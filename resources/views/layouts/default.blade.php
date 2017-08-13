<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
  <header>
    <div class="h_inner">
      <div class="h_title"><a href="/">ToDoリスト</a></div>
      <div class="h_search"><a href="/search"><i class="fa fa-search" aria-hidden="true"></i> 検索</a></div>
    </div>
  </header>
  @if (session('flash_message'))
  <div class="flash_message" onclick="this.classList.add('hidden')">{{ session('flash_message') }}</div>
  @endif
  <div class="container">
  @yield('content')
  </div>
</body>
</html>
