<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portefeuille</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">

<link href="{{asset('assets/css/Tree.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<!-- Styles -->
</head>
<body>
@include('side_bar.side-barV1')
<!-- Container for Car Cards -->
<div>
 {{--@include('progress_step.progress_step')--}}
 <br>
 </div>
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 <div class="container">
 <div class="container family-tree" id="{{$allport['id']}}">
    <div class="row justify-content-center">
      <div class="col-12 tree">
        <ul id="father0">
          <li>
              <span class="member" id="{{$allport['id']}}">

                <!--  -->

                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Portefeuille</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"> AE :{{$allport['TotalAE']}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0"> CP :{{$allport['TotalCP']}}</h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div>
                        @foreach($allport['prgrammes'] as $portf)

                        <p class="fs-7 mb-0">Progamme : {{$portf['id_prog'] }}</p>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

                <!--  -->
            </span>
            <ul id="father1" style="display:none;">
            @foreach($allport['prgrammes'] as $portf)
              <li>
             
                @if($portf['TotalAE'] == $portf['init_AE'] && $portf['TotalCP'] ==  $portf['init_CP'])
              <span class="member" id="{{$portf['id_prog']}}">
                @else
                <span class="member alert_func" id="{{$portf['id_prog']}}">
              @endif
              <div class="edit-zone"><i class="fas fa-edit update-handl"></i></div>
                <div class="col-12 col-sm-6" id="kids">  
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">{{$portf['data']['nom_prog']}}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"> AE :{{$portf['TotalAE']}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0"> CP :{{$portf['TotalCP']}}</h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div>
                      @if(count($portf['sous_program']) !=0) 
                      @foreach($portf['sous_program'] as $souportf)
                        @if(!empty($souportf['id_sous_prog']))
                        <p class="fs-7 mb-0">Sous_Progamme : {{$souportf['id_sous_prog'] }}</p>
                        @else
                        <p class="fs-7 mb-0">aucun Sous_Progamme</p>
                        @endif
                      @endforeach
                      @else
                      <p class="fs-7 mb-0">aucun Sous_Progamme</p>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span>
              <ul id="father2" style="display:none">
                @foreach($portf['sous_program'] as $souportf)
                <li>
                @if($souportf['TotalAE'] == $souportf['init_AE'] && $souportf['TotalCP'] == $souportf['init_CP'])
                <span class="member" id="{{$souportf['id_sous_prog']}}">
                @else
                <span class="member alert_func" id="{{$souportf['id_sous_prog']}}">
                @endif
                <div class="edit-zone"><i class="fas fa-edit update-handl"></i></div>
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">{{$souportf['data']['nom_sous_prog']}}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">AE : {{$souportf['TotalAE']}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0">CP :{{$souportf['TotalCP']}}</h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div>
                      @foreach($souportf['Action'] as $act)
                        <p class="fs-7 mb-0">Action : {{$act['num_act'] }}</p>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span> 
                <ul id="father3" style="display:none">
                @foreach($souportf['Action'] as $act)
                  <li>
                  @if(count($act['sous_action'])>0)
                  @foreach($act['sous_action'] as $sous_act)
                  @if($sous_act['num_act'] != $act['num_act'])
                  <span class="member" id="{{$act['num_act']}}">
                  @else
                  <span class="member" id="act_{{$act['num_act']}}">
                  @endif
                  @endforeach
                  @endif
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Action: {{$act['num_act'] }}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">AE : {{$act['TotalAE']}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0">CP :{{$act['TotalCP']}}</h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div style="display:flex;">
                      @if(count($act['sous_action'])>0)
                      @foreach($act['sous_action'] as $sous_act)
                      @if($sous_act['num_act'] != $act['num_act'])
                        <p class="fs-7 mb-0">Sous Action :{{$sous_act['num_act']}} </p>
                       @else
                       @foreach($sous_act['Tports'] as $key=>$values)
                       <div class="T-holder"> 
                        <p class="fs-7 mb-0"> {{$key}} </p>
                        <div class="TotalT-holder">
                          <p>AE : {{$values['total'][0]['values']['totalAE']}} </p>
                          <p>CP : {{$values['total'][0]['values']['totalCP']}} </p>
                        </div>
                        </div>
                      @endforeach
                       @endif 
                      @endforeach
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span>
            <ul id="father4" style="display:none;">
            @foreach($act['sous_action'] as $sous_act)
            @if($sous_act['num_act'] != $act['num_act'])
                  <li>
                <span class="member" id="sact-{{$sous_act['num_act']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous Action: {{$sous_act['num_act'] }}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">AE : {{$sous_act['TotalAE']}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0">CP :{{$sous_act['TotalCP']}}</h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div class="Port-info-holder">
                      @foreach($sous_act['Tports'] as $key=>$values)
                       <div class="T-holder"> 
                        <p class="fs-7 mb-0">{{$key}} </p>
                        <div class="TotalT-holder">
                          <p>AE : {{$values['total'][0]['values']['totalAE']}} </p>
                          <p>CP : {{$values['total'][0]['values']['totalCP']}} </p>
                        </div>
                        </div>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span>
          @else
          
          @endif
              @endforeach
              <li>
                  <span class="member">
                  <button class="add-btn" id="{{$act['num_act'] }}_act">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button> 
                  </li>
            </ul>
                </li>
                  @endforeach
                  <li>
                  <span class="member">
                  <button class="add-btn" id="{{$souportf['id_sous_prog']}}_sprog">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button> 
                  </li>
                </ul>
                @endforeach
                <li>
                <span class="member">
                <button class="add-btn" id=" {{$portf['id_prog']}}_prog">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                </button> 
                </li>
               </ul>
              </li>
            @endforeach
            <li>
                <span class="member">
                <button class="add-btn" id="{{$allport['id']}}_all">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button> 
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
 </div>

 <div class="float-export">
    <div class="folder-box">
    <a href="#">
    <i class="fas fa-print"></i>
    </a>
    </div>
</div>

<div class="modif-contiant">
</div>
<div class="modif-handler" style="display:none;">
  <div>
    <p> Modfication : <p id="id_sprog_modif"></p></p>
    <form id="update_art_handler">
    <div class="form-group">
          <label for="input1">Article</label>
          <select type="text" class="form-control" id="id" placeholder="Entrer le Nom du Programme">
           <option value="0" >Selectionner Article</option>
           @foreach ($art as $key=>$actelement )
           <option value="{{$actelement['id_art']}}" >{{$actelement['nom_art'].' / '.$actelement['code_art']}}</option>
           @endforeach
          </select>
        </div>
        <hr>
        <div class="form-group">
        <fieldset>
        <legend>Choisir Les Port</legend>
        <div class="Tchecks">
        <div class="Tfields" >
        <label for="Tports">T1</label>
         <input type="checkbox" class="form-check-input" id="T1" name="interest" value="T1" />
         <div id="T1-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T1" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T1" name="interest" />
         </div>
         </div>
          
         <div class="hr-vert"></div>


        <div class="Tfields" >
        <label for="Tports">T2</label>
         <input type="checkbox" class="form-check-input" id="T2" name="interest" value="T2" />
         <div id="T2-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T2" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T2" name="interest" />
         </div>
         </div>
         
         <div class="hr-vert"></div>

         <div class="Tfields" >
        <label for="Tports">T3</label>
         <input type="checkbox" class="form-check-input" id="T3" name="interest" value="T3" />
         <div id="T3-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T3" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T3" name="interest" />
         </div>
         </div>
         
         <div class="hr-vert"></div>

         <div class="Tfields" >
        <label for="Tports">T4</label>
         <input type="checkbox" class="form-check-input" id="T4" name="interest" value="T4" />
         <div id="T4-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T4" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T4" name="interest" />
         </div>
         </div>
         </div>
        </fieldset>
        </div>
        <hr>


        <div class="Radio-ids">
        <div>
        <label for="Tports">Interieur</label>
         <input type="radio" class="form-check-input" id="intr" name="type_modif" value="inter" />
        </div>
        <div>
        <label for="Tports">Exterieur</label>
         <input type="radio" class="form-check-input" id="extr" name="type_modif" value="exter" />
        </div>
        </div>

        <hr>

        <div class="add-envoi">

        </div>

        <div class="form-group">
        <label for="input1">Action a modifier</label>
          <select type="text" class="form-control" id="id_cible" placeholder="Entrer le Nom du Programme">
           <option value="0" >Selectionner Article</option>
            <option value="1" >Action 01</option>
            <option value="2" >Action 01</option>
          </select>
        </div>
      </div>
    </form>
    <button class="button-70" id="button-71" role="button">modifier</button></div>
  </div>
 </div>


<div class="confirm-justfie">
 
</div>

</body>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/treeHandles.js')}}"></script>
<script>
  var path=Array();
  var path3=Array();
 document.querySelectorAll('.member').forEach(member => {
  member.addEventListener('dblclick', function(event) {
    const children = member.nextElementSibling;
    if (children) {
      if (children.style.display === 'flex') {
     
        children.style.display = 'none';
      } else {
        children.style.display = 'flex';
      }
    }
  });
  });
  $(document).ready(function(){
    $('.member').on('dblclick',function(){
    id=$(this).attr('id');
    
    var index=path.indexOf(id)
    if( index !== -1)
    {
      path.splice(index);
      console.log('testing path '+JSON.stringify(path.length-1))
      var idfather="#father"+path.length
      console.log('t fther'+idfather)
      if(idfather == '#father1')
    {
      console.log('deleting part')
    }
      var listItemsWithNestedUl = $(''+idfather).find('ul');

// Iterate over and log each of these <li> elements
listItemsWithNestedUl.each(function(){
  if ($(this).css('display') === 'flex' && $(this).attr('id') != 'father4') {
                        console.log('displaying');
                    }
                    else
                    {
                      var fap=$(this).attr('id')
                      if($(this).attr('id') == 'father2')
                      console.log('display out'+fap )
                    }
});}
    else
    {
      path.push(id);
      path3.push(id);
    }
    var typeact=id.split('_',2)
    console.log('-<<'+JSON.stringify(path)+"-->>"+JSON.stringify(typeact))
    if(typeact[0] =='act')
    {
      $(this).on('click',function(){
  window.location.href='/testing/Action/'+path3[0]+'/'+path3[1]+'/'+path3[2]+'/'+path3[3]+'/'
      })
    
    }
    if(typeact[0] == 'sact')
    {
    $(this).on('click',function(){
     window.location.href='/testing/S_action/'+path3[0]+'/'+path3[1]+'/'+path3[2]+'/'+path3[3]+'/'+typeact[1]+'/'
      })
   
    }
  })
  $('.add-btn').on('click',function(){
            var id = $(this).attr("id");
            var indice=id ;
            console.log('i m the level '+indice)  
            window.location.href='/creation/from/'+id;
            var  news;
        })

})

</script>
</html>
