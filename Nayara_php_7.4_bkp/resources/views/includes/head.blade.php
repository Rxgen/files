<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<base href="{{URL::to('/')}}/" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
<meta name="theme-color" content="#249adf">

<link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="manifest.json">
@if(isset($page) && isset($page[0]))
<meta property="og:title" content="{{$page[0]->meta_title}}">
<meta property="og:description" content="{{$page[0]->meta_description}}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:image" content="{{Voyager::image($page[0]->desktop_banner)}}">
<!-- <link rel="canonical" href="www.nayaraenergy.com"> -->
@else
<meta property="og:title" content="Nayara Energy">
<meta property="og:description" content="Petroleum Company in India">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:image" content="{{asset('images/thumbnail.jpg')}}">
@endif
@if(!empty($post->custom_canonical ?? false))
    <link rel="canonical" href="{{ $post->custom_canonical }}">
@elseif(!empty($custom_canonical ?? false))
    <link rel="canonical" href="{{ $custom_canonical }}">
@elseif(!empty($page[0]->custom_canonical ?? false))
    <link rel="canonical" href="{{ $page[0]->custom_canonical }}">
@else
    <link rel="canonical" href="{{ URL::current() }}">
@endif
<!--<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />-->
<link rel="stylesheet" type="text/css" href="{{asset('css/newstyle.css')}}" />

@php  $basename =  Route::currentRouteName() @endphp
@if( $basename == 'event.contact')

<link rel="stylesheet" type="text/css" href="{{asset('css/swiper-bundle.min.css')}}" />
@endif
@include('includes.gtmcode')
