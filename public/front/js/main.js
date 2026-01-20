var FormsAttr = {
  "school": [
       {
        'classroom': ["א", "ב", "ג", "ד", "ה", "ו"],
        'SchoolNames': ["שדות סילבר", "ניצני קטיף", "ניצן", "מורשה", "חופים", "באר גנים"]
       },
       {
        'classroom': ["ז", "ח", "ט", "י", "יא", "יב"],
        'SchoolNames': ["שקמה", "נווה דקלים", "כפר סילבר", "בני יששכר"]
       }
  ],
  "childrengarden": [
       {
        'classroom': ["טרום טרום חובה", "טרום חובה", "חובה"],
        'SchoolNames':["תלמי שילה", "תלמי גאולה", "נתנאל", "סיגלון", "שקד", "הדר", "ארז", "זוהר", "דקל", "זית", "אתרוג", "סיון", "אורן" ,"צאלון", "ניצן", "ברוש גיל", "פקאן", "רימון", "גפן", "אמציה גיל", "אמציה", "כלנית", "צבעוני", "רותם", "גיל", "רקפת", "עמי", "חרוב", "נרקיס", "חצב", "אחוזם", "תמר","נטע", ]
       }
  ],
  "initial": [
       {
        'classroom': ["ב ", "ג ", "ד ", "ה ", "ו "],
        'SchoolNames': ["שדות סילבר", "ניצני קטיף", "ניצן", "מורשה", "חופים", "באר גנים"]
       }
  ],
  "high": [
       {
        'classroom': ["ח ", "ט ", "י ", "יא ", "יב "],
        'SchoolNames':["אולפנא", "תיכון", "כפר נוער", "ישיבה תיכונית"]
       }
  ]
}
jQuery(function ($) {
	if (window.location.search.indexOf('formdata')>=0 ){
		var index=window.location.search.indexOf('formdata')+9;
		var ap=window.location.search.indexOf('&',index);
		var code=ap>0?window.location.search.substr(index,ap-index):window.location.search.substr(index);

		var pdf_index = window.location.search.indexOf('pdf')+4;
		var pdf = window.location.search.substr(pdf_index);
		if (code > 0 && pdf != '')
		{
			window.acode=code;

		var token = $('meta[name="csrf-token"]').attr('content');
		if (token){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': token
				}
			});

			var loadfunc=function (data){
				if(data == 'error'){
				   return false;
				}
				try
					{
					let dataarr=JSON.parse(data);
					console.log('loaded',dataarr);
					for(let line of dataarr){
						//	console.log(line);

					var nam=line.n;
					var idd=line.idd;
					//console.log('idd',idd);
					var v=line.v;
					if (nam) {
//					console.log(nam,v);
					if (document.getElementsByName(nam) && document.getElementsByName(nam).length>0 && document.getElementsByName(nam)[0].type!=='file'){
					document.getElementsByName(nam)[0].value=v;
					document.getElementsByName(nam)[0].required=false;
					}
					}
					else if (idd) {
						console.log('idd',idd,document.getElementById(idd));
						if (document.getElementById(idd) && document.getElementById(idd).type!=='file')
							{
							document.getElementById(idd).value=v;
							document.getElementById(idd).required=false;
							}
						}

		  			var rt0 = Array.from(document.getElementsByTagName("textarea"));
					//var rt = Array.from(document.getElementsByTagName("input"));
          		//	rt = rt.concat(rt0);
					var	rt=Array.from(document.querySelectorAll('#form6-7')[0]);

					for (let i = 0; i < rt.length; i++)
					{
					   rt[i].required = false;
					}

					}//end for

					rt=document.getElementById('reportSendBtn');
	//rt.id='reportUpdateBtn2'

					let frm=document.getElementById("form6-7");

					//frm.append('<input type="hidden" name="mainfield" value="'+code+'" />');
					var element1 = document.createElement("input");
					element1.type = "hidden";
					element1.value = code;
					element1.name = 'codename';
					frm.appendChild(element1);

					var element2 = document.createElement("input");
					element2.type = "hidden";
					element2.value = pdf;
					element2.name = 'pdf';
					frm.appendChild(element2);
					}
			catch(ex){
				console.log(ex);
			}
		}
        $.get(window.location.origin+"/admin/getappdata"+(window.mode?'_b':'')+"/"+code+"/"+pdf,loadfunc);
	//	alert(code);
		}
		}
	}

	signature();

	/*
	$(document).on("input", 'input[type="radio"],input[type="checkbox"]', function(e) {
        $('.virtual').removeClass("requiredError");
        if (!$(this).is(":checked")) {
            $('.virtual').addClass("requiredError");
        }
    });
	*/

	$('.radio, .checkbox').on("click", function(e) {
		const el = $(this).find('.virtual');
		if (el.attr('class').includes('requiredError')){
        	$(el).parents('.input-control, .faind_line, .faind_line_small_div').find('.virtual').removeClass("requiredError");
		}
        if (!$(this).find('input').is(":checked")) {
            $(el).parents('.input-control, .faind_line, .faind_line_small_div').find('.virtual').addClass("requiredError");
        }
    });

    $("#form input").on("invalid", function (e) {
        //e.preventDefault();
        if ($(this).attr('type') == 'file') {
			console.log($(this).attr('data-val'));
			console.log($(this).attr('id'));
			console.log($(this).attr('name'));
			this.setCustomValidity(' ');

			//$('.btn-input-upload').addClass("requiredError");
			$(this).parent().find('.btn-input-upload').addClass("requiredError");
            $(this).parents('tr').addClass("requiredError");

        } else {
            $(this).addClass("requiredError");

        }

        if (!$("#form").hasClass("invalid")) {
            formInvalid();
        }
		const files = $('input[type="file"]');
		if (files.length > 0){
			$.each(files, function() {
			  if ($(this).attr('data-val') === 'recomendations') {
				  $('.recomendations').removeClass("requiredError");
			  }
			  if ($(this).attr('data-val') === 'educ') {
				  $('.educ').removeClass("requiredError");
			  }
			  if ($(this).attr('data-val') === 'condition-or' && $(this).val() !== '') {
				  $('.condition-or').removeClass("requiredError");
				  $.each($('.condition-or'), function() {
					  removeError($(this));
				  });
				   $.each($('input[data-val="condition-or"]'), function() {
					    $(this).removeAttr('required');
				   });

			  }
			  /*if ($(this).attr('data-val') === undefined) {

				  $('.data-val').removeClass("requiredError");
			  }*/
		   });
		}
    });

    $(document).on("click", "#reportSendBtn", function (e) {
        $('input').each(function () {
            var error = false;
            var val = $(this).val();
            var min = $(this).attr('minlength');
            var max = $(this).attr('maxlength');
            var min_val = $(this).attr('data-min');
            if (min && val.length > 0 && val.length < min) {
                error = true;
            }
            if (max && val.length > 0 && val.length > max) {
                error = true;
            }
            if (min_val && val < min_val) {
                error = true;
            }

            if (error) {
                this.setCustomValidity(' ');
                $(this).addClass("requiredError");
            } else {
                this.setCustomValidity('');
                $(this).removeClass("requiredError");
            }
        })
        $('select').each(function () {
            if ($(this).prop('required')) {
                var val = $(this).val();
                if (val == '') {
                    this.setCustomValidity(' ');
                    $(this).addClass("requiredError");
                } else {
                    this.setCustomValidity('');
                    $(this).removeClass("requiredError");
                }
            }
        });
		$('div.required-a').find('input').each(function () {
			$('div.required-a .virtual').removeClass("requiredError");
			if (!$(this).is(":checked") && $('div.required-a :checkbox:checked').length == 0) {
				//this.setCustomValidity(' ');
				$('div.required-a .virtual').addClass("requiredError");
			}
		});
		$('div.required-b').find('input').each(function () {
			$('div.required-b .virtual').removeClass("requiredError");
			if (!$(this).is(":checked") && $('div.required-b :checkbox:checked').length == 0) {
				//this.setCustomValidity(' ');
				$('div.required-b .virtual').addClass("requiredError");
			}
		});
/*$('div.required-c').find('input').each(function () {
			$('div.required-c .virtual').removeClass("requiredError");
			if (!$(this).is(":checked") && $('div.required-c :checkbox:checked').length == 0) {
				this.setCustomValidity(' ');
				$('div.required-c .virtual').addClass("requiredError");
			}
		});*/
			$('div.input-control').find('input[type="radio"]').each(function () {
			$( this ).parent().find('.virtual').removeClass("requiredError");
			if (!$(this).is(":checked") && $( this ).parent().parent().find(':radio:checked').length == 0 && this.id != 'still_working' && $(this).attr('name') != 'gender') {
				//this.setCustomValidity(' ');
				//console.log(this.id);
				$( this ).parent().find('.virtual').addClass("requiredError");
			}
		});
			$('input[name="nearness"]').each(function (){
				$( this ).parent().find('.virtual').removeClass("requiredError");
			if (!$(this).is(":checked") && $( this ).parent().parent().parent().find(':radio:checked').length == 0) {
				//this.setCustomValidity(' ');
				$( this ).parent().find('.virtual').addClass("requiredError");
			}
		});
		/*$('input[name="still_working"]').each(function (){
			if (!$(this).is(":checked") && $('#reason_for_leaving').val().length ==0 ) {
				$(this).parent().find('.virtual').addClass("requiredError");
			} else {
				this.setCustomValidity('');
				$(this).parent().find('.virtual').removeClass("requiredError");
			}
		});*/
		$('input[name^="form3_ch2"]').each(function (){
			this.setCustomValidity('');
			$(this).parent().find('.virtual').removeClass("requiredError");
		});
    });



	$(document).on("submit", "#form6-7", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".submit-error-msg").html("");
        $("#form").removeClass("invalid");
        if (!$("#form").hasClass("invalid")) {
            formSaving();
        }
    });

    $(document).on("submit", "#form", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".submit-error-msg").html("");
        $("#form").removeClass("invalid");
        if (!$("#form").hasClass("invalid")) {
            formSending();
        }
    });

    $(document).on("input", "input", function (e) {
        $(this).removeClass("fError");
        if (!$(this).is(":valid")) {
            $(this).addClass("requiredError");
        }
    });

   $(document).on("input", 'input[type="email"]', function (e) {
        //var email = $(this).val();
        console.log(e,"ss", e.target);
        /*
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        if (re.test(email)) {
            $(this).removeClass("requiredError");
            this.setCustomValidity('');
        } else {
            $(this).addClass("requiredError");
            this.setCustomValidity('invalid email address');
        }*/
    });
    $(document).on("input", 'input.id_number', function (e) {
        console.log('id', e);
        var num = $(this).val();
        var tot = 0;
        var tz = new String(num);
        if (tz.length == 9) {
            for (i = 0; i < 8; i++) {
                x = (((i % 2) + 1) * tz.charAt(i));
                if (x > 9) {
                    x = x.toString();
                    x = parseInt(x.charAt(0)) + parseInt(x.charAt(1))
                }
                tot += x;
            }
            if ((tot + parseInt(tz.charAt(8))) % 10 == 0) {
                $(this).removeClass("requiredError");
                this.setCustomValidity('');
            } else {
                $(this).addClass("requiredError");
                this.setCustomValidity('Not Correct');
            }
        }
    });

	 $(document).on("blur", 'input[name^="pf1"]', function (e) {
		console.log('hi');
		var value = $(this).val();
		var rowCount = $('#committee_block tr').length;
		if (value != ''){
			var pn1 = $('input[name^="pn1"]').eq(rowCount-1).val();
			$('tr[id^="committee_sing_line"]').eq(rowCount-1).find('td:first-child').text(pn1 + ' ' + value);
		}
	});



	function formInvalid() {
        console.log('checkling!!!');
        $("#form").addClass("invalid");
        $(".submit-error-msg").html('<span class="error ng-tns-c1-0 ng-star-inserted">נא וודאו שמלאתם את כל השדות ההכרחיים   לפני השליחה.</span>');
    }

    function formSending() {
        var form = document.getElementById('form');
        var data = new FormData(form);
        var error = 0;
        $('.load_container').show();
        $('select').each(function () {
            var val = $(this).val();
            if ($(this).attr('required') == 'required' && val == '') {
                error++;
                return false;
            }
            $(this).find('option[value="' + val + '"]').attr('selected', true);
        });
		if (error != 0) {
            $('.load_container').hide();
            alert('אנא מלא את כל השדות');
            return false;
        }
		$('input').each(function () {
            $(this).attr('value', $(this).val());
            if ($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') {
                if ($(this).is(':checked')) {
                    $(this).attr('checked', 'checked');
                }
            }
			if ($(this).attr('data-key') !== undefined &&
				$(this).attr('data-cond') !== undefined) {
					let key = $(this).attr('data-key');
					data.append('condition'+key, $(this).attr('data-cond'));
			}
        });
        $('textarea').each(function () {
            $(this).attr('value', $(this).val());
            $(this).replaceWith('<pre class="detail" style="height: auto;min-height: 120px;">' + $(this).val() + '</pre>');
        });
        if ($('#single_parent_yes').length > 0 && $('#single_parent_yes').is(':checked')) {
            $('#single_parent_yes').parents('.faind_line').prev().addClass('page-break');
            console.log(11);
        }
        if ($('select[name="current11"]').length > 0) {
            data.append('current_select_html', $('select[name="current11"]').html());
        }
        data.append('html', $('form').html());
        var url = $('#form_url').val();
		var token = $('meta[name="csrf-token"]').attr('content');
        if (token){
			$.ajaxSetup({
			   headers: {
                'X-CSRF-TOKEN': token
            },
			});
        	$.post({
				url:url+"/create",
				data: data,
				contentType: false,
            	cache: false,
            	processData: false,
            	success: function(data) {
                	var res = JSON.parse(data);
                	if(res.error){
                    	$('.load_container').hide();
                    	alert(res.error);
                	} else {
                   	window.location.href = url+'/success/'+res.decisionId;
                	}
            	},
				error: function(error){
					console.log(error);
                    if(error.status==413){
                        alert('Please increase server file upload limit!')
                    }
				}
        	});
		}else{
			console.log("token is null");
		}
	}

	function formSaving() {
        var form = document.getElementById('form6-7');
		var data = new FormData(form);
        $('.load_container').show();
        $('input').each(function () {
            $(this).attr('value', $(this).val());
            if ($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') {
                if ($(this).is(':checked')) {
                    $(this).attr('checked', 'checked');
                }
            }
        });
        $('textarea').each(function () {
            $(this).html($(this).val());
            //$(this).replaceWith('<pre class="detail" style="height: auto;min-height: 120px;">' + $(this).val() + '</pre>');
        });
		$('#header6-7').css('display', 'none');
		data.append('tenderid', $('#tenderid').text().split('-')[1]);
        data.append('html', $('form').html());
        var form_name = $('#from_name').val();
		var formform=document.querySelectorAll("#form6-7")[0];
		skipped=0;
		console.log('f+++f',formform);
  		var dataArr=[];
		for (var i = 0; i < formform.length; i++) {
			if (formform[i].name)
			{
				let line={n:formform[i].name,v:formform[i].value};
				dataArr.push(line);
			}
			else if (formform[i].id) {
				let line={idd:formform[i].id,v:formform[i].value};
				dataArr.push(line);
			}
			else {
				skipped++;
				console.log('skipped',formform[i],formform[i].parentElement,skipped);
			}
			//dataArr[formform[i].name]=formform[i].value
		}
		let aData = dataArr ? JSON.stringify(dataArr) : '';
//		console.log('fAf',dataArr,aData);

		if (aData) data.append('data_val',aData);
		$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/generate_pdf/' + form_name,
            data: data,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                var res = JSON.parse(data);
                if (res.error) {
                    $('.load_container').hide();
                    alert(res.error);
                } else {
                    console.log('success');
					$('.load_container').hide();
                }
            },
			error: function(error){
				console.log(error);
			}
        });
    }

	$('#committee_add_btn').click(function(){
		dublibe('committee_sing_block','committee_sing_line');
		signature();
	});

	$('#committee_remove_btn').click(function(){
		remove('committee_sing_block','committee_sing_line');
	});

	function signature(){
		$('.signature-container').each(function () {
			var parent = $(this),
				signatureText = parent.find('.signature-text'),
				signaturePad = new SignaturePad(parent.find('.signature')[0], {
					backgroundColor: 'rgba(255, 255, 255, 0)',
					penColor: 'rgb(0, 0, 0)'
				}),
				cancelButton = parent.find('.signature-eraser'),
				imageContent = parent.find(".img");

			signaturePad.onEnd = function () {
				signatureText.removeClass('requiredError');
				signatureText.val(signaturePad.toDataURL());
				imageContent.html('');
				imageContent.append('<img src="' + signaturePad.toDataURL() + '" />');
			};

			cancelButton.on('click', function (event) {
				signaturePad.clear()
				signatureText.val('')
				imageContent.html('');
				parent.find('.plesh_sig').show();
			});
		});
	}

    $(document).on("mousedown touchstart", ".signature", function (e) {
        $(this).siblings('.plesh_sig').hide();
    })

    $('input').change(function (e) {
        var curr=e.currentTarget;
        var parent=curr.parentElement;
        if (curr && parent && parent.parentElement &&  e.currentTarget) {
            var parentL=curr.parentElement;
            var qs=parentL?parentL.querySelector(".btn-input-upload"):false;
            let ctv= e.currentTarget.value;
            ctv=ctv.substring(ctv.lastIndexOf("\\")+1);
        //    console.log(e.currentTarget.value,ctv);
            if (qs) qs.value = ctv;
        }
     //   console.log('---',e.currentTarget,parent,e.currentTarget.value)
        saveFormToCookie($('#form'));
    });
    $('select').change(function () {
        $(this).removeClass("requiredError");
        saveFormToCookie($('#form'));
    });

  /*  if (Cookies.get('form') && Cookies.get('form') != '' && $('form').length) {
        if (confirm("יש לך טופס שמולא באופן חלקי, האם תרצה להמשיך למלא אותו?")) {
            loadFormFromCookie($('#form'));
        } else {
            Cookies.set('form', '', { expires: -1 });
        }
    }*/

    $("input").on('keydown', keydownHandler);
    $("input").on('input', inputHandler);
    $(".date_val").on('input', inputHandlerdate);

    function keydownHandler(e) {
        oldValue = $(this).val();
    }
    function inputHandler(e) {
        var nameRegex = $(this).attr('pattern');
        var error = false;
        if (!$(this).hasClass('date_val')) {
            var newValue = $(this).val();
            var regex = new RegExp(nameRegex);
            var invalid = regex.test(newValue);
            var min = $(this).attr('minlength');
            var max = $(this).attr('maxlength');
            if (!invalid && newValue != '') {
                $(this).val(oldValue)
                if (min && oldValue.length < min) {
                    error = true;
                }
                if (max && oldValue.length > max) {
                    error = true;
                }
            }
            if (error) {
                this.setCustomValidity(' ');
            } else {
                this.setCustomValidity('');
            }
        }
    }
    function inputHandlerdate(e) {
        var newValue = $(this).val();
        var regex = /^[0-9 /]+$/;
        var invalid = regex.test(newValue);
        if (invalid || newValue == '') {
            $(this).val(newValue)
        } else {
            $(this).val(oldValue)
        }
    }

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
				debugger;//
				if($(this).data('show_type').indexOf("edu_type") == -1 && $(this).find("#reason_for_leaving").length ==0 && $(this).data('show_type').indexOf("license_exist_yes") == -1){
                $(this).find('input').attr('required', 'required');
                $(this).find('select').attr('required', 'required');
                $(this).find('input[type="checkbox"]').removeAttr('required');
					 $(this).find('input.not-required').removeAttr('required', 'required');
				}
            } else {
                $(this).hide();
                $(this).find('input').removeAttr('required');
                $(this).find('select').removeAttr('required');
                // Don't clear input values when hiding sections - preserve user data
                // $(this).find('input[type="text"],input[type="file"]').val('');
                // $(this).find('input[type="radio"],input[type="checkbox"]').prop('checked', false);
                // $(this).find('.file-name').html('');
            }
        });
    })
	 /* $('input[name="still_working"]').change(function (e) {
		  	$('input[name="reason_for_leaving"]').attr('required', 'required');
		 if( $(this).is(':checked')){
			  $('input[name="reason_for_leaving"]').removeAttr('required');
			   $('input[name="reason_for_leaving"]').removeClass("requiredError");
			 $('input[name="reason_for_leaving"]').val("");
		 }
	  });*/
