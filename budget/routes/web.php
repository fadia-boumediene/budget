<?php

use App\Http\Controllers\actionController;
use App\Http\Controllers\portfeuilleController;
use App\Http\Controllers\programmeControlleur;
use App\Http\Controllers\sousProgrammeController;
use App\Http\Controllers\opeartionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/testing',function (){
return view('test.carsoule');
});
Route::get('/testing/tree',function (){
    return view('test.tree');
    });
 /* Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}/',function ($port,$prog,$sous_prog,$act){



        return view('Action-in.index',compact('port','prog','sous_prog','act'));
        });*/
      /* Route::get('/testing/S_Action/{port}/{prog}/{sous_prog}/{act}/{s_act}/',function ($port,$prog,$sous_prog,$act,$s_act){



            return view('Action-in.index',compact('port','prog','sous_prog','act','s_act'));
            });*/
//Route::get('/Portfail',action: [portfeuilleController::class,'affich_portef'])->name('home.portfail');


//===============ROUTE PORTEFEUILLE==============================
Route::controller(portfeuilleController::class)->group(function(){
    Route::get('/Portfail','affich_portef')->name('home.portfail');
    Route::get('/Form','form_portef')->name('form.portfail'); //afficher formulaire d ajout
    Route::post('/creation','creat_portef')->name('creation.portfail');
});

//===============ROUTE PROGRAMME==============================
Route::controller( programmeControlleur::class)->group(function(){
    Route::get('/Programme','affich_prog')->name('home.programme');
    Route::post('/creationProg','creat_prog')->name('creation.programme');
});

//===============ROUTE SOUS PROGRAMME==============================
Route::controller(sousProgrammeController::class)->group(function(){
    Route::get('/SousProgramme','affich_sou_prog')->name('home.sousProgramme');
    Route::post('/creationSousProg','create_sou_prog')->name('creation.souProgramme');
});

//===============ROUTE ACTION==============================
Route::controller(actionController::class)->group(function(){
    Route::get('/Action','affich_action')->name('action.detail');
    Route::post('/creationAction','create_action')->name('creation.action');
});

//===============ROUTE SOUS ACTION==============================
Route::controller(sousActionController::class)->group(function(){
});

//===============ROUTE GROUPE D'OPERATIONS==============================
Route::controller(groupOperationController::class)->group(function(){
});

//===============ROUTE  OPERATION==============================
Route::controller(opeartionController::class)->group(function(){
    Route::get('/testing/S_Action/{port}/{prog}/{sous_prog}/{act}/{s_act}', 'calculerEtEnvoyer');
   // Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}', 'calculerEtEnvoyer');
});

//===============ROUTE SOUS OPERATION==============================
Route::controller(sousOperationController::class)->group(function(){
});
