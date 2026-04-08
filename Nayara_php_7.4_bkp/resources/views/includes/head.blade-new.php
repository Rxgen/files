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
<link rel="canonical" href="{{ URL::current() }}">

<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
<!-- Hotjar Tracking Code for my site -->

<!---End of Hotjar Tracking Code for my site ---->

<!-- Google Tag Manager -->

<!-- End Google Tag Manager -->


@php
$url = url('/');
$url= trim($url, '/');
if (!preg_match('#^http(s)?://#', $url)) {
    $url = 'http://' . $url;
}
$urlParts = parse_url($url);
$domain = preg_replace('/^www\./', '', $urlParts['host']);
//dd($domain);
@endphp
@if($domain == 'nayaraenergy.com')
	
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6EDN8NZ3RQ"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<meta name="google-site-verification" content="pa7BLq3l8N5oTcJFFixxvjIkkrw4WdIHL4EdzaXa_u0" />
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142048367-1"></script>



<!-- Global site tag (gtag.js) - Google Ads: 734101562 28th may 2020-->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=AW-734101562"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-734101562');
</script> --}}

<!-- Global site tag (gtag.js) - Google Marketing Platform 4th June 2020 -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=DC-10061040"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'DC-10061040');
</script> --}}
<!-- End of global snippet: Please do not remove -->

<!-- 
Start of global snippet: Please do not remove Place this snippet between the <head> and </head> tags on every page of your site. date - 17/6/2020-->
<!-- Global site tag (gtag.js) - Google Marketing Platform -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=DC-10061040"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'DC-10061040');
</script> --}}
<!-- End of global snippet: Please do not remove -->

@if(collect(request()->segments())->last() == 'apply-online')
{!! setting('site.apply_online_tracking_code') !!}
<!-- Event snippet for Lead form - Franchise conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. 28th may 2020-->
{{-- <script>
function gtag_report_conversion_may(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-734101562/5RtfCN_L1NEBELqAht4C',
      'event_callback': callback
  });
  return false;
}
</script> --}}

<!--
Event snippet for Nayara Energy - Lead Form on https://www.nayaraenergy.com/retail/apply-online: Please do not remove.
Place this snippet on pages with events you’re tracking. 
Creation date: 06/04/2020
-->
{{-- <script>
  gtag('event', 'conversion', {
    'allow_custom_scripts': true,
    'send_to': 'DC-10061040/lead0/nayar0+unique'
  });
</script> --}}
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=10061040;type=lead0;cat=nayar0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1;num=1?" width="1" height="1" alt=""/>
</noscript>
<!-- End of event snippet: Please do not remove -->
@endif

@if(Route::currentRouteName() == 'retail.thankyou')
{!! setting('site.thank_you_page_tracking_code') !!}
<!--Event snippet for Nayara Energy - Lead Form - Thankyou page on https://www.nayaraenergy.com/retail/apply-online/thankyou: Please do not remove.Place this snippet on pages with events you’re tracking. Creation date: 06/16/2020-->
{{-- <script>
  gtag('event', 'conversion', {
    'allow_custom_scripts': true,
    'u1': '[Thankyou]',
    'send_to': 'DC-10061040/leadty0/nayar0+unique'
  });
</script> --}}
{{-- <noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=10061040;type=leadty0;cat=nayar0;u1=[Thankyou];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1;num=1?" width="1" height="1" alt=""/>
</noscript> --}}
<!-- End of event snippet: Please do not remove -->

<!-- Event snippet for Page view - Thank You - Franchise Form conversion page -->

@endif

@if(collect(request()->segments())->last() == 'apply-online-for-dealership')

@endif
@if(Route::currentRouteName() == 'dealership.thankyou')

@endif

<!-- Event snippet for Nayara-Google Remarketing Tag conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> 
{{-- <script> 
  function gtag_report_conversion(url) { 
    var callback = function () { 
    if (typeof(url) != 'undefined') { 
      window.location = url; } 
    }; 
    gtag('event', 'conversion', { 
      'send_t28th may 2020o': 'AW-734101562/K16TCMWVmaMBELqAht4C', 
      'event_callback': callback 
    }); 
    return false; 
  } 
</script> --}}

<!-- Facebook Pixel Code -->

<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=412524926006252&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!---- Added for New Campaign on Apply Online Page -->
@if(collect(request()->segments())->last() == 'apply-online')

<!-- Google tag (gtag.js) --> 
{{--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11145588631"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-11145588631'); --}}
</script>


<!-- Event snippet for Page View conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
{{--<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-11145588631/Od39CP_lzpcYEJff0MIp',
      'event_callback': callback
  });
  return false;
}
</script>--}}

{{--<!-- Event snippet for Lead conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-11145588631/0vi4CK_n1pcYEJff0MIp'});
</script>--}}
@endif

{{--<!-- Event snippet for Page View conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-11145588631/Od39CP_lzpcYEJff0MIp'});
</script> --}}

{{-- start Schema code by velocity 28/1/2021 --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList", 
  "itemListElement": [{
    "@type": "ListItem", 
    "position": 1, 
    "name": "India’s second largest refinery in India",
    "item": "https://www.nayaraenergy.com/vadinar-refinery"  
  },{
    "@type": "ListItem", 
    "position": 2, 
    "name": "Nayara Energy Dealership in India",
    "item": "https://www.nayaraenergy.com/retail/petrol-pump-dealership-apply"  
  },{
    "@type": "ListItem", 
    "position": 3, 
    "name": "Petrol pump Nearest to me",
    "item": "https://www.nayaraenergy.com/petrol-pump-near-me"  
  },{
    "@type": "ListItem", 
    "position": 4, 
    "name": "Cotact-us",
    "item": "https://www.nayaraenergy.com/contact-us"  
  },{
    "@type": "ListItem", 
    "position": 5, 
    "name": "Press Release",
    "item": "https://www.nayaraenergy.com/media/press-release"  
  }]
}
</script>
{{-- schema code ends --}}
@endif