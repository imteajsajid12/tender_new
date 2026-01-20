jQuery( document ).ready(function($) {
	
	var options = $('#pref_tender_brunch option');
var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
options.each(function(i, o) {
  o.value = arr[i].v;
  $(o).text(arr[i].t);
});
    /*
	$(document).click(function(){
        $('.cancel_file_content').remove();
        $('.apps-btn').removeClass('beforecolor');
        $('.file-content, #buttons-content').removeClass('margin-b200');
    })
    $(document).on("click",".cancel_file_content",function(event) {
        event.stopPropagation();
    })
	*/
    //signature();
	$('.send_all').change(function(e) {
        send_all_change($(this));
    });
	
	function send_all_change(elem){
		const val = elem.val();//decision name
		let app_ids = [];//apps_decisions ids
		$('input[name="send_all"]').each(function( index ) {
  			if(this.checked){
				let id = $(this).attr('data-val');
				app_ids.push(id);
			}
		});
		
		if(app_ids.length > 0){
			const data = {
				'view': val,
				'app_ids': app_ids
			};
			$('#send-all').click(()=>{
				console.log(data);
				send_all_decision(data);
				elem.val(0);
			});
		} else {
			alert('לא נבחרה פניה');
			elem.val(0);
		}
	}
	
	function send_all_decision(data){
		if (data){			
			var form_data = new FormData();
			form_data.append('view', data.view);
			form_data.append('app_ids', data.app_ids);
            
		    let committee_meetings = []; 
            let committee_meeting_data = [];
            $('input[name="committee_meeting"]').each(function( index ) {
                if(this.checked){
                    committee_meetings.push($(this).val());
                    if ($(this).val() == 1) {
                        committee_meeting_data.push(
                            $("#meeting_date").val()+'###'+$("#meeting_time").val()+'###'+$("#meeting_location").val()
                        );
                    } else if ($(this).val() == 2) {
                        committee_meeting_data.push($("#minutes").val());
                    } else if ($(this).val() == 3) {
                        committee_meeting_data.push($("#pluse_meeting").val());
                    } else if ($(this).val() == 4) {
                        committee_meeting_data.push($("#pluse_meeting_time").val());
                    }
                }
            });
			form_data.append('committee_meetings', committee_meetings);
			form_data.append('committee_meeting_data', committee_meeting_data);
			$('#fader').css('display', 'block');
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"/admin/ajax/send-all-decision",
				data: form_data,
				type: 'POST',
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {
					$('#fader').css('display', 'none');
					const res = JSON.parse(data);
					$('.outer').append('<span>' + res.message + '</span>');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.status);
					console.log(thrownError);
				}
			});
		} else {
			console.log('data is empty');
		}
	}

	$(document).on("change", "#download-cv-app-ids", function(e){
		 //e.preventDefault();
		const val = $(this).val();
		let app_ids = [];//apps_decisions ids
		let  stringToSend= '';
	if(val ==1){
		
		$('input[name="send_all"]').each(function( index ) {
  			if(this.checked){
				let id = $(this).attr('data-val');
				app_ids.push(id);
			}
		});
		if(app_ids.length == 0){
			  //var  stringToSend = "?app_ids=" +app_ids.join(",") ;
			// window.location.href = $(this).attr('href') + stringToSend;
			alert('לא נבחרה פניה');
		}
		}else{
			 var params = $.fn.getUrlParams();
            var tenderid = params.tenderid;
			stringToSend = (tenderid && tenderid.length > 0 ? '/' + tenderid : '');
			if(stringToSend == '') {alert('לא נבחר מכרז'); return false;}
			
		}
		stringToSend= stringToSend + "?type=" + val;
					  stringToSend = (app_ids.length > 0) ? stringToSend + "&app_ids=" +app_ids.join(",") : stringToSend ;
			 window.location.href = "/admin/tenders/cvfiledownload" + stringToSend;
	
		
	
	});
	
	$(document).on("click", "#add-user-outapp-form", function(e){
		event.stopPropagation();
		if ($('.outer').css('display') == 'none'){
			$('.outer').css('display', 'block');
			return false;
		}
		var html = '<span class="input-control mr-0"><input type="email" id="outer_email" class="typeahead form-control" placeholder="מייל">';
		html+= '<button class="btn" style="display: inline-block;" id="add-user-outapp">שלח</button></span>';
		$('.outer').replaceWith(html);
	});
	
	$(document).on("click", "#add-user-outapp", function(e){
		event.stopPropagation();
		if ($('.mr-0').length > 0) {
			//var appid = $('#appid_input').val();
			var tenderid = location.href.split('/')[7];
			var email = $('#outer_email').val();
			if(email == ''){
				$('#outer_email').css({'border-color': 'red'});
				return false;
			}
			if(!tenderid){
				alert("יש לבחור מכרז!");
				return false;
			}
			$('#fader').css('display', 'block');
			var form_data = new FormData();
			//form_data.append('type', 'cvmail');
			form_data.append('email', email);
			form_data.append('tenderid', tenderid);
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"/admin/ajax/cvmail",
				data: form_data,
				type: 'POST',
				contentType: false, 
				cache: false, 
				processData: false,
				success: function(data) {
					$('#fader').css('display', 'none');
					$('#outer_email').val('');
					$('.mr-0').html(data);
					//location.reload(true);
				}
			});
		}
	});
	
	$(document).on("change",".cancel_file_sel_approve",function(e) {	
		if ($(this).val() == "1"){
			const html = '<input id="desired_hourly_rate" type="text" placeholder="השכר הממוצע לתפקיד הינו">';
			$(html).insertAfter(this);
			$(this).css({"margin-left":"0", "width":"345px"});
		} else {
			$("#desired_hourly_rate").remove();
			$(this).css({"margin-left":"", "width":"345px"});
		}
	});
	
	$('input[type=radio],input[type=checkbox]').change(function () {
        $("*[data-show_type]").each(function () {
            if ($(this).data('show_type').split('||').length > 1) {
                var ids = $(this).data('show_type').split('||');
                var res = false;
                for (var i = ids.length - 1; i >= 0; i--) {
                    if ($('#' + ids[i]).is(':checked')) {
                        res = true;
                    }
                }
            } else {
                var ids = $(this).data('show_type').split('+');
                var res = true;
                for (var i = ids.length - 1; i >= 0; i--) {
                    if (!$('#' + ids[i]).is(':checked')) {
                        res = false;
                    }
                }
            }
            if (res) {
                $(this).show();
                $(this).find('input').attr('required', 'required');
                $(this).find('select').attr('required', 'required');
                $(this).find('input[type="checkbox"]').removeAttr('required');
            } else {
                $(this).hide();
                $(this).find('input').removeAttr('required');
                $(this).find('select').removeAttr('required');
                // Don't clear input values when hiding sections - preserve user data
                // $(this).find('input[type="text"],input[type="file"]').val('');
                // $(this).find('input[type="radio"],input[type="checkbox"]').prop('checked', false);
                // $(this).find('.file-name').html('');
            }
        })
    });
	
    $(document).on("keydown","input",function(e) {
        var nameRegex = $(this).attr('pattern');
        if(nameRegex && event.keyCode != 8 && event.keyCode != 46 && !$(this).hasClass('date_val')){
            var regex = new RegExp(nameRegex);
            var invalid = regex.test(event.key);
            if(!invalid){
                return false;
            }
        }
        console.log(event.keyCode)
    });
    $(document).on("click",".filter-app  li.dropdown-item a",function(e) {
        e.preventDefault();
        var val = $(this).attr('data-val');
        $(this).parents(".filter-app").find('.dropdown-toggle').attr('data-val', val);
        js_redirect_filter(".filter-app");
    })


    $('.has-clear input[type="text"]').on('input propertychange', function() {
      var $this = $(this);
      var visible = Boolean($this.val());
      $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
    }).trigger('propertychange');

    $('.form-control-clear').click(function() {
      $(this).siblings('input[type="text"]').val('')
        .trigger('propertychange').focus();
    });

    $(document).on("click","#search",function(e) {

      //  console.log('!!!');

        $('.sky-card-header').toggleClass('showsearch');
    })
    $(document).on("click","#search input",function(e) {
        e.stopPropagation();
        e.preventDefault();
        console.log('sent!');
    })
    $('#file-upload').change(function(e) {
        var fileName = e.target.files[0].name;
        console.log(fileName)
        $('.doc-filename').text(fileName);
    });
});

