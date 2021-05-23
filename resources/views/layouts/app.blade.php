<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

    <script src="https://bossanova.uk/jexcel/v4/jexcel.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v4/jexcel.css" type="text/css" />
    <script src="https://jsuites.net/v3/jsuites.js"></script>
    <link rel="stylesheet" href="https://jsuites.net/v3/jsuites.css" type="text/css" />

    <title>@yield('title-blog')</title>
</head>
<body>
<div>
</div>
@if(Auth::user() !== NULL)
    <div id="content">
        <div class="groupRightMenu">
            @include('includes.rightMenu')
        </div>

        <div class="center">
            <div class="contain" id="contain">
                @include('includes.messages')
            </div>
            @yield('content')
        </div>
    </div>
@else
    <div id="content">
        <div class="contain" id="contain">
            @include('includes.messages')
        </div>
        @yield('content')
    </div>
@endif
</body>
</html>
