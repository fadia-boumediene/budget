<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\SousProgramme;
use App\Models\SousAction;

use App\Services\CalculDpia;
class portfeuilleController extends Controller
{
    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }
//===================================================================================
                                //affichage du portrefeuille
//===================================================================================
    function affich_portef($id)
    {
        // Récupérer tous les portefeuilles de la base de données
          //  $portefeuilles = Portefeuille::all();
         
          $por=Portefeuille::findOrFail($id);
          $progms=Programme::where('num_portefeuil',$id)->get();
          $allprogram=[];
          $allsous_prog=[];
          $allaction=[];
          $allsous_action=[];
          $resultats=0;
           $CalculDpia;
  
        
  
         
  
  
          foreach($progms as $progm)
          {
              $sousprog=SousProgramme::where('num_prog',$progm->num_prog)->get();
              foreach($sousprog as $sprog)
              {
                  
                 
                      $act=Action::where('num_sous_prog',$sprog->num_sous_prog)->get();
                      
                      foreach($act as $listact)
                      {
                          if(isset($listact))
                          {
                              $sous_act=SousAction::where('num_action',$listact->num_action)->get();
                              foreach($sous_act as $listsousact)
                              {
                                  if(isset($listsousact))
                                  {
                                     // $resultats = $this->CalculDpia->calculdpiaFromPath($id, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                     
                                      try {
                                          $resultats = $this->CalculDpia->calculdpiaFromPath($id, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                      } catch (\Exception $e) {
                                         
                                          $resultats="null";
                                      }
                                      //dd($resultats);
                                      array_push($allsous_action,['num_act'=>$listsousact->num_sous_action,'data'=>$listsousact,'T2'=>$resultats]);
                                     
                                  }
                              } 
                          array_push($allaction,['num_act'=>$listact->num_action,'data'=>$listact,'sous_action'=>$allsous_action]);
                          $allsous_action=[];
                          }
                      }
                      array_push($allsous_prog,['id_sous_prog'=>$sprog->num_sous_prog,'data'=>$sprog,'Action'=>$allaction]);
                      $allaction=[];
              }
              array_push($allprogram,['id_prog'=>$progm->num_prog,'data'=>$progm,'sous_program'=>$allsous_prog]);
              $allsous_prog=[];
          }
          $allport=[
              'id'=>$id,
              'prgrammes'=>$allprogram,
          ];
            dd($allport);
      // Passer les données à la vue
      return view('test.tree', compact('allport'));


    // Passer les données à la vue
     
    }
    //affichage formulaire
    function form_portef()
    {
        return view('Portfail-in.creation');
    }
//===================================================================================
                                // creation du portefeuille
//===================================================================================
    function creat_portef(Request $request)
    {
         // Validation des données
         $request->validate([
            'num_portefeuil' => 'required',
            'num_journal' => 'required',
            'nom_journal' => 'required',
            'AE_portef' => 'required',
            'CP_portef' => 'required',
            'Date_portefeuille' => 'required|date',
        ]);

        // Vérifier si le portefeuille existe déjà
        $existing = Portefeuille::where('num_portefeuil', $request->num_port)->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le portefeuille avec ce numéro existe déjà.',
                'code'=>404,
            ]);
        }

        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = intval($request->num_portefeuil);
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->Date_portefeuille;
        $portefeuille->id_min =2;//periodiquement
        $portefeuille->save();

        if($portefeuille)
        {
            return response()->json([
                'success' => true,
                'message' => 'Portefeuille ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du portefeuille.',
                'code' => 500,
            ]);
        }


    }

}
