<!-- Hotjar Tracking Code for my site -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3422175,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!---End of Hotjar Tracking Code for my site ---->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-54Q6TP5');</script>
<!-- End Google Tag Manager -->

{!! setting('site.global_tracking_code') !!}
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
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6EDN8NZ3RQ');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<meta name="google-site-verification" content="pa7BLq3l8N5oTcJFFixxvjIkkrw4WdIHL4EdzaXa_u0" />
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142048367-1"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

 

  gtag('config', 'UA-142048367-1');
 
</script>

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
  <!-- Event snippet for Franchise Campaign - 2024 conversion page -->


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
<script>
  gtag('event', 'conversion', {'send_to': 'AW-734101562/e7VoCOX2-dMBELqAht4C'});
</script>
@endif

@if(collect(request()->segments())->last() == 'apply-online-for-dealership')
{!! setting('site.apply_online_for_dealership_tracking_code') !!}
@endif
@if(Route::currentRouteName() == 'dealership.thankyou')
{!! setting('site.dealership_thank_you_page_tracking_code') !!}
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


@endif