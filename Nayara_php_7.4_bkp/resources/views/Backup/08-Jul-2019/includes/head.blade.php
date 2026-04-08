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

<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
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
<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142048367-1"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

 

  gtag('config', 'UA-142048367-1');
  gtag('config', 'AW-734101562');

</script>
<!-- Event snippet for Nayara-Google Remarketing Tag conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> 
<script> 
	function gtag_report_conversion(url) { 
		var callback = function () { 
		if (typeof(url) != 'undefined') { 
			window.location = url; } 
		}; 
		gtag('event', 'conversion', { 
			'send_to': 'AW-734101562/K16TCMWVmaMBELqAht4C', 
			'event_callback': callback 
		}); 
		return false; 
	} 
</script>

<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '412524926006252');
	fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=412524926006252&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endif