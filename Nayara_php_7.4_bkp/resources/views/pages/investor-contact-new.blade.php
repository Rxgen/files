@extends('layouts.welcome')
@section('content')
@if(count($page) > 0)
</style>
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
<section class="innerPage-content investorPages-container page-investors-notices">
    <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Investors</h4>

    <div class="notices-container">
        @foreach($contacts as $contact)
        <div class="notices-wrapper {{ $contact->custom_class }}">
            <h5 class="notices-heading">{{ $contact->title }}
                <div class="arrow-title"></div>
            </h5>
            {!! $contact->description !!}
        </div>
        @endforeach
    </div>
</section>

<!--- New Created the Form  For investors/information page New Section is created ----> 
<div class="investor_overlay"></div>
<div class="investor_popup" id="investor_popup">
    <div class="investor_container">
        <div class="investor_steps step_1">
            <form action=" "  class="folio_number">
                <label class="text_input retail-inquiry__contact-form_wrapper" for="id_number">
                    <input id="check_folio_number" type="text" class="retail-inquiry__contact-form_input step1_input"
                        placeholder="Enter Folio Number">
                </label>
                <span class="otpError folioerror">  </span>
                <span class="field_option">OR</span>
                <label class="text_input retail-inquiry__contact-form_wrapper required" for="demat">
                    <input id="demat_number" type="text" class="retail-inquiry__contact-form_input step1_input"
                        placeholder="Enter Demat account Number">
                </label>
                <span class="otpError dematerror"></span>
                <button type="submit" data-api-url="{{ route('investors.usercheck') }}" class="step_1_btn cta gradient-cta theme-gradient"><span
                        class="gradient-cta-overlay gradient-text theme-gradient">Submit</span>
                </button>
                
                
            </form>
            <div class="investor_note">
                <div class="note_title">Note:</div>
                <ol>
                    <li>Folio Number should be same as appearing on the certificate. Please ensure that folio number is a 7-digit number.</li>
                    <li>
                        If you were a resident Indian and holder of equity shares of erstwhile Vadinar Oil Terminal Limited
                        (‘VOTL’) in physical form and have not taken credit of Non-Convertible Debenture (issued on
                        merger of VOTL with Nayara Energy) in your demat account, please enter Folio no. appearing on
                        your VOTL share certificate. Please ensure that folio no. is a 7-digit alpha-numeric number starting
                        with letter ‘V’ followed by 6 digits. Example V012345.
                    </li>
                    <li>
                        Demat Account Number (comprising of DP ID and Client ID) should be entered without any space
                        or special character. <br>
                        Example. If DP ID is IN123456 and Client ID is 78910000 then enter IN12345678910000. Or, if DP
                        ID is 12345678 and Client ID is 91012345 then enter 1234567891012345.
                    </li>
                </ol>
            </div>
        </div>
        <span class="otpError errorShow"></span>
        <div class="investor_steps step_2">
        <form action="" class="folio_number">
                <label class="text_input retail-inquiry__contact-form_wrapper required" for="pan_number">
                    <input id="pan_number" type="text" class="retail-inquiry__contact-form_input input"
                        placeholder="Enter Your PAN Number">
                </label>
                <span class="otpError otpError-1"></span>
                <!-- <span class="field_option">OR</span>
                <label class="text_input retail-inquiry__contact-form_wrapper required" for="mobile_number">
                    <input id="mobile_number" type="number" class="retail-inquiry__contact-form_input input"
                        placeholder="Enter Your Mobile Number">
                </label>
                <span class="otpError otpError-2"></span> -->
                <span class="field_option">OR</span>
                <label class="text_input retail-inquiry__contact-form_wrapper required" for="email">
                    <input id="email" type="email" class="retail-inquiry__contact-form_input input"
                        placeholder="Enter Your Email ID">
                </label>
                <span class="otpError otpError-3"></span>
                <button type="submit" data-api-url="{{ route('investors.otp') }}" class="step_2_btn cta gradient-cta theme-gradient" id="send_otp"><span class="gradient-cta-overlay gradient-text theme-gradient">Get OTP</span></button>    
            </form>
            <div class="investor_note">
                <div class="note_title">Note:</div>
                <ol>
                    <li>
                        To access your details, please enter either of the following as Password:
                        <ul>
                            <li>PAN number of the First holder of shares of erstwhile VOTL / debentures of Nayara, as the case
                                may be. Please ensure to enter PAN in ALL CAPS. If PAN entered by you is registered with the
                                RTA / depository participant, you will be able to access details of your unclaimed payments;
                            </li>
                            <span class="field_option">OR</span>
                            <li>
                                Mobile Number or E-mail ID of the First holder of shares / debentures as registered with the
                                Registrar &amp; Transfer Agents (in case of physical shares) or with your depository participant (in
                                case of shares held in demat form). If correct details are entered, you will receive an OTP on
                                the mobile number or e-mail entered for verification. On verification of OTP, you will be able
                                to access details of your unclaimed payments.
                            </li>
                        </ul>
                    </li> 
                </ol>
            </div>
        </div>
        <span class="otpError errorShow2"></span>
        <div class="investor_steps step_3">
        <form action="" class="folio_number">
                <label class="text_input retail-inquiry__contact-form_wrapper step-mobile" for="mobile_number">
                    <input id="StepMobile" type="number" class="retail-inquiry__contact-form_input  " placeholder="Enter Your Mobile Number">
                </label> 
                <label class="text_input retail-inquiry__contact-form_wrapper step-email" for="email" >
                    <input id="StepEmail" type="email" class="retail-inquiry__contact-form_input "
                        placeholder="Enter Your Email ID" >
                </label>
                <button type="submit" data-api-url="{{ route('investors.otp') }}" class="step_3_btn cta gradient-cta theme-gradient"><span
                        class="gradient-cta-overlay gradient-text theme-gradient">Resend OTP</span></button>
                <span class="otpMessage" id="Resendtimer"></span>
                <div class="otp_text">A one-time password (OTP) verification code has been sent to your Registered Number / Email ID</div>
                <div class="otp_detail">
                    <label
                        class="retail-inquiry__contact-form_wrapper required folio_input cta gradient-cta theme-gradient"
                        for="otp_1"><input id="otp_1" type="number"
                            class="retail-inquiry__contact-form_input gradient-cta-overlay gradient-text theme-gradient otp_number"
                            max-length="1"></label>
                    <label
                        class="retail-inquiry__contact-form_wrapper required folio_input cta gradient-cta theme-gradient"
                        for="otp_2"><input id="otp_2" type="number"
                            class="retail-inquiry__contact-form_input gradient-cta-overlay gradient-text theme-gradient otp_number"
                            max-length="1"></label>
                    <label
                        class="retail-inquiry__contact-form_wrapper required folio_input cta gradient-cta theme-gradient"
                        for="otp_3"><input id="otp_3" type="number"
                            class="retail-inquiry__contact-form_input gradient-cta-overlay gradient-text theme-gradient otp_number"
                            max-length="1"></label>
                    <label
                        class="retail-inquiry__contact-form_wrapper required folio_input cta gradient-cta theme-gradient"
                        for="otp_4"><input id="otp_4" type="number"
                            class="retail-inquiry__contact-form_input gradient-cta-overlay gradient-text theme-gradient otp_number"
                            max-length="1"></label>
                    <label
                        class="retail-inquiry__contact-form_wrapper required folio_input cta gradient-cta theme-gradient"
                        for="otp_5"><input id="otp_5" type="number"
                            class="retail-inquiry__contact-form_input gradient-cta-overlay gradient-text theme-gradient otp_number"
                            max-length="1"></label>
                    <label
                        class="retail-inquiry__contact-form_wrapper required folio_input cta gradient-cta theme-gradient"
                        for="otp_6"><input id="otp_6" type="number"
                            class="retail-inquiry__contact-form_input gradient-cta-overlay gradient-text theme-gradient otp_number"
                            max-length="1"></label>
                    <span class="otpError InvalidMessage"></span>
                </div>
                <button type="submit" data-api-url="{{ route('investors.userverify') }}" class="step_4_btn cta gradient-cta theme-gradient"><span
                        class="gradient-cta-overlay gradient-text theme-gradient">Next</span></button>
            </form>
        </div>
    </div>
    <img src="{{asset('images/black-close.png')}}" alt="" class="close_popup">
</div>
@stop