function newShowDecision(decId, id) {
	let elem = document.getElementById(id);
	if (elem) {
		elem.style.display = '';
	}
}

function signature(){
    $('.signature-container').each(function () {
        var parent = $(this),
        signatureText = parent.find('.signature-text'),
        signaturePad = new SignaturePad(parent.find('.signature')[0], {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        })
        signaturePad.onEnd = function () {
            signatureText.val(signaturePad.toDataURL())
            parent.find('.img').html('');
            parent.find('.img').append('<img src="' + signaturePad.toDataURL() + '" />');
        }
    });
}

function remove_app(elem, id){
		if(confirm('האם הינך בטוח שברצונך למחוק?')){
    var form_data = new FormData();
    form_data.append('id', id);
    $('#fader').css('display', 'block');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/delete_app",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if(data == 'success'){
                $('#fader').css('display', 'none');
                $(elem).parents('tr').remove();
            }else{
                $('#fader').css('display', 'none');
                alert(data);
            }
        }
    });
		}
}

function js_redirect_filter(clas, href="?"){
    $(clas+" a.dropdown-toggle").each(function(index, el) {
        var name = $(this).attr('data-name');
        var val = $(this).attr('data-val');
        href += name+"="+val+"&";
    });
    href = href.slice(0, -1);
    if($(clas).find("#date_range").length > 0)
        href += "&label="+$("#date_range").attr('data-label');
    window.location.href = href;
}

