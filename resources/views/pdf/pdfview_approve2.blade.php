@include('pdf.pdf_decision_header')
   

<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	{{-- אנו מודים לך על השתתפותך במכרז לתפקיד {{$tendername}}.<br> --}}
	הריני להודיעך כי נבחר/ה מועמד/ת אחר/ת לתפקיד הנ"ל, יחד עם זאת החליטה ועדת המכרזים לבחור בך כמועמד/ת מספר שתיים.
במידה והמשרה הנ"ל תתפנה שוב במהלך השנה הקרובה, אנו נפנה אלייך לבדיקת רלוונטיות איוש המשרה, ללא צורך במכרז נוסף. 
אנו מודים לך על הגשת המועמדות ומאחלים לך הצלחה בהמשך דרכך.
	
	@if(isset($decision_3) && !empty($decision_3) && strlen($decision_3) > 0)
		<p>הערות:<br> {{$decision_3}} </p>
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
{{-- <img width="150" src="{{ asset('/img/signature.jpg') }}" alt=""> --}}
    </div>

@include('pdf.pdf_decision_footer')

