@extends('layouts.default')

@section('title', 'Todoリスト')

@section('content')
<div class="search_form">
<p class="form_text">
  <input type="text" id="search_field" name="search" placeholder="title" value="{{ old('title') }}">
</p>
<p class="form_submit">
  <input type="submit" id="search_submit" value="検索">
</p>
</div>

<div class="result_area">
<ul class="todolist" id="postdata"></ul>
<ul class="todolist" id="tododata"></ul>
</div>

<script>
$('#search_submit').on('click', function() {
  $value = $('#search_field').val();
  $.ajax({
    type: 'get',
    url: '{{URL::to('search\/ajax')}}',
    data: {'search':$value},
    })
    .then(
      function(data) {
        $('#tododata').html(data[0]);
        $('#postdata').html(data[1]);
      },
      function() {
        alert('読み込み失敗');
    });
});
</script>

@endsection
