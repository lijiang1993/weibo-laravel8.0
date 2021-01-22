<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', 'Weibo App') - Laravel 入门教程</title>
  <link rel="stylesheet" href="{{mix('/css/app.css')}}">
</head>
<body>

@include('layouts._header')

<div class="container">
  @include('shared._messages')
  @yield('content')
  @include('layouts._footer')
</div>
</body>
</html>
