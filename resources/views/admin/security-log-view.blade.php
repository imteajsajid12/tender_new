@extends('layouts.admin.header')
@section('content')

<style>
    .log-entry {
        font-family: monospace;
        font-size: 12px;
        padding: 8px 12px;
        margin-bottom: 4px;
        border-radius: 4px;
        white-space: pre-wrap;
        word-break: break-word;
    }

    /* Success - Green */
    .log-success {
        background-color: #d4edda;
        border-right: 4px solid #28a745;
        color: #155724;
    }

    /* Warning - Orange */
    .log-warn {
        background-color: #fff3cd;
        border-right: 4px solid #ffc107;
        color: #856404;
    }

    /* Error/Failed - Red */
    .log-error {
        background-color: #f8d7da;
        border-right: 4px solid #dc3545;
        color: #721c24;
    }

    /* Info - Yellow/Light */
    .log-info {
        background-color: #fff9e6;
        border-right: 4px solid #ffc107;
        color: #664d03;
    }

    /* Default */
    .log-default {
        background-color: #f8f9fa;
        border-right: 4px solid #6c757d;
        color: #495057;
    }

    .log-number {
        display: inline-block;
        min-width: 40px;
        color: #6c757d;
        font-weight: bold;
        margin-left: 10px;
    }

    .log-legend {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
    }

    .legend-success { background-color: #28a745; }
    .legend-warn { background-color: #ffc107; }
    .legend-error { background-color: #dc3545; }
    .legend-info { background-color: #ffd700; }
</style>

<main id="main" class="main" style="overflow-x: hidden; min-width: 1200px;">
    <section class="section-topbar">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="py-4 px-3">
                    <h2 class="page-name">יומן אבטחה - {{ $date }}</h2>
                </div>
                <div class="py-4 px-3">
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
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 px-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>רשומות יומן ({{ count($entries) }} סה"כ)</h4>
                        </div>
                        <div class="card-body">
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

                            @if(count($entries) > 0)
                                <div class="log-entries">
                                    @foreach($entries as $index => $entry)
                                        @php
                                            // Determine log type based on content
                                            $logClass = 'log-default';

                                            // Check for success=true or LOGIN_SUCCESS
                                            if (str_contains($entry, 'success=true') || str_contains($entry, 'LOGIN_SUCCESS')) {
                                                $logClass = 'log-success';
                                            }
                                            // Check for WARN level or success=false
                                            elseif (str_contains($entry, '| WARN') || str_contains($entry, 'success=false')) {
                                                if (str_contains($entry, 'success=false')) {
                                                    $logClass = 'log-error';
                                                } else {
                                                    $logClass = 'log-warn';
                                                }
                                            }
                                            // Check for ERROR level
                                            elseif (str_contains($entry, '| ERROR')) {
                                                $logClass = 'log-error';
                                            }
                                            // Check for INFO level
                                            elseif (str_contains($entry, '| INFO')) {
                                                // INFO with success indicators
                                                if (str_contains($entry, 'SUCCESS') || str_contains($entry, 'DOWNLOAD') || str_contains($entry, 'APPROVE')) {
                                                    $logClass = 'log-success';
                                                } else {
                                                    $logClass = 'log-info';
                                                }
                                            }
                                        @endphp
                                        <div class="log-entry {{ $logClass }}">
                                            <span class="log-number">{{ $index + 1 }}.</span>{{ $entry }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">אין רשומות יומן לתאריך זה.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
