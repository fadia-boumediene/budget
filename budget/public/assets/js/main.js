/*   var nexthop='<div class="pinfo-handle">'+
                              '<i class="fas fa-wallet"></i>'+
                              '<p >ACTION :</p>'+
                              '<p>  </p>'+
                              '</div>'+
                              ' <div class="next-handle">'+
                              '<i class="fas fa-angle-double-right waiting-icon"></i>'+
                              '</div>'
                          $('#progam-handle').addClass('slide-out')
                          setTimeout(() => {
                            // Add the class to hide the table
                            $('#progam-handle').empty();
                            // Optionally remove the scaling out class after hiding
                            $('#T_List-handle').addClass('grid-T')
                            add_T1();add_T2();add_T3();add_T4()
                          $('.next-handle svg').removeClass('waiting-icon')
                            $('.next-handle svg').addClass('complet-icon')
                          $('.the-path').append(nexthop)
                          $('#T-card_button button').on('click',function(){
                            var buttonid=$(this).attr('id');
                            console.log(''+buttonid);
                            $('#T_List-handle').removeClass('grid-T')
                            $('#T_List-handle').addClass('row-T')
                            $('#gr_list_handle').addClass('gr_list')
                            $('#T1-handle').empty()
                            $('#T2-handle').empty()
                            $('#T3-handle').empty()
                            $('#T4-handle').empty()
                            T1_newform();
                            T2_newform();
                            T3_newform();
                            T4_newform();
                                  $('#table-T').addClass('table-T-scroll')
                            var table='<table class="container-T" id="T-tables">'+
                                        '<thead style="position: sticky;">'+
                                       '<tr>'+
                                       '<th rowspan="2"><h1>T Description</h1><th> </th></th>'+
                                       '<th><h1>AE</h1></th>'+
                                       '<th><h1>CP </h1></th>'+
                                       '</tr>'+
                                       '</thead>'+
                                       '<tbody>'+
                                       '</tbody>'+
                                     '</table>'
                      $('#table-T').append(table)
                      if( buttonid == 'T1')
                          {   $.getJSON(jsonpath, function (data) {
                                  // Loop through each item in the JSON data
                                  $.each(data, function (key, value) {
                                      // Create a table row
                                      let row = '<tr>' +
                                          '<td>' + key + '</td>' +
                                          '<td>' + value + ' </td>' +
                                          '<td class="editable">' + 0 + '</td>' +
                                          '<td class="editable">' + 180+',000</td>' +
                                          '</tr>';

                                      // Append the row to the table body
                                      $('#T-tables tbody').append(row);
                                      Edit();
                                      $('.TP-handle button').on('click',function(){
                                        var btn=$(this).attr('id')
                                        console.log('testing card Click'+btn)
                                        if(btn != 'T1'){
                                        $('#T-tables tbody').empty()
                                        $('#T1-handle').empty()
                                        $('#T2-handle').empty()
                                        $('#T3-handle').empty()
                                        $('#T4-handle').empty()
                                        T1_newform();
                                        T2_newform();
                                        T3_newform();
                                        T4_newform();}
                                      })
                                  });
                              }).fail(function () {
                                  console.error('Error loading JSON file.');
                              });
                              }
                          })

                        }, 500)
                         /** this to creating at same page  */

                         var click = 0;
                         var changing_mist = new Object();
                         var value_chng = new Array()
                         var  dataupdate=new Array();

                         /**
                          *
                          * this function for adding button et makalah -_- ;
                          */

                        function only_year(years,id_date)
                        {

                        }


                         /**
                          *
                          * upload file function
                          *
                          */
                         function upload_file(id_file,id_relat)
                         {

                            let formDataFa = new FormData();
                            formDataFa.append('pdf_file', $('#'+id_file)[0].files[0]);
                            formDataFa.append('related_id',id_relat);
                            $.ajax({
                                url:'/upload-pdf',
                                type:'POST',
                                data:formDataFa,
                                processData: false,
                                contentType: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                                },
                                success:function(response)
                                {
                                    if(response.code)
                                    {
                                   return response.code
                                  }
                                    else
                                    {
                                        return response.message;
                                    }
                                }
                            })

                         }
                         function focus_() {
                             $('input').focus(function () {
                                 $(this).removeAttr('style');
                             });
                         }
                         function check_ifnull(button) {
                             var indice = 0;
                             var isEmpty = false
                             var formId = $(button).parents('.form-container').attr('id');
                             console.log('and form id' + formId);
                             $('#' + formId + ' form').find('input').each(function () {
                                 console.log('before the loop')
                                 var inputValue = $(this).val();

                                 // Check if the input is not empty
                                 if (inputValue.trim() === "") {
                                     isEmpty = true;
                                     indice++;
                                 }


                                 if (isEmpty) {
                                     if (indice < 2) {
                                         alert("Veuillez remplir tous les champs obligatoires");
                                     }
                                     $(this).css('box-shadow', '0 0 0 0.25rem rgb(255 0 0 / 47%)')
                                 }
                             });
                         }

                         function splitcode(str, length) {
                             let result = [];
                             for (let i = 0; i < str.length; i += length) {
                                 let chunk = str.substring(i, i + length);
                                 result.push({ substring: chunk, length: chunk.length });
                             }
                             return result;
                         }


                         function add_newOPs_T1(id, descr, value, key,) {
                             var row = '<tr id="ref' + id + '">' +
                                 '<td class="code" >' + id + '</td>' +
                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + descr + '</p></td>' +
                                 '<td class="editable" id="AE_T1">' + value + '</td>' +
                                 '<td class="editable" id="CP_T1">' + 180 + ',000</td>' +
                                 '</tr>';

                             $('#' + key).after(row);
                             $('#' + key + ' td').each(function () {
                                 $(this).removeClass('editable');
                             })
                         }
                         function add_newOPs_T2(id, descr, value, key) {
                            var champ='<div><label>AE Overture</label>'+
                            '<input type="number" class="form-control" id="add_AE_Over">'+
                            '<label>AE Attendu</label>'+
                            '<input type="number" class="form-control" id="add_AE_att">'+
                            '<label>AE Total</label>'+
                            '<input type="number" class="form-control" id="some_AE" disabled>'+
                            '</div>'+
                            '<div>'+
                            '<label>CP Overture</label>'+
                            '<input type="number" class="form-control" id="add_CP_Over">'+
                            '<label>CP Attendu</label>'+
                            '<input type="number" class="form-control" id="add_CP_att">'+
                            '<label>CP Toral</label>'+
                            '<input type="number" class="form-control" id="some_CP" disabled>'+
                            '</div>';
                            $('#Tport-vals').append(champ);
                            var someae=0;
                            var somecp=0;
                            $('#add_AE_Over').on('change',function(){

                                someae+=parseInt($(this).val())
                                $('#some_AE').val(someae);
                            })
                            $('#add_AE_att').on('change',function(){
                                someae+=parseInt($(this).val())
                                $('#some_AE').val(someae);
                            })
                            $('#add_CP_att').on('change',function(){

                                somecp+=parseInt($(this).val())
                                $('#some_CP').val(somecp)
                            })
                            $('#add_CP_Over').on('change',function(){
                                if($(this).val() !=0 && somecp != 0)
                                    {
                                        somecp-=$(this).val()
                                    }
                                somecp+=parseInt($(this).val())
                                $('#some_CP').val(somecp)
                            })
                             $('#ajt').click(function(){
                                var sopdata_add={
                                    code:id,
                                    descrp:descr,
                                    AE_Over:$('#add_AE_Over').val(),
                                    CP_Over:$('#add_CP_Over').val(),
                                    AE_att:$('#add_AE_att').val(),
                                    CP_att:$('#add_CP_att').val(),
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                    _method: "POST",
                                }
                                $.ajax({
                                    url:'',
                                    type:'POST',
                                    data:sopdata_add,
                                    success:function(response)
                                    {
                                        var row = '<tr class="ref'+id+'" id="ref' + id + '">' +
                                        '<td class="code">' + id + '</td>' +
                                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + descr + '</p> </td>' +
                                        '<td class="editable" id="AE_Over">' + value + '</td>' +
                                        '<td class="editable" id="CP_Over">' + 180 + ',000</td>' +
                                        '<td class="editable" id="AE_att">' + value + '</td>' +
                                        '<td class="editable" id="CP_att">' + 180 + ',000</td>' +
                                        '<td  id="AE_TT" diseabled>' + some + '</td>' +
                                        '<td  id="CP_TT" diseabled>' + 360 + ',000</td>' +
                                        '</tr>';
                                    $('#' + key).after(row);
                                    $('#' + key + ' td').each(function () {
                                        $(this).removeClass('editable');
                                    })
                                    }
                                })



                         })
                         $('#cancel_ops').click(function(){

                            $('.Tsop_handler').addClass('Tsop_handler_h')
                            $('#Tport-vals').empty()
                            alert('cancel op')
                     })
                        }
                         function add_newOPs_T3(id, descr, value, key,) {
                            var champ='<div><label>intitueler</label><input type="text" class="form-control" id="int-T3"></div>'+
                                      '<div><label>AE Reportter</label>'+
                                      '<input type="number" class="form-control" id="add_AE_rpor">'+
                                      '<label>AE Notifier</label>'+
                                      '<input type="number" class="form-control" id="add_AE_not">'+
                                      '<label>AE Engager</label>'+
                                      '<input type="number" class="form-control" id="add_AE_enga">'+
                                      '</div>'+
                                      '<div>'+
                                      '<label>CP Reporter</label>'+
                                      '<input type="number" class="form-control" id="add_CP_rpor">'+
                                      '<label>CP Notifier</label>'+
                                      '<input type="number" class="form-control" id="add_CP_not">'+
                                      '<label>CP Consumer</label>'+
                                      '<input type="number" class="form-control" id="add_CP_consom">'+
                                      '</div>';
                            $('#Tport-vals').append(champ);
                            $('#ajt').on('click',function(){
                                var sopdata_add={
                                    code:id,
                                    intituel:$('#int-T3').val(),
                                    descrp:$('#dispo').val(),
                                    AE_rpor:$('#add_AE_rpor').val(),
                                    AE_not:$('#add_AE_not').val(),
                                    AE_enga:$('#add_AE_enga').val(),
                                    CP_rpor:$('#add_CP_rpor').val(),
                                    CP_not:$('#add_CP_not').val(),
                                    CP_consom:$('#add_CP_consom').val(),
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                    _method: "POST",

                                }
                                console.log('data T3'+JSON.stringify(sopdata_add))
                                $.ajax({
                                    url:'',
                                    type:'POST',
                                    data:sopdata_add,
                                    success:function(response)
                                    {
                                        if(response.code == 200)
                                        {
                                            var row = '<tr id="ref' + id + '">' +
                                            '<td class="code">' + id + '</td>' +
                                            '<td><p>' + descr + '</p> </td>' +
                                            '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + descr + '</p></td>' +
                                            '<td class="editable" id="AE_rpor">' + value + '</td>' +
                                            '<td class="editable" id="AE_not">' + 180 + ',000</td>' +
                                            '<td class="editable" id="AE_enga">' + value + '</td>' +
                                            '<td class="editable" id="CP_rpor">' + 180 + ',000</td>' +
                                            '<td class="editable" id="CP_not">' + value + '</td>' +
                                            '<td class="editable" id="CP_consom">' + 180 + ',000</td>' +
                                            '</tr>';
                                        $('#' + key).after(row);
                                        $('#' + key + ' td').each(function () {
                                            $(this).removeClass('editable');
                                        })
                                        $('.Tsop_handler').addClass('Tsop_handler_h')
                                        $('#Tport-vals').empty()
                                        }
                                    }
                                })
                            })
                            $('#cancel_ops').click(function(){

                                $('.Tsop_handler').addClass('Tsop_handler_h')
                                $('#Tport-vals').empty()
                                alert('cancel op')
                            })
                         }

                         function add_newOPs_T4(id, value, key,) {
                            $('#Tport-vals').addClass('T4')
                            var champ='<label>definition</label><input type="text" class="form-control" id="def_T4">'+
                            '<div><label>AE</label>'+
                            '<input type="number" class="form-control" id="add_AE_T4">'+
                            '</div>'+
                            '<div>'+
                            '<label>CP Reporter</label>'+
                            '<input type="number" class="form-control" id="add_CP_T4">'+
                            '</div>';
                            $('#Tport-vals').append(champ);
                            $('#ajt').click(function(){
                                var data_add_ops={
                                    code:id,
                                    descrp:$('#dispo').val(),
                                    defi:$('#def_T4').val(),
                                    AE_T4:$('#add_AE_T4').val(),
                                    CP_T4:$('#add_CP_T4').val(),
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                    _method: "POST",
                                }
                                var row = '<tr id="ref' + id + '">' +
                                '<td class="code" >' + id + '</td>' +
                                '<td>'+data_add_ops.defi+'</td>'+
                                '<td>'+data_add_ops.descrp+'</td>'+
                                '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + data_add_ops.descrp + '</p></td>' +
                                '<td class="editable" id="AE_T4">' + data_add_ops.AE_T4 + '</td>' +
                                '<td class="editable" id="CP_T4">' + data_add_ops.CP_T4 + '</td>' +
                                '</tr>';
                            $('#' + key).after(row);
                            $('#' + key + ' td').each(function () {
                                $(this).removeClass('editable');
                            })
                                console.log('data T4'+JSON.stringify(data_add_ops))
                                $('.Tsop_handler').addClass('Tsop_handler_h')
                                $('#Tport-vals').empty()
                                $('#Tport-vals').removeClass('T4')
                            })
                            $('#cancel_ops').click(function(){
                                $('.Tsop_handler').addClass('Tsop_handler_h')
                                $('#Tport-vals').empty()
                                $('#Tport-vals').removeClass('T4')
                                alert('cancel op')
                            })

                         }
                         /**
                          *
                          * the end
                          *
                          */

                         /**
                          *
                          * star of update function
                          *
                          */
                         function Update_dpia(T,act)
                         {
                            var old;
                            $(document).ready(function(){
                                $('.editable').on('click', function () {
                                    let cell = $(this);  // Reference to the clicked cell
                                    old = cell.text();
                                })
                                $('.editable').dblclick(function(){
                                    var i=0
                                    var ae=0;
                                    var cp=0;
                                    var ae_ouvert =0
                                    var cp_ouvert =0
                                    var ae_attendu =0
                                    var cp_attendu =0
                                    var ae_reporte =0
                                    var ae_notifie =0
                                    var ae_engage =0
                                    var cp_reporte =0
                                    var cp_notifie =0
                                    var cp_consome =0
                                    var clickid = $(this).attr('id');
                                    console.log('testing the id'+clickid);
                                     var clickedRow = $(this).closest('tr');
                                     var code = clickedRow.find('td:first-child');
                                     let cell = $(this);  // Reference to the clicked cell
                                     var currentText = cell.text();

                                     var exist=false;  // Get current text
                                     console.log('odl ' + code.text() +'old '+old)
                                     var codesoup=clickedRow.attr('id').split('ref')[1];
                                     // Create an input element and set its value
                                     let input = $('<input type="number" step="0.01" class="form-control"/>').val(currentText);
                                     cell.html(input);  // Replace the cell content with the input

                                     input.focus();
                                     input.blur(function()
                                    {
                                        let newText = $(this).val();
                                        if (T == '2') {
                                            var testcpattendu = clickedRow.find('td').eq(5).text();//cpattendu
                                            var testaeattendu = clickedRow.find('td').eq(4).text();//aeattendu
                                            var testcpover = clickedRow.find('td').eq(3).text();//cpovert
                                            var testaeover = clickedRow.find('td').eq(2).text();//aeovert
                                            var someae = 0;
                                            var somecp = 0;
                                            if (newText != 0 && newText != '' && newText != null) {
                                                var wit = $(this).parent().attr('id');
                                                console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                                                if (wit == 'CP_att') {
                                                    testcpattendu = newText
                                                }
                                                if (wit == 'AE_att') {
                                                    testaeattendu = newText
                                                }
                                                if (wit == 'AE_Over') {
                                                    testaeover = newText
                                                }
                                                if (wit == 'CP_Over') {
                                                    testcpover = newText
                                                }
                                                somecp = parseFloat(testcpattendu) + parseFloat(testcpover)
                                                someae = parseFloat(testaeattendu) + parseFloat(testaeover);
                                                console.log('ae' + someae + ' cp ' + somecp)
                                                clickedRow.find('td').eq(6).text(someae);
                                                clickedRow.find('td').eq(7).text(somecp);
                                            }
                                        }
                                        if(dataupdate.length > 0)
                                        {
                                           for (let index = 0; index < dataupdate.length; index++) {
                                            const element = dataupdate[index];
                                             if(element.code === codesoup)
                                             {
                                                console.log('code exisit'+JSON.stringify(element))
                                               if( clickid == 'AE_T1' || clickid == 'AE_T4')
                                               {
                                                element.value.ae=newText;
                                               }
                                               if(clickid == 'CP_T1' || clickid == 'CP_T4')
                                               {
                                                element.value.cp=newText;
                                               }
                                               if(clickid == 'AE_Over')
                                               {
                                                element.value.ae_ouvert=newText
                                               }
                                               if(clickid == 'AE_att')
                                                {
                                                    element.value.ae_attendu=newText
                                                }
                                                if(clickid == 'CP_Over')
                                                {
                                                    element.value.cp_ouvert=newText
                                                }
                                                if(clickid == 'CP_att')
                                                {
                                                    element.value.cp_attendu=newText
                                                }
                                                if(clickid == 'AE_rpor')
                                                {
                                                    element.value.ae_reporte=ae_reporte
                                                }
                                                if(clickid == 'AE_not')
                                                {
                                                    element.value.ae_notifie=ae_notifie
                                                }
                                                if(clickid == 'AE_enga')
                                                {
                                                    element.value.ae_engage=ae_engage
                                                }
                                                if(clickid == 'CP_rpor')
                                                {
                                                element.value.cp_reporte=cp_reporte
                                                }
                                                if(clickid == 'CP_not')
                                                {
                                                element.value.cp_notifie=cp_notifie
                                                }
                                                if(clickid == 'CP_consom')
                                                {
                                                element.value.cp_consome=cp_consome
                                                }
                                                exist=true;
                                             }
                                           }
                                        }

                                        if (newText != 0 && newText != '' && newText != null) {
                                            mount_chang = true

                                            if (mount_chang == true) {
                                                console.log('tesing ' + newText)
                                                click++;
                                                if (click == 1) {
                                                    var buttons = '<button class="btn btn-primary" id="changin-up"> appliquer</button>'
                                                    click++
                                                }
                                                $('.change_app').append(buttons)


                                            //  console.log('all table'+JSON.stringify(value_chng))
                                            cell.text(newText);
                                            if(!exist){
                                                if(clickid == 'AE_T1' || clickid == 'AE_T4')
                                                {
                                                    ae=newText
                                                    cp=0
                                                }
                                                if(clickid == 'CP_T1' || clickid == 'CP_T4')
                                                {
                                                    ae=0
                                                    cp=newText
                                                }
                                                if(clickid == 'AE_Over')
                                                {
                                                     ae_ouvert=newText
                                                }
                                                if(clickid == 'AE_att')
                                                {
                                                 ae_attendu=newText
                                                }
                                                if(clickid == 'CP_Over')
                                                {
                                                cp_ouvert=newText
                                                }
                                                if(clickid == 'CP_att')
                                                {
                                                cp_attendu=newText
                                                }
                                                if(clickid == 'AE_rpor')
                                                    {
                                                       ae_reporte=newText
                                                    }
                                                    if(clickid == 'AE_not')
                                                    {
                                                       ae_notifie=newText
                                                    }
                                                    if(clickid == 'AE_enga')
                                                    {
                                                        ae_engage=newText
                                                    }
                                                    if(clickid == 'CP_rpor')
                                                    {
                                                    cp_reporte=newText
                                                    }
                                                    if(clickid == 'CP_not')
                                                    {
                                                    cp_notifie=newText
                                                    }
                                                    if(clickid == 'CP_consom')
                                                    {
                                                    cp_consome=newText
                                                    }

                                                if( T == '1')
                                                {
                                                    dataupdate.push({code:codesoup,value:{ae:ae,cp:cp}});
                                                }
                                                if(T == '2')
                                                {
                                                dataupdate.push({code:codesoup,value:{ae_ouvert:ae_ouvert,ae_attendu:ae_attendu,cp_ouvert:cp_ouvert,cp_attendu:cp_attendu}});
                                                }
                                                if(T == '3')
                                                {
                                                    dataupdate.push({code:codesoup,value:{ae_notifie:ae_notifie,ae_reporte:ae_reporte,ae_engage:ae_engage,
                                                                                          cp_notifie:cp_notifie,cp_reporte:cp_reporte,cp_consome:cp_consome}})
                                                }
                                                if(T == '4')
                                                {
                                                        dataupdate.push({code:codesoup,value:{ae:ae,cp:cp}})
                                                }

                                            console.log('i insert '+JSON.stringify(dataupdate))
                                            }
                                            $("#changin-up").on('click',function()
                                            {
                                                console.log('click once')
                                                i++
                                                if( i === 1)
                                                    {
                                               $.ajax({
                                                    url:'/update',
                                                    type:'POST',
                                                    data:{
                                                        Tport:T,
                                                        result:dataupdate,
                                                        _token: $('meta[name="csrf-token"]').attr("content"),
                                                        _method: "POST",},
                                                        success:function(response)
                                                        {

                                                        }

                                                })
                                                    }
                                                   console.log('testing'+JSON.stringify(dataupdate))
                                                   $('.change_app').empty()

                                                //dataupdate=[];
                                                click=0;
                                            })
                                        }
                                        }
                                        else {
                                            cell.empty();
                                            cell.text(old)
                                        }
                                    })

                                })
                            })
                            i=0;
                         }
                         /**
                          *
                          * The end of update function
                          */
                         function Edit(tid, T) {
                             $(document).ready(function () {
                                 var old;
                                 var data = {
                                     ae: {},
                                     cp: {},
                                     ae_ouvert: {},
                                     cp_ouvert: {},
                                     ae_attendu: {},
                                     cp_attendu: {},
                                     ae_reporte: {},
                                     ae_notifie: {},
                                     ae_engage: {},
                                     cp_reporte: {},
                                     cp_notifie: {},
                                     cp_consome: {}
                                 };
                                 // Add double-click event to all cells with the class "editable"
                                 $('.editable').on('click', function () {
                                     let cell = $(this);  // Reference to the clicked cell
                                     old = cell.text();
                                 })
                                 $('.editable').dblclick(function () {
                                     var clickid = $(this).attr('id');
                                     var clickedRow = $(this).closest('tr');
                                     var code = clickedRow.find('td:first-child');
                                     let cell = $(this);  // Reference to the clicked cell
                                     var currentText = cell.text();  // Get current text
                                     console.log('odl ' + code.text())
                                     // Create an input element and set its value
                                     let input = $('<input type="number" step="0.01" class="form-control"/>').val(currentText);
                                     cell.html(input);  // Replace the cell content with the input

                                     input.focus();  // Focus on the input immediately

                                     // When the input loses focus, update the cell with new text
                                     input.blur(function (t) {
                                         let newText = $(this).val();  // Get new value from input

                                         if (tid == 'T_port2' || tid == 'T2') {
                                             var testcpattendu = clickedRow.find('td').eq(5).text();//cpattendu
                                             var testaeattendu = clickedRow.find('td').eq(4).text();//aeattendu
                                             var testcpover = clickedRow.find('td').eq(3).text();//cpovert
                                             var testaeover = clickedRow.find('td').eq(2).text();//aeovert
                                             var someae = 0;
                                             var somecp = 0;
                                             if (newText != 0 && newText != '' && newText != null) {
                                                 var wit = $(this).parent().attr('id');
                                                 console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                                                 if (wit == 'CP_att') {
                                                     testcpattendu = newText
                                                 }
                                                 if (wit == 'AE_att') {
                                                     testaeattendu = newText
                                                 }
                                                 if (wit == 'AE_Over') {
                                                     testaeover = newText
                                                 }
                                                 if (wit == 'CP_Over') {
                                                     testcpover = newText
                                                 }
                                                 somecp = parseFloat(testcpattendu) + parseFloat(testcpover)
                                                 someae = parseFloat(testaeattendu) + parseFloat(testaeover);
                                                 console.log('ae' + someae + ' cp ' + somecp)
                                                 clickedRow.find('td').eq(6).text(someae);
                                                 clickedRow.find('td').eq(7).text(somecp);
                                             }
                                         }
                                         if (newText != 0 && newText != '' && newText != null) {
                                             mount_chang = true

                                             if (mount_chang == true) {
                                                 console.log('tesing ' + newText)
                                                 click++;
                                                 if (click == 1) {
                                                     var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
                                                 }
                                                 $('.change_app').append(buttons)
                                                 $('#changin').on('click', function () {
                                                     // value_chng=new Array()

                                                     //    alert('changing success')
                                                     $('#T-tables tbody tr').each(function () {

                                                         if (tid == 'T_port1' || tid == 'T1') {

                                                             var code = $(this).find('td').eq(0).text();
                                                             var aeValue = $(this).find('td').eq(2).text();
                                                             var cpValue = $(this).find('td').eq(3).text();
                                                             // Ajoute les valeurs dans les objets
                                                             data.ae[code] = aeValue;
                                                             data.cp[code] = cpValue;
                                                             console.log('Data of T1'+JSON.stringify(data));


                                                         }
                                                         if (tid == 'T_port2' || tid == 'T2') {

                                                             var code = $(this).find('td').eq(0).text();
                                                             var aeDataOuvert = $(this).find('td').eq(2).text();
                                                             var cpDataOuvert = $(this).find('td').eq(3).text();
                                                             var aeDataAttendu = $(this).find('td').eq(4).text();
                                                             var cpDataAttendu = $(this).find('td').eq(5).text();
                                                          /* var someae = parseFloat(aeDataOuvert) + parseFloat(aeDataAttendu);
                                                             var somecp = parseFloat(cpDataOuvert) + parseFloat(cpDataAttendu);
                                                             */
                                                             // Ajoute les valeurs dans les objets
                                                             data.ae_ouvert[code] = aeDataOuvert;
                                                             data.cp_ouvert[code] = cpDataOuvert;
                                                             data.ae_attendu[code] = aeDataAttendu;
                                                             data.cp_attendu[code] = cpDataAttendu;

                                                         }
                                                         if (tid == 'T_port3' || tid == 'T3' || T == 3) {

                                                             var code = $(this).find('td').eq(0).text();
                                                             var aeDataReporte = $(this).find('td').eq(3).text();
                                                             var aeDataNotifie = $(this).find('td').eq(4).text();
                                                             var aeDataEngage = $(this).find('td').eq(5).text();

                                                             var cpDataReporte = $(this).find('td').eq(6).text();
                                                             var cpDataNotifie = $(this).find('td').eq(7).text();
                                                             var cpDataEngage = $(this).find('td').eq(8).text();


                                                             // Ajoute les valeurs dans les objets
                                                             //console.log("ddcss");
                                                             data.ae_reporte[code] = aeDataReporte;
                                                             data.ae_notifie[code] = aeDataNotifie;
                                                             data.ae_engage[code] = aeDataEngage;

                                                             data.cp_reporte[code] = cpDataReporte;
                                                             data.cp_notifie[code] = cpDataNotifie;
                                                             data.cp_consome[code] = cpDataEngage;

                                                         }
                                                         if (tid == 'T_port4' || tid == 'T4') {

                                                             var code = $(this).find('td').eq(0).text();
                                                             var aeValue = $(this).find('td').eq(2).text();
                                                             var cpValue = $(this).find('td').eq(3).text();
                                                             // Ajoute les valeurs dans les objets
                                                             data.ae[code] = aeValue;
                                                             data.cp[code] = cpValue;
                                                            console.log('T4'+JSON.stringify(data))

                                                         }
                                                         // value_chng.push(rw);
                                                     })

                                                     $('.change_app').empty()
                                                     //  console.log('path' + JSON.stringify(path))
                                                     //console.log('path' + JSON.stringify(path3))
                                                     //var url=   '/testing/Action/' + path.join('/');
                                                     console.log(" eat " + path3.length)
                                                     if (path3.length > 4) {
                                                        console.log('URL plus' + url)
                                                         var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[4] + '/' + T;
                                                         //var id_sous_action= path[4];
                                                     } else {

                                                         // var id_sous_action= path[3];
                                                         var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[3] + '/' + T;
                                                         console.log('URL less' + url)
                                                     }

                                                     $.ajax({
                                                         url: url,
                                                         type: 'GET',
                                                         data: {
                                                             ae: data.ae,
                                                             cp: data.cp,

                                                             ae_ouvert: data.ae_ouvert,
                                                             cp_ouvert: data.cp_ouvert,
                                                             ae_attendu: data.ae_attendu,
                                                             cp_attendu: data.cp_attendu,

                                                             ae_reporte: data.ae_reporte,
                                                             ae_notifie: data.ae_notifie,
                                                             ae_engage: data.ae_engage,
                                                             cp_reporte: data.cp_reporte,
                                                             cp_notifie: data.cp_notifie,
                                                             cp_consome: data.cp_consome,
                                                             //id_sous_action: id_sous_action,
                                                             _token: $('meta[name="csrf-token"]').attr('content'),
                                                             _method: "GET"
                                                         },
                                                         success: function (response) {
                                                             if (response.code == 200 || response.code == 404) {
                                                               //  window.location.reload();
                                                                 console.log('path' + JSON.stringify(path))

                                                             }
                                                             else
                                                             {
                                                                console.log(response.message)
                                                             }
                                                         },
                                                         error: function (response) {
                                                             console.log('error')
                                                         }


                                                     });
                                                     click = 0;
                                                 })
                                             }
                                             //  console.log('all table'+JSON.stringify(value_chng))
                                             cell.text(newText);
                                         }
                                         else {
                                             cell.empty();
                                             cell.text(old)
                                         }
                                         // Set the new value back to the cell
                                     });

                                     // Optionally, save when Enter key is pressed
                                     input.keydown(function (event) {
                                         if (event.key === 'Enter') {
                                             input.blur();  // Trigger blur event to save and exit input mode
                                         }
                                     });
                                 });

                             });

                         }

                         function add_T1() {
                             var T1 = '<div class="col-md-15 hover-container" id="T1-card-handle">' +
                                 '<div class="card">' +
                                 ' <div class="icon-holder">' +
                                 '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
                                 '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
                                 '</div>' +
                                 '<div class="card-body" id="T-card_button">' +
                                 '<h5 class="card-title">Titre 1</h5>' +
                                 ' <p class="card-text">Description pour Titre 1.</p>' +
                                 '<button class="btn btn-primary bts" id="T1">Vers Les Operation</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T1-handle').append(T1)
                         }
                         function add_T2() {
                             var T1 = '<div class="col-md-15 hover-container" id="T2-card-handle">' +
                                 '<div class="card">' +
                                 ' <div class="icon-holder">' +
                                 '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
                                 '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
                                 '</div>' +
                                 '<div class="card-body" id="T-card_button">' +
                                 '<h5 class="card-title">Titre 2</h5>' +
                                 ' <p class="card-text">Description pour Titre 2.</p>' +
                                 '<button class="btn btn-primary bts" id="T2">Vers Les Operation</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T2-handle').append(T1)
                         }
                         function add_T3() {
                             var T1 = '<div class="col-md-15 hover-container" id="T3-card-handle">' +
                                 '<div class="card">' +
                                 ' <div class="icon-holder" >' +
                                 '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
                                 '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
                                 '</div>' +
                                 '<div class="card-body" id="T-card_button">' +
                                 '<h5 class="card-title">Titre 3</h5>' +
                                 ' <p class="card-text">Description pour Titre 3.</p>' +
                                 '<button class="btn btn-primary bts" id="T3">Vers Les Operation</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T3-handle').append(T1)
                         }
                         function add_T4() {
                             var T1 = '<div class="col-md-15 hover-container" id="T4-card-handle">' +
                                 '<div class="card">' +
                                 ' <div class="icon-holder">' +
                                 '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
                                 '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
                                 '</div>' +
                                 '<div class="card-body" id="T-card_button">' +
                                 '<h5 class="card-title">Titre 4</h5>' +
                                 ' <p class="card-text">Description pour Titre 4.</p>' +
                                 '<button class="btn btn-primary bts" id="T4">Vers Les Operation</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T4-handle').append(T1)
                         }
                         function T1_newform() {
                             var newT = '<div class="TP-handle">' +
                                 ' <div class="card-T">' +
                                 '<div class="container-card bg-yellow-box">' +
                                 '<!--i class="fas fa-door-closed T-icon"></i-->' +
                                 '<i class="fas fa-door-open T-icon"></i>' +
                                 '<p class="card-title-T">Titre Port 1</p>' +
                                 ' <p class="card-description-T">AE 190,000 DZ.</p>' +
                                 ' <p class="card-description-T">CP 100,000 DZ.</p>' +
                                 ' <button id="T1">...</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T1-handle').append(newT)
                         }
                         function T2_newform() {
                             var newT = '<div class="TP-handle">' +
                                 ' <div class="card-T">' +
                                 '<div class="container-card bg-yellow-box">' +
                                 '<!--i class="fas fa-door-closed T-icon"></i-->' +
                                 '<i class="fas fa-door-open T-icon"></i>' +
                                 '<p class="card-title-T">Titre Port 2</p>' +
                                 ' <p class="card-description-T">AE 290,000 DZ.</p>' +
                                 ' <p class="card-description-T">CP 100,000 DZ.</p>' +
                                 ' <button id="T2">...</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T2-handle').append(newT)
                         }
                         function T3_newform() {
                             var newT = '<div class="TP-handle">' +
                                 ' <div class="card-T">' +
                                 '<div class="container-card bg-yellow-box">' +
                                 '<!--i class="fas fa-door-closed T-icon"></i-->' +
                                 '<i class="fas fa-door-open T-icon"></i>' +
                                 '<p class="card-title-T">Titre Port 3</p>' +
                                 ' <p class="card-description-T">AE 390,000 DZ.</p>' +
                                 ' <p class="card-description-T">CP 100,000 DZ.</p>' +
                                 ' <button id="T3">...</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T3-handle').append(newT)
                         }
                         function T4_newform() {
                             var newT = '<div class="TP-handle">' +
                                 ' <div class="card-T">' +
                                 '<div class="container-card bg-yellow-box">' +
                                 '<!--i class="fas fa-door-closed T-icon"></i-->' +
                                 '<i class="fas fa-door-open T-icon"></i>' +
                                 '<p class="card-title-T">Titre Port 4</p>' +
                                 ' <p class="card-description-T">AE 490,000 DZ.</p>' +
                                 ' <p class="card-description-T">CP 100,000 DZ.</p>' +
                                 ' <button id="T4">...</button>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>'
                             $('#T4-handle').append(newT)
                         }
                         $('a').click(function (e) {
                             var _elem = $(this);

                             $('a').parent('li').each(function () {
                                 $(this).removeClass('active');
                             });

                             _elem.parent('li').addClass('active');
                         });
                         (function () {
                             $('#msbo').on('click', function () {
                                 $('body').toggleClass('msb-x');
                             });
                         }());
                         $(document).ready(function () {
                             $('.card-photo-holder').on('click', function () {
                                 alert('clicks')
                                 window.location = '/tech';
                             })
                         })
                         $(document).ready(function () {


                             // Vérifie l'existence du portefeuille lorsque le champ de date perd le focus
                             $('#date_crt_portf').on('focusout', function () {
                                 var num_portefeuil = $('#num_port').val(); // Récupérer la valeur du portefeuille
                                 var Date_portefeuille = $(this).val();  // Récupérer la valeur de la date

                                 var year = new Date(Date_portefeuille).getFullYear(); // Extraire l'année à partir de la date
                                 var numwall_year = num_portefeuil +'-'+ year;


                                 // Vérifie que les deux champs sont remplis avant de continuer
                                 if (Date_portefeuille && num_portefeuil) {
                                     // Appel AJAX pour vérifier le portefeuille dans la base de données
                                     $.ajax({
                                         url: '/check-portef',  // Route pour vérifier l'existence du portefeuille
                                         type: 'GET',
                                         data: {
                                             num_portefeuil: numwall_year,
                                             Date_portefeuille: Date_portefeuille
                                         },
                                         success: function (response) {
                                             if (response.exists) {
                                                 console.log(response); // Vérifiez la réponse

                                                 console.log('numwall_year path3: ' + JSON.stringify(path3));
                                                  $('#file_holder   ').empty()

                                                 // Remplir les champs du formulaire avec les données récupérées
                                                 $('#date_crt_portf').val(response.Date_portefeuille).trigger('change'); // Remplir et déclencher l'événement change
                                                 $('#AE_portef').val(response.AE_portef).trigger('change'); // Remplir et déclencher l'événement change
                                                 $('#CP_portef').val(response.CP_portef).trigger('change'); // Remplir et déclencher l'événement change
                                                 $('#nom_journ').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                                                 $('#num_journ').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change

                                                 console.log(response.Date_portefeuille);
                                                 alert('Le portefeuille existe déjà');

                                                 //$('.font-bk').removeClass('back-bk')
                                                 //$('.wallet-path').css('display', 'flex')
                                                 //$('.wallet-handle').empty()
                                                 //$('#progam-handle').css('display', 'block')
                                                 //$('#progam-handle').removeClass('scale-out')
                                                 //$('#progam-handle').addClass('scale-visible')
                                                 //$('#w_id').text(num_portefeuil)
                                             } else {
                                                 //alert('Le portefeuille n\'existe pas.');
                                             }
                                         },
                                         error: function () {
                                             alert('Erreur lors de la vérification du portefeuille');
                                         }
                                     });
                                 }
                             });


                             $("#add-wallet").on("click", function () {
                                 var num_wallet = $("#num_port").val();
                                 var dateprort = $("#date_crt_portf").val();
                                 var year = new Date(dateprort).getFullYear(); // Extraire l'année à partir de la date
                                 var numwall_year = num_wallet + '-'+ year;
                                 var indice = 0;
                                 var isEmpty = false;
                                 var formId = $(this).parents(".card-body").attr("id");
                                 console.log("and form id" + formId);
                                 $("#" + formId + " form")
                                     .find("input")
                                     .each(function () {
                                         console.log("before the loop");
                                         var inputValue = $(this).val();

                                         // Check if the input is not empty
                                         if (inputValue.trim() === "") {
                                             isEmpty = true;
                                             indice++;
                                         }

                                         if (isEmpty) {
                                             if (indice < 2) {
                                                 alert("Veuillez remplir tous les champs obligatoires");
                                             }
                                             $(this).css(
                                                 "box-shadow",
                                                 "0 0 0 0.25rem rgb(255 0 0 / 47%)"
                                             );
                                         }
                                     });
                                 // console.log('id'+num_wallet)
                                 var formportinsert = {
                                     num_portefeuil: numwall_year,
                                     Date_portefeuille: $("#date_crt_portf").val(),
                                     nom_journal: $("#nom_journ").val(),
                                     num_journal: parseInt($("#num_journ").val()),
                                     AE_portef: parseFloat($("#AE_portef").val()),
                                     CP_portef: parseFloat($("#CP_portef").val()),
                                     //year: year,
                                     _token: $('meta[name="csrf-token"]').attr("content"),
                                     _method: "POST",
                                 };

                                 // Ajouter le fichier s'il est sélectionné HOUDAA
                                 var fileInput = $("#inputFile")[0]; // Assurez-vous que l'input de fichier a l'ID `file`
                                 if (fileInput && fileInput.files.length > 0) {
                                     formportinsert.append("inputFile", fileInput.files[0]);
                                 }
                                 $.ajax({
                                     url: "/creation",
                                     type: "POST",
                                     data: formportinsert,
                                     success: function (response) {
                                         if (response.code == 200 ) {
                                            let formDataFa = new FormData();
                                            formDataFa.append('pdf_file', $('#pdf_file')[0].files[0]);
                                            formDataFa.append('related_id',num_wallet);
                                            $.ajax({
                                                url:'/upload-pdf',
                                                type:'POST',
                                                data:formDataFa,
                                                processData: false,
                                                contentType: false,
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                                                },
                                                success:function(response)
                                                {
                                                    if(response.code){
                                                    alert(response.message);
                                                    path.push(numwall_year);
                                                    path3.push(num_wallet);

                                                    console.log("numwall_year path: " + JSON.stringify(path));

                                                    $(".font-bk").removeClass("back-bk");
                                                    $(".wallet-path").css("display", "flex");
                                                    $(".wallet-handle").empty();
                                                    $(".wallet-handle").addClass('wallet-hide');
                                                    $("#progam-handle").css("display", "block");
                                                    $("#progam-handle").removeClass("scale-out");
                                                    $("#progam-handle").addClass("scale-visible");
                                                    $("#w_id").text(num_wallet);}
                                                    else
                                                    {
                                                        alert(response.message);
                                                    }
                                                }
                                            })
                                         } else if( response.code == 404) {

                                            alert(response.message);
                                            path.push(numwall_year);
                                            path3.push(num_wallet);

                                            console.log("numwall_year path: " + JSON.stringify(path));
                                            $(".font-bk").removeClass("back-bk");
                                            $(".wallet-path").css("display", "flex");
                                            $(".wallet-handle").empty();
                                            $(".wallet-handle").addClass('wallet-hide');
                                            $("#progam-handle").css("display", "block");
                                            $("#progam-handle").removeClass("scale-out");
                                            $("#progam-handle").addClass("scale-visible");
                                            $("#w_id").text(num_wallet);
                                        }
                                            else{
                                             alert(response.message);
                                         }
                                     },
                                     error: function () {
                                         alert("error");
                                     },
                                 });
                             });




                         });
                         focus_()
                         $("#date_insert_portef").on('focusout', function () {
                             var num_prog = $('#num_prog').val(); // Récupérer la valeur du portefeuille
                             var Date_prog = $(this).val();  // Récupérer la valeur de la date

                             var year = new Date(Date_prog).getFullYear(); // Extraire l'année à partir de la date
                             var numprog_year = path[0] +'-'+num_prog;


                             // Vérifie que les deux champs sont remplis avant de continuer
                             if (Date_prog && num_prog) {
                                 // Appel AJAX pour vérifier le portefeuille dans la base de données

                                 console.log('data' + numprog_year)
                                 $.ajax({
                                     url: '/check-prog',  // Route pour vérifier l'existence du portefeuille
                                     type: 'GET',
                                     data: {
                                         num_portefeuil: path[0],
                                         num_prog: numprog_year,
                                         Date_prog: Date_prog
                                     },
                                     success: function (response) {
                                         if (response.exists) {
                                             console.log(response); // Vérifiez la réponse
                                             console.log('numwall_year path3: ' + JSON.stringify(path3));
                                             $("#file_holder_prog").empty();
                                             // Remplir les champs du formulaire avec les données récupérées
                                             console.log('response.CP_prog' + response.CP_prog)
                                             $('#date_insert_portef').val(response.date_insert_portef).trigger('change');
                                             $('#nom_prog').val(response.nom_prog).trigger('change'); // Remplir et déclencher l'événement change
                                             $('#AE_prog').val(response.AE_prog).trigger('change'); // Remplir et déclencher l'événement change
                                             $('#CP_prog').val(response.CP_prog).trigger('change'); // Remplir et déclencher l'événement change
                                             $('#nom_journ').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                                             $('#num_journ').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change


                                             alert('Le programme existe déjà');

                                         }
                                     },
                                     error: function () {
                                         alert('Erreur lors de la vérification du programme');
                                     }
                                 });
                             }
                         });
                         $("#add-prg").on('click', function () {
                             var id_prog = $('#num_prog').val();
                             var nom_prog = $('#nom_prog').val();
                             var ae_prog = parseFloat($('#AE_prog').val())
                             var cp_prog = parseFloat($('#CP_prog').val())
                             var numprog_year =path[0] +'-'+ id_prog;
                             console.log("path[0]",path[0] );
                             console.log("id_prog",id_prog );
                             console.log("prog",numprog_year );
                             var date_sort_jour = $('#date_insert_portef').val();
                             check_ifnull(this)
                             var formprogdata = {
                                 num_prog: numprog_year,
                                 nom_prog: nom_prog,
                                 ae_prog: parseFloat(ae_prog),
                                 cp_prog: parseFloat(cp_prog),
                                 num_portefeuil: path[0],
                                 date_insert_portef: date_sort_jour,
                                 _token: $('meta[name="csrf-token"]').attr('content'),
                                 _method: 'POST'
                             }
                             var prg2 = '<div class="form-container" id="creati-sous_prog">' +
                                 '<form enctype="multipart/form-data">' +
                                 '<div class="form-group">' +
                                 '<label for="input1">Code du Sous Programme</label>' +
                                 '<input type="text" class="form-control" id="num_sous_prog" placeholder="Entrer le  Code du Sous Programme">' +
                                 '</div>' +
                                 ' <div class="form-group">' +
                                 ' <label for="inputDate">Date du Journal</label>' +
                                 '<input type="date" class="form-control" id="date_insert_sousProg">' +
                                 '</div>' +
                                 '<div class="form-group">' +
                                 '<label for="input1">Nom du Sous Programme</label>' +
                                 '<input type="text" class="form-control" id="nom_sous_prog" placeholder="Entrer le Nom du Sous Programme">' +
                                 '</div>' +
                                 '<div class="form-group">' +
                                 '<label for="input1">AE pour Sous Programme</label>' +
                                 '<input type="number" class="form-control" id="AE_sous_prog"   placeholder="Entrer AE Sous Programme">' +
                                 '</div>' +
                                 '<div class="form-group">' +
                                 '<label for="input1">CP pour Sous Programme</label>' +
                                 '<input type="number" class="form-control" id="CP_sous_prog"  placeholder=" Entrer CP Sous Programme">' +
                                 '</div>' +
                                 '<div class="init_holder">'+
                                 '<div class="T_init_port">'+
                                 '<div class="ports_init">'+
                                 '<div class="form-group">' +
                                 '<label for="input1">T1 pour Sous Programme</label>' +
                                 '<input type="number" class="form-control" id="T1_AE_init"   placeholder="Entrer T1 AE Sous Programme">' +
                                 '<input type="number" class="form-control" id="T1_CP_init"   placeholder="Entrer T1 CP Sous Programme">' +
                                 '</div>' +
                                 '<div class="form-group">' +
                                 '<label for="input1">T2 pour Sous Programme</label>' +
                                 '<input type="number" class="form-control" id="T2_AE_init"   placeholder="Entrer T2 AE Sous Programme">' +
                                 '<input type="number" class="form-control" id="T2_CP_init"   placeholder="Entrer T2 CP Sous Programme">' +
                                 '</div>' +
                                 '<div class="form-group">' +
                                 '<label for="input1">T3 pour Sous Programme</label>' +
                                 '<input type="number" class="form-control" id="T3_AE_init"   placeholder="Entrer T3 AE Sous Programme">' +
                                 '<input type="number" class="form-control" id="T3_CP_init"   placeholder="Entrer T3 CP Sous Programme">' +
                                 '</div>' +
                                 '<div class="form-group">' +
                                 '<label for="input1">T4 pour Sous Programme</label>' +
                                 '<input type="number" class="form-control" id="T4_AE_init"   placeholder="Entrer T4 AE Sous Programme">' +
                                 '<input type="number" class="form-control" id="T4_CP_init"   placeholder="Entrer T4 CP Sous Programme">' +
                                 '</div>' +
                                 '</div>'+
                                 '</div>'+
                                 '</div>'+
                                 ' </form>' +
                                 ' <br>' +
                                 '<div id="confirm-holder_sprog">' +
                                 ' <div class="file-handle" id="file_holder">' +
                                 '<input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png">' +
                                 '</div>' +
                                  '<hr>' +
                                 '<button class="btn btn-primary" id="add-prg2">Ajouter</button>' +
                                 '</div>'
                             var nexthop = '<div class="pinfo-handle">' +
                                 '<i class="fas fa-wallet"></i>' +
                                 '<p >Programm :</p>' +
                                 '<p>' + id_prog + '</p>' +
                                 '</div>' +
                                 ' <div class="next-handle">' +
                                 '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                                 '</div>';
                             $.ajax({
                                 url: '/creationProg',
                                 type: "POST",
                                 data: formprogdata,
                                 success: function (response) {
                                     if (response.code == 200 || response.code == 404) {

                                        if(response.code == 200){
                                        if(upload_file('file',id_prog) == 200)
                                        {
                                            alert(response.message)
                                        }}
                                         path.push(numprog_year);
                                         path3.push(id_prog);
                                         console.log('numprog_year path: ' + JSON.stringify(path));
                                         console.log('numprog path: ' + JSON.stringify(path3));
                                         $('.next-handle svg').removeClass('waiting-icon')
                                         $('.next-handle svg').addClass('complet-icon')
                                         $('.the-path').append(nexthop)
                                         $('#progam-handle').append(prg2)
                                         $('#confirm-holder').empty()
                                         $('#confirm-holder').append('<i class="fas fa-wrench"></i>')

                                         // Vérifie l'existence du programme lorsque le champ de programme perd le focus
                                         $('#date_insert_sousProg').on('focusout', function () {
                                             var Date_sou_program = $(this).val(); // Récupérer la valeur du programme
                                             //var year = new Date(Date_sou_program).getFullYear(); // Extraire l'année à partir de la date
                                             var num_sou_prog = $('#num_sous_prog').val(); // Récupérer la valeur de la date du programme
                                             // Vérifie que les deux champs sont remplis avant de continuer
                                             var num_sou_program = path[1] +'-'+ num_sou_prog;
                                             if (Date_sou_program && num_sou_prog) {
                                                 // Appel AJAX pour vérifier le programme dans la base de données
                                                 $.ajax({
                                                     url: '/check-sousprog',  // Route pour vérifier l'existence du programme
                                                     type: 'GET',
                                                     data: {
                                                         num_sous_prog: num_sou_program,
                                                     },
                                                     success: function (response) {
                                                        if (response.exists) {
                                                            console.log(response); // Vérifiez la réponse

                                                            // Remplir les champs du formulaire avec les données récupérées
                                                            $('#nom_sous_prog').val(response.nom_sous_prog).trigger('change');
                                                            $('#AE_sous_prog').val(response.AE_sous_prog).trigger('change');
                                                            $('#CP_sous_prog').val(response.CP_sous_prog).trigger('change');

                                                            $('#T1_AE_init').val(response.T1_AE_init).trigger('change');
                                                            $('#T1_CP_init').val(response.T1_CP_init).trigger('change');

                                                            $('#T2_AE_init').val(response.T2_AE_init).trigger('change');
                                                            $('#T2_CP_init').val(response.T2_CP_init).trigger('change');

                                                            $('#T3_AE_init').val(response.T3_AE_init).trigger('change');
                                                            $('#T3_CP_init').val(response.T3_CP_init).trigger('change');

                                                            $('#T4_AE_init').val(response.T4_AE_init).trigger('change');
                                                            $('#T4_CP_init').val(response.T4_CP_init).trigger('change');

                                                            alert('Le sous-programme existe déjà.');
                                                        }  else {
                                                             // alert('Le programme n\'existe pas.');
                                                         }
                                                     },
                                                     error: function () {
                                                         alert('Erreur lors de la vérification du programme');
                                                     }
                                                 });
                                             }
                                         });
                                         focus_()
                                         /**  sous prog insert */
                                         $('#add-prg2').on('click', function () {
                                             var sou_prog = $('#num_sous_prog').val()
                                             var nom_sou_prog = $('#nom_sous_prog').val();
                                             var dat_sou_prog = $('#date_insert_sousProg').val()
                                             var AE_sous_prog = $('#AE_sous_prog').val()
                                             var T1_AE_init = $('#T1_AE_init').val()
                                             var T1_CP_init = $('#T1_CP_init').val()

                                             var T2_AE_init = $('#T2_AE_init').val()
                                             var T2_CP_init = $('#T2_CP_init').val()

                                             var T3_AE_init = $('#T3_AE_init').val()
                                             var T3_CP_init = $('#T3_CP_init').val()

                                             var T4_AE_init = $('#T4_AE_init').val()
                                             var T4_CP_init = $('#T4_CP_init').val()

                                             var CP_sous_prog = $('#CP_sous_prog').val()
                                             var id_prog = path[1];
                                             var numsouprog_year = id_prog +'-'+sou_prog ;
                                             check_ifnull('#add-prg2')
                                             //var id_port = path[0];
                                             var nexthop = '<div class="pinfo-handle">' +
                                                 '<i class="fas fa-wallet"></i>' +
                                                 '<p >S_Program :</p>' +
                                                 '<p>' + sou_prog + '</p>' +
                                                 '</div>' +
                                                 ' <div class="next-handle">' +
                                                 '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                                                 '</div>'
                                             var prg3 = '<div class="form-container" id="creati-act">' +
                                                 '<form>' +
                                                 '<div class="form-group">' +
                                                 '<label for="input1">Code  d\'ACTION</label>' +
                                                 '<input type="text" class="form-control" id="num_act" placeholder="Entrer le Code  d\'ACTION">' +
                                                 '</div>' +
                                                 ' <div class="form-group">' +
                                                 ' <label for="inputDate">Date du Journal</label>' +
                                                 '<input type="date" class="form-control" id="date_insert_action">' +
                                                 '</div>' +
                                                 '<div class="form-group">' +
                                                 '<label for="input1">Nom  d\'ACTION</label>' +
                                                 '<input type="text" class="form-control" id="nom_act" placeholder="Entrer le Nom  d\'ACTION">' +
                                                 '</div>' +
                                                 '<div class="form-group" id="ElAE_act">' +
                                                 '<label for="input1">AE pour Action</label>' +
                                                 '<input type="number" class="form-control" id="AE_act" placeholder="Entrer AE Action">' +
                                                 '</div>' +
                                                 '<div class="form-group" id="ElCP_act">' +
                                                 '<label for="input1">CP pour Action</label>' +
                                                 '<input type="number" class="form-control" id="CP_act" placeholder="Entrer CP Action">' +
                                                 '</div>' +
                                                 ' </form>' +
                                                 ' <br>' +
                                                 '<div id="confirm-holder_sprog">' +
                                                 ' <div class="file-handle" id="file_holder">' +
                                                 '<input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png">' +
                                                 '</div>' +
                                                 '<hr>' +
                                                 '<div id="confirm-holder_act">' +
                                                 '<button class="btn btn-primary" id="add-prg3">Ajouter</button>' +
                                                 '</div>'
                                             var formdatasou_prog = {
                                                 num_sous_prog: numsouprog_year,
                                                 nom_sous_prog: nom_sou_prog,
                                                 AE_sous_prog: AE_sous_prog,
                                                 CP_sous_prog: CP_sous_prog,
                                                 date_insert_sousProg: dat_sou_prog,
                                                 id_program: id_prog,

                                                 T1_AE_init: T1_AE_init,
                                                 T1_CP_init: T1_CP_init,
                                                 code_t1: 10000,

                                                 T2_AE_init: T2_AE_init,
                                                 T2_CP_init: T2_CP_init,
                                                 code_t2: 20000,

                                                 T3_AE_init: T3_AE_init,
                                                 T3_CP_init: T3_CP_init,
                                                 code_t3: 30000,

                                                 T4_AE_init: T4_AE_init,
                                                 T4_CP_init: T4_CP_init,
                                                 code_t4: 40000,

                                                 //id_porte: id_port,
                                                 _token: $('meta[name="csrf-token"]').attr('content'),
                                                 _method: 'POST'
                                             }
                                             var formatinitports=
                                             {
                                                num_sous_prog: numsouprog_year,
                                                code_t1:10000,
                                                T1_AE_init:$('#T1_AE_init').val(),
                                                T1_CP_init:$('#T1_CP_init').val(),

                                                code_t2:20000,
                                                T2_AE_init:$('#T2_AE_init').val(),
                                                T2_CP_init:$('#T2_CP_init').val(),

                                                code_t3:30000,
                                                AE_init_t3:$('#T3_AE_init').val(),
                                                CP_init_t3:$('#T3_CP_init').val(),

                                                code_t4:40000,
                                                AE_init_t4:$('#T4_AE_init').val(),
                                                CP_init_t4:$('#T4_CP_init').val(),
                                                date_init:dat_sou_prog,
                                                _token: $('meta[name="csrf-token"]').attr('content'),
                                                _method: 'POST'
                                             }
                                             console.log('data' + JSON.stringify(formdatasou_prog))
                                             $.ajax({
                                                 url: '/creationSousProg',
                                                 type: "POST",
                                                 data: formdatasou_prog,
                                                 success: function (response) {
                                                     if (response.code == 200 || response.code == 404) {
                                                        if(response.code == 200){
                                                            if(upload_file('file',sou_prog) == 200)
                                                            {

                                                                alert(response.message)
                                                            }
                                                           /* $.ajax({
                                                                url:'/init_ports',
                                                                type:'POST',
                                                                data:formatinitports,
                                                                success:function(response)
                                                                {
                                                                    if(response.code == 200)
                                                                    {

                                                                    }
                                                                    else
                                                                    {

                                                                    }
                                                                }
                                                            })*/
                                                        }
                                                         alert(response.message)
                                                         path.push(numsouprog_year);
                                                         path3.push(sou_prog);
                                                         console.log('num_sou_program path: ' + JSON.stringify(path));

                                                         $('.next-handle svg').removeClass('waiting-icon')
                                                         $('.next-handle svg').addClass('complet-icon')
                                                         $('.the-path').append(nexthop)
                                                         $('#progam-handle').append(prg3)
                                                         $('#confirm-holder_sprog').empty()
                                                         $('#confirm-holder_sprog').append('<i class="fas fa-wrench"></i>')
                                                         focus_()



                                                         $('#date_insert_action').on('focusout', function () {
                                                             console.log('out')
                                                             var date_act = $(this).val();
                                                             var num_act = $('#num_act').val();
                                                             //  var date_act=  new Date(date_act).getFullYear();
                                                             var numact_year = path[2] +'-'+num_act ;
                                                             console.log('the new id' + numact_year + ' with ' + JSON.stringify(path))
                                                             console.log('jhvgf');
                                                             if (date_act && num_act) {
                                                                 $.ajax({
                                                                     url: '/check-action',  // Route pour vérifier l'existence du programme
                                                                     type: 'GET',
                                                                     data: {
                                                                         num_action: numact_year,
                                                                     },
                                                                     success: function (response) {
                                                                         if (response.exists) {
                                                                             $('#nom_act').val(response.nom_action).trigger('change'); // Remplir et déclencher l'événement change
                                                                              //$('#date_insert_action').val(response.date_insert_action).trigger('change'); // Remplir et déclencher l'événement change
                                                                             $('#AE_act').val(response.AE_act).trigger('change'); // Remplir et déclencher l'événement change
                                                                             $('#CP_act').val(response.CP_act).trigger('change'); // Remplir et déclencher l'événement change
                                                                             alert('L`Action existe déjà');

                                                                         }
                                                                         else {
                                                                             console.log('Erreur d`Opération');

                                                                         }
                                                                     }
                                                                 })
                                                             }
                                                         })

                                                         /******           ACTION add for under_progam                    *********** */


                                                         $('#add-prg3').on('click', function () {
                                                             /**
                                                              *  this part for chacking if he want to under_action
                                                              *
                                                              */
                                                             // Demande de confirmation pour ajouter une sous-action après l'ajout de l'action
                                                             let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                                             var nom_act = $('#nom_act').val();
                                                             var num_act = $('#num_act').val();
                                                             var AE_act = $('#AE_act').val()
                                                             var CP_act = $('#CP_act').val()
                                                             var dat_inst = $('#date_insert_action').val();
                                                             var id_sou_prog = path[2];
                                                             check_ifnull('#add-prg3')
                                                             var numaction_year = id_sou_prog +'-'+num_act ;
                                                                 var nexthop = '<div class="pinfo-handle">' +
                                                                     '<i class="fas fa-wallet"></i>' +
                                                                     '<p >Action :</p>' +
                                                                     '<p>' + num_act + '</p>' +
                                                                     '</div>' +
                                                                     ' <div class="next-handle">' +
                                                                     '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                                                                     '</div>'
                                                                 // Création du formData pour l'action
                                                                 console.log('action sous prog '+path[2])
                                                                 var formdata_act = {
                                                                     num_action: numaction_year,
                                                                     nom_action: nom_act,
                                                                     AE_act: AE_act,
                                                                     CP_act: CP_act,
                                                                     date_insert_action: dat_inst,
                                                                     id_sous_prog: path[2],
                                                                     _token: $('meta[name="csrf-token"]').attr('content'),
                                                                     _method: 'POST'
                                                                 };

                                                             if (userResponse) {
                                                                 // Récupération des informations de l'action


                                                                 // Envoi de l'Action via Ajax
                                                                 $.ajax({
                                                                     url: '/creationAction',
                                                                     type: 'POST',
                                                                     data: formdata_act,
                                                                     success: function (response) {
                                                                         if (response.code === 200 || response.code === 404) {
                                                                             // Ajout du numéro de l'action au chemin

                                                                             if(response.code == 200){
                                                                                if(upload_file('file',num_act) == 200)
                                                                                {
                                                                                    alert(response.message)
                                                                                }
                                                                            }
                                                                             path.push(numaction_year);
                                                                             path3.push(num_act);
                                                                             $('#confirm-holder_act').empty()
                                                                             $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                                                             console.log('A path: ' + JSON.stringify(path));
                                                                             $('#confirm-holder_act').empty()
                                                                             $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                                                             // Création du formulaire pour la sous-action après l'ajout de l'action
                                                                             var prg4 = `<div class="form-container" id="creati-act">
                                                                                    <form>
                                                                                     <div class="form-group">
                                                                                     <label for="num_sous_act">Code de Sous ACTION</label>
                                                                                     <input type="text" class="form-control" id="num_sous_act" placeholder="Entrer le Code de sous ACTION">
                                                                                    </div>
                                                                                     <div class="form-group">
                                                                                          <label for="date_insert_sou_action">Date du Journal</label>
                                                                                          <input type="date" class="form-control" id="date_insert_sou_action">
                                                                                        </div>
                                                                                     <div class="form-group">
                                                                                         <label for="nom_sous_act">Nom de  Sous ACTION</label>
                                                                                     <input type="text" class="form-control" id="nom_sous_act" placeholder="Entrer le Nom de sous ACTION">
                                                                                     </div>
                                                                                        <div class="form-group">
                                                                                         <label for="AE_sous_act">AE pour Sous Action</label>
                                                                                         <input type="number" class="form-control" id="AE_sous_act" placeholder="Entrer AE Sous Action">
                                                                                     </div>
                                                                                     <div class="form-group">
                                                                                       <label for="CP_sous_act">CP pour Sous Action</label>
                                                                                     <input type="number" class="form-control" id="CP_sous_act" placeholder="Entrer CP Sous Action">
                                                                                        </div>

                                                                                        </form>
                                                                                        <br>
                                                                                        <button class="btn btn-primary" id="add-prg4">Ajouter Sous Action</button>
                                                                                        </div>`;

                                                                             // Insertion du formulaire pour la sous-action dans le DOM
                                                                             $('.the-path').append(nexthop)
                                                                             $('#progam-handle').append(prg4);
                                                                             focus_()

                                                                             //===============CHECK SOUS ACTION=====================//
                                                                             $('#date_insert_sou_action').on('focusout', function () {
                                                                                //alert('out')
                                                                                var date_sousact = $(this).val();
                                                                                var num_sousact = $('#num_sous_act').val();
                                                                                //  var date_act=  new Date(date_act).getFullYear();
                                                                                var numsousact_year = path[3] +'-'+num_sousact ;
                                                                                console.log('numsousact_year' + numsousact_year + ' with ' + JSON.stringify(path))
                                                                                if (date_sousact && num_sousact) {
                                                                                    $.ajax({
                                                                                        url: '/check-sousaction',  // Route pour vérifier l'existence du programme
                                                                                        type: 'GET',
                                                                                        data: {
                                                                                            num_sous_action: numsousact_year,
                                                                                        },
                                                                                        success: function (response) {
                                                                                            if (response.exists) {
                                                                                                $('#nom_sous_act').val(response.nom_sous_action).trigger('change'); // Remplir et déclencher l'événement change
                                                                                                 $('#date_insert_sou_action').val(response.date_insert_sous_action).trigger('change'); // Remplir et déclencher l'événement change
                                                                                                $('#AE_sous_act').val(response.AE_sous_act).trigger('change'); // Remplir et déclencher l'événement change
                                                                                                $('#CP_sous_act').val(response.CP_sous_act).trigger('change'); // Remplir et déclencher l'événement change
                                                                                                alert('L`Action existe déjà');

                                                                                            }
                                                                                            else {
                                                                                                alert('Erreur d`Opération');

                                                                                            }
                                                                                        }
                                                                                    })
                                                                                }
                                                                            })
                                                                             //=============== FIN CHECK SOUS ACTION================//
                                                                             // Ajout de l'événement d'ajout pour la sous-action
                                                                             $('#add-prg4').on('click', function () {
                                                                                 console.log('inside sous_action')
                                                                                 var nom_sous_act = $('#nom_sous_act').val();
                                                                                 var num_sous_act = $('#num_sous_act').val();
                                                                                 var AE_sous_act = $('#AE_sous_act').val()
                                                                                 var CP_sous_act = $('#CP_sous_act').val()
                                                                                 var dat_inst = $('#date_insert_sou_action').val();
                                                                                 console.log("ae= ",AE_sous_act,"      " );
                                                                                 console.log("cp= ",CP_sous_act );
                                                                                 check_ifnull('#add-prg4')
                                                                                 var numaction_year = path[3];
                                                                                 var numsousaction_year = numaction_year +'-'+num_sous_act ;
                                                                                 // Création du formData pour la sous-action
                                                                                 var formdata_sous_act = {
                                                                                     num_sous_action: numsousaction_year,
                                                                                     nom_sous_action: nom_sous_act,
                                                                                     AE_sous_act: AE_sous_act,
                                                                                     CP_sous_act: CP_sous_act,
                                                                                     date_insert_sous_action: dat_inst,
                                                                                     num_act: path[3],
                                                                                     //id_sous_act: path[2],
                                                                                     //id_prog: path[1],
                                                                                     // id_porte: path[0],
                                                                                     //year: year,
                                                                                     _token: $('meta[name="csrf-token"]').attr('content'),
                                                                                     _method: 'POST'
                                                                                 };

                                                                                 // Envoi de la sous-action via Ajax
                                                                                 $.ajax({
                                                                                     url: '/creationsousAction',
                                                                                     type: 'POST',
                                                                                     data: formdata_sous_act,
                                                                                     success: function (response) {
                                                                                         if (response.code === 200 || response.code === 404) {
                                                                                             path.push(numsousaction_year);
                                                                                             path3.push(num_sous_act);
                                                                                             console.log('path: ' + JSON.stringify(path));

                                                                                             // Redirection vers la page suivante après l'ajout de la sous-action
                                                                                             alert('testing')
                                                                                             window.location.href = 'testing/S_action/' + path[0] + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[4];
                                                                                         }
                                                                                     },
                                                                                     error: function (response) {
                                                                                         alert('Erreur lors de l\'ajout de la sous-action.');
                                                                                     }
                                                                                 });
                                                                             });
                                                                         }
                                                                     },
                                                                     error: function (response) {
                                                                         alert('Erreur lors de l\'ajout de l\'action.');
                                                                     }
                                                                 });
                                                             } else {
                                                                 // Cas où l'utilisateur n'ajoute pas de sous-action
                                                                 var nom_act = $('#nom_act').val();
                                                                 var num_act = $('#num_act').val();
                                                                 var AE_act = $('#AE_act').val()
                                                                 var CP_act = $('#CP_act').val()
                                                                 var dat_inst = $('#date_insert_action').val();
                                                                 var id_sou_prog = path[2];
                                                                 var numaction_year = id_sou_prog +'-'+num_act ;
                                                                 var formdata_act = {
                                                                     num_action: numaction_year,
                                                                     nom_action: nom_act,
                                                                     AE_act: AE_act,
                                                                     CP_act: CP_act,
                                                                     date_insert_action: dat_inst,
                                                                     id_sous_prog: id_sou_prog,
                                                                     //id_prog: path[1],
                                                                     //id_porte: path[0],
                                                                     _token: $('meta[name="csrf-token"]').attr('content'),
                                                                     _method: 'POST'
                                                                 };

                                                                 $.ajax({
                                                                     url: '/creationAction',
                                                                     type: 'POST',
                                                                     data: formdata_act,
                                                                     success: function (response) {
                                                                         if (response.code === 200 || response.code === 404) {
                                                                            if(response.code == 200){
                                                                                if(upload_file('file',num_act) == 200)
                                                                                {
                                                                                    alert(response.message)
                                                                                }
                                                                            }
                                                                             path.push(numaction_year);
                                                                             path3.push(num_act);
                                                                             // console.log('path: ' + JSON.stringify(path));
                                                                             window.location.href = 'testing/Action/' + path[0] + '/' + path[1] + '/' + path[2] + '/' + path[3];
                                                                         }
                                                                     },
                                                                     error: function (response) {
                                                                         alert('Erreur lors de l\'ajout de l\'action.');
                                                                     }
                                                                 });
                                                             }

                                                             /*********         END ACTION ********************************************** */
                                                         })

                                                     }
                                                 },
                                                 error: function (response) {
                                                     alert('error')
                                                 }
                                             })

                                             /**  this for Creating the T port so we gonna send it to Action handle to deal with it */

                                         })
                                     }
                                 },
                                 error: function (response) {
                                     alert('error')
                                 }
                             })




                         });

                         /**
                          * this for action T port select table
                          *
                          */

                         function T1_table(id, T, id_s_act, port,code) {

                             var current = new Array();
                             var preve = new Array();
                             var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
                             var data_T_port = new Array();
                             console.log('T is' + T)
                             $('#Tport-handle').addClass('scale-out');
                             setTimeout(() => {
                                 // Add the class to hide the table
                                 $('#Tport-handle').addClass('scale-hidden');
                                 // Optionally remove the scaling out class after hiding
                                 $('#Tport-handle').removeClass('scale-out');
                                 $('.T-handle').css('display', 'flex')
                             }, 500)
                             if(code == 200)
                                 {
                             $.ajax({
                                 url: '/testing/S_action/' + port + '/' + id_s_act + '/T1',
                                 type: 'GET',
                                 success: function (response) {
                                     if (response.code === 200) {
                                         console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                                         data_T_port = response.results;
                                     }
                                     else {
                                         alert(response.message);
                                     }
                                 }
                             })
                         }

                             var headT = '<tr>' +
                                 '<th ><h1>Code</h1></th>' +
                                 '<th ><h1>T Description</h1></th>' +
                                 '<th><h1>AE</h1></th>' +
                                 '<th><h1>CP</h1></th>' +
                                 '</tr>';
                             $('#T-tables thead').append(headT)
                             $.getJSON(jsonpath1, function (data) {
                                 // Loop through each item in the JSON data
                                 var lengT = Object.keys(data).length
                                 var i = 0;
                                 var ig = 0;
                                 var io = 0;
                                 var iso = 0;
                               //  console.log('testing split function' + splitcode(data_T_port.group[0].code, 5)[0].substring)
                                 $.each(data, function (key, value) {
                                     // Create a table row
                                     let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                                         '<td scope="row" class="code" >' + key + '</td>' +
                                         '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                                         '<td class="editable" id="AE_T1">' + 0 + '</td>' +
                                         '<td class="editable" id="CP_T1">' + 0 + '</td>' +
                                         '</tr>';
                                         if(Object.keys(data_T_port).length > 0 ){
                                     if (data_T_port.group.length > 0 && data_T_port.group.length > ig) {
                                        var land=data_T_port.group[ig].code.length-5
                                         if (key == splitcode(data_T_port.group[ig].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                                                 '<td scope="row" class="code" >' + key + '</td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                                                 '<td class="editable" id="AE_T1">' + data_T_port.group[ig].values.ae_grpop + '</td>' +
                                                 '<td class="editable" id="CP_T1">' + data_T_port.group[ig].values.cp_grpop + '</td>' +
                                                 '</tr>';
                                             ig++;
                                         }
                                     }
                                     if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
                                        var land=data_T_port.operation[io].code.length-5
                                         if (key == splitcode(data_T_port.operation[io].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                                                 '<td scope="row"  class="code" >' + key + '</td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                                                 '<td class="editable" id="AE_T1">' + data_T_port.operation[io].values.ae_op + '</td>' +
                                                 '<td class="editable" id="CP_T1">' + data_T_port.operation[io].values.cp_op + '</td>' +
                                                 '</tr>';
                                             io++;
                                         }
                                     }
                                     if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso) {
                                        var land=data_T_port.sousOperation[iso].code.length-5
                                         if (key == splitcode(data_T_port.sousOperation[iso].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                                                 '<td scope="row"  class="code" >' + key + '</td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                                                 '<td class="editable" id="AE_T1">' + data_T_port.sousOperation[iso].values.ae_sousop + '</td>' +
                                                 '<td class="editable" id="CP_T1">' + data_T_port.sousOperation[iso].values.cp_sousuop + '</td>' +
                                                 '</tr>';
                                             iso++;
                                         }
                                     }
                         }
                                     // Append the row to the table body

                                     $('#T-tables tbody').append(row);
                                     if(code !== 200)
                                     {
                                        console.log('testing')
                                        Edit(id, T)
                                       ;
                                     }
                                     i++
                                     console.log('the lengh' + lengT + 'and the pas' + i)
                                     if (i == lengT) {
                                         if ($('.ref' + key + ' td').hasClass("editable")) {
                                         }
                                     }

                                     if (current.length == 0) {
                                         current = key;
                                         preve = current;
                                     }
                                     else {
                                         current = key;
                                         if (current.split("0")[0].length > preve.split("0")[0].length) {
                                             //console.log('testing editable'+key)
                                             $('.ref' + preve + ' td').each(function () {
                                                 $(this).removeClass('editable')
                                             })
                                             preve = current;
                                         }
                                         else {
                                             //   console.log('testing '+key)
                                             if ($('.ref' + preve + ' td').hasClass("editable")) {


                                             }
                                             preve = current;
                                         }
                                         current = key;
                                     }


                                 });
                                 if(code === 200)
                                 {Update_dpia(T,id_s_act);
                                 console.log('testing new update function')}
                             }).fail(function () {
                                 console.error('Error loading JSON file.');
                             });
                         }
                         function T2_table(id, T, id_s_act, port,code) {
                             var current = new Array();
                             var preve = new Array();
                             var data_T_port = new Array();
                             var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
                             $('#Tport-handle').addClass('scale-out');
                             setTimeout(() => {
                                 // Add the class to hide the table
                                 $('#Tport-handle').addClass('scale-hidden');
                                 // Optionally remove the scaling out class after hiding
                                 $('#Tport-handle').removeClass('scale-out');
                                 $('.T-handle').css('display', 'flex')
                             }, 500)
                         if(code == 200)
                             {
                             $.ajax({
                                 url: '/testing/S_action/' + port + '/' + id_s_act + '/T2',
                                 type: 'GET',
                                 success: function (response) {
                                     if (response.code === 200) {
                                         console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                                         data_T_port = response.results;
                                     }
                                     else {
                                         alert(response.message);
                                     }
                                 }
                             })
                         }

                             var headT = '<tr>' +
                                 '<th colspan="2"><h1>T Description</h1></th>' +
                                 ' <th colspan="2">' +
                                 ' <div class="fusion-father">' +
                                 ' <h1>CREDITS OUVERTS</h1>' +
                                 '<div class="fusion-child">' +
                                 ' <h1 style="width:40px;">AE</h1>' +
                                 ' <h1>CP</h1>' +
                                 ' </div>' +
                                 ' </div>  ' +
                                 '</th>' +
                                 '<th colspan="2">' +
                                 ' <div class="fusion-father">' +
                                 '<h1>CREDITS ATTENDUS EVENUS DISPONIBLES</h1>' +
                                 '<div class="fusion-child">' +
                                 '<h1 style="width:40px;">AE</h1>' +
                                 '<h1>CP</h1>' +
                                 '</div>' +
                                 '</div>    ' +
                                 '</th>' +
                                 '<th colspan="2">' +
                                 '<div class="fusion-father">' +
                                 '<h1>TOTAL CREDITS DISPONIBLES</h1>' +
                                 '<div class="fusion-child">' +
                                 ' <h1 style="width:40px;">AE</h1>' +
                                 '<h1>CP</h1>' +
                                 '</div>' +
                                 '</div>    ' +
                                 '</th>' +
                                 '</tr>';
                             $('#T-tables thead').append(headT)
                             $.getJSON(jsonpath2, function (data) {
                                 // Loop through each item in the JSON data
                                 var lengT = Object.keys(data).length
                                 var i = 0;
                                 var ig = 0;
                                 var io = 0;
                                 var iso = 0;
                                 $.each(data, function (key, value) {
                                     // Create a table row
                                     let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                                         '<td scope="row"  class="code">' + key + '</td>' +
                                         '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                                         '<td class="editable" id="AE_Over">' + 0 + '</td>' +
                                         '<td class="editable" id="CP_Over">' + 0 + '</td>' +
                                         '<td class="editable" id="AE_att">' + 0 + '</td>' +
                                         '<td class="editable" id="CP_att">' + 0 + '</td>' +
                                         '<td  class="someae" id="AE_TT">' + 0 + '</td>' +
                                         '<td  class="somecp" id="CP_TT">' + 0 + '</td>' +
                                         '</tr>';
                                     var codegr = data_T_port.group;
                                     var codeop = data_T_port.operation;
                                     var codesop = data_T_port.sousOperation;

                                     if(Object.keys(data_T_port).length > 0){
                                     if (codegr.length > 0 && data_T_port.group.length > ig) {
                                        var land=data_T_port.group[ig].code.length-5
                                         if (key == splitcode(data_T_port.group[ig].code, land)[1].substring) {
                                             row = '<tr class="ref' + key + '" id="ref'+data_T_port.group[ig].code+'">' +
                                                 '<td scope="row"  class="code">' + key + '</td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                                                 '<td class="editable" id="AE_Over">' + data_T_port.group[ig].values.ae_ouvertgrpop + '</td>' +
                                                 '<td class="editable" id="CP_Over">' + data_T_port.group[ig].values.cp_ouvertgrpop + '</td>' +
                                                 '<td class="editable" id="AE_att">' + data_T_port.group[ig].values.ae_attendugrpop + '</td>' +
                                                 '<td class="editable" id="CP_att">' + data_T_port.group[ig].values.cp_attendugrpop + '</td>' +
                                                 '<td  class="someae" id="AE_TT">' + data_T_port.group[ig].values.totalAEgrpop + '</td>' +
                                                 '<td  class="somecp" id="CP_TT">' + data_T_port.group[ig].values.totalCPgrpop + '</td>' +
                                                 '</tr>';
                                             ig++
                                         }
                                     }
                                     if (codeop.length > 0 && data_T_port.operation.length > io) {
                                        var land=data_T_port.operation[io].code.length-5
                                         if (key == splitcode(data_T_port.operation[io].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                                                 '<td scope="row"  class="code">' + key + '</td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                                                 '<td class="editable" id="AE_Over">' + data_T_port.operation[io].values.ae_ouvertop + '</td>' +
                                                 '<td class="editable" id="CP_Over">' + data_T_port.operation[io].values.cp_ouvertop + '</td>' +
                                                 '<td class="editable" id="AE_att">' + data_T_port.operation[io].values.ae_attenduop + '</td>' +
                                                 '<td class="editable" id="CP_att">' + data_T_port.operation[io].values.cp_attenduop + '</td>' +
                                                 '<td  class="someae" id="AE_TT">' + data_T_port.operation[io].values.totalAEop + '</td>' +
                                                 '<td  class="somecp" id="CP_TT">' + data_T_port.operation[io].values.totalCPop + '</td>' +
                                                 '</tr>';
                                             io++
                                         }
                                     }
                                     if (codesop.length > 0 && data_T_port.sousOperation.length > iso) {
                                        var land=data_T_port.sousOperation[iso].code.length-5
                                         if (key == splitcode(data_T_port.sousOperation[iso].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                                                 '<td scope="row"  class="code">' + key + '</td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                                                 '<td class="editable" id="AE_Over">' + data_T_port.sousOperation[iso].values.ae_ouvertsousop + '</td>' +
                                                 '<td class="editable" id="CP_Over">' + data_T_port.sousOperation[iso].values.cp_ouvertsousop + '</td>' +
                                                 '<td class="editable" id="AE_att">' + data_T_port.sousOperation[iso].values.ae_attendusousop + '</td>' +
                                                 '<td class="editable" id="CP_att">' + data_T_port.sousOperation[iso].values.cp_attendsousuop + '</td>' +
                                                 '<td  class="someae" id="AE_TT">' + data_T_port.sousOperation[iso].values.totalAEsousop + '</td>' +
                                                 '<td  class="somecp" id="CP_TT">' + data_T_port.sousOperation[iso].values.totalCPsousop + '</td>' +
                                                 '</tr>';
                                             iso++
                                         }
                                     }
                         }
                                     // Append the row to the table body
                                     $('#T-tables tbody').append(row);
                                     Edit(id, T)
                                     if (current.length == 0) {
                                         current = key;
                                         preve = current;
                                     }
                                     else {
                                         current = key;
                                         console.log('cuureent' + current.split("0")[0] + ' prev' + preve.split("0")[0])
                                         if (key.split("0")[0].length > preve.split("0")[0].length) {
                                             console.log('testing not adding' + preve)
                                             $('.ref' + preve + ' td').each(function () {
                                                 $(this).removeClass('editable')
                                             })

                                         }
                                         else {

                                             console.log('testing adding ' + preve)
                                             if ($('.ref' + preve + ' td').hasClass("editable")) {
                                             }

                                         }
                                         preve = current;
                                         current = key;
                                     }
                                     i++
                                     if (i == lengT) {
                                         if ($('.ref' + key + ' td').hasClass("editable")) {


                                         }
                                     }
                                 });
                                 if(code === 200)
                                    {
                                        dataupdate=[]
                                        Update_dpia(T,id_s_act);
                                    console.log('testing new update function')
                                    }
                             }).fail(function () {
                                 console.error('Error loading JSON file.');
                             });
                         }
                         function T3_table(id, T, id_s_act, port,code) {
                             var current = new Array();
                             var preve = new Array();
                             var data_T_port = new Array();
                             var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
                             console.log('data is')
                             $('#Tport-handle').addClass('scale-out');
                             setTimeout(() => {
                                 // Add the class to hide the table
                                 $('#Tport-handle').addClass('scale-hidden');
                                 // Optionally remove the scaling out class after hiding
                                 $('#Tport-handle').removeClass('scale-out');
                                 $('.T-handle').css('display', 'flex')
                             }, 500)
                         if(code == 200){
                             $.ajax({
                                 url: '/testing/S_action/' + port + '/' + id_s_act + '/T3',
                                 type: 'GET',
                                 success: function (response) {
                                     if (response.code === 200) {
                                         console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                                         data_T_port = response.results;
                                     }
                                     else {
                                         alert(response.message);
                                     }
                                 }
                             })}
                                var lasty=parseInt(yearport) - 1
                             var headT = '<tr>' +
                                 '<th><h1>code</h1></th>' +
                                 '<th><h1>T Description</h1></th>' +
                                 '<th><h1>Intitule de L`Operation</h1></th>' +
                                 '<th colspan="6">' +
                                 '<div class="fusion-father">' +
                                 '<h1>MONTANT ANNEE (N)</h1>' +
                                 '<div class="fusion-child">' +
                                 '<h1>AE Reportee <p>31-12-'+lasty+'</p></h1>' +
                                 '<h1>AE Notifiee <p>'+yearport+'<p></h1>' +
                                 '<h1>AE Engagée  <p>31-12-'+lasty+'</p></h1>' +
                                 '<h1>CP Reportee <p>31-12-'+lasty+'</p></h1>' +
                                 '<h1>CP Notifiée <p>'+yearport+'<p></h1>' +
                                 '<h1>CP Engagée  <p>31-12-'+lasty+'</p></h1>' +
                                 '</div>' +
                                 '</th>' +
                                 '</tr>';
                             $('#T-tables thead').append(headT)
                             $.getJSON(jsonpath3, function (data) {
                                 // Loop through each item in the JSON data
                                 var lengT = Object.keys(data).length
                                 var i = 0;
                                 var ig = 0;
                                 var io = 0;
                                 var iso = 0;
                                 $.each(data, function (key, value) {
                                     // Create a table row
                                     var val = value.split('-')

                                     //   console.log('values' + JSON.stringify(val))
                                     let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                                         '<td scope="row"  class="code">' + key + '</td>' +
                                         '<td><p>' + val[0] + '</p> </td>' +
                                         '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                                         '<td class="editable" id="AE_rpor">' + 0 + '</td>' +
                                         '<td class="editable" id="AE_not">' + 0 + '</td>' +
                                         '<td class="editable" id="AE_enga">' + 0 + '</td>' +
                                         '<td class="editable" id="CP_rpor">' + 0 + '</td>' +
                                         '<td class="editable" id="CP_not">' + 0 + '</td>' +
                                         '<td class="editable" id="CP_consom">' + 0 + '</td>' +
                                         '</tr>';

                                     if(Object.keys(data_T_port).length > 0){

                                     if (data_T_port.group.length > 0 && data_T_port.group.length > ig) {
                                        var land=data_T_port.group[ig].code.length-5;
                                        console.log('T3'+JSON.stringify(data_T_port.group) +' length'+land)
                                         if (key == splitcode(data_T_port.group[ig].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                                                 '<td scope="row"  class="code">' + key + '</td>' +
                                                 '<td><p>' + val[0] + '</p> </td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                                                 '<td class="editable" id="AE_rpor">' + data_T_port.group[ig].values.ae_reportegrpop + '</td>' +
                                                 '<td class="editable" id="AE_not">' + data_T_port.group[ig].values.ae_notifiegrpop + ',000</td>' +
                                                 '<td class="editable" id="AE_enga">' + data_T_port.group[ig].values.ae_engagegrpop + '</td>' +
                                                 '<td class="editable" id="CP_rpor">' + data_T_port.group[ig].values.cp_reportegrpop + ',000</td>' +
                                                 '<td class="editable" id="CP_not">' + data_T_port.group[ig].values.cp_notifiegrpop + '</td>' +
                                                 '<td class="editable" id="CP_consom">' + data_T_port.group[ig].values.cp_consomegrpop + ',000</td>' +
                                                 '</tr>';
                                             ig++;
                                         }
                                     }
                                     if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
                                        var land=data_T_port.operation[io].code.length-5;

                                         if (key == splitcode(data_T_port.operation[io].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                                                 '<td scope="row"  class="code">' + key + '</td>' +
                                                 '<td><p>' + val[0] + '</p> </td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                                                 '<td class="editable" id="AE_rpor">' + data_T_port.operation[io].values.ae_reporteop + '</td>' +
                                                 '<td class="editable" id="AE_not">' + data_T_port.operation[io].values.ae_notifieop + ',000</td>' +
                                                 '<td class="editable" id="AE_enga">' + data_T_port.operation[io].values.ae_engageop + '</td>' +
                                                 '<td class="editable" id="CP_rpor">' + data_T_port.operation[io].values.cp_reporteop + ',000</td>' +
                                                 '<td class="editable" id="CP_not">' + data_T_port.operation[io].values.cp_notifieop + '</td>' +
                                                 '<td class="editable" id="CP_consom">' + data_T_port.operation[io].values.cp_consomeop + ',000</td>' +
                                                 '</tr>';
                                             io++;
                                         }
                                     }
                                     if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso) {
                                        var land=data_T_port.sousOperation[iso].code.length-5;
                                         if (key == splitcode(data_T_port.sousOperation[iso].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                                                 '<td scope="row"  class="code">' + key + '</td>' +
                                                 '<td><p>' + val[0] + '</p> </td>' +
                                                 '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                                                 '<td class="editable" id="AE_rpor">' + data_T_port.sousOperation[iso].values.ae_reportesousop + '</td>' +
                                                 '<td class="editable" id="AE_not">' + data_T_port.sousOperation[iso].values.ae_notifiesousop + ',000</td>' +
                                                 '<td class="editable" id="AE_enga">' + data_T_port.sousOperation[iso].values.ae_engagesousop + '</td>' +
                                                 '<td class="editable" id="CP_rpor">' + data_T_port.sousOperation[iso].values.cp_reportesousuop + ',000</td>' +
                                                 '<td class="editable" id="CP_not">' + data_T_port.sousOperation[iso].values.cp_notifiesousop + '</td>' +
                                                 '<td class="editable" id="CP_consom">' + data_T_port.sousOperation[iso].values.cp_consomesousop + ',000</td>' +
                                                 '</tr>';
                                             iso++;
                                         }
                                     }
                                     }
                                     // Append the row to the table body

                                     $('#T-tables tbody').append(row);
                                     Edit(id, T)
                                     if (current.length == 0) {
                                         current = key;
                                         preve = current;
                                     }
                                     else {
                                         current = key;
                                         if (key.split("0")[0].length <= 2) {
                                             $('#ref' + key + ' td').each(function () {
                                                 $(this).removeClass('editable')
                                             })
                                         }
                                         if (current.split("0")[0].length > preve.split("0")[0].length) {
                                             console.log('testing ' + preve)
                                             $('.ref' + preve + ' td').each(function () {
                                                 $(this).removeClass('editable')
                                             })
                                             preve = current;

                                         }
                                         else {
                                             //console.log('testing editable'+preve)
                                             if ($('.ref' + preve + ' td').hasClass("editable")) {
                                                 $('.ref' + preve + ' #add_op').append(newbtn)
                                                 $('.ref' + preve + ' #add_op').on('click', function () {
                                                    var newKey=$(this).parent().attr('id');
                                                    var ads = newKey.split('ref')[1] + '1';
                                                    $('.Tsop_handler').removeClass('Tsop_handler_h')
                                                     add_newOPs_T3(ads, 'testing new descr', 2500, newKey);

                                                 })
                                             }

                                             preve = current;
                                         }
                                         current = key;
                                     }
                                     i++
                                     if (i == lengT) {
                                         if ($('.ref' + key + ' td').hasClass("editable")) {
                                             $('.ref' + key + ' #add_op').append(newbtn)
                                             $('.ref' + key + ' #add_op').on('click', function () {
                                                var newKey=$(this).parent().attr('id');
                                                var ads = newKey.split('ref')[1] + '1';
                                                $('.Tsop_handler').removeClass('Tsop_handler_h')
                                                 add_newOPs_T3(ads, 'testing new descr', 2500, preve);
                                             })
                                         }
                                     }
                                     Edit(id, T)
                                 });
                                 if(code === 200)
                                 {
                                    dataupdate=[]
                                    Update_dpia(T,id_s_act);
                                    console.log('testing new update function')
                                 }
                             }).fail(function () {
                                 console.error('Error loading JSON file.');
                             });
                         }
                         function T4_table(id, T, id_s_act, port,code) {
                             var current = new Array();
                             var preve = new Array();
                             var data_T_port = new Array();
                             var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
                             console.log('data is')
                             $('#Tport-handle').addClass('scale-out');
                             setTimeout(() => {
                                 // Add the class to hide the table
                                 $('#Tport-handle').addClass('scale-hidden');
                                 // Optionally remove the scaling out class after hiding
                                 $('#Tport-handle').removeClass('scale-out');
                                 $('.T-handle').css('display', 'flex')
                             }, 500)
                             if(code === 200){
                             $.ajax({
                                 url: '/testing/S_action/' + port + '/' + id_s_act + '/T4',
                                 type: 'GET',
                                 success: function (response) {
                                     if (response.code === 200) {
                                         console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                                         data_T_port = response.results;
                                     }
                                     else {
                                         alert(response.message);
                                     }
                                 }
                             })}

                             var headT = '<tr>' +
                                 '<th><h1>Code</h1></th>' +
                                 '<th><h1>DEPENSES DE TRANSFERT</h1></th>' +
                                 '<th><h1>Detail</h1></th>'+
                                 '<th colspan="2">' +
                                 '<div class="fusion-father">' +
                                 '<h1>MONTANT ANNEE (N)</h1>' +
                                 '<div class="fusion-child">' +
                                 '<h1>AE</h1>' +
                                 '<h1>CP</h1>' +
                                 '</div>' +
                                 '</div>    ' +
                                 '</th>' +
                                 '</tr>';
                             $('#T-tables thead').append(headT)
                             var i = 0;
                             var ig = 0;
                             var io = 0;
                             var iso = 0;
                             $.getJSON(jsonpath4, function (data) {
                                 // Loop through each item in the JSON data
                                 $.each(data, function (key, value) {
                                     // Create a table row
                                     var val = value.split('-')
                                     //   console.log('values' + JSON.stringify(val))
                                     let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                                         '<td scope="row"  class="code">' + key + '</td>' +
                                         '<td><p>' + value + '</p></td>' +
                                         '<td  id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                                         '<td class="editable" id="AE_T4">' + 0 + ',00</td>' +
                                         '<td class="editable" id="CP_T4">' + 0 + ',00</td>' +
                                         '</tr>';
                                     if(Object.keys(data_T_port).length > 0){
                                     if (data_T_port.group.length > 0 && data_T_port.group.length > ig) {
                                        var land=data_T_port.group[ig].code.length-5;
                                         if (key == splitcode(data_T_port.group[ig].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                                                 '<td scope="row" class="code" >' + key + '</td>' +
                                                 '<td><p>' + value + '</p></td>' +
                                             
                                                 '<td  id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                                                 '<td class="editable" id="AE_T4">' + data_T_port.group[ig].values.ae_grpop + '</td>' +
                                                 '<td class="editable" id="CP_T4">' + data_T_port.group[ig].values.cp_grpop + '</td>' +
                                                 '</tr>';
                                             ig++;
                                         }
                                     }
                                     if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
                                        var land=data_T_port.operation[io].code.length-5;
                                         if (key == splitcode(data_T_port.operation[io].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                                                 '<td scope="row" class="code" >' + key + '</td>' +
                                                 '<td ><p>' + value + '</p></td>' +
                                                
                                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                                                 '<td class="editable" id="AE_T4">' + data_T_port.operation[io].values.ae_op + '</td>' +
                                                 '<td class="editable" id="CP_T4">' + data_T_port.operation[io].values.cp_op + '</td>' +
                                                 '</tr>';
                                             io++;
                                         }
                                     }
                                     if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso) {
                                        var land=data_T_port.sousOperation[iso].code.length-5;
                                         if (key == splitcode(data_T_port.sousOperation[iso].code, land)[1].substring) {
                                             row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                                                 '<td scope="row" class="code" >' + key + '</td>' +
                                                 '<td ><p>' + value + '</p></td>' +
                                              
                                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                                                 '<td class="editable" id="AE_T4">' + data_T_port.sousOperation[iso].values.ae_sousop + '</td>' +
                                                 '<td class="editable" id="CP_T4">' + data_T_port.sousOperation[iso].values.cp_sousuop + '</td>' +
                                                 '</tr>';
                                             iso++;
                                         }
                                     }}
                                     // Append the row to the table body

                                     $('#T-tables tbody').append(row);

                                     if (current.length == 0) {
                                         current = key;
                                         preve = current;
                                     }
                                     else {

                                         if (key.split("0")[0].length <= 2) {
                                             $('.ref' + key + ' td').each(function () {
                                                 $(this).removeClass('editable')
                                             })
                                         }
                                         if (current.split("0")[0].length > preve.split("0")[0].length) {
                                             console.log('testing ' + preve)
                                             $('.ref' + preve + ' td').each(function () {
                                                 $(this).removeClass('editable')
                                             })
                                             preve = current;

                                         }
                                         else {
                                             //console.log('testing editable'+preve)
                                             if ($('.ref' + preve + ' td').hasClass("editable")) {
                                                 $('.ref' + preve + ' #add_op').append(newbtn)
                                                 $('.ref' + preve + ' #add_op').on('click', function () {
                                                    var newKey=$(this).parent().attr('id');
                                                    var ads = newKey.split('ref')[1] + '1';
                                                    $('.Tsop_handler').removeClass('Tsop_handler_h')
                                                     add_newOPs_T4(ads, 2500, newKey);
                                                 })
                                             }

                                             preve = current;
                                         }
                                         current = key;
                                     }

                                     Edit(id, T)
                                 });
                                 if(code === 200)
                                    {
                                       dataupdate=[]
                                       Update_dpia(T,id_s_act);
                                       console.log('testing new update function')
                                    }
                             }).fail(function () {
                                 console.error('Error loading JSON file.');
                             });
                         }
                         $(document).ready(function () {

                             $('#T1').on('click', function () {

                                 var indic = path3.length - 1
                                 var id = $(this).attr('id');
                                 var T = 1;
                                 console.log('len' + path3.length + ' act ' + indic)
                                 $.ajax({
                                     url: '/testing/codeSousOperation/' + path3[indic],
                                     type: 'GET',
                                     success: function (response) {
                                         if (response.code == 200 && response.t1_exists==1) {
                                             alert('Exist')
                                             T1_table(id, T, path3[indic], path3[0],response.code)
                                             $('#T_port1').addClass('heilighter')
                                         }
                                         else {
                                             alert('New')
                                             code =404
                                             T1_table(id, T, path3[indic], path3[0],code)
                                         }
                                     }
                                 })
                             })
                             $('#T2').on('click', function () {

                                 var indic = path3.length - 1
                                 var T=2
                                 var id = $(this).attr('id');
                                 console.log('len' + path3.length + ' act ' + indic)
                                 $.ajax({
                                     url: '/testing/codeSousOperation/' + path3[indic],
                                     type: 'GET',
                                     success: function (response) {
                                         if (response.code == 200 && response.t2_exists==1) {
                                             alert('Exist')


                                             T2_table(id, T, path3[indic], path3[0],response.code)
                                             $('#T_port2').addClass('heilighter')
                                         }
                                         else {
                                             alert('New')

                                            code=404
                                             T2_table(id, T, path3[indic], path3[0],code)
                                         }
                                     }
                                 })
                                 //  T2_table(id, T)
                             })

                             $('#T3').on('click', function () {

                                 var indic = path3.length - 1
                                 console.log('len' + path3.length + ' act ' + indic)
                                 var id = $(this).attr('id');
                                 var T = 3;
                                 $.ajax({
                                     url: '/testing/codeSousOperation/' + path3[indic],
                                     type: 'GET',
                                     success: function (response) {
                                         if (response.code == 200 && response.t3_exists==1) {
                                             alert('Exist')

                                             T3_table(id, T, path3[indic], path3[0],response.code)
                                             $('#T_port3').addClass('heilighter')
                                         }
                                         else {
                                             alert('New')
                                             code =404
                                             T3_table(id, T, path3[indic], path3[0],code)
                                         }
                                     }
                                 })
                                 //T3_table(id, T)
                             })
                             $('#T4').on('click', function () {

                                 var indic = path3.length - 1
                                 console.log('len' + path3.length + ' act ' + indic)
                                 var id = $(this).attr('id');
                                 var T = 4;
                                 $.ajax({
                                     url: '/testing/codeSousOperation/' + path3[indic],
                                     type: 'GET',
                                     success: function (response) {
                                         if (response.code == 200 && response.t4_exists==1) {
                                             alert('Exist')

                                             T4_table(id, T, path3[indic], path3[0],response.code)
                                             $('#T_port4').addClass('heilighter')
                                         }
                                         else {
                                             alert('New')
                                             code =404
                                             T4_table(id, T, path3[indic], path3[0],code)
                                         }
                                     }
                                 })
                             })
                             $(".TP-handle").on('click', function () {
                                 $('#T-tables thead').empty()
                                 $('#T-tables tbody').empty()
                                 var indic = path3.length - 1
                                 var id_tport_c = $(this).attr('id');
                                    $(this).addClass('heilighter')
                                 if (id_tport_c == 'T_port1') {
                                    $('#T_port2').removeClass('heilighter')
                                    $('#T_port3').removeClass('heilighter')
                                    $('#T_port4').removeClass('heilighter')
                                     //var indic = path3.length - 1
                                     var id = $(this).attr('id');
                                     var T = 1;
                                     console.log('len' + path3.length + ' act ' + indic)
                                     $.ajax({
                                         url: '/testing/codeSousOperation/' + path3[indic],
                                         type: 'GET',
                                         success: function (response) {
                                             if (response.code == 200 && response.t1_exists==1) {
                                                 alert('Exist')

                                                 T1_table(id, T, path3[indic], path3[0],response.code)
                                             }
                                             else {
                                                 alert('New')
                                                 code =404
                                                 T1_table(id, T, path3[indic], path3[0],code)
                                             }
                                         }
                                     })
                                 }
                                 if (id_tport_c == 'T_port2') {
                                    $('#T_port1').removeClass('heilighter')
                                    $('#T_port3').removeClass('heilighter')
                                    $('#T_port4').removeClass('heilighter')
                                    var id = $(this).attr('id');
                                    var T = 2;
                                     $.ajax({
                                         url: '/testing/codeSousOperation/' + path3[indic],
                                         type: 'GET',
                                         success: function (response) {
                                             if (response.code == 200 && response.t2_exists==1) {
                                                 alert('Exist')

                                                 T2_table(id, T, path3[indic], path3[0],response.code)
                                             }
                                             else {
                                                 alert('New')
                                                        code=404
                                                 T2_table(id, T, path3[indic], path3[0],code)
                                             }
                                         }
                                     })
                                 }
                                 if (id_tport_c == 'T_port3') {
                                    $('#T_port2').removeClass('heilighter')
                                    $('#T_port1').removeClass('heilighter')
                                    $('#T_port4').removeClass('heilighter')
                                    var id = $(this).attr('id');
                                    var T = 3;
                                     $.ajax({
                                         url: '/testing/codeSousOperation/' + path3[indic],
                                         type: 'GET',
                                         success: function (response) {
                                             if (response.code == 200 && response.t3_exists==1) {
                                                 alert('Exist')

                                                 T3_table(id, T, path3[indic], path3[0],response.code)
                                             }
                                             else {
                                                 alert('New')
                                                 code =404
                                                 T3_table(id, T, path3[indic], path3[0],code)
                                             }
                                         }
                                     })


                                 }
                                 if (id_tport_c == 'T_port4') {
                                    $('#T_port2').removeClass('heilighter')
                                    $('#T_port3').removeClass('heilighter')
                                    $('#T_port1').removeClass('heilighter')
                                    var id = $(this).attr('id');
                                    var T = 4;
                                     $.ajax({
                                         url: '/testing/codeSousOperation/' + path3[indic],
                                         type: 'GET',
                                         success: function (response) {
                                             if (response.code == 200 && response.t4_exists==1) {
                                                 alert('Exist')

                                                 T4_table(id, T, path3[indic], path3[0],response.code)
                                             }
                                             else {
                                                 alert('New')
                                                 code =404
                                                 T4_table(id, T, path3[indic], path3[0],code)
                                             }
                                         }
                                     })


                                 }
                                 console.log('testign which port im ' + id_tport_c)
                             })


                         })

                         /**
                          *
                          *  this js for creation from the index
                          */




                         /**
                          *
                          *
                          *
                          */
                         /**
                          *
                          *  end
                          */
                         const progress = document.getElementById("progress");
                         const stepCircles = document.querySelectorAll(".circle");
                         let currentActive = 1;

                         //NOTE CHANGE HERE TO 1-4
                         //1=25%
                         //2=50%
                         //3=75%
                         //4=100%
                         update(3);

                         function update(currentActive) {
                             stepCircles.forEach((circle, i) => {
                                 if (i < currentActive) {
                                     circle.classList.add("active");
                                 } else {
                                     circle.classList.remove("active");
                                 }
                             });

                             const activeCircles = document.querySelectorAll(".active");
                             progress.style.width =
                                 ((activeCircles.length - 1) / (stepCircles.length - 1)) * 100 + "%";


                         }
