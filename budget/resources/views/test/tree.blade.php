<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portfail</title>

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

 <div class="container">
 <div class="container family-tree">
    <div class="row justify-content-center">
      <div class="col-12 tree">
        <ul id="father0">
          <li>
              <span class="member" id="Portfail">

                <!--  -->

                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Portfail</h5>
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
              <span class="member" id="{{$portf['id_prog']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Programme :{{$portf['id_prog']}}</h5>
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
                      <br>
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
                <span class="member" id="{{$souportf['id_sous_prog']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous Programme:{{$souportf['id_sous_prog']}}</h5>
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
                  <span class="member" id="{{$souportf['id_sous_prog']}}">
                  @else
                  <span class="member" id="act-{{$souportf['id_sous_prog']}}">
                  @endif
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
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
                      <div>
                      @if(count($act['sous_action'])>0)
                      @foreach($act['sous_action'] as $sous_act)
                        <p class="fs-7 mb-0">Sous Action :{{$sous_act['num_act']}} </p>
                      @endforeach
                      @else
                      @foreach($act['Tports'] as $key=>$values)
                       <div class="T-holder"> 
                        <p class="fs-7 mb-0">{{$key}} </p>
                        <div class="TotalT-holder">
                          <p>AE : {{$values['total'][0]['values']['totalAE']}} </p>
                          <p>CP : {{$values['total'][0]['values']['totalCP']}} </p>
                        </div>
                        </div>
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
                  <li>
                <span class="member" id="s_act-{{$souportf['id_sous_prog']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
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
              @endforeach
              <li>
                  <span class="member">
                  <a href="{{route('creation.portfail')}}">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </a> 
                  </li>
            </ul>
                </li>
                  @endforeach
                  <li>
                  <span class="member">
                  <a href="{{route('creation.portfail')}}">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </a> 
                  </li>
                </ul>
                @endforeach
                <li>
                <span class="member">
                  <a href="{{route('creation.portfail')}}">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </a> 
                </li>
               </ul>
              </li>
            @endforeach
            <li>
                <span class="member">
                  <a href="{{route('creation.portfail')}}">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </a> 
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
 </div>



</body>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script>
  var path=Array();
  var path3=Array();
 document.querySelectorAll('.member').forEach(member => {
  member.addEventListener('click', function(event) {
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
    $('.member').on('click',function(){
    id=$(this).attr('id');
    var index=path.indexOf(id)
    if( index !== -1)
    {
      path.splice(index+1);
      console.log('testing path '+JSON.stringify(path.length-1))
      var idfather="#father"+path.length
      console.log('t fther'+idfather)
      let listItemsWithNestedUl = $(''+idfather).find('ul');

// Iterate over and log each of these <li> elements
listItemsWithNestedUl.each(function(){
  if ($(this).css('display') === 'flex' && $(this).attr('id') != 'father4') {
                        // If it's hidden, set display to flex
                        $(this).css('display', 'none');
                    }
});}
    else
    {
      path.push(id);
      path.push3(id);
    }
    var typeact=id.split('-')
    console.log('-<<'+JSON.stringify(path)+"-->>"+JSON.stringify(typeact))
    if(typeact[0] =='act')
    {
      window.location.href='/testing/Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+typeact[1]+'/'
    }
    if(typeact[0] =='s_act')
    {
       window.location.href='/testing/S_action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'+typeact[1]+'/'
    }
  })
})

</script>
</html>
