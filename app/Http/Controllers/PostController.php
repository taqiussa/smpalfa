<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function detail()
    {
        return view('livewire.kreator.post.detail-post',['post' => Post::with('user')->where('slug', request('slug'))->first()]);
    }
}
