@extends('layouts.sky_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="sky-card">
                <div style="text-align: center"><img src="{{ asset('img/logo.png') }}"></div>
                <div class="sky-login-container row">
                    <div class="card-body col-md-6">
                        {{-- Success/Error Messages --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show sky-rtl" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show sky-rtl" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger sky-rtl" role="alert">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('2fa.verify.submit') }}" id="otp-form">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="login-label sky-rtl">אימות דו-שלבי</div>
                                    <p class="sky-rtl text-muted" style="font-size: 14px; margin-bottom: 20px;">
                                        הזן את קוד האימות שנשלח לאימייל שלך
                                        <br>
                                        <strong>{{ $email }}</strong>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input
                                        placeholder="הזן קוד אימות"
                                        id="otp_code"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9]*"
                                        maxlength="{{ config('twofactor.otp_length', 6) }}"
                                        class="sky-rtl form-control otp-input{{ $errors->has('otp_code') ? ' is-invalid' : '' }}"
                                        name="otp_code"
                                        required
                                        autofocus
                                        autocomplete="one-time-code"
                                        style="text-align: center; font-size: 24px; letter-spacing: 8px; font-weight: bold;"
                                    >

                                    @if ($errors->has('otp_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('otp_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Timer Display --}}
                            @if($remainingTime && $remainingTime > 0)
                            <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    <small class="text-muted sky-rtl">
                                        קוד יפוג בעוד: <span id="countdown" class="text-primary font-weight-bold">{{ gmdate('i:s', $remainingTime) }}</span>
                                    </small>
                                </div>
                            </div>
                            @endif

                            {{-- Remember Device Option --}}
                            @if($rememberDeviceEnabled)
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check sky-rtl">
                                        <input class="form-check-input" type="checkbox" name="remember_device" id="remember_device" value="1">
                                        <label class="form-check-label" for="remember_device">
                                            זכור מכשיר זה ל-{{ $rememberDays }} ימים
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn sky-btn-primary login-btn" id="verify-btn">
                                        אמת
                                    </button>
                                </div>
                            </div>
                        </form>

                        {{-- Resend Code Section --}}
                        <div class="form-group row mt-3">
                            <div class="col-md-12 text-center">
                                <form method="POST" action="{{ route('2fa.resend') }}" id="resend-form" style="display: inline;">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="btn btn-link sky-rtl"
                                        id="resend-btn"
                                        {{ !$canResend ? 'disabled' : '' }}
                                        style="font-size: 14px;"
                                    >
                                        שלח קוד חדש
                                        @if(!$canResend)
                                            (<span id="resend-countdown">{{ $resendCooldown }}</span>)
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Back to Login --}}
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <a href="{{ route('2fa.cancel') }}" class="btn btn-link text-muted sky-rtl" style="font-size: 14px;">
                                    חזור לדף הכניסה
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 right-log" style="margin-top: 25px;">
                        <img src="{{ asset('img/logo-b.png') }}">

                        {{-- Security Tips --}}
                        <div class="mt-4 p-3 bg-light rounded sky-rtl" style="font-size: 12px;">
                            <strong>טיפים לאבטחה:</strong>
                            <ul class="mb-0 mt-2" style="padding-right: 20px;">
                                <li>לעולם אל תשתף את הקוד הזה עם אף אחד</li>
                                <li>צוות האתר לעולם לא יבקש ממך את הקוד</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // OTP Input - Only allow numbers
    const otpInput = document.getElementById('otp_code');
    if (otpInput) {
        otpInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Auto-submit when OTP is complete
        otpInput.addEventListener('keyup', function(e) {
            if (this.value.length === {{ config('twofactor.otp_length', 6) }}) {
                // Optional: auto-submit
                // document.getElementById('otp-form').submit();
            }
        });
    }

    // Countdown Timer for OTP expiry
    @if($remainingTime && $remainingTime > 0)
    let remainingSeconds = {{ $remainingTime }};
    const countdownEl = document.getElementById('countdown');

    const countdownInterval = setInterval(function() {
        remainingSeconds--;

        if (remainingSeconds <= 0) {
            clearInterval(countdownInterval);
            countdownEl.textContent = '00:00';
            countdownEl.classList.remove('text-primary');
            countdownEl.classList.add('text-danger');
            document.getElementById('verify-btn').disabled = true;
            // Show expired message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-warning mt-2 sky-rtl';
            alertDiv.textContent = 'קוד האימות פג תוקף. אנא בקש קוד חדש';
            otpInput.parentNode.appendChild(alertDiv);
        } else {
            const minutes = Math.floor(remainingSeconds / 60);
            const seconds = remainingSeconds % 60;
            countdownEl.textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

            // Change color when less than 1 minute
            if (remainingSeconds < 60) {
                countdownEl.classList.remove('text-primary');
                countdownEl.classList.add('text-warning');
            }
        }
    }, 1000);
    @endif

    // Resend Cooldown Timer
    @if(!$canResend)
    let resendCooldown = {{ $resendCooldown }};
    const resendBtn = document.getElementById('resend-btn');
    const resendCountdown = document.getElementById('resend-countdown');

    const resendInterval = setInterval(function() {
        resendCooldown--;

        if (resendCooldown <= 0) {
            clearInterval(resendInterval);
            resendBtn.disabled = false;
            resendBtn.innerHTML = 'שלח קוד חדש';
        } else {
            resendCountdown.textContent = resendCooldown;
        }
    }, 1000);
    @endif
});
</script>
@endpush

<style>
.otp-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.otp-input::placeholder {
    font-size: 14px;
    letter-spacing: normal;
}

#verify-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

#resend-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>
@endsection
