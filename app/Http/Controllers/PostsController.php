<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Todo;

class PostsController extends Controller
{

  public function store(PostRequest $request, $todoId) {
    $post = new Post();
    $post->title = $request->title;
    $post->deadline = $request->deadline;
    $post->enabled = $request->enabled;
    $todo = Todo::findOrFail($todoId);
    $todo->posts()->save($post);

    return redirect()
           ->action('TodosController@show', $todo->id)
           ->with('flash_message', 'Todoを追加しました！');
  }

  public function update(Request $request, $id) {
    $post = Post::findOrFail($id);
    $post->enabled = $request->enabled;
    $post->save();
    return redirect()
           ->action('TodosController@show', $post->todo_id);
  }
}
