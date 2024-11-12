console.log('testing'+JSON.stringify(path))
$(document).ready(function(){
    $('input').focus(function() {
        $(this).removeAttr('style');
    });
    $('.btn-primary').on('click',function(event){
        event.preventDefault(); // Prevents default button behavior
        id=$(this).attr('id')
        var indice=0;
        var isEmpty=false
        var formId = $(this).parents('.form-container').attr('id');
        console.log('this is '+id+'and form id'+formId);
        $('#' + formId+' form').find('input').each(function(){
            console.log('before the loop')
            var inputValue = $(this).val();

            // Check if the input is not empty
            if (inputValue.trim() === "") 
             {
                isEmpty = true;
                indice++;
             }
       

        if (isEmpty) {
            if(indice < 2)
            {
            alert("Veuillez remplir tous les champs obligatoires.");
            }
            $(this).css('box-shadow','0 0 0 0.25rem rgb(255 0 0 / 47%)')
        }
    });
      


    if(id == "add-prg3")
    {
      
      let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                    if (userResponse) {
                                        // Récupération des informations de l'action
                                        $('#confirm-holder_act').empty()
                                        $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var id_sou_prog = path[2];
                                        var numaction_year = num_act + id_sou_prog;
                                        var nexthop = '<div class="pinfo-handle">' +
                                         '<i class="fas fa-wallet"></i>' +
                                         '<p >Action :</p>' +
                                          '<p>' + num_act + '</p>' +
                                           '</div>' +
                                          ' <div class="next-handle">' +
                                          '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                                          '</div>'
                                        // Création du formData pour l'action
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: path[2],
                                            //id_prog: path[1],
                                            //id_porte: path[0],
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            _method: 'POST'
                                        };

                                        // Envoi de l'Action via Ajax
                                        $.ajax({
                                            url: '/creationAction',
                                            type: 'POST',
                                            data: formdata_act,
                                            success: function (response) {
                                                if (response.code === 200 || response.code === 404) {
                                                    // Ajout du numéro de l'action au chemin
                                                    path.push(numaction_year);
                                                    path3.push(num_act);
                                                  
                                                    console.log('A path: ' + JSON.stringify(path));
                                                    $('#confirm-holder_act').empty()
                                                    $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                                    // Création du formulaire pour la sous-action après l'ajout de l'action
                                                    var prg4 = `<div class="form-container">
                                                           <form>
                                                            <div class="form-group">
                                                            <label for="num_sous_act">N°Sous ACTION</label>
                                                            <input type="text" class="form-control" id="num_sous_act" placeholder="Donner le code Sous ACTION">
                                                           </div>
                                                            <div class="form-group">
                                                                <label for="nom_sous_act">Nom Sous ACTION</label>
                                                            <input type="text" class="form-control" id="nom_sous_act" placeholder="Donner le Nom Sous ACTION">
                                                            </div>
                                                               <div class="form-group">
                                                                <label for="AE_sous_act">AE pour Sous Action</label>
                                                                <input type="number" class="form-control" id="AE_sous_act">
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="CP_sous_act">CP pour Sous Action</label>
                                                            <input type="number" class="form-control" id="CP_sous_act">
                                                               </div>
                                                               <div class="form-group">
                                                                 <label for="date_insert_sou_action">Date Journal</label>
                                                                 <input type="date" class="form-control" id="date_insert_sou_action">
                                                               </div>
                                                               </form>
                                                               <br>
                                                               <button class="btn btn-primary" id="add-prg4">Ajouter Sous Action</button>
                                                               </div>`;

                                                    // Insertion du formulaire pour la sous-action dans le DOM
                                                    $('.the-path').append(nexthop)
                                                    $('#progam-handle').append(prg4);

                                                    // Ajout de l'événement d'ajout pour la sous-action
                                                    $('#add-prg4').on('click', function () {
                                                        console.log('inside sous_action')
                                                        var nom_sous_act = $('#nom_sous_act').val();
                                                        var num_sous_act = $('#num_sous_act').val();
                                                        var dat_inst = $('#date_insert_sou_action').val();
                                                        var numaction_year = path[3];
                                                        var numsousaction_year = num_sous_act + numaction_year;
                                                        // Création du formData pour la sous-action
                                                        var formdata_sous_act = {
                                                            num_sous_action: numsousaction_year,
                                                            nom_sous_action: nom_sous_act,
                                                            date_insert_sous_action: dat_inst,
                                                            num_act: path[3],
                                                            //id_sous_act: path[2],
                                                            //id_prog: path[1],
                                                           // id_porte: path[0],
                                                            //year: year,
                                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                                            _method: 'POST'
                                                        };

                                                        // Envoi de la sous-action via Ajax
                                                        $.ajax({
                                                            url: '/creationsousAction',
                                                            type: 'POST',
                                                            data: formdata_sous_act,
                                                            success: function (response) {
                                                                if (response.code === 200 || response.code === 404) {
                                                                    path.push(numsousaction_year);
                                                                    path3.push(num_sous_act);
                                                                    console.log('path: ' + JSON.stringify(path));

                                                                    // Redirection vers la page suivante après l'ajout de la sous-action
                                                                    alert('testing')
                                                                    window.location.href = 'testing/S_action/' + path.join('/');
                                                                }
                                                            },
                                                            error: function (response) {
                                                                alert('Erreur lors de l\'ajout de la sous-action.');
                                                            }
                                                        });
                                                    });
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action.');
                                            }
                                        });
                                    } else {
                                        // Cas où l'utilisateur n'ajoute pas de sous-action
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var id_sou_prog = path[2];
                                        var numaction_year = num_act + id_sou_prog;

                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
                                            //id_prog: path[1],
                                            //id_porte: path[0],
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            _method: 'POST'
                                        };

                                        $.ajax({
                                            url: '/creationAction',
                                            type: 'POST',
                                            data: formdata_act,
                                            success: function (response) {
                                                if (response.code === 200 || response.code === 404) {
                                                    path.push(numaction_year);
                                                    path3.push(num_act);
                                                    // console.log('path: ' + JSON.stringify(path));
                                                    window.location.href = '/testing/Action/' + path.join('/');
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action.');
                                            }
                                        });
                                    }

    }
    if(id == "add-prg2")
    {
      var parent=$(this).parent() 
      var sou_prog = $('#num_sousProg').val()
                    var nom_sou_prog = $('#nom_sousProg').val();
                    var dat_sou_prog = $('#date_insert_sousProg').val()
                    var ae_sou_prog = $('#AE_sousProg').val();
                    var cp_sou_prog = $('#CP_sousProg').val();
                    var id_prog = path[1];
                    var numsouprog_year = sou_prog + id_prog;
                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var formdatasou_prog = {
                        num_sous_prog: numsouprog_year,
                        nom_sous_prog: nom_sou_prog,
                        date_insert_sousProg: dat_sou_prog,
                        id_program: id_prog,
                        //id_porte: id_port,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'POST'
                    }
                    console.log('data' + JSON.stringify(formdatasou_prog))
                    $.ajax({
                        url: '/creationSousProg',
                        type: "POST",
                        data: formdatasou_prog,
                        success: function (response) {
                            if (response.code == 200 || response.code == 404)
                             {
                             alert(response.message)
                             path.push(numsouprog_year);
                             $('.the-path').append(nexthop)
                             parent.empty();
                             parent.append('<i class="fas fa-wrench"></i>')
                              document.getElementById("creati-act").style.display="block";
                            // path3.push(id_prog);
                              }
    }
  })
}
    if(id == "add-prg1")
    {
     
      var id_prog = $('#num_prog').val();
    var nom_prog = $('#nom_prog').val();
    var Ae_prog = $('#AE_prog').val();
    var Cp_prog = $('#CP_prog').val();
    var numprog_year = id_prog + path[0];
    var nexthop = '<div class="pinfo-handle">' +
        '<i class="fas fa-wallet"></i>' +
        '<p >Programm :</p>' +
        '<p>' + id_prog + '</p>' +
        '</div>' +
        ' <div class="next-handle">' +
        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
        '</div>';
    var date_sort_jour = $('#date_insert_portef').val();
    var parent=$(this).parent()
    var formprogdata = {
        num_prog: numprog_year,
        nom_prog: nom_prog,
        ae_prog:Ae_prog,
        cp_prog:Cp_prog,
        num_portefeuil: path[0],
        date_insert_portef: date_sort_jour,
        _token: $('meta[name="csrf-token"]').attr('content'),
        _method: 'POST'
    }
    $.ajax({
        url: '/creationProg',
        type: "POST",
        data: formprogdata,
        success: function (response) {
            if (response.code == 200 || response.code == 404) {

                alert(response.message)
                path.push(numprog_year);
                $('.the-path').append(nexthop)
                console.log('testing'+numprog_year);
              
               parent.empty();
               parent.append('<i class="fas fa-wrench"></i>')
               document.getElementById("creati-sous_prog").style.display="block";
      }
      else
      {
        alert(response.message)
      }
    }
    })
  }
    })
    
})
