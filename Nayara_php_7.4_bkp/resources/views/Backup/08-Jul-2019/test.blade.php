<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
	<title></title>
</head>
<!-- <body>
	<input type="hidden" class="states_url" value="{{route('populate_states')}}" >
<p>Done</p>
<select class="add-states"></select>
<select class="add-district"></select> -->
<input type="hidden" name="country" id="countryId" value="IN"/>
<select name="state" class="states order-alpha" id="stateId">
    <option value="">Select State</option>
</select>
<select name="city" class="cities order-alpha" id="cityId">
    <option value="">Select City</option>
</select>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//geodata.solutions/includes/statecity.js"></script>
<!-- <script type="text/javascript" src="{{asset('js/apply-online.js')}}"></script> -->
</body>
</html>