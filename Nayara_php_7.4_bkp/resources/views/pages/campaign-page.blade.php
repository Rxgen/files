<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nayara | Business Opportunity</title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
    <!-- Global site tag (gtag.js) - Google Ads: 734101562 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-734101562"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

    
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
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142048367-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-142048367-1');
	</script>	
</head>
<body class="lp">
    <header class="header-container">
        <div class="header">
            <a class="logo" href="."><img src="{{ asset('images/logo.png')}}" alt="Nayara Energy" class="logo-img" /></a>
        </div>
    </header>
    <main class="lp-content <?php echo isset($_GET['thankyou']) ? 'thankyou' : ''; ?>">
        <figure class="lp-banner">
            <picture>
                <source srcset="https://www.nayaraenergy.com/storage/campaign/business-opportunity-banner-mobile_1.jpg" media="(max-width: 767px)" />
                <img loading="lazy" src="https://www.nayaraenergy.com/storage/campaign/business-opportunity-banner.jpg" alt="Business Opportunity" />
            </picture>
        </figure>
        <section class="section-intro">
            <div class="section-form">
                <h5 class="form-heading"><?php echo isset($_GET['thankyou']) ? 'Thank you' : 'Apply now'; ?></h5>
                <?php if (isset($_GET['thankyou'])): ?>
                <div class="intro-form">Thank you for getting in touch with us. Our representatives will get back to you shortly!</div>
                <?php else: ?>
                <form class="intro-form" method="post">
                    <input value="{{route('populate_states')}}" type="hidden" class="states_url" />
                    <input value="{{route('camp.thankyou')}}" type="hidden" class="camp-thanku-redirect" />
                    <input value="{{route('populate_district')}}" type="hidden" class="district_url" />
                    <input value="{{route('camp_form_url')}}" type="hidden" class="camp_form_submit" />
                    <input type="hidden" value="@php echo isset($_GET['utm_source']) ? $_GET['utm_source'] : ''; @endphp" id="utm-source">
                    <input type="hidden" value="@php echo isset($_GET['utm_medium']) ? $_GET['utm_medium'] : ''; @endphp" id="utm-medium">
                    <input type="hidden" value="@php echo isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : ''; @endphp" id="utm-campaign">
                    <label class="intro-form--label">
                        <input type="text" name="name" id="name" required pattern="^[^\s][a-zA-Z\s]+[^\s]$" class="intro-form--ip" placeholder="Name" />
                        <span class="error-text">*Please enter a valid name</span>
                    </label>
                    <label class="intro-form--label">
                        <input type="tel" name="mobile" id="mobile" required pattern="^\d{10}$" class="intro-form--ip" placeholder="Mobile" />
                        <span class="error-text">*Please enter a mobile number</span>
                    </label>
                    <label class="intro-form--label">
                        <input type="email" name="email" id="email" required class="intro-form--ip" placeholder="Email Id" />
                        <span class="error-text">*Please enter a valid email id</span>
                    </label>
                    <label class="intro-form--label">
                        {{-- <input type="text" name="how-did-you-find" required id="source" class="intro-form--ip" placeholder="How did you find us?" /> --}}
                        <select id="source" name="how-did-you-find" required class="intro-form--ip select">
                            <option selected="selected" value="blank">How did you find us?*</option>
                            <option value="Newspaper Ad">Newspaper Ad</option>
                            <option value="Employee referral">Employee referral</option>
                            <option value="Online">Online</option>
                            <option value="Social Media">Social Media</option>
                            <option value="Others">Others</option>
                        </select>
                        <span class="error-text">*Please let us know how you found us?</span>
                    </label>
                    <label class="intro-form--label">
                        <select name="state" id="state" class="intro-form--ip select add-states">
                            <option value="">Loading States</option>
                        </select>
                        <span class="error-text">*Please select a state</span>
                    </label>
                    <label class="intro-form--label error">
                        <select name="district" id="district" class="intro-form--ip select add-district">
                            <option value="">Select District</option>
                        </select>

                        <span class="error-text">*Please select a district</span>
                    </label>
                    <label class="intro-form--label has-label">
                        <span id="create_captcha" class="intro-form--ip intro-form--label-text">{{ $num1 }} + {{ $num2 }}</span>
                        <input type="text" name="captcha" required id="captcha" class="intro-form--ip" placeholder="Enter answer" />
                        <span class="error-text">*Please enter a valid captcha</span>
                    </label>

                    <button class="intro-form--submit" name="submit" id="submit">Submit</button>
                </form>
                <?php endif; ?>
            </div>

            <div class="section-intro-text">
                <h2 class="section-intro-title">Who we are</h2>
                <p class="section-intro-p">Essar Petrol Pumps, part of Nayara Energy, is India’s fastest growing fuel retail network. With a network of over 5800 fuel stations pan India and over 2,600 fuel stations in various stages of commissioning, we endeavour to reach the length and breadth of the country covering national and state highways as well as rural areas. <br />Nayara Energy is a new-age downstream company of international scale with robust foundation of best-in-class infrastructure. It owns India’s second-largest single-site, state-of-the-art refinery and one of the most modern and complex refineries in the country having businesses across the hydrocarbon value chain, from refining to retail and is geared up to drive the vision of delivering crude to chemicals.</p>
            </div>
        </section>

        <section class="generic-section">
            <div class="generic-section--text">
                <h5 class="generic-section--heading">Your new business opportunity</h5>
                <p class="generic-section--content">We are excited to expand in cities like Himachal Pradesh, Assam, Uttarakhand and Meghalaya. We have an extremely transparent, seamless and quick enrolment and commissioning process. Unlike other fuel manufacturing companies, we do not have a tender-led selection process. If your land meets our requirements, we issue a Letter of Appointment (LOA) in your name within a month. You can then proceed with other formalities and clearances required for commissioning the retail outlet.</p>
            </div>
            <div class="generic-section--text">
                <h5 class="generic-section--heading">What you need</h5>
                <div class="generic-section--content">
                    <ul class="generic-section--list">
                        <li>A clear title of a land. Ideally in the name of the franchisee</li>
                        <li>Land of 500 sq. mts. or more</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="generic-section patch">
            <div class="generic-section--text">
                <h5 class="generic-section--heading">Fraud alert</h5>
                <p class="generic-section--content">This is to notify the general public that some unscrupulous elements posing themselves as employees/representatives agents of Nayara Energy Limited or Essar Petrol Pumps, with an ulterior motive to earn wrongful gains and or cheat the general public are fraudulently misrepresenting/promising/offering franchisee of Nayara Energy for setting up retail outlets/petrol pump.<br />Nayara Energy shall not be liable for any conclusion, loss or damage of any nature whatsoever suffered or may be suffered by any part of members of the public arising from or as a result of usage of any information or portal, website, social channels or email domains which are not authorized by Nayara Energy.<br />General public are requested to be cautious about such fraudulent and unauthorized solicitations and websites by fraudsters.</p>

                <p class="generic-section--content note">To verify or seek clarification, write to: <a href="mailto:Customer.care@nayaraenergy.com">Customer.care@nayaraenergy.com</a> <br />For any Franchisee related query, write to <a href="mailto:Franchisee.support@nayaraenergy.com">Franchisee.support@nayaraenergy.com</a></p>
            </div>
        </section>
    </main>
    <footer class="footerContainer">
        <div class="footerSocialIconsContainer">
            <a href="https://www.facebook.com/NayaraEnergy/" target="_blank" class="socialIconBox" rel="noopener noreferrer">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="https://www.linkedin.com/company/nayaraenergy/" target="_blank" class="socialIconBox" rel="noopener noreferrer">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="https://www.youtube.com/NayaraEnergy/" target="_blank" class="socialIconBox" rel="noopener noreferrer">
                <i class="fa fa-youtube-play" aria-hidden="true"></i>
            </a>
            <a href="https://www.twitter.com/NayaraEnergy/" target="_blank" class="socialIconBox" rel="noopener noreferrer">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="https://www.instagram.com/nayaraenergyofficial/" target="_blank" class="socialIconBox" rel="noopener noreferrer">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
    </footer>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/business-opportunity.js') }}" defer></script>
    <style>
    .modal {
        opacity: 0;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        -webkit-overflow-scrolling: touch;
        outline: 0;
        width: 100%;
        height: auto;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        overflow-y: scroll;
        -webkit-transition: all 0.15s linear;
        -o-transition: all 0.15s linear;
        transition: all 0.15s linear;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /*padding: 20px;*/
        border: 1px solid #888;
        /*width: 80%; */
        width: fit-content;
        height: inherit;
        margin-top: 2%;
    }

    .modal.fade .modal-content {
        -webkit-transform: translate(0, -10%);
        -ms-transform: translate(0, -10%);
        -o-transform: translate(0, -10%);
        transform: translate(0, -10%);
        -webkit-transition: -webkit-transform 0.3s ease-out;
        -moz-transition: -moz-transform 0.3s ease-out;
        -o-transition: -o-transform 0.3s ease-out;
        transition: transform 0.3s ease-out;
    }

    .modal.in .modal-content {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .modal::-webkit-scrollbar {
        display: none;
    }

    .modal-content img {
        width: 100%;
        height: auto;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        padding-right: 5px;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .fade.in {
        opacity: 1;
        /* display:block; */
        z-index: 1024;
    }

    .fade {
        opacity: 0;
        -webkit-transition: opacity 0.15s linear;
        -o-transition: opacity 0.15s linear;
        transition: opacity 0.15s linear;
        /* display:none; */
        z-index: -10;
    }
    </style>
    @php $img_link = 'https://www.nayaraenergy.com/storage/retail/retail-popup.jpg'; @endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div id="notice_modal" class="modal fade">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="@php echo $img_link; @endphp"> 
        </div>
    </div>
    
    <script>
    
    $(document).ready(function(){
        
        setTimeout(function(){
            $('#notice_modal').addClass('in');
        }, 500);
   
        //$('#notice_modal').addClass('in');

        var modal = $(".notice_modal");

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        
        $('#notice_modal .close').click(function(){
            $('#notice_modal').removeClass('in'); 
        });   
        
    });
      
    </script>
</body>
</html>