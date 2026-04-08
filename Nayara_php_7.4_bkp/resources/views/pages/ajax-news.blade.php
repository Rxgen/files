@if(count($in_the_news) > 0)
@foreach($in_the_news as $news)
@php $file = json_decode($news->file); @endphp
<div class="pdfDownload-data">
    <!--<img src="assets/images/pdf-img.png" alt="pdf" class="pdfIcon">-->
    <div class="pdfdata-block">
        <img src="{{ Voyager::image($news->image) }}" alt="{{ $news->img_alt }}" title="{{ $news->img_title }}" class="news-image">
        <div class="pdf-name-title">
            <span>{{ $news->title }}</span> {{$news->sub_title}} </div>
        <a href="{{Storage::url($file[0]->download_link)}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
        </a>
    </div>
</div>
@endforeach
@endif