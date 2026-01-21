	<footer class="apps-cart-footer container_s">
		<div class="row">
	        <!--<div class="sky-rtl col-md-6">
	            <img src="{{ asset('img/footer-menu-v2.png') }}" style="padding-left: 10px;margin-left: 6px;margin-top: -15px">
	        </div>-->
	        <div class="col-md-6">
	            אוטומס ©  כל הזכויות שמורות
	        </div>
		</div>
    </footer>
    <div id="fader"><img src="{{ asset('img/loader.gif') }}"></div>
	<script src="{{asset('js/main.js')}}"></script>
    <link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
    <script src="{{asset('js/datetimepicker.js')}}"></script>

    <!-- Auto Logout on Inactivity -->
    @auth
    <style>
        .auto-logout-modal {
            display: none;
            position: fixed;
            z-index: 99999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .auto-logout-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            direction: rtl;
        }

        .auto-logout-content h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 20px;
        }

        .auto-logout-content p {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .auto-logout-timer {
            font-size: 32px;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .auto-logout-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .auto-logout-buttons button {
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-stay {
            background-color: #28a745;
            color: #fff;
        }

        .btn-stay:hover {
            background-color: #218838;
        }

        .btn-logout {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>

    <!-- Warning Modal -->
    <div id="autoLogoutModal" class="auto-logout-modal">
        <div class="auto-logout-content">
            <h3>אזהרת התנתקות</h3>
            <p>בגלל חוסר פעילות, המערכת תתנתק אוטומטית בעוד:</p>
            <div class="auto-logout-timer" id="logoutCountdown">05:00</div>
            <div class="auto-logout-buttons">
                <button class="btn-stay" onclick="AutoLogout.stayLoggedIn()">הישאר מחובר</button>
                <button class="btn-logout" onclick="AutoLogout.logoutNow()">התנתק עכשיו</button>
            </div>
        </div>
    </div>

    <script>
        const AutoLogout = (function() {
            // Configuration
            const INACTIVE_TIMEOUT = 30 * 60 * 1000;  // 30 minutes in milliseconds
            const WARNING_TIME = 5 * 60 * 1000;       // 5 minutes warning before logout
            const COUNTDOWN_INTERVAL = 1000;          // Update countdown every second

            // State
            let inactivityTimer = null;
            let warningTimer = null;
            let countdownTimer = null;
            let countdownSeconds = 0;
            let isWarningShown = false;

            // DOM Elements
            let modal = null;
            let countdownDisplay = null;

            // Track user activity
            const activityEvents = [
                'mousedown',
                'mousemove',
                'keydown',
                'scroll',
                'touchstart',
                'click',
                'wheel'
            ];

            // Initialize
            function init() {
                modal = document.getElementById('autoLogoutModal');
                countdownDisplay = document.getElementById('logoutCountdown');

                if (!modal || !countdownDisplay) {
                    console.error('Auto-logout: Modal elements not found');
                    return;
                }

                // Add event listeners for user activity
                activityEvents.forEach(function(event) {
                    document.addEventListener(event, handleActivity, { passive: true });
                });

                // Start the inactivity timer
                resetTimer();

                console.log('Auto-logout initialized: 30 minutes timeout');
            }

            // Handle user activity
            function handleActivity() {
                if (!isWarningShown) {
                    resetTimer();
                }
            }

            // Reset the inactivity timer
            function resetTimer() {
                // Clear existing timers
                if (inactivityTimer) clearTimeout(inactivityTimer);
                if (warningTimer) clearTimeout(warningTimer);
                if (countdownTimer) clearInterval(countdownTimer);

                // Hide warning modal if shown
                if (isWarningShown) {
                    hideWarning();
                }

                // Set warning timer (triggers 5 minutes before logout)
                warningTimer = setTimeout(showWarning, INACTIVE_TIMEOUT - WARNING_TIME);

                // Set logout timer
                inactivityTimer = setTimeout(logoutNow, INACTIVE_TIMEOUT);
            }

            // Show warning modal
            function showWarning() {
                isWarningShown = true;
                modal.style.display = 'block';

                // Start countdown
                countdownSeconds = WARNING_TIME / 1000;
                updateCountdownDisplay();

                countdownTimer = setInterval(function() {
                    countdownSeconds--;
                    updateCountdownDisplay();

                    if (countdownSeconds <= 0) {
                        clearInterval(countdownTimer);
                        logoutNow();
                    }
                }, COUNTDOWN_INTERVAL);
            }

            // Hide warning modal
            function hideWarning() {
                isWarningShown = false;
                modal.style.display = 'none';
                if (countdownTimer) clearInterval(countdownTimer);
            }

            // Update countdown display
            function updateCountdownDisplay() {
                var minutes = Math.floor(countdownSeconds / 60);
                var seconds = countdownSeconds % 60;
                countdownDisplay.textContent =
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');
            }

            // Stay logged in - reset everything
            function stayLoggedIn() {
                hideWarning();
                resetTimer();
            }

            // Perform logout
            function logoutNow() {
                // Redirect to logout
                window.location.href = '/logout';
            }

            // Public API
            return {
                init: init,
                stayLoggedIn: stayLoggedIn,
                logoutNow: logoutNow,
                resetTimer: resetTimer
            };
        })();

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                AutoLogout.init();
            });
        } else {
            AutoLogout.init();
        }
    </script>
    @endauth

</body>
</html>
