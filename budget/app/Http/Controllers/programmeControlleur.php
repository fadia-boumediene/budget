<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;

class programmeControlleur extends Controller
{
    //===================================================================================
                                //affichage du programme
    //===================================================================================
    function affich_prog( $num_portefeuil)
    {
           // Récupérer les programmes qui ont le même num_port
    $programmes = Programme::where('num_portefeuil', $num_portefeuil)->get();

    // Vérifier si des programmes existent
    if ($programmes->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Aucun programme trouvé pour ce portefeuille.',
        ]);
    }

    // Retourner les programmes à la vue
        return view('Portfail-in.index', compact('programmes'));
    }

    //===================================================================================
                                //DEBUT CHECK
//===================================================================================

    public function check_prog(Request $request)
    {
        // Validation de la requête
    $request->validate([
        'num_prog' => 'required',
    ]);

        $prog = programme::where('num_prog', $request->num_prog)->first();

        if ($prog) {
            return response()->json([
                'exists' => true,
                'nom_prog' => $prog->nom_prog,
                'num_prog' => $prog->num_prog,
                'date_insert_portef' => $prog->date_insert_portef,
            ]);
        }

        return response()->json(['exists' => false]);
    }
//===================================================================================
                                //FIN CHECK
//===================================================================================

 //===================================================================================
                                // creation du programme
//===================================================================================
    function creat_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_prog' => 'required|unique:programmes,num_prog',
            'nom_prog' => 'required',
            'date_insert_portef' => 'required|date',
        ]);

        // Créer un nouveau programme
        $programme = new Programme();
        $programme->num_prog = $request->num_prog;
        $programme->num_portefeuil = $request->num_portefeuil;
        $programme->nom_prog = $request->nom_prog;
        $programme->date_insert_portef = $request->date_insert_portef;
        $programme->id_rp = 1; //periodiquement

        $programme->save();
        //dd($programme);
        if ($programme) {
            return response()->json([
                'success' => true,
                'message' => 'Programme ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du programme.',
                'code' => 500,
            ]);
        }
    }

}