/*	$('input[name="reason_for_leaving"]').on('input', function() {


			  var $entered = $(this).val().length;
		if($entered === 0){
			$('input[name="still_working"]').attr('required', 'required');
			 if( !$('input[name="still_working"]').is(':checked')){
				 	$('input[name="reason_for_leaving"]').attr('required', 'required');
			 }
		}
		var attr = $$('input[name="still_working"]').attr('required');

    if($entered > 0 && (typeof attr !== 'undefined' && attr !== false)){
		$('input[name="still_working"]').prop('checked',false);
			 $('input[name="still_working"]').removeAttr('required');
			 $('input[name="still_working"]').parent().find('.virtual').removeClass("requiredError");
		 }
		});*/
    $('select[name="num_children"]').change(function (e) {
        num_children_change($(this));
    });

    $('.frametype').change(function () {
        frametype_change($(this));
    });
    $('.current_itemshow').change(function () {
        current_itemshow_change($(this));
    });
	  /*  $('input[name="form5_nigud"]').change(function () {
        if($(this).val() == 'yes'){
			$('#form5_nigud_text').attr("required","required");
		}else{
			$('#form5_nigud_text').removeAttr("required");
		}
    });*/

    //$('.current').append(newOption).trigger('change');
});

(function ($) {
    $("*[data-show_type]").each(function () {
        $(this).hide();
    })
    $.fn.serializeJSON = function () {
        var json = {};
        jQuery.map($(this).serializeArray(), function (n, _) {
            json[n['name']] = n['value'];
        });
        return json;
    };
})(jQuery);

