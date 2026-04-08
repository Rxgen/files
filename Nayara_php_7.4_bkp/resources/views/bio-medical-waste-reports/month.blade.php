<select name="month" id="bm-month" class="month" data-site-api-route="{{ route('bio_medical_waste_report.get_site') }}">
        <option value="select Month" disabled selected>Select month</option>
        <!-- <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option> -->
        @foreach($months as $month)
        <option value="{{ $month->month }}">{{ $month->month }}</option>
        @endforeach
        
</select>