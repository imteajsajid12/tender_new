<div class="twofactor-settings-panel" id="twofactor-settings-panel">
    <div class="settings-header">
        <h3><i class="fa fa-shield"></i> הגדרות אימות דו-שלבי (2FA)</h3>
        <p class="text-muted">הגדרות אימות דו-שלבי למערכת - קוד OTP נשלח באימייל</p>
    </div>

    <form id="twofactor-settings-form">
        @csrf

        <div class="settings-section">
            <h4>הגדרות כלליות</h4>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">הפעל אימות דו-שלבי</label>
                <div class="col-sm-8">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="twofactor_enabled" name="enabled" checked>
                        <label class="custom-control-label" for="twofactor_enabled">
                            <span class="status-text enabled">מופעל</span>
                            <span class="status-text disabled">מושבת</span>
                        </label>
                    </div>
                    <small class="form-text text-muted">כאשר מופעל, המשתמשים יצטרכו להזין קוד אימות שנשלח לאימייל שלהם</small>
                </div>
            </div>
        </div>

        <div class="settings-section">
            <h4>הגדרות קוד OTP</h4>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="otp_length">אורך קוד OTP</label>
                <div class="col-sm-8">
                    <select class="form-control" id="otp_length" name="otp_length">
                        <option value="4">4 ספרות</option>
                        <option value="5">5 ספרות</option>
                        <option value="6" selected>6 ספרות (מומלץ)</option>
                        <option value="8">8 ספרות</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="otp_expiry">זמן תפוגה (דקות)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="otp_expiry" name="otp_expiry"
                           min="1" max="60" value="10">
                    <small class="form-text text-muted">הקוד יפוג לאחר מספר הדקות שנקבע (1-60)</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="max_attempts">מקסימום ניסיונות</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="max_attempts" name="max_attempts"
                           min="1" max="10" value="5">
                    <small class="form-text text-muted">מספר הניסיונות המרבי להזנת קוד שגוי (1-10)</small>
                </div>
            </div>
        </div>

        <div class="settings-section">
            <h4>הגבלת קצב</h4>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="rate_limit">מקסימום קודים לשעה</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="rate_limit" name="rate_limit"
                           min="1" max="50" value="10">
                    <small class="form-text text-muted">מספר הקודים המרבי שניתן לשלוח למשתמש בשעה</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="resend_cooldown">זמן המתנה לשליחה חוזרת (שניות)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="resend_cooldown" name="resend_cooldown"
                           min="30" max="300" value="60">
                    <small class="form-text text-muted">זמן ההמתנה בין בקשות לשליחה חוזרת של קוד (30-300 שניות)</small>
                </div>
            </div>
        </div>

        <div class="settings-section">
            <h4>זיכרון מכשיר</h4>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">אפשר זכירת מכשיר</label>
                <div class="col-sm-8">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="remember_device" name="remember_device" checked>
                        <label class="custom-control-label" for="remember_device">
                            <span class="status-text enabled">מופעל</span>
                            <span class="status-text disabled">מושבת</span>
                        </label>
                    </div>
                    <small class="form-text text-muted">מאפשר למשתמשים לדלג על אימות דו-שלבי במכשירים מוכרים</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="remember_days">ימים לזכירת מכשיר</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="remember_days" name="remember_days"
                           min="1" max="90" value="30">
                    <small class="form-text text-muted">מספר הימים שהמכשיר נזכר (1-90)</small>
                </div>
            </div>
        </div>

        <div class="settings-section">
            <h4>פטורים</h4>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="exempt_roles">תפקידים פטורים</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exempt_roles" name="exempt_roles"
                           placeholder="לדוגמה: admin,superuser">
                    <small class="form-text text-muted">תפקידים שפטורים מאימות דו-שלבי (מופרדים בפסיק)</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="ip_whitelist">כתובות IP מורשות</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="ip_whitelist" name="ip_whitelist"
                           placeholder="לדוגמה: 192.168.1.1,10.0.0.0/24">
                    <small class="form-text text-muted">כתובות IP שפטורות מאימות דו-שלבי (מופרדות בפסיק)</small>
                </div>
            </div>
        </div>

        <div class="settings-section statistics" id="twofactor-statistics">
            <h4>סטטיסטיקות היום</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-value" id="stat-sent">-</div>
                        <div class="stat-label">קודים נשלחו</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card success">
                        <div class="stat-value" id="stat-verified">-</div>
                        <div class="stat-label">אומתו בהצלחה</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card danger">
                        <div class="stat-value" id="stat-failed">-</div>
                        <div class="stat-label">ניסיונות כושלים</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="settings-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> שמור הגדרות
            </button>
            <button type="button" class="btn btn-secondary" id="refresh-settings">
                <i class="fa fa-refresh"></i> רענן
            </button>
        </div>

        <div class="alert alert-success mt-3" id="settings-success" style="display: none;">
            <i class="fa fa-check-circle"></i> <span class="message"></span>
        </div>
        <div class="alert alert-danger mt-3" id="settings-error" style="display: none;">
            <i class="fa fa-exclamation-circle"></i> <span class="message"></span>
        </div>
    </form>
