<?php

namespace App\Http\Controllers;

use App\Models\SousAction;
use Illuminate\Http\Request;

class sousActionController extends Controller
{
//===================================================================================
                            // affichage sous action
//===================================================================================
public function affich_sous_action($num_action)
{
    // Récupérer les action qui ont le même num_action
    $SousAction = SousAction::where('num_action', $num_action)->get();
    dd($SousAction);
// Vérifier si des action existent
    if ($SousAction->isEmpty()) {
         return response()->json([
            'success' => false,
            'message' => 'Aucune sous action trouvée pour cette action.',
        ]);
    }

// Retourner les action à la vue
    return view('Action-in.index', compact('SousAction'));
}


//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_action(Request $request)
    {
        $sousaction = sousAction::where('num_sous_action', $request->num_sous_action)->first();

        if ($sousaction) {
            return response()->json([
                'exists' => true,
                'nom_sous_action' => $sousaction->nom_sous_action,
                'AE_sous_action' => $sousaction->AE_sous_act,
                'CP_sous_action' => $sousaction->CP_sous_act,
                'date_insert_sous_action' => $sousaction->date_insert_sous_action
            ]);
        }

        return response()->json(['exists' => false]);
    }

//===================================================================================
                            //FIN CHECK
//===================================================================================
//===================================================================================
                        // creation sous action
//===================================================================================
function create_sousaction(Request $request)
{
    //dd($request);
 // Récupérer la ligne de la table en fonction de 'numsouaction'
 $sousAction = SousAction::where('num_sous_action', $request->num_act)->first(); // Utilisation de 'numsouaction' pour trouver l'élément

 if ($sousAction) {
    // Mise à jour des autres champs
    $sousAction->num_sous_action = $request->num_sous_action;
    $sousAction->nom_sous_action = $request->nom_sous_action;
    $sousAction->AE_sous_action=floatval($request->AE_sous_act);
    $sousAction->CP_sous_action=floatval($request->CP_sous_act);
   // $sousAction->num_action = $request->num_act;
    $sousAction->date_insert_sous_action = $request->date_insert_sous_action;

    // Enregistrer les modifications dans la base de données
    if($sousAction->save())
   {
    //dd($sousAction);
    return response()->json([
        'success' => true,
        'message' => 'Sous-Action ajouté avec succès.',
        'code' => 200,
    ]);
}
    else
    {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'ajout de la sous action.',
            'code' => 500,
        ]);
    }
}
else{
        //si la sous action existe donc la modifier
        dd($request);
        $sousAction = SousAction::where('num_sous_action', $request->num_sous_action)->first();
    if ($sousAction) {
        $sousAction->nom_sous_action = $request->nom_sous_action;
        $sousAction->AE_sous_action=floatval($request->AE_sous_act);
        $sousAction->CP_sous_action=floatval($request->CP_sous_act);
        $sousAction->date_insert_sous_action = $request->date_insert_sous_action;
        $sousAction->save();

              // Enregistrer le fichier et le lier au portefeuille
                /*...
                                                    */

        if ( $sousAction) {
            return response()->json([
                'success' => true,
                'message' => 'Action ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de l\'action.',
                'code' => 500,
            ]);
        }

    }
    else {
        // Gérer le cas où la sous-action n'est pas trouvée
        return response()->json([
            'success' => true,
            'message' => 'exist lors de l\'ajout de la sous action.',
            'code' => 404,
        ]);

    }
}


}
}
