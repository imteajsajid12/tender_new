@include('pdf.pdf_decision_header')

<div style="text-align: right; font-size: 20px; letter-spacing: 0px;">
    <div>
        <img src="{{ asset('img/allok.png') }}" alt=""> בהמשך להגשת מועמדותך, עליך לעבור מבחן מקוון במכון {{ $test_info['place'][0] }} <br>
        <img src="{{ asset('img/allok.png') }}" alt=""> הקישור למבחן יישלח ממכון {{ $test_info['place'][0] }} בשעה 08:00 ויהיה זמין עד חצות. <br>
        <img src="{{ asset('img/allok.png') }}" alt=""> תמיכה טכנית פעילה עד השעה 16:00. <br>
        <img src="{{ asset('img/allok.png') }}" alt=""> יש להיבחן מול מחשב נייד/נייח עם מצלמה פעילה. <br>
        <img src="{{ asset('img/allok.png') }}" alt=""> אורך המבחן כ־5-6 שעות. <br>

        <b>לבחירתך, מועדים אפשריים – אנא בחר את המועד המועדף עליך.<br></b>

        @foreach ($test_info['date'] as $date)
            <a target="_blank" href="{{ url('/approve-test/' . $decId) }}?date={{ $date }}">{{ str($date)->before(' ') }}</a>
            <br>
        @endforeach
    </div>

    @if(isset($msg) && !empty($msg) && strlen($msg) > 0)
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
    <div>
        <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
    </div>
    <div>
        <img src="{{ asset($app_dec?->tender_body_image ?? 'img/logo-b.png') }}">
    </div>
</div>

@include('pdf.pdf_decision_footer')
