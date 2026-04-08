@extends('layouts.welcome')
@section('content')
<section class="innerPage-banner-container investors-governance-banner">
            <picture>
                <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
                <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Qr Code" class="innerBanner-img" width="1920" height="419">
            </picture>
            <h2 class="innerBanner-title"> {!! $page[0]->banner_title !!}</h2>
        </section>
        @include('includes.bread-crumbs')
        <section class="qr_form_container">
            <div class="qr_form">
                <div class="qr_title">We are looking forward to your enquiry</div>
                <form action="" class="">
                    <div class="cta gradient-cta theme-gradient qr_input grow">
                        <input type="text" id="company_name" placeholder="Company name" required>    
                        <span class="otpError otpError-3 companyerror"></span>
                    </div>
                    
                    
                    <div class="cta gradient-cta theme-gradient qr_input">
                             <select name="country" id="country-select" required class="country-select">
                                <option value="" disabled selected>Country of Establishment</option>
                            </select>
                            <span class="otpError otpError-3"></span>
                    </div>
                    <div class="cta gradient-cta theme-gradient qr_input">
                        <input type="text" id="contact_person" placeholder="Contact Person" required>
                        <span class="otpError otpError-3 ContactPersonError"></span>
                    </div>

                    <div class="cta gradient-cta theme-gradient qr_input">
                        <input type="number" id="MobileNumber" placeholder="Contact Number" required>
                        <span class="otpError otpError-3 mobileerror"></span>
                    </div>
                    <div class="cta gradient-cta theme-gradient qr_input">
                        <input type="email" id="EmailId" placeholder="EMAIL ID" required>
                        <span class="otpError otpError-3 Emailerror"></span>
                    </div>
                    <div class="cta gradient-cta theme-gradient qr_select qr_input grow">
                        <select name="category" id="category" required>
                            <option value="" disabled selected>Category</option>
                            <option value="procurement">Procurement</option>
                            <option value="retail/petrol-pump-dealership-apply">Apply for Petrol pump dealership </option>
                            <option value="career">Career</option>
                            <option value="trading">Trading </option>
                            <options value="Institutional Business">Institutional Business </options>
                             <options value="Institutional Business">Media </options>
                            <option value="Investors">Investors</option>
                        </select>
                    </div>
                    <div class="cta gradient-cta theme-gradient qr_input grow qr_textarea" style="display:none" id="refinery">
                     <textarea name="refinery"  placeholder="Enter your comment" cols="50" rows="4" required></textarea>
                    </div>

                    <div class="cta gradient-cta theme-gradient qr_input grow qr_textarea" style="display:none" id="trading">
                     <textarea name="trading"  placeholder="Enter your comment" cols="50" rows="4" required></textarea>
                    </div>

                    <div class="cta gradient-cta theme-gradient qr_input grow qr_textarea" style="display:none" id="other">
                     <textarea name="other"  placeholder="Enter your comment" cols="50" rows="4" required></textarea>
                    </div>
                    <div class="cta gradient-cta theme-gradient qr_select qr_input grow" id="procurement-dropdown" style="display:none">
                        <select name="category" id="category2" required>
                            <option value="" disabled selected>Category</option>
                            <option value="ADM">ADM - Admin, Health, Safety, Fire & Environment Material / Service Provider</option>
                            <option value="ADP">ADP - Project Management, Consulting & Licensing</option>
                            <option value="C&C">C&C - Chemical / Catalyst & lab Chemical Material / Service Provider</option>
                            <option value="CSR">CSR - CSR Services</option>
                            <option value="CVL">CVL - Civil Material / Service Provider</option>
                            <option value="ELE">ELE - Electrical Material / Service Provider</option>
                            <option value="F1F">F1F - Subscriptions & Professional Service</option>
                            <option value="HMF">HMF - Biofuel Procurement</option>
                            <option value="I1I">I1I - Information Technology Material / Service Provider</option>
                            <option value="INS">INS - Instrumentation Material / Service Provider</option>
                            <option value="L2L">L2L - Logistics</option>
                            <option value="M1M">M1M - Marketing Infrastucture Development</option>
                            <option value="MEC">MEC - Mechanical Material / Service Provider</option>
                            <option value="MRO">MRO - Consumable + Workshop Related Material / Service Provider</option>
                            <option value="PVF">PVF - Piping & Structural Steel Material / Service Provider</option>
                            <option value="RIR">R1R - Retail Outlet Equipment & Services</option>
                            <option value="WIW">W1W - Storage & Terminal</option>
                        </select>
                    </div>
                    <div class="cta_button">
                        <button type="submit" class="qr-form-submit" data-api-url="{{ route('enquiry.leads') }}">
                            <div class="cta gradient-cta theme-gradient">
                                <span>SUBMIT</span>
                            </div>
                        </button>
                        <span class=" otpError-4" style="color:green"></span>
                    </div>
                </form>
            </div>
        </section>
        <section class="qr_interest">
            <div class="qr_title">You may also be interested in</div>
            <div class="qr_interest_container">
                <a href="{{ route('static.contact', ['slug' => 'petrol-pump-near-me']) }}" class="qr_box">
                    <img src="{{ asset('images/qr/img-1.webp') }}" class="home-business__img" alt="Image1" width="727" height="413">
                    <div class="box_title">PETROL PUMP NEAR ME</div>
                    <div class="box_cta">
                        <div class="home-business__caption_container activeText ">
                            <div class="cta gradient-cta theme-gradient normal-cta">
                                <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                            </div>
                        </div>
                    </div> 
                </a>
                <a href="{{ route('static.retail', ['slug' => 'petrol-pump-dealership-requirements']) }}" class="qr_box">
                    <img src="{{ asset('images/qr/img-2.webp') }}" class="home-business__img" alt="image2" width="727" height="413">
                    <div class="box_title">PETROL PUMP DEALERSHIP</div>
                    <div class="box_cta">
                        <div class="home-business__caption_container activeText ">
                            <div class="cta gradient-cta theme-gradient normal-cta">
                                <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                            </div>
                        </div>
                    </div>
                </a> 
                <a href="{{ route('static.contact', ['slug' => 'vadinar-refinery']) }}" class="qr_box">
                    <img src="{{ asset('images/qr/img-3.webp') }}" class="home-business__img" alt="Image3" width="727" height="413">
                    <div class="box_title">VADINAR REFINERY</div>
                    <div class="box_cta">
                        <div class="home-business__caption_container activeText ">
                            <div class="cta gradient-cta theme-gradient normal-cta">
                                <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('static.contact', ['slug' => 'petrochemicals']) }}" class="qr_box"> 
                    <img src="{{ asset('images/qr/img-4.webp') }}" class="home-business__img" alt="Petrochemicals" width="727" height="413">
                    <div class="box_title">PETROCHEMICALS</div>
                    <div class="box_cta">
                        <div class="home-business__caption_container activeText ">
                            <div class="cta gradient-cta theme-gradient normal-cta">
                                <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
</section>
@stop