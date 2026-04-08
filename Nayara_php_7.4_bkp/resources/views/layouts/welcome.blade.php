<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9" lang="en"><![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    @include('includes.head')

    

@if(Route::currentRouteName() == 'static.petrochemicals' )
			@if(isset($page) && !is_null($page))
			<title>{{ $page->meta_title }}</title>
			<meta name="description" content="{{ $page->meta_description }}">
			<meta name="keywords" content="{{ $page->meta_keywords }}">
			@if(!empty($page->page_schema))
			{!!  $page->page_schema  !!}
			@endif
		@endif
 @else
          @if(isset($page) && count($page) > 0)
	     <title>{{$page[0]->meta_title}}</title>
	    <meta name="description" content="{{ $page[0]->meta_description }}">
	   <meta name="keywords" content="{{ $page[0]->meta_keywords }}">
		@if(!empty($page[0]->page_schema))
			{!!  $page[0]->page_schema  !!}
			@endif
	@endif
@endif



@if(!empty($eventSchemaCode))
	{!! $eventSchemaCode !!}
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
<script src="{{asset('js/swiper-bundle.min.js')}}"></script>

@endif
{!! setting('site.footer_javascript_tags') !!}
</body>
</html>