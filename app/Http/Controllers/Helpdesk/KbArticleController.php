<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Helpdesk\KbArticleRequest;
use App\Http\Resources\Helpdesk\KbArticleResource;
use App\Models\Helpdesk\KbArticle;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Carbon;

class KbArticleController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:read articles', only: ['index', 'show']),
            new Middleware('permission:create articles', only: ['store']),
            new Middleware('permission:edit articles', only: ['update']),
            new Middleware('permission:delete articles', only: ['destroy']),
            new Middleware('permission:publish articles', only: ['publish']),
            new Middleware('permission:unpublish articles', only: ['unpublish']),
        ];
    }

    public function index()
    {
        return KbArticleResource::collection(KbArticle::all());
    }

    public function store(KbArticleRequest $request)
    {
        return new KbArticleResource(KbArticle::create($request->validated()));
    }

    public function show(KbArticle $kbArticle)
    {
        return new KbArticleResource($kbArticle);
    }

    public function update(KbArticleRequest $request, KbArticle $kbArticle)
    {
        $kbArticle->update($request->validated());
        $kbArticle->refresh();

        return new KbArticleResource($kbArticle);
    }

    public function destroy(KbArticle $kbArticle)
    {
        $kbArticle->delete();

        return response()->json();
    }

    public function publish(KbArticle $kbArticle, $publishDate = null)
    {
        if ($publishDate) {
            $kbArticle->published_at  = $publishDate;
        } else {
            $kbArticle->published_at  = Carbon::now()->toDateTimeString();
        }

        return new KbArticleResource($kbArticle);
    }

    public function unpublish(KbArticle $kbArticle)
    {
        $kbArticle->published_at = null;

        return new KbArticleResource($kbArticle);
    }
}