</div>

<style>
.twofactor-settings-panel {
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.settings-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 15px;
    margin-bottom: 25px;
}

.settings-header h3 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.settings-header h3 i {
    color: #3498db;
    margin-left: 10px;
}

.settings-section {
    background: #f8f9fa;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 20px;
}

.settings-section h4 {
    color: #495057;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dee2e6;
}

/* RTL Custom Switch Styles */
.custom-control.custom-switch {
    padding-right: 3.5rem;
    padding-left: 0;
    min-height: 1.75rem;
    position: relative;
}

.custom-switch .custom-control-label {
    cursor: pointer;
    position: relative;
    margin-bottom: 0;
    vertical-align: top;
}

.custom-switch .custom-control-label::before {
    width: 2.75rem;
    height: 1.5rem;
    border-radius: 1.5rem;
    position: absolute;
    top: 0;
    right: -3.5rem;
    left: auto;
    background-color: #e9ecef;
    border: 1px solid #adb5bd;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

.custom-switch .custom-control-label::after {
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    right: calc(-3.5rem + 2px);
    left: auto;
    background-color: #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out;
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #28a745;
    border-color: #28a745;
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(-1.25rem);
    background-color: #fff;
}

.custom-control-input {
    position: absolute;
    right: 0;
    z-index: -1;
    opacity: 0;
}

.custom-control-label .status-text {
    padding-right: 15px;
    font-weight: 500;
    font-size: 14px;
    line-height: 1.5rem;
}

.status-text.disabled {
    display: inline;
    color: #dc3545;
}

.status-text.enabled {
    display: none;
    color: #28a745;
}

.custom-control-input:checked ~ .custom-control-label .status-text.disabled {
    display: none;
}

.custom-control-input:checked ~ .custom-control-label .status-text.enabled {
    display: inline;
}

.statistics {
    background: linear-gradient(135deg, #6ec270 0%, #4ba298 100%);

    color: #fff;
}

.statistics h4 {
    color: #fff;
    border-bottom-color: rgba(255,255,255,0.3);
}

.stat-card {
    background: rgba(255,255,255,0.15);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.stat-card.success {
    background: rgba(40, 167, 69, 0.3);
}

.stat-card.danger {
    background: rgba(220, 53, 69, 0.3);
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.85rem;
    opacity: 0.9;
}

.settings-actions {
    display: flex;
    gap: 10px;
    padding: 20px;
    background: #fff;
    border-radius: 6px;
    margin-top: 20px;
}

.settings-actions .btn {
    padding: 12px 30px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.settings-actions .btn i {
    margin-left: 8px;
}

.settings-actions .btn-primary {
  background: linear-gradient(135deg, #6ec270 0%, #4ba298 100%);
    border: none;
    color: #fff;
}

.settings-actions .btn-primary:hover {
   background: linear-gradient(135deg, #6ec270 0%, #4ba298 100%);

    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.settings-actions .btn-secondary {
    background: #6c757d;
    border: none;
    color: #fff;
}

.settings-actions .btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .form-group.row {
        flex-direction: column;
    }

    .col-sm-4, .col-sm-8 {
        width: 100%;
        max-width: 100%;
        flex: 0 0 100%;
    }

    .col-sm-4 {
        margin-bottom: 5px;
    }
}
</style>

<script>
$(document).ready(function() {
    // Load current settings
    loadTwoFactorSettings();
    loadStatistics();

    // Handle form submission
    $('#twofactor-settings-form').on('submit', function(e) {
        e.preventDefault();
        saveTwoFactorSettings();
    });

    // Refresh button
    $('#refresh-settings').on('click', function() {
        loadTwoFactorSettings();
        loadStatistics();
    });
});

function loadTwoFactorSettings() {
    $.ajax({
        url: '/admin/twofactor-settings',
        method: 'GET',
        success: function(data) {
            $('#twofactor_enabled').prop('checked', data.enabled);
            $('#otp_length').val(data.otp_length);
            $('#otp_expiry').val(data.otp_expiry);
            $('#max_attempts').val(data.max_attempts);
            $('#rate_limit').val(data.rate_limit);
            $('#resend_cooldown').val(data.resend_cooldown);
            $('#remember_device').prop('checked', data.remember_device);
            $('#remember_days').val(data.remember_days);
            $('#exempt_roles').val(data.exempt_roles);
            $('#ip_whitelist').val(data.ip_whitelist);
        },
        error: function(xhr) {
            showError('שגיאה בטעינת ההגדרות');
        }
    });
}

function loadStatistics() {
    $.ajax({
        url: '/admin/twofactor-settings/statistics',
        method: 'GET',
        success: function(data) {
            $('#stat-sent').text(data.total_otp_sent_today || 0);
            $('#stat-verified').text(data.total_otp_verified_today || 0);
            $('#stat-failed').text(data.failed_attempts_today || 0);
        },
        error: function() {
            // Silently fail for statistics
        }
    });
}

function saveTwoFactorSettings() {
    var formData = {
        _token: $('input[name="_token"]').val(),
        enabled: $('#twofactor_enabled').is(':checked') ? 1 : 0,
        otp_length: parseInt($('#otp_length').val()),
        otp_expiry: parseInt($('#otp_expiry').val()),
        max_attempts: parseInt($('#max_attempts').val()),
        rate_limit: parseInt($('#rate_limit').val()),
        resend_cooldown: parseInt($('#resend_cooldown').val()),
        remember_device: $('#remember_device').is(':checked') ? 1 : 0,
        remember_days: parseInt($('#remember_days').val()),
        exempt_roles: $('#exempt_roles').val(),
        ip_whitelist: $('#ip_whitelist').val()
    };

    $.ajax({
        url: '/admin/twofactor-settings',
        method: 'POST',
        data: formData,
        success: function(data) {
            if (data.success) {
                showSuccess(data.message);
            } else {
                showError(data.message || 'שגיאה בשמירת ההגדרות');
            }
        },
        error: function(xhr) {
            var message = 'שגיאה בשמירת ההגדרות';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                message = xhr.responseJSON.errors.join('<br>');
            }
            showError(message);
        }
    });
}

function showSuccess(message) {
    $('#settings-error').hide();
    $('#settings-success .message').html(message);
    $('#settings-success').fadeIn();
    setTimeout(function() {
        $('#settings-success').fadeOut();
    }, 5000);
}

function showError(message) {
    $('#settings-success').hide();
    $('#settings-error .message').html(message);
    $('#settings-error').fadeIn();
}
</script>
