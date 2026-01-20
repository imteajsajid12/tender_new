<table border="1">
	
	<tr><td>__/__/_____ תאריך המיון </td></tr>
		<!--<tr><td>שם הממיינ/ת _________________________</td></tr>-->
	<tr><td> ___________________ שם הממיינ/ת</td></tr>
	<tr><td> טבלה למיון {{$tname}} </td></tr>
	
    <tr>
		<td width="10">מס"ד</td>
	    <td width="10">שם המועמד</td>
		<td width="10">האם בוצע ראיון טלפוני/פנים אל פנים<br>(במידה ובוצע יש לציין תאריך הראיון)</td>
		<td width="10">מבקש/ת לזמן את המועמד למכרז<br></td>
        <td width="10">מבקש/ת לא לזמן את המועמד<br>(יש לפרט את הסיבות)</td>
    </tr>

	<!--<tr><td>{{$tname}} טבלה למיון </td></tr>
	<tr><td>שם הממיינ/ת _________________________</td></tr>
	<tr><td>תאריך המיון __/__/_____</td></tr>
    <tr>
        <td width="10">מבקש/ת לא לזמן את המועמד<br>(יש לפרט את הסיבות)</td>
        <td width="10">מבקש/ת לזמן את המועמד למכרז<br></td>
        <td width="10">האם בוצע ראיון טלפוני/פנים אל פנים<br>(במידה ובוצע יש לציין תאריך הראיון)</td>
		<td width="10">שם המועמד</td>
		<td width="10">מס"ד</td>
    </tr>-->
    @foreach ($arr as $key => $line)
        <tr>
			<td width="10">{{$key+1}}</td>
			<td width="10">{{$line['candidates_name']}}</td>
			<td width="10"></td>
			<td width="10"></td>
			<td width="10"></td>
			
				
			
					<!--	<td width="10"></td>
			<td width="10"></td>
			<td width="10"></td>
			<td width="10">{{$line['candidates_name']}}</td>
			<td width="10">{{$key+1}}</td>	-->
		</tr>
    @endforeach

</table>