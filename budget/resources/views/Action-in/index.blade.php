<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTION</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/tableTemplat-new.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link
        rel="stylesheet"
        href="https://unpkg.com/@patternfly/patternfly/patternfly.css"
        crossorigin="anonymous"
      >
</head>
<body>
@include('side_bar.side-barV1')
<!-- Container for Car Cards -->
<div>
 {{--@include('progress_step.progress_step')--}}
 <br>
 </div>
 <div class="wallet-path">
    <div class="the-path">
      <!-- path insert -->
      <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >code :</p>
      <p> {{$port}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->
       <!-- path insert -->
       <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >Programme :</p>
      <p> {{$prog}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->
       <!-- path insert -->
       <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >S_Programme :</p>
      <p> {{$sous_prog}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->
       <!-- path insert -->
       <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >Action :</p>
      <p> {{$act}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->
       @if( isset($s_act))
        <!-- path insert -->
        <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >S_Action :</p>
      <p> {{$s_act}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->
       @endif
      <!-- confirme button in -->
      <div class="change_app">
      </div>
      <!-- end -->
    </div>
  </div>
 <div class="container">
    <div class="T-handle">
        <div class="list-T-hanlde">
                <div class="TP-handle" id="T_port1">
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                    <!--i class="fas fa-door-closed T-icon"></i-->
                    <i class="fas fa-door-closed T-icon icon icon-card"></i>
                    <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 1</p>
                    <p class="card-description-T">AE : {{$resultats['T1']['total'][0]['values']['totalAE']}} DZ</p>
                    <p class="card-description-T">CP : {{$resultats['T1']['total'][0]['values']['totalCP']}} DZ</p>
                  </div>
                </div>
                </div>
                <div class="TP-handle" id="T_port2">
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                  <i class="fas fa-door-closed T-icon icon icon-card"></i>
                  <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 2</p>
                    <p class="card-description-T">AE : {{$resultats['T2']['total'][0]['values']['totalAE']}} DZ</p>
                    <p class="card-description-T">CP : {{$resultats['T2']['total'][0]['values']['totalCP']}} DZ</p>
                  </div>
                </div>
                </div>
                <div class="TP-handle" id="T_port3">
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                  <i class="fas fa-door-closed T-icon icon icon-card"></i>
                  <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 3</p>
                    <p class="card-description-T">AE : {{$resultats['T3']['total'][0]['values']['totalAE']}} DZ</p>
                    <p class="card-description-T">CP : {{$resultats['T3']['total'][0]['values']['totalCP']}} DZ</p>
                  </div>
                </div>
                </div>
                <div class="TP-handle" id="T_port4">

                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                  <i class="fas fa-door-closed T-icon icon icon-card"></i>
                  <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 4</p>
                    <p class="card-description-T">AE : {{$resultats['T4']['total'][0]['values']['totalAE']}} DZ</p>
                    <p class="card-description-T">CP : {{$resultats['T4']['total'][0]['values']['totalCP']}} DZ</p>
                  </div>
                </div>
                </div>
        </div>
        <hr>
        <div class="table-T-handle">
            <table class="responsive-table" id="T-tables">
            <thead>
	         </thead>
	<tbody>
	</tbody>
  <tfoot></tfoot>
            </table>
        </div>
</div>
    </div>
 <div class="container">
 <div class="grid-container" id="Tport-handle">
        <!-- Card 1 -->
        <div class="col-md-15 hover-container">
            <div class="card">
                <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 1</h5>
                    <p class="card-text"> DEPENSES  DE PERSONNEL</p>
                    <button class="btn btn-primary" id="T1">Vers Tableau Operation</button>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-15 hover-container">
            <div class="card">
            <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 2</h5>
                    <p class="card-text" style="text-align:center;">DEPENSES DE FONCTIONNEMENT DES SERVICES </p>
                    <button class="btn btn-primary" id="T2">Vers Tableau Operation</button>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-15 hover-container">
            <div class="card">
            <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 3</h5>
                    <p class="card-text">DEPENSES D'INVESTISSEMENT </p>
                    <button class="btn btn-primary" id="T3" >Vers Tableau Operation</button>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-15 hover-container">
            <div class="card">
            <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 4</h5>
                    <p class="card-text"> DEPENSES DE TRANSFERT  </p>
                    <button class="btn btn-primary" id="T4">Vers Les Operation</button>
                </div>
            </div>
        </div>
    </div>
 </div>

    <div class="Tsop_handler Tsop_handler_h">
      
    </div>


    </div>
   </div>
 <div class="reload-handle reload-hidden" id="reloading">
  <div class="reload"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a12" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#C6BC0A"></stop><stop offset=".3" stop-color="#C6BC0A" stop-opacity=".9"></stop><stop offset=".6" stop-color="#C6BC0A" stop-opacity=".6"></stop><stop offset=".8" stop-color="#C6BC0A" stop-opacity=".3"></stop><stop offset="1" stop-color="#C6BC0A" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a12)" stroke-width="29" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#C6BC0A" stroke-width="29" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
  </div>
</div>
</body>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
  var mount_chang=false; // this for showing if changing in table;
  var jsonpath1="{{asset('assets/Titre/dataT1.json')}}"
  var jsonpath2="{{asset('assets/Titre/dataT2.json')}}"
  var jsonpath3="{{asset('assets/Titre/dataT3.json')}}"
  var jsonpath4="{{asset('assets/Titre/dataT4.json')}}"
  var yearport="{{$years}}"
  var counter=0;
  @if(isset($s_act))
  var path3=['{{$port}}','{{$prog}}','{{$sous_prog}}','{{$act}}','{{$s_act}}']
  @else
  var path3=['{{$port}}','{{$prog}}','{{$sous_prog}}','{{$act}}']
  @endif
  $(document).ready(function(){
    $('.Tsop_handler').on('dblclick',function(){
      console.log('click')
      $(this).addClass('Tsop_handler_h');
      $('#Tport-vals').removeClass('T4')
      $('.Tsop_add_handle').empty()
    })
  })
</script>
</html>
