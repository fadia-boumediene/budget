<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\SousAction;
use App\Models\SousProgramme;
use App\Models\Programme;

class actionController extends Controller
{
//===================================================================================
                            // affichage de l'action
//===================================================================================
    public function affich_action($num_action)
    {
        // Récupérer les action qui ont le même num_action
        $action = action::where('num_action', $num_action)->get();
    //    dd($action);

    // Vérifier si des action existent
        if ($action->isEmpty()) {
             return response()->json([
                'success' => false,
                'message' => 'Aucune action trouvée pour ce sous programme.',
            ]);
        }

    // Retourner les action à la vue
        return view('Action-in.index', compact('action'));
    }


//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_action(Request $request)
    {
        $action = Action::where('num_action', $request->num_action)->first();
        //dd($request);
        if ($action) {
            return response()->json([
                'exists' => true,
                'nom_action' => $action->nom_action,
                'date_insert_action' => $action->date_insert_action,
                'AE_act'=>$action->AE_action,
                'CP_act'=>$action->CP_action,
            ]);
        }

        return response()->json(['exists' => false]);
    }

//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                            // creation de l'action
//===================================================================================
    function create_action(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_action' => 'required',
            'nom_action' => 'required',
            'date_insert_action' => 'required|date',
        ]);
        //si l action existe donc le modifier
        $action = action::where('num_action', $request->num_action)->first();
        $num_act= $request->num_action .'-01';
        //dd($num_act);
        $sousaction = sousaction::where('num_sous_action', $request->num_act)->first();
        //dd($sousaction);
    if ($action) {
        $action->nom_action = $request->nom_action;
        $action->AE_action=floatval($request->AE_act);
        $action->CP_action=floatval($request->CP_act);
        $action->id_ra = 1;//periodiquement
        $action->date_update_action = now();
        $action->save();

        if ($sousaction) {
            $sousaction->nom_sous_action = $request->nom_action;
            $sousaction->AE_sous_action=floatval($request->AE_act);
            $sousaction->CP_sous_action=floatval($request->CP_act);
            $sousaction->date_update_sous_action = now();
            $sousaction->save();
        }


              // Enregistrer le fichier et le lier au portefeuille
                /*...
                                                    */
         $num_sousact = sousaction::where('num_action', $request->num_action)->first();
            // Récupérer l'action en chargeant les relations nécessaires
                $action = Action::with('SousProgramme.Programme')
                ->where('num_action', $request->num_action)
                ->first();
         $numPortef = $action->sousProgramme->programme->num_portefeuil ?? null;
         $count_sousact = sousaction::where('num_action', $request->num_action)->count();
        // dd($numPortef);
         if ($action) {
             return response()->json([
                 'num_sous_action' => $num_sousact ? $num_sousact->num_sous_action : null,
                 'count_sous_action' => $count_sousact,
                 'numPortef' => $numPortef,
                 'success' => true,
                 'message' => 'Action ajouté avec succès.',
                 'code' => 404,
             ]);
         } else {
             return response()->json([
                 'success' => false,
                 'message' => 'Erreur lors de l\'ajout de l\'action.',
                 'code' => 500,
             ]);
         }


    }
        else{
        // Créer une nouvelle action
        $action = new action();
        $action->num_action = $request->num_action;
        $action->num_sous_prog =$request->id_sous_prog;
        $action->nom_action = $request->nom_action;
        $action->AE_action=floatval($request->AE_act);
        $action->CP_action=floatval($request->CP_act);
        $action->id_ra = 1;//periodiquement
        $action->date_insert_action = $request->date_insert_action;

        $action->save();


         // Créer une nouvelle sous action
         $sousaction = new sousAction();
         $num_act= $request->num_action .'-01';
        //dd($num_act);
         $sousaction->num_action = $request->num_action;
         $sousaction->num_sous_action = $num_act;
         $sousaction->nom_sous_action = $request->nom_action;
         $sousaction->AE_sous_action=floatval($request->AE_act);
         $sousaction->CP_sous_action=floatval($request->CP_act);
         $sousaction->date_insert_sous_action = $request->date_insert_action;

        // dd($sousaction);
         $sousaction->save();

              // Enregistrer le fichier et le lier au portefeuille
                /*...
                                                    */

              if ( $action && $sousaction) {
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
    }



}
