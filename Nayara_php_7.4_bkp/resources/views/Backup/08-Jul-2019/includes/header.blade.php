@php //headerMenu(); @endphp
<header class="header-container">
    <div class="header">
        <a class="logo" href="."><img src="{{asset('images/logo.png')}}" alt="Nayara Energy" class="logo-img" /></a>
        <nav class="header-nav">
            <a href="javascript:;" class="nav fuel" title="current Price"></a>
            <a href="{{url('/contact-us')}}" class="nav contact" title="Contact Us"></a>
            <a href="{{url('/retail-outlet-locator')}}" class="nav location" title="Loacte A Pump"></a>
            <a href="{{url('retail/apply-online')}}" class="nav apply" title="Apply Online"></a>
            <a href="javascript:;" class="nav menu">
                <span class="nav-line"></span>
                <span class="nav-line"></span>
                <span class="nav-line"></span>
            </a>
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