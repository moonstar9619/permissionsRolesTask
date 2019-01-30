<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::get();
        return view('posts.index',compact('posts'));
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);
        return view('posts.show',compact('post'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'title'=>'required|max:100',
            'body'=>'required'
        ]);
        $newPost = [
          'title' =>$request->input('title'),
            'body'=>$request->input('body')
        ];
        $newPostObject = Post::create($newPost);
        return redirect()->route('post.list')->with('msg','Article'.$newPostObject->title.' created!');
    }

    public function edit($post_id)
    {
        $post = Post::find($post_id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $post_id)
    {
        $this->validate($request,[
           'title'=>'required|max:100',
            'body'=>'required'
        ]);
        $editPost = [
          'title'=>$request->input('title'),
            'body'=>$request->input('body')
        ];
        $post = Post::find($post_id);
        $post->update($editPost);
        return redirect()->route('post.list')->with('msg','Article, '.$post->title.' updated!');
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->route('post.list')->with('msg','Article successfully deleted!');
    }
}
