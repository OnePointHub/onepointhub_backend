<?php

use App\Models\Helpdesk\KbArticle;
use App\Models\Helpdesk\KbCategory;
use App\Models\User;
use Database\Seeders\HelpdeskModulePermissionsSeeder;
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

it('can show all categories', function () {
    $this->user->givePermissionTo('read categories');

    KbCategory::factory(10)->create();

    $response = $this->getJson(route('kbcategories.index'));

    $response->assertOk();

    $response->assertJson(fn(AssertableJson $json) => $json->has('data', 10));

    $this->assertDatabaseCount('kb_categories', 10);
});

it('can show single category', function () {
    $this->user->givePermissionTo('read categories');

    $category = KbCategory::factory()->create([
        'name' => 'Category 1',
    ]);

    $response = $this->getJson(route('kbcategories.show', $category->slug));

    $response->assertOk();

    $response
        ->assertJsonPath('data.name', $category->name);
});

it('can create category', function () {
    $this->user->givePermissionTo('create categories');

    $category = [
        'name' => 'Category 1',
    ];

    $response = $this->postJson(route('kbcategories.store'), $category);

    $response->assertCreated();

    $response
        ->assertJsonPath('data.name', $category['name']);

    $this->assertDatabaseCount('kb_categories', 1);

    $this->assertDatabaseHas('kb_categories', $category);
});

it('can edit category', function () {
    $this->user->givePermissionTo('edit categories');

    $category = KbCategory::factory()->create();

    $newCategory = [
        'name' => 'Category 1',
    ];

    $response = $this->putJson(route('kbcategories.update', $category->slug), $newCategory);

    $response->assertOk();

    $response
        ->assertJsonPath('data.name', $newCategory['name']);

    $this->assertDatabaseHas('kb_categories', [
        'name' => $newCategory['name'],
    ]);
});

it('can delete category', function () {
    $this->user->givePermissionTo('delete categories');

    $category = KbCategory::factory()->create();

    $response = $this->deleteJson(route('kbcategories.destroy', $category->slug));

    $response->assertOk();


    $this->assertDatabaseMissing('kb_categories', $category->toArray());
});

it('can attach an article to category', function () {
    $this->user->givePermissionTo('attach article to categories');

    $category = KbCategory::factory()->create();

    $article = KbArticle::factory()->create();

    $response = $this->putJson(route('kbcategories.attach', [$category->slug, $article->slug]));

    $response->assertOk();

    $response
        ->assertJsonPath('data.id', $category->id)
        ->assertJsonPath('data.name', $category->name)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data.articles', 1)
            ->has('data.articles.0', fn (AssertableJson $json) =>
            $json->where('id', $article->id)
                ->etc())
        );
});

it('can detach an article from category', function () {
    $this->user->givePermissionTo('detach article from categories');

    $category = KbCategory::factory()->create();

    $article = KbArticle::factory()->create();

    $category->kb_articles()->detach($category);

    $response = $this->putJson(route('kbcategories.detach', [$category->slug, $article->slug]));

    $response->assertOk();

    $response
        ->assertJsonPath('data.id', $category->id)
        ->assertJsonPath('data.name', $category->name)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data.articles', 0)
        );
});

