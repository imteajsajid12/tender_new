
<style>
	@isset($isView)
    input{
        background-color: white !important;
    }
    .form-control:focus{
        box-shadow: none;
    }
    @endisset
    
    label>input,label{
        font-weight:bold
    }
    #header_title{
        box-shadow: none;
        border: none;
    }
    [id*="application_rules"]{
        font-weight: bold
    }
</style>