function User_fileChange(elem, id){
    if ($('#file-upload').val() == '') {
        alert('אנא בחר קובץ');
        return;
    }
    var file_data = $('#file-upload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('fileID', id);
    $('#fader').css('display', 'block');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/replacefile",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var res = JSON.parse(data);
            if(res.error){
                $('#fader').css('display', 'none');
                alert(res.error);
            }else{
                var content = '<h1 style="color:#4c9d4c;font-size: 30px;font-weight: bold;margin-top: 100px;">'+res.text+'</h1>';
                $('.replacefile-content').html(content);
                $('#fader').css('display', 'none');
            }
        }
    });
}
//function open_logs( elem, id, appid ){
function open_logs( elem, id ){
    $('body').addClass('show-log');
    $(".app-logs-content").html('<img src="/img/loader.gif" class="loader-img">');
    var form_data = new FormData();
    form_data.append('ID', id);
	//form_data.append('appid', appid);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/show-log",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $(".app-logs-content").html(data);
            return false;
        },
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			console.log(thrownError);
		}
    });
}
function closs_logs(){
    $('body').removeClass('show-log');
}

function cancel_file_not_tender(elem, id){
    if($('.cancel_file_content').length < 1){
        id = '"'+id+'"';
        event.stopPropagation();
        var html = "<div class='cancel_file_content'>"
                   +"<textarea class='cancel_file_text' rows='4'></textarea>"
                   +"<a href='#' class='cancel_file_btn' onclick='cancel_file("+id+")'>שלח  </a>"
                   +"</div>";
        $(elem).addClass('beforecolor');
        var top =  $(elem).offset().top
        var right = ($(window).width() - ($(elem).offset().left + $(elem).outerWidth()));
        $('body').append(html);
        $('.cancel_file_content').css({'top': top,'right': right,'max-width': $(window).width() - right });
        $(elem).parents('.file-content').addClass('margin-b200');
    }
}

function update_file(elem, id){
    var form_data = new FormData();
    $('#fader').css('display', 'block');
    var appid = $('#appid_input').val();
	var budget_item = $('#budget_item').val();
	var budget_remarks = $('#budget_remarks').val();
	var budget_manager = $('input[name="budget_manager"]:checked').val();
	var treasurer = $('input[name="treasurer"]:checked').val();
	var hr = $('input[name="hr"]:checked').val();
	var hr_date = $('#hr_date').val();
    form_data.append('appid', appid);
	form_data.append('budget_item', budget_item);
	form_data.append('budget_remarks', budget_remarks);
	form_data.append('budget_manager', budget_manager);
	form_data.append('treasurer', treasurer);
	form_data.append('hr', hr);
	form_data.append('hr_date', hr_date);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/update-file",
        data: form_data,
        type: 'POST',
        contentType: false, 
        cache: false, 
        processData: false,
        success: function(data) {
            if(data == 'success'){
                var url = '/admin/apps/'.appid;
                $.get(url, function(data, status){
                    var content = $(data).find('main');
                    $('main').html(content);
                    $('#fader').css('display', 'none');
                    m_typeahead();
                });
            }else{
                $('#fader').css('display', 'none');
                alert(data);
            }
        }
    });
}
function cancel_file_tk(elem, id){
    if($('.cancel_file_content').length < 1){
        id = '"'+id+'"';
        event.stopPropagation();
        var html = "<div class='cancel_file_content'>"
                   +"<textarea class='cancel_file_text' rows='4'></textarea>"
                   +"<a href='#' class='cancel_file_btn' onclick='cancel_file_function_tk("+id+")'>שלח  </a>"
                   +"</div>";
        $(elem).addClass('beforecolor');
        var top =  $(elem).offset().top
        var right = ($(window).width() - ($(elem).offset().left + $(elem).outerWidth()));
        $('body').append(html);
        $('.cancel_file_content').css({'top': top,'right': right,'max-width': $(window).width() - right });
        $(elem).parents('.file-content').addClass('margin-b200');
    }
}
function show_text_area(elem, id, type){
    event.preventDefault();
    if($('.cancel_file_content').length < 1){
        event.stopPropagation();
        var html = "<div class='cancel_file_content tk"+type+"'>";
        if (type == 1) {
            var t = '"decline"';
            html += "<textarea class='cancel_file_text' rows='4'></textarea>"

            $(elem).parents('#buttons-content').addClass('margin-b200');
        }else if(type == 3){
            var t = '"decline"';
            html += "<select class='cancel_file_sel'> <option value='חוסר מקום'>חוסר מקום</option> <option value='מוסד לא באזור רישום'>מוסד לא באזור רישום</option> <option value='עקב כתובת מגורים'>עקב כתובת מגורים</option> <option value='שיקולים פדגוגים'>שיקולים פדגוגים</option> <option value='על ידי ועדת ערר'>על ידי ועדת ערר</option> <option value='מוסד מבוקש לא שייך למוסד מזין'>מוסד מבוקש לא שייך למוסד מזין</option></select>";
            html += "<input class='cancel_file_text' type='text' placeholder='ניתן להגיש ערער עד לתאריך: dd/mm/yyyy' >";
        }else if(type == 8){
            var t = '"decline"';
            html += "<select class='cancel_file_sel'><option style='color:#ccc'>בחר סיבה לדחיה</option><option value='חוסר מקום'>חוסר מקום</option> <option value='מוסד לא באזור רישום'>מוסד לא באזור רישום</option> <option value='עקב כתובת מגורים'>עקב כתובת מגורים</option> <option value='שיקולים פדגוגים'>שיקולים פדגוגים</option> <option value='על ידי ועדת ערר'>על ידי ועדת ערר</option> <option value='מוסד מבוקש לא שייך למוסד מזין'>מוסד מבוקש לא שייך למוסד מזין</option></select>";
        }else{
            var t = '"1"';
            if($(elem).data('placeholder')){ var placeholder = $(elem).data('placeholder'); }else{var placeholder = 'החל מתאריך: dd/mm/yyyy';}
            html += "<input class='cancel_file_text' type='text' placeholder='"+placeholder+"' >"
        }
        html += "<a href='#' class='cancel_file_btn' onclick='send_app("+id+","+t+")'>שלח  </a></div>";
        $(elem).addClass('beforecolor');
        var top =  $(elem).offset().top
        $('body').append(html);
        $('.cancel_file_content').css({'top': top});
    }
}

