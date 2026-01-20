jQuery(function($) {
    $(document).on("submit","form.request",function(e) {
        e.preventDefault();
        var input = $(this).find('input');

        if (!input.val())
            return input.css('border', '1px solid red');


        passID = input.val();
        input.css('border', '1px solid #cccccc');
        $('#fader').css('display', 'block');
        var data = new FormData();
        data.append('pass_id', passID);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:$(this).attr('action'),
            data: data,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var res = JSON.parse(data);

                if(res.error){
                    alert(res.error);
                }else{
                    $('.response').html(res.data);
                    $('.content').addClass('content--response');
                }
                $('#fader').css('display', 'none');
                input.val('');
            }
        });
    });
    $(document).on("click",".stop-app-s",function(e) {
        e.preventDefault();
        $('#fader').css('display', 'block');
        var data = [];
		if (confirm("עצירת פניה זו תגרום להסרת מועמדותך. האם אתה בטוח?")){
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:$(this).attr('href'),
				data: data,
				type: 'POST',
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {
					if(data != 'success'){
						alert(data);
					}else{
						$('.content').removeClass('content--response');
						$('.response').html('');
					}
					$('#fader').css('display', 'none');
				}
			});
		} else {
			$('#fader').css('display', 'none');
		}
    });
    $(document).on("click",".cansel-request",function(e) {
        e.preventDefault();
        $('.content').removeClass('content--response');
        $('.response').html('');
    });

});
