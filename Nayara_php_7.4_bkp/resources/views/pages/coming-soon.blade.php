<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	@include('includes.head')
	<title>Coming Soon</title>
	<meta name="robots" content="noindex">
</head>
<body>
	@include('includes.newheader')

	<main class="wrapper">
		<section class="container error-container">
            <h1 class="error__heading coming-soon__heading">Coming Soon</h1>
            {{-- <p class="error__content"><a href="{{url('/')}}" class="cta gradient-cta theme-gradient"><span class="gradient-cta-overlay gradient-text theme-gradient">Go Back</span></a></p> --}}
        </section>
	</main>
	@include('includes.footer')
</body>
</html>