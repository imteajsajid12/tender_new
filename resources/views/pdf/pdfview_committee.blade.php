@include('pdf.pdf_decision_header')


<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	@php
		$committee_meetings_arr = explode(',', $committee_meetings);
		$committee_meeting_data_arr = explode(',', $committee_meeting_data);
	@endphp
	{{-- <div>הינך מוזמן/ת לוועדת מכרזים בתאריך {{ $date }} בשעה {{ $time }}. הוועדה תתכנס ב־{{ $place }}. --}}

		@if (in_array(1, $committee_meetings_arr))
			@php
				$index = array_search(1, $committee_meetings_arr);
				$start_hour = explode('###',$committee_meeting_data_arr[$index]);
			@endphp
			<div>הינך מוזמן/ת לוועדת מכרזים בתאריך {{ $start_hour[0] }} בשעה {{ $start_hour[1] }} הוועדה תתכנס ב{{ $start_hour[2] }}.</div>
		@endif

		@if (in_array(2, $committee_meetings_arr))
			@php
				$index = array_search(2, $committee_meetings_arr);
			@endphp
			<div>כמה דקות כל פגישה : {{ $committee_meeting_data_arr[$index] }} </div>
		@endif

		@if (in_array(3, $committee_meetings_arr))
			@php
				$index = array_search(3, $committee_meetings_arr);
			@endphp
			<div>אחרי כמה פגישות תהיה לנו הפסקה : {{ $committee_meeting_data_arr[$index] }} </div>
		@endif

		@if (in_array(4, $committee_meetings_arr))
			@php
				$index = array_search(4, $committee_meetings_arr);
			@endphp
			<div>אחרי כמה פגישות תהיה הפסקה : {{ $committee_meeting_data_arr[$index] }} </div>
		@endif
		

</div>
<style>
.signature {
				margin-top: 150px;
				margin-bottom: 50px;
                font-size: 20px;
                height: 100px;
                width: 100%;
                text-align: left;
				display: flex;
				flex-direction: column;
            }
        </style>

	<div class="signature">
		{{-- <img width="150" src="{{ asset('/img/signature.jpg') }}" alt=""> --}}
		<div>
			<a href="https://www.kiryat-arba.muni.il/">www.kiryat-arba.muni.il</a>
		</div>
		<div>
			<img src="{{ asset($app_dec?->tender_body_image ?? '/img/logo-b.png') }}">
		</div>
    </div>

@include('pdf.pdf_decision_footer')
