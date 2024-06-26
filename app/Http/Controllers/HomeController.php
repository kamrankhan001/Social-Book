<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $post = Post::query()->latest()->paginate(20);

        return Inertia::render("Home",[
            'posts' => PostResource::collection($post),
        ]);
    }
}
