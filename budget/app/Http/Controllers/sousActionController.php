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
        $sousaction = Action::where('num_sous_action', $request->num_sous_action)->first();

        if ($sousaction) {
            return response()->json([
                'exists' => true,
                'nom_sous_action' => $sousaction->nom_sous_action,
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
     
 // Récupérer la ligne de la table en fonction de 'numsouaction'
 $sousAction = SousAction::where('num_sous_action', $request->num_act)->first();
 // Utilisation de 'numsouaction' pour trouver l'élément
 if (!isset($sousAction)) {
    // Concaténation des valeurs pour num_sous_action
    $sousAction=new SousAction();
    $sousAction->num_sous_action = $request->num_sous_action;
    // Mise à jour des autres champs
    $sousAction->nom_sous_action = $request->nom_sous_action;
    $sousAction->num_action = $request->num_act;
    $sousAction->date_insert_sous_action = $request->date_insert_sous_action;
    
    // Enregistrer les modifications dans la base de données
    if($sousAction->save())
   {
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
