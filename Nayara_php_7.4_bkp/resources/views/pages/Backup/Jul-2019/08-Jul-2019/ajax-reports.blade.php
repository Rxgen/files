@if(count($reports) > 0)
@foreach($reports as $report)
@if($report->is_subsidiaries == 0)
@php
	$file = json_decode($report->file);
@endphp
<div class="pdfDownload-data">
    <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
    <div class="pdfdata-block">
        <div class="pdf-name-title">
           Annual Report ( {{ $report->year }} - {{ $report->year+1 }} )
        </div>
        <a href="{{Storage::url($file[0]->download_link)}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
        </a>
    </div>
</div>
@endif
@endforeach
@else
<div class="pdf-name-title">
   No Report Found.
</div>
@endif