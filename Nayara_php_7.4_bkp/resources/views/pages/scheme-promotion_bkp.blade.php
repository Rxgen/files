@extends('layouts.welcome')
@section('content')
<style>
    .pb-0 {
        padding-bottom: 0 !important;
    }

    .pt-0 {
        padding-top: 0 !important;
    }

    .ta-c {
        text-align: center;
    }

    .ta-l,
    .bullet-list li {
        text-align: left;
    }

    .pb-5 {
        padding-bottom: 5.49048316252vw;
    }

    .grid-4-section .grid-4-col.jc-sb {
        justify-content: space-between !important;
    }


    .notices-wrapper {
        padding-top: 2.026354vw;
        padding-bottom: 2.026354vw;
        border-bottom: 1px solid rgba(51, 51, 51, 0.2);
        text-align: left;
    }

    .retail-network-join__cta_text {
        text-align: center;
        font-weight: normal;
        font-size: .833333333333vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 24px;
    }

    .retail-network-join__cta_text div {
        font-size: 14px;
        line-height: 1.2;
    }

    @media only screen and (min-width: 1023px) {
        .grid-4-section .grid-4-col .img-text-container p {
            font-size: 1vw !important;
        }

        .sustainable-title {
            display: block !important;
        }

        .livelihood-img-block+p {
            padding-top: 0 !important;
        }

        .sustainableInner-container p {
            margin-bottom: 0.521vw !important;
        }

        .schemeImg {
            width: 5.938vw;
        }

        .retail-network-join__cta_text div {
            font-size: 0.8vw;
            text-transform: capitalize;
        }

        .retail-network-join__cta_text {
            gap: 1.250vw;
        }
    }

    @media only screen and (max-width: 570px) {
        .ip-apply {
            flex-direction: column;
            gap: 7vw;
            padding-top: 0;
            margin-top: 0;
        }

        .schemeImg {
            width: 13.285vw;
        }

        .retail-network-join__cta {
            width: 60.386vw;
            height: 60.386vw;
            padding: 7.246vw;
        }

        .retail-network-join__cta_text div {
            font-size: 2.899vw;
            text-transform: capitalize;
        }
    }

</style>
@if(count($page) > 0)
<section class="innerPage-banner-container scheme_banner">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{{$page[0]->banner_title}}</h1>
</section>
@endif
@include('includes.bread-crumbs')
@if(count($page) > 0)

<section class="home-refinery" data-section="energy" style="align-items: center">
    <div class="generic-slider-content">
        <h1 class="generic-slider-heading">Join Nayara Energy’s<span
                class="theme-gradient-alpha gradient-text generic-slider-text">Mahabachat<br> Utsav</span></h1>
        <h4 class=" generic-slider-heading">get great fuel and instant discount on petrol purchase!!</h4>
        
    </div>
    <div class="video-container">
        <video id="nayaraVideo" onclick="control()" poster="{{asset('images/v2/scheme-promotion-new-thumbnail.webp')}}" controls>
            <source src="{{asset('videos/home/scheme-promotion.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</section>

<section class="scheme_container">
    <div class="scheme_text">
        <h4 class="generic-slider-heading">Only the best for your vehicles </h4>
        <p class="generic-slider-text-caption"> Head over to Nayara Energy Petrol Pumps, fuel up, and win instant
            savings!</p>
    </div>

    <div class="table-wrap scheme_table">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td>Save Rs. 50</td>
                    <td> Fuel purchase of Rs. 2000 & above</td>
                </tr>
                <tr>
                    <td>Save Rs. 30</td>
                    <td>Fuel purchase of Rs. 1500 to Rs. 1999</td>
                </tr>
                <tr>
                    <td>Save Rs. 15</td>
                    <td>Fuel purchase of Rs. 1000 to Rs. 1499</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="scheme_valid">*Valid till 15th September, 2024, valid on digital payments only
    </div>
</section>

<section class="scheme_fuel">
    <h4 class="generic-slider-heading">Fuel up at Nayara Energy petrol pumps and secure instant savings, <br>ensuring
        the best for your vehicles and a smooth journey! </h4>
    <div class="scheme_cta">
        <a href="tel:1800 1200 330" class="cta gradient-cta theme-gradient">
            <span class="gradient-cta-overlay gradient-text theme-gradient cta_text">Call Customer Support number for
                assistance </span>
            <span class="gradient-cta-overlay gradient-text theme-gradient">1800 1200 330 </span>
        </a>
    </div>
    <a class="scheme_link" href="{{asset('August_RO_List.pdf')}}" target="_blank" rel="noopener"> Click here for list of participating Ro's</a>
    <div class="brocher-text">
    <a href="{{ route('static.contact', ['slug' =>'terms-condition']) }}" target="_blank"><span class="note-blue gradient-cta-overlay gradient-text theme-gradient"> T&C - click here <strong class="retail-note-call"></a></span>
    </div>
