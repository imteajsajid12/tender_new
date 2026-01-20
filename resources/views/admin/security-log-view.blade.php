@extends('layouts.admin.header')
@section('content')

<main id="main" class="main" style="overflow-x: hidden; min-width: 1200px;">
    <section class="section-topbar">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="py-4 px-3">
                    <h2 class="page-name">Security Log - {{ $date }}</h2>
                </div>
                <div class="py-4 px-3">
                    <a href="{{ route('security-log.index') }}" class="btn btn-secondary">
                        Back to List
                    </a>
                    <a href="{{ route('security-log.download', ['date' => $date]) }}" class="btn btn-primary">
                        Download
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
                        <div class="card-header">
                            <h4>Log Entries ({{ count($entries) }} total)</h4>
                        </div>
                        <div class="card-body">
                            @if(count($entries) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" style="font-family: monospace; font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th>Log Entry</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($entries as $index => $entry)
                                                <tr class="@if(str_contains($entry, '| WARN')) table-warning @elseif(str_contains($entry, '| ERROR')) table-danger @endif">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td style="white-space: pre-wrap;">{{ $entry }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No log entries for this date.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
