<?php
namespace App\Services;

use App\Models\Portefeuille;
use App\Models\SousAction;
use Illuminate\Support\Facades\DB;  
class CalculDpia
{
    public function calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act)
    {
      /*  // décomposer le chemin (portefeuille, programme, sous-programme, action, sous-action)
        $chemin = explode('/', $path);
        if (count($chemin) < 1) {
            throw new \Exception("Le chemin n'est pas valide");
        }*/
       // dd($port);
       /* $port = intval($port);
       // dd($port);
        $prog = intval($prog);
        $sous_prog = intval($sous_prog);
        $act = intval($act);
        $s_act = ($s_act);*/
      
      //dd($port, $prog, $sous_prog, $act,$s_act);
      
      $portefeuille = Portefeuille::where('num_portefeuil', $port)
        ->whereHas('Programme.SousProgramme.Action.SousAction', function ($query) use ($s_act) {
            $query->where('num_sous_action', $s_act);
        })
        ->with([
            'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation'
        ])
        ->first();
   // dd($portefeuille);
    //dd($portefeuille);
        // récupérer le portefeuille à partir du chemin
    /*  $portefeuille = Portefeuille::where('num_portefeuil', $port)
        ->with([
            'Programme.SousProgramme.Action.SousAction',
            'Programme.SousProgramme.Action.SousAction.GroupOperation',
            'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation'
        ])
        ->first();

        if ($portefeuille) {
            $sousActions = $portefeuille->Programme
                ->flatMap(fn($programme) => $programme->SousProgramme)
                ->flatMap(fn($sousProgramme) => $sousProgramme->Action)
                ->flatMap(fn($action) => $action->SousAction)
                ->where('num_sous_action', $s_act);
        
         //  dd($sousActions);
        } else {
            dd('Aucun portefeuille trouvé pour ce numéro');
        }
     */
  
/*$portefeuille = DB::select("
SELECT sa.*
FROM sous_actions sa
JOIN actions a ON sa.num_action = a.num_action
JOIN sous_programmes sp ON a.num_sous_prog = sp.num_sous_prog
JOIN programmes p ON sp.num_prog = p.num_prog
JOIN portefeuilles pf ON p.num_portefeuil = pf.num_portefeuil
WHERE pf.num_portefeuil = :port
AND sa.num_sous_action = :s_act
", ['port' => $port, 's_act' => $s_act]);
if (!empty($portefeuille)) {
    // $results contient un tableau d'objets
    //dd($portefeuille);
} else {
    dd('Aucun sous-action trouvé pour ce portefeuille et ce sous-action.');
}
//dd($portefeuille);
       
           /*$portefeuille = DB::table('portefeuilles as p')
    ->join('programmes as pr', 'pr.num_portefeuil', '=', 'p.num_portefeuil')
    ->join('sous_programmes as sp', 'sp.num_prog', '=', 'pr.num_prog')
    ->join('actions as a', 'a.num_sous_prog', '=', 'sp.num_sous_prog')
    ->join('sous_actions as sa', 'sa.num_action', '=', 'a.num_action')
    ->join('group_operations as go', 'go.num_sous_action', '=', 'sa.num_sous_action')
    ->join('operations as o', 'o.code_grp_operation', '=', 'go.code_grp_operation')
    ->join('sous_operations as so', 'so.code_operation', '=', 'o.code_operation')
    ->where('p.num_portefeuil', $port)
    ->first(); // Pour récupérer un seul résultat*/

        //dd($portefeuille->Programme->get()->SousProgramme->get()->Action->get()->SousAction->get()->GroupOperation->get()); 
     // dd( $portefeuille);
        if (!$portefeuille) {
            throw new \Exception("Portefeuille introuvable");
        }
         //dd( $portefeuille);
        $totalAeT2 = 0;
        $totalCpT2 = 0;

        $totalAeT3 = 0;
        $totalCpT3 = 0;

        $totalAe = 0; //pour t1
        $totalCp = 0;


        $totalAet4 = 0; //pour  t4
        $totalCpt4 = 0;

        $groupT2 = [];
        $totalt2= [];
        $operationT2 = [];
        $sousOperationT2 = [];

        $groupT3 = [];
        $totalt3= [];
        $operationT3 = [];
        $sousOperationT3 = [];

        //pour t1
        $groupT = [];
        $totalt= [];
        $operationT = [];
        $sousOperationT = [];

        //pour t1
        $groupT4= [];
        $totalt4= [];
        $operationT4 = [];
        $sousOperationT4 = [];

        $totalAeOuvertGlobal=0;
        $totalAeAttenduGlobal=0;
        $totalCpOuvertGlobal=0;
        $totalCpAttenduGlobal=0;


        $totalAeNotifieGlobal=0;
        $totalAeReporteGlobal=0;
        $totalAeEngageGlobal=0;
        $totalCpNotifieGlobal=0;
        $totalCpReporteGlobal=0;
        $totalCpConsomeGlobal=0;



        // parcourir tous les programmes du portefeuille
        foreach ($portefeuille->Programme as $programme) {
           // dd($programme);
            foreach ($programme->SousProgramme as $sousProgramme) {
              //  dd($sousProgramme);
                foreach ($sousProgramme->Action as $action) {
                   // dd($action);
                    foreach ($action->SousAction as $sousAction) {
                       // dd($sousAction);
                        foreach ($sousAction->GroupOperation as $groupe) {
                            if($groupe->num_sous_action==$s_act)
                            {
                              //  dd($groupe);
                                $groupeAeOuvert = 0;
                                $groupeAeAttendu = 0;
                                $groupeCpOuvert = 0;
                                $groupeCpAttendu = 0;
    
                                $groupeAeReporte = 0; 
                                $groupeAeNotife= 0;
                                $groupeAeEngage= 0;
                                $groupeCpReporte = 0;
                                $groupeCpNotife= 0;
                                $groupeCpConsome= 0;
    
                                //pour t1
                                $groupeAe = 0;
                                $groupeCp= 0;
    
                                $groupeAet4 = 0;
                                $groupeCpt4 = 0;
                                foreach ($groupe->Operation as $operation) {
                                  // dd($operation);
                                    $operationAeOuvert = 0;
                                    $operationAeAttendu = 0;
                                    $operationCPOuvert = 0;
                                    $operationCPAttendu = 0;
    
                                    $operationAeReporte = 0;
                                    $operationAeNotife = 0;
                                    $operationAeEngage= 0;
                                    $operationCPReporte = 0;
                                    $operationCPNotife = 0;
                                    $operationCPConsome = 0;
    
                                   //pour t1
                                    $operationAe = 0;
                                    $operationCP = 0;
    
                                    $operationAet4 = 0;
                                    $operationCPt4 = 0;
                                        // calculer la somme de chaque sous op
                                        foreach ($operation->SousOperation as $sousOperation) {
                                          //dd($sousOperation);
                         /***************************************** T2 ********************************************************** */
                                            $sousopAeouvert= $sousOperation->AE_ouvert;
                                            $sousopAeattendu= $sousOperation->AE_atendu;
                                             // dd($sousopAeouvert,$sousopAeattendu);
    
                                             $sousopCpouvert= $sousOperation->CP_ouvert;
                                            $sousopCpattendu= $sousOperation->CP_atendu;
                                          //  dd($sousopCpouvert,$sousopCpattendu);
    
                                          $totalSousAeGlobal = $sousopAeouvert + $sousopAeattendu; // AE_ouvert + AE_attendu global
                                          $totalSousCpGlobal = $sousopCpouvert + $sousopCpattendu; // CP_ouvert + CP_attendu global
                                          //dd($totalSousAeGlobal,$totalSousCpGlobal);
    
                                                  //calcul l'operation depuis les sous operations
                                          $operationAeOuvert += $sousOperation->AE_ouvert;
                                          $operationAeAttendu += $sousOperation->AE_atendu;
                                          $operationCPOuvert += $sousOperation->CP_ouvert;
                                          $operationCPAttendu += $sousOperation->CP_atendu;
    
                                          $totalOPAeGlobal = $operationAeOuvert + $operationAeAttendu; // AE_ouvert + AE_attendu global ligne(horizontale)
                                          $totalOPCpGlobal = $operationCPOuvert + $operationCPAttendu;

                                     
                                        
                                          if($sousOperation->code_t2==20000) {
                                            $sousOperationT2[] = [
                                                "code" => $sousOperation->code_sous_operation,
                                                "values" => [
                                                    'ae_ouvertsousop' => $sousopAeouvert,
                                                    'ae_attendusousop' => $sousopAeattendu,
                                                    'cp_ouvertsousop' => $sousopCpouvert,
                                                    'cp_attendsousuop' => $sousopCpattendu,
                                                    'ae_ouvertsousop_NONREPARTIS' => $sousOperation->AE_ouvert_NONREPARTIS,
                                                    'ae_attendusousop_NONREPARTIS' => $sousOperation->AE_atendu_NONREPARTIS,
                                                    'cp_ouvertsousop_NONREPARTIS' => $sousOperation->CP_ouvert_NONREPARTIS,
                                                    'cp_attendsousuop_NONREPARTIS' => $sousOperation->CP_atendu_NONREPARTIS,
                                                    'totalAEsousop' => $totalSousAeGlobal,
                                                    'totalCPsousop' => $totalSousCpGlobal,

                                                    'totalAEsousop_NONREPARTIS' =>  $sousOperation->AE_ouvert_NONREPARTIS+ $sousOperation->AE_atendu_NONREPARTIS,
                                                    'totalCPsousop_NONREPARTIS' => $sousOperation->CP_ouvert_NONREPARTIS+ $sousOperation->CP_atendu_NONREPARTIS,
                                                ]  ];
                                          }
    
   
    
                          /****************************************T3******************************************************************* */
    
                                             $sousopAereporte= $sousOperation->AE_reporte;
                                             $sousopAenotifie= $sousOperation->AE_notifie;
                                             $sousopAeengage= $sousOperation->AE_engage;
                                            //dd($sousopAereporte,$sousopAenotifie, $sousopAeengage);
    
    
                                          $sousopCpreporte= $sousOperation->CP_reporte;
                                          $sousopCpnotifie= $sousOperation->CP_notifie;
                                          $sousopCpconsome= $sousOperation->CP_consome;
                                         // dd($sousopCpreporte,$sousopCpnotifie, $sousopCpconsome);
    
    
                                           //calcul l'operation depuis les sous operations
                                           $operationAeReporte += $sousOperation->AE_reporte;
                                           $operationAeNotife += $sousOperation->AE_notifie;
                                           $operationAeEngage += $sousOperation->AE_engage;
                                           $operationCPReporte += $sousOperation->CP_reporte;
                                           $operationCPNotife += $sousOperation->CP_notifie;
                                           $operationCPConsome += $sousOperation->CP_consome;
                                           //dd($operationAeReporte,$operationAeNotife, $operationAeEngage,$operationCPReporte,$operationCPNotife,$operationCPConsome);
    
                                           if($sousOperation->code_t3==30000) {
                                           $sousOperationT3[] = [
                                               "code" => $sousOperation->code_sous_operation,
                                               "values" => [
                                                   'ae_reportesousop' => $sousopAereporte,
                                                   'ae_notifiesousop' => $sousopAenotifie,
                                                   'ae_engagesousop' => $sousopAeengage,
                                                   'cp_reportesousuop' => $operationCPReporte,
                                                   'cp_notifiesousop' => $operationCPNotife,
                                                   'cp_consomesousop' => $operationCPConsome,

                                                   'ae_reportesousop_NONREPARTIS' =>  $sousOperation->AE_reporte_NONREPARTIS,
                                                   'ae_notifiesousop_NONREPARTIS' => $sousOperation->AE_notifie_NONREPARTIS,
                                                   'ae_engagesousop_NONREPARTIS' => $sousOperation->AE_engage_NONREPARTIS,
                                                   'cp_reportesousuop_NONREPARTIS' => $sousOperation->CP_reporte_NONREPARTIS,
                                                   'cp_notifiesousop_NONREPARTIS' => $sousOperation->CP_notifie_NONREPARTIS,
                                                   'cp_consomesousop_NONREPARTIS' => $sousOperation->CP_consome_NONREPARTIS,

                                                   'totalae_NONREPARTIS'=>$sousOperation->AE_reporte_NONREPARTIS+$sousOperation->AE_notifie_NONREPARTIS+$sousOperation->AE_engage_NONREPARTIS,
                                                   'totalcp_NONREPARTIS'=>$sousOperation->CP_reporte_NONREPARTIS+$sousOperation->CP_notifie_NONREPARTIS+$sousOperation->CP_consome_NONREPARTIS,


                                               ]  ];
                                           }
    
                            /************************************T1********************************************************** */
    
                                            $sousopAe= $sousOperation->AE_sous_operation;
                                            $sousopcP= $sousOperation->CP_sous_operation;
                                            //dd($sousopAe,$sousopcP);
    
                                           //calcul l'operation depuis les sous operations
                                           $operationAe+= $sousOperation->AE_sous_operation;
                                           $operationCP+= $sousOperation->CP_sous_operation;
    
                                           if($sousOperation->code_t1==10000) {
                                            $sousOperationT[] = [
                                                "code" => $sousOperation->code_sous_operation,
                                                "values" => [
                                                    'ae_sousop' => $sousopAe,
                                                    'cp_sousuop' => $sousopcP,

                                                    'ae_sousop_NONREPARTIS' => $sousOperation->AE_sous_operation,
                                                    'cp_sousuop_NONREPARTIS' => $sousOperation->CP_sous_operation,
                                                  
    
                                                ]  ];
                                          }
                /*****************************************T4********************************************************** */
    
                                              $sousopAet4= $sousOperation->AE_sous_operation;
                                              $sousopcPt4= $sousOperation->CP_sous_operation;
                                              //dd($sousopAet4,$sousopcPt4);
    
                                             //calcul l'operation depuis les sous operations
                                             $operationAet4 += $sousOperation->AE_sous_operation;
                                             $operationCPt4 += $sousOperation->CP_sous_operation;
    
                                             if(isset($sousOperation) && $sousOperation->code_t4==40000) {
                                              $sousOperationT4[] = [
                                                  "code" => $sousOperation->code_sous_operation,
                                                  "values" => [
                                                      'ae_sousop' => $sousopAet4,
                                                      'cp_sousuop' => $sousopcPt4,

                                                      'ae_sousop_NONREPARTIS' => $sousOperation->AE_sous_operation,
                                                      'cp_sousuop_NONREPARTIS' => $sousOperation->CP_sous_operation,
    
                                                  ]  ];
                                            }
    
    
                                        }
    
                                   // dd($operationAeOuvert,$operationAeAttendu,$operationCPOuvert , $operationCPAttendu);
                                    //dd($totalOPAeGlobal,$totalOPCpGlobal);
                                    if(isset($sousOperation) && $sousOperation->code_t2==20000) {
                                    $operationT2[] = [
                                        "code" => $operation->code_operation,
                                        "values" => [
                                            'ae_ouvertop' => $operationAeOuvert,
                                            'ae_attenduop' => $operationAeAttendu,
                                            'cp_ouvertop' => $operationCPOuvert,
                                            'cp_attenduop' => $operationCPAttendu,
                                            'totalAEop' => $totalOPAeGlobal, //total horizontal
                                            'totalCPop' => $totalOPCpGlobal,
                                        ]  ];}
    
                                        // ajouter les valeurs de l'operation au groupe d'op
                                        $groupeAeOuvert += $operationAeOuvert;
                                        $groupeAeAttendu += $operationAeAttendu;
                                        $groupeCpOuvert += $operationCPOuvert;
                                        $groupeCpAttendu += $operationCPAttendu;
    
                                        //dd($groupeAeOuvert,$groupeAeAttendu,$groupeCpOuvert , $groupeCpAttendu);
    
                                        $totalgroupAeGlobal = $groupeAeOuvert + $groupeAeAttendu; // AE_ouvert + AE_attendu global horizental
                                        $totalgroupCpGlobal = $groupeCpOuvert + $groupeCpAttendu;
    
                                       // dd($totalgroupAeGlobal,$totalgroupCpGlobal);
    
                /********************************************************************* T3******************************************************* */
                                      if(isset($sousOperation) && $sousOperation->code_t3==30000) {
                                        $operationT3[] = [
                                            "code" => $operation->code_operation,
                                            "values" => [
                                                'ae_reporteop' => $operationAeReporte,
                                                'ae_notifieop' => $operationAeNotife,
                                                'ae_engageop' => $operationAeEngage,
                                                'cp_reporteop' => $operationCPReporte,
                                                'cp_notifieop' => $operationCPNotife,
                                                'cp_consomeop' => $operationCPConsome,
    
                                            ]  ];  }
    
                                             // ajouter les valeurs de l'operation au groupe d'op
                                        $groupeAeReporte += $operationAeReporte;
                                        $groupeAeNotife += $operationAeNotife;
                                        $groupeAeEngage += $operationAeEngage;
                                        $groupeCpReporte += $operationCPReporte;
                                        $groupeCpNotife += $operationCPNotife;
                                        $groupeCpConsome += $operationCPConsome;
    
                                        //dd($groupeAeReporte,$groupeAeNotife,$groupeAeEngage , $groupeCpReporte,$groupeCpNotife,$groupeCpConsome);
           /********************************************************************* T1******************************************************* */
                                        if(isset($sousOperation) && $sousOperation->code_t1==10000) {
                                            $operationT[] = [
                                                "code" => $operation->code_operation,
                                                "values" => [
                                                    'ae_op' => $operationAe,
                                                    'cp_op' => $operationCP,
    
                                                ]  ];
                                             }
                                                     // ajouter les valeurs de l'operation au groupe d'op
                                            $groupeAe += $operationAe;
                                            $groupeCp += $operationCP;
                                           // dd($groupeAe,$groupeCp);
    
            /********************************************************************* T4******************************************************* */
                                        if(isset($sousOperation) && $sousOperation->code_t4==40000) {
                                            $operationT4[] = [
                                                "code" => $operation->code_operation,
                                                "values" => [
                                                    'ae_op' => $operationAet4,
                                                    'cp_op' => $operationCPt4,
    
                                                ]  ];
                                             }
    
    
                                                // ajouter les valeurs de l'operation au groupe d'op
                                            $groupeAet4 += $operationAet4;
                                            $groupeCpt4 += $operationCPt4;
                                           // dd($groupeAe,$groupeCp);
    
                                        }
    
                                        if(isset($sousOperation) && $sousOperation->code_t2==20000) {
                                        $groupT2[] = [
                                            "code" => $groupe->code_grp_operation,
                                             "values" => [
                                                'ae_ouvertgrpop' => $groupeAeOuvert,
                                                'ae_attendugrpop' => $groupeAeAttendu,
                                                'cp_ouvertgrpop' => $groupeCpOuvert,
                                                'cp_attendugrpop' => $groupeCpAttendu,
                                                'totalAEgrpop' => $totalgroupAeGlobal,
                                                'totalCPgrpop' => $totalgroupCpGlobal,
    
                                        ]
                                    ];}
                                        // calculer le total ae et cp par colonne
                                        $totalAeOuvertGlobal += $groupeAeOuvert;
                                        $totalAeAttenduGlobal += $groupeAeAttendu;
                                        $totalCpOuvertGlobal += $groupeCpOuvert;
                                        $totalCpAttenduGlobal += $groupeCpAttendu;
    
                                        //dd($totalAeOuvertGlobal,$totalAeAttenduGlobal,$totalCpOuvertGlobal,$totalCpAttenduGlobal);
    
                                        $totalAeT2= $totalAeOuvertGlobal + $totalAeAttenduGlobal; // AE_ouvert + AE_attendu global
                                        $totalCpT2 = $totalCpOuvertGlobal + $totalCpAttenduGlobal;
                                        //dd($totalAeT2,$totalCpT2); //total de sous action
    
             /*************************************************T3*********************************************************************** */
                                         if(isset($sousOperation) && $sousOperation->code_t3==30000) {
                                            $groupT3[] = [
                                                "code" => $groupe->code_grp_operation,
                                                "values" => [
                                                    'ae_reportegrpop' => $groupeAeReporte,
                                                    'ae_notifiegrpop' => $groupeAeNotife,
                                                    'ae_engagegrpop' => $groupeAeEngage,
                                                    'cp_reportegrpop' => $groupeCpReporte,
                                                    'cp_notifiegrpop' => $groupeCpNotife,
                                                    'cp_consomegrpop' => $groupeCpConsome,
    
                                            ]
                                        ]; }
    
                                        // calculer le total ae et cp par colonne
                                        $totalAeReporteGlobal += $groupeAeReporte;
                                        $totalAeNotifieGlobal += $groupeAeNotife;
                                        $totalAeEngageGlobal += $groupeAeEngage;
                                        $totalCpReporteGlobal += $groupeCpReporte;
                                        $totalCpNotifieGlobal += $groupeCpNotife;
                                        $totalCpConsomeGlobal += $groupeCpConsome;
                                        //dd($totalAeReporteGlobal,$totalAeNotifieGlobal,$totalAeEngageGlobal,$totalCpReporteGlobal,$totalCpNotifieGlobal,$totalCpConsomeGlobal);
    
                                        $totalAeT3= $totalAeReporteGlobal + $totalAeNotifieGlobal+ $totalAeEngageGlobal ;
                                        $totalCpT3 = $totalCpReporteGlobal + $totalCpNotifieGlobal+$totalCpConsomeGlobal;
                                        //dd($totalAeT3,$totalCpT3); //total de sous action
    
            /*********************************************************************T1***************************************************** ********/
                                            if(isset($sousOperation) && $sousOperation->code_t1==10000) {
                                                $groupT[] = [
                                                    "code" => $groupe->code_grp_operation,
                                                    "values" => [
                                                        'ae_grpop' => $groupeAe,
                                                        'cp_grpop' => $groupeCp,
    
                                                ]
                                            ];
                                            // calculer le total ae et cp par colonne
                                            $totalAe += $groupeAe;
                                            $totalCp += $groupeCp;}
                                            //dd($totalAe,$totalCp);
    
         /*********************************************************************T1/T4***************************************************** ********/
                                            if(isset($sousOperation) && $sousOperation->code_t4==40000)
                                             {
                                                $groupT4[] = [
                                                    "code" => $groupe->code_grp_operation,
                                                    "values" => [
                                                        'ae_grpop' => $groupeAet4,
                                                        'cp_grpop' => $groupeCpt4,
    
                                                ]
                                            ];
    
    
                                            // calculer le total ae et cp par colonne
                                            $totalAet4 += $groupeAet4;
                                            $totalCpt4 += $groupeCpt4;
                                        }
                                         //   dd($totalAe,$totalCp);
    
    
                            }
                             

                                }



                            }
                        }
                    }
                }
            
                //dd($groupT);
                 // dd($totalAe,$totalCp);
               $totalt2[] = [
                    "values" => [
                        'totalAEouvrtvertical'=> $totalAeOuvertGlobal,
                        'totalAEattenduvertical'=> $totalAeAttenduGlobal ,
                        'totalCPouvrtvertical'=>  $totalCpOuvertGlobal ,
                        'totalCPattenduvertical'=> $totalCpAttenduGlobal ,

                        'totalAE' => $totalAeT2,
                        'totalCP' => $totalCpT2,

                     
                                            ]

                    ];

                    $totalt3[] = [
                        "values" => [
                            'totalAEreportevertical'=> $totalAeReporteGlobal,
                            'totalAEnotifievertical'=> $totalAeNotifieGlobal ,
                            'totalAEengagevertical'=> $totalAeEngageGlobal ,
                            'totalCPreportevertical'=>  $totalCpReporteGlobal ,
                            'totalCPnotifievertical'=> $totalCpNotifieGlobal ,
                            'totalCPconsomevertical'=> $totalCpConsomeGlobal ,

                            'totalAE' => $totalAeT3,
                            'totalCP' => $totalCpT3,
                        ]

                        ];

                        $totalt[] = [
                            "values" => [

                                'totalAE' => $totalAe,
                                'totalCP' => $totalCp,
                            ]

                            ];

                            $totalt4[] = [
                                "values" => [

                                    'totalAE' => $totalAet4,
                                    'totalCP' => $totalCpt4,
                                ]

                                ];

                     // retourner les résultats


                      return[
                           'T2'=>['sousOperation' => $sousOperationT2,
                            'operation' => $operationT2,
                            'group' => $groupT2,
                            'total' => $totalt2,] ,


                           'T3'=>['sousOperation' => $sousOperationT3,
                            'operation' => $operationT3,
                            'group' => $groupT3,
                            'total' => $totalt3,] ,

                            'T1'=>['sousOperation' => $sousOperationT,
                            'operation' => $operationT,
                            'group' => $groupT,
                            'total' => $totalt,] ,

                           'T4'=>['sousOperation' => $sousOperationT4,
                            'operation' => $operationT4,
                            'group' => $groupT4,
                            'total' => $totalt4,] ,
                        ];






                            }
}
