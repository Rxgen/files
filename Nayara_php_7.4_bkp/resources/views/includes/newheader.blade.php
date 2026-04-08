@php //headerMenu(); @endphp
<header class="header-content">
    <div class="top_position"></div>
    <div class="header">
        <a class="logo" href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="Nayara Energy" class="logo-img" width="135" height="108" /></a>
        <div class="menu">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <path d="M30 7a1 1 0 0 1-1 1H3a1 1 0 0 1 0-2h26a1 1 0 0 1 1 1zm-5 8H3a1 1 0 0 0 0 2h22a1 1 0 0 0 0-2zm-9 9H3a1 1 0 0 0 0 2h13a1 1 0 0 0 0-2z" data-name="Layer 13" fill="#273e6c" data-original="#000000" opacity="1" class=""></path>
                </g>
            </svg>
        </div>
        <nav class="header-nav">
            <div class="closeMenu"><img src="{{asset('images/cancel.png')}}" alt="Cancel" width="32" height="32"> </div>
            
            <div class="topHead">
                <div class="headLink">
                <a href="javascript:;" class="topLink fuelPrice">Current price</a>
                    <a href="{{url('/petrol-pump-near-me')}}" class="topLink">Retail outlet locator</a>
                    <a href="{{url('retail/petrol-pump-dealership-apply')}}" class="topLink">Apply online</a>
                </div>
                <input type="hidden" id="current-fuel-price" value="{{route('current_fuel_price')}}">
            <div class="fuel_prices_header">
                <div class="fuel_prices_col fuel_diesel_price">
                    Diesel price : <span>&#x20B9;</span> / litre
                </div>
                <div class="fuel_prices_col fuel_petrol_price">
                    Petrol price : <span>&#x20B9;</span> / litre
                </div>
            </div>
                <form action="{{url(route('search_result'))}}"  method="GET"class="header_form">
                    <input type="search" name="search_field" placeholder="Search" class="search_form" id="searchinput">
                    <input type="hidden" id="autosearch_field" value="{{(route('auto_search'))}}" />
                    <button type="submit" class="nav nav_search navSearch"></button>
                </form>
            </div>
            <div class="bottomHead">

                @foreach(headerMenu() as $header_menu_key => $header_menu_value)
                <div class="navLink">
                    @if(empty($header_menu_value['url']))
                    <a href="javascript:void(0)">{{$header_menu_value['title']}}</a>
                    <div class="menuWrapper-j">
                        <ul class="subMenu-j">
                            @foreach($header_menu_value['sub_parent'] as $sub_header_key => $sub_header_value)
                            <li @if(count($sub_header_value['sub_parent'])  > 0) style="display: none !important;" @endif class="menuList @if($loop->index == 0) firstList @endif">
                               <a href="{{ url($sub_header_value['url'])}}" class=
                               "@if($loop->index == 0) tabActive
                                @endif">{{$sub_header_value['title']}}</a>
                              </li>
                            @if(!empty($sub_header_value['sub_parent']))
                            <li class="hasSubmenu-I menuList" >
                                <a href="javascript:;">{{$sub_header_value['title']}}</a>
                                <ul class="subMenu-I">
                                    @foreach($sub_header_value['sub_parent'] as $child_key => $child_value)
                                    <li @if(count($child_value['sub_parent']) > 0) style="display: none !important;" @endif>
                                        @if(!empty($child_value['url']))
                                        <a href="{{ url($child_value['url'])}}">{{$child_value['title']}}</a>
                                        @else
                                        <a href="javascript:;">{{$child_value['title']}}</a>
                                        @endif
                                    </li>
                                    @if(!empty($child_value['sub_parent']))
                                    <li class="hasSubmenu-II">
                                        <a href="{{ url($child_value['url'])}}">{{$child_value['title']}}</a>
                                        <ul class="subMenu-II">
                                            @foreach($child_value['sub_parent'] as $sub_child_key => $sub_child_value)
                                            <li @if(isset($sub_child_value['sub_parent']) && count($sub_child_value['sub_parent']) > 0) style="display:none !important;" @endif>
                                                @if(!empty($sub_child_value['url']))
                                                <a href="{{ url($sub_child_value['url'])}}">{{$sub_child_value['title']}}</a>
                                                @else
                                                <a href="javascript:;">{{$sub_child_value['title']}}</a>
                                                @endif
                                            </li>
                                            @if(!empty($sub_child_value['sub_parent']))
                                            <li class="hasSubmenu-III">
                                               <a href="javascript:;">{{$sub_child_value['title']}}</a>
                                                <ul class="subMenu-III">
                                            @foreach($sub_child_value['sub_parent'] as $last_sub_child_key => $last_sub_child_value)
                                            <li>
                                                @if(!empty($last_sub_child_value['url']))
                                                <a href="{{ url($last_sub_child_value['url'])}}">{{$last_sub_child_value['title']}}</a>
                                                @else
                                                <a href="javascript:;">{{$last_sub_child_value['title']}}</a>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                         <div class="heroWrapper">
                           <div class="nayaraImg">
                           <img src="{{$header_menu_value['image']}}" loading="lazy" alt="Naraya Menu.png" width="377" height="376">
                            </div>
                            <div class="heroContent">
                                <div class="heroTitle">{{$header_menu_value['content']}}</div>
                                <div class="heroPara">{{$header_menu_value['description']}}</div>
                            </div>
                        </div> 
                    </div>
                    @else
                    <a href="{{ url($header_menu_value['url']) }}">{{$header_menu_value['title']}}</a>
                    @endif
                </div>
                @endforeach
            </div>
        </nav>
    </div>
</header>