function send_app(id, type){
    event.preventDefault();
    var form_data = new FormData();
    form_data.append('appid', id);
    form_data.append('type', type);
    if($('.cancel_file_text').length > 0){
        form_data.append('msg', $('.cancel_file_text').val());
    }else{
        form_data.append('msg', '');
    }
    if($('.cancel_file_sel').length > 0){
        form_data.append('option', $('.cancel_file_sel option:selected').val());
    }else{
        form_data.append('option', '');
    }
    $('#fader').css('display', 'block');
    $('.cancel_file_content').remove();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/actions-form",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if(data && data.res === JSON.stringify({res:'success'}))
            {
                var url = '/admin/apps/'.id;
                $.get(url, function(data, status){
                    var content = $(data).find('main');
                    console.log(content);
                    $('main').html(content);
                    $('#fader').css('display', 'none');
                    m_typeahead();
                });
            }else{
                $('#fader').css('display', 'none');
                console.log(data);
            }
        }
    });
}
function approve_file_tk(elem, id){
    var form_data = new FormData();
    form_data.append('fileID', id);
    $('#fader').css('display', 'block');
    var appid = $('#appid_input').val();
    form_data.append('appid', appid);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/tenders/approve-file",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log('dd', data)
            if(data && data === JSON.stringify({res:'success'}))
            {
                var url = '/admin/apps/'.appid;
                $.get(url, function(data, status){
                    window.location.reload();

                    // var content = $(data).find('main');
                  //  $('main').html(content);
                    //$('#fader').css('display', 'none');
                    m_typeahead();
                });
            }else{
                $('#fader').css('display', 'none');
                alert(data);
            }
        }
    });
}

function cancel_file_function_tk(id){
    event.preventDefault();
    if($('.cancel_file_text').val() != ''){
        var appid = $('#appid_input').val();
        var form_data = new FormData();
        form_data.append('fileID', id);
        form_data.append('appid', appid);
        form_data.append('msg', $('.cancel_file_text').val());
        $('#fader').css('display', 'block');
        $('.cancel_file_content').remove();
        $('.apps-btn').removeClass('beforecolor');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/admin/tenders/cancelfile",
            data: form_data,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if(data && data === JSON.stringify({res:'success'}))
                {
                    var url = '/admin//tenders/application/'.appid;
                    $.get(url, function(data, status){
                       // var content = $(data).find('main');
                        window.location.reload();
                       // $('main').html(content);
                       // $('#fader').css('display', 'none');
                        m_typeahead();
                    });
                }else{
                    alert(data);
                    $('#fader').css('display', 'none');
                }
            }
        });
    }else{
        $('.cancel_file_text').css({'border-color':'red'})
    }

}

