<select name="year" id="bm-year" class="year"  data-month-api-route="{{ route('bio_medical_waste_report.get_month') }}" data-site-api-route="{{ route('bio_medical_waste_report.get_site') }}">
    <option value="select year" disabled selected>Select Year</option>
    @foreach($years as $year)
    <option value="{{ $year->year }}"> {{ $year->year }} </option>
    @endforeach
</select>