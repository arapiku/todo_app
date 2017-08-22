@extends('layouts.default')

@section('title', $todo->title)

@section('content')
<h1>{{ $todo->title }}</h1>
<p>新しいフォームを作成する</p>

<form method="post" action="{{ action('PostsController@store', $todo->id) }}" class="main_form">
  {{ csrf_field() }}
  <p class="form_text">
    <input type="text" name="title" placeholder="ToDo名を入力してください" value="{{ old('title') }}">
    @if ($errors->has('title'))
    <span class="error">{{ $errors->first('title') }}</span>
    @endif
    <input type="date" name="deadline" value="{{ old('deadline'), date('Y-m-d') }}">
    @if ($errors->has('deadline'))
    <span class="error">{{ $errors->first('deadline') }}</span>
    @endif
    <input type="hidden" name="enabled" value="0">
  </p>
  <p class="form_submit form_submit_post">
    <input type="submit" value="ToDoの追加">
  </p>
</form>

@forelse($todo->posts as $post)
<ul class="todolist">
  <li>
    <div class="post_content">
      <ul class="postlist">
        <li class="title">{{ $post->title }}</li>
        <li>期限：　<?php echo date('Y年m月d日', strtotime($post->deadline)); ?></li>
        <li>作成日：　{{ $post->created_at->format('Y年m月d日') }}</li>
      </ul>
    </div>
    <div class="post_enabled">
      @if($post->enabled == 0)
      <?php $tf = 1; ?>
      @else
      <?php $tf = 0; ?>
      @endif
      <form method="post" action="{{ url('/todos', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <input type="hidden" name="enabled" value="<?php echo $tf; ?>">
        <input type="submit" value="@if($post->enabled == 0)完了@else未完了@endif" class="enabled_btn @if($post->enabled == 0)enable_true @endif">
      </form>
    </div>
  </li>
</ul>
@empty
<p>登録されたToDoはございません！</p>
@endforelse

@endsection
