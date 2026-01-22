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

    .log-entry {
        /* font-family: 'Courier New', monospace; */
        font-size: 12px;
        padding: 8px 12px;
        margin-bottom: 4px;
        border-radius: 4px;
        white-space: pre-wrap;
        word-break: break-word;
        line-height: 1.6;
        color: #000000;
        font-weight: 400;
    }

    /* Success - Green (login success with success=true) */
    .log-success {
        background-color: #d4edda;
        border-right: 3px solid #28a745;
    }

    /* Warning - Orange (WARN level) */
    .log-warn {
        background-color: #fff3cd;
        border-right: 3px solid #fd7e14;
    }

    /* Error/Failed - Red (success=false or ERROR level) */
    .log-error {
        background-color: #f8d7da;
        border-right: 3px solid #dc3545;
    }

    /* Info - Yellow/Light (INFO level - general actions) */
    .log-info {
        background-color: #fff9e6;
        border-right: 3px solid #ffc107;
    }

    /* Default */
    .log-default {
        background-color: #f8f9fa;
        border-right: 3px solid #6c757d;
    }

    .log-number {
        display: inline-block;
        min-width: 35px;
        color: #6c757d;
        font-weight: bold;
        margin-left: 8px;
        font-size: 11px;
    }

    /* User information highlighting */
    .user-email {
        color: #0066cc;
        font-weight: 600;
    }

    .user-name {
        color: #28a745;
        font-weight: 600;
    }

    .user-id {
        color: #6c757d;
        font-weight: 500;
    }

    .status-success {
        color: #28a745;
        font-weight: 700;
    }

    .status-failed {
        color: #dc3545;
        font-weight: 700;
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

    .log-entries {
        max-height: 600px;
        overflow-y: auto;
        padding: 10px;
        background-color: #fafafa;
        border-radius: 6px;
        border: 1px solid #e9ecef;
    }

    .log-header-actions {
        display: flex;
        gap: 10px;
    }

    .log-header-actions .btn {
        padding: 6px 12px;
        font-size: 13px;
    }

    .log-stats {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 10px;
    }
</style>

<main id="main" class="main" style="overflow-x: hidden; min-width: 1200px;">
    <section class="section-topbar">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="py-3 px-3">
                    <h2 class="page-name" style="margin: 0;">יומן אבטחה - {{ $date }}</h2>
                </div>
                <div class="py-3 px-3 log-header-actions">
                    <a href="{{ route('security-log.index') }}" class="btn btn-secondary">
                        חזרה לרשימה
                    </a>
                    <a href="{{ route('security-log.download', ['date' => $date]) }}" class="btn btn-primary">
                        הורדה
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-content">
        <div class="security-log-container">
            <div class="card log-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 style="margin: 0;">רשומות יומן</h5>
                    <span class="log-stats">{{ count($entries) }} רשומות סה"כ</span>
                </div>
                <div class="card-body">
                    <!-- Legend -->
                    <div class="log-legend">
                        <div class="legend-item">
                            <div class="legend-color legend-success"></div>
                            <span>הצלחה (✓ SUCCESS / LOGIN_SUCCESS)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-warn"></div>
                            <span>אזהרה (WARN)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-error"></div>
                            <span>כישלון (✗ FAILED)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-info"></div>
                            <span>מידע (INFO)</span>
                        </div>
                    </div>

                    @if(count($entries) > 0)
                        <div class="log-entries">
                            @foreach($entries as $index => $entry)
                                @php
                                    // Simple and consistent color logic
                                    $logClass = 'log-default';

                                    // Priority 1: Check for explicit success/failure status
                                    if (str_contains($entry, 'success=true')) {
                                        $logClass = 'log-success';
                                    }
                                    elseif (str_contains($entry, 'success=false')) {
                                        $logClass = 'log-error';
                                    }
                                    // Priority 2: Check for log level
                                    elseif (str_contains($entry, '| ERROR')) {
                                        $logClass = 'log-error';
                                    }
                                    elseif (str_contains($entry, '| WARN')) {
                                        $logClass = 'log-warn';
                                    }
                                    elseif (str_contains($entry, '| INFO')) {
                                        $logClass = 'log-info';
                                    }

                                    // Parse and enhance user information display
                                    $displayEntry = $entry;
                                    
                                    // Highlight email addresses
                                    $displayEntry = preg_replace(
                                        '/email=([^\s|]+)/',
                                        'email=<span class="user-email">$1</span>',
                                        $displayEntry
                                    );
                                    
                                    // Highlight user names
                                    $displayEntry = preg_replace(
                                        '/name=([^\s|]+)/',
                                        'name=<span class="user-name">$1</span>',
                                        $displayEntry
                                    );
                                    
                                    // Highlight user IDs
                                    $displayEntry = preg_replace(
                                        '/user_id=(user_\d+)/',
                                        'user_id=<span class="user-id">$1</span>',
                                        $displayEntry
                                    );
                                    
                                    // Highlight success/failure status for better visibility
                                    $displayEntry = preg_replace(
                                        '/success=true/',
                                        'success=<span class="status-success">✓ SUCCESS</span>',
                                        $displayEntry
                                    );
                                    
                                    $displayEntry = preg_replace(
                                        '/success=false/',
                                        'success=<span class="status-failed">✗ FAILED</span>',
                                        $displayEntry
                                    );
                                    
                                    // Highlight LOGIN_SUCCESS for completed logins
                                    $displayEntry = preg_replace(
                                        '/\| (LOGIN_SUCCESS\s+)/',
                                        '| <span class="status-success">$1</span>',
                                        $displayEntry
                                    );
                                @endphp
                                <div class="log-entry {{ $logClass }}">
                                    <span class="log-number">{{ $index + 1 }}.</span>{!! $displayEntry !!}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted" style="text-align: center; padding: 20px;">אין רשומות יומן לתאריך זה.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
