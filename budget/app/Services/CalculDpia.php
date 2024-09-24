<?php
namespace App\Services;

use App\Models\Portefeuille;

class CalculDpia
{
    public function calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act)
    {
      /*  // décomposer le chemin (portefeuille, programme, sous-programme, action, sous-action)
        $chemin = explode('/', $path);
        if (count($chemin) < 1) {
            throw new \Exception("Le chemin n'est pas valide");
        }*/
        $port = intval($port);
        $prog = intval($prog);
        $sous_prog = intval($sous_prog);
        $act = intval($act);
        $s_act = intval($s_act);
          //dd($port, $prog, $sous_prog, $act);
        // récupérer le portefeuille à partir du chemin
        $portefeuille = Portefeuille::where('num_portefeuil',$port)
            ->with([
                'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation.SousOperation'
            ])->first();
       // dd( $portefeuille);
        if (!$portefeuille) {
            throw new \Exception("Portefeuille introuvable");
        }

        $totalAeT2 = 0; 
        $totalCpT2 = 0; 
        $totalAeT3 = 0;
        $totalCpT3 = 0;
                                     

        $groupT2 = [];
        $totalt2= [];
        $operationT2 = [];
        $sousOperationT2 = [];

        $totalAeOuvertGlobal=0;
        $totalAeAttenduGlobal=0;
        $totalCpOuvertGlobal=0;
        $totalCpAttenduGlobal=0;

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
                           // dd($groupe);
                            $groupeAeOuvert = 0;
                            $groupeAeAttendu = 0;
                            $groupeCpOuvert = 0;
                            $groupeCpAttendu = 0;
                           
                            foreach ($groupe->Operation as $operation) {
                              //  dd($operation);
                                $operationAeOuvert = 0;
                                $operationAeAttendu = 0;
                                $operationCPOuvert = 0;
                                $operationCPAttendu = 0;

                           

                                    // calculer la somme de chaque sous op 
                                    foreach ($operation->SousOperation as $sousOperation) {
                                        //dd($sousOperation);
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
                                     
                                        $sousOperationT2[] = [
                                            "code" => $sousOperation->code_sous_operation,
                                            "values" => [
                                                'ae_ouvertsousop' => $sousopAeouvert, 
                                                'ae_attendusousop' => $sousopAeattendu,
                                                'cp_ouvertsousop' => $sousopCpouvert,
                                                'cp_attendsousuop' => $sousopCpattendu,
                                                'totalAEsousop' => $totalSousAeGlobal,
                                                'totalCPsousop' => $totalSousCpGlobal,
                                            ]  ];
                        
                                           
                        

                                    }
                                 
                               // dd($operationAeOuvert,$operationAeAttendu,$operationCPOuvert , $operationCPAttendu);
                                //dd($totalOPAeGlobal,$totalOPCpGlobal);
                
                                $operationT2[] = [
                                    "code" => $operation->code_operation,
                                    "values" => [
                                        'ae_ouvertop' => $operationAeOuvert, 
                                        'ae_attenduop' => $operationAeAttendu,
                                        'cp_ouvertop' => $operationCPOuvert,
                                        'cp_attenduop' => $operationCPAttendu,
                                        'totalAEop' => $totalOPAeGlobal, //total horizontal
                                        'totalCPop' => $totalOPCpGlobal,
                                    ]  ];
                              
                                    // ajouter les valeurs de l'operation au groupe d'op
                                    $groupeAeOuvert += $operationAeOuvert;
                                    $groupeAeAttendu += $operationAeAttendu;
                                    $groupeCpOuvert += $operationCPOuvert;
                                    $groupeCpAttendu += $operationCPAttendu;

                                    //dd($groupeAeOuvert,$groupeAeAttendu,$groupeCpOuvert , $groupeCpAttendu);

                                    $totalgroupAeGlobal = $groupeAeOuvert + $groupeAeAttendu; // AE_ouvert + AE_attendu global horizental
                                    $totalgroupCpGlobal = $groupeCpOuvert + $groupeCpAttendu;

                                   // dd($totalgroupAeGlobal,$totalgroupCpGlobal);
                                    }

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
                                ];
                                    // calculer le total ae et cp par colonne 
                                    $totalAeOuvertGlobal += $groupeAeOuvert;
                                    $totalAeAttenduGlobal += $groupeAeAttendu;
                                    $totalCpOuvertGlobal += $groupeCpOuvert;
                                    $totalCpAttenduGlobal += $groupeCpAttendu;

                                    //dd($totalAeOuvertGlobal,$totalAeAttenduGlobal,$totalCpOuvertGlobal,$totalCpAttenduGlobal); 

                                    $totalAeT2= $totalAeOuvertGlobal + $totalAeAttenduGlobal; // AE_ouvert + AE_attendu global
                                    $totalCpT2 = $totalCpOuvertGlobal + $totalCpAttenduGlobal;
                                    //dd($totalAeT2,$totalCpT2);
                                }
                            }
                        }
                    }
                }
               
               $totalt2[] = [
                    "values" => [
                        'totalAEouvrtvertical'=> $totalAeOuvertGlobal,
                        'totalAEattenduvertical'=> $totalAeAttenduGlobal ,
                        'totalCPouvrtvertical'=>  $totalCpOuvertGlobal ,
                        'totalCPattenduvertical'=> $totalCpAttenduGlobal ,

                        'totalAEt2' => $totalAeT2,
                        'totalCPt2' => $totalCpT2,
                    ]

                    ];

                     // retourner les résultats
                        return [
                                        'sousOperationT2' => $sousOperationT2,
                                        'operationT2' => $operationT2,
                                        'groupT2' => $groupT2,
                                        'totalT2' => $totalt2,
                                  
                                ];
                                      
                            }
}
