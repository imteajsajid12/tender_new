<table border="1">
		<tr><td>סוג משרה {{$tender_type}}</td><td>אגף {{$brunch}}</td></tr>
	<tr><td>פרטי מועמדים למכרז למשרת {{$tname}}</td></tr>
	 <tr>
		<td width="10">שם המועמד</td>
		<td width="10">מסמכים להשלמה</td>
		<td width="10">בוצע זימון</td>
		<td width="10">טלפון נייד</td>
        <td width="10">מייל</td>
    </tr>

	
   
	
	<!--<tr><td>פרטי מועמדים למכרז למשרת {{$tname}}</td></tr>
	<tr><td>אגף {{$brunch}}</td><td>סוג משרה {{$tender_type}}</td></tr>
    <tr>
        <td width="10">מייל</td>
        <td width="10">טלפון נייד</td>
        <td width="10">בוצע זימון</td>
        <td width="10">מסמכים להשלמה</td>
		<td width="10">שם המועמד</td>
    </tr>-->
    @foreach ($arr as $line)
        <tr>
			<td width="10">{{$line['candidates_name']}}</td>
			<td width="10">{{$line['more_docs']}}</td>
			<td width="10">{{$line['is_invited']}}</td>
			<td width="10">{{$line['phone']}}</td>
			<td width="10">{{$line['email']}}</td>

				<!--<td width="10">{{$line['email']}}</td>
			<td width="10">{{$line['phone']}}</td>
			<td width="10">{{$line['is_invited']}}</td>
			<td width="10">{{$line['more_docs']}}</td>
			<td width="10">{{$line['candidates_name']}}</td>-->
		</tr>
    @endforeach

</table>