function formNumber()
{
    var res=parseInt(window.location.href.substr(window.location.href.indexOf('/page')+5,1));
    //  console.log('chingk', window.location.href,res);

    if (isNaN(res)) res=0;
    return res;
}

jQuery( document ).ready(



    function() {

        setTimeout(function() {




            // console.log("cookie",window.Cookies);
           console.log(formNumber());
            if ( window.Cookies && Cookies.get('form'+formNumber()) && Cookies.get('form'+formNumber()) != '' && $('form').length) {
                if (confirm("יש לך טופס שמולא באופן חלקי, האם תרצה להמשיך למלא אותו?")) {
					if($('#form').length > 0){
                    	loadFormFromCookie($('#form'));
					} else if ($('#form5').length > 0) {
						loadFormFromCookie($('#form5'));
					} else {
						loadFormFromCookie($('#form6-7'));
					}
                } else if (window.Cookies) {
                    Cookies.set('form', '', {expires: -1});
                } else {
                    console.log('now');
                }
            }},1);
    }
);


ensureNumber = function (n) {
    n = parseInt(n, 10);
    if (isNaN(n) || n <= 0) {
        n = 0;
    }
    return n;
};

saveFormToCookie = function (form) {
    var name = $(form).attr('id')+formNumber();
    var data = $(form).serializeJSON();
    console.log('saveFormToCookie',window.location,data, name)
    Cookies.set(name, data, { expires: 365 });
};

