@include('pdf.pdf_decision_header')
   

<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	{{-- אנו מודים לך על השתתפותך במכרז לתפקיד {{$tendername}}.
ועדת המכרזים בחרה במועמד אחר לתפקיד, אנו מודים לך על התמודדותך ומאחלים לך בהצלחה.<br> --}}

הריני להודיעך כי נבחר/ה מועמד/ת אחר/ת לתפקיד הנ"ל.  <br>
אנו מודים לך על הגשת המועמדות ומאחלים לך הצלחה בהמשך דרכך.
	
@if(isset($decision_4) && !empty($decision_4) && strlen($decision_4) > 0)
	<p style="width: 100%">הערות:<br> {{$decision_4}} </p>
@endif
	
@if(isset($users) && !empty($users))
<div style="margin-top: 250px;font-weight: normal;">
	<p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
</div>
@endif
</div>
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

	<div class="signature">
		{{--  <img width="150" src="{{ asset('/img/signature.jpg') }}" alt=""> --}}
    </div>
@include('pdf.pdf_decision_footer')