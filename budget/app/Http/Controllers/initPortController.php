<?php

namespace App\Http\Controllers;

use App\Models\initPort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class initPortController extends Controller
{
//===================================================================================
                            // creation du initPort
//===================================================================================
function create_sou_prog(Request $request)
{
    // Validation des données
    $request->validate([
        'AE_init_t1' => 'required',
        'CP_init_t1' => 'required',

        'AE_init_t2' => 'required',
        'CP_init_t2' => 'required',

        'AE_init_t3' => 'required',
        'CP_init_t3' => 'required',

        'AE_init_t4' => 'required',
        'CP_init_t4' => 'required',

    ]);
    //dd(floatval(floatval($request->AE_init_t1)));

    $initPort = new initPort();
    $initPort->AE_init_t1 = floatval($request->AE_init_t1);
    $initPort->CP_init_t1 = floatval($request->CP_init_t1);

    $initPort->AE_init_t2 = floatval($request->AE_init_t2);
    $initPort->CP_init_t2 = floatval($request->CP_init_t2);

    $initPort->AE_init_t3 = floatval($request->AE_init_t3);
    $initPort->CP_init_t3 = floatval($request->CP_init_t3);

    $initPort->AE_init_t4 = floatval($request->AE_init_t4);
    $initPort->CP_init_t4 = floatval($request->CP_init_t4);

    $initPort->code_t1 = $request->code_t1;
    $initPort->code_t2 = $request->code_t2;
    $initPort->code_t3 = $request->code_t3;
    $initPort->code_t4 = $request->code_t4;
    $initPort->date_init = $request->date_init;
    $initPort->num_sous_prog = $request->num_sous_prog;


    $initPort->save();



  //  dd($initPort);
    if ($initPort) {
        return response()->json([
            'success' => true,
            'message' => 'Sous programme ajouté avec succès.',
            'code' => 200,
        ]);
 //dd($initPort);

    } else {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'ajout du sous programme.',
            'code' => 500,
        ]);
    }


}
}