loadFormFromCookie = function (form) {
    console.log('loadFormFromCookie',form,window.location)

    var name = $(form).attr('id')+formNumber();
    var data = Cookies.get(name);

    if (typeof data === 'undefined') {
        return;
    }

	try {
        JSON.parse(data, function (key, value) {
		console.log(key, value);
        if (typeof (value) !== 'object') {
            var el = $(form).find('*[name="' + key + '"]');
            if (el.is('input')) {
                if (false) {
                    // code formatting stub
                } else if (el.attr('type') === 'number') {
                    el.val(ensureNumber(value));
                } else if (el.attr('type') === 'checkbox') {
                    if (el.val() === value) {
                        $(el).prop('checked', true);
                    }
                } else if (el.attr('type') === 'radio') {
                    $.each(el, function (_, elc) {
                        if (elc.value === value) $(elc).prop('checked', true);
                    });
                } else if (el.attr('type') === 'hidden') {

                } else if (!el.hasClass('signature-text')) {
                    el.val(value);
                }
            } else if (el.is('select')) {
                el.find('option[value="' + value + '"]').attr('selected', true);
                if (el.attr('required') == 'required' && el.hasClass('frametype')) {
                    frametype_change(el);
                }
                if (el.attr('required') == 'required' && el.hasClass('current_itemshow')) {
                    current_itemshow_change(el);
                }
                if (el.attr('name') == 'num_children') {
                    num_children_change(el)
                }
                if (el.data('select2')) el.select2().trigger('change');
            } else if (el.is('textarea')) {
                el.val(value);
            }
        }
    });
    } catch(e) {
        console.log(e); // error in the above string (in this case, yes)!
    }


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

				if($(this).data('show_type').indexOf("edu_type") == -1 && $(this).find("#reason_for_leaving").length ==0 && $(this).data('show_type').indexOf("license_exist_yes") == -1){

            $(this).find('input').attr('required', 'required');
            $(this).find('select').attr('required', 'required');
            $(this).find('input[type="checkbox"]').removeAttr('required');
					 $(this).find('input.not-required').removeAttr('required', 'required');
				}
        } else {
            $(this).hide();
            $(this).find('input').removeAttr('required');
            $(this).find('select').removeAttr('required');
            // Don't clear input values on page load - preserve user data
            // $(this).find('input[type="text"],input[type="file"]').val('');
            // $(this).find('input[type="radio"],input[type="checkbox"]').prop('checked', false);
            // $(this).find('.file-name').html('');
        }
    })

};

