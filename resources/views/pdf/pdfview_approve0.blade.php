@include('pdf.pdf_decision_header')

<div style="text-align: right; font-size: 20px; letter-spacing: 0px;">
	<div>
		אנו מודים לך על הגשת מועמדותך למכרז מס' {{ $tenderval }} במועצה מקומית קריית ארבע חברון.<br>
		לצורך תאום ציפיות שכר, אנו רוצים להבהיר כי השכר המוצע לתפקיד הנוכחי הינו {{ $desired_hourly_rate_value }}.<br>

		במידה והשכר המוצע לתפקיד הנ"ל תואם את ציפיותיך, נא לחץ
		<a target="_blank" href="{{ url('/approve/' . $decId) }}">כאן</a>, לטובת המשך התהליך.<br>

		במידה והשכר המוצע לתפקיד הנ"ל אינו תואם את ציפיותיך, להסרת מועמדות, יש ללחוץ
		<a target="_blank" href="{{ url('/cancel/' . $decId) }}">כאן.</a>
	</div>

	@if(!empty($decision_1))
		<p>הערות:<br>{{ $decision_1 }}</p>
	@endif

	@if(!empty($users))
		<div style="margin-top: 50px; font-weight: normal;">
			<p style="line-height: 40px;">העתקים:<br>{!! $users !!}</p>
		</div>
	@endif
</div>

<br><br><br><br>

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
	<div>
		<a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
	</div>
	<div>
		<img src="{{ asset($app_dec?->tender_body_image ?? 'img/logo-b.png') }}">
	</div>
</div>

@include('pdf.pdf_decision_footer')
