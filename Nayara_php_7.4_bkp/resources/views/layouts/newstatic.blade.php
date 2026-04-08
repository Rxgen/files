<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9" lang="en"><![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	@include('includes.head')

	
@if(Route::currentRouteName() == 'blog.detail' )
			@if(isset($post))
			<title>{{ $post->meta_title }}</title>
			<meta name="description" content="{{ $post->meta_description }}">
			<meta name="keywords" content="{{ $post->meta_keywords }}">
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


	

	

	@if(!empty($blogSchemaCode))
	{!! $blogSchemaCode !!}
	@endif
</head>
<body>
	{!! setting('site.after_body_tags') !!}

	@if(Route::currentRouteName() == 'retail.thankyou')
		<!--
	Start of Floodlight Tag: Please do not remove
	Activity name of this tag: Nayara Energy - Lead Form - Thankyou page
	URL of the webpage where the tag is expected to be placed: https://www.nayaraenergy.com/retail/apply-online/thankyou
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/18/2020
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<img src="https://ad.doubleclick.net/ddm/activity/src=10061040;type=leadty0;cat=nayar0;u1=[Thankyou];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1;num=' + a + '?" width="1" height="1" alt=""/>');
	</script>
	<noscript>
	<img src="https://ad.doubleclick.net/ddm/activity/src=10061040;type=leadty0;cat=nayar0;u1=[Thankyou];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1;num=1?" width="1" height="1" alt=""/>
	</noscript>
	<!-- End of Floodlight Tag: Please do not remove -->
	@endif

	@include('includes.newheader')

	<main class="wrapper">
		@yield('content')
	</main>
	@include('includes.footer')
	
	{!! setting('site.footer_javascript_tags') !!}
</body>
</html>