
var click = 0;
var iupdate=1;
var changing_mist = new Object();
var value_chng = new Array()
var  dataupdate=new Array();

/**
 *
 * this function for adding button et makalah -_- ;
 */

function only_def(id)
{
   var localverb;
   $.ajax({
       url:'/opsinfo/'+id,
       type:'GET',
       success:function(response)
       {
           if(response.code == 200)
           {
               defss=response.result.nom_sous_operation 
               console.log('def '+defss)
               newdfs=defss.split('_')
               $('#ref'+id+" #def").text(newdfs[0])
               $('#ref'+id+" #sous_def").text(newdfs[1])
               
           }
       }
   })
   return localverb
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
    var testing =str.split("-");
    var last=testing.length-1
  
    return testing[last];
}


function add_newOPs_T1(id, descr, value, key,) {
    var row = '<tr id="ref' + id + '">' +
        '<td class="code" >' + id + '</td>' +
        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + descr + '</p></td>' +
        '<td class="editable" id="AE_T1">' + value + '</td>' +
        '<td class="editable" id="CP_T1">' + 180 + '</td>' +
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
               '<td class="editable" id="CP_Over">' + 180 + '</td>' +
               '<td class="editable" id="AE_att">' + value + '</td>' +
               '<td class="editable" id="CP_att">' + 180 + '</td>' +
               '<td  id="AE_TT" diseabled>' + some + '</td>' +
               '<td  id="CP_TT" diseabled>' + 360 + '</td>' +
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
function add_newOPs_T3(id, value, key,) {
   id=id+'-'+counter;
   $("#dispo").text('');
   $('.desp').text('Intituler');
   var champ='<div class="Tsop_add_handle">'+
   '<form id="add_sops">'+
   '<div class="form-group">'+
   '<label class="desp">descrption</label>'+
    '<input type="text" class="form-control" id="dispo" placeholder="Entrer La description">'+
    '<label class="desp">Intituler</label>'+
    '<input type="text" class="form-control" id="int-T3" placeholder="Entrer La description">'+
    '</div>'+
    '<div class="T3-ops_inpt_handle">' +
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
             '</div>'+
   '</div>'+
'</form>'+
'<div class="Tsop_btn_handle">'+
'<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
'<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
'</div>'+
'</div>'
  
   $('.Tsop_handler').append(champ);
   $('#ajt').on('click',function(){
    var buttons = '<button class="btn btn-primary" id="changin-up"> appliquer</button>'
    $('.change_app').append(buttons)
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
       dataupdate.push({code:id,value:{ae_notifie:sopdata_add.AE_not,ae_reporte:sopdata_add.AE_rpor,ae_engage:sopdata_add.AE_enga,
        cp_notifie:sopdata_add.CP_not,cp_reporte:sopdata_add.CP_rpor,cp_consome:sopdata_add.CP_consom}})
       console.log('data T3'+JSON.stringify(sopdata_add))
       /*$.ajax({
           url:'',
           type:'POST',
           data:sopdata_add,
           success:function(response)
           {
               if(response.code == 200)
               {
                   
               }
           }
       })*/
            
            var idsfinal=id.split("-")
            var lng=idsfinal.length
           var row = '<tr id="ref' + id + '">' +
                   '<td class="code">' +idsfinal[lng-2]+'-'+idsfinal[lng-2]-1 + '</td>' +
                   '<td>' + value + '</td>' +
                   '<td>' + sopdata_add.descrp + '</td>' +
                   '<td>' + sopdata_add.intituel + '</td>' +
                   '<td class="editable" id="AE_rpor">' + sopdata_add.AE_rpor + '</td>' +
                   '<td class="editable" id="AE_not">' + sopdata_add.AE_not + '</td>' +
                   '<td class="editable" id="AE_enga">' + sopdata_add.AE_enga + '</td>' +
                   '<td class="editable" id="CP_rpor">' + sopdata_add.CP_rpor + '</td>' +
                   '<td class="editable" id="CP_not">' + sopdata_add.CP_not + '</td>' +
                   '<td class="editable" id="CP_consom">' + sopdata_add.CP_consom + '</td>' +
                   '</tr>';
               $('#' + key).after(row);
             /*  $('#' + key + ' td').each(function () {
                   $(this).removeClass('editable');
               })*/
                   $('#Tport-vals').removeClass('T4')
                   $("#dispo").val('');
                  $('.Tsop_handler').empty();
                  $('#add_sops').trigger('reset');
                  $('.Tsop_handler').addClass('Tsop_handler_h')
                  mount_chang = true

                  if (mount_chang == true) {
                      
                      click++;
                      if (click == 1) {
                         
                          click++
                      }
                   
                    }
   })
   $('#cancel_ops').click(function(){
       $('.change_app').empty()
       $('.Tsop_handler').addClass('Tsop_handler_h')
       $('#Tport-vals').empty()
       $('.Tsop_handler').empty();
       alert('cancel op')
   })
}

function add_newOPs_T4(id, value, key,) {
 
    $('.change_app').append(buttons)
   $("#dispo").val('');
   $('.desp').text('Dispositive');
   $('#Tport-vals').addClass('T4')

   var champ='<div class="Tsop_add_handle">'+
               '<form id="add_sops">'+
               '<div class="form-group">'+
               '<label class="desp">Dispositive ou bien la description</label>'+
            '<input type="text" class="form-control" id="dispo" placeholder="Entrer La description">'+
           '</div>'+

           '<div class="form-group" id="Tport-vals">'+
           '<label>definition</label><input type="text" class="form-control" id="def_T4">'+
             '<div><label>AE</label>'+
            '<input type="number" class="form-control" id="add_AE_T4">'+
            '</div>'+
            '<div>'+
            '<label>CP Reporter</label>'+
           '<input type="number" class="form-control" id="add_CP_T4">'+
           '</div>'+
           '</div>'+

           '</form>'+
       '<div class="Tsop_btn_handle">'+
        '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
        '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
       '</div>'+
   '</div>'
   ;
   $('.Tsop_handler').append(champ);
 
   $('#ajt').click(function(){
    mount_chang=true;
    $('.change_app').empty()
    id=id+'-'+counter;
    var buttons = '<button class="btn btn-primary" id="changin-up"> appliquer</button>'
       var data_add_ops={
           code:id,
           descrp:$('#dispo').val(),
           defi:$('#def_T4').val(),
           AE_T4:$('#add_AE_T4').val(),
           CP_T4:$('#add_CP_T4').val(),
           _token: $('meta[name="csrf-token"]').attr("content"),
           _method: "POST",
       }
       newid=id.split('-');
       var row = '<tr id="ref' + id + '">' +
       '<td class="code" >' +newid[newid.length-2]+'-'+ newid[newid.length-1] + '</td>' +
       '<td>'+data_add_ops.defi+'</td>'+
       '<td ><p>' + data_add_ops.descrp + '</p></td>' +
       '<td id="AE_T4">' + data_add_ops.AE_T4 + '</td>' +
       '<td  id="CP_T4">' + data_add_ops.CP_T4 + '</td>' +
       '</tr>';
       counter++
   $('#' + key).after(row);
  /* $('#' + key + ' td').each(function () {
       $(this).removeClass('editable');
   })*/
       console.log('data T4'+JSON.stringify(data_add_ops))
        $('#Tport-vals').removeClass('T4')
        $("#dispo").val('');
       $('.Tsop_handler').empty();
       $('#add_sops').trigger('reset');
       $('.Tsop_handler').addClass('Tsop_handler_h')
       
      
       
   })
   $('#cancel_ops').click(function(){
       $('.Tsop_handler').empty();
       $('.Tsop_handler').addClass('Tsop_handler_h')
    
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
function Update_dpia(T,iupdate)
{
   var old;
   $(document).ready(function(){
       $('.editable').on('click', function () {
           let cell = $(this);  // Reference to the clicked cell
           old = cell.text();
       })
       $('.editable').dblclick(function(){

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
            let input = $('<input type="number" step="0.01" class="form-control" min="0"/>').val(currentText);
            cell.html(input);  // Replace the cell content with the input

            input.focus();
            input.blur(function()
           {
               let newText = $(this).val();
               console.log('zero'+newText)
               if (T == '2') {
                   var sommevertAEatt=$('#foot_AE_att').text();
                   var sommevertCPatt=$('#foot_CP_att').text();
                   var sommevertAEovr=$('#foot_AE_Over').text();
                   var sommevertCPovr=$('#foot_CP_Over').text();
                   var sommevertAETT=$('#foot_AE_TT').text();
                   var sommevertCPTT=$('#foot_CP_TT').text();
                   console.log('footer info'+sommevertAEatt+'--'+sommevertCPatt+'--'+sommevertAEovr+'--'+sommevertCPovr)
                   var testcpattendu = clickedRow.find('td').eq(5).text();//cpattendu
                   var testaeattendu = clickedRow.find('td').eq(4).text();//aeattendu
                   var testcpover = clickedRow.find('td').eq(3).text();//cpovert
                   var testaeover = clickedRow.find('td').eq(2).text();//aeovert
                   var someae = 0;
                   var somecp = 0;
                   var wit = $(this).parent().attr('id');
                   if (newText != 0 && newText != '' && newText != null ) {
                     someae = clickedRow.find('td').eq(6).text();
                     somecp = clickedRow.find('td').eq(7).text();
                       console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                       if (wit == 'CP_att') {
                           testcpattendu = newText
                           sommevertCPatt=parseFloat(sommevertCPatt)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                           sommevertCPatt=parseFloat(sommevertCPatt)+parseFloat(newText)
                           sommevertCPTT=parseFloat(sommevertCPTT)+parseFloat(newText)
                           somecp-=parseFloat(old)
                           console.log('new AE_Over'+sommevertCPatt)
                       }
                       if (wit == 'AE_att') {
                           testaeattendu = newText
                          
                              
                               sommevertAEatt=parseFloat(sommevertAEatt)-parseFloat(old)
                               sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                               sommevertAEatt=parseFloat(sommevertAEatt)+parseFloat(newText)
                               sommevertAETT=parseFloat(sommevertAETT)+parseFloat(newText)
                               someae-=parseFloat(old)
                          
                           console.log('new AE_Over'+sommevertAEatt)
                       }
                       if (wit == 'AE_Over') {
                           testaeover = newText
                           sommevertAEovr=parseFloat(sommevertAEovr)-parseFloat(old)
                           sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                           sommevertAEovr=parseFloat(sommevertAEovr)+parseFloat(newText)
                           sommevertAETT=parseFloat(sommevertAETT)+parseFloat(newText)
                           someae-=parseFloat(old)
                           console.log('new AE_Over'+sommevertAEovr)
                       }
                       if (wit == 'CP_Over') {
                           testcpover = newText
                           sommevertCPovr=parseFloat(sommevertCPovr)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                           somecp-=parseFloat(old)
                           sommevertCPovr=parseFloat(sommevertCPovr)+parseFloat(newText)
                           sommevertCPTT=parseFloat(sommevertCPTT)+parseFloat(newText)
                           console.log('new CP_Over'+sommevertCPovr)
                       }
                       somecp = parseFloat(testcpattendu) + parseFloat(testcpover)
                       someae = parseFloat(testaeattendu) + parseFloat(testaeover);
                       console.log('ae' + someae + ' cp ' + somecp)
                    $('#foot_AE_att').text(sommevertAEatt);
                    $('#foot_CP_att').text(sommevertCPatt);
                    $('#foot_AE_Over').text(sommevertAEovr);
                    $('#foot_CP_Over').text(sommevertCPovr);
                    $('#foot_AE_TT').text(sommevertAETT);
                    $('#foot_CP_TT').text(sommevertCPTT);

                    console.log('footer info'+sommevertAEatt+'--'+sommevertCPatt+'--'+sommevertAEovr+'--'+sommevertCPovr)
                       clickedRow.find('td').eq(6).text(someae);
                       clickedRow.find('td').eq(7).text(somecp);
                   } else
                   {
                    someae = clickedRow.find('td').eq(6).text();
                    somecp = clickedRow.find('td').eq(7).text();
                       console.log('deminuis'+old+'of '+wit)
                       if (wit == 'CP_att') {
                           testcpattendu = newText
                           sommevertCPatt=parseFloat(sommevertCPatt)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                           somecp-=parseInt(old)
                          
                       }
                       if (wit == 'AE_att') {
                            testaeattendu = newText
                           someae-=parseInt(old)
                           sommevertAEatt=parseFloat(sommevertAEatt)-parseFloat(old)
                           sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                   
                       }
                       if (wit == 'AE_Over') {
                             testaeover = newText
                           someae-=parseInt(old)
                           sommevertAEovr=parseFloat(sommevertAEovr)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                          
                       }
                       if (wit == 'CP_Over') {
                           testcpover = newText
                           somecp-=parseInt(old)
                           sommevertCPovr=parseFloat(sommevertCPovr)-parseFloat(old)
                           sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                           
                    
                       }
                       
                   
                        $('#foot_AE_att').text(sommevertAEatt);
                        $('#foot_CP_att').text(sommevertCPatt);
                        $('#foot_AE_Over').text(sommevertAEovr);
                        $('#foot_CP_Over').text(sommevertCPovr);
                        $('#foot_AE_TT').text(sommevertAETT);
                        $('#foot_CP_TT').text(sommevertCPTT);
                       
                        somecp = parseFloat(testcpattendu) + parseFloat(testcpover)
                        someae = parseFloat(testaeattendu) + parseFloat(testaeover);
                       clickedRow.find('td').eq(6).text(someae);
                       clickedRow.find('td').eq(7).text(somecp);
                   }
               }
               else
               {
                if( T= '3')
                {
                    var sommevertAErepor=$('#foot_AE_rpor').text();
                    var sommevertAEnot=$('#foot_AE_not').text();
                    var sommevertAEenga=$('#foot_AE_enga').text();
                    var sommevertCPrpor=$('#foot_CP_rpor').text();
                    var sommevertCPnot=$('#foot_CP_not').text();
                    var sommevertCPconsum=$('#foot_CP_consom').text();
                  
                   
                    var wit = $(this).parent().attr('id');
                    if (newText != 0 && newText != '' && newText != null ) {
                       // console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                        if (wit == 'AE_rpor') {
                            
                            sommevertAErepor=parseFloat(sommevertAErepor)-parseFloat(old)
                            sommevertAErepor=parseFloat(sommevertAErepor)+parseFloat(newText)
    
                        }
                        if (wit == 'AE_not') {
                               
                            sommevertAEnot=parseFloat(sommevertAEnot)-parseFloat(old)
                            sommevertAEnot=parseFloat(sommevertAEnot)+parseFloat(newText)
                        }
                        if(wit == 'AE_enga')
                        { 
                            sommevertAEenga=parseFloat(sommevertAEenga)-parseFloat(old)
                            sommevertAEenga=parseFloat(sommevertAEenga)+parseFloat(newText)

                        }
                        if (wit == 'CP_rpor') {
                            sommevertCPrpor=parseFloat(sommevertCPrpor)-parseFloat(old)
                            sommevertCPrpor=parseFloat(sommevertCPrpor)+parseFloat(newText)
                        }
                        if (wit == 'CP_not') {
                            sommevertCPnot=parseFloat(sommevertCPnot)-parseFloat(old)
                            sommevertCPnot=parseFloat(sommevertCPnot)+parseFloat(newText)
                        }
                        if (wit == 'CP_consom') {
                            sommevertCPconsum=parseFloat(sommevertCPconsum)-parseFloat(old)
                            sommevertCPconsum=parseFloat(sommevertCPconsum)+parseFloat(newText)
                        }
    

                        $('#foot_AE_rpor').text(sommevertAErepor);
                        $('#foot_AE_not').text(sommevertAEnot);
                        $('#foot_AE_enga').text(sommevertAEenga);
                        $('#foot_CP_rpor').text(sommevertCPrpor);
                        $('#foot_CP_not').text(sommevertCPnot);
                        $('#foot_CP_consom').text(sommevertCPconsum);
 
               
                    } else
                    {
                  
                        if (wit == 'AE_rpor') {
                            
                            sommevertAErepor=parseFloat(sommevertAErepor)-parseFloat(old)
                          
    
                        }
                        if (wit == 'AE_not') {
                               
                            sommevertAEnot=parseFloat(sommevertAEnot)-parseFloat(old)
                            
                        }
                        if(wit == 'AE_enga')
                        { 
                            sommevertAEenga=parseFloat(sommevertAEenga)-parseFloat(old)
                           

                        }
                        if (wit == 'CP_rpor') {
                            sommevertCPrpor=parseFloat(sommevertCPrpor)-parseFloat(old)
                           
                        }
                        if (wit == 'CP_not') {
                            sommevertCPnot=parseFloat(sommevertCPnot)-parseFloat(old)
                          
                        }
                        if (wit == 'CP_consom') {
                            sommevertCPconsum=parseFloat(sommevertCPconsum)-parseFloat(old)
                           
                        }
                        
                    
                        $('#foot_AE_rpor').text(sommevertAErepor);
                        $('#foot_AE_not').text(sommevertAEnot);
                        $('#foot_AE_enga').text(sommevertAEenga);
                        $('#foot_CP_rpor').text(sommevertCPrpor);
                        $('#foot_CP_not').text(sommevertCPnot);
                        $('#foot_CP_consom').text(sommevertCPconsum);
                    
                    }
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
                           element.value.ae_reporte=newText
                        
                       }
                       if(clickid == 'AE_not')
                       {
                           element.value.ae_notifie=newText
                       }
                       if(clickid == 'AE_enga')
                       {
                           element.value.ae_engage=newText
                       }
                       if(clickid == 'CP_rpor')
                       {
                       element.value.cp_reporte=newText
                       }
                       if(clickid == 'CP_not')
                       {
                       element.value.cp_notifie=newText
                       }
                       if(clickid == 'CP_consom')
                       {
                       element.value.cp_consome=newText
                       }
                       exist=true;
                    }
                  }
               }

               if (newText != 0 && newText != '' && newText != null && newText != '0') {
                   mount_chang = true

                   if (mount_chang == true) {
                       
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

               }
               }
               else {
                   cell.empty();
                   if(old == 0 || old == "0" || old == '' || old === null || newText == 0 )
                       {
                          old='0';
                       }
                   cell.text(old)
               }
           })



       })
       $('.change_app').on('click',function(){
           var idbtn=$(this).children('#changin-up').attr('id');
           if(idbtn =='changin-up' )
           {
               console.log('i insert '+JSON.stringify(dataupdate))
               console.log('click once'+iupdate);


               console.log('click after'+iupdate);
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
                   if(response.code == 200)
                       {
                   dataupdate.forEach(elemnt=>{
                       console.log('green add to '+elemnt.code)
                       $('#ref'+elemnt.code).addClass('row-updated');
                       dataupdate=new Array();
                   })
                   }
               }


       })

          console.log('testing'+JSON.stringify(dataupdate))
          $('.change_app').empty()
       click=0;

           }
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
           disp:{},
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
            cp_consome: {},
            descrp:{},
            intituel:{}
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
                        
                        click++;
                        if (click == 1) {
                            var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
                        }
                        $('.change_app').append(buttons)
                      /*  $('#changin').on('click', function () {
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
                                    var aeValue = $(this).find('td').eq(3).text();
                                    var cpValue = $(this).find('td').eq(4).text();
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
                                url:'/opsinfo/'+id,
                                type:'GET',
                                success:function(response)
                                {
                                    if(response.code == 200)
                                    {
                                        defss=response.result.nom_sous_operation 
                                        console.log('def '+defss)
                                        newdfs=defss.split('_')
                                        $('#ref'+id+" #def").text(newdfs[0])
                                        $('#ref'+id+" #sous_def").text(newdfs[1])
                                        
                                    }
                                }
                            })
                            return localverb
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
                             var testing =str.split("-");
                             var last=testing.length-1
                           
                             return testing[last];
                         }


                         function add_newOPs_T1(id, descr, value, key,) {
                             var row = '<tr id="ref' + id + '">' +
                                 '<td class="code" >' + id + '</td>' +
                                 '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + descr + '</p></td>' +
                                 '<td class="editable" id="AE_T1">' + value + '</td>' +
                                 '<td class="editable" id="CP_T1">' + 180 + '</td>' +
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
                                        '<td class="editable" id="CP_Over">' + 180 + '</td>' +
                                        '<td class="editable" id="AE_att">' + value + '</td>' +
                                        '<td class="editable" id="CP_att">' + 180 + '</td>' +
                                        '<td  id="AE_TT" diseabled>' + some + '</td>' +
                                        '<td  id="CP_TT" diseabled>' + 360 + '</td>' +
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
   $('#T-tables tfoot').empty();
    var current = new Array();
    var preve = new Array();
    var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
    var data_T_port = new Array();
    console.log('T is' + T)
    $('#Tport-handle').addClass('scale-out');
    var tfooter='<tr><td colspan="2">Total</td>'+
                '<td id="foot_AE_T1">' + 0 + '</td>' +
                '<td id="foot_CP_T1">' + 0 + '</td>';
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
               tfooter='<tr><td colspan="2">Total</td>'+
                '<td id="foot_AE_T1">' + data_T_port.total[0].values.totalAE + '</td>' +
                '<td id="foot_CP_T1">' + data_T_port.total[0].values.totalCP + '</td>';
               
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })
}
   else
{
 
    $('#T-tables tfoot').append(tfooter);
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
                if (key == splitcode(data_T_port.group[ig].code, land)) {
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
                if (key == splitcode(data_T_port.operation[io].code, land)) {
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
                if (key == splitcode(data_T_port.sousOperation[iso].code, land)) {
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
   $('#T-tables tfoot').empty();
    var current = new Array();
    var preve = new Array();
    var data_T_port = new Array();
    var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
    $('#Tport-handle').addClass('scale-out');
    var tfooter='<tr><td colspan="2">Total</td>'+
    '<td  id="foot_AE_Over">'+0 + '</td>' +
    '<td  id="foot_CP_Over">'+0+ '</td>' +
    '<td  id="foot_AE_att">'+0+ '</td>' +
    '<td  id="foot_CP_att">'+0+ '</td>' +
    '<td  id="foot_AE_TT">'+0+ '</td>' +
    '<td  id="foot_CP_TT">'+0+ '</td> </tr>' ;
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
               tfooter='<tr><td colspan="2">Total</td>'+
                '<td  id="foot_AE_Over">'+data_T_port.total[0].values.totalAEouvrtvertical + '</td>' +
                '<td  id="foot_CP_Over">'+data_T_port.total[0].values.totalCPouvrtvertical + '</td>' +
                '<td  id="foot_AE_att">'+data_T_port.total[0].values.totalAEattenduvertical + '</td>' +
                '<td  id="foot_CP_att">'+data_T_port.total[0].values.totalCPattenduvertical + '</td>' +
                '<td  id="foot_AE_TT">'+data_T_port.total[0].values.totalAE + '</td>' +
                '<td  id="foot_CP_TT">'+data_T_port.total[0].values.totalCP + '</td> </tr>' ;
                
                
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })
}
else
   {
       $('#T-tables tfoot').append(tfooter);
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
                if (key == splitcode(data_T_port.group[ig].code, land)) {
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
                if (key == splitcode(data_T_port.operation[io].code, land)) {
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
                if (key == splitcode(data_T_port.sousOperation[iso].code, land)) {
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
   $('#T-tables tfoot').empty();
    var current = new Array();
    var preve = new Array();
    var data_T_port = new Array();

    var aerTpt=0;
    var aenTpt=0;
    var aeeTpt=0;

    var cprTpt=0;
    var cpnTpt=0;
    var cpcTpt=0;
    var tfooter='<tr><td colspan="4">Total</td>'+
                '<td  id="foot_AE_rpor">'+0 + '</td>' +
                '<td  id="foot_AE_not">'+0 + '</td>' +
                '<td  id="foot_AE_enga">'+0 + '</td>' +
                '<td  id="foot_CP_rpor">'+0 + '</td>' +
                '<td  id="foot_CP_not">'+0 + '</td>' +
                '<td  id="foot_CP_consom">'+0 + '</td> </tr>' ;
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
                console.log(data_T_port.total[0].values.totalAEnotifievertical)
                aerTpt=data_T_port.total[0].values.totalAEreportevertical
                aenTpt=data_T_port.total[0].values.totalAEnotifievertical
                aeeTpt=data_T_port.total[0].values.totalAEengagevertical
                cprTpt=data_T_port.total[0].values.totalCPreportevertical
                cpnTpt=data_T_port.total[0].values.totalCPnotifievertical
                cpcTpt=data_T_port.total[0].values.totalCPconsomevertical
               tfooter='<tr><td colspan="4">Total</td>'+
                '<td  id="foot_AE_rpor">'+aerTpt + '</td>' +
                '<td  id="foot_AE_not">'+aenTpt + '</td>' +
                '<td  id="foot_AE_enga">'+aeeTpt + '</td>' +
                '<td  id="foot_CP_rpor">'+cprTpt + '</td>' +
                '<td  id="foot_CP_not">'+cpnTpt + '</td>' +
                '<td  id="foot_CP_consom">'+cpcTpt + '</td> </tr>' ;
               
                
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })}
    else
   {
       $('#T-tables tfoot').append(tfooter);
   }
       var lasty=parseInt(yearport) - 1
    var headT = '<tr>' +
        '<th><h1>code</h1></th>' +
        '<th><h1>T Description</h1></th>' +
        '<th><h1>Numero de Decision</h1></th>' +
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
                '<td> - </td>' +
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
            
                if (key == splitcode(data_T_port.group[ig].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td><p>' + val[0] + '</p> </td>' +
                        '<td> - </td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                        '<td class="editable" id="AE_rpor">' + data_T_port.group[ig].values.ae_reportegrpop + ',00</td>' +
                        '<td class="editable" id="AE_not">' + data_T_port.group[ig].values.ae_notifiegrpop + ',00</td>' +
                        '<td class="editable" id="AE_enga">' + data_T_port.group[ig].values.ae_engagegrpop + ',00</td>' +
                        '<td class="editable" id="CP_rpor">' + data_T_port.group[ig].values.cp_reportegrpop + ',00</td>' +
                        '<td class="editable" id="CP_not">' + data_T_port.group[ig].values.cp_notifiegrpop + '</td>' +
                        '<td class="editable" id="CP_consom">' + data_T_port.group[ig].values.cp_consomegrpop + ',00</td>' +
                        '</tr>';
                    ig++;
                }
            }
            if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
               var land=data_T_port.operation[io].code.length-5;
                
                if (key == splitcode(data_T_port.operation[io].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td><p>' + val[0] + '</p> </td>' +
                        '<td> - </td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                        '<td class="editable" id="AE_rpor">' + data_T_port.operation[io].values.ae_reporteop + '</td>' +
                        '<td class="editable" id="AE_not">' + data_T_port.operation[io].values.ae_notifieop + '</td>' +
                        '<td class="editable" id="AE_enga">' + data_T_port.operation[io].values.ae_engageop + '</td>' +
                        '<td class="editable" id="CP_rpor">' + data_T_port.operation[io].values.cp_reporteop + '</td>' +
                        '<td class="editable" id="CP_not">' + data_T_port.operation[io].values.cp_notifieop + '</td>' +
                        '<td class="editable" id="CP_consom">' + data_T_port.operation[io].values.cp_consomeop + '</td>' +
                        '</tr>';
                    io++;
                }
            }
            if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso) {
               var land=data_T_port.sousOperation[iso].code.length-5;
            
                if (key == splitcode(data_T_port.sousOperation[iso].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td><p>' +    val[0] + '</p> </td>' +
                        '<td> -  </td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                        '<td class="editable" id="AE_rpor">' + data_T_port.sousOperation[iso].values.ae_reportesousop + '</td>' +
                        '<td class="editable" id="AE_not">' + data_T_port.sousOperation[iso].values.ae_notifiesousop + '</td>' +
                        '<td class="editable" id="AE_enga">' + data_T_port.sousOperation[iso].values.ae_engagesousop + '</td>' +
                        '<td class="editable" id="CP_rpor">' + data_T_port.sousOperation[iso].values.cp_reportesousuop + '</td>' +
                        '<td class="editable" id="CP_not">' + data_T_port.sousOperation[iso].values.cp_notifiesousop + '</td>' +
                        '<td class="editable" id="CP_consom">' + data_T_port.sousOperation[iso].values.cp_consomesousop + '</td>' +
                        '</tr>';
                    iso++;
                }
                else
                { 
                   if(splitcode(data_T_port.sousOperation[iso].code, land).length < 5 )
                   {
                   
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                    '<td scope="row"  class="code" >' + key + '</td>' +
                    '<td>'  +    val[0] + '</td>' +
                    '<td>  - </td>' +
                    '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                    '<td class="editable" id="AE_rpor">' + data_T_port.sousOperation[iso].values.ae_reportesousop + '</td>' +
                    '<td class="editable" id="AE_not">' + data_T_port.sousOperation[iso].values.ae_notifiesousop + '</td>' +
                    '<td class="editable" id="AE_enga">' + data_T_port.sousOperation[iso].values.ae_engagesousop + '</td>' +
                    '<td class="editable" id="CP_rpor">' + data_T_port.sousOperation[iso].values.cp_reportesousuop + '</td>' +
                    '<td class="editable" id="CP_not">' + data_T_port.sousOperation[iso].values.cp_notifiesousop + '</td>' +
                    '<td class="editable" id="CP_consom">' + data_T_port.sousOperation[iso].values.cp_consomesousop + '</td>' +
                    '</tr>';
                    iso++;
                     $('#T-tables tbody').append(row);
                       only_def(data_T_port.sousOperation[iso].code)
                   row = '<tr class="ref'+splitcode(data_T_port.sousOperation[iso].code, land)+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                   '<td scope="row"  class="code" >' +key+"-"+splitcode(data_T_port.sousOperation[iso].code, land) + '</td>' +
                   '<td>'  +    val[0] + '</td>' +
                   '<td id="def"> </td>' +
                   '<td id="sous_def" style="display: flex;align-items: center; justify-content: space-between;"></td>' +
                   '<td class="editable" id="AE_rpor">' + data_T_port.sousOperation[iso].values.ae_reportesousop + '</td>' +
                   '<td class="editable" id="AE_not">' + data_T_port.sousOperation[iso].values.ae_notifiesousop + '</td>' +
                   '<td class="editable" id="AE_enga">' + data_T_port.sousOperation[iso].values.ae_engagesousop + '</td>' +
                   '<td class="editable" id="CP_rpor">' + data_T_port.sousOperation[iso].values.cp_reportesousuop + '</td>' +
                   '<td class="editable" id="CP_not">' + data_T_port.sousOperation[iso].values.cp_notifiesousop + '</td>' +
                   '<td class="editable" id="CP_consom">' + data_T_port.sousOperation[iso].values.cp_consomesousop + '</td>' +
                   '</tr>';
                   iso++;
                 
               }
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
                           var ads = newKey.split('ref')[1]
                           $('.Tsop_handler').removeClass('Tsop_handler_h')
                            add_newOPs_T3(ads, 2500, newKey);

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
                       var ads = newKey.split('ref')[1] 
                       $('.Tsop_handler').removeClass('Tsop_handler_h')
                        add_newOPs_T3(ads, 2500, preve);
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
   $('#T-tables tfoot').empty();
    var current = new Array();
    var preve = new Array();
    var data_T_port = new Array();
    var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
    var tfooter='<tr><td colspan="3">Total</td>'+
    '<td id="foot_AE_T4">' + 0+ '</td>' +
    '<td id="foot_CP_T4">' + 0 + '</td>';  
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
               tfooter='<tr><td colspan="3">Total</td>'+
                '<td id="foot_AE_T4">' + data_T_port.total[0].values.totalAE + '</td>' +
                '<td id="foot_CP_T4">' + data_T_port.total[0].values.totalCP + '</td> </tr>';  

               
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })
   }
   else
   {
       $('#T-tables tfoot').append(tfooter);
   }

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
                if (key == splitcode(data_T_port.group[ig].code, land)) {
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
                if (key == splitcode(data_T_port.operation[io].code, land)) {
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
                if (key == splitcode(data_T_port.sousOperation[iso].code, land)  ) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row" class="code" >' + key + '</td>' +
                        '<td ><p>' + value + '</p></td>' +

                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                        '<td class="editable" id="AE_T4">' + data_T_port.sousOperation[iso].values.ae_sousop + '</td>' +
                        '<td class="editable" id="CP_T4">' + data_T_port.sousOperation[iso].values.cp_sousuop + '</td>' +
                        '</tr>';
                    iso++;
                }
                else{
                    var sousou=true
                    while (sousou) {
                        if(splitcode(data_T_port.sousOperation[iso].code, land).length < 5 )
                            {
                             
                            only_def(data_T_port.sousOperation[iso].code)
                            row = '<tr class="ref'+data_T_port.sousOperation[iso].code+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                            '<td scope="row" class="code" >' +key+"-"+splitcode(data_T_port.sousOperation[iso].code, land)+ '</td>' +
                            '<td id="def"></td>' +
                            '<td id="sous_def" ></td>'+
                            '<td class="editable" id="AE_T4">' + data_T_port.sousOperation[iso].values.ae_sousop + '</td>' +
                            '<td class="editable" id="CP_T4">' + data_T_port.sousOperation[iso].values.cp_sousuop + '</td>' +
                            '</tr>';
                            iso++;  
                            $('#T-tables tbody').append(row);
                    }
                    else
                    {
                        sousou=false
                    }
                    }
                  
                }
            }
           }
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
                           var ads = newKey.split('ref')[1]
                           $('.Tsop_handler').removeClass('Tsop_handler_h')
                           console.log('add once');
                            add_newOPs_T4(ads, 2500, newKey);
                        })
                    }

                    preve = current;
                }
                current = key;
            }
            if(code === 200)
                {
                   dataupdate=[]
                   Update_dpia(T,iupdate);
                   console.log('testing new update function')
     
                }else
                {
                    Edit(id, T)
                }
            
        });
        
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
