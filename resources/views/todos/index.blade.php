@extends('layouts.default')

@section('title', 'Todoリスト')

@section('content')
<p>新しいTodoを作成する</p>

<form method="post" action="{{ url('/') }}" class="main_form">
  {{ csrf_field() }}
  <p class="form_text">
    <input type="text" name="title" placeholder="リスト名を入力してください" value="{{ old('title') }}">
    @if ($errors->has('title'))
    <span class="error">{{ $errors->first('title') }}</span>
    @endif
  </p>
  <p class="form_submit">
    <input type="submit" value="リストの作成">
  </p>
</form>

<ul class="todolist">

  @forelse ($todos as $todo)
  <li>

    <a href="{{ action('TodosController@show', $todo->id) }}" class="title">{{ $todo->title }}</a>

    <form action="{{ action('TodosController@destroy', $todo->id)}}" id="form_{{ $todo->id }}" method="post" class="delete_form">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <a href="#" data-id="{{ $todo->id }}" onclick="deletePost(this);" class="fa fa-times" aria-hidden="true"></a>
    </form>
    @if($todo->posts != null)

    @if($todo->posts->count() != 0)
    <p>
      {{$todo->posts->count()}}個中
      <?php $i=0; ?>
      @foreach($todo->posts as $post)
      @if($post->enabled == true)
      <?php $i++; ?>
      @endif
      @endforeach
      <?php echo $i; ?>個がチェック済み
    </p>
    @else
    <p>Todoがありません</p>
    @endif

    <p>
      <?php $time = strtotime('0000-00-00'); ?>
      @foreach($todo->posts as $post)
      <?php
        if(strtotime($time) > strtotime($post->deadline)) :
        $time = $post->deadline;
        else :
        continue;
        endif;
      ?>
      @endforeach
      <?php if(!($time==-62170016400)) { echo '直近の締切日：' . date('Y年m月d日', strtotime($time)); } ?>
    </p>

    @endif
  </li>

  @empty

  <li>Todoはありません</li>

  @endforelse

</ul>

<script>
function deletePost(e) {
  'use strict';

  if (confirm('are you sure?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>
@endsection
