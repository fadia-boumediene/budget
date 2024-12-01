<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portefeuille</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
        <link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
        <link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

        <link
                rel="stylesheet"
                href="https://unpkg.com/@patternfly/patternfly/patternfly.css"
                crossorigin="anonymous"
              >

        <!-- Styles -->
    </head>
    <body>
    @include('side_bar.side-barV1')
<!-- Container for Car Cards -->
<div>
 {{--@include('progress_step.progress_step')--}}
 <br>
 </div>
 @php
 $j=1;
 @endphp
<div class="container">

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" style="">

  <div class="carousel-indicators">

    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    @for($i=2 ; $i < count($portfs) ; $i+=3)

    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{$j}}" aria-label="Slide {{$j}}"></button>
    @php
    $j++;
    @endphp
  @endfor
  </div>
  <div class="row justify-content-center">


  <div class="carousel-inner">
    <!-- First Car Card -->
    <div class="carousel-item active">
    <div class="col-md-6 col-lg-4 mb-4 card-mar-right">
      <div class="card" >
        <div class="card-photo-holder" id="create-dir">
          <i class="fas fa-plus-circle icon-car"></i>
        </div>
        <div class="card-body">
        <h5 class="card-title">Création d'un nouveau portefeuille pour l'année</h5>
        <p class="card-text">Cela permet de démarrer la création des portefeuilles pour chaque année.</p>

        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4 card-mar-right">
      @if(isset($portfs[0]))
      <div class="card">
        <div class="card-photo-holder" id="{{ $portfs[0]->num_portefeuil}}">
           <i class="fas fa-folder-open icon-card"></i> 
        </div>
        <div class="card-body">
        <h5 class="card-title">Portefeuille {{ $portfs[0]->num_portefeuil }} du : {{$portfs[0]->Date_portefeuille}}</h5>
        <p class="card-text">Cela permet de consulter et d'effectuer des mouvements ou des transactions depuis le portefeuille.</p>

        </div>
      </div>
      @endif
    </div>
    <div class="col-md-6 col-lg-4 mb-4 card-mar-right">
    @if(isset($portfs[1]))
      <div class="card">
        <div class="card-photo-holder" id="{{ $portfs[1]->num_portefeuil}}">
          <i class="fas fa-folder-open icon-card"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">Portefeuille {{ $portfs[1]->num_portefeuil}} du : {{$portfs[1]->Date_portefeuille}}</h5>
          <p class="card-text">Cela permet de consulter et d'effectuer des mouvements ou des transactions depuis le portefeuille.</p>
        </div>
      </div>
      @endif
    </div>
  </div>


    <!-- Second Car Card -->
    @for($i=2 ; $i < count($portfs) ; $i+=3)
    <div class="carousel-item">
    <div class="col-md-6 col-lg-4 mb-4 card-mar-right">
      @if(isset($portfs[$i]) && $i < count($portfs))
      <div class="card">
        <div class="card-photo-holder" id="{{$portfs[$i]->num_portefeuil}}">
          <i class="fas fa-folder-open icon-card"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">Portefeuille {{$portfs[$i]->num_portefeuil}} du : {{$portfs[$i]->Date_portefeuille}}</h5>
          <p class="card-text">Cela permet de consulter et d'effectuer des mouvements ou des transactions depuis le portefeuille.</p>
        </div>
      </div>
    </div>
    @endif
    <div class="col-md-6 col-lg-4 mb-4 card-mar-right">
    @if(isset($portfs[$i+1]) && $i+1 < count($portfs))
   
      <div class="card">
        <div class="card-photo-holder" id="{{$portfs[$i+1]->num_portefeuil}}">
          <i class="fas fa-folder-open icon-card"></i>
        </div>
        <div class="card-body">
        <h5 class="card-title">Portefeuille {{$portfs[$i+1]->num_portefeuil}} du : {{$portfs[$i+1]->Date_portefeuille}}</h5>
        <p class="card-text">Cela permet de consulter et d'effectuer des mouvements ou des transactions depuis le portefeuille.</p>
        </div>
      </div>
    </div>
    @endif
    <div class="col-md-6 col-lg-4 mb-4 card-mar-right">
    @if(isset($portfs[$i+2]) && $i+2 < count($portfs))
      <div class="card">
        <div class="card-photo-holder" id="{{$portfs[$i+2]->num_portefeuil}}">
          <i class="fas fa-folder-open icon-card"></i>
        </div>
        <div class="card-body">
        <h5 class="card-title">Portefeuille {{$portfs[$i+2]->num_portefeuil}} du : {{$portfs[$i+2]->Date_portefeuille}}</h5>
        <p class="card-text">Cela permet de consulter et d'effectuer des mouvements ou des transactions depuis le portefeuille.</p>
        </div>
      </div>
    </div>
    </div>
    @endif
    @endfor
    </div>


  </div>

  </div>
  <br>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




</div>

<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
</body>
<script>

let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
/*  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });*/
  $(document).ready(function(){
    $('.card-photo-holder').on('click',function(){
    //  console.log('{{--route('home.portfail')--}}'+'---'+$(this).attr('id'));
      if($(this).attr('id') == 'create-dir')
      {
        window.location.href='{{route('form.portfail')}}'
      }else{
      window.location.href='/Portfail/'+$(this).attr('id')}
    })
  })
</script>
</html>