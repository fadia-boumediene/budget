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
        <ul>
          <li>
              <span class="member" id="Portfail">

                <!--  -->

                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Portfail</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">100,820,155 DZ</h4>
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
            <ul style="display:none;">
            @foreach($allport['prgrammes'] as $portf)
              <li>
              <span class="member" id="{{$portf['id_prog']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Programme :{{$portf['id_prog']}}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"> AE :{{$portf['data']->AE_porg}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0"> CP :{{$portf['data']->CP_prog}}</h4>
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
              <ul style="display:none">
                @foreach($portf['sous_program'] as $souportf)
                <li>
                <span class="member" id="{{$souportf['id_sous_prog']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous Programme:{{$souportf['id_sous_prog']}}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">AE : {{$souportf['data']->AE_sous_porg}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0">CP :{{$souportf['data']->CP_sous_prog}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0">number :{{count($souportf['Action'])}}</h4>
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
                
                <ul style="display:none">
                @foreach($souportf['Action'] as $act)
                  <li>
                <span class="member" id="act-{{$souportf['id_sous_prog']}}">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Action: {{$act['num_act'] }}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">114,000,000 DZ</h4>
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
                      @foreach($act['sous_action'] as $sous_act)
                        <p class="fs-7 mb-0">Action : </p>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span>
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
 document.querySelectorAll('.member').forEach(member => {
  member.addEventListener('click', function(event) {
    const children = member.nextElementSibling;
    if (children) {
      if (children.style.display === 'flex') {
        children.style.display = 'none';
        if(member.id == 'Portfail')
        {
          path=Array();
        }
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
    }
    else
    {
      path.push(id);
    }
    var typeact=id.split('-')
    console.log('-<<'+JSON.stringify(path)+"-->>"+JSON.stringify(typeact))
    if(typeact[0] =='act')
    {
      window.location.href='/testing/Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+typeact[1]+'/'
    }
    if(id =='S_ACTION-002' || id =='S_ACTION-001')
    {
       window.location.href='/testing/S_Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'+path[4]+'/'
    }
  })
})

</script>
</html>
