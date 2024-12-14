<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\initPort;
use Illuminate\Http\Request;
use App\Models\SousProgramme;
use App\Http\Controllers\Controller;

class sousProgrammeController extends Controller
{

//===================================================================================
                            //affichage du SousProgramme
//===================================================================================
    function affich_sou_prog($num_prog)
    {
        // Récupérer les SousProgramme qui ont le même num_prog
            $SousProgramme = SousProgramme::where('num_prog', $num_prog)->get();
            //dd($SousProgramme);
        // Vérifier si des SousProgramme existent
            if ($SousProgramme->isEmpty()) {
                 return response()->json([
                    'success' => false,
                    'message' => 'Aucun Sous programme trouvé pour ce programme.',
                ]);
            }
            else
            {
                return response()->json([
                    'success' => true,
                    'result'=>$SousProgramme,
                    'message' => 'Sous programme trouvé pour ce programme.',
                ]);
            }

        // Retourner les SousProgramme à la vue
             return view('Portfail-in.index', compact('SousProgramme'));
    }

//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_sous_prog(Request $request)
{
    $sousprog = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
    $initPort = initPort::where('num_sous_prog', $request->num_sous_prog)->first();
    // Vérification des données
    //dd($sousprog);
    if ($sousprog && $initPort) {
        return response()->json([
            'exists' => true,

            'num_sous_prog'=>$sousprog->num_sous_prog,
            'nom_sous_prog' => $sousprog->nom_sous_prog,
            'date_insert_sousProg' => $sousprog->date_insert_sousProg,
            'num_prog' =>$sousprog->num_prog,

            'AE_sous_prog' => $sousprog->AE_sous_prog,
            'CP_sous_prog' => $sousprog->CP_sous_prog,

            'T1_AE_init' => $initPort->AE_init_t1,
            'T1_CP_init' => $initPort->CP_init_t1,

            'T2_AE_init' => $initPort->AE_init_t2,
            'T2_CP_init' => $initPort->CP_init_t2,

            'T3_AE_init' => $initPort->AE_init_t3,
            'T3_CP_init' => $initPort->CP_init_t3,

            'T4_AE_init' => $initPort->AE_init_t4,
            'T4_CP_init' => $initPort->CP_init_t4,
        ]);
    }
    else
    {
        if(!isset($initPort))
        {
            return response()->json([
                'exists' => true,
    
                'num_sous_prog'=>$sousprog->num_sous_prog,
                'nom_sous_prog' => $sousprog->nom_sous_prog,
                'date_insert_sousProg' => $sousprog->date_insert_sousProg,
                'num_prog' =>$sousprog->num_prog,
    
                'AE_sous_prog' =>$sousprog->AE_sous_prog,
                'CP_sous_prog' => $sousprog->CP_sous_prog,
    
                'T1_AE_init' => 0,
                'T1_CP_init' => 0,
    
                'T2_AE_init' => 0,
                'T2_CP_init' =>0,
    
                'T3_AE_init' => 0,
                'T3_CP_init' => 0,
    
                'T4_AE_init' => 0,
                'T4_CP_init' =>0,
            ]);
        }

    }


    return response()->json(['exists' => false]);
}
//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                            // creation du SousProgramme
//===================================================================================
public function create_sou_prog(Request $request)
{
    // Validation des données
    $request->validate([
        'num_sous_prog' => 'required',
        'nom_sous_prog' => 'required',
        'date_insert_sousProg' => 'required|date',
        'AE_sous_prog' => 'nullable|numeric',
        'CP_sous_prog' => 'nullable|numeric',
        'T1_AE_init' => 'nullable|numeric',
        'T1_CP_init' => 'nullable|numeric',
        'T2_AE_init' => 'nullable|numeric',
        'T2_CP_init' => 'nullable|numeric',
        'T3_AE_init' => 'nullable|numeric',
        'T3_CP_init' => 'nullable|numeric',
        'T4_AE_init' => 'nullable|numeric',
        'T4_CP_init' => 'nullable|numeric',
        'code_t1' => 'nullable',
        'code_t2' => 'nullable',
        'code_t3' => 'nullable',
        'code_t4' => 'nullable',
        'id_program' => 'required',
    ]);

    // Vérifier si le sous-programme existe
    $sousProgramme = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
    $initPort = initPort::where('num_sous_prog', $request->num_sous_prog)->first();
 
    if ($sousProgramme) {
        // Mise à jour du sous-programme existant
        $sousProgramme->update([
            'nom_sous_prog' => $request->nom_sous_prog,
            'AE_sous_prog' => floatval($request->AE_sous_prog),
            'CP_sous_prog' => floatval($request->CP_sous_prog),
            'date_update_sousProg' => now(),
        ]);

        if ($initPort) {
            // Mise à jour des données dans init_ports
            $initPort->update([
                'AE_init_t1' => $request->T1_AE_init,
                'CP_init_t1' => $request->T1_CP_init,
                'AE_init_t2' => $request->T2_AE_init,
                'CP_init_t2' => $request->T2_CP_init,
                'AE_init_t3' => $request->T3_AE_init,
                'CP_init_t3' => $request->T3_CP_init,
                'AE_init_t4' => $request->T4_AE_init,
                'CP_init_t4' => $request->T4_CP_init,
                'date_update_init' => now(),
            ]);
        }
        else
        {
              // Création des données dans init_ports
        initPort::create([
            'num_sous_prog' => $request->num_sous_prog,
            'date_init' => $request->date_insert_sousProg,
            'code_t1' => $request->code_t1,
            'code_t2' => $request->code_t2,
            'code_t3' => $request->code_t3,
            'code_t4' => $request->code_t4,
            'AE_init_t1' => $request->T1_AE_init,
            'CP_init_t1' => $request->T1_CP_init,
            'AE_init_t2' => $request->T2_AE_init,
            'CP_init_t2' => $request->T2_CP_init,
            'AE_init_t3' => $request->T3_AE_init,
            'CP_init_t3' => $request->T3_CP_init,
            'AE_init_t4' => $request->T4_AE_init,
            'CP_init_t4' => $request->T4_CP_init,
        ]);  
        }
    } else {
        // Création d'un nouveau sous-programme
        $sousProgramme = SousProgramme::create([
            'num_sous_prog' => $request->num_sous_prog,
            'num_prog' => $request->id_program,
            'nom_sous_prog' => $request->nom_sous_prog,
            'AE_sous_prog' => $request->AE_sous_prog,
            'CP_sous_prog' => $request->CP_sous_prog,
            'date_insert_sousProg' => $request->date_insert_sousProg,
        ]);
    // Création des données dans init_ports
    initPort::create([
        'num_sous_prog' => $request->num_sous_prog,
        'date_init' => $request->date_insert_sousProg,
        'code_t1' => $request->code_t1,
        'code_t2' => $request->code_t2,
        'code_t3' => $request->code_t3,
        'code_t4' => $request->code_t4,
        'AE_init_t1' => $request->T1_AE_init,
        'CP_init_t1' => $request->T1_CP_init,
        'AE_init_t2' => $request->T2_AE_init,
        'CP_init_t2' => $request->T2_CP_init,
        'AE_init_t3' => $request->T3_AE_init,
        'CP_init_t3' => $request->T3_CP_init,
        'AE_init_t4' => $request->T4_AE_init,
        'CP_init_t4' => $request->T4_CP_init,
    ]);
    
    }

    // Vérification finale
    if ($sousProgramme && (!$initPort || $initPort->exists)) {
        return response()->json([
            'success' => true,
            'message' => 'Sous programme mis à jour avec succès.',
            'code' => 200,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Erreur lors de l\'ajout ou de la mise à jour des données.',
        'code' => 500,
    ]);
}



}
