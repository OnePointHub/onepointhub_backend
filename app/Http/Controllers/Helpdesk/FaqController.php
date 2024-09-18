<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Helpdesk\FaqRequest;
use App\Http\Resources\Helpdesk\FaqResource;
use App\Models\Helpdesk\Faq;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Carbon;

class FaqController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:read faqs', only: ['index', 'show']),
            new Middleware('permission:create faqs', only: ['store']),
            new Middleware('permission:edit faqs', only: ['update']),
            new Middleware('permission:delete faqs', only: ['destroy']),
            new Middleware('permission:publish faqs', only: ['publish']),
            new Middleware('permission:unpublish faqs', only: ['unpublish']),
        ];
    }

    public function index()
    {
        return FaqResource::collection(Faq::all());
    }

    public function store(FaqRequest $request)
    {
        return new FaqResource(Faq::create($request->validated()));
    }

    public function show(Faq $faq)
    {
        return new FaqResource($faq);
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return new FaqResource($faq);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return response()->json();
    }

    public function publish(Faq $faq, $publishDate = null)
    {
        if ($publishDate) {
            $faq->published_at  = $publishDate;
        } else {
            $faq->published_at  = Carbon::now()->toDateTimeString();
        }

        return new FaqResource($faq);
    }

    public function unpublish(Faq $faq)
    {
        $faq->published_at = null;

        return new FaqResource($faq);
    }
}
