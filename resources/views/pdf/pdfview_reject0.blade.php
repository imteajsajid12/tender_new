@include('pdf.pdf_decision_header')

<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	{{-- אנו מודים לך על הגשת מועמדותך למכרז מס' {{$tenderval}} בעיריית מעלה אדומים.<br> --}}

	הריני להודיעך כי לא נבחרת לתפקיד הנ"ל, עקב אי עמידה בתנאי הסף של המכרז. <br>
	אנו מודים לך על הגשת המועמדות ומאחלים לך הצלחה בהמשך דרכך.	@if(isset($comment) && !empty($comment) && strlen($comment) > 0 && $comment != $comment_text_reject_value)
		<p>הערות:<br> {{$comment}} </p>
	@endif
	@if(isset($users) && !empty($users))
	<div style="margin-top: 50px;font-weight: normal;">
		<p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
	</div>
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