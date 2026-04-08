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
        aths.className += ' active';
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

<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!}
</script>
<script>
!function () {
    var baseName = '@php  echo Route::currentRouteName() @endphp',
        lastUrlParameter = '@php echo collect(request()->segments())->last() @endphp',
        assets = '',
        libs = ['https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js' ,  assets + 'js/slick.min.js' ],
        scripts = [assets + '/build/js/common.js', assets + 'build/js/fuel-price.js'],
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
    if ( baseName === 'home.homepage') {
        var loadHomebannerjs = '{{ isset($top_banners) ? $top_banners->isEmpty() : '' }}';
        if(loadHomebannerjs) {
            scripts.push(assets + 'js/home-banner.js');
        }
    } else {
        scripts.push(assets + 'js/inner.js');

        switch (baseName) {
			case 'media.content':
            switch (lastUrlParameter) {
                case 'in-the-news':
                scripts.push(assets + 'js/in-the-news.js');
                break;
                case 'press-release':
                scripts.push(assets + 'js/in-the-news.js');
                break;  
                case 'gallery':
                scripts.push(assets + 'js/gallery.js');
                break;
            }
            case 'static.contact':
            switch (lastUrlParameter) {
				case 'awards':
                scripts.push(assets + 'js/in-the-news.js');
                break;
                case 'about-us':
                case 'ethos':
                case ' tainable-development':
                case 'career':
                scripts.push(assets + 'js/yt.js');
                break;
                case 'apply-online-lp':
                scripts.push(assets + 'js/apply-online-campaign.js');
                break;
                case 'exhibition-enquiry':
                scripts.push(assets + 'js/enquiry-lead.js');
                break;
                                
                case 'petrol-pump-near-me':
                scripts.push(assets + 'js/map.js');  
            }
            break;
            case 'static.retail':
            @if (collect(request()->segments())->last() === 'petrol-pump-dealership-apply')
            scripts.push(assets + '/build/js/apply-online.js');
            @elseif(collect(request()->segments())->last() === 'apply-online-for-dealership')
            scripts.push(assets + 'js/apply-online-for-dealership.js');
            @endif
            break;
            case 'investors.content': 
            scripts.push(assets + 'js/investor.js'); 
            scripts.push(assets + 'js/iepf.js');            
            break;
            case 'media.content':
            switch (lastUrlParameter) {
                case 'kits-and-resources':
                libs.push(assets + 'js/flipster.min.js');  
            }            
            break;
            case 'career':
            scripts.push(assets + 'js/career.js', assets + 'js/yt.js'); 
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
            case 'sustainability.content':
            scripts.push(assets + 'js/bio-medical.js');
            break;
            case 'static.petrochemicals':
            @if (collect(request()->segments())->last() === 'contact-us')
            scripts.push(assets + 'js/petrochemicals-contact-us.js');
            @endif
            break;
            case 'event.contact':
            scripts.push(assets + 'js/swiper.js');
            break;

        }
    }
    scripts = libs.concat(scripts);
    loadScript(0);
}();
</script>