function frametype_change(elem, selected = '') {
    var frametype = elem.find('option:selected').val();
    var sel = elem.parents('.faind_line').find('.current_itemshow');
    var classrooms = [''];
    if (FormsAttr[frametype]) {
        for (i = 0; i < FormsAttr[frametype].length; i++) {
            var classrooms = $.merge(classrooms, FormsAttr[frametype][i].classroom);
        }
    }
    sel.html('');
    for (i = 0; i < classrooms.length; i++) {
        var option = new Option(classrooms[i], classrooms[i]);
        if (selected == classrooms[i]) option.setAttribute("selected", "selected");
        sel.append(option);
    }
    var sel2 = elem.parents('.faind_line').find('.current');
    if (sel2.length > 0 && sel2.data('select2')) {
        sel2.select2("destroy");
        sel2.find('option').remove();
        sel2.select2({ language: "he", dir: "rtl", data: [''] });
    }
    var ind = elem.prop('selectedIndex');
    if (ind == 1) {
        if (elem.attr('data-text') != 'no') elem.parents('.faind_line').find('.current_itemshow_text').html('כיתה:');
        if (elem.parents('.faind_line').find('.current_itemshow_text2').length > 0) elem.parents('.faind_line').find('.current_itemshow_text2').html('לבית הספר');

    } else {
        if (elem.attr('data-text') != 'no') elem.parents('.faind_line').find('.current_itemshow_text').html("חתך גיל:");
        if (elem.parents('.faind_line').find('.current_itemshow_text2').length > 0) elem.parents('.faind_line').find('.current_itemshow_text2').html("לגן");
    }
}

