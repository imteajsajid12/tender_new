@extends('layouts.admin.header')
@section('content')

<main id="main" class="main" style="overflow-x: hidden; min-width: 1200px;">
    <section class="section-topbar">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="py-4 px-3">
                    <h2 class="page-name">יומן פעילות אבטחה</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section-content">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 px-0">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>קבצי יומן זמינים</h4>
                        </div>
                        <div class="card-body">
                            @if(count($logs) > 0)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>תאריך</th>
                                            <th>חודש</th>
                                            <th>גודל קובץ</th>
                                            <th>עדכון אחרון</th>
                                            <th>פעולות</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $log)
                                            <tr>
                                                <td>{{ $log['date'] }}</td>
                                                <td>{{ $log['month'] }}</td>
                                                <td>{{ number_format($log['size'] / 1024, 2) }} KB</td>
                                                <td>{{ $log['modified'] }}</td>
                                                <td>
                                                    <a href="{{ route('security-log.download', ['date' => $log['date']]) }}"
                                                       class="btn btn-sm btn-primary">
                                                        הורדה
                                                    </a>
                                                    <a href="{{ route('security-log.show', ['date' => $log['date']]) }}"
                                                       class="btn btn-sm btn-secondary">
                                                        צפייה
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">אין יומני אבטחה זמינים עדיין.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


@endsection
