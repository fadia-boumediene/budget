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
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link
        rel="stylesheet"
        href="https://unpkg.com/@patternfly/patternfly/patternfly.css"
        crossorigin="anonymous"
      >
<script>
  var path=[]
var paths=@json($paths);
console.log('te'+JSON.stringify(path))
Object.entries(paths).forEach(([code,value])=>{
  path.push(value)
})
</script>
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
       
        @foreach($paths as $key =>$value)
      <!-- path insert -->
      <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >{{$key}} :</p>
      <p> {{$value}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->


      <!-- this part for all froms at same-->

    

      <!-- end -->

       @endforeach
   
    </div>
  </div>
  @if($leng == 4)
  <div class="form-container" id="creati-sous_act">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° Sous_ACTION</label>
                        <input type="text" class="form-control" id="num_s_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Sous_ACTION</label>
                        <input type="text" class="form-control" id="nom_s_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous_ACTION</label>
                        <input type="number" class="form-control" id="AE_s_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_ACTION</label>
                        <input type="number" class="form-control" id="CP_s_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
                 @endif

                 @if($leng == 3)
  <div class="form-container" id="creati-act">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
                 @endif

                 @if($leng == 2)
  <div class="form-container" id="creati-sous_prog">

                 <form >
                        <div class="form-group">
                        <label for="input1">N° Sous_Programme</label>
                        <input type="text" class="form-control" id="num_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Sous_Programme</label>
                        <input type="text" class="form-control" id="nom_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous_Programme</label>
                        <input type="number" class="form-control" id="AE_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_Programme</label>
                        <input type="number" class="form-control" id="CP_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_sousProg">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg2">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
    </div>                    
    <div class="form-container" id="creati-act" style="display:none">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
        </div>
                 @endif


                 @if($leng == 1)

                 <div class="form-container" id="creati-prog">

                 <form>
                        <div class="form-group">
                        <label for="input1">N° Programme</label>
                        <input type="text" class="form-control" id="num_prog" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Programme</label>
                        <input type="text" class="form-control" id="nom_prog" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Programme</label>
                        <input type="number" class="form-control" id="AE_prog" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Programme</label>
                        <input type="number" class="form-control" id="AE_prog" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_portef">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_prog">
                        <button class="btn btn-primary" id="add-prg1">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
    </div>                    
                
  <div class="form-container" id="creati-sous_prog" style="display:none">

                 <form >
                        <div class="form-group">
                        <label for="input1">N° Sous_Programme</label>
                        <input type="text" class="form-control" id="num_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Sous_Programme</label>
                        <input type="text" class="form-control" id="nom_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous_Programme</label>
                        <input type="number" class="form-control" id="AE_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_Programme</label>
                        <input type="number" class="form-control" id="CP_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_sousProg">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_sprog">
                        <button class="btn btn-primary" id="add-prg2">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
    </div>                    
    <div class="form-container" id="creati-act" style="display:none">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_act">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
        </div>
                 @endif
                 <script>var path3=Array()</script>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/prousuiv.js')}}"></script>
 </body>

</html>