<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9" lang="en"><![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    @include('includes.head')
    <title>{!! setting('site.title') !!}</title>
	<meta name="description" content="{!! setting('site.description') !!}">
	<meta name="keywords" content="{!! setting('site.keywords') !!}">
</head>
<body class="page-front">
	{!! setting('site.after_body_tags') !!}
	<h1 class="hidden_seo_tag">Petroleum Company in India</h1>
    <h2 class='hidden_seo_tag'>Nayara Energy</h2>
@include('includes.header')
<main>
    @yield('content')
</main>
@include('includes.footer')
{!! setting('site.footer_javascript_tags') !!}
</body>
</html>