function current_itemshow_change(elem, selected = '') {
    if (elem.attr('data-child')) {
        var sel = elem.parents('.faind_line').find('.current' + elem.attr('data-child'));
    } else {
        var sel = elem.parents('.faind_line').find('.current');
    }
    var frametype = elem.parents('.faind_line').find('.frametype').find('option:selected').val();
    var classroom = elem.find('option:selected').val();
    var SchoolNames = [''];
    $.each(FormsAttr[frametype], function (i, v) {
        if ($.inArray(classroom, v.classroom) >= 0) {
            SchoolNames = $.merge(SchoolNames, v.SchoolNames);
            return false;
        }
    });
    if (sel.length > 0) {
        if (sel.data('select2')) sel.select2("destroy");

        sel.find('option').remove();
        //sel.select2({ language: "he", dir: "rtl", data: SchoolNames });
        //sel.val(selected);
        //sel.select2().trigger('change');
        return false;
    }

}
function num_children_change(elem) {
    var val = elem.val();
    $('.num_children_container').find('.faind_line').addClass('hidden');
    $('.num_children_container').find('input').removeAttr('required');
    $('.num_children_container').find('select').removeAttr('required');
    for (var i = 1; i <= val; i++) {
        $('.numchildren' + i).removeClass('hidden');
        $('.numchildren' + i).find('input').attr('required', 'required');
        $('.numchildren' + i).find('select').attr('required', 'required');
    }
}
function fileChange(el) {
	// Handle different ID patterns for remove buttons
	var removeButtonId;
	if (el.id.startsWith('cfile-upload-')) {
		// For military service and other files with cfile-upload- prefix
		removeButtonId = 'r' + el.id.replace('cfile-upload-', '');
	} else {
		// For legacy files
		removeButtonId = 'r' + el.id;
	}
	var rt = document.getElementById(removeButtonId);
    if (el.files.item(0).size > 20971520) {
        alert('גודל הקובץ לא יעלה על 20 MB.');
        el.value = "";
    } else {
		let name = el.files.item(0).name;
		let ext_arr = name.split('.');
		let ext = ext_arr[ext_arr.length - 1];
		//const allows = ["doc", "docx", "pdf", "jpg", "jpeg"];
		const allows = ["pdf"];
		const promise = checkmime(el.files.item(0));
		promise.then(
			result => {
			  if (!allows.includes(ext) || result.binaryFileType === "Unknown filetype") {
				name = '';
				el.value = "";
				$(el).parents('.upload-block').find('.btn-input-upload').val('אנא צרף תעודה רלוונטית');
				if (rt && rt.style) rt.style.display='none';
				//alert('העלת קובץ שאינו נתמך, הקבצים שנתמכים הינם מסוג: pdf, jpg, word, jpeg עד לגודל של 20 MB בלבד');
				  alert('העלת קובץ שאינו נתמך, הקבצים שנתמכים הינם מסוג: pdf עד לגודל של 20 MB בלבד');
			  } else {
				  if (rt && rt.style) rt.style.display='';
				  removeError(el);
				  $.each($('.condition-or'), function() {
					  removeError($(this));
				  });
				   $.each($('input[data-val="condition-or"]'), function() {
					    $(this).removeAttr('required');
				   });
			  }
			  $(el).parents('.upload-block').find('.btn-input-upload').val(name);
			},
			error => {
			  if (!allows.includes(ext)) {
				name = '';
				el.value = "";
				$(el).parents('.upload-block').find('.btn-input-upload').val('אנא צרף תעודה רלוונטית');
				if (rt && rt.style) rt.style.display='none';
				alert('העלת קובץ שאינו נתמך, הקבצים שנתמכים הינם מסוג: pdf, jpg, word, jpeg עד לגודל של 20 MB בלבד');
			  } else {
    			  if (rt && rt.style) rt.style.display='';
				  removeError(el);
				   $.each($('.condition-or'), function() {
					   removeError($(this));
				   });
				   $.each($('input[data-val="condition-or"]'), function() {
					    $(this).removeAttr('required');
				   });

			  }
        	  $(el).parents('.upload-block').find('.btn-input-upload').val(name);
			}
		);
    }

	console.log("Type: " + el.files.item(0).type);
}

