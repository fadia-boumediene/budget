<?php

namespace App\Http\Controllers;

use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;

use App\Models\SousAction;
use App\Models\SousProgramme;
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


// ======================= get all action of portfial ===============================///


function allact($numport)
{
    $allaction=[];
    $allsous_prog=[];
    $all_prog=[];
    $progms=Programme::where("num_portefeuil",$numport)->get();
    foreach($progms as $progm)
    {
        $sousprog=SousProgramme::where('num_prog',$progm->num_prog)->get();
        foreach($sousprog as $sprog)
        {


                $act=Action::where('num_sous_prog',$sprog->num_sous_prog)->get();
            //    dd($act);
                foreach($act as $listact)
                {
                    if(isset($listact))
                    {
                        $sous_act=SousAction::where('num_action',$listact->num_action)->get();
                      //  dd($sous_act);
                        foreach($sous_act as $listsousact)
                        {

                            if(isset($listsousact))
                            {
                            
                                array_push($allaction,['actions'=>['actions_num'=>$listsousact->num_sous_action,"actions_name"=>$listsousact->nom_sous_action]]);

                            }

                        }
                    }
                }   
                array_push($allsous_prog,['sous_programs'=>['sous_progs_num'=>$sprog->num_sous_prog,"sous_progs_name"=>$sprog->nom_sous_prog]]);
            }
            array_push($all_prog,['programs'=>['progs_num'=>$progm->num_prog,"progs_name"=>$progm->nom_prog]]); 
        }
      //  dd($allaction,$allsous_prog,$all_prog); 
        if(count($allaction)>0)
        {
        return response()->json([
            'exists' => true,
            'actions'=>$allaction,
            'sous_programs'=>$allsous_prog,
            'programs'=>$all_prog,
        ]);
        }
        else
        {
            response()->json(['exists' => false]);
        }
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
        //dd($request);
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