function approve_file(elem, id){
    var form_data = new FormData();
    form_data.append('fileID', id);
    $('#fader').css('display', 'block');
    var appid = $('#appid_input').val();
    form_data.append('appid', appid);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/approve-file",
        data: form_data,
        type: 'POST',
        contentType: false, 
        cache: false, 
        processData: false,
        success: function(data) {
            if(data == 'success'){
                var url = '/admin/apps/'.appid;
                $.get(url, function(data, status){
                    var content = $(data).find('main');
                    $('main').html(content);
                    $('#fader').css('display', 'none');
                    m_typeahead();
					location.reload();
					return false;
                });
            }else{
                $('#fader').css('display', 'none');
                alert(data);
            }
        }
    });
}

function cancel_file(id){
    event.preventDefault();
    if($('.cancel_file_text').val() != ''){
        var appid = $('#appid_input').val();
        var form_data = new FormData();
        form_data.append('fileID', id);
        form_data.append('appid', appid);
        form_data.append('msg', $('.cancel_file_text').val());
        $('#fader').css('display', 'block');
        $('.cancel_file_content').remove();
        $('.apps-btn').removeClass('beforecolor');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/admin/ajax/cancel-file",
            data: form_data,
            type: 'POST',
            contentType: false, 
            cache: false, 
            processData: false,
            success: function(data) {
                if(data == 'success'){
                    var url = '/admin/apps/'.appid;
                    $.get(url, function(data, status){
                        var content = $(data).find('main');
                        $('main').html(content);
                        $('#fader').css('display', 'none');
                        m_typeahead();
                    });
                }else{
                    alert(data);
                    $('#fader').css('display', 'none');
                }
            }
        });
    }else{
        $('.cancel_file_text').css({'border-color':'red'})
    }
    
}

function send_all_mails(id){
    event.preventDefault();
    var form_data = new FormData();
    form_data.append('appid', id);
    $('#fader').css('display', 'block');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/send-all-mails",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('#fader').css('display', 'none');
            //alert(data);
        }
    });
}

function send_email(type, id, app_id){
	var form_data = new FormData();
	form_data.append('id', id);//166
	form_data.append('appid', app_id);//579
	form_data.append('type', type);
	$('input[name^="'+ type +'"]').each(function(){
		var name = $(this).attr("name");
		form_data.append(name, $(this).val());
	});
	if ($('textarea#manager_notice').val() != ''){
		form_data.append(type + '_msg', $('textarea#' + type + '_msg').val());
	}
	console.log(form_data);
	var url = '/admin/ajax/email-to-user';
	$('#fader').css('display', 'block');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: url,
		data: form_data,
		type: 'POST',
		contentType: false, 
		cache: false, 
		processData: false,
		success: function(data) {
			if(data == 'success'){			
				var url = '/admin/tenders/application/'.id;
				var res = $.get(url, function(data, status){
					var content = $(data).find('main');
					console.log(content);
					$('main').html(content);
					$('#fader').css('display', 'none');
				}).fail(function() {
					console.log(url);
				});
				window.location.reload();
			}else{
				$('#fader').css('display', 'none');
				console.log(data);
			}
		}
	});
}

$(document).on("click",".get_chart",function(e) {
    var url = $(this).attr('href');
    $('#fader').css('display', 'block');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        data: [],
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('#fader').css('display', 'none');
            $('.chart_content').html(data);
        }
    });
})

