@include('pdf.pdf_decision_header')


<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	<div>
		הינך מוזמן/ת לראיון ראשוני ב &nbsp;{{$date}}, בשעה: {{$time}}, {{$place}}, אנא אשר/י הגעתך <a target="_blank" href="https://tcarmel.automas.co.il/approve-interview/{{$decId}}">בלינק הבא</a>.<br>
תודה ובהצלחה
	</div>
	@if(isset($msg) && !empty($msg) && strlen($msg) > 0)
		<p style="width: 100%">הערות:<br> {{$msg}} </p>
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
			<a href="https://www.tcarmel.automas.co.il">www.tcarmel.automas.co.il</a>
		</div>
		<div>
			<img src="{{ asset($app_dec?->tender_body_image ?? '/img/logo-b.png') }}">
		</div>
    </div>

@include('pdf.pdf_decision_footer')
