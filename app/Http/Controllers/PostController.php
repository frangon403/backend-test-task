<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() ////возвращаем посты
    {

        try {
            $posts = Post::all();
            return PostResource::collection($posts);
        } catch (\Exception $exception) {
            return "Index error: {$exception->getMessage()}";
        }

    }

    public function show(Post $post) //возвращаем пост
    {
        try {
            return new PostResource($post);
        } catch (\Exception $exception) {
            return "Show error: {$exception->getMessage()}";
        }

    }

    public function store(CreateRequest $request) //возвращаем созданный пост
    {
        try {
            $data = $request->validated();
            $post = Post::create($data);
            return new PostResource($post);
        } catch (\Exception $exception) {
            return "Store error: {$exception->getMessage()}";
        }
    }

    public function update(Post $post, UpdateRequest $request) //возвращаем обновленный пост
    {

        try {
            $data = $request->validated();
            $post->update($data);
            return new PostResource($post);
        } catch (\Exception $exception) {
            return "Update error: {$exception->getMessage()}";
        }

    }

    public function destroy(Post $post)
    {

        try {
            $post->delete();
            return new PostResource($post); //возвращаем удаленный пост
        } catch (\Exception $exception) {
            return "Destroy error: {$exception->getMessage()}";
        }

    }

}