$(document).on("click",".remove_user_inappp",function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $("input.typeahead").css({'border-bottom': '1px solid #ccc'})
    $('#fader').css('display', 'block');
    var appid = $('#appid_input').val();
    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append('app_id', appid);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/remove-user-inappp",
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('#fader').css('display', 'none');
            $('.typeahead_res').html(data);
        }
    });
});
function m_typeahead(){
    var $input = $("input#typeahead");
    if ($input.length > 0) {
        $input.typeahead({
            minLength: 1,
            autoSelect: true,
            items: 4,
            source: function (query, process) {
                var path = $input.data('path');
                return $.get(path, {text: query }, function (data) {
                    return process(data);
                });
            },
            updater: function(item) {
                console.log(item);
                return item;
            }
        });
        $(document).on("change", 'input#typeahead',function(e) {
          var current = $input.typeahead("getActive");
          if (current) {
            if (current.name == $input.val()) {
              return true;
            } else {
                $(this).val('');
            }
          } else {
            $(this).val('');
          }
        });
        $(document).on("click","#add-user-inappp",function(e) {
            var current = $input.typeahead("getActive");
            console.log(1)
            if (current) {
                if (current.name == $input.val()) {
                    $input.css({'border-bottom': '1px solid #ccc'})
                    $('#fader').css('display', 'block');
                    var appid = $('#appid_input').val();
                    var form_data = new FormData();
                    form_data.append('id', current.id);
                    form_data.append('app_id', appid);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"/admin/ajax/add-user-inappp",
                        data: form_data,
                        type: 'POST',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $('#fader').css('display', 'none');
                            $input.val('');
                            $('.typeahead_res').html(data);
                        }
                    });
                } else {
                    $input.css({'border-bottom': '1px solid red'})
                }
            } else {
                $input.css({'border-bottom': '1px solid red'})
            }
        });
    }
	
	$(document).on("click", "#add-user-outapp-form2", function(e){
			event.stopPropagation();
			if ($('.outer').css('display') == 'none'){
				$('.outer').css('display', 'block');
				return false;
			}
        	var html = '<div><input type="text" id="outer_name" class="typeahead form-control" placeholder="שם">';
			html+= '<input type="text" id="outer_role" class="typeahead form-control" placeholder="תפקיד"></div>';
			html+= '<span class="input-control mr-0"><input type="email" id="outer_email" class="typeahead form-control" placeholder="מייל">';
			html+= '<button class="btn" style="display: inline-block;" id="add-user-outapp2">הוסף</button></span>';
			$('.outer2').append(html);
		});
		
		$(document).on("click", "#add-user-outapp2", function(e){
			event.stopPropagation();
			if ($('.outer2').length > 0) {
				var appid = $('#appid_input').val();
				var name = $('#outer_name').val();
				var role = $('#outer_role').val();
				var email = $('#outer_email').val();
				if(name == '' && role == '' && email == ''){
					$('#outer_name').css({'border-color': 'red'});
					$('#outer_role').css({'border-color': 'red'});
					$('#outer_email').css({'border-color': 'red'});
				   	return false;
				}
				$('#fader').css('display', 'block');
				var form_data = new FormData();
				form_data.append('name', name);
				form_data.append('role', role);
				form_data.append('email', email);
				form_data.append('app_id', appid);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"/admin/ajax/add-user-outapp",
					data: form_data,
					type: 'POST',
					contentType: false, 
					cache: false, 
					processData: false,
					success: function(data) {
						$('#fader').css('display', 'none');
						$('#outer_name').val('');
						$('#outer_role').val('');
						$('#outer_email').val('');
						$('.outer2').css('display', 'none');
						$('.typeahead_res').html(data);
						location.reload(true);
					}
				});
			}
		});
	$(document).on("click",".remove_user_outapp",function(e) {
    e.preventDefault();
    var name = $(this).attr('data-name');
    $("input.typeahead").css({'border-bottom': '1px solid #ccc'})
    $('#fader').css('display', 'block');
    var appid = $('#appid_input').val();
    var form_data = new FormData();
    form_data.append('name', name);
    form_data.append('app_id', appid);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/ajax/remove-user-outapp",
        data: form_data,
        type: 'POST',
        contentType: false, 
        cache: false, 
        processData: false,
        success: function(data) {
            $('#fader').css('display', 'none');
            $('.typeahead_res').html(data);
			location.reload(true);
        }
    });
});
}
m_typeahead();


