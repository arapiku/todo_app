<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Requests\TodoRequest;

class TodosController extends Controller
{
    public function index() {
      $todos = Todo::latest('created_at')->get();
      return view('todos.index')->with('todos', $todos); // with：ビューで変数を使えるようにする
    }

    public function store(TodoRequest $request) {
      $todo = new Todo();
      $todo->title = $request->title;
      $todo->save();
      return redirect('/')->with('flash_message', 'Todoを追加しました！');
    }

    public function show($id) {
      $todo = Todo::findOrFail($id);
      return view('todos.show')->with('todo', $todo);
    }

    public function destroy($id) {
      $todo = Todo::findOrFail($id);
      $todo->delete();
      return redirect('/')->with('flash_message', 'Todoを削除しました！');
    }
}
