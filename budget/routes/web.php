<?php

use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\SousProgramme;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\portfeuilleController;
use App\Http\Controllers\programmeControlleur;
use App\Http\Controllers\sousProgrammeController;
use App\Http\Controllers\initPortController;
use App\Http\Controllers\actionController;
use App\Http\Controllers\sousActionController;
use App\Http\Controllers\groupOperationController;
use App\Http\Controllers\opeartionController;
use App\Http\Controllers\sousOperationController;
use App\Http\Controllers\modificationController;
Route::get('/', function () {
 $portfs =Portefeuille::get();
    return view('welcome',compact('portfs'));
});
Route::get('/testing',function (){
return view('test.carsoule');
});
//===============ROUTE PORTEFEUILLE==============================
Route::controller(portfeuilleController::class)->group(function(){
    Route::get('/Portfail/{id}','affich_portef')->name('home.portfail');
    Route::get('/Form','form_portef')->name('form.portfail'); //afficher formulaire d ajout
    Route::post('/creation','creat_portef')->name('creation.portfail');
    Route::get('/creation/from/{path}','show_prsuiv')->name('creation.show_prsuiv');
    Route::get('/check-portef','check_portef')->name('check.portfail');
    Route::get('/update-portef','update_portef')->name('update.portfail');
    Route::post('/upload-pdf', 'uploadPDF')->name('upload.pdf');
});

//===============ROUTE PROGRAMME==============================
Route::controller( programmeControlleur::class)->group(function(){
    Route::get('/Programme/{num_portefeuil}','affich_prog')->name('home.programme');
    Route::post('/creationProg','creat_prog')->name('creation.programme');
    Route::get('/check-prog','check_prog')->name('check.prog');


});

//===============ROUTE SOUS PROGRAMME==============================
Route::controller(sousProgrammeController::class)->group(function(){
    Route::get('/SousProgramme/{num_prog}','affich_sou_prog')->name('home.sousProgramme');
    Route::post('/creationSousProg','create_sou_prog')->name('creation.souProgramme');
    Route::get('/check-sousprog','check_sous_prog')->name('check.sousprog');

});

//===============ROUTE PORTE INITIALE==============================
Route::controller(initPortCntroller::class)->group(function(){
    Route::post('/creationPort','create_port')->name('creation.porte');

});

//===============ROUTE ACTION==============================
Route::controller(actionController::class)->group(function(){
    Route::get('/Action','affich_action')->name('action.detail');
    Route::get('/Action/{id}','affich_action')->name('actikon');
    Route::post('/creationAction','create_action')->name('creation.action');
    Route::get('/check-action','check_action')->name('check.action');

});

//===============ROUTE SOUS ACTION==============================
Route::controller(sousActionController::class)->group(function(){
    Route::post('/creationsousAction','create_sousaction')->name('creation.sousaction');
    Route::get('/allaction/{numport}','allact')->name('action.lists');
});

//===============ROUTE GROUPE D'OPERATIONS==============================
Route::controller(groupOperationController::class)->group(function(){
   Route::get('/testing/S_action/{port}/{prog}/{sous_prog}/{act}/{s_act}/{T}', 'insertDPA');

});

//===============ROUTE  OPERATION==============================
Route::controller(opeartionController::class)->group(function(){
    Route::get('/testing/Ss_Action/{port}/{prog}/{sous_prog}/{act}/{s_act}', 'calculerEtEnvoyer');
    Route::get('/testing/S_action/{port}/{s_act}/{T}', 'afficherDPIA');



    Route::get('/testing/S_action/{s_act}', 'afficherDPIAWithoutT');
    Route::get('/testing/codeSousOperation/{s_act}', 'checkSousOperationExist');
   // Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}', 'calculerEtEnvoyer');
});

//===============ROUTE SOUS OPERATION==============================
Route::controller(sousOperationController::class)->group(function(){
    Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}','AffichePortsAction');
    Route::get('/testing/S_action/{port}/{prog}/{sous_prog}/{act}/{s_act}','AffichePortsSousAct');
    Route::get('/testing/{port}/{prog}/{sous_prog}/{act}/{s_act}/pdf','impressionpdf');
    Route::get('/testing/{port}/{prog}/{sous_prog}/{act}/pdf','impressionpdf');
});
//===============ROUTE modification==============================
Route::controller(modificationController::class)->group(function(){
    Route::post('/update','updateSousOperation');
    Route::post('/updateModif','insertModif');


});
Route::controller(initPortController::class)->group(function(){
    Route::post('/init_ports','create_sou_prog')->name('init.ports');
});


/*Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}/',function ($port,$prog,$sous_prog,$act){



        return view('Action-in.index',compact('port','prog','sous_prog','act'));
        });

        //affiche les portes
       Route::get('/testing/S_action/{port}/{prog}/{sous_prog}/{act}/{s_act}/',function ($port,$prog,$sous_prog,$act,$s_act){



            return view('Action-in.index',compact('port','prog','sous_prog','act','s_act'));
            });
*/
