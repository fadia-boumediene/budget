$(document).ready(function(){
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
  var type;
  let selectTret ='T0';
  let  selectedHobby='t'
  let selectedret ='0';
  var prognum='';
  var sousprogbum='';
  var progs={};
  var sousProgs={};
    $('.update-handl').on('click',function(){
      var id=$(this).parent().parent().attr('id');
      var port=$('.family-tree').attr('id');
      console.log('file loading  '+id)
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
            $('#id_sprog_modif').text(response.nom_prog);
            prognum=response.num_prog
            $.ajax({
              url:'/allaction/'+port,
              type:'GET',
              success:function(response)
              {
                if(response.exists)
                {
                  progs=response.programs
                  
                  response.actions.forEach(element => {
                    console.log('append'+JSON.stringify(element.actions) )
                    $('#id_cible').append("<option value="+element.actions.actions_num+">"+element.actions.actions_name+"</option>")
                  });
                
                }
              }
            })
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
                $('#id_sprog_modif').text(response.nom_sous_prog);
                sousprogbum=response.num_sous_prog
                prognum=response.num_prog
                $.ajax({
                  url:'/allaction/'+port,
                  type:'GET',
                  success:function(response)
                  {
                    if(response.exists)
                    {
                      sousProgs=response.sous_programs
                      
                      response.actions.forEach(element => {
                        console.log('append'+JSON.stringify(element.actions) )
                        $('#id_cible').append("<option value="+element.actions.actions_num+">"+element.actions.actions_name+"</option>")
                      });
                    
                    }
                  }
                })
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
    ' <label for="input1">Action a Reterie montant</label>'+
    '<select class="form-control" id="id-retire" >'+
    '<option value="0" >Selectionner Article</option>'+
    '</select>'+
    '</div><div class="section-env"></div>';
    $('.add-envoi').append(chose);
    if(Object.keys(progs).length !=0)
    {
   
     progs.forEach(element=>{
      $('#id-retire').append("<option value="+element.programs.progs_num+">"+element.programs.progs_name+"</option>")
     }) 
    }
    else
    {
      if(Object.keys(sousProgs).length !=0)
      {

        sousProgs.forEach(element=>{
          $('#id-retire').append("<option value="+element.sous_programs.sous_progs_num+">"+element.sous_programs.sous_progs_name+"</option>")
         }) 
      }
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
    
      $('#id-retire').on('change',function(){
        console.log('i act chnage')
        selectedret = $('#id-retire').val();
        if (selectedret != '0') {
          console.log('i act chnage inside')
      $('.add-envoi').append('<hr>');
      $('.section-env').append(choseT);
      
      var init='<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_env_T" name="interest" />'+
       '<label for="number">CP</label>'+
       '<input type="number" class="form-control" id="CP_env_T" name="interest" />';
      $('.add-envoi').append('<hr>');
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
          
          console.log('nothing is selected Action that will give '+selectedret)
        }
      })

     } else {
      $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
     
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
  if(selectTret === '' || selectedret === '' && selectedHobby === 'inter')
  {
    cmpt=false
  }
  else
  {
    if(selectTret !== '' && selectedret !== '' && selectedHobby === 'inter')
    {
      cmpt=true;
    }
  }
  if(selectedHobby === 'exter' && $('#id_cible').val() !== '0')
  {
    cmpt=true;
  }
  var data={
    ref:$('#id').val(),
     AE_T1:AE_T1,
     CP_T1:CP_T1,
     AE_T2:AE_T2,
     CP_T2:CP_T2,
     AE_T3:AE_T3,
     CP_T3:CP_T3,
     AE_T4:AE_T4,
     CP_T4:CP_T4,
     T_port_env:selectTret,
     AE_env_T:$('#AE_env_T').val(),
     CP_env_T:$('#CP_env_T').val(),
     Sous_prog_env:selectedret,
     type:selectedHobby,
     prognum:prognum,
     sousprogbum:sousprogbum,
     cible:$('#id_cible').val(),
     status:cmpt, 
  }
  console.log('testing all'+JSON.stringify(data));
  $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
})
    })
  })
})