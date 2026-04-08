@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    @if(collect(request()->segments())->last() === 'bulk-business' || collect(request()->segments())->last() === 'franchisees-testimonials')
    <h2 class="innerBanner-title innerBanner-sm-title">{!! $page[0]->banner_title !!}</h2>
    @else
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
    @endif
</section>
@if (collect(request()->segments())->last() === 'apply-online')
<input value="{{route('populate_states')}}" type="hidden" class="states_url" />
<input value="{{route('populate_district')}}" type="hidden" class="district_url" />
<input value="{{route('form_url')}}" type="hidden" class="apply_form_submit" />
@endif
@if (collect(request()->segments())->last() === 'retail-outlet-locator')
<input value="{{route('get.ro')}}" type="hidden" class="find-ro-url" />
<input value="{{route('get.code-ro')}}" type="hidden" class="ro-code-url" />
@endif
@if (collect(request()->segments())->last() === 'retail-outlet-locator')
<input value="{{route('get.ro')}}" type="hidden" class="find-ro-url" />
<input value="{{route('ro.pumps')}}" type="hidden" class="ro_pumps" />
<input value="{{route('get.code-ro')}}" type="hidden" class="ro-code-url" />
@endif
@endif
@include('includes.bread-crumbs')
@if(count($page) > 0)
	@if (collect(request()->segments())->last() === 'apply-online')
    <section class="innerPage-content retail-content retail-apply">
        <div class="retail-inquiry-wrapper"><strong class="innerPageTitle theme-gradient-alpha gradient-text">Retail Outlet Franchisee Enquiry</strong>
            <div class="retail-inquiry-container wrap-clear">
                <div class="retail-inquiry__contact-container">
                    <div class="retail-inquiry__contact"><img src="http://182.76.150.26/nayara-energy/public//storage/pages/April2019/contact-phone-icon2.png" alt="" width="80" height="32" /> <span class="retail-inquiry__contact_prefix">Toll Free Number</span> <a class="retail-inquiry__contact_number" href="tel:18001200330">1800 1200 330</a>
                        <div class="retail-inquiry__contact_suffix">(Monday - Saturday: 9:00 AM to 12:00 AM)</div>
                    </div>
                    <div class="retail-inquiry__contact"><img src="http://182.76.150.26/nayara-energy/public//storage/pages/April2019/contact-phone-icon2.png" alt="" width="80" height="32" /> <span class="retail-inquiry__contact_prefix">Or give a missed call at</span> <a class="retail-inquiry__contact_number" href="tel:18001200330">09575795330</a></div>
                </div>
                <div class="retail-inquiry__contact-form">
                    <label class="retail-inquiry__contact-form_wrapper required" for="name">
                        <input id="name" type="text" class="retail-inquiry__contact-form_input" placeholder="Name" /> </label>
                    <label class="retail-inquiry__contact-form_wrapper required" for="mobile">
                        <input id="mobile" type="number" class="retail-inquiry__contact-form_input" placeholder="Mobile" /> </label>
                    <label class="retail-inquiry__contact-form_wrapper required">
                        <input id="email" type="email" class="retail-inquiry__contact-form_input" placeholder="Email Id" /> </label>
                    <label class="retail-inquiry__contact-form_wrapper select required">
                        <select id="source" class="retail-inquiry__contact-form_input">
                            <option selected="selected" value="blank">How did you find us?*</option>
                            <option value="Newspaper Ad">Newspaper Ad</option>
                            <option value="Employee referral">Employee referral</option>
                            <option value="Online">Online</option>
                            <option value="Social Media">Social Media</option>
                            <option value="Others">Others</option>
                        </select>
                    </label>
                    <label class="retail-inquiry__contact-form_wrapper select required">
                        <select class="retail-inquiry__contact-form_input add-states">
                            <option value="">Loading States</option>
                        </select>
                    </label>
                    <label class="retail-inquiry__contact-form_wrapper select required">
                        <select class="retail-inquiry__contact-form_input add-district">
                            <option value="">Select District</option>
                        </select>
                    </label>
                     <label class="retail-inquiry__contact-form_wrapper required" >
                        <input id="create_captcha" type="text" class="retail-inquiry__contact-form_input" style="display:inline-block; width:20%;font-weight: 700;" value="{{$num1}} + {{$num2}}" readonly /> 
                        <span style="display:inline-block; width:5%;"> = </span>
                        <input id="captcha" type="text" class="retail-inquiry__contact-form_input" style="display:inline-block; width:40%;" placeholder="enter answer" />
                    </label>
                    
                    <button class="cta gradient-cta theme-gradient form-cta retail-form-cta"> <span class="gradient-cta-overlay gradient-text theme-gradient">Submit</span> </button>
                    <div class="form-thank-you">Thank you for submitting the form.
                        <br />We will get in touch with you shortly</div>
                </div>
            </div>
        </div>
        <div class="retail-note"><strong>ATTENTIONS</strong> - <span class="note-blue">Persons desirous to be Franchisee / dealer of Nayara Energy. to set up of Petrol Pumps /Retail Outlet be cautioned against misrepresentation / fraud by unauthorised persons / company.</span> This is to inform and caution the persons desirous to be Franchisee / dealer of Nayara Energy for setting up Petrol Pumps /Retail Outlet that we have come to know about some incidences wherein some unauthorised persons / company have misrepresented in the name of Nayara Energy or fake company having deceptive similarity with company&rsquo;s name to defraud and cheat people. The public at large is hereby further cautioned that Nayara Energy has not given any authority to any third party to act on its behalf for setting up petrol pump. Any person dealing with such unauthorised person/company, shall be responsible, for his/her own acts and for any loss, cost or expenses occurred to him/her and Nayara Energy will not be responsible/ liable in any manner for any such dealings. <span class="note-blue">For any enquiry for setting up petrol pump you may please call us at our toll free number <strong class="retail-note-call"><a href="tel:18001200330">1800 1200 330. nilesh nilesh</a></strong></span></div>
    </section>
	@else
    {!! $page[0]->body !!}
    @endif
@endif
@stop