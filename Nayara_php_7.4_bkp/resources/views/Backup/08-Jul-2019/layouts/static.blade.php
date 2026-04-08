<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9" lang="en"><![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	@include('includes.head')
	@if(count($page) > 0)
	<title>{{$page[0]->meta_title}}</title>
	<meta name="description" content="{{$page[0]->meta_description}}">
	<meta name="keywords" content="{{$page[0]->meta_keywords}}">
	@endif
</head>
<body>
	@include('includes.header')

	<main class="wrapper">
		@yield('content')
	</main>
	@include('includes.footer')
</body>
</html>