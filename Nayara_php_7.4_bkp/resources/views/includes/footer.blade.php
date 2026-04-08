<footer class="footerContainer">
    <div class="footerSocialIconsContainer">
        <a href="{{setting('site.facebook_social_media_icon_mp')}}" class="socialIconBox" target="_blank">
            <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="{{setting('site.linkedin_social_media_icon_mp')}}" class="socialIconBox" target="_blank">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
        </a>
        <a href="{{setting('site.youtube_social_media_icon_mp')}}" class="socialIconBox" target="_blank">
            <i class="fa fa-youtube-play" aria-hidden="true"></i>
        </a>
        <a href="{{setting('site.twitter_social_media_icon_mp')}}" class="socialIconBox" target="_blank">
        <img src="{{asset('images/X-logo.webp')}}" alt="Nayara Energy" width="32" height="32" style="width:12px;" />     
        </a>
         <a href="{{setting('site.instagram_social_media_icon_mp')}}" target="_blank" class="socialIconBox" rel="noopener noreferrer">
            <i class="fa fa-instagram" aria-hidden="true"></i>
        </a> 
        <!-- <a href="{{setting('site.gmail_icon')}}" target="_blank" class="socialIconBox" rel="noopener noreferrer">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </a>  -->
        <!-- <div style="display: flex; justify-content: center;">
    <div class="email-right-block email-detailBlock-content">For media queries, write to<a href="mailto:brand.communications@nayaraenergy.com">brand.communications@nayaraenergy.com</a></div>
        </div>
        </div> -->
    </div>
    
    <div class="footerPageLinkContainer">
        <div class="addressLink">
        <address>
            <div>Nayara Energy Limited </div>
            <div>Corporate Office</div>
            <p class="address"><span>Corporate Office address</span>: 5th Floor, Jet Airways Godrej BKC, Plot No. C-68 G Block,Bandra Kurla Complex, Bandra East, Mumbai - 400 051,<br>Maharashtra,
            India </br></p>
            <div class="telephone">    
            </div>
            <span>Telephone: <a href="tel:+02266121800">02266121800</a></span>
        </address>

        <address>
            <div>Registered Office and Refinery</div>
            <p class="address"><span>Registered Office address</span>: Khambhalia Post, P O Box 24, District Devbhumi Dwarka - 361 305, Gujarat, India</p>
            <p class="cin-no">CIN : U11100GJ1989PLC032116</p>
            <div class="telephone">
                <span>Tel No. <a href="tel:+02833661444">02833 661 444</a></span><br><span>Fax No. <a href="tel:+02833662929">02833 662929</a></span>
            </div>
            <span>Email: <a href="mailto:customer.care@nayaraenergy.com">customer.care@nayaraenergy.com</a></span>
        </address>
</div>
        @if(count(footerMenu()) > 0)
        @foreach(footerMenu() as $footer_menu)
        <div class="pageLinkContainer">
            <a href="{{!empty($footer_menu['url']) ? url($footer_menu['url']) : 'javascript:;'}}" class="pageLinkSectionHeading">{{$footer_menu['title']}}</a>
            <ul class="pageLinks">
                @if(array_key_exists('sub_parent', $footer_menu))
                @if(count($footer_menu['sub_parent']) > 0)
                @foreach($footer_menu['sub_parent'] as $sub_parent_menu)
                <li><a href="{{!empty($sub_parent_menu->url) ? url($sub_parent_menu->url) : 'javascript:;'}}" rel="noopener noreferrer">{{$sub_parent_menu->title}}</a></li>
                {{-- <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Board &amp Seniors</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">HSEQ Policy</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Operations</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Bulk Business</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Zero Tolerance Against Corruption &amp; Fraud --}}</a></li>
                @endforeach
                @endif
                @endif
            </ul>
        </div>
        @endforeach
        @endif
    </div>
    <div class="footerPageBtm">&copy; All rights reserved</div>
</footer>
<div class="up_down_arrow"></div>
<div class="mobile__landscape">
    Site best viewed in the portrait mode
</div>

<div class="addToHomeScreen" id="addToHomeScreen">
    <div class="adhs_close" id="adhs_close">&times;</div>
    <div class="adhs_blk">
        <div class="adhs_content_blk">
            <div class="adhs_ttl">Nayara Energy</div>
            <div class="adhs_text">Click to instantly access nayara</div>
        </div>
        <div class="adhs_button_blk">
            <button class="adhs_button" id="adhs_button">Add to Home Screen</button>
        </div>
    </div>
</div>

@php  $currentroute = Route::currentRouteName() @endphp

@if($currentroute === 'home.homepage')

<!-- <div class="popUp2" id="notice_modal">
        <img src="{{ URL::to('/') }}/images/popup.png" alt="" class="pop-img">
        <img src="{{URL::to('/') }}/images/close.png" alt="" class="close-img" id="close">
        <a href="https://www.nayaraenergy.com/investors/information" target="_blank" >
        <div class="popUp2__content">
            <img src="{{URL::to('/') }}/images/buyback_popup.jpg" alt="" class="fleet-alert-img">
        </div>
        </a>
    </div>  -->

   
@endif
@if (collect(request()->segments())->last() === 'retail-outlet-locator')
<!-- <script type="text/javascript" src="{{asset('js/map.js')}}"></script>
 --><!-- <script type="text/javascript" src="{{asset('js/map.js')}}"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOSVMcXnqT4201iOaZe_TtxdkmTR-FoFY&libraries=places&callback=initMap"
    async defer></script> -->
@endif

<!-- show notice modal on retail pages -->
<!-- Hide Popup on every page below code is commetnted  -->

 @if ( (Request::segment(1) == 'retail') || (collect(request()->segments())->last() === ('retail-footprint')) || (collect(request()->segments())->last() === ('franchisees-eligibility')) || (Request::segment(1)=== ('career-opening'))  )

    @if(collect(request()->segments())->last() === ('sustainable-development'))
        @php $img_link = 'https://www.nayaraenergy.com/storage/retail/CSR.png'; @endphp
    @elseif(Request::segment(1) === ('career-opening'))
        @php $img_link = 'https://www.nayaraenergy.com/storage/retail/Career_1.png'; @endphp
{{--     @elseif((collect(request()->segments())->last() === 'retail-footprint') || (Request::segment(1) === 'retail'))
        @php $img_link = 'https://www.nayaraenergy.com/storage/retail/retail-popup-3.jpg'; @endphp --}} 
    @else
        @php $img_link = 'https://www.nayaraenergy.com/storage/retail/retail-popup.jpg'; @endphp
    @endif
    
     <div class="popUp2" id="notice_modal">
        <img src="{{ URL::to('/') }}/images/popup.png" alt="Popup" class="pop-img">
        <img src="{{URL::to('/') }}/images/close.png" alt="Close" class="close-img" id="close">
        <div class="popUp2__content">
            <img src="{{URL::to('/') }}/images/pop_up_alert2.jpg" alt="" class="fleet-alert-img">
        </div> 
        
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endif 

@include('includes.footer-script')


