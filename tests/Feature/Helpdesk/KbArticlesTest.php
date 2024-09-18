<?php

use App\Models\Helpdesk\KbArticle;
use App\Models\Helpdesk\KbCategory;
use App\Models\User;
use Database\Seeders\HelpdeskModulePermissionsSeeder;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->seed(HelpdeskModulePermissionsSeeder::class);
    $this->user = User::factory()->create();
    Sanctum::actingAs(
        $this->user,
        ['*']
    );
});

it('can show all articles', function () {
    $this->user->givePermissionTo('read articles');

    KbArticle::factory(10)->create();

    $response = $this->getJson(route('kbarticles.index'));

    $response->assertOk();

    $response->assertJson(fn(AssertableJson $json) => $json->has('data', 10));

    $this->assertDatabaseCount('kb_articles', 10);
});

it('can show single article', function () {
    $this->user->givePermissionTo('read articles');

    $article = KbArticle::factory()->create([
        'title' => 'Article title',
        'body' => 'Article body',
    ]);

    $response = $this->getJson(route('kbarticles.show', $article->slug));

    $response->assertOk();

    $response
        ->assertJsonPath('data.title', $article->title)
        ->assertJsonPath('data.body', $article->body);
});

it('can create article', function () {
    $this->user->givePermissionTo('create articles');

    $article = [
        'title' => 'Article title',
        'body' => 'Article body',
    ];

    $response = $this->postJson(route('kbarticles.store'), $article);

    $response->assertCreated();

    $response
        ->assertJsonPath('data.title', $article['title'])
        ->assertJsonPath('data.body', $article['body']);

    $this->assertDatabaseCount('kb_articles', 1);

    $this->assertDatabaseHas('kb_articles', $article);
});

it('can edit article', function () {
    $this->user->givePermissionTo('edit articles');

    $article = KbArticle::factory()->create();

    $newArticle = [
        'title' => 'Article title',
        'body' => $article->body,
    ];

    $response = $this->putJson(route('kbarticles.update', $article->slug), $newArticle);

    $response->assertOk();

    $response
        ->assertJsonPath('data.title', $newArticle['title'])
        ->assertJsonPath('data.body', $article->body);

    $this->assertDatabaseHas('kb_articles', [
        'title' => $newArticle['title'],
        'body' => $article->body,
    ]);
});

it('can delete article', function () {
    $this->user->givePermissionTo('delete articles');

    $article = KbArticle::factory()->create();

    $response = $this->deleteJson(route('kbarticles.destroy', $article->slug));

    $response->assertOk();

    $this->assertDatabaseMissing('kb_articles', $article->toArray());
});

it('can attach a category to article', function () {
    $this->user->givePermissionTo('attach category to articles');

    $category = KbCategory::factory()->create();

    $article = KbArticle::factory()->create();

    $response = $this->putJson(route('kbarticles.attach', [$article->slug, $category->slug]));

    $response->assertOk();

    $response
        ->assertJsonPath('data.id', $article->id)
        ->assertJsonPath('data.title', $article->title)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('data.categories', 1)
                ->has('data.categories.0', fn (AssertableJson $json) =>
                    $json->where('id', $category->id)
                        ->etc())
            );
});

it('can detach a category from article', function () {
    $this->user->givePermissionTo('detach category from articles');

    $category = KbCategory::factory()->create();

    $article = KbArticle::factory()->create();

    $article->kb_categories()->detach($category);

    $response = $this->putJson(route('kbarticles.detach', [$article->slug, $category->slug]));

    $response->assertOk();

    $response
        ->assertJsonPath('data.id', $article->id)
        ->assertJsonPath('data.title', $article->title)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data.categories', 0)
        );
});

it('can publish an article without specifying a date', function () {
    $this->user->givePermissionTo('publish articles');

    $article = KbArticle::factory()->create([
        'title' => 'Article title',
        'body' => 'Article body',
    ]);

    $response = $this->putJson(route('kbarticles.publish', $article->slug));

    $response->assertOk();

    $response
        ->assertJsonPath('data.title', $article->title)
        ->assertJsonPath('data.body', $article->body)
        ->assertJsonPath('data.published_at', Carbon::now()->toDateTimeString());
});

it('can publish an article specifying a date', function () {
    $this->user->givePermissionTo('publish articles');

    $article = KbArticle::factory()->create([
        'title' => 'Article title',
        'body' => 'Article body',

    ]);

    $published_at = '2024-01-01 12:00:05';

    $response = $this->putJson(route('kbarticles.publish', [$article->slug, $published_at]));

    $response->assertOk();

    $response
        ->assertJsonPath('data.title', $article->title)
        ->assertJsonPath('data.body', $article->body)
        ->assertJsonPath('data.published_at', $published_at);
});

it('can unpublish an article', function () {
    $this->user->givePermissionTo('unpublish articles');

    $article = KbArticle::factory()->create([
        'title' => 'Article title',
        'body' => 'Article body',
        'published_at' => '2024-01-01 12:00:05',
    ]);

    $response = $this->putJson(route('kbarticles.unpublish', $article->slug));

    $response->assertOk();

    $response
        ->assertJsonPath('data.title', $article->title)
        ->assertJsonPath('data.body', $article->body)
        ->assertJsonPath('data.published_at', null);
});
