<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création du Portfeuille</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/steps.css')}}" rel="stylesheet"/>
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
<div>
 {{-- @include('progress_step.program_steps') --}}
</div>
<div class="font-bk back-bk">
  <div class="wallet-path" style="display:none;">
    <div class="the-path">
      <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >code :</p>
      <p id="w_id"> </p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
    </div>
  </div>
    <div class="wallet-handle">
    <div class="card">
            <div class="card-body"  id="creati-prog">
                <h5 class="card-title">
                    <i class="fas fa-file-alt"></i> Télécharger votre Document
                </h5>
                <form id="pdf-upload-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="num_port">Code du portefeuille</label>
                        <input type="text" class="form-control" id="num_port" placeholder="Entrer le Code du portefeuille">

                    </div>
                    <div class="form-group">
                        <label for="date_crt_portf">Date de sortie du portefeuille</label>
                        <input type="date" class="form-control" id="date_crt_portf" placeholder="Entrer la Date de sortie du portefeuille">
                    </div>
                    <div class="form-group">
                        <label for="nom_journ">Nom du Journal</label>
                        <input type="text" class="form-control" id="nom_journ" placeholder="Entrer le nom du journal">
                    </div>
                    <div class="form-group">
                        <label for="num_journ">Référence du journal</label>
                        <input type="text" class="form-control" id="num_journ" placeholder="Entrer la Référence du journal">
                    </div>
                    <div class="form-group">
                        <label for="AE_portef">AE pour Portefeuille</label>
                        <input type="number" class="form-control" id="AE_portef" placeholder="Entrer AE Portefeuille">
                    </div>
                    <div class="form-group">
                        <label for="CP_portef">CP pour Portefeuille</label>
                        <input type="number" class="form-control" id="CP_portef" placeholder="Entrer CP Portefeuille">
                    </div>
                    <div class="form-group" id="file_holder">
                        <!--label for="inputFile">Journal scanner</label-->
                        <label for="pdf_file">Choisissez un fichier PDF :</label>
                        <input type="file" name="pdf_file" id="pdf_file" accept=".pdf, .jpg, .jpeg, .png">
                    </div>

                </form>
                <br>
                <button type="submit" class="btn btn-primary" id="add-wallet">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
                <div id="message"></div>





            </div>
        </div>
    </div>
    <div id="progam-handle" style="display:none;">
    <div class="form-container" id="creati-prog">
      <form enctype="multipart/form-data">
        <div class="form-group">
          <label for="input1">Code du Programme</label>
          <input type="text" class="form-control" id="num_prog" placeholder="Entrer le Code du Programme">
        </div>
        <div class="form-group">
          <label for="input2">Date insertion Programme :</label>
          <input type="date" class="form-control" id="date_insert_portef">
        </div>
        <div class="form-group">
          <label for="input1">Nom du Programme</label>
          <input type="text" class="form-control" id="nom_prog" placeholder="Entrer le Nom du Programme">
        </div>
        <div class="form-group">
          <label for="inputDate">AE pour Programme</label>
          <input type="number" class="form-control" id="AE_prog" placeholder="Entrer AE Programme">
        </div>
        <div class="form-group">
          <label for="inputDate">CP pour Programme</label>
          <input type="number" class="form-control" id="CP_prog" placeholder="Entrer CP Programme">
        </div>
        </form>

        <br>
        <div id="confirm-holder">
        <div id="file_holder_prog">
        <input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png">
        </div>
        <hr>
        <button class="btn btn-primary" id="add-prg">Ajouter</button>
        </div>
    </div>
    </div>
    <div id="sous_prog-handle">

    </div>
    <div id="act-handle">

    </div>
    <div id="gr_list_handle">
     <div id="T_List-handle">

        <div id="T1-handle">

        </div>
        <div id="T2-handle">

        </div>
        <div id="T3-handle">

        </div>
        <div id="T4-handle">

        </div>
    </div>
    <div id="table-T">
    </div>
    </div>
</div>
<script>
  var jsonpath="{{asset('assets/Titre/dataT1.json')}}"
  var path=new Array();
  var path3=new Array();
</script>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>