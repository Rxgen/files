<select name="site" id="bm-site" class="site" data-detail-api-route="{{  route('bio_medical_waste_report.get_detail') }}">
        <option value="select site" disabled selected>Select Site</option>
        @foreach($sites as $site)
        <option value="{{ $site->site_name }}">{{ $site->site_name }}</option>
        @endforeach
</select>