</section>






<!---- Below Code Commented since it is temporaly removed -->
{{-- <section class="investorPages-container">
    <div class="content-flex">
        <div class="grid-4-section grid-padding">
            <div class="left-content">
                <div class="grid-4-col column-reverse pb-5 jc-sb">
                    <div class="img-text-container"><a href="scheme-promotion#faq"> <img src="{{asset('images/icons/FAQ.png')}}"
alt="Nayara Energy" /> </a>
<p class="theme-gradient-alpha generic-text"><a href="scheme-promotion#faq">Faq's</a></p>
</div>
<div class="img-text-container"><a href="{{ route('static.contact', ['slug' =>'terms-condition']) }}" target="_blank">
        <img src="{{asset('images/icons/Terms_and_conditions .png')}}" alt="Nayara Energy" /> </a>
    <p class="theme-gradient-alpha generic-text"><a href="petrochemicals/product#nadc">Terms And Conditions</a></p>
</div>
<div class="img-text-container"><a href="scheme-promotion#winners"> <img src="{{asset('images/icons/winners.png')}}"
            alt="Nayara Energy" /> </a>
    <p class="theme-gradient-alpha generic-text"><a href="scheme-promotion#winners">Winners</a></p>
</div>
<div class="img-text-container"><a href="scheme-promotion#participate"> <img
            src="{{asset('images/icons/participating_RO.png')}}" alt="Nayara Energy" /> </a>
    <p class="theme-gradient-alpha generic-text"><a href="scheme-promotion#participate">Participating RO'S</a></p>
</div>
<div class="img-text-container"><a href="scheme-promotion#schemeflow"><img
            src="{{asset('images/icons/Our_scheme_flow.png')}}" alt="Nayara Energy" /></a>
    <p class="theme-gradient-alpha generic-text"><a href="scheme-promotion#schemeflow">Scheme Flow</a></p>
</div>
<div class="img-text-container"><a href="scheme-promotion#aboutscheme"> <img
            src="{{asset('images/icons/About_the_scheme.png')}}" alt="Nayara Energy" /></a>
    <p class="theme-gradient-alpha generic-text"><a href="scheme-promotion#aboutscheme">About The Scheme</a></p>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="sustainableInner-container refinery_container investorPages-container">
    <h3 class="sustainable-title" style="text-align:center;" id="aboutscheme">This Festive period, Stay Connected <br>
        Nayara Petrol Pump presents ‘Sab ki Jeet Guaranteed’</br></h3>
    <div class="sustainableInner-content-block wrap-clear">
        <div class="livelihood-img-block"><img src="{{asset('images/icons/Inner_fuel.jpg')}}" alt="refinery"></div>
        <p>This festive period, gear up to celebrate ‘Connected Festivity’ !
            Pen a list of all friends and families that you would visit this festive period, as Nayara Energy, is back
            with “Sab Ki Jeet Guaranteed” scheme.</p>
        <p>Simply, fuel up your petrol tank with Rs 200/- or more and secure an instant fuel voucher upto Rs 1000/- But
            that's not all! </p>
        <p>You even stand a chance to win smartphones to sleek two-wheelers and to command the road in a brand-new car.
            This festive season, Nayara guarantees that we give you a reason to ‘Stay Connected’....Mileage ke saath
            Smileage bhi!</p>
        <p>Plan that ‘ Re-Union Party’ or ‘ Cards Night’ this festive period… Head over to Nayara Petrol Pumps…fuel up
            and celebrate Festivities with ones that matter the most!</p>
    </div>
</section>

<section class="investorPages-container" style="margin-bottom: 7vw;">
    <div class="innerPage-content  ta-c">
        <h3 class="sustainable-title" id="schemeflow">To avail this offer, simply follow these instructions</h3>
        <section class="ip-apply whoWe-are-container wrap-clear pb-0 pt-0">
            <a href="javascript:" class="retail-network-join__cta apply ip-shadow">
                <div class="retail-network-join__cta_text"><span class="retail-network-join__cta_highlight">STEP
                        1</span>
                    <img src="{{asset('images/icons/Step1.png')}}" alt="Step 1" class="schemeImg" />
                    <div>Scan the QR code at the RO.</div>
                </div>
            </a>
            <a href="javascript:" class="retail-network-join__cta apply ip-shadow">

                <div class="retail-network-join__cta_text"><span class="retail-network-join__cta_highlight">STEP 2

                    </span>
                    <img src="{{asset('images/icons/Step2.png')}}" alt="Step 2" class="schemeImg" />
                    <div>You'll get a welcome message on the Customer WhatsApp Bot.</div>
                </div>
            </a>
            <a href="javascript:" class="retail-network-join__cta apply ip-shadow">
                <div class="retail-network-join__cta_text"><span class="retail-network-join__cta_highlight">STEP 3

                    </span> <img src="{{asset('images/icons/Step3.png')}}" alt="Step 3" class="schemeImg" />
                    <div>Complete a one-time registration by following the prompts. Provide your Name, Vehicle Type
                    </div>
                </div>
            </a>
        </section>
        <section class="ip-apply whoWe-are-container wrap-clear pb-0">
            <a href="javascript:" class="retail-network-join__cta apply ip-shadow">
                <div class="retail-network-join__cta_text"> <span class="retail-network-join__cta_highlight">STEP 4

                    </span> <img src="{{asset('images/icons/Step4.png')}}" alt="Step 4" class="schemeImg" />
                    <div>Share a picture of your fuel receipt on WhatsApp.</div>
                </div>
            </a>
            <a href="javascript:" class="retail-network-join__cta apply ip-shadow">
                <div class="retail-network-join__cta_text"><span class="retail-network-join__cta_highlight">STEP 5

                    </span> <img src="{{asset('images/icons/Step5.png')}}" alt="Step 5" class="schemeImg" />
                    <div>WhatsApp will read the receipt with its QR code</div>
                </div>
            </a>
            <a href="javascript:" class="retail-network-join__cta apply ip-shadow">
                <div class="retail-network-join__cta_text"><span class="retail-network-join__cta_highlight">STEP 6

                    </span> <img src="{{asset('images/icons/Step6.png')}}" alt="Step 6" class="schemeImg" />
                    <div>Get an Assured Instant Fuel Voucher upto 1000/- on your 1st and 4th Visit.</div>
                </div>
            </a>

        </section>
    </div>
</section>

<section class="investorPages-container" style="margin-bottom: 7vw;">
    <div class="innerPage-content">
        <div style="text-align:center;">
            <h3 class="sustainable-title" id="participate">Participating RO'S</h3>
        </div>
        <div class=" ">
            <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
            <div class="pdfdata-block">
                <div class="pdf-name-title">
                    List Of Participate RO.
                </div>
                <a href="{{ asset('images/RO_list.pdf') }}"
                    class="cta gradient-cta theme-gradient form-cta steps-form-cta" download>
                    <span class="gradient-cta-overlay gradient-text theme-gradient download">Download</span>
                </a>
            </div>
        </div>

</section>


<section class=" board_section_audit ta-c pb-5">
    <h3 class="sustainable-title" id="winners">Winners</h3>
    <div>
        <h2 class="gradient-cta-overlay gradient-text theme-gradient" style="font-size:100px;">Coming Soon</h2>
    </div>
    <!--    <div class="board_inner_sec">
        <div class="board_person_blk">
            <div class="board_person_blk_inner" data-index="0">
                <div class="board_person_img_blk">
                    <img src="{{asset('images/icons/pro.png')}}" alt="AAA">
                </div>
                <div class="board_person_content_blk">
                    <div class="board_person_ttl">
                        AAAA
                    </div>
                </div>
            </div>
        </div>
        <div class="board_person_blk">
            <div class="board_person_blk_inner" data-index="1">
                <div class="board_person_img_blk">
                    <img src="{{asset('images/icons/pro.png')}}" alt="XYZ">
                </div>
                <div class="board_person_content_blk">
                    <div class="board_person_ttl">
                        XYZ
                    </div>
                </div>
            </div>
        </div>
        <div class="board_person_blk">
            <div class="board_person_blk_inner" data-index="2">
                <div class="board_person_img_blk">
                    <img src="{{asset('images/icons/pro.png')}}" alt="ABC">
                </div>
                <div class="board_person_content_blk">
                    <div class="board_person_ttl">
                        ABC
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>


<section class="innerPage-content investorPages-container faqPage page-investors-notices ta-c">
    <h3 class="sustainable-title" id="faq">FAQ: Nayara Sab ki Jeet Guaranteed</h3>
    <div class="notices-wrapper">
        <h5 class="notices-heading">What is Nayara: Sab ki Jeet Guaranteed?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>
                ‘Nayara: Sab ki Jeet Guaranteed’ is a “Promotional Offer” for consumers, which is sponsored and brought
                to you by Nayara Energy.
            </div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">What is the validity of this campaign?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>
                The Promotional Offer is a limited period offer valid only in India subject to availability
                participating retail outlets only. The offer period is 1st November 2023 to 26th January 2024.
            </div>
        </div>
    </div>

    <div class="notices-wrapper ">
        <h5 class="notices-heading">How will the customer know about the participating outlets?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>They can refer to the Nayara Webpage. The list of outlets will get refreshed from time to time</div>
        </div>
    </div>
    <div class="notices-wrapper ">
        <h5 class="notices-heading">Who can participate in the Campaign?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>Promotion is open to citizens of India only and persons above 18 years of age.</div>
        </div>
    </div>
    <div class="notices-wrapper ">
        <h5 class="notices-heading">Can Nayara Employees & their relatives, Nayara Franchisee or their staff & their
            relatives participate in this campaign?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>No.</div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">What are the criteria to participate in this campaign?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>To participate in the Contest, the Customer should register on the WhatsApp business account of Nayara,
                purchase petrol of minimum Rs.200 during the Offer Period and share the QR code on the POS bill on
                WhatsApp business account of Nayara. </div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">Is there a need to preserve the invoice to claim any prizes?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>It’s recommended that the customer keeps the photocopy/photo of original bill to help in verifying the
                original bill if it partially fades away</div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">Is there any limit to the number of invoice uploads during the offer period?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>A customer can submit a 1 POS bill per day and maximum of 10 POS bills in a month during the offer
                period</div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">What will happen if a customer uploads the 11th invoice in a month?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>The WhatsApp chatbot page will throw an error message</div>
        </div>
    </div>
    <div class="notices-wrapper ">
        <h5 class="notices-heading">What are the prizes that customer can win in this contest?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>Bumper Prize Assured Prizes
                7 Cars Fuel vouchers starting from Rs 10 upto Rs 1000.
                24 Two-Wheelers
                48 Mobile phones
            </div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">Are there any assured prizes for participating customers?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>Every participant wins an assured fuel voucher on the 1st and the 4th valid transaction. 1st valid
                transaction is the one where the customer shares the valid POS bill. A petrol bill having a QR code
                generated from Fiserv POS of Nayara Retail Outlet is considered a valid POS bill</div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">Is there a validity period of the fuel voucher?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>Yes, the fuel voucher expires after 30 days. Hence the voucher is to be redeemed within 30 days of
                issuance</div>
        </div>
    </div>
    <div class="notices-wrapper ">
        <h5 class="notices-heading">What are valid transactions?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>Any petrol POS bill of value greater than Rs 200 uploaded successfully on WhatsApp is counted as a
                valid transaction.</div>
        </div>
    </div>
    <div class="notices-wrapper">
        <h5 class="notices-heading">Can the prizes be redeemed or exchanged for another Gift Voucher/Gift Card/cash?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>No.</div>
        </div>
    </div>

    <div class="notices-wrapper">
        <h5 class="notices-heading">Can a customer win multiple prizes?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>All the participating customers who have won the regular prizes also stand a chance of winning any one
                from the Bumper Prizes category mentioned in the above table. Bumper prizes are not applicable on
                transactions from Nayara retail outlets of TN</div>
        </div>
    </div>

    <div class="notices-wrapper">
        <h5 class="notices-heading">What are the steps to claim physical prizes?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>In the case of physical items, the customer needs to provide valid ID proof (Aadhar Card, Passport,
                Driving License or PAN Card.) and pay the registration, Insurance, statutory levies / taxes, if
                applicable. Failing to do so may lead to disqualification</div>
        </div>
    </div>

    <div class="notices-wrapper">
        <h5 class="notices-heading">Who will bear the gift taxes & who will guide the customers to complete the
            formalities to claim the gifts?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>The Winners/customers will have to bear the same, complete the payment before the gifts are handed over
                to the customer. The Agency will connect with the winners and guide them on the same</div>
        </div>
    </div>

    <div class="notices-wrapper">
        <h5 class="notices-heading">Does the customer pay the gift tax to claim the prizes?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>Yes</div>
        </div>
    </div>

    <div class="notices-wrapper">
        <h5 class="notices-heading">Who will bear the cost associated to registration, insurance and taxes for
            Cars/2Wheelers?
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>The Winners/customers will have to bear the same</div>
        </div>
    </div>

    <div class="notices-wrapper">
        <h5 class="notices-heading">What happens if a customer does not want to pay the taxes associated and other costs
            to claim any prize
            <div class="arrow-title"></div>
        </h5>
        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>In such cases, that customer will lose out on the prize and Nayara will run the system/program again to
                pick a new winner.</div>
        </div>
    </div>
</section>--}}
@endif
@stop
