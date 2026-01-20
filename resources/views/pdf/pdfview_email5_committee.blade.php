@include('pdf.pdf_decision_header')

<div style="text-align: right; font-size: 20px; letter-spacing: 0px;">

    <div>
        הינך מוזמן/ת לוועדת מכרזים בתאריך {{ $date }} בשעה {{ $time }} הוועדה תתכנס ב{{ $place }}.
        <br>

        <a target="_blank" href="{{ url('/approve-committee/' . $decId) }}">לאישור הגעה לחץ כאן</a>
        <br>

        <a target="_blank" href="{{ url('/cancel/' . $decId . '?src=second-invitation') }}">להסרת מועמדות לחץ כאן</a>
    </div>

    @if(strlen($msg) > 0)
        <p style="width: 100%">הערות:<br> {{ $msg }} </p>
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
    {{-- Use the configured app URL instead of hardcoded domain --}}
    <div>
        <!--<a href="{{ config('app.url') }}">{{ config('app.url') }}</a> -->
		<a href="www.kiryat-arba.muni.il">www.kiryat-arba.muni.il</a>
    </div>
    <div>
        <img src="{{ asset($app_dec?->tender_body_image ?? 'img/logo-b.png') }}">
    </div>
</div>

@include('pdf.pdf_decision_footer')
