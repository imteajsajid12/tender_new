window.onload = ()=>{
    for (data in datas){
        if(document.getElementById(data)!= null){
            if(document.getElementById(data).tagName=='INPUT'){
                console.log('iput '+data, datas[data].value);
                
                document.getElementById(data).value = datas[data].value
            }else{
                document.getElementById(data).innerText = datas[data].value
            }
        }
    }
}