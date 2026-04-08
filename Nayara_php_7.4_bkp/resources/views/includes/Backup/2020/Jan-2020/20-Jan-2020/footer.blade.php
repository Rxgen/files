<footer class="footerContainer">
    <div class="footerSocialIconsContainer">
        <a href="{{setting('site.facebook_social_media_icon_mp')}}" class="socialIconBox">
            <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="{{setting('site.linkedin_social_media_icon_mp')}}" class="socialIconBox">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
        </a>
        <a href="{{setting('site.youtube_social_media_icon_mp')}}" class="socialIconBox">
            <i class="fa fa-youtube-play" aria-hidden="true"></i>
        </a>
        <a href="{{setting('site.twitter_social_media_icon_mp')}}" class="socialIconBox">
            <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <!-- <a href="{{setting('site.instagram_social_media_icon_mp')}}" target="_blank" class="socialIconBox" rel="noopener noreferrer">
            <i class="fa fa-instagram" aria-hidden="true"></i>
        </a> -->
    </div>
    <div class="footerPageLinkContainer">
        @if(count(footerMenu()) > 0)
        @foreach(footerMenu() as $footer_menu)
        <div class="pageLinkContainer">
            <a href="{{!empty($footer_menu['url']) ? url($footer_menu['url']) : 'javascript:;'}}" class="pageLinkSectionHeading">{{$footer_menu['title']}}</a>
            <ul class="pageLinks">
                @if(array_key_exists('sub_parent', $footer_menu))
                @if(count($footer_menu['sub_parent']) > 0)
                @foreach($footer_menu['sub_parent'] as $sub_parent_menu)
                <li><a href="{{!empty($sub_parent_menu->url) ? url($sub_parent_menu->url) : 'javascript:;'}}" rel="noopener noreferrer">{{$sub_parent_menu->title}}</a></li>
                <!-- <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Board &amp Seniors</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">HSEQ Policy</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Operations</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Bulk Business</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Zero Tolerance Against Corruption &amp; Fraud --></a></li>
                @endforeach
                @endif
                @endif
            </ul>
        </div>
        @endforeach
        @endif
        <!-- <div class="pageLinkContainer">
            <div class="pageLinkSectionHeading">Sustainability</div>
            <ul class="pageLinks">
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">CSR Policy</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Photo Gallery</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Impact Stories</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Report</a></li>
            </ul>
        </div>
        <div class="pageLinkContainer">
            <div class="pageLinkSectionHeading">For Businesses</div>
            <ul class="pageLinks">
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Franchise Networks</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Fleet Owners</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Bulk Business</a></li>
            </ul>
        </div>
        <div class="pageLinkContainer">
            <div class="pageLinkSectionHeading">Investors</div>
            <ul class="pageLinks">
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Annual Reports</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Corporate Governance</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Notices</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Investor Contacts</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Presentation</a></li>
            </ul>
        </div>
        <div class="pageLinkContainer">
            <div class="pageLinkSectionHeading">Tenders</div>
        </div>
        <div class="pageLinkContainer">
            <div class="pageLinkSectionHeading">Media</div>
            <ul class="pageLinks">
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Press Release</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Media Kit</a></li>
                <li><a href="javascript:;" target="_blank" rel="noopener noreferrer">Media Coverage</a></li>
            </ul>
        </div>
        <div class="pageLinkContainer">
            <div class="pageLinkSectionHeading">Downloads</div>
            <a href="javascript:;" target="_blank" rel="noopener noreferrer" class="pageLinkSectionHeading">news</a>
            <a href="javascript:;" target="_blank" rel="noopener noreferrer" class="pageLinkSectionHeading">careers</a>
            <a href="javascript:;" target="_blank" rel="noopener noreferrer" class="pageLinkSectionHeading">faqs</a>
            <a href="javascript:;" target="_blank" rel="noopener noreferrer" class="pageLinkSectionHeading">terms &amp; condition</a>
        </div> -->
    </div>
    <div class="footerPageBtm">&copy; All rights reserved</div>
