<?php

namespace App\Http\Controllers;

use App\Models\SousProgramme;
use Illuminate\Http\Request;

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

    if ($sousprog) {
        return response()->json([
            'exists' => true,
            'nom_sous_prog' => $sousprog->nom_sous_prog,
            'date_insert_sousProg' => $sousprog->date_insert_sousProg,
            'AE_sous_prog'=>$sousprog->AE_sous_prog,
            'CP_sous_prog'=>$sousprog->CP_sous_prog,
            'num_sous_prog'=>$sousprog->num_sous_prog,
            'num_prog'=>$sousprog->num_prog
        ]);
    }

    return response()->json(['exists' => false]);
}
//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                            // creation du SousProgramme
//===================================================================================
    function create_sou_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_sous_prog' => 'required',
            'nom_sous_prog' => 'required',
            'date_insert_sousProg' => 'required|date',
        ]);
        //dd($request->num_sous_prog);
 //si le portefeuiille existe donc le modifier
 $SousProgramme = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
 if ($SousProgramme) {
    $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
        $SousProgramme->AE_sous_prog=floatval($request->AE_sous_prog);
        $SousProgramme->CP_sous_prog=floatval($request->CP_sous_prog);
        $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;
        $SousProgramme->save();
        return response()->json([
            'success' => true,
            'message' => 'Sous programme ajouté avec succès.',
            'code' => 404,
        ]);
}
else{
        $SousProgramme = new SousProgramme();
        $SousProgramme->num_sous_prog = $request->num_sous_prog;
        $SousProgramme->num_prog = $request->id_program;
        $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
        $SousProgramme->AE_sous_prog=floatval($request->AE_sous_prog);
        $SousProgramme->CP_sous_prog=floatval($request->CP_sous_prog);
        $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;
        $SousProgramme->save();


}
      //  dd($SousProgramme);
        if ($SousProgramme) {
            return response()->json([
                'success' => true,
                'message' => 'Sous programme ajouté avec succès.',
                'code' => 200,
            ]);
     //dd($SousProgramme);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du sous programme.',
                'code' => 500,
            ]);
        }


}
}
