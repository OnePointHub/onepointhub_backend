<?php

use App\Models\Helpdesk\Faq;
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

it('can show all FAQs', function () {
    $this->user->givePermissionTo('read faqs');

    Faq::factory(10)->create();

    $response = $this->getJson(route('faq.index'));

    $response->assertOk();

    $response->assertJson(fn(AssertableJson $json) => $json->has('data', 10));

    $this->assertDatabaseCount('faqs', 10);
});

it('can show single FAQ', function () {
    $this->user->givePermissionTo('read faqs');

    $faq = Faq::factory()->create([
        'question' => 'What is the name of the question?',
        'answer' => 'This is the answer to the question',
    ]);

    $response = $this->getJson(route('faq.show', $faq->id));

    $response->assertOk();

    $response
        ->assertJsonPath('data.question', $faq->question)
        ->assertJsonPath('data.answer', $faq->answer);
});

it('can create FAQ', function () {
    $this->user->givePermissionTo('create faqs');

    $faq = [
        'question' => 'What is the name of the question?',
        'answer' => 'This is the answer to the question',
    ];

    $response = $this->postJson(route('faq.store'), $faq);

    $response->assertCreated();

    $response
        ->assertJsonPath('data.question', $faq['question'])
        ->assertJsonPath('data.answer', $faq['answer']);

    $this->assertDatabaseCount('faqs', 1);

    $this->assertDatabaseHas('faqs', $faq);
});

it('can edit FAQ', function () {
    $this->user->givePermissionTo('edit faqs');

    $faq = Faq::factory()->create();

    $newFaq = [
        'question' => 'What is the name of the question?',
        'answer' => $faq->answer,
    ];

    $response = $this->putJson(route('faq.update', $faq), $newFaq);

    $response->assertOk();

    $response
        ->assertJsonPath('data.question', $newFaq['question'])
        ->assertJsonPath('data.answer', $faq->answer);

    $this->assertDatabaseHas('faqs', [
        'question' => $newFaq['question'],
        'answer' => $faq->answer,
    ]);
});

it('can delete FAQ', function () {
    $this->user->givePermissionTo('delete faqs');

    $faq = Faq::factory()->create();

    $response = $this->deleteJson(route('faq.destroy', $faq));

    $response->assertOk();

    $this->assertDatabaseMissing('faqs', $faq->toArray());
});

it('can publish a FAQ without specifying a date', function () {
    $this->user->givePermissionTo('publish faqs');

    $faq = Faq::factory()->create([
        'question' => 'Question 1',
        'answer' => 'Answer 1',
    ]);

    $response = $this->putJson(route('faq.publish', $faq));

    $response->assertOk();

    $response
        ->assertJsonPath('data.question', $faq->question)
        ->assertJsonPath('data.answer', $faq->answer)
        ->assertJsonPath('data.published_at', Carbon::now()->toDateTimeString());
});

it('can publish a FAQ specifying a date', function () {
    $this->user->givePermissionTo('publish faqs');

    $faq = Faq::factory()->create([
        'question' => 'Question 1',
        'answer' => 'Answer 1',

    ]);

    $published_at = '2024-01-01 12:00:05';

    $response = $this->putJson(route('faq.publish', [$faq, $published_at]));

    $response->assertOk();

    $response
        ->assertJsonPath('data.question', $faq->question)
        ->assertJsonPath('data.answer', $faq->answer)
        ->assertJsonPath('data.published_at', $published_at);
});

it('can unpublish a FAQ', function () {
    $this->user->givePermissionTo('unpublish faqs');

    $faq = Faq::factory()->create([
        'question' => 'Question 1',
        'answer' => 'Answer 1',
        'published_at' => '2024-01-01 12:00:05',
    ]);

    $response = $this->putJson(route('faq.unpublish', $faq));

    $response->assertOk();

    $response
        ->assertJsonPath('data.question', $faq->question)
        ->assertJsonPath('data.answer', $faq->answer)
        ->assertJsonPath('data.published_at', null);
});