function removeError(el){
	const trid = $(el).parents('tr').attr('id');
	const elid = $(el).parents('.upload-block').find('.btn-input-upload').attr('id')
	if(trid && $("#" + trid + "").attr('class') && $("#" + trid + "").attr('class') == 'requiredError'){
		$("#" + trid + "").removeClass('requiredError');
	}
	//if(elid && $("#" + elid + "").attr('class') && $("#" + elid + "").attr('class').includes('requiredError')){
	if(elid && $("#" + elid + "").attr('class') && $("#" + elid + "").attr('class').includes('requiredError')){
		$("#" + elid + "").removeClass("requiredError");

	}else
	if(elid && $("input[data-key=" + elid +"]").attr('class') && $("input[data-key=" + elid +"]").attr('class').includes('requiredError')){

		$("input[data-key=" + elid +"]").removeClass("requiredError");
	}
}

function checkmime(file) {
	const filereader = new FileReader();
	return new Promise((resolve, reject) => {
		filereader.onloadend = function(evt) {
			if (evt.target.readyState === FileReader.DONE) {
				const uint = new Uint8Array(evt.target.result)
				let bytes = []
				uint.forEach((byte) => {
					bytes.push(byte.toString(16))
				})
				const hex = bytes.join('').toUpperCase()
				resolve({
					filename: file.name,
					filetype: file.type ? file.type : 'Unknown/Extension missing',
					binaryFileType: getMimetype(hex),
					hex: hex
				});
			}
		}
		const blob = file.slice(0, 4);
		filereader.readAsArrayBuffer(blob);
	});
}

const getMimetype = (signature) => {
	console.log('Signature: ' + signature);
	switch (signature) {
		case '0,504B030414000600':
		case '504B34':
			return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		case '0,0D444F':
		case '0,CF11E0':
		case '0,D0CF11':
		case '0,DBA52D':
		case '512,ECA5':
			return 'application/msword'
		case '25504446':
			return 'application/pdf'
		case 'FFD8FFDB':
		case 'FFD8FFE0':
		case 'FFD8FFE1':
			return 'image/jpeg'
		default:
			return 'Unknown filetype'
	}
}

function removeFile(el,n) {
	$(el).parents('.upload-block').find('.btn-input-upload').val('אנא צרף תעודה רלוונטית');
    var fl=document.getElementById('cfile-upload-' + n);
    var rm=document.getElementById('rcfile-upload-' + n);
    console.log('rmvf',n,fl,rm);
    if (fl) fl.value="";
    if (rm && rm.style) rm.style.display='none';
}

	function resetRadio() {
			$('input[name^="form3_ch2"]').each(function (){
			this.setCustomValidity('');
				$(this).prop('checked', false);
			$(this).parent().find('.virtual').removeClass("requiredError");
		});
	}
