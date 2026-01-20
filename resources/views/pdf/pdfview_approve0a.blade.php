@include('pdf.pdf_decision_header')

<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	<div>
	לאחר בחינת המסמכים שהגשת, הננו לאשר כי הנך עומד/ת בתנאי הסף של המכרז.<br>
הודעה לגבי המשך ההליך וזימון לועדת בחינה תשלח בהמשך.<br>
תודה ובהצלחה
	</div>
	
	@if(isset($decision_1) && !empty($decision_1) && strlen($decision_1) > 0)
		<p>הערות:<br> {{$decision_1}} </p>
	@endif
	@if(isset($users) && !empty($users))
	<div style="margin-top: 50px;font-weight: normal;">
		<p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
	</div>
	@endif
</div>
<br><br><br>
<br>
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
	