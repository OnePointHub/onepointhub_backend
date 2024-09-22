<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Helpdesk\KbCategoryRequest;
use App\Http\Resources\Helpdesk\KbCategoryResource;
use App\Models\Helpdesk\KbCategory;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KbCategoryController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:read categories', only: ['index', 'show']),
            new Middleware('permission:create categories', only: ['store']),
            new Middleware('permission:edit categories', only: ['update']),
            new Middleware('permission:delete categories', only: ['destroy']),
        ];
    }

    public function index()
    {
        return KbCategoryResource::collection(KbCategory::withCount('articles')->get());
    }

    public function store(KbCategoryRequest $request)
    {
        return new KbCategoryResource(KbCategory::create($request->validated()));
    }

    public function show(KbCategory $kbCategory)
    {
        return new KbCategoryResource($kbCategory);
    }

    public function update(KbCategoryRequest $request, KbCategory $kbCategory)
    {
        $kbCategory->update($request->validated());

        return new KbCategoryResource($kbCategory);
    }

    public function destroy(KbCategory $kbCategory)
    {
        $kbCategory->delete();

        return response()->json();
    }
}
