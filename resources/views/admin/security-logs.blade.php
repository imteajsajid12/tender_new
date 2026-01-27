@extends('layouts.admin.header')
@section('content')

<style>
    .security-log-container {
        padding: 20px;
        margin: 15px;
    }

    .log-card {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .log-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 15px 20px;
    }

    .log-card .card-body {
        padding: 20px;
    }

    .log-table {
        font-size: 13px;
        margin-bottom: 0;
    }

    .log-table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding: 10px 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .log-table tbody td {
        padding: 10px 12px;
        vertical-align: middle;
    }

    .log-table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .btn-action {
        padding: 4px 10px;
        font-size: 12px;
        margin-left: 5px;
    }

    .file-size {
        color: #6c757d;
        font-size: 12px;
    }

    .file-date {
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #dee2e6;
    }

    .page-header {
        margin-bottom: 0;
    }

    .log-stats-badge {
        background-color: #e9ecef;
        color: #495057;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        margin-right: 10px;
    }

    .btn-delete-disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>

<main id="main" class="main" style="overflow-x: hidden; min-width: 1200px;">
    <section class="section-topbar">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="py-3 px-3">
                    <h2 class="page-name page-header">יומן פעילות אבטחה</h2>
                </div>
                @if(count($logs) > 0)
                <div class="py-3 px-3">
                    <span class="log-stats-badge">{{ count($logs) }} קבצים זמינים</span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section-content">
        <div class="security-log-container">
            @if(session('error'))
                <div class="alert alert-danger" style="margin-bottom: 15px;">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 15px;">{{ session('success') }}</div>
            @endif

            <div class="card log-card">
                <div class="card-header">
                    <h5 style="margin: 0;">קבצי יומן זמינים</h5>
                </div>
                <div class="card-body">
                    @if(count($logs) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered log-table">
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
                                    @foreach($logs as $index => $log)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="file-date">{{ $log['date'] }}</td>
                                            <td>{{ $log['month'] }}</td>
                                            <td class="file-size">{{ number_format($log['size'] / 1024, 2) }} KB</td>
                                            <td>{{ $log['modified'] }}</td>
                                            <td>
                                                <a href="{{ route('security-log.show', ['date' => $log['date']]) }}"
                                                   class="btn btn-sm btn-outline-primary btn-action">
                                                    צפייה
                                                </a>
                                                <a href="{{ route('security-log.download', ['date' => $log['date']]) }}"
                                                   class="btn btn-sm btn-outline-secondary btn-action">
                                                    הורדה
                                                </a>
                                                @if(auth()->user() && (auth()->user()->id === 1 || in_array('1', explode(',', auth()->user()->role ?? ''))))
                                                <button onclick="confirmDelete('{{ $log['date'] }}')"
                                                        class="btn btn-sm btn-outline-danger btn-action">
                                                    מחק
                                                </button>
                                                @else
                                                <button disabled
                                                        class="btn btn-sm btn-outline-danger btn-action btn-delete-disabled"
                                                        title="נדרשת הרשאת הגדרות">
                                                    מחק
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div style="font-size: 48px; color: #dee2e6; margin-bottom: 15px;">📋</div>
                            <p>אין יומני אבטחה זמינים עדיין.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

<script>
/**
 * Confirm and delete security log file
 */
function confirmDelete(date) {
    Swal.fire({
        icon: 'warning',
        title: 'האם אתה בטוח?',
        html: `האם אתה בטוח שברצונך למחוק את יומן האבטחה לתאריך <strong>${date}</strong>?<br><br>` +
              '<span style="color: #dc3545; font-weight: bold;">פעולה זו לא ניתנת לביטול!</span>',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'כן, מחק',
        cancelButtonText: 'ביטול',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            deleteSecurityLog(date);
        }
    });
}

/**
 * Delete security log via AJAX
 */
function deleteSecurityLog(date) {
    // Show loading state
    Swal.fire({
        title: 'מוחק...',
        html: 'אנא המתן',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Send DELETE request
    fetch(`/admin/security-log/delete/${date}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'נמחק בהצלחה!',
                text: data.message,
                confirmButtonText: 'אישור'
            }).then(() => {
                // Reload the page to refresh the list
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'שגיאה',
                text: data.message || 'אירעה שגיאה במחיקת היומן',
                confirmButtonText: 'אישור'
            });
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        Swal.fire({
            icon: 'error',
            title: 'שגיאה',
            text: 'אירעה שגיאה בחיבור לשרת',
            confirmButtonText: 'אישור'
        });
    });
}
</script>

@endsection
