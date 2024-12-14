<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\pdf;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;

use App\Models\SousAction;
use App\Models\SousProgramme;
use Illuminate\Http\Request;
use App\Services\CalculDpia;


class sousActionController extends Controller
{
    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }
//===================================================================================
                            // affichage sous action
//===================================================================================
public function affich_sous_action($num_action)
{
    // Récupérer les action qui ont le même num_action
    $sousaction = SousAction::where('num_action', $num_action)->get();
    //dd($sousaction);
// Vérifier si des action existent
    if ($sousaction->isEmpty()) {
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

                                $resultats = $this->CalculDpia->calculdpiaFromPath($numport, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                             //   dd($resultats);
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


function printdpic($numport)
{
    $allaction=[];
    $all_act=[];
    $allsous_prog=[];
    $programmes=[];
    $ttall=[];
    $TtAE1=0;
    $TtCP1=0;
    $TtAE2=0;
    $TtCP2=0;
    $TtAE3=0;
    $TtCP3=0;
    $TtAE4=0;
    $TtCP4=0;
    $TtportT1AE=0;
    $TtportT1CP=0;
    $TtportT2AE=0;
    $TtportT2CP=0;
    $TtportT3AE=0;
    $TtportT3CP=0;
    $TtportT4AE=0;
    $TtportT4CP=0;
    $Ttportglob=[];
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

                                $resultats = $this->CalculDpia->calculdpiaFromPath($numport, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);

                                array_push($allaction,['actions'=>['code'=>$listsousact->num_sous_action,"nom"=>$listsousact->nom_sous_action,'TotalT'=>$resultats]]);
                                $all_act= $allaction;

                            }

                        }
                    }


                }

               // dd($allaction);
                for($i=0 ;$i<count($allaction);$i++)
                {
                foreach($allaction[$i] as $actsect)
                {
                    $TtAE1+=$actsect['TotalT']['T1']['total'][0]['values']['totalAE'];
                    $TtCP1+=$actsect['TotalT']['T1']['total'][0]['values']['totalCP'];

                    $TtAE2+=$actsect['TotalT']['T2']['total'][0]['values']['totalAE'];
                    $TtCP2+=$actsect['TotalT']['T2']['total'][0]['values']['totalCP'];

                    $TtAE3+=$actsect['TotalT']['T3']['total'][0]['values']['totalAE'];
                    $TtCP3+=$actsect['TotalT']['T3']['total'][0]['values']['totalCP'];

                    $TtAE4+=$actsect['TotalT']['T4']['total'][0]['values']['totalAE'];
                    $TtCP4+=$actsect['TotalT']['T4']['total'][0]['values']['totalCP'];

                };

                };

                $ttall=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
                    'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
                    'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
                    'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,
                ];

                array_push($allsous_prog,['sous_programmes'=>['code'=>$sprog->num_sous_prog,"nom"=>$sprog->nom_sous_prog,'actions'=>$all_act,"Total"=>$ttall]]);
                $all_sous_prog= $allsous_prog;
                $TtAE1=0;
                $TtCP1=0;
                $TtAE2=0;
                $TtCP2=0;
                $TtAE3=0;
                $TtCP3=0;
                $TtAE4=0;
                $TtCP4=0;
                $ttall=[];
                $allaction=[];
                $all_act=[];



            }
            for ($i=0; $i < count($allsous_prog) ; $i++)
            {
            foreach($allsous_prog[$i] as $sousprog)
             {
                # code...
                $TtAE1+=$sousprog['Total']['TotalT1_AE'];
                $TtCP1+=$sousprog['Total']['TotalT1_CP'];

                $TtAE2+=$sousprog['Total']['TotalT2_AE'];
                $TtCP2+=$sousprog['Total']['TotalT2_CP'];

                $TtAE3+=$sousprog['Total']['TotalT3_AE'];
                $TtCP3+=$sousprog['Total']['TotalT3_CP'];

                $TtAE4+=$sousprog['Total']['TotalT4_AE'];
                $TtCP4+=$sousprog['Total']['TotalT4_CP'];
            }
        }
            $ttall=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
            'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
            'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
            'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,
        ];
            array_push($programmes,['programmes'=>['code'=>$progm->num_prog,"nom"=>$progm->nom_prog,"sous_programmes"=>$all_sous_prog,"Total"=>$ttall]]);
            $TtAE1=0;
            $TtCP1=0;
            $TtAE2=0;
            $TtCP2=0;
            $TtAE3=0;
            $TtCP3=0;
            $TtAE4=0;
            $TtCP4=0;
            $allsous_prog=[];
        }
             // dd($programmes);
             for ($i=0; $i < count($programmes) ; $i++)
             {
        foreach($programmes[$i] as $prog)
        {
            $TtportT1AE+=$prog['Total']['TotalT1_AE'];
            $TtportT1CP+=$prog['Total']['TotalT1_CP'];
            $TtportT2AE+=$prog['Total']['TotalT2_AE'];
            $TtportT2CP+=$prog['Total']['TotalT2_CP'];
            $TtportT3AE+=$prog['Total']['TotalT3_AE'];
            $TtportT3CP+=$prog['Total']['TotalT3_CP'];
            $TtportT4AE+=$prog['Total']['TotalT4_AE'];
            $TtportT4CP+=$prog['Total']['TotalT4_CP'];
        };
    };
        array_push($Ttportglob,['TotalPortT1_AE'=>$TtportT1AE,'TotalPortT1_CP'=>$TtportT1CP,
                                'TotalPortT2_AE'=>$TtportT2AE,'TotalPortT2_CP'=>$TtportT2CP,
                                'TotalPortT3_AE'=>$TtportT3AE,'TotalPortT3_CP'=>$TtportT3CP,
                                'TotalPortT4_AE'=>$TtportT4AE,'TotalPortT4_CP'=>$TtportT4CP]);
        //dd($Ttportglob);
        if(count($programmes)>0)
        {
        /*return response()->json([
            'exists' => true,
            'actions'=>$allaction,
            'sous_programs'=>$allsous_prog,
            'programs'=>$all_prog,
        ]);*/
         $pdf=Pdf::loadView('impression.programmes', compact('programmes','Ttportglob'))->setPaper('A3','landscape');//lanscape mean orentation
               return $pdf->stream('liste_impression.pdf');
       //return view('impression.programmes',compact('programmes','Ttportglob'));
        }
        else
        {
            response()->json(['exists' => false]);
        }

}

