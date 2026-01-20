@include('pdf.pdf_decision_header')


<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	{{-- אנו שמחים להודיעך כי ועדת המכרזים שהתכנסה ביום {{$committee_date}} בחרה בך לתפקיד {{$tendername}}.<br><br>
אנו מאחלים לך הצלחה במילוי תפקידך. --}}

הריני להודיעך בשם ועדת המכרזים, כי נבחרת לתפקיד הנ"ל. <br>
במהלך קליטתך לתפקיד, תלווה אותך רפרנטית מחלקת קליטה וארגון.  <br>
אנו מאחלים לך הצלחה ועבודה פורייה בתפקידך. <br>

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
	margin-top: 50px;
	margin-bottom: 50px;
	font-size: 20px;
	height: 100px;
	width: 100%;
	text-align: left;
	}
</style>

	<div class="signature">{{-- <img width="150" src="{{ asset('/img/signature.jpg') }}" alt=""> --}}           
    </div>

@include('pdf.pdf_decision_footer')