jQuery(function($) {

    $(document).on("click",".save_row",function(e) {
        e.preventDefault();
        var error = true;
        var elem = $(this);
        var parent = elem.parents('.faind_line');
        var meta = elem.attr('data-id');
        var id = $('#appid_input').val();
        var form_data = new FormData();
        form_data.append('save_meta', meta);
        form_data.append('app_id', id);
        var metas = new Object();
        parent.find('input').each(function(index, el) {
            if ($(this).attr('type') == 'radio') {
                var name = $(this).attr('name');
                var val = $("input[name='"+name+"']:checked").val();
                if (val == '' || typeof val === typeof undefined) { error = false }
                 metas[name] = val;

            }else{
                var attr = $(this).attr('disabled');
                if (typeof attr == typeof undefined || attr == false) {
                  var name = $(this).attr('name');
                  var val = $(this).val();
                  if (val == '') { error = false }
                  metas[name] = val;
                }
            }

        });
        metas = JSON.stringify(metas);
        form_data.append('metas', metas);
        if (error) {
            $('#fader').css('display', 'block');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"/admin/ajax/saverow",
                data: form_data,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var res = JSON.parse(data);
                    if(res.error){
                        $('#fader').css('display', 'none');
                        alert(res.error);
                    }else{
                        var url = '/apps/'.id;
                        $.get(url, function(data, status){
                            var content = $(data).find('main');
                            $('main').html(content);
                            $('#fader').css('display', 'none');
                            $('.disabled-filds input').each(function(index, el) {
                                $(this).attr('disabled', 'disabled');
                            });
                            $('.disabled-filds .save_row').attr('disabled', 'disabled');
							m_typeahead();
                        });

                    }
                }
            });
        }else{
            alert('error')
        }
    })

    $('.disabled-filds').find('input').each(function(index, el) {
        $(this).attr('disabled', 'disabled');
    });

    $('.disabled-filds').find('.save_row').attr('disabled', 'disabled');

    $(document).on("change",'.edit-form .switcher-control input[type="checkbox"]',function(e) {
        $('.section-content .edit-area fieldset .field.system')
            [$(this).prop('checked') ? "removeClass" : "addClass"]('hidden');

        $('.cheng_statuss_content')
            [$(this).prop('checked') ? "addClass" : "removeClass"]('hidden');
    });
    $(document).on("change",'.c-select',function(e) {
        $(this)
            [$(this).val() != 'בחירת טופס' ? "removeClass" : "addClass"]('c-ddd');
    });
    $(document).on("click",".nav-tabs a",function(e) {
        e.preventDefault();
        $(this).parents('.nav-tabs').find('li').removeClass('active');
        $(this).parents('li').addClass('active');
    });
    $(document).on("click","#edit-personal-data",function(e) {
        e.preventDefault();

        $('.personal-block').addClass('hidden');
        $('.personal-data').removeClass('hidden');
    });
    $(document).on("click","#cancel-personal-data",function(e) {
        $('.personal-block').removeClass('hidden');
        $('.personal-data').addClass('hidden');
    });
    $(document).on("click","#save-form",function(e) {
        $('.user-list table tr.selected').removeClass('selected');
        $('.edit-area').addClass('empty');
    });
    $(document).on("change",'input[name="user_type"]',function(e) {
        $('.c-modal .additional-data')
            [$(this).val() === "1" ? "removeClass" : "addClass"]('hidden');
        if ($(this).val() === "1"){
            $('input[type="password"]').attr('required','required')
        }else{
            $('input[type="password"]').attr('required',false);
        }
    });
    $(document).on("change",'.apppermissions[name="institution_type"]',function(e) {
        if ($('.apppermissions[name="form_type"]').val() != 'בחירת טופס' && $('.apppermissions[name="form_type"]').val() != '' && $('.apppermissions[name="institution_type"]').val() != '' && $('.apppermissions[name="institution_type"]').val() != 'בחירת טופס' ) {
            var data = new FormData();
            data.append('form_type', $('.apppermissions[name="form_type"]').val());
            data.append('institution_type', $('.apppermissions[name="institution_type"]').val());
            var url = $('#edit-form').attr('action');
            $(".apppermissions_content").html('<img src="/img/loader.gif" class="loader-img">');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:url+"/get-apppermissions-html",
                data: data,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.apppermissions_content').html(data);
                }
            });
        }else{
            $('.apppermissions_content').html('');
        }
    });
    $(document).on("change",'.apppermissions[name="form_type"]',function(e) {
        if ($(this).val() != 'בחירת טופס' && $(this).val() != ''){
            $('.apppermissions[name="institution_type"]').html(new Option('בחירת טופס', ""));
            var deps = $(this).find(":selected").attr('data-dep');
            if(deps){
                deps = deps.split(',');
                for (i = 0; i < deps.length; i++) {
                    $('.apppermissions[name="institution_type"]').append(new Option(instypes[deps[i]], deps[i]));
                }
            }else{
                $('.apppermissions_content').html('');
            }
        }else{
            $('.apppermissions_content').html('');
            $('.apppermissions[name="institution_type"]').html(new Option('בחירת טופס', ""));
        }
    });
    $(document).on("change",'.adduser_apppermissions[name="institution_type"]',function(e) {
        if(!change_add_apppermissions()) return false;
        if ($('.apppermissions[name="form_type"]').val() != 'בחירת טופס' && $('.apppermissions[name="form_type"]').val() != '' && $('.apppermissions[name="institution_type"]').val() != '' && $('.apppermissions[name="institution_type"]').val() != 'בחירת טופס' ) {
            var data = new FormData();
            var form_type = $('.adduser_apppermissions[name="form_type"]').val();
            var institution_type = $('.adduser_apppermissions[name="institution_type"]').val();
            data.append('form_type', form_type);
            data.append('institution_type', institution_type);
            $(".apppermissions_content").html('<img src="/img/loader.gif" class="loader-img">');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"/admin/users/edit-user/0/get-apppermissions-html",
                data: data,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.checkboxes_content').append(data);
                }
            });
        }
    });
	$(document).on("change",'.adduser_apppermissions[name="form_type"]',function(e) {
        var form_type = $('.adduser_apppermissions[name="form_type"]').val();
        console.log('chekeekekekk!',form_type);
        if (form_type && form_type!='' && form_type!=='בחירת טופס')   $('[name="appperm"]').removeClass('hidden');
        else  $('[name="appperm"]').addClass('hidden');

        //appperm

        $('.checkboxes_content').find('.checkboxes').removeClass('act');
        if ($(this).val() != 'בחירת טופס' && $(this).val() != ''){
            $('.adduser_apppermissions[name="institution_type"]').html(new Option('בחירת טופס', ""));
            var deps = $(this).find(":selected").attr('data-dep');
            if(deps){
                deps = deps.split(',');
                for (i = 0; i < deps.length; i++) {
                    $('.adduser_apppermissions[name="institution_type"]').append(new Option(instypes[deps[i]], deps[i]));
                }
            }
        }else{
            $('.adduser_apppermissions[name="institution_type"]').html(new Option('בחירת טופס', ""));
        }
    });
	
    function change_add_apppermissions(){
        var form_type = $('.adduser_apppermissions[name="form_type"]').val();
        var institution_type = $('.adduser_apppermissions[name="institution_type"]').val();
        $('.checkboxes_content').find('.checkboxes').removeClass('act');
        var elem = $('.checkboxes_content').find('.'+institution_type+'_'+form_type);
        if(elem.length > 0){
            elem.addClass('act');
            return false;
        }
        return true;
    }

    $(document).on("submit", "#create-user-form", function(e) {
        e.preventDefault();
        error = "";
        if ($('input[name="user_type"]').val() == "1") {
            if ($('input[name="password"]').val() != $('input[name="password_confirmation"]').val()) {
                error = "סיסמאות לא תואמות";
            }
            if ($('input[name="password"]').val().length < 8 ) {
                error = "סיסמאות חייבות לכלול לפחות 8 תווים";
            }
        }
        $('.form-res').html(error);
        if (error == "") {
            $('.form-res').html('');
            var form = document.getElementById('create-user-form');
            var data = new FormData(form);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"/admin/users/create-user",
                data: data,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    data = jQuery.parseJSON(data);
                    if (data.errors) {
                        var errors = data.errors;
                        for (var i = errors.length - 1; i >= 0; i--) {
                            $('#addUserModal .form-res').append('<p>'+errors[i]+'</p>');
                        }
                    }else{
                        $('#addUserModal .modal-body').html(data.s);
                        window.location.reload();
                    }
                    console.log(data)
                }
            });
        }

    });
    $(document).on("click",".create-user",function(e) {
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/admin/users/get-create-user-form",
            data: [],
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#addUserModal .modal-content').html(data);
            }
        });
    });
    $(document).on("click",'.user-list table a.edit-user-b',function(e) {
        e.preventDefault();
        $('#fader').css('display', 'block');
        $('.user-list table tr.selected').removeClass('selected');
        $(this).parents('tr').addClass('selected');
        $('.edit-area').removeClass('empty');
        var url = $(this).attr('href');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:url,
            data: [],
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.edit-area').html(data);
                $('#fader').css('display', 'none');
            }
        });
    });
    $(document).on("submit", "#edit-form", function(e) {
        e.preventDefault();
    })
    $(document).on("click", "#save-personal-data", function(e) {
        e.preventDefault();
        var error = false;
        if ($('input[name="fname"]').val() == '') {
            error = true;
            $('input[name="fname"]').css('border-bottom', '1px solid red');
        }else{
            $('input[name="fname"]').css('1px solid rgb( 189, 189, 189 )');
        }
        if ($('input[name="name"]').val() == '') {
            error = true;
            $('input[name="name"]').css('border-bottom', '1px solid red');
        }else{
            $('input[name="name"]').css('1px solid rgb( 189, 189, 189 )');
        }
        if (!error) {
            edit_user(1);
        }
    })
    $(document).on("click", "#save-form-auth-data", function(e) {
        e.preventDefault();
        var error = false;
        var email = $('.edit-email').val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        if (re.test(email)) {
            error = true;
            $('.edit-email').css('border-bottom', '1px solid red');
        } else {
            $('.edit-email').css('1px solid rgb( 189, 189, 189 )');
        }
        if ($('input[name="password"].e-pass').val() != $('input[name="password_confirmation"].e-pass').val() || $('input[name="password"].e-pass').val().length < 8 ) {
            error = true;
            $('.e-pass').css('border-bottom', '1px solid red');
        }else{
            $('.e-pass').css('1px solid rgb( 189, 189, 189 )');
        }
        if (!error) {
            edit_user(2);
        }
    })

    $(document).on("click", "#save-form-access-data", function(e) {
        e.preventDefault();
        var error = false;
        if (!error) {
            edit_user(3);
        }
    })
    $(document).on("click", "#cheng-statuss-button", function(e) {
        e.preventDefault();
        var error = false;
        if (!error) {
            edit_user(4);
        }
    })
    function edit_user(type) {
        $('#fader').css('display', 'block');
        var url = $('#edit-form').attr('action');
        var form = document.getElementById('edit-form');
        var data = new FormData(form);
        data.append('form_types', type);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:url,
            data: data,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.edit-area').html(data);
                $('#fader').css('display', 'none');
            }
        });
    }
	
	

});
