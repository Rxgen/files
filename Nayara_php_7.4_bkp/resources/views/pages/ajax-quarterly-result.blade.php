@if(count($quarterly_results) > 0)
@foreach($quarterly_results as $quarterly_result)
@php
	$file = json_decode($quarterly_result->file);
@endphp
<div class="pdfDownload-data">
    <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
    <div class="pdfdata-block">
        <div class="pdf-name-title">
        {{ $quarterly_result->title }}
        </div>
        <a href="{{Storage::url($file[0]->download_link)}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
        </a>
    </div>
</div>
@endforeach
@else
<div class="pdf-name-title">
   No Report Found.
</div>
@endif