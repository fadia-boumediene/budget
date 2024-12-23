<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
    <a class="element" href="http://127.0.0.1:8000">
      <i class="fas fa-tachometer-alt"></i> Tableau du Portefeuille
      </a>
      @if(isset($port) || isset($allport) || isset($paths))
      @if(isset($port))
      <a class="element" href="/Portfail/{{$port}}">
      @else
        @if(isset($paths))
        <a class="element" href="/Portfail/{{$paths['code_port']}}">
        @else
      <a class="element" href="/Portfail/{{$allport['id']}}">
        @endif
      @endif
      <i class="fas fa-tools"></i> Suivi des Portefeuilles
      </a>
      @if( !isset($port) && !isset($prog) && !isset($sous_prog) && !isset($act))
      <a class="element" href="#">
      <div class="update-handl" style="display: flex;align-items: flex-start;justify-content: flex-start;flex-wrap: nowrap;">
        <i class="fas fa-edit"></i>
        <h6 >Creation Modifcation</h6>
      </div>
    </a>
    @endif
      @endif
   
      @if( isset($port) && isset($prog) && isset($sous_prog) && isset($act))
      @if(isset($s_act))
    <a class="element" href="/testing/{{$port}}/{{$prog}}/{{$sous_prog}}/{{$act}}/{{$s_act}}/pdf" target="_blank">
      <i class="fas fa-calendar-check"></i> DPA à imprimer
    </a>
    @else
    <a class="element" href="/testing/{{$port}}/{{$prog}}/{{$sous_prog}}/{{$act}}/{{$act}}/pdf" target="_blank">
      <i class="fas fa-calendar-check"></i> DPA à imprimer
    </a>
    @endif
    @endif
      <a class="element" href="/testing/Action/{port}/{prog}/{sous_prog}/{act}/">
        <i class="fas fa-wrench"></i> Détails des Portes
      </a>
  </div>
  <div class="menu-container-btn">
    <div class="menu-toggle-btn">
      <label class="menu-btn text-center" for="menu-toggle">
          <i class="fa fa-close"></i>
          <i class="fa fa-bars"></i>
        </label>
    </div>
  </div>
</div>
