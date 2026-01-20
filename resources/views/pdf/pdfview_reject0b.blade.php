@include('pdf.pdf_decision_header')

<div style="text-align: right;font-size:20px;letter-spacing: 0px;">
	<div>
	{{-- קיבלנו את הודעתך בדבר הסרת מועמדותך למכרז שבנדון.<br>
הננו מאחלים לך הצלחה בהמשך דרכך. --}}

הריני להודיעך כי רשמנו לפנינו את בקשתך להסרת המועמדות לתפקיד הנ"ל. <br>
אנו מודים לך על הגשת המועמדות ומאחלים לך הצלחה בהמשך דרכך.
	</div>
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
	