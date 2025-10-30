<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <title>@yield('title', ' Central Council for Research in Yoga & Naturopathy (CCRYN)')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Central Council for Research in Yoga & Naturopathy (CCRYN)">
    <meta name="keywords"
        content="Central Council for Research in Yoga & Naturopathy (CCRYN)">
    <meta content="Central Council for Research in Yoga & Naturopathy (CCRYN)" name="author">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Central Council for Research in Yoga & Naturopathy (CCRYN)">
    <meta property="og:description"
        content="Central Council for Research in Yoga & Naturopathy (CCRYN)">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">

    @yield('css')
    @include('front.partials.head-css')
</head>

<body>

    @include('front.partials.header')
    @include('front.partials.preloader')


    <main class="app-wrapper">
        <div class="app-container">

            @include('front.partials.breadcrumb')

            <!-- end page title -->

            @yield('content')
            @include('front.partials.bottom-wrapper')
            @yield('js')

</body>

</html>