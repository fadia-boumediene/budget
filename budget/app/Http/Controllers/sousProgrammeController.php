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

        // Vérifier si des SousProgramme existent
            if ($SousProgramme->isEmpty()) {
                 return response()->json([
                    'success' => false,
                    'message' => 'Aucun Sous programme trouvé pour ce programme.',
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
            'nom_sous_prog' => $request->nom_sous_prog,
            'date_insert_sousProg' => $request->date_insert_sousProg,
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
            'num_sous_prog' => 'required|unique:sous_programmes,num_sous_prog',
            'nom_sous_prog' => 'required',
            'date_insert_sousProg' => 'required|date',
        ]);
//dd($request);
        // Créer un nouveau SousProgramme
        $SousProgramme = new SousProgramme();
        $SousProgramme->num_sous_prog = $request->num_sous_prog;
        $SousProgramme->num_prog = $request->id_program;
        $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
        $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;

        $SousProgramme->save();
      //  dd($SousProgramme);
        if ($SousProgramme) {
            return response()->json([
                'success' => true,
                'message' => 'Sous programme ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du sous programme.',
                'code' => 500,
            ]);
        }

}
}