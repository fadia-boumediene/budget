<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;

class programmeControlleur extends Controller
{
    //===================================================================================
                                //affichage du programme
    //===================================================================================
    function affich_prog( $num_port)
    {
           // Récupérer les programmes qui ont le même num_port
    $programmes = Programme::where('num_portefeuil', $num_port)->get();

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
                                // creation du programme
//===================================================================================
    function creat_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_prog' => 'required',
            'nom_prog' => 'required',
            'AE_prog' => 'required',
            'CP_prog' => 'required',
            'date_insert_portef' => 'required|date',
        ]);
      
        // Vérifier si le programme existe déjà en fonction du numéro et des dates
        $existing = programme::where('num_prog', $request->num_prog)
                             ->whereNotNull('date_insert_portef')
                             ->exists(); // Vérifie s'il y a un enregistrement existant
                             
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le programme avec ce numéro existe déjà.',
                'code' => 404,
            ]);
        }

        // Créer un nouveau programme
        $programme = new Programme();
        $programme->num_prog = intval($request->num_prog);
        $programme->num_portefeuil = intval($request->num_portefeuil);
        $programme->nom_prog = $request->nom_prog;
        $programme->AE_porg =floatval($request->AE_prog);
        $programme->CP_prog = floatval($request->CP_prog);
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
