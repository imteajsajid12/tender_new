<table border="1">
    <tr>
		<td width="10">מספר מכרז</td>
		<td width="10">שם מכרז</td>
		<td width="10">אגף/מחלקה</td>
		<td width="10">סוג מכרז</td>
		<td width="10">משרה חדשה/קיימת</td>
		<td width="10">פורסם מתאריך עד תאריך</td>
		<td width="10">מספר מועמדים שניגשו</td>
		<td width="10">מספר מועמדים שעברו תנאי סף</td>
		<td width="10">מספר מועמדים שזומנו</td>
		<td width="10">תאריך ועדת בחינה</td>
        <td width="10">סטטוס</td>
      
       <!--<td width="10">סטטוס</td>
        <td width="10">תאריך ועדת בחינה</td>
        <td width="10">מספר מועמדים שזומנו</td>
        <td width="10">מספר מועמדים שעברו תנאי סף</td>
		<td width="10">מספר מועמדים שניגשו</td>
		<td width="10">פורסם מתאריך עד תאריך</td>
		<td width="10">משרה חדשה/קיימת</td>
		<td width="10">סוג מכרז</td>
		<td width="10">אגף/מחלקה</td>
		<td width="10">שם מכרז</td>
		<td width="10">מספר מכרז</td>-->

    </tr>
    @foreach ($arr as $line)
        <tr>	
			<td width="10">{{$line['generated_id']}}</td>
			<td width="10">{{$line['tname']}}</td>
			<td width="10">{{$line['brunch']}}</td>
			<td width="10">{{$line['ttype']}}</td>
			<td width="10">{{$line['is_exist']}}</td>
			<td width="10">{{$line['from_to_date']}}</td>
			<td width="10">{{$line['candidates_approached']}}</td>
			<td width="10">{{$line['candidates_passed_thresholds']}}</td>
			<td width="10">{{$line['candidates_invited']}}</td>
			<td width="10">{{$line['committee_date']}}</td>
			<td width="10">{{$line['status']}}</td>
	
		</tr>
    @endforeach

</table>
