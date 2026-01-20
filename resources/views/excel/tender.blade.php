<table>
    <thead>
        <tr>
            <th>מספר מכרז</th>
            <th>שם המכרז</th>
            <th>מחלקה</th>
            <th>סטטוס מכרז</th>
            <th>התחלת המכרז</th>
            <th>סיום מכרז</th>
            <th>ספירת מועמדים</th>
            <th>היקף המשרה</th>
            <th>סוג מכרז</th>
            <th>הערת מכרז</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $tender)
            <tr>
                <td>{{ $tender->tender_number }}</td>
                <td>{{ $tender->tname }}</td>
                <td>{{ $tender->brunch }}</td>
                <td>
                    @php
                    $date = new DateTime();
                    $date->setTimezone(new DateTimeZone('Asia/Jerusalem'));
                    
                    $fdate = $date->format('Y-m-d H:i:s');
                    @endphp

                        @if ($fdate < $tender->finish_date && $tender->stopped == 0)
                        <span class="adminlighthdr">פעיל</span>
                        @elseif ($tender->stopped == 1)
                        <span class="adminlighthdr">מבוטל</span>
                        @else
                        <span class="adminlighthdr">לא פעיל</span>
                        @endif
                </td>
                <td>{{ $tender->start_date }}</td>
                <td>{{ $tender->finish_date }}</td>
                <td>{{ $tender->tender_data->applications_count }}</td>
                <td>{{ $tender->tender_data->job_scope }}</td>
                <td>{{ $tender->ttype== 1 ? 'מכרז פנימי' : 'מכרז חיצוני' }}</td>
                <td>{{ $tender->note_list }}</td>
            </tr>
        @endforeach
    </tbody>
</table>