//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_sousaction(Request $request)
    {
        $sousaction = sousAction::where('num_sous_action', $request->num_sous_action)->first();
       // dd($request);
        if ($sousaction) {
            return response()->json([
                'exists' => true,
                'nom_sous_action' => $sousaction->nom_sous_action,
                'date_insert_sous_action' => $sousaction->date_insert_sous_action,
                'AE_sous_act'=>$sousaction->AE_sous_action,
                'CP_sous_act'=>$sousaction->CP_sous_action,
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
 $sousaction = SousAction::where('num_sous_action', $request->num_act)->first(); // Utilisation de 'numsouaction' pour trouver l'élément
 $sousaction3 = SousAction::where('num_sous_action', $request->num_sous_action)->first(); // Utilisation de 'numsouaction' pour trouver l'élément
 if ($sousaction || $sousaction3) {
     if(isset($sousaction3)){
         $sousaction=$sousaction3;
        }
        //dd($sousaction);
    // Mise à jour des autres champs
    $sousaction->num_sous_action = $request->num_sous_action;
    $sousaction->nom_sous_action = $request->nom_sous_action;
    $sousaction->AE_sous_action=floatval($request->AE_sous_act);
    $sousaction->CP_sous_action=floatval($request->CP_sous_act);
   // $sousaction->num_action = $request->num_act;
    $sousaction->date_update_sous_action = now();

    // Enregistrer les modifications dans la base de données
    $sousaction->save();

}
else{
      //dd($request);
    // creer une nouvelle  sous action
    $sousaction = new sousAction();
    $sousaction->num_action = $request->num_act;
    $sousaction->num_sous_action = $request->num_sous_action;
    $sousaction->nom_sous_action = $request->nom_sous_action;
    $sousaction->AE_sous_action=floatval($request->AE_sous_act);
    $sousaction->CP_sous_action=floatval($request->CP_sous_act);
    $sousaction->date_insert_sous_action = $request->date_insert_sous_action;
    $sousaction->save();
}

if ( $sousaction) {
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
