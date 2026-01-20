@include('pdf.pdf_decision_header')


<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	אנו שמחים להודיעך כי ועדת המכרזים שהתכנסה ביום {{$committee_date}} בחרה בך לתפקיד {{$tendername}}.<br>
מינויך כאמור כפוף להמלצות ולמעבר בהצלחה של מבדק מהימנות.<br>
בימים הקרובים יצרו איתך קשר ממכון "מידות" לתיאום מועד המבדק.<br><br>
	<b>אנו מאחלים לך הצלחה במילוי תפקידך.</b>	
</div>
	@if(isset($decision_3) && !empty($decision_3) && strlen($decision_3) > 0)
		<p>הערות:<br> {{$decision_3}} </p>
	@endif
	
	@if(isset($users) && !empty($users))
	<div style="margin-top: 250px;font-weight: normal;">
		<p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
	</div>
	@endif
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

