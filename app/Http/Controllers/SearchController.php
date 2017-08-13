<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Post;

class SearchController extends Controller
{
    public function index() {
      return view('search.search');

      // return view('search.search')->with([
      //   'todos' => $todos,
      //   'posts' => $posts,
      // ]);
    }

    public function search(Request $request) {
      if($request->ajax()) {
        $todos = Todo::where('title', 'LIKE', '%'.$request->search.'%')->get();
        $posts = Post::Where('title', 'LIKE', '%'.$request->search.'%')->get();

        $todo_output='';
        $post_output='';
        if(count($todos) != 0 || count($posts) != 0) {
          if(count($todos) == 0) {
            $todo_output.='<p class="result_txt">対象のTodoリストは見つかりません</p>';
          } else {
            $todo_output.='<p class="result_txt">Todoリストが'.count($todos).'件見つかりました</p>';
          }
          if(count($posts) == 0) {
            $post_output.='<p class="result_txt">対象のTodoは見つかりません</p>';
          } else {
            $post_output.='<p class="result_txt">Todoが'.count($posts).'件見つかりました</p>';
          }
          foreach($todos as $key => $todo) {
            $todo_output.='<li>'.
                          '<ul class="postlist">'.
                          '<li><a href="'.action('TodosController@show', $todo->id).'" class="title">'.$todo->title.'</a></li>'.
                          '<li>作成日：'.$todo->created_at->format('Y年m月d日').'</li>'.
                          '</ul>'.
                          '</li>';
          }
          foreach($posts as $key => $post) {
            $post_output.='<li>'.
                          '<ul class="postlist">'.
                          '<li><a href="'.action('TodosController@show', $post->todo_id).'" class="title">'.$post->title.'</a></li>'.
                          '<li>'.$post->todo->title.'</li>'.
                          '<li>期限：'.date('Y年m月d日', strtotime($post->deadline)).'</li>'.
                          '<li>作成日：'.$post->created_at->format('Y年m月d日').'</li>'.
                          '</ul>'.
                          '</li>';
          }
        } else {
          $todo_output.='<p class="result_txt">対象のTodoリストは見つかりません</p>';
          $post_output.='<p class="result_txt">対象のTodoは見つかりません</p>';
        }
        return Response([$todo_output, $post_output]);
      }
    }
}
