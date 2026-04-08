@if (collect(request()->segments())->last() === 'contact-us')
<input value="{{route('populate_states')}}" type="hidden" class="states_url" />
<input value="{{route('static.petrochemicals',['primarySlug' =>'contact-us','secondarySlug' =>'thankyou'])}}" type="hidden" class="thanku-redirect" />
<input value="{{route('populate_district')}}" type="hidden" class="district_url" />
<input value="{{route('form_submit')}}" type="hidden" class="apply_form_submit" />
@endif
<section class="innerPage-content retail-content retail-apply">
          <div class="retail-inquiry-wrapper">
                <b class="innerPageTitle theme-gradient-alpha gradient-text">Business Enquiry form</b>
                <div class="retail-inquiry-container wrap-clear">
                    <div class="retail-inquiry__contact-form">
                        <label for="name" class="retail-inquiry__contact-form_wrapper required">
                            <input id="name" type="text" class="retail-inquiry__contact-form_input" placeholder="Name" />
                        </label>
                        <label class="retail-inquiry__contact-form_wrapper required">
                            <input type="text" id="orgname" class="retail-inquiry__contact-form_input" placeholder="Organization Name" />
                        </label>
                        <label for="mobile" class="retail-inquiry__contact-form_wrapper required">
                            <input id="mobile" type="number" class="retail-inquiry__contact-form_input" placeholder="Mobile" />
                        </label>
                        <label class="retail-inquiry__contact-form_wrapper required">
                            <input type="email" id="email" class="retail-inquiry__contact-form_input" placeholder="Email Id" />
                        </label>
                       
                        <label class="retail-inquiry__contact-form_wrapper required select">
                            <select class="retail-inquiry__contact-form_input add-states">
                                <option value="">Select State</option>
                            </select>
                        </label>
                        <label class="retail-inquiry__contact-form_wrapper required select">
                            <select class="retail-inquiry__contact-form_input add-district">
                                <option value="">Select District</option>
                            </select>
                        </label>
                        <label class="retail-inquiry__contact-form_wrapper required">
                            <input type="text" id="query" class="retail-inquiry__contact-form_input" placeholder="Query" />
                        </label>
                        <button class="cta gradient-cta theme-gradient form-cta retail-form-cta btn-loading">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Submit</span>
                        </button>
                        <div class="form-thank-you">Thank you for submitting the form.<br />We will get in touch with you shortly</div>
                    </div>
                </div>
            </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
    <script>
var clipboard = new ClipboardJS('address');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
    </script>