</footer>
<div class="up_down_arrow"></div>
<div class="mobile__landscape">
    Site best viewed in the portrait mode
</div>
<script>
 if(navigator.serviceWorker){
    navigator.serviceWorker.register("service-worker.js")
        .then( function(reg){
            console.log('Service worker registration', reg);
        })
        .catch( function(err){
            console.error('Service Worker Error', err);
        });

    window.addEventListener('beforeinstallprompt', function (event) {
        var e = event,
            aths = document.getElementById('addToHomeScreen');

        e.preventDefault();

        // show the Add to homescreen section
        aths.className += ' active';

        // add event listener to add to homescreen button
        document.getElementById('adhs_button').onclick = function(){
            e.prompt().then(function (result) {
                if ( result.outcome === 'accepted' ) {
                    aths.className = aths.className.replace(/\s*active\s*/, ' ');
                }
            });
        };

        document.getElementById('adhs_close').onclick = function () {
            aths.className = aths.className.replace(/\s*active\s*/, ' ');
        };
    });
 }
</script>

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
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!}
</script>
<script>
!function () {
    var baseName = '@php  echo Route::currentRouteName() @endphp',
        lastUrlParameter = '@php echo collect(request()->segments())->last() @endphp',
        assets = '',
        libs = [assets + 'js/jquery.min.js', assets + 'js/slick.min.js'],
        scripts = [assets + 'js/common.js', assets + 'js/fuel-price.js'],
        loadScript = function (i) {
            var script = scripts[i];

            if (script) {
                script = document.createElement('script');
                script.async = true;
                script.src = scripts[i];
                document.head.appendChild(script);

                script.onload = function (e) {
                    script = undefined;
                    loadScript(i+1);
                };

                script.onerror = function (e) {
                    console.error('No more scripts will be loaded because "' + script.src + '" failed to load!');
                };
            } else {
                loadScript = script_file = scripts = undefined;
            }
        };

    window.videoPath = assets + 'videos/';
    //console.log(lastUrlParameter);
    // insert any dependencies (if required) here according to each page and then load scripts
    if ( baseName === 'home.homepage') {
        scripts.push(assets + 'js/home-banner.js', assets + 'js/front.js', assets + 'js/newsletter.js');
    } else {
        scripts.push(assets + 'js/inner.js');

        switch (baseName) {
            case 'static.contact':
            switch (lastUrlParameter) {
                case 'retail-outlet-locator':
                scripts.push(assets + 'js/map.js','https://maps.googleapis.com/maps/api/js?key=AIzaSyCOSVMcXnqT4201iOaZe_TtxdkmTR-FoFY&libraries=places&callback=initMap');  
            }
            break;
            case 'static.retail':
            scripts.push(assets + 'js/apply-online.js');            
            break;
            case 'investors.content':
            scripts.push(assets + 'js/investor.js');            
            break;
            case 'media.content':
            switch (lastUrlParameter) {
                case 'kits-and-resources':
                libs.push(assets + 'js/flipster.min.js');  
            }            
            break;
            case 'career':
            scripts.push(assets + 'js/career.js');            
            break;
            case 'perspective':
            scripts.push(assets + 'js/perspective.js');            
            break;
            case 'divisional_office':
            scripts.push(assets + 'js/contact.js');            
            break;
			case 'search_result':
            scripts.push(assets + 'js/search.js');            
            break;
        }
    }

    // concat all scripts
    scripts = libs.concat(scripts);

    // start loading scripts
    loadScript(0);
}();
</script>
@if (collect(request()->segments())->last() === 'retail-outlet-locator')
<!-- <script type="text/javascript" src="{{asset('js/map.js')}}"></script>
 --><!-- <script type="text/javascript" src="{{asset('js/map.js')}}"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOSVMcXnqT4201iOaZe_TtxdkmTR-FoFY&libraries=places&callback=initMap"
    async defer></script> -->
@endif

<!-- AIzaSyBfPpB6dMsWTxWG92zQ5Yhw_PldwUrWjbI -->