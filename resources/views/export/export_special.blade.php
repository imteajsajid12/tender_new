<table border="1">
    <tr>

        <td width="10">         שם פרטי+שם משפחה</td>
        <td width="10">השכלה</td>
        <td width="10"> נסיון</td>
        <td width="10">שנים</td>




    </tr>
    @foreach ($arr as $line)
        @if ((isset($line["name"]) && $line["name"]!=='' && $line["name"]!==null) || ($line["educ"]!=='' && $line["educ"]!=' ')  || $line["descr"]!=='')
            <tr>
                <td>{{$line["name"]}}</td>
                <td>{{$line["educ"]}}</td>
                <td>{{isset($line["descr"])?$line["descr"]:""}}</td>

                <td>{{$line["years"]}}</td>


            </tr>
        @endif
    @endforeach

</table>
