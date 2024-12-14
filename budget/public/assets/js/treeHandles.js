$(document).ready(function(){
  var change = false;
  var AE_T1=0
  var CP_T1=0
  var T1select=false
  var AE_T2=0
  var CP_T2=0
  var T2select=false
  var AE_T3=0
  var CP_T3=0
  var T3select=false
  var AE_T4=0
  var CP_T4=0
  var T4select=false
  var singlcheck=false
  var wallet_selected=false
  var prog_selected=false
  var sprog_selected=false
  var type;
  let selectTret ='T0';
  let  selectedHobby='t'
  let selectedprogret ='0';
  let selectdsousret='0';
  var prognum='';
  var sousprogbum='';
  var iid=0
  var progs={};
  var sousProgs={};
  $('.back-flw').on('click',function(){
    change=false;
          $('#wall_to_wall').css('display','flex')
         
          $('#wall_to_wall').children().each(function() {
            
            if($(this).attr('class') == 'card-body hidden') // Add the class of each child to the array
              {
                $(this).removeClass('hidden')
              }
            
        });


          $('#prog_to_prog').css('display','flex')
        
          $('#prog_to_prog').children().each(function() {
          
            if($(this).attr('class') == 'card-body hidden') // Add the class of each child to the array
              {
                $(this).removeClass('hidden')
              }
            
        });

          $('#sprog_to_sprog').css('display','flex')

          $('#sprog_to_sprog').children().each(function() {
          
            if($(this).attr('class') == 'card-body hidden') // Add the class of each child to the array
              {
                $(this).removeClass('hidden')
              }
            
        });


          $('#update_art_handler').addClass('hidden')
          $('#modif-dif').empty()
  })
  /**
 * wallet volet
 */
  $('#wall_to_wall').on('click',function(){
    $(this).children().each(function() {
      if($(this).attr('class') == 'card-body') // Add the class of each child to the array
        {
          wallet_selected=true;
          prog_selected=false
          sprog_selected=false
          $(this).addClass('hidden')
          $('#prog_to_prog').css('display','none')
          $('#sprog_to_sprog').css('display','none')
          $('#update_art_handler').removeClass('hidden')
        
        }
      
  });
 
   }) 
 
   /**
 * programme volet
 */
   $('#prog_to_prog').on('click',function(){
    $(this).children().each(function() {
      if($(this).attr('class') == 'card-body') // Add the class of each child to the array
        {
          wallet_selected=false;
          prog_selected=true
          sprog_selected=false
          $(this).addClass('hidden')
          $('#wall_to_wall').css('display','none')
          $('#sprog_to_sprog').css('display','none')
          $('#update_art_handler').removeClass('hidden')
        
        }
      
  });
});

/**
 * sous programme volet
 */
$('#sprog_to_sprog').on('click',function(){
  $(this).children().each(function() {
    if($(this).attr('class') == 'card-body') // Add the class of each child to the array
      {
        wallet_selected=false;
        prog_selected=false
        sprog_selected=true
        $(this).addClass('hidden')
        $('#wall_to_wall').css('display','none')
        $('#prog_to_prog').css('display','none')
        $('#update_art_handler').removeClass('hidden')
      
      }
    
});
});

  $('#single').click(function(){
    /**
     * this for wallet_to_wallet
     */
    if(wallet_selected)
    {
    if($(this).is(':checked'))
    {
      singlcheck=true;
    
    }
    if(singlcheck && iid == 0)
    {
      var inpsrouce =' <div id="wallet-inpt-handle" >'+
      '<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_wall_source" name="interest" />'+
      '<label for="number">CP</label>'+
      '<input type="number" class="form-control" id="CP_wall_source" name="interest" />'+
      '</div>';
      var inpdista ='<div id="wallet-inpt-handle" >'+
      '<label for="wallet">Donner Code du Portfail destinataire</label>'+
      '<input type="text" class="form-control" id="id_wall_distance" name="interest" style="width: 100px;" />'+
      '<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_wall_distance" name="interest" />'+
      '<label for="number">CP</label>'+
      '<input type="number" class="form-control" id="CP_wall_distance" name="interest" />'+
      '</div>';
      $('#modif-dif').append(inpsrouce)
      $('#modif-dif').append(inpdista)
      iid++;
    }
    }
    /**
     * for program ver programe
     */
    if(prog_selected)
    {

      $.ajax({
        url:'/check-prog',
        Type:'GET',
        data:{
            num_prog:id
        },
        success:function(response)
        {
           if(response.exists)
           {
            prognum=response.num_prog
           }
           else
           {
            $.ajax({
              url:'/check-sousprog',
              Type:'GET',
              data:{
                num_sous_prog:id,},
              success:function(response) {
                if(response.exists)
                {
                sousprogbum=response.num_sous_prog
                prognum=response.num_prog
                console.log('resitn'+JSON.stringify(response));
                }
              }         
            })
           }
        }
      })

      var chose ='<div class="form-group">'+
      ' <label for="input1">Programme a Reterie montant</label>'+
      '<select class="form-control" id="id-retire_prog" >'+
      '<option value="0" >Selectionner Article</option>'+
      '</select>'+
      '</div><div class="section-env"></div><hr>';

      var inpsrouce =' <div id="wallet-inpt-handle" >'+
      '<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_prog_source" name="interest" />'+
      '<label for="number">CP</label>'+
      '<input type="number" class="form-control" id="CP_prog_source" name="interest" />'+
      '</div>';
      var inpsrdist =' <div id="wallet-inpt-handle" >'+
      '<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_prog_distan" name="interest" />'+
      '<label for="number">CP</label>'+
      '<input type="number" class="form-control" id="CP_prog_distanc" name="interest" />'+
      '</div>';
      $('#modif-dif').append(inpsrouce)
      $('#modif-dif').append(chose)
      
      if(Object.keys(progs).length !=0)
    {
     progs.forEach(element=>{
      $('#id-retire_prog').append("<option value="+element.programs.progs_num+">"+element.programs.progs_name+"</option>")
     }) 
    }
    $('#id-retire_prog').on('change',function(){
    if(change == false)
    $('.section-env').append(inpsrdist)
       change= true;
    })
    }

/* ==============================================================================================================================*/

/**
 * this for sprog to sprog
 */

if(sprog_selected)
{

var Thandle='  <div class="form-group">'+
'<fieldset>'+
'<legend>Choisir Les Port</legend>'+
'<div class="Tchecks">'+
'<div class="Tfields" >'+
'<label for="Tports">T1</label>'+
' <input type="checkbox" class="form-check-input" id="T1" name="interest" value="T1" />'+
' <div id="T1-inpt-handle" style="display:none;">'+
' <label for="Tports">AE</label>'+
' <input type="number" class="form-control" id="AE_T1" name="interest" />'+
' <label for="number">CP</label>'+
' <input type="number" class="form-control" id="CP_T1" name="interest" />'+
' </div>'+
' </div>'+
  
' <div class="hr-vert"></div>'+


'<div class="Tfields" >'+
'<label for="Tports">T2</label>'+
' <input type="checkbox" class="form-check-input" id="T2" name="interest" value="T2" />'+
' <div id="T2-inpt-handle" style="display:none;">'+
 '<label for="Tports">AE</label>'+
 '<input type="number" class="form-control" id="AE_T2" name="interest" />'+
 '<label for="number">CP</label>'+
 '<input type="number" class="form-control" id="CP_T2" name="interest" />'+
' </div>'+
 '</div>'+
 
 '<div class="hr-vert"></div>'+

 '<div class="Tfields" >'+
'<label for="Tports">T3</label>'+
 '<input type="checkbox" class="form-check-input" id="T3" name="interest" value="T3" />'+
 '<div id="T3-inpt-handle" style="display:none;">'+
 '<label for="Tports">AE</label>'+
 '<input type="number" class="form-control" id="AE_T3" name="interest" />'+
 '<label for="number">CP</label>'+
 '<input type="number" class="form-control" id="CP_T3" name="interest" />'+
 '</div>'+
 '</div>'+
 
 '<div class="hr-vert"></div>'+

 '<div class="Tfields" >'+
'<label for="Tports">T4</label>'+
 '<input type="checkbox" class="form-check-input" id="T4" name="interest" value="T4" />'+
 '<div id="T4-inpt-handle" style="display:none;">'+
 '<label for="Tports">AE</label>'+
 '<input type="number" class="form-control" id="AE_T4" name="interest" />'+
 '<label for="number">CP</label>'+
 '<input type="number" class="form-control" id="CP_T4" name="interest" />'+
' </div>'+
 '</div>'+
 '</div>'+
'</fieldset>'+
'</div>';
  
  $.ajax({
    url:'/check-prog',
    Type:'GET',
    data:{
        num_prog:id
    },
    success:function(response)
    {
       if(response.exists)
       {
        prognum=response.num_prog
       }
       else
       {
        $.ajax({
          url:'/check-sousprog',
          Type:'GET',
          data:{
            num_sous_prog:id,},
          success:function(response) {
            if(response.exists)
            {
            sousprogbum=response.num_sous_prog
            prognum=response.num_prog
            console.log('resitn'+JSON.stringify(response));
            }
          }         
        })
       }
    }
  })

  var chosesoussourc ='<div class="form-group">'+
    ' <label for="input1">Sous Programme a Reterie montant</label>'+
    '<select class="form-control" id="id-retire_sous_prog" >'+
    '<option value="0" >Selectionner Article</option>'+
    '</select>'+
    '<div class="section-env"></div><hr>';
    var chosesousdest ='<div class="form-group">'+
    ' <label for="input1">Sous Programme a Reterie montant</label>'+
    '<select class="form-control" id="id-env_sous_prog" >'+
    '<option value="0" >Selectionner Article</option>'+
    '</select>'+
    '<div class="section-ret"></div><hr>';
    var choseact=' <div class="form-group">'+
    '<label for="input1">Action a modifier</label>'+
'      <select type="text" class="form-control" id="id_cible" placeholder="Entrer le Nom du Programme">'+
'       <option value="0" >Selectionner Article</option>'+
'      </select>'+
'    </div>'
    $('#modif-dif').append(chosesoussourc)
   // $('#modif-dif').append(chose)
    if(Object.keys(sousProgs).length !=0)
    {
        sousProgs.forEach(element=>{
          $('#id-retire_sous_prog').append("<option value="+element.sous_programs.sous_progs_num+">"+element.sous_programs.sous_progs_name+"</option>")
         }) 

         $('#id-retire_sous_prog').on('change',function(){
          if(change == false)
          {
          $('#modif-dif').append(chosesousdest)
             change= true;
             sousProgs.forEach(element=>{
              $('#id-env_sous_prog').append("<option value="+element.sous_programs.sous_progs_num+">"+element.sous_programs.sous_progs_name+"</option>")
             }) 
            }  
          $('#id-env_sous_prog').on('change',function(){
                $('.section-ret').append(Thandle)
                $('#T1').click(function(){
                  if ($(this).is(':checked')) {
                   $('#T1-inpt-handle').css('display','flex')
                     // Checkbox is checked
                    T1select=true
                          } else {
                         // Checkbox is unchecked
                   console.log($(this).val() + " is unchecked.");
                   $('#T1-inpt-handle').css('display','none')
                        AE_T1=0
                        CP_T1=0
                        T1select=false
                       }
                     });
                     $('#T2').click(function(){
                  if ($(this).is(':checked')) {
                     // Checkbox is checked
                   console.log($(this).val() + " is checked.");
                   $('#T2-inpt-handle').css('display','flex')
                   T2select=true
                          } else {
                         // Checkbox is unchecked
                   console.log($(this).val() + " is unchecked.");
                   $('#T2-inpt-handle').css('display','none')
                   AE_T2=0
                   CP_T2=0
                   T2select=false
                       }
                     });
                     $('#T3').click(function(){
                  if ($(this).is(':checked')) {
                     // Checkbox is checked
                   console.log($(this).val() + " is checked.");
                   $('#T3-inpt-handle').css('display','flex')
                   T3select=true
                          } else {
                         // Checkbox is unchecked
                   console.log($(this).val() + " is unchecked.");
                   $('#T3-inpt-handle').css('display','none')
                   AE_T3=0
                   CP_T3=0
                   T3select=false
                       }
                     });
                     $('#T4').click(function(){
                  if ($(this).is(':checked')) {
                     // Checkbox is checked
                   console.log($(this).val() + " is checked.");
                   $('#T4-inpt-handle').css('display','flex')
                   T4select=true
                          } else {
                         // Checkbox is unchecked
                   console.log($(this).val() + " is unchecked.");
                   $('#T4-inpt-handle').css('display','none')
                   AE_T4=0
                   CP_T4=0
                   T4select=false
                       }
                     });

          })
          var port=$('.family-tree').attr('id');
          $('#modif-dif').append(choseact)
          $.ajax({
            url:'/allaction/'+port,
            type:'GET',
            success:function(response)
            {
              if(response.exists)
              {
                progs=response.programs
                sousProgs=response.sous_programs
                console.log('sous prog'+JSON.stringify(sousProgs)+' and prog'+JSON.stringify(progs))
                progs.forEach(element=>{
                  console.log('boucme'+element.programs.progs_num )
                  var ids=element.programs.progs_num
                  if(ids == id)
                  {
                    $('#id_sprog_modif').text(element.programs.progs_name);
                  }
                 })
                 sousProgs.forEach(element=>{
                  if(element.sous_programs.sous_progs_num == id)
                  {
                    $('#id_sprog_modif').text(element.sous_programs.sous_progs_name);
                  }
                 }) 
    
                response.actions.forEach(element => {
                  console.log('append'+JSON.stringify(element.actions) )
                  $('#id_cible').append("<option value="+element.actions.actions_num+">"+element.actions.actions_name+"</option>")
                });
              
              }
            }
          })
    
        
          })
         
    }
}


 /* ===============================================================================================================================*/

  })


 
    $('.update-handl').on('click',function(){
      var id=$(this).parent().parent().attr('id');
      var port=$('.family-tree').attr('id');
      console.log('file loading  '+id)


      $.ajax({
        url:'/allaction/'+port,
        type:'GET',
        success:function(response)
        {
          if(response.exists)
          {
            progs=response.programs
            sousProgs=response.sous_programs
            console.log('sous prog'+JSON.stringify(sousProgs)+' and prog'+JSON.stringify(progs))
            progs.forEach(element=>{
              console.log('boucme'+element.programs.progs_num )
              var ids=element.programs.progs_num
              if(ids == id)
              {
                $('#id_sprog_modif').text(element.programs.progs_name);
              }
             })
             sousProgs.forEach(element=>{
              if(element.sous_programs.sous_progs_num == id)
              {
                $('#id_sprog_modif').text(element.sous_programs.sous_progs_name);
              }
             }) 

            response.actions.forEach(element => {
              console.log('append'+JSON.stringify(element.actions) )
              $('#id_cible').append("<option value="+element.actions.actions_num+">"+element.actions.actions_name+"</option>")
            });
          
          }
        }
      })

     $.ajax({
        url:'/check-prog',
        Type:'GET',
        data:{
            num_prog:id
        },
        success:function(response)
        {
           if(response.exists)
           {
            prognum=response.num_prog
           }
           else
           {
            $.ajax({
              url:'/check-sousprog',
              Type:'GET',
              data:{
                num_sous_prog:id,},
              success:function(response) {
                if(response.exists)
                {
                sousprogbum=response.num_sous_prog
                prognum=response.num_prog
                console.log('resitn'+JSON.stringify(response));
                }
              }         
            })
           }
        }
      })
      $(this).css('color','red')
        var inputfile='<div class="confirm-file-handle"><form>'+
                      '<input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png">'+
                      ' </form>'+
                      '<button class="button-70" id="button-70"  role="button">joindre fichier</button></div>'
    $('.confirm-justfie').addClass('setit-back')
    $('.confirm-justfie').append(inputfile)
    $('.float-export').css('display','none');  
    $('.confirm-justfie').on('click',function(){
      $(this).empty()
      $(this).removeClass('setit-back');
      $('.member .update-handl').css('color','black')
      $('.float-export').css('display','block');
      
    })
    $('.modif-contiant').on('click',function(){
      $(this).removeClass('setit-insert');
      $('.member .update-handl').css('color','black')
      $('.modif-handler').css('display','none')
      $('.float-export').css('display','block');
      $('#id_cible').empty()
      $('#id-retire').empty()
      window.location.reload();
    })
    $('#button-70').on('click',function(){
  $('.float-export').css('display','block'); 
  $('.modif-contiant').addClass('setit-insert');
  $('.modif-handler').css('display','block');
  $('#T1').click(function(){
  if ($(this).is(':checked')) {
   $('#T1-inpt-handle').css('display','flex')
     // Checkbox is checked
    T1select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T1-inpt-handle').css('display','none')
        AE_T1=0
        CP_T1=0
        T1select=false
       }
     });
     $('#T2').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T2-inpt-handle').css('display','flex')
   T2select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T2-inpt-handle').css('display','none')
   AE_T2=0
   CP_T2=0
   T2select=false
       }
     });
     $('#T3').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T3-inpt-handle').css('display','flex')
   T3select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T3-inpt-handle').css('display','none')
   AE_T3=0
   CP_T3=0
   T3select=false
       }
     });
     $('#T4').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T4-inpt-handle').css('display','flex')
   T4select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T4-inpt-handle').css('display','none')
   AE_T4=0
   CP_T4=0
   T4select=false
       }
     });
 
  $('input[name="type_modif"]').change(function () {
    selectedHobby = $('input[name="type_modif"]:checked').val();
   if (selectedHobby === "inter") {
    console.log('testing radio'+selectedHobby);
    var chose ='<div class="form-group">'+
    ' <label for="input1">Programme ou Bien sous programme a Reterie montant</label>'+
    '<select class="form-control" id="id-retire_prog" >'+
    '<option value="0" >Selectionner Article</option>'+
    '</select>'+
    '</div><div class="section-env"></div><hr>';
    $('.add-envoi').append(chose);
    var chosesous ='<div class="form-group">'+
    ' <label for="input1">Sous Programme a Reterie montant</label>'+
    '<select class="form-control" id="id-retire_sous_prog" >'+
    '<option value="0" >Selectionner Article</option>'+
    '</select>'+
    '<hr>';
    $('.add-envoi').append(chosesous);
    if(Object.keys(progs).length !=0)
    {
     progs.forEach(element=>{
      $('#id-retire_prog').append("<option value="+element.programs.progs_num+">"+element.programs.progs_name+"</option>")
     }) 
    }
    if(Object.keys(sousProgs).length !=0)
    {
        sousProgs.forEach(element=>{
          $('#id-retire_sous_prog').append("<option value="+element.sous_programs.sous_progs_num+">"+element.sous_programs.sous_progs_name+"</option>")
         }) 
    }
    
    var choseT ='<div class="form-group">'+
    ' <label for="input1">Tport Reterie montant</label>'+
    '<select class="form-control" id="id-T-retire">'+
    '<option value="T0" >Selectionner TPort</option>'+
    '<option value="T1" >Port 01</option>'+
    '<option value="T2" >Port 02</option>'+
    '<option value="T3" >Port 03</option>'+
    '<option value="T4" >Port 04</option>'+
    '</select>'+
    '</div>'+
    '<div class="Tenv-inpt-handle" >'+
     '</div>';
      $('#id-retire_sous_prog').on('change',function(){
        console.log('i act chnage')
        selectdsousret = $('#id-retire_sous_prog').val();  
      })
      $('#id-retire_prog').on('change',function(){
        console.log('i act chnage')
        selectedprogret = $('#id-retire_prog').val();
        if (selectedprogret != '0') {
          console.log('i act chnage inside')
      
      if(change == false)
      {
      $('.add-envoi').append('<hr>');
      $('.section-env').append(choseT);
      }
      change= true;
      var init='<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_env_T" name="interest" />'+
       '<label for="number">CP</label>'+
       '<input type="number" class="form-control" id="CP_env_T" name="interest" />';
      $('#id-T-retire').on('change',function(){
      $('.Tenv-inpt-handle').empty()
       selectTret =$('#id-T-retire').val();
       if(selectTret !== 'T0')
        {
          console.log('all inside')
        $('.Tenv-inpt-handle').append(init);
       
        }
        else
        {
          console.log('nothing is selected of radios '+selectTret )
        }
      })
      
        } else {
          
          console.log('nothing is selected Action that will give '+selectedprogret)
        }
      })

     } else {
      $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
      if(selectedHobby == "mvm")
      {
        var choseT ='<div class="form-group">'+
    ' <label for="input1">Tport Reterie montant</label>'+
    '<select class="form-control" id="id-T-retire">'+
    '<option value="T0" >Selectionner TPort</option>'+
    '<option value="T1" >Port 01</option>'+
    '<option value="T2" >Port 02</option>'+
    '<option value="T3" >Port 03</option>'+
    '<option value="T4" >Port 04</option>'+
    '</select>'+
    '</div>'+
    '<div class="Tenv-inpt-handle" >'+
     '</div>';
   
      $('.add-envoi').append(choseT);
      $('.add-envoi').append('<hr>');
      var init='<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_env_T" name="interest" />'+
       '<label for="number">CP</label>'+
       '<input type="number" class="form-control" id="CP_env_T" name="interest" />';
       $('#id-T-retire').on('change',function(){
        $('.Tenv-inpt-handle').empty()
         selectTret =$('#id-T-retire').val();
         if(selectTret !== 'T0')
          {
            console.log('all inside')
          $('.Tenv-inpt-handle').append(init);
         
          }  
         }  
        )}
      else
      {
        $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
      }
     console.log('nothing is selected type of interaction '+selectedHobby)
     $('.float-export').css('display','block');
    }

})
$('#button-71').on('click',function(){
  if(T1select == true)
  {
    AE_T1=$('#AE_T1').val();
    CP_T1=$('#CP_T1').val();
  }
  if(T2select == true)
  {
    AE_T2=$('#AE_T2').val();
    CP_T2=$('#CP_T2').val();
  }
  if(T3select == true)
  {
    AE_T3=$('#AE_T3').val();
    CP_T3=$('#CP_T3').val();   
  }
  if(T4select == true)
  {
    AE_T4=$('#AE_T4').val();
    CP_T4=$('#CP_T4').val();     
  }
  var cmpt=false;
  if(selectTret === '0' || selectedprogret === '' && selectedHobby === 'inter' && $('#id_cible').val() === '0')
  {
    cmpt=false
  }
  else
  {
    if(selectTret !== '0' && selectedprogret !== '' && selectedHobby === 'inter' && $('#id_cible').val() !== '0')
    {
      cmpt=true;
    }
  }
  if(selectedHobby === 'exter' && $('#id_cible').val() !== '0')
  {
    cmpt=true;
  }
  else
  
  var datamodif={
    ref:$('#id').val(),
     AE_T1:parseFloat(AE_T1),
     CP_T1:parseFloat(CP_T1),
     AE_T2:parseFloat(AE_T2),
     CP_T2:parseFloat(CP_T2),
     AE_T3:parseFloat(AE_T3),
     CP_T3:parseFloat(CP_T3),
     AE_T4:parseFloat(AE_T4),
     CP_T4:parseFloat(CP_T4),
     T_port_env:selectTret,
     AE_env_T: parseFloat($('#AE_env_T').val()),
     CP_env_T: parseFloat($('#CP_env_T').val()),
     prog_retirer:selectedprogret,
     Sous_prog_retire:selectdsousret,
     type:selectedHobby,
     prognum_click:prognum,
     sousprogbum_click:sousprogbum,
     cible_action:$('#id_cible').val(),
     status:cmpt, 
     _token: $('meta[name="csrf-token"]').attr("content"),
     _method: "POST",
  }
  console.log('testing all'+JSON.stringify(datamodif));
  $.ajax({
    url:'/updateModif',
    type:'POST',
    data:datamodif,
    success:function(response)
    {

    }
  })

  $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
     change=false;
})
    })
  })
})