<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }} | {{ request()->host() }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon-16x16.png') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/earlyaccess/opensanshebrew.css" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sky-style.css') }}?v=2" rel="stylesheet">
    <!--<link href="{{ asset('kendo/kendo.common.min.css') }}" rel="stylesheet">
    <link href="{{ asset('kendo/kendo.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('kendo/kendo.default.mobile.css') }}" rel="stylesheet" type="text/css">-->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>


    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/kendo.all.min.js') }}"></script>

    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.default-v2.min.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.1.219/js/kendo.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    @if (isset($appChart))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/v2.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/aaa0796509.js" crossorigin="anonymous"></script>

    <script language="JavaScript">
        function removeCondition(id) {
            event.preventDefault();
            if (document.getElementById(id)) {
                document.getElementById(id).remove();;
            }
        }

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }

        function addElement(block, con, mode, suffix, index = 1) {
            var isDocPos = suffix.indexOf('doc') !== -1 ? suffix.indexOf('doc') : false;
            var currentTime = Date.now() + index;
            var headerClass = '';
            headerClass = suffix.substring(isDocPos, suffix.length);
            if ((suffix == '_tender_add_cond' || isDocPos) && suffix !== '_tender_add_cond_doc6') {
                //if ((suffix == '_tender_add_cond' || isDocPos)) {
                var newAdvanYes = document.createElement("input");
                newAdvanYes.type = "radio";
                newAdvanYes.name = "manual_advan[" + currentTime + "]";
                newAdvanYes.value = "תנאי סף";
                if (suffix !== '_tender_add_cond_doc6') {
                    newAdvanYes.style = "border:1px solid black";
                } else {
                    newAdvanYes.style = "border:1px solid black; display: none;";
                }
                newAdvanYes.classList.add("manual-cond-radio");
                // Set default selection to "תנאי סף" for new elements
                if (mode === 'create') {
                    newAdvanYes.checked = true;
                }
                var labelYes = document.createElement("label");
                if (suffix !== '_tender_add_cond_doc6') {
                    var labelYesContent = document.createTextNode("תנאי סף");
                } else {
                    var labelYesContent = document.createTextNode("תנאי סף");
                }

                var newAdvanNo = document.createElement("input");
                newAdvanNo.type = "radio";
                newAdvanNo.name = "manual_advan[" + currentTime + "]";
                newAdvanNo.value = "יתרון";
                if (suffix !== '_tender_add_cond_doc6') {
                    newAdvanNo.style = "border:1px solid black";
                } else {
                    newAdvanNo.style = "border:1px solid black; display: none;";
                }
                newAdvanNo.classList.add("manual-cond-radio");
                var labelNo = document.createElement("label");

                if (suffix !== '_tender_add_cond_doc6') {
                    var labelNoContent = document.createTextNode("יתרון");
                } else {
                    var labelNoContent = document.createTextNode("יתרון");
                }

                var newAdvanOr = document.createElement("input");
                newAdvanOr.type = "radio";
                newAdvanOr.name = "manual_advan[" + currentTime + "]";
                newAdvanOr.value = "תנאי סף מסוג או";
                newAdvanOr.style = "border:1px solid black;display:none";
                newAdvanOr.classList.add("manual-cond-radio");
                newAdvanOr.classList.add("d-none");
                var labelOr = document.createElement("label");
                var labelOrContent = document.createTextNode("תנאי סף מסוג או");

                if (suffix === '_tender_add_cond_doc4') {
                    var newAdvanConfirm = document.createElement("input");
                    newAdvanConfirm.type = "radio";
                    newAdvanConfirm.name = "manual_advan[" + currentTime + "]";
                    newAdvanConfirm.value = "מאשר/ת שהנני עומד/ת בדרישות אלה";
                    newAdvanConfirm.style = "border:1px solid black";
                    newAdvanConfirm.classList.add("manual-cond-radio");
                    var labelConfirm = document.createElement("label");
                    var labelConfirmContent = document.createTextNode("מאשר/ת שהנני עומד/ת בדרישות אלה");
                }

                if (mode === 'update') {
                    switch (con.option) {
                        case 'not_required':
                            newAdvanNo.checked = true
                            break;
                        case 'required':
                            newAdvanYes.checked = true;
                            break;
                        case 'cond_or':
                            newAdvanOr.checked = true;
                            break;
                        case 'confirm':
                            if (newAdvanConfirm) {
                                newAdvanConfirm.checked = true;
                            } else {
                                newAdvanYes.checked = true; // fallback for sections without confirm option
                            }
                            break;
                        case 'no':
                            // Don't check any radio button for 'no' status
                            break;
                        default:
                            newAdvanYes.checked = true;
                    }
                }
            }
            if ((suffix == '_tender_add_cond' || isDocPos) && suffix === '_tender_add_cond_doc6') {
                var labeldoc6 = document.createElement("label");
                labeldoc6.textContent = "תנאי סףיתרון";
                labeldoc6.style = "display:none";
            }
            var newIcon = document.createElement("i");
            newIcon.classList.add("fas");
            newIcon.classList.add("fa-times");
            // create a new div element
            var newDiv = document.createElement("div");
            //var currentTime = Date.now();
            newDiv.setAttribute("id", currentTime);
            if (suffix == '_tender_or_cond') {
                newDiv.classList.add("condition-or");
            } else {
                newDiv.setAttribute("name", "tender_con_manual[]");
                newDiv.setAttribute("data-val", headerClass);
            }

            newDiv.classList.add("condition");
            // and give it some content
            //if(mode === 'create'){
            var newContent = document.createTextNode(" " + con.value);
            //}
            // add the text node to the newly created div
            newDiv.appendChild(newIcon);
            newDiv.appendChild(newContent);
            if ((suffix == '_tender_add_cond' || isDocPos) && suffix !== '_tender_add_cond_doc6') {
                //if ((suffix == '_tender_add_cond' || isDocPos)) {
                newDiv.appendChild(newAdvanYes);
                newDiv.appendChild(labelYesContent);
                newDiv.appendChild(newAdvanNo);
                newDiv.appendChild(labelNoContent);
                newDiv.appendChild(newAdvanOr);
                // newDiv.appendChild(labelOrContent);
                if (newAdvanConfirm && labelConfirmContent) {
                    newDiv.appendChild(newAdvanConfirm);
                    newDiv.appendChild(labelConfirmContent);
                }
            } else {
                if (suffix === '_tender_add_cond_doc6') {
                    newDiv.appendChild(labeldoc6);
                }
            }
            newIcon.setAttribute("onclick", 'removeCondition(' + newDiv.getAttribute('id') + ')');
            // add the newly created element and its content into the DOM
            //var currentDiv = document.getElementById(block);

            var nodeList = document.querySelectorAll('[data-val=' + headerClass + ']');
            if (nodeList.length === 0) {
                var currentDiv = document.getElementById(block);
            } else {
                var currentDiv = nodeList[nodeList.length - 1];
            }
            insertAfter(currentDiv, newDiv);
            // Don't clear input field - user wants to keep the text after adding
            // if (mode === 'create') {
            //     var input = document.getElementById('modal' + suffix);
            //     if (input == null) {
            //         input = document.getElementById('emodal' + suffix);
            //     }
            //     if (input) {
            //         input.value = "";
            //     }
            // }
        }

        function new_dublibe(block, suffix) {
            var con = document.getElementById('modal' + suffix);
            if (con == null) {
                con = document.getElementById('emodal' + suffix);
            }
            if (con.value == '') {
                console.log('Please fill text');
                return;
            }
            var langPos = document.getElementById(block);
            addElement(block, con, 'create', suffix);
            // Don't clear the input field - keep the text for user convenience
            con.value = '';
        }

        function update_dublibe(block, suffix, con, index) {
            /*var con = document.getElementById('modal'+suffix);
            if(con == null){
            	con = document.getElementById('emodal'+suffix);
            }*/

            //var langPos = document.getElementById(block);
            addElement(block, con, 'update', suffix, index);
        }

        function dublibe(block, line) {
            var langPos = document.getElementById(block);
            var langLine = document.getElementById(line).cloneNode(true);
            // console.log('ll', langLine);
            var lido = (langLine.querySelector("input").id);
            var lid = parseInt(lido.substr(lido.lastIndexOf('_') + 1)) + 1;
            langLine.querySelector("input").id = "modal_tender_email_" + Math.round(Math.random(10000) * 10000);

            langLine.querySelector("input").value = ""
            //langLine.value='';
            langPos.appendChild(langLine);
            // console.log(langPos, langLine);
            //alert('111');
        }

        function addwd(id, name) {
            // console.log('idd',id,txt);
            if (!window.addArr || !window.addArr.push) window.addArr = [];
            window.addArr.push({
                id,
                name
            })
            drawWd();
            var doc = document.getElementById('modal_userch');
            if (doc) doc.innerHTML = '';
            var doc2 = document.getElementById('modal_tender_email_1');
            if (doc2) doc2.value = '';
        }

        function deleteFromWd(i) {
            if (window.addArr && window.addArr.filter) {
                console.log('dlt', i);
                window.addArr = window.addArr.filter(function(e) {
                    return e.id !== i;
                })
                drawWd();
            }

        }

        function drawWd() {
            var doc = document.getElementById('modal_users');
            if (doc && window.addArr) {
                var elist = window.addArr.map(function(e) {
                    return '<button class="abtn2">' + e.name + '&nbsp;<span onclick="deleteFromWd(' + e.id +
                        ')" class="clibutton">x</span></button>';
                });
                // console.log('eeelist',elist);

                doc.innerHTML = elist.join('');
            }
        }

        function showUsers(data) {
            // console.log('dat',data);
            var doc = document.getElementById("modal_userch");
            if (doc && data && data.length > 0) {
                // let resArr=[];
                var newdata = data.map(function(e) {
                    var line = '<button class="abtn" onclick="addwd(' + e.id + ',\'' + e.name.replace(/'/g, "") +
                        '\')">' + e.name + '</button>';
                    console.log(line);

                    return line;
                });
                //   console.log('da',newdata,newdata.join(''));

                doc.outerHTML = '<div id="modal_userch" class="modal_userch">' + newdata.join('') + '</div>';

                //                        <div id="pref_userch" style="width:200px;height:50px;"></div>
            }
        }

        function showAddUserDec(decisionId, data3, data) {
            // console.log('dat',decisionId,data,data3);
            var doc = document.getElementById("userlist");

            if (doc && data && data.length > 0) {
                // let resArr=[];
                var newdata = data.map(function(e) {
                    var line = '<button class="abtnA" onclick="addwdU(' + e.id + ',' + decisionId + ')">' + e.name +
                        '</button>';
                    console.log(line);

                    return line;
                });
                //   console.log('da',newdata,newdata.join(''));

                doc.innerHTML = '<div id="modal_userch" class="modal_userch">' + newdata.join('') + '</div>';

                //                        <div id="pref_userch" style="width:200px;height:50px;"></div>
            }
        }

        async function addwdU(userId, decisionId) {
            var request = {
                userId,
                decisionId
            }
            var rq = createandSendRequestAjax('/admin/adduserdecision', request);
            rq.then(reload);

        }

        async function delLw(userId, decisionId) {
            var request = {
                userId,
                decisionId
            }
            var rq = createandSendRequestAjax('/admin/deluserdecision', request);

            rq.then(reload);

        }


        async function checkUserEmail() {
            //findusers;
            // alert('chk');

            var doc = document.getElementById("modal_tender_email_1");

            console.log('chk', doc.value);
            if (doc.value && doc.value.length > 1) {
                var request = {
                    name: doc.value,
                    noshow: true
                }
                var rq = createandSendRequestAjax('/admin/findusers', request);
                rq.then(showUsers);
            }
        }

        async function checkUserDecision(decision) {
            var doc = document.getElementById("adduser_decision");
            console.log(doc, doc.value);
            var request = {
                name: doc.value,
                noshow: true
            }
            var rq = createandSendRequestAjax('/admin/findusers', request);
            rq.then(showAddUserDec.bind(this, decision, checkUserDecision));

        }


        async function showRequestNewFile(dec) {
            var doc = document.getElementById('files_comment');
            // console.log('dd',doc);

            if (doc && doc.style) {
                doc.style.display = '';
                //  doc.style.width=200;
                //doc.style.height=200;
                // doc.style.border="thin solid green";
            }

        }

        async function requestNewFile(dec) {
            function close() {
                $('.load_container').hide();
                window.location.reload();

            }
            var req = {};

            var data = document.getElementById('files_comment_data');
            if (data) {
                req = {
                    msg: data.value
                };
                //console.log(req);
            }



            var rt = createandSendRequestAjax('/admin/reqadd/' + dec, req);
            rt.then(close);

        }

        async function createandSendRequestAjax(url0, tenderdata, callable = null) {

            if (tenderdata && !tenderdata.noshow)
                $('.load_container').show();

            var token = document.getElementsByName('csrf-token')[0].content;
            // console.log(tenderdata.name);
            var data = {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-TOKEN": token
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *client
                body: JSON.stringify(tenderdata) // body data type must match "Content-Type" header
            };
            var url = window.location.protocol + '//' + window.location.host + url0;

            return fetch(url, data)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (callable != null) {
                            callable(data)
                        }
                        return data;
                    } catch (e) {
                        console.error('JSON Parse Error:', e, 'Response text:', text);
                        // If it's a simple string (like tender ID), return it directly
                        if (text.startsWith('"') && text.endsWith('"')) {
                            const cleanText = text.slice(1, -1); // Remove quotes
                            if (callable != null) {
                                callable(cleanText)
                            }
                            return cleanText;
                        }
                        throw e;
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            /*   .then((myJson) => {
                   console.log(myJson);
               })*/
            ;


        }

        const reload = () => {
            //console.log(window);
            $('.load_container').hide();

            window.location.reload();
        }

        function create_elem(data) {
            var html = '';
            for (var i = 0; i < data.length; i++) {
                var elem = '';
                if (data[i].type == 'select') {
                    elem += "<select id='comment_text_reject' class='" + data[i].class + "' >";
                    for (var o = 0; o < data[i].option.length; o++) {
                        elem += "<option value='" + o + "'>" + data[i].option[o] + "</option>";
                    }
                    elem += "</select>";
                } else if (data[i].type == 'input') {
                    elem += "<input id='comment_text' class='" + data[i].class + "' type='" + data[i].it +
                        "' placeholder='" + data[i].placeholder + "' >";
                } else if (data[i].type == 'textarea') {
                    elem += "<textarea id='comment_text' class='" + data[i].class + "' rows='" + data[i].rows +
                        "'></textarea>";
                }
                html += elem;
            }
            return html;
        }

        function cond_details(elem, dec, decId, data = false, tstyle) {
            event.preventDefault();
            if ($('.cancel_file_content').length < 1) {
                event.stopPropagation();
                var html = '';
                //var t = '"'+type+'"';
                if (data) {
                    html = "<div class='cancel_file_content tk3' style='" + tstyle + "'>";
                    html += create_elem(data);
                } else {
                    html = "<div class='cancel_file_content tk2'>";
                }
                //html += "<textarea class='cancel_file_text' rows='4'></textarea>";
                //$(elem).parents('#buttons-content').addClass('margin-b200');
                html += "<a href='#' class='cancel_file_btn' onclick='send_decision(" + dec + "," + decId +
                    ");'>שלח  </a></div>";
                $(elem).addClass('beforecolor');
                var top = $(elem).offset().top;
                $('body').append(html);
                $('.cancel_file_content').css({
                    'top': top
                });
                if (dec != 0 && dec != 1) {
                    elem.parentElement.parentElement.style.marginBottom = "200px";
                }
                return false;
            }
        }

        async function send_decision(dec, decId) {
            console.log(dec);
            var comment = '';
            var text = document.getElementById('comment_text');
            var comment_text_reject = document.getElementById('comment_text_reject');
            var desired_hourly_rate = document.getElementById('desired_hourly_rate');
            if (text) comment = text.value;
            if (comment_text_reject) comment = comment + comment_text_reject.value;
            if (comment == '') {
                console.log('comment is empty');
            }
            if (text) {
                var text_value = text.value;
            }
            if (desired_hourly_rate) {
                var desired_hourly_rate_value = desired_hourly_rate.value;
            }
            if (comment_text_reject) {
                var comment_text_reject_value = comment_text_reject.value;
            }
            var data = {
                dec,
                decId,
                text_value,
                comment_text_reject_value,
                comment,
                desired_hourly_rate_value
            };
            var rt = createandSendRequestAjax('/admin/tenders/decision/' + decId + '/' + dec, data);

            rt.then(function(data) {
                if (data.res == 'nok') {
                    alert(data.error)
                } else {

                }

                window.location.reload();

            });


        }

        function approveShowDecision(decId) {
            var el = document.getElementById('comment_block');
            if (el) {
                el.style.display = '';
            }
        }

        function rejectShowDecision(decId) {
            var el = document.getElementById('comment_block_reject');
            if (el) {
                el.style.display = '';
            }
        }

        async function onInitOpen(a) {

        }

        async function onOpen(a) {

            console.log('onOpen', a, a.sender.options, window.editW);

            //edittender


        }

        async function editA(tenderId, type, duplicate = false) {
            $('.load_container').show();
            var tenderData = await createandSendRequestAjax('/admin/tenders/gettenderdata/' + tenderId, false, function(
                tenderData) {
                // try {
                //     var job_details = [];
                //     tenderData.job_details.forEach(element => {
                //         job_details.push(parseInt(element))
                //     });
                //     console.log(job_details);
                //     $('#jobDetails').val(job_details).change()

                //     var userIDs = [];
                //     tenderData.user.forEach(element => {
                //         userIDs.push(parseInt(element.id))
                //     });
                //     $('#userSelect').val(userIDs).change()
                //     console.log('form callback');
                // } catch (error) {
                //     console.log('form callback error ', error);
                // }
            });
            $('.load_container').hide();
            var modal = document.getElementById("editModal");
            var modalin = document.getElementById("modalcontent");
            modal.style.display = "block";
            var span = document.getElementsByClassName("editclose")[0];

            // 		if(type==2){
            // 			var tempHTML = `<div class="input-control"><label for="hasSalaryInput" class="hasSalary caption captiogreen">Has Salary</label> <input type="checkbox" id="hasSalaryInput" name="has-salary" />
        //     <input type="number" style="display:none" min="1" class="input-control" id="salaryInput" name="salary">
        // </div>`;
            // 		}else{
            // 			var tempHTML = '';
            // 		}

            // When the user clicks on <span> (x), close the modal
            var tenderContent = getTenderHtml('emodal'); //tenderContent.replace(/pref/g, 'modal')
            // console.log('aa', modalin.outerHTML, tenderContent);
            var ttype1 = tenderData.ttype == 1 ? 'checked' : "";
            var ttype2 = tenderData.ttype == 2 ? 'checked' : "";
            var ttype3 = tenderData.ttype == 3 ? 'checked' : "";
            var tempHTML = `<div class="form-group">
        <div class="row">
			<div class="col-auto mr-2 custom-control custom-checkbox"><input type="checkbox" ${tenderData.has_salary ? `checked=""` : ``} id="hasSalaryInput" class="custom-control-input" name="has-salary" /><label for="hasSalaryInput" class="hasSalary caption captiogreen custom-control-label">שכר</label> </div>
			<div class="col-auto"><input placeholder="הזן את השכר המוצע למשרה" value="${tenderData.salary}" type="text" style="${tenderData.has_salary == 1 ? `` : 'display:none'}" min="1" class="form-control mx-2 w-auto" id="salaryInput" name="salary"></div>
            </div>
    </div>`;


            var commonHTML = `${options__list}<br>${jobDetails__option}<br><div class="row mx-2">${functional__level__list}${is_recommended_block}${is_test_required_block}${is_protocol_required_block}</div><br><div class="col-12">

                </div>`


            if (type == 0 || type == 4) {
                modalin.outerHTML = `<div id="modalcontent">${tenderContent}<div style="" >` +
                    '                <div class="text-right mr-2 tenderTypeWrap"><label>' +
                    '                    <div class="caption captiobblue" style="font-weight: bold;">מכרז</div><br>\n' +
                    '                    <label class="radio">\n' +
                    '                        <input type="radio" name="modal_tender_type"  ' + ttype1 +
                    ' value="yes" required="true" id="emodal_tender_type_yes">\n' +
                    '                        <span class="virtual"></span>\n' +
                    '                        <span class="caption"> מכרז פנימי</span>\n' +
                    '                    </label>\n' +
                    '                    <label class="radio">\n' +
                    '                        <input type="radio" name="modal_tender_type"  ' + ttype2 +
                    '  value="no"  id="emodal_tender_type_no" required="true">\n' +
                    '                        <span class="virtual"></span>\n' +
                    '                        <span class="caption">  מכרז חיצוני</span>\n' +
                    '                    </label>\n' +
                    '                    <label class="radio">\n' +
                    '                        <input type="radio" name="modal_tender_type"  ' + ttype3 +
                    ' value="3" required="true" id="emodal_tender_type_both">\n' +
                    '                        <span class="virtual"></span>\n' +
                    '                        <span class="caption"> פנימי/ חיצוני</span>\n' +
                    '                    </label>\n' +
                    '                </label>\n' +
                    '            </div>' +

                    '<br><div class="w-100">' + `<br>${tempHTML} <br>` + commonHTML +
                    '</div><div class="w-100 text-center">' +
                    `<button  class="btn" onclick="${duplicate ? 'createTender' : 'updateTender'}(` + "'" +
                    tenderId + "'" + `${duplicate? ',true' : ''}` +
                    ')" style="margin:auto auto 10px 10px">' + `${duplicate ? 'שכפול מכרז' : 'עדכן'}` + ' </button>' +
                    '</div>' +

                    '</div></div>';
            } else {
                modalin.outerHTML = '<div id="modalcontent">' + tenderContent +
                    ' ' + `<br>${tempHTML} <br>` + commonHTML +
                    `<button  class="btn" onclick="${duplicate ? 'createTender' : 'updateTender'}(` + "'" +
                    tenderId + "'" + `${duplicate? ',true' : ''}` +
                    ')" style="margin:auto auto 10px 10px">' + `${duplicate ? 'שכפול מכרז' : 'עדכן'}` +
                    ' </button></div>';
            }






            try {
                $('#input_manager').val(tenderData.input_manager)
                $('#job_scope').val(tenderData.job_scope)
                $('#subordinations').val(tenderData.subordinations)
                $('#grades_voltage').val(tenderData.grades_voltage)
                $('#bodies_input').val(tenderData.body)
            } catch (error) {
                console.log('form callback error ', error);
            }

            try {
                var userIDs = [];
                tenderData.user.forEach(element => {
                    userIDs.push(parseInt(element.id))
                });
                $('#userSelect').val(userIDs).change()
                console.log('form userIDs callback', userIDs);
            } catch (error) {
                console.log('form callback error ', error);
            }

            $('#functional__level_select').val(tenderData.functional_level).change()
            $('#template_input').val(tenderData.template_id).change()
            console.log("protocol:" + tenderData.is_protocol);

            $('#is_protocol_required_checkbox').attr('checked', tenderData.is_protocol == 1).change()
            $('#is_test_required_checkbox').attr('checked', tenderData.is_test_required == 1).change()
            $('#is_recommended_checkbox').attr('checked', tenderData.is_recommended == 1).change()



            var clean_num_value = tenderId;
            var tt = document.getElementById('emodal_tender_type');
            var tn = document.getElementById('emodal_tender_name');
            var eusers = document.getElementById('emodal_users');
            var econds = document.getElementById('emodal_conds');
            var tnum = document.getElementById('emodal_tender_num');
            var display = document.getElementById('emodal_tender_num_display');
            display.value = tenderData.generated_id;
            var brunch = document.getElementById('emodal_tender_brunch');
            brunch.value = tenderData.brunch;
            var email = document.getElementById('emodal_tender_email_1');
            if (email && email.style) email.style.display = 'none';
            if (tt) tt.value = tenderData.tender_type;
            if (tn) tn.value = tenderData.tname;
            if (tnum) tnum.value = tenderData.tender_number;
            if (eusers && tenderData && tenderData.users && tenderData.users.length > 0) {
                // if (tenderData && )
                let line = tenderData.users.map((e) => {
                    return ('<span>' + e.name + '</span>');
                })
                console.log('lkl', line);
                eusers.innerHTML = line.join('');

            }
            /*if (econds && tenderData && tenderData.conditions && tenderData.conditions.length>0)
            {
                let line=tenderData.conditions.map((e)=>{return ('<span>'+e+'</span>&nbsp; ');})
                console.log('lkl',line);
                econds.style.display='block';
                econds.innerHTML=line.join('');
                var doc=document.getElementById('emodal_cond_main');
                if (doc && doc.style) doc.style.display='none';


            }*/
            // Load existing conditions and qualifications
            if (tenderData && tenderData.conditions && tenderData.conditions.length > 0) {
                console.log('Loading conditions:', tenderData.conditions);

                // Parse qualifications to understand section structure
                const qualificationsArray = tenderData.qualifications.split("#$$#");

                // Process each condition and map it to the correct section
                for (let i = 0; i < tenderData.conditions.length; i++) {
                    var condition = tenderData.conditions[i];

                    // Skip section headers (they start with '=>' but don't have qualification text)
                    if (condition.includes('=>') && !condition.startsWith('=>')) {
                        var parts = condition.split('=>');
                        if (parts.length >= 2) {
                            var qualificationText = parts[0].trim();
                            var statusPart = parts[1].trim();

                            // Check if the condition has section information (new format)
                            var status = statusPart;
                            var targetSectionId = null;

                            // Check if status part contains section info (format: "status[section]")
                            var sectionMatch = statusPart.match(/^(.+)\[doc(\d+)\]$/);
                            if (sectionMatch) {
                                status = sectionMatch[1];
                                targetSectionId = 'doc' + sectionMatch[2];
                                console.log('Found section info in condition:', targetSectionId, 'status:', status);
                            } else {
                                // Fallback: try to match condition text to qualification sections
                                for (let q = 0; q < qualificationsArray.length && q < 6; q++) {
                                    var sectionText = qualificationsArray[q] ? qualificationsArray[q].trim() : '';
                                    var sectionId = 'doc' + (q + 1);

                                    // Check if the qualification text matches this section's content
                                    if (sectionText.length > 0 && sectionText.includes(qualificationText)) {
                                        targetSectionId = sectionId;
                                        console.log('Matched condition to section by text:', targetSectionId);
                                        break;
                                    }
                                }

                                // If still no match, assign to first section with content
                                if (!targetSectionId) {
                                    for (let q = 0; q < qualificationsArray.length && q < 6; q++) {
                                        var sectionText = qualificationsArray[q] ? qualificationsArray[q].trim() : '';
                                        if (sectionText.length > 0) {
                                            var existingConditions = document.querySelectorAll('#emodal_cond_block_doc' + (q + 1) + ' .condition[data-val="doc' + (q + 1) + '"]');
                                            if (existingConditions.length === 0) {
                                                targetSectionId = 'doc' + (q + 1);
                                                console.log('Assigned condition to first available section:', targetSectionId);
                                                break;
                                            }
                                        }
                                    }
                                }
                            }

                            console.log('Loading condition:', qualificationText, 'with status:', status, 'to section:', targetSectionId);

                            // Add the condition to the target section
                            if (targetSectionId) {
                                var con = {
                                    value: qualificationText,
                                    option: status
                                };

                                console.log('Adding to section:', targetSectionId, con);
                                update_dublibe('emodal_cond_block_' + targetSectionId, '_tender_add_cond_' + targetSectionId, con, i);
                            }
                        }
                    }
                }
            }
            const qualificationsArray = tenderData.qualifications.split("#$$#");
            for (let q = 0; q < qualificationsArray.length; q++) {
                document.getElementById("emodal_tender_add_cond_doc" + (q + 1)).value = qualificationsArray[q];
            }
            var title = document.getElementById("emodal_addupdatetitle");
            title.innerText = 'עריכת מכרז';
            if (duplicate) {
                title.innerText = ('שכפול מכרז')
            }

            //  } else console.log('no kendo found...');
            // */
            console.log(tenderData);
            $("#emodal_picker_start").kendoDateTimePicker({
                format: "yyyy dd MMMM HH:mm",
                value: (new Date(tenderData.start_date)),
                dateInput: true,
                min: new Date("{{ today()->format('Y-m-d') }}")
            });
            $("#emodal_picker_final").kendoDateTimePicker({
                format: "yyyy dd MMMM HH:mm",
                value: (new Date(tenderData.finish_date)),
                dateInput: true,
                min: new Date("{{ today()->format('Y-m-d') }}")
            });
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Education and professional requirements (השכלה ודרישות מקצועיות)
            $('#emodal_tender_add_cond_doc1').autocomplete({
                source: [
                    "שנות לימוד / תעודת בגרות12",
                    "תואר ראשון ממוסד אקדמי",
                    "תעודת הוראה",
                    "תואר שני",
                    "אישור רישום בפנקס העוס״ים"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Professional courses and trainings (קורסים והכשרות מקצועיות)
            $('#emodal_tender_add_cond_doc2').autocomplete({
                source: [],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Professional experience (ניסיון מקצועי)
            $('#emodal_tender_add_cond_doc3').autocomplete({
                source: [
                    "ניסיון של"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Additional requirements (דרישות נוספות)
            $('#emodal_tender_add_cond_doc4').autocomplete({
                source: [
                    "רישום פלילי - היעדר הרשעה פלילית והיעדר רישום על עברות מין",
                    "רישיון נהיגה – בתוקף"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Management experience (ניסיון ניהול)
            $('#emodal_tender_add_cond_doc5').autocomplete({
                source: [
                    "ניסיון של ניהול צוות עובדים"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })
            console.log(tenderData.is_drushim);
            if (tenderData.is_drushim) {
                $('#modal_addupdatetitle').html($('#emodal_addupdatetitle').html().replaceAll('מכרז', 'דרושים'))
                $('.tenderTypeWrap').html($('.tenderTypeWrap').html().replaceAll('מכרז', 'דרושים'))
            }
            if (duplicate) {
                var tenderId = await getNewTenderId(); // ('/admin/tenders/gettenderdata/' + tenderId);
                // document.getElementById("emodal_tender_num_display").value = tenderId;
                // $('#emodal_tender_num_display,#modal_tender_num').val(tenderId)
                $('#emodal_tender_num_display').val(tenderId)
                $('#emodal_tender_num').val(tenderData.tender_number)
            }

            $('#userSelect,#functional__level_select').select2();
            $('.load_container').hide();

            // When the user clicks anywhere outside of the modal, close it
            /* window.onclick = function (event) {
                            if (event.target == modal) {
                                console.log('tmp');
                                modal.style.display = "none";
                            }
                        }
            			*/

        }

        async function dubA(tenderId) {
            // console.log(dec);
            //  var data={dec,decId}
            var rt = createandSendRequestAjax('/admin/tenders/dub/' + tenderId);
            rt.then(reload);
        }

        async function delA(tenderId) {
            if (confirm("האם בטוח שברצונך למחוק מכרז זה?")) {
                var rt = createandSendRequestAjax('/admin/tenders/del/' + tenderId);
                rt.then(reload);
            }
        }

        async function saveStatus(ele, tenderId) {

            //	  var tenderStatus = $('#tender_status').find(":selected").val();
            // var optionSelected = $("option:selected", ele);
            var tenderStatus = ele.value;

            var data = {
                tenderStatus
            };
            var rt = createandSendRequestAjax('/admin/tenders/save/' + tenderId, data);
            rt.then(reload);

        }

        async function stopA(tenderId) {
            createandSendRequestAjax('/admin/tenders/stop/' + tenderId)
                .then(reload);

        }

        async function continueA(tenderId) {
            var rt = createandSendRequestAjax('/admin/tenders/continue/' + tenderId);
            rt.then(reload);
        }

        async function updateTender(tenderid) {
            //alert('1u');
            var rt = await createUpdateTender('update', tenderid);
            console.log('upd', rt);
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
            $('.load_container').hide();
            // Reload the page to show updated data
            window.location.reload();
        }
        /*
                async function createUpdateTender(mode, tenderid) {
                    var prefix = mode === 'create' ? 'modal' : 'emodal';
        			var clean_num_value = tenderid;
                    var doc = document.getElementById(prefix + "_tender_name");
        			var brunch = document.getElementById(prefix + "_tender_brunch");
        			var is_exist_yes = document.getElementById(prefix + "_is_exist_yes");
        			var is_exist = false;
        			if (is_exist_yes && is_exist_yes.checked){
        				is_exist = true;
        			} else {
        				is_exist = false;
        			}
                    var num = document.getElementById(prefix + "_tender_num");
        			var display = document.getElementById(prefix + "_tender_num_display");
        			display.value = num.value;
                    var ttype_yes=document.getElementById(prefix + "_tender_type_yes");
                    var ttype_no=document.getElementById(prefix + "_tender_type_no");
        			var ttype_both=document.getElementById(prefix + "_tender_type_both");

                   // title.innerText= (mode === 'create')?'הוספת משרה חדשה':'עריכת משרה'+2;
                    var ttype=0;
                   // console.log('cup', mode,ttype,ttype_yes,ttype_no);

                    if (ttype_yes && ttype_yes.checked) ttype=1;
                    if (ttype_no && ttype_no.checked) ttype=2;
        			if (ttype_both && ttype_both.checked) ttype=3;

                    //console.log('ss', num);
                    var date_start = document.getElementById(prefix + "_picker_start");
                    var emails = document.getElementsByName(prefix + "_tender_email[]");
                    var eline = [];
                    for (let i = 0; i < emails.length; i++) {
                        var val = emails[i] ? emails[i].value : false;
                        //  console.log('cc',val);
                        if (val) eline.push(val);
                    }
                    var enames = [];
                    if (window.addArr) {
                        for (let i = 0; i < window.addArr.length; i++) {
                            var val = window.addArr[i] ? window.addArr[i].id : false;
                            //  console.log('cc',val);
                            if (val) enames.push(val);
                        }
                    }
        			//var cond_manual = $('input[name="tender_con_manual[]"]');
        			var cond_manual = document.getElementsByName("tender_con_manual[]");
        			var cond_manual_advantage = $('.manual-cond-radio');
        			var cond = $('input[name^="'+ prefix +'_tender_cond"]');
        			var cond_advantage = $('input[name^="'+ prefix +'_advantage"]');
        			var cond_or = $('.condition-or');
                    var cline = [];
        			for (let i = 0; i < cond.length; i++) {
        				var y = Number(i*2);
        				var val1 = cond[i].value;
        				var obj = '';
        				if (cond_advantage[y] && cond_advantage[y].checked){
        					obj = val1 + '=>' + 'required' + '['+ i +']';
        				} else {
        					obj = val1 + '=>' + 'not_required' + '['+ i +']';
        				}
        				var val2 = cond[i] && cond[i].checked ? true : false;
                        console.log('cc2', val2);
                        if (val2) cline.push(obj);
                    }
        			let counter1 = 0;
        			for (let i = 0; i < cond_manual.length; i++){
        				var val1 = cond_manual[i] ? cond_manual[i].textContent : false;
        				var cpos = val1.indexOf("תנאי סףיתרון");
        				if (cpos != -1){
        					counter1++;
        					let x = Number(3*counter1);
        					val1 = val1.substring(0, cpos);
        					var obj = '';
        					if (cond_manual_advantage[x-3] && cond_manual_advantage[x-3].checked){
        						obj = val1 + '=>' + 'required';
        					}
        					if (cond_manual_advantage[x-2] && cond_manual_advantage[x-2].checked){
        						obj = val1 + '=>' + 'not_required';
        					}
        					if (cond_manual_advantage[x-1] && cond_manual_advantage[x-1].checked){
        						obj = val1 + '=>' + 'cond_or';
        					}
        					if (obj) cline.push(obj);
        				} else {
        					if (val1) cline.push(val1);
        				}
        				console.log('cc1', val1);
        				console.log('obj', obj);
        			}

        			for (let i = 0; i < cond_or.length; i++){
        				var val_or = cond_or[i] ? cond_or[i].textContent : false;
        				var obj = '';
        				obj = val_or + '=>' + 'cond_or';
        				console.log('cc_or', obj);
        				if (val_or) cline.push(obj);
        			}

                    var date_finish = document.getElementById(prefix + "_picker_final");
        			var tender_type = document.getElementById(prefix + '_tender_type');
                    var tenderdata = {
                        name: doc.value,
        				brunch: brunch.value,
        				is_exist: is_exist,
        				display: display.value,
                        num: clean_num_value,
                        start: date_start.value,
                        finish: date_finish.value,
                        email: eline,
                        ttype:ttype,
                        enames: enames,
                        conditions: cline,
        				tender_type: tender_type.value
                    };
                    console.log('corrected:', tenderdata);


                    $('.load_container').show();

                    var rt = createandSendRequestAjax('/admin/tenders/' + (mode === 'create' ? 'create' : 'updatetender/' + clean_num_value), tenderdata);
                    //  console.log('rr', rt);
                    rt.then((e) => {
                        //console.log('twnd', e);
                        $('.load_container').hide();
                        if (e.id > 0) window.location.reload();
                    });
                    return rt;

                }
        */
        async function createUpdateTender(mode, tenderid, duplicate = false) {
            var prefix = (mode === 'create' && !duplicate) ? 'modal' : 'emodal';

            var clean_num_value = tenderid;
            var doc = document.getElementById(prefix + "_tender_name");
            var brunch = document.getElementById(prefix + "_tender_brunch");
            var is_exist_yes = document.getElementById(prefix + "_is_exist_yes");
            var is_exist = false;
            if (is_exist_yes && is_exist_yes.checked) {
                is_exist = true;
            } else {
                is_exist = false;
            }
            var num = document.getElementById(prefix + "_tender_num");
            var display = document.getElementById(prefix + "_tender_num_display");
            // if(!duplicate){
            //     display.value = num.value;
            // }else{
            //     var doc = document.getElementById("emodal_tender_name");
            //     var brunch = document.getElementById( "emodal__tender_brunch");
            // var is_exist_yes = document.getElementById( "emodal__is_exist_yes");
            // var is_exist = false;
            // if (is_exist_yes && is_exist_yes.checked) {
            //     is_exist = true;
            // } else {
            //     is_exist = false;
            // }
            // }
            var ttype_yes = document.getElementById(prefix + "_tender_type_yes");
            var ttype_no = document.getElementById(prefix + "_tender_type_no");
            var ttype_both = document.getElementById(prefix + "_tender_type_both");
            var is_personal_contract_yes = document.getElementById(prefix + "_is_personal_contract_yes");
            var is_personal_contract_no = document.getElementById(prefix + "_is_personal_contract_no");
            // title.innerText= (mode === 'create')?'הוספת מכרז חדש':'עריכת מכרז'+2;
            var ttype = 0;
            // console.log('cup', mode,ttype,ttype_yes,ttype_no);

            if (ttype_yes && ttype_yes.checked) ttype = 1;
            if (ttype_no && ttype_no.checked) ttype = 2;
            if (ttype_both && ttype_both.checked) ttype = 3;

            var is_personal_contract = 0;
            if (is_personal_contract_yes && is_personal_contract_yes.checked) is_personal_contract = 1;
            if (is_personal_contract_no && is_personal_contract_no.checked) is_personal_contract = 2;
            //console.log('ss', num);
            var date_start = document.getElementById(prefix + "_picker_start");
            var emails = document.getElementsByName(prefix + "_tender_email[]");
            var eline = [];
            for (let i = 0; i < emails.length; i++) {
                var val = emails[i] ? emails[i].value : false;
                //  console.log('cc',val);
                if (val) eline.push(val);
            }
            var enames = [];
            if (window.addArr) {
                for (let i = 0; i < window.addArr.length; i++) {
                    var val = window.addArr[i] ? window.addArr[i].id : false;
                    //  console.log('cc',val);
                    if (val) enames.push(val);
                }
            }
            //var cond_manual = $('input[name="tender_con_manual[]"]');
            var cond_manual = document.getElementsByName("tender_con_manual[]");
            var cond_manual_advantage = $('.manual-cond-radio');
            //var cond = $('input[name^="'+ prefix +'_tender_cond"]');
            var cond_advantage = $('input[name^="' + prefix + '_advantage"]');
            var cond_or = $('.condition-or');
            var cline = [];
            var qualifications = "";
            for (let c = 1; c < 7; c++) {
                if (c == 1) {
                    qualifications = document.getElementById(prefix + "_tender_add_cond_doc" + c).value;
                } else {
                    qualifications += "#$$#" + document.getElementById(prefix + "_tender_add_cond_doc" + c).value;
                }
            }
            /*for (let i = 0; i < cond.length; i++) {
        				let y = Number(i*2);
        				var val1 = cond[i].value;
        				var obj = '';
        				if (cond_advantage[y] && cond_advantage[y].checked){
        					obj = val1 + '=>' + 'required';
        				} else {
        					obj = val1 + '=>' + 'not_required';
        				}
        				var val2 = cond[i] && cond[i].checked ? true : false;
                        console.log('cc2', val2);
                        if (val2) cline.push(obj);
                    }*/
            let counter1 = 0;
            let counter2 = 0;
            let x = 0;
            console.log('qualifications', qualifications);

            console.log('cond_manual', cond_manual_advantage);

            // Don't add section headers to conditions as they interfere with page5 form file upload logic
            // The page5 form will handle section headers separately based on qualification content

            for (let i = 0; i < cond_manual.length; i++) {
                var val1 = cond_manual[i] ? cond_manual[i].textContent : false;
                var obj = '';

                if (val1) {
                    // Extract text before radio buttons
                    var cpos1 = val1.indexOf("תנאי סף");
                    if (cpos1 != -1) {
                        val1 = val1.substring(0, cpos1).trim();
                    }

                    // Get the section identifier from data-val attribute
                    var sectionId = cond_manual[i].getAttribute('data-val');

                    // Find all radio buttons within this condition element
                    var radioButtons = cond_manual[i].querySelectorAll('input[type="radio"]');
                    var selectedValue = null;

                    for (let j = 0; j < radioButtons.length; j++) {
                        if (radioButtons[j].checked) {
                            selectedValue = radioButtons[j].value;
                            break;
                        }
                    }

                    // Map the selected value to the appropriate status and include section info
                    if (selectedValue) {
                        switch (selectedValue) {
                            case 'תנאי סף':
                                obj = val1 + '=>' + 'required[' + sectionId + ']';
                                break;
                            case 'יתרון':
                                obj = val1 + '=>' + 'not_required[' + sectionId + ']';
                                break;
                            case 'תנאי סף מסוג או':
                                obj = val1 + '=>' + 'cond_or[' + sectionId + ']';
                                break;
                            case 'מאשר/ת שהנני עומד/ת בדרישות אלה':
                                obj = val1 + '=>' + 'confirm[' + sectionId + ']';
                                break;
                            default:
                                obj = val1 + '=>' + 'no[' + sectionId + ']';
                        }
                    } else {
                        // No radio button selected, default to 'no' (which will show as "ממתין לאישור")
                        obj = val1 + '=>' + 'no[' + sectionId + ']';
                    }

                    if (obj) {
                        cline.push(obj);
                    }
                }
                console.log('val1', val1);
                console.log('obj', obj);
            }
            console.log('cline', cline);
            for (let i = 0; i < cond_or.length; i++) {
                var val_or = cond_or[i] ? cond_or[i].textContent : false;
                var obj = '';
                obj = val_or + '=>' + 'cond_or';
                console.log('cc_or', obj);
                if (val_or) cline.push(obj);
            }

            var date_finish = document.getElementById(prefix + "_picker_final");
            var tender_type = document.getElementById(prefix + '_tender_type');
            var tenderdata = {
                name: doc.value,
                brunch: brunch.value,
                is_exist: is_exist,
                display: display.value ?? clean_num_value,
                num: num.value,
                start: date_start.value,
                finish: date_finish.value,
                email: eline,
                ttype: ttype,
                enames: enames,
                duplicate: duplicate,
                conditions: cline,
                qualifications: qualifications,
                template_id: $('#template_input').val(),
                tender_type: $('#is_drushim').val() ? 4 : tender_type.value,
                is_drushim: $('#is_drushim').val(),
                body: $('#bodies_input').val(),
                has_salary: $('#hasSalaryInput').is(":checked") ? 1 : 0,
                is_protocol: $('#is_protocol_required_checkbox').is(":checked") ? 1 : 0,
                is_test_required: $('#is_test_required_checkbox').is(":checked") ? 1 : 0,
                is_recommended: $('#is_recommended_checkbox').is(":checked") ? 1 : 0,
                'input_manager': $('#input_manager').val(),
                'job_scope': $('#job_scope').val(),
                'subordinations': $('#subordinations').val(),
                'grades_voltage': $('#grades_voltage').val(),
                salary: $('#salaryInput').val(),
                // additional_salary: $('#salaryInput_aud').val(),
                users: $('#userSelect').val(),
                note: $('#noteInput').val(),
                job_details: $('#jobDetails').val() ?? null,
                functional_level: $('#functional__level_select').val() ?? 0,
            };
            console.log('corrected:', tenderdata);


            $('.load_container').show();

            console.log(tenderdata);

            var rt = createandSendRequestAjax('/admin/tenders/' + (mode === 'create' ? 'create' : 'updatetender/' +
                clean_num_value), tenderdata);
            console.log('rr', rt);
            // rt.then((e) => {
            //     //console.log('twnd', e);
            //     $('.load_container').hide();
            //     if (e.id > 0) window.location.reload();
            // });
            // return rt;

        }

        async function createTender(tenderid, duplicate = false) {
            let res = await createUpdateTender('create', tenderid, duplicate);
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
            $('.load_container').hide();
            // Reload the page to show new tender
            window.location.reload();
            return res;
        }

        async function getNewTenderId() {
            return createandSendRequestAjax('/admin/tenders/getnewid', {});
        }

        function unMore(tenderid) {
            var sel = 'line_' + tenderid;

            console.log(tenderid, sel);
            var docs = document.getElementById(sel);
            console.log(docs, docs.children);
            for (let i = 0; i < docs.children.length; i++) {
                docs.children[i].style.display = '';
            }
            var docs2 = document.getElementById("z" + sel);
            var docs3 = document.getElementById("az" + sel);

            docs2.style.display = 'none';
            docs3.style.display = 'none';
        }

        function unMore2(tenderid) {
            var sel = 'line_' + tenderid;
            var docs4 = document.getElementById("zz" + sel);
            if (docs4) docs4.style.display = 'none';

        }


        function showMore(tenderid) {
            var sel = 'line_' + tenderid;

            console.log(tenderid, sel);
            /*var docs = document.getElementById(sel);
            console.log(docs, docs.children);
            for (let i = 0; i < docs.children.length; i++) {
                console.log('nn', docs.children[i].style.display);
                docs.children[i].style.display = 'none';
            }
            var docs2 = document.getElementById("z" + sel);
            var docs3 = document.getElementById("az" + sel);
            docs2.style.display = '';
            docs3.style.display = '';*/
            var docs4 = document.getElementById("zz" + sel);
            if (docs4) docs4.style.display = '';
            closs_logs();


        }

        function onClose() {
            console.log('window closed');
            //  undo.fadeIn();
        }

        function getTenderHtml(changer) {
            var tenderTag = document.getElementById("newtenderform");
            var tenderContent = tenderTag ? tenderTag.innerHTML : '';
            tenderContent = tenderContent.replace(/pref/g, changer);
            return tenderContent;
        }


        function gopage(page) {
            var currParams = $.fn.getUrlParams();
            currParams.page = page;
            goByParams(currParams);

        }

        function gofilters() {
            var currParams = $.fn.getUrlParams();
            currParams.page = 0;

            goByParams(currParams);
        }

        function goByParams(params) {
            let url = '/admin/tenders/' + params.filter + '?page_num=' + params.page + (params.start ?
                '&start_date=' + params.start : '') + (params.finish ? '&finish_date=' + params.finish :
                '') + '&tender_type=' + params.tender_type;
            console.log(url);

            window.location.href = url;

        }

        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setHours(9, 0, 0);
            return local;
        });

        function newdrushim() {
            newtender(0, true)
        }

        async function newtender(type, is_drushim = false) {
            $('.load_container').show();
            //$('.load').show();
            var tenderId = await getNewTenderId(); // ('/admin/tenders/gettenderdata/' + tenderId);
            $('.load_container').hide();
            //console.log('nw', tenderContent, dialog);
            var tenderTag = document.getElementById("newtenderform");
            var tender_type = document.getElementById("pref_tender_type");
            //tender_type.type = "hidden";
            //tender_type.id = "pref_tender_type";
            tender_type.value = type;
            //tenderTag.appendChild(tender_type);
            var setTenderType = function(type) {
                if (type == 0 || type == 4) {
                    var tmp = document.getElementById("pref_addupdatetitle");
                    if (tmp) tmp.innerHTML = "הוספת מכרז חדש";
                    var tmp1 = document.getElementById("name");
                    if (tmp1) tmp1.innerHTML = "שם המכרז";

                    var tmp2 = document.getElementById("num");
                    if (tmp2) tmp2.innerHTML = "מספר המכרז";
                    var tmp3 = document.getElementById("datefrom");
                    if (tmp3) tmp3.innerHTML = "תאריך תחילת המכרז";

                    var tmp4 = document.getElementById("is_exist_yes");
                    if (tmp4) tmp4.innerHTML = "מכרז קיים";
                    var tmp5 = document.getElementById("is_exist_no");
                    if (tmp5) tmp5.innerHTML = "מכרז חדש";
                } else {
                    var tmp = document.getElementById("pref_addupdatetitle");

                    if (type == 2) {
                        tmp.innerHTML = "הוספת משרת מילוי מקום";
                    }

                    if (type == 2) {
                        if (tmp) tmp.innerHTML = "הוספת משרת מילוי מקום";
                    } else {
                        if (tmp) tmp.innerHTML = "הוספת משרה חדשה";
                    }
                    var tmp1 = document.getElementById("name");
                    if (tmp1) tmp1.innerHTML = "שם המשרה";
                    var tmp2 = document.getElementById("num");
                    if (tmp2) tmp2.innerHTML = "מספר המשרה";
                    var tmp3 = document.getElementById("datefrom");
                    if (tmp3) tmp3.innerHTML = "תאריך תחילת המשרה";

                    var tmp4 = document.getElementById("is_exist_yes");
                    if (tmp4) tmp4.innerHTML = "משרה קיימת";
                    var tmp5 = document.getElementById("is_exist_no");
                    if (tmp5) tmp5.innerHTML = "משרה חדשה";
                }
            }
            setTenderType(type);
            var modal = document.getElementById("editModal");
            var modalin = document.getElementById("modalcontent");
            modal.style.display = "block";
            var span = document.getElementsByClassName("editclose")[0];

            var tempHTML = `<div class="form-group">
        <div class="row">
			<div class="col-auto mr-2 custom-control custom-checkbox"><input type="checkbox" id="hasSalaryInput" class="custom-control-input" name="has-salary" /><label for="hasSalaryInput" class="hasSalary caption captiogreen custom-control-label">מצויין שכר</label> </div>
			<div class="col-auto"><input placeholder="Enter salary range in number" type="text" style="display:none" min="1" class="form-control mx-2 w-auto" id="salaryInput" name="salary"></div>
            </div>
    </div>`;


            var commonHTML = `${options__list}<br>${jobDetails__option}<br><div class="row mx-2">${functional__level__list}${is_recommended_block}${is_test_required_block}${is_protocol_required_block}</div><br><div class="col-12">

                </div><input type="hidden" id="is_drushim" value="${is_drushim?1:0}">`



            // When the user clicks on <span> (x), close the modal
            var tenderContent = getTenderHtml('modal'); //tenderContent.replace(/pref/g, 'modal')
            if (type == 0 || type == 4) {
                modalin.outerHTML = `<div id="modalcontent">${tenderContent}<div>` +
                    '                <div class="text-right mr-2 tenderTypeWrap"><label>' +
                    '                    <div class="caption captiobblue" style="font-weight: bold;">מכרז</div><br>\n' +
                    '                    <label class="radio">\n' +
                    '                        <input type="radio" name="modal_tender_type"  checked value="yes" required="true" id="modal_tender_type_yes">\n' +
                    '                        <span class="virtual"></span>\n' +
                    '                        <span class="caption"> מכרז פנימי</span>\n' +
                    '                    </label>\n' +
                    '                    <label class="radio">\n' +
                    '                        <input type="radio" name="modal_tender_type"    value="no"  id="modal_tender_type_no" required="true">\n' +
                    '                        <span class="virtual"></span>\n' +
                    '                        <span class="caption">  מכרז חיצוני</span>\n' +
                    '                    </label>\n' +
                    '                    <label class="radio">\n' +
                    '                        <input type="radio" name="modal_tender_type" value="3" required="true" id="modal_tender_type_both">\n' +
                    '                        <span class="virtual"></span>\n' +
                    '                        <span class="caption"> פנימי/ חיצוני</span>\n' +
                    '                    </label>\n' +
                    '                </label>\n' +
                    '            </div>' +
                    ' <br>' +
                    '<div class="w-100">' + `<br>${tempHTML} <br>` + commonHTML +
                    '</div></div><div class="w-100 text-center"><button class="btn ml-2 mb-2" onclick="createTender(' +
                    "'" +
                    tenderId + "'" + ')">שמור</button></div>' +

                    '</div>';
            } else {
                modalin.outerHTML = `<div id="modalcontent">${tenderContent} <br>${tempHTML} <br>` + commonHTML +
                    '<div><button class="btn ml-2 mb-2" onclick="createTender(' + "'" + tenderId + "'" +
                    ')">שמור</button></div>' +

                    '</div></div>';
            }
            var setTenderNum = function(id) {
                var tmp = document.getElementById("modal_tender_num");
                if (tmp) tmp.value = id;
            }
            var tn = document.getElementById('modal_tender_name');

            setTenderNum(tenderId);
            $("#modal_picker_start").kendoDateTimePicker({
                format: "dd-MM-yyyy HH:mm",
                dateInput: true,
                value: new Date().toDateInputValue(),
                min: new Date("{{ today()->format('Y-m-d') }}")
            });
            $("#modal_picker_final").kendoDateTimePicker({
                format: "dd-MM-yyyy HH:mm",
                dateInput: true,
                value: new Date().toDateInputValue(),
                min: new Date("{{ today()->format('Y-m-d') }}")
            });
            span.onclick = function() {
                modal.style.display = "none";
            }
            $('#userSelect,#functional__level_select').select2()

            // Education and professional requirements (השכלה ודרישות מקצועיות)
            $('input#modal_tender_add_cond_doc1, input#pref_tender_add_cond_doc1').autocomplete({
                source: [
                    "שנות לימוד / תעודת בגרות12",
                    "תואר ראשון ממוסד אקדמי",
                    "תעודת הוראה",
                    "תואר שני",
                    "אישור רישום בפנקס העוס״ים"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Professional courses and trainings (קורסים והכשרות מקצועיות)
            $('input#modal_tender_add_cond_doc2, input#pref_tender_add_cond_doc2').autocomplete({
                source: [],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Professional experience (ניסיון מקצועי)
            $('input#modal_tender_add_cond_doc3, input#pref_tender_add_cond_doc3').autocomplete({
                source: [
                    "ניסיון של"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Additional requirements (דרישות נוספות)
            $('input#modal_tender_add_cond_doc4, input#pref_tender_add_cond_doc4').autocomplete({
                source: [
                    "רישום פלילי - היעדר הרשעה פלילית והיעדר רישום על עברות מין",
                    "רישיון נהיגה – בתוקף"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            // Management experience (ניסיון ניהול)
            $('input#modal_tender_add_cond_doc5, input#pref_tender_add_cond_doc5').autocomplete({
                source: [
                    "ניסיון של ניהול צוות עובדים"
                ],
                position: {
                    my: "right top",
                    at: "right bottom"
                },
                autoFocus: true,
                minLength: 0
            }).focus(function() {
                $(this).data("uiAutocomplete").search($(this).val());
            })

            if (is_drushim) {
                $('#modal_addupdatetitle').html($('#modal_addupdatetitle').html().replaceAll('מכרז', 'דרושים'))
                $('.tenderTypeWrap').html($('.tenderTypeWrap').html().replaceAll('מכרז', 'דרושים'))
            }


            /*
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                console.log('tmp');
                                modal.style.display = "none";
                            }
                        }
            			*/
        }

        // $(document).on('change', '#hasSalaryInputs', function(event) {
        //     $('#salaryInput').style('display', $(this).is('checked') ? 'block' : 'none')
        // });

        function newtender2() {
            var dialog = $('#dialog');
            var setTenderNum = function(id) {
                var tmp = document.getElementById("modal_tender_num");
                if (tmp) tmp.value = id;
            }
            getNewTenderId().then(setTenderNum);


            dialog.kendoDialog({
                width: "750px",
                title: "",
                closable: true,
                modal: true,
                content: getTenderHtml('modal'),
                actions: [{
                        text: 'Create Tender',
                        action: createTender
                    },
                    {
                        text: 'Close',
                        action: onClose
                    },
                ],
                close: onClose
            });
            $("#modal_picker_start").kendoDateTimePicker({
                format: "yyyy dd MMMM HH:mm",
                dateInput: true
            });
            // $("#modal_picker_final").kendoDateTimePicker({
            //     format: "yyyy dd MMMM HH:mm",
            //     dateInput: true
            // });

            if (dialog.data("kendoDialog"))
                dialog.data("kendoDialog").open();
            else console.log('no kendo found...');
            return false;
        }

        function fileChange(el, n) {
            var rt = document.getElementById("r" + el.id);
            var tt = $("#t" + el.id);

            for (var i = 0; i < el.length; i++) {
                if (el.files.item(i).size > 20971520) {
                    alert('גודל הקובץ לא יעלה על 20 MB.');
                    el.value = "";
                } else {
                    let name = el.files.item(i).name;
                    let ext_arr = name.split('.');
                    let ext = ext_arr[ext_arr.length - 1];
                    //const allows = ["doc", "docx", "pdf", "jpg", "jpeg"];
                    const allows = ["pdf"];
                    const promise = checkmime(el.files.item(i));
                    promise.then(
                        result => {
                            //debugger;
                            if (!allows.includes(ext) || result.binaryFileType === "Unknown filetype") {
                                name = '';
                                el.value = "";
                                tt.text("");
                                fileUplaodDivs(true, n);
                                //alert('העלת קובץ שאינו נתמך, הקבצים שנתמכים הינם מסוג: pdf, jpg, word, jpeg עד לגודל של 20 MB בלבד');
                                alert('העלת קובץ שאינו נתמך, הקבצים שנתמכים הינם מסוג: pdf עד לגודל של 20 MB בלבד');
                            } else {
                                $(el).parents(".form").submit();

                                // tt.text(name);
                                //fileUplaodDivs(false,n);
                            }

                        },
                        error => {
                            if (!allows.includes(ext)) {
                                name = '';
                                el.value = "";
                                tt.text("");
                                fileUplaodDivs(true, n);
                                alert(
                                    'העלת קובץ שאינו נתמך, הקבצים שנתמכים הינם מסוג: pdf, jpg, word, jpeg עד לגודל של 20 MB בלבד'
                                );
                            } else {
                                tt.text(name);
                                fileUplaodDivs(false, n);


                            }



                        }
                    );
                }

                console.log("Type: " + el.files.item(i).type);
            }

        }

        function fileUplaodDivs(show, n) {
            //debugger;
            var rt = document.getElementById("rcfile-upload-" + n);
            var tt = $("#tcfile-upload-" + n);
            var el = $("#cfile-upload-" + n);
            if (show) {
                $(el).parents('.upload-block').find('.btn-input-upload').val('אנא צרף קובץ רלוונטי');
                if (rt && rt.style) rt.style.display = 'none';
                if (tt) tt.hide();
                $(el).parents('.upload-block').find('.btn-input-upload').show();
                $(el).parents('.upload-block').find('.btn-upload').show();
                $(el).parents('.upload-block').find('.btn-file-upload').show();
            } else {
                if (rt && rt.style) rt.style.display = '';
                if (tt) {
                    tt.show();

                }
                $(el).parents('.upload-block').find('.btn-input-upload').hide();
                $(el).parents('.upload-block').find('.btn-upload').hide();
                $(el).parents('.upload-block').find('.btn-file-upload').hide();
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

        function removeFile(el, n) {
            //	debugger;

            // tt.text("");
            var rq = createandSendRequestAjax('/admin/tenders/addfile/' + n);
            fileUplaodDivs(true, n);
            //	$(el).parents('.upload-block').find('.btn-input-upload').val('אנא צרף תעודה רלוונטית');
            var fl = document.getElementById('cfile-upload-' + n);
            var rm = document.getElementById('rcfile-upload-' + n);
            // console.log('rmvf',n,fl,rm);
            if (fl) fl.value = "";
            if (rm && rm.style) rm.style.display = 'none';
        }
        jQuery(function($) {
            $(document).on("submit", ".form", function(e) {
                e.preventDefault();
                e.stopPropagation();
                var ret = this.id.split("-");
                var str2 = ret[1];
                // var rq =  createandSendRequestAjax('/admin/tenders/addfile/' + str2);
                var form = this; //document.getElementById('form');
                var data = new FormData(form);
                var error = 0;
                $('.load_container').show();

                //  data.append('html', $('form').html());
                //  var url = $('#form_url').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                if (token) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                    });
                    $.post({
                        url: "/admin/tenders/addfile/" + str2,
                        data: data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            var res = JSON.parse(data);
                            /*if(res.error){
                                	//$('.load_container').hide();
                                	alert(res.error);
                            	} else {
                              // 	window.location.href = url+'/success/'+res.decisionId;
                            	}*/
                            $("#tcfile-upload-" + str2).text(res.filename);;

                            fileUplaodDivs(false, str2);
                            $('.load_container').hide();

                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                } else {
                    console.log("token is null");
                }
                //    rq.then(reload);

            });
        })
    </script>
</head>

<body dir="rtl">
    <div class="load_container" id="load_container" style="display: none;">
        <div class="loader">

        </div>
    </div>
    @guest
    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest

    <header id="header" class="header">
        <nav class="navbar navbar-expand-sm">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->is('admin/tenders') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/tenders">מכרזים</a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/tenders/requestsorted/*') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/tenders/requestsorted/all">פניות</a>
                    </li>
                    {{-- <li class="nav-item {{ request()->is('admin/apps') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/apps">אישור פרסום</a>
                    </li> --}}
                    <li class="nav-item {{ request()->is('admin/tenders/application/*') ? 'active' : '' }}">
                        <a class="nav-link" href="#">החלטות</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('template.list') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('template.list') }}">תבנית</a>
                    </li>
                    @if (\App\User::check_auth_user_permission(1))
                        <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <a class="nav-link" href="/admin/users">הגדרות</a>
                        </li>
                    @endif
                </ul>
                <a href="{{ route('logout') }}" class="logout-link icon icon-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
            </div>
            <br />
        </nav>
    </header>
    <div id="editModal" class="editmodal">

        <!-- Modal content -->
        <div class="editmodal-content">
            <span style="padding-left:20px" class="editclose">&times;</span>
            <div id="modalcontent"></div>
        </div>

    </div>
    <div style="visibility:hidden;position:absolute;z-index:-1" id="hiddenmodal">

        <div id="dialog"></div>
        <div id="edittender"></div>
        <div id="newtenderform">
            <div style="font-size:1.5em; text-align:center" id="pref_addupdatetitle">הוספת משרה חדשה</div>
            <hr />
            <div style="text-align: center">
                <div class="input-control inline">
                    <div class="modal-row">
                        <div>
                            <div class="caption captiogreen max-w300" id="name">שם המשרה</div>
                            <input type="hidden" id="pref_tender_type">
                            <input type="text" id="pref_tender_name" required="" class="max-280" placeholder=""
                                style="margin-left: 5px;">
                        </div>
                        <div>
                            <div class="caption captiogreen max-w300" id="brunch">אגף/מחלקה</div>
                            <select id="pref_tender_brunch" class="max-280">
                                <option value="">--- אגף/מחלקה ---</option>
                                <!--<option value="אגף קש''ת">אגף קש''ת</option>-->

                                <option value="לשכת ראש המועצה">לשכת ראש המועצה</option>
                                <option value="לשכת מנכל">לשכת מנכל</option>
                                <option value="מחלקת הון אנושי">מחלקת הון אנושי</option>
                                <option value="אגף גזברות">אגף גזברות</option>
                                <option value="מחלקת גביה">מחלקת גביה</option>
                                <option value="אגף שפע">אגף שפע</option>
                                <option value="מחלקת הנדסה">מחלקת הנדסה</option>
                                <option value="אגף החינוך">אגף החינוך</option>
                                <option value="מחלקת ביטחון">מחלקת ביטחון</option>
                                <option value="האגף לשירותים חברתיים">האגף לשירותים חברתיים</option>
                                <option value="מחלקת קהילה">מחלקת קהילה</option>
                                <option value="ספריה">ספריה</option>
                                <option value="מחלקת שפח">מחלקת שפח</option>
                                <option value="מחלקת נוער וצעירים">מחלקת נוער וצעירים</option>
                                <option value="מחלקת דוברות">מחלקת דוברות</option>
                            </select>
                        </div>
                        <div class="input-control">
                            <!--<div class="caption captiogreen max-w300">משרה</div>
      <label class="radio">
       <input type="radio" name="pref_is_exist" id="pref_is_exist_yes" value="true">
       <span class="virtual"></span>
       <span class="caption" id="is_exist_yes"> משרה קיימת </span>
       <input type="radio" name="pref_is_exist" id="pref_is_exist_no" value="false">
       <span class="virtual"></span>
       <span class="caption" id="is_exist_no"> משרה חדשה </span>
      </label>-->
                        </div>
                    </div>
                    <div class="model-row row w-100">
                        <div class="form-group col-6">
                            <div class="caption captiogreen max-w300">תבנית</div>
                            <select name="" id="template_input" class="form-control">
                                <option value="">---לִבחוֹר תבנית---</option>
                                @foreach ($templates ?? [] as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <div class="caption captiogreen max-w300">גופים</div>
                            <select name="" id="bodies_input" class="form-control">
                                @foreach (array_keys(config('static_array.bodies')) as $body)
                                    <option value="{{ $body }}">{{ $body }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-row">
                        <div>
                            <div class="caption captiogreen max-w300" id="num">מספר המשרה</div>
                            <input type="text" id="pref_tender_num" required="" class="max-440"
                                placeholder="">
                            <input type="hidden" id="pref_tender_num_display">
                        </div>
                        <div>
                            <div class="caption captiogreen  max-w300" id="datefrom">תאריך התחלת המשרה</div>
                            <input id="pref_picker_start" type="date" name="pref_datefrom" class="max-440" />
                        </div>
                        <div>
                            <div class="caption captiogreen max-w300">תאריך פקיעת תוקף</div>
                            <input id="pref_picker_final" type="date" name="pref_dateto" class="max-440" />
                        </div>
                    </div>
                    <!--<div>
                    <div class="caption captiogreen">תנאי סף מלל</div>
     <div id="pref_cond_line">
      <input type="text" id="pref_tender_add_cond_text" required="" class="max-440" style="width: 89%;">
      <button class="btn" onclick="new_dublibe('pref_cond_text_block', '_tender_add_cond_text')">הוסף</button>
     </div>
     <div id="pref_cond_text_block"></div>
                </div>-->
                    <div>
                        <div class="caption captiogreen" id="doc1">השכלה ודרישות מקצועיות</div>
                        <div id="pref_cond_line">
                            <input type="text" id="pref_tender_add_cond_doc1" required="" class="max-440"
                                style="width: 89%;">
                            <button class="btn"
                                onclick="new_dublibe('pref_cond_block_doc1', '_tender_add_cond_doc1')">הוסף</button>
                        </div>
                        <div id="pref_cond_block_doc1"></div>
                    </div>
                    <div>
                        <div class="caption captiogreen" id="doc2">קורסים והכשרות מקצועיות</div>
                        <div id="pref_cond_line">
                            <input type="text" id="pref_tender_add_cond_doc2" required="" class="max-440"
                                style="width: 89%;">
                            <button class="btn"
                                onclick="new_dublibe('pref_cond_block_doc2', '_tender_add_cond_doc2')">הוסף</button>
                        </div>
                        <div id="pref_cond_block_doc2"></div>
                    </div>
                    <div>
                        <div class="caption captiogreen" id="doc3">ניסיון מקצועי</div>
                        <div id="pref_cond_line">
                            <input type="text" id="pref_tender_add_cond_doc3" required="" class="max-440"
                                style="width: 89%;">
                            <button class="btn"
                                onclick="new_dublibe('pref_cond_block_doc3', '_tender_add_cond_doc3')">הוסף</button>
                        </div>
                        <div id="pref_cond_block_doc3"></div>
                    </div>
                    <div>
                        <div class="caption captiogreen" id="doc4">דרישות נוספות</div>
                        <div id="pref_cond_line">
                            <input type="text" id="pref_tender_add_cond_doc4" required="" class="max-440"
                                style="width: 89%;">
                            <button class="btn"
                                onclick="new_dublibe('pref_cond_block_doc4', '_tender_add_cond_doc4')">הוסף</button>
                        </div>
                        <div id="pref_cond_block_doc4"></div>
                    </div>
                    <div>
                        <div class="caption captiogreen" id="doc5">ניסיון ניהול</div>
                        <div id="pref_cond_line">
                            <input type="text" id="pref_tender_add_cond_doc5" required="" class="max-440"
                                style="width: 89%;">
                            <button class="btn"
                                onclick="new_dublibe('pref_cond_block_doc5', '_tender_add_cond_doc5')">הוסף</button>
                        </div>
                        <div id="pref_cond_block_doc5"></div>
                    </div>
                    <div>
                        <div class="caption captiogreen" id="doc6">שאלות כן ולא</div>
                        <div id="pref_cond_line">
                            <input type="text" id="pref_tender_add_cond_doc6" required="" class="max-440"
                                style="width: 89%;">
                            <button class="btn"
                                onclick="new_dublibe('pref_cond_block_doc6', '_tender_add_cond_doc6')">הוסף</button>
                        </div>
                        <div id="pref_cond_block_doc6"></div>
                    </div>
                    <!--<div>
                    <div class="caption captiogreen">תנאי סף</div>
     <div id="pref_cond_line">
      <input type="text" id="pref_tender_add_cond" required="" class="max-440" style="width: 89%;">
      <button class="btn" onclick="new_dublibe('pref_cond_block', '_tender_add_cond')">הוסף</button>
     </div>
     <div id="pref_cond_block"></div>
                </div>-->

                    <!--<div class="modal-row">
     <div class="modal-column">
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[0]" value="תעודה המעידה על מספר שנות לימוד">
        <span class="virtual"></span>
        <span class="caption">תעודה המעידה על מספר שנות לימוד</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[0]" value="תנאי סף" data-val="tender_cond[0]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[0]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[1]" value="תעודת בגרות">
        <span class="virtual"></span>
        <span class="caption">תעודת בגרות</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[1]" value="תנאי סף" data-val="tender_cond[1]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[1]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[2]" value="טכנאי">
        <span class="virtual"></span>
        <span class="caption">טכנאי</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[2]" value="תנאי סף" data-val="tender_cond[2]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[2]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[3]" value="הנדסאי">
        <span class="virtual"></span>
        <span class="caption">הנדסאי</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[3]" value="תנאי סף" data-val="tender_cond[3]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[3]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[4]" value="לבורנט">
        <span class="virtual"></span>
        <span class="caption">לבורנט</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[4]" value="תנאי סף" data-val="tender_cond[4]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[4]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
     </div>

     <div class="modal-column">
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[5]" value="תעודת הוראה">
        <span class="virtual"></span>
        <span class="caption">תעודת הוראה</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[5]" value="תנאי סף" data-val="tender_cond[5]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[5]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[6]" value="תואר ראשון">
        <span class="virtual"></span>
        <span class="caption">תואר ראשון</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[6]" value="תנאי סף" data-val="tender_cond[6]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[6]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[7]" value="תואר שני">
        <span class="virtual"></span>
        <span class="caption">תואר שני</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[7]" value="תנאי סף" data-val="tender_cond[7]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[7]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[8]" value='תעודת סמיכות לרבנות ("יורה יורה")'>
        <span class="virtual"></span>
        <span class="caption">תעודת סמיכות לרבנות ("יורה יורה")</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[8]" value="תנאי סף" data-val="tender_cond[8]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[8]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
      <div>
       <label class="checkbox">
        <input type="checkbox" name="pref_tender_cond[9]" value="אישור לימודים מישיבה גבוהה או מכולל">
        <span class="virtual"></span>
        <span class="caption">אישור לימודים מישיבה גבוהה או מכולל</span>
       </label>
      </div>
      <div>
       <label class="radio">
        <input type="radio" name="pref_advantage[9]" value="תנאי סף" data-val="tender_cond[9]">
        <span class="virtual"></span>
        <span class="caption"> תנאי סף </span>
       </label>
       <label class="radio">
        <input type="radio" name="pref_advantage[9]" value="יתרון">
        <span class="virtual"></span>
        <span class="caption"> יתרון </span>
       </label>
      </div>
     </div>
    </div>-->
                </div>
            </div>
        </div>
    </div>
    <script>
        function exportToExcel(table) {
            var location = 'data:application/vnd.ms-excel;base64,';
            var excelTemplate = '<html> ' +
                '<head> ' +
                '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
                '</head> ' +
                '<body> ' +
                table +
                '</body> ' +
                '</html>'
            window.location.href = location + btoa(unescape(encodeURIComponent(excelTemplate)));
        }
        @php
            $templates = $templates ?? '[]';
        @endphp
        var templates = {!! $templates !!}

        $(document).on('change', '#template_input', function(event) {
            // for(template in ){
            //     console.log(template)
            // }
            var temp_id = $(this).val();

            templates.map(function(elem, index) {
                console.log(elem.id, temp_id);

                if (elem.id == temp_id) {
                    var jsonData = JSON.parse(elem.value);

                    for (data in jsonData) {
                        console.log(data, jsonData[data].tender_form_id);

                        if (jsonData[data].tender_form_id != null) {

                            if (jsonData[data].tender_form_id.add) {
                                console.log('non plain data ', data);
                                if ($('#modalcontent #emodal_addupdatetitle').length == 1) {
                                    $('#' + jsonData[data].tender_form_id.edit + '').val(jsonData[data]
                                        .value)
                                } else {
                                    $('#' + jsonData[data].tender_form_id.add + '').val(jsonData[data]
                                        .value)
                                }
                            } else {
                                console.log('plain data ', data);

                                $('#' + jsonData[data].tender_form_id + '').val(jsonData[data].value)
                            }

                        }
                    }

                }
            })
        });
    </script>

    @yield('content')
    @extends('layouts.admin.footer')

    @stack('extra_js')
