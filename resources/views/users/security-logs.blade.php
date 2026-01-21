<div class="security-logs-panel" id="security-logs-panel">
    <div class="settings-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><i class="fa fa-file-text"></i> יומן פעילות אבטחה</h3>
                <p class="text-muted">צפייה והורדה של יומני אבטחת המערכת</p>
            </div>
            @if(isset($securityLogs) && count($securityLogs) > 0)
            <span class="logs-count-badge">{{ count($securityLogs) }} קבצים זמינים</span>
            @endif
        </div>
    </div>

    <div class="logs-container">
        @if(isset($securityLogs) && count($securityLogs) > 0)
            <div class="table-responsive">
                <table class="table table-bordered logs-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">תאריך</th>
                            <th style="width: 15%;">חודש</th>
                            <th style="width: 15%;">גודל קובץ</th>
                            <th style="width: 25%;">עדכון אחרון</th>
                            <th style="width: 20%;">פעולות</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($securityLogs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="file-date">{{ $log['date'] }}</td>
                                <td>{{ $log['month'] }}</td>
                                <td class="file-size">{{ number_format($log['size'] / 1024, 2) }} KB</td>
                                <td>{{ $log['modified'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-action" onclick="viewSecurityLog('{{ $log['date'] }}')">
                                        <i class="fa fa-eye"></i> צפייה
                                    </button>
                                    <a href="{{ route('security-log.download', ['date' => $log['date']]) }}" class="btn btn-sm btn-outline-secondary btn-action">
                                        <i class="fa fa-download"></i> הורדה
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fa fa-folder-open-o"></i>
                </div>
                <p>אין יומני אבטחה זמינים עדיין.</p>
            </div>
        @endif
    </div>
</div>

<!-- Log View Modal -->
<div class="modal fade" id="securityLogViewModal" tabindex="-1" role="dialog" aria-labelledby="securityLogViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="securityLogViewModalLabel">צפייה ביומן</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="security-log-view-loading" class="text-center py-4">
                    <img src="{{ asset('img/loader.gif') }}" style="width: 40px;">
                    <p class="mt-2 text-muted">טוען יומן...</p>
                </div>
                <div id="security-log-view-content" style="display: none;">
                    <!-- Legend -->
                    <div class="log-legend">
                        <div class="legend-item">
                            <div class="legend-color legend-success"></div>
                            <span>הצלחה</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-warn"></div>
                            <span>אזהרה</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-error"></div>
                            <span>כישלון</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-info"></div>
                            <span>מידע</span>
                        </div>
                    </div>
                    <div class="log-entries-container"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">סגור</button>
            </div>
        </div>
    </div>
</div>

<style>
.security-logs-panel {
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.security-logs-panel .settings-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 15px;
    margin-bottom: 25px;
}

.security-logs-panel .settings-header h3 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.security-logs-panel .settings-header h3 i {
    color: #e74c3c;
    margin-left: 10px;
}

.logs-count-badge {
   background: linear-gradient(135deg, #6ec270 0%, #4ba298 100%);
    color: #fff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

.logs-table {
    margin-bottom: 0;
    font-size: 13px;
}

.logs-table thead th {
    background: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    padding: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.logs-table tbody td {
    padding: 12px;
    vertical-align: middle;
}

.logs-table tbody tr:hover {
    background: #f5f5f5;
}

.logs-table .file-date {
    font-weight: 500;
    color: #2c3e50;
}

.logs-table .file-size {
    color: #6c757d;
}

.logs-table .btn-action {
    padding: 6px 12px;
    font-size: 12px;
    margin-left: 5px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 4px;
}

.logs-table .btn-action i {
    margin-left: 3px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
    background: #f8f9fa;
    border-radius: 8px;
}

.empty-state .empty-icon {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 20px;
}

/* Modal Styles */
#securityLogViewModal .modal-dialog {
    max-width: 90%;
}

#securityLogViewModal .modal-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

#securityLogViewModal .modal-title {
    font-weight: 600;
}

.log-legend {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    padding: 10px 15px;
    background-color: #f8f9fa;
    border-radius: 6px;
    flex-wrap: wrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
}

.legend-color {
    width: 14px;
    height: 14px;
    border-radius: 3px;
}

.legend-success { background-color: #28a745; }
.legend-warn { background-color: #fd7e14; }
.legend-error { background-color: #dc3545; }
.legend-info { background-color: #ffc107; }

.log-entries-container {
    max-height: 500px;
    overflow-y: auto;
    padding: 10px;
    background-color: #fafafa;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.log-entry {
    font-size: 11px;
    padding: 6px 10px;
    margin-bottom: 3px;
    border-radius: 3px;
    white-space: pre-wrap;
    word-break: break-word;
    line-height: 1.4;
    color: #000000;
}

.log-success {
    background-color: #d4edda;
    border-right: 3px solid #28a745;
}

.log-warn {
    background-color: #fff3cd;
    border-right: 3px solid #fd7e14;
}

.log-error {
    background-color: #f8d7da;
    border-right: 3px solid #dc3545;
}

.log-info {
    background-color: #fff9e6;
    border-right: 3px solid #ffc107;
}

.log-default {
    background-color: #f8f9fa;
    border-right: 3px solid #6c757d;
}

.log-number {
    display: inline-block;
    min-width: 30px;
    color: #6c757d;
    font-weight: bold;
    margin-left: 8px;
    font-size: 10px;
}
</style>

<script>
function viewSecurityLog(date) {
    $('#securityLogViewModalLabel').text('יומן אבטחה - ' + date);
    $('#security-log-view-loading').show();
    $('#security-log-view-content').hide();
    $('#securityLogViewModal').modal('show');

    $.ajax({
        url: '/admin/security-log/view/' + date,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#security-log-view-loading').hide();

            if (response && response.entries) {
                var html = '';
                response.entries.forEach(function(entry, index) {
                    var logClass = 'log-default';

                    if (entry.indexOf('success=true') !== -1) {
                        logClass = 'log-success';
                    } else if (entry.indexOf('success=false') !== -1) {
                        logClass = 'log-error';
                    } else if (entry.indexOf('| ERROR') !== -1) {
                        logClass = 'log-error';
                    } else if (entry.indexOf('| WARN') !== -1) {
                        logClass = 'log-warn';
                    } else if (entry.indexOf('| INFO') !== -1) {
                        logClass = 'log-info';
                    }

                    html += '<div class="log-entry ' + logClass + '">' +
                        '<span class="log-number">' + (index + 1) + '.</span>' +
                        escapeHtml(entry) +
                    '</div>';
                });

                $('.log-entries-container').html(html);
                $('#security-log-view-content').show();
            }
        },
        error: function(xhr) {
            $('#security-log-view-loading').hide();

            // Try to fetch as HTML and parse
            $.ajax({
                url: '/admin/security-log/view/' + date,
                method: 'GET',
                success: function(html) {
                    var $html = $(html);
                    var entries = [];
                    $html.find('.log-entry').each(function() {
                        entries.push($(this).text());
                    });

                    if (entries.length > 0) {
                        var entriesHtml = '';
                        entries.forEach(function(entry, index) {
                            var logClass = 'log-default';

                            if (entry.indexOf('success=true') !== -1) {
                                logClass = 'log-success';
                            } else if (entry.indexOf('success=false') !== -1) {
                                logClass = 'log-error';
                            }

                            entriesHtml += '<div class="log-entry ' + logClass + '">' + escapeHtml(entry) + '</div>';
                        });

                        $('.log-entries-container').html(entriesHtml);
                    } else {
                        $('.log-entries-container').html('<p class="text-center text-muted">לא ניתן לטעון את תוכן היומן</p>');
                    }
                    $('#security-log-view-content').show();
                },
                error: function() {
                    $('.log-entries-container').html('<p class="text-center text-danger">שגיאה בטעינת היומן</p>');
                    $('#security-log-view-content').show();
                }
            });
        }
    });
}

function escapeHtml(text) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>
