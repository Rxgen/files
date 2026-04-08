<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9" lang="en"><![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    @include('includes.head')

	@if(Route::currentRouteName() == 'home.homepage' )
	<title>{!! setting('site.title') !!}</title>
	<meta name="description" content="{!! setting('site.description') !!}">
	<meta name="keywords" content="{!! setting('site.keywords') !!}">
	@endif
	
</head>
<body class="page-front">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54Q6TP5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	{!! setting('site.after_body_tags') !!}
@include('includes.newheader')
<main class="wrapper">
    @yield('content')
</main>
@include('includes.footer')
@php  $basename =  Route::currentRouteName() @endphp
@if( $basename == 'event.contact')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endif
{!! setting('site.footer_javascript_tags') !!}
</body>
</html>