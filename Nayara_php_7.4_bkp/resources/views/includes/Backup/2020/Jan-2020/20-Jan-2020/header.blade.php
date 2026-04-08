@php //headerMenu(); @endphp
<header class="header-container">
    <div class="header">
        <a class="logo" href="."><img src="{{asset('images/logo.png')}}" alt="Nayara Energy" class="logo-img" /></a>
        <nav class="header-nav">
			<a href="javascript:;" class="nav nav_search" title="Search Results"></a>
            <a href="javascript:;" class="nav fuel" title="Current Price"></a>
            <a href="{{url('/contact-us')}}" class="nav contact" title="Contact Us"></a>
            <a href="{{url('/retail-outlet-locator')}}" class="nav location" title="Locate A Pump"></a>
            <a href="{{url('retail/apply-online')}}" class="nav apply" title="Apply Online"></a>
            <a href="javascript:;" class="nav menu">
                <span class="nav-line"></span>
                <span class="nav-line"></span>
                <span class="nav-line"></span>
            </a>
            <input type="hidden" id="current-fuel-price" value="{{route('current_fuel_price')}}">
            <div class="fuel_prices_header">
                <div class="fuel_prices_col fuel_diesel_price">
                    Diesel price : <span>&#x20B9;</span> / litre
                </div>
                <div class="fuel_prices_col fuel_petrol_price">
                    Petrol price : <span>&#x20B9;</span> / litre
                </div>
            </div>
			 <form class="nav_searchBlk" action="{{url(route('search_result'))}}">
                <script async src="https://cse.google.com/cse.js?cx=015322309963132319884:9xyb8zp48cc"></script>
				<div class="gcse-searchbox-only"></div>
                <!-- <script async src="https://cse.google.com/cse.js?cx=006668303133136004969:8izn1zhsqqw"></script>
                <div class="gcse-searchbox-only"></div> -->
                {{-- <div class="mic status_img">
                    
                    <?xml version="1.0" encoding="utf-8"?>
                    <!-- Generator: Adobe Illustrator 22.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 197 240" style="enable-background:new 0 0 197 240;" xml:space="preserve">
                        <g>
                            <path d="M138.9,88c0,13.2,0,26.3,0,39.5c0,18.4-13.3,39.4-40,39.4c-26.5,0-40-21.1-39.9-39.5c0.1-26.8,0-53.6,0-80.4
                                C59.1,25.8,77.7,7.5,99,7.7c21.5,0.1,39.8,18.1,39.9,39.4C139,60.7,138.9,74.3,138.9,88z M123.1,87.5c0-13.1,0.2-26.3-0.1-39.4
                                c-0.1-3.7-1-7.7-2.5-11.1c-4.4-10-15.6-15.3-26.5-13.1c-10.9,2.2-18.9,11.8-19,23.2c-0.1,26.5-0.1,52.9,0,79.4
                                c0,14.2,10.2,24.7,23.8,24.8c13.8,0.1,24.2-10.6,24.3-25C123.1,113.5,123.1,100.5,123.1,87.5z"/>
                            <path d="M107.2,199.2c0,5.5,0,10.6,0,16.3c5.9,0,11.5,0,17.1,0c2.2,0,4.3-0.1,6.5,0.1c5,0.4,8,3.4,8.1,7.8c0.1,4.6-3.1,7.9-8.3,8
                                c-10,0.2-20,0.1-30,0.1c-10.7,0-21.3,0.1-32-0.1c-2.2,0-5.3-0.4-6.4-1.8c-1.7-2.2-3.5-6-2.7-8.2c0.9-2.5,4.4-5.2,7.1-5.6
                                c6-0.8,12.3-0.3,18.5-0.3c1.8,0,3.6,0,5.6,0c0-5.7,0-10.8,0-16c-5.3-1.4-10.6-2.5-15.7-4.3c-28.9-10.2-47.8-36.9-48-67.5
                                c0-7.7,0-15.3,0-23c0-5.5,3.1-9.1,7.7-9.2c4.8-0.1,7.9,3.6,8.2,9.3c0.6,12.4-0.2,25.2,2.3,37.2c5.3,25.6,29.8,42.6,56.8,41.3
                                c26.4-1.3,48.6-20.8,52-46.7c1.4-10.8,0.8-21.9,1.1-32.9c0.1-4.2,2.2-7,6.2-7.9c3.9-1,6.8,0.7,8.7,4.2c0.5,0.8,0.9,1.9,0.8,2.8
                                c-0.6,13.6,0.4,27.5-2.1,40.7c-5.3,28.4-28.3,49.5-56.8,54.7C110.4,198.4,109,198.8,107.2,199.2z"/>
                        </g>
                    </svg> 
                </div> --}}
                <input name="input_field" type="hidden" id="input_field" />
                <input name="result" id="result" value="" type="hidden" />
            </form>
        </nav>
    </div>
    <div class="menu-wrapper">
        <ul class="menu-nav main-menu-nav">
            @if(count(headerMenu()) > 0)
            @foreach(headerMenu() as $header_menu_key => $header_menu_value)
            @if(count($header_menu_value['sub_parent']) > 0)
            <li class="menu-nav__item has-submenu">
                <a href="javascript:;" class="menu-nav__item_link">{{$header_menu_value['title']}}</a>
                @if(array_key_exists('sub_parent',$header_menu_value))
                @if(count($header_menu_value['sub_parent']) > 0)
                <ul class="menu-nav">
                    <li class="menu-nav__item heading">
                        @if(!empty($header_menu_value['url']))
                        <a href="{{ url($header_menu_value['url']) }}" class="menu-nav__item_link">{{$header_menu_value['title']}}</a>
                        @else
                        <a href="javascript:;" class="menu-nav__item_link">{{$header_menu_value['title']}}</a>
                        @endif
                    </li>
                    @foreach($header_menu_value['sub_parent'] as $sub_header_key => $sub_header_value)
                    @if(array_key_exists('sub_parent',$sub_header_value))
                    @if(count($sub_header_value['sub_parent']) > 0)
                    <li class="menu-nav__item has-submenu">
                        <a href="javascript:;" class="menu-nav__item_link">{{$sub_header_value['title']}}</a>
                        @if(array_key_exists('sub_parent',$sub_header_value))
                        <ul class="menu-nav">
                            <li class="menu-nav__item heading">
                                @if(!empty($sub_header_value['url']))
                                <a href="{{ url($sub_header_value['url']) }}" class="menu-nav__item_link">{{$sub_header_value['title']}}</a>
                                @else
                                <a href="javascript:;" class="menu-nav__item_link">{{$sub_header_value['title']}}</a>
                                @endif
                            </li>
                            @foreach($sub_header_value['sub_parent'] as $child_key => $child_value)
                            @if(count($child_value['sub_parent']) > 0)
                            <li class="menu-nav__item has-submenu">
                                <a href="javascript:;" class="menu-nav__item_link">{{$child_value['title']}}</a>
                                {{-- @if(count($child_value['sub_parent']) > 0) --}}
                                <ul class="menu-nav">
                                    <li class="menu-nav__item heading">
                                        @if(!empty($child_value['url']))
                                        <a href="{{ url($child_value['url']) }}" class="menu-nav__item_link">{{$child_value['title']}}</a>
                                        @else
                                        <a href="javascript:;" class="menu-nav__item_link">{{$child_value['title']}}</a>
                                        @endif
                                    </li>
                                    @foreach($child_value['sub_parent'] as $sub_child_key => $sub_child_value)
                                    <li class="menu-nav__item">
                                        @if(!empty($sub_child_value['url']))
                                        <a href="{{ url($sub_child_value['url']) }}" class="menu-nav__item_link">{{$sub_child_value['title']}}</a>
                                        @else
                                        <a href="javascript:;" class="menu-nav__item_link">{{$sub_child_value['title']}}</a>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                {{-- @endif --}}
                            </li>
                            @else
                            <li class="menu-nav__item">
                                <a href="{{url($child_value['url'])}}" class="menu-nav__item_link">{{$child_value['title']}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        {{-- @endif --}}
                        @endif
                    </li>
                    @else
                    <li class="menu-nav__item">
                        <a href="{{url($sub_header_value['url'])}}" class="menu-nav__item_link">{{$sub_header_value['title']}}</a>
                    </li>
                    @endif
                    @endif
                    @endforeach
                    {{-- @endif --}}
                </ul>
                @endif
                @endif
            </li>
            @else
            <li class="menu-nav__item">
                <a href="{{url($header_menu_value['url'])}}" class="menu-nav__item_link">{{$header_menu_value['title']}}</a>
            </li>
            @endif
            @endforeach
            @endif
            <li class="header-social-nav">
                <a target="_blank" href="{{setting('site.facebook_social_media_icon_mp')}}" title="Facebook" class="fa fa-facebook"></a>
                <a target="_blank" href="{{setting('site.twitter_social_media_icon_mp')}}" title="Twitter" class="fa fa-twitter"></a>
                <a target="_blank" href="{{setting('site.youtube_social_media_icon_mp')}}" title="YouTube" class="fa fa-youtube"></a>
                <a target="_blank" href="{{setting('site.linkedin_social_media_icon_mp')}}" title="Instagram" class="fa fa-linkedin"></a>
                <a target="_blank" href="{{setting('site.instagram_social_media_icon_mp')}}" title="Instagram" class="fa fa-instagram" rel="noopener noreferrer"></a>
            </li>
        </ul>
        <div class="header-social-nav mobile">
            <a target="_blank" href="{{setting('site.facebook_social_media_icon_mp')}}" title="Facebook" class="fa fa-facebook"></a>
            <a target="_blank" href="{{setting('site.twitter_social_media_icon_mp')}}" title="Twitter" class="fa fa-twitter"></a>
            <a target="_blank" href="{{setting('site.youtube_social_media_icon_mp')}}" title="YouTube" class="fa fa-youtube"></a>
            <a target="_blank" href="{{setting('site.linkedin_social_media_icon_mp')}}" title="Linkedin" class="fa fa-linkedin"></a>
            <a target="_blank" href="{{setting('site.instagram_social_media_icon_mp')}}" title="Instagram" class="fa fa-instagram" rel="noopener noreferrer"></a>
        </div>
    </div>
</header>