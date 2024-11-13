<?php

namespace App\Http\Controllers;
use App\Services\CalculDpia;
use App\Models\GroupOperation;
use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;

class opeartionController extends Controller
{
    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }

    public function calculerEtEnvoyer($port, $prog, $sous_prog, $act,$s_act)
    {
       
        //dd($port, $prog, $sous_prog, $act);
      
       /* $port = $request->input('port');
        $prog = $request->input('prog');
        $sous_prog = $request->input('sous_prog');
        $act = $request->input('act');
        $s_act = $request->input('s_act');
*/
        try {
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
            dd($resultats );
               // eenvoyer les résultats en JSON
               return view('Action-in.index',compact('port','prog','sous_prog','act','s_act','resultats'));
           // return response()->json($resultats);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        }


        public function afficherDPIA($s_act,$T)
        {
            try {
                 // dd($s_act, $T);
            //get toutes les données des 3 tables 
            $groupOperations = DB::table('group_operations as go')
            ->leftJoin('operations as o', 'go.code_grp_operation', '=', 'o.code_grp_operation')
            ->leftJoin('sous_operations as so', 'o.code_operation', '=', 'so.code_operation')
            ->select('go.*', 'o.*', 'so.*')
            ->get();
         //   dd($groupOperations);

            // creer un tableau pour structurer les données 
            $results = [
                'T1' => [],
                'T2' => [],
                'T3' => [],
                'T4' => []
            ];

            //parcourir les resultats 
            foreach ($groupOperations as $grpoperation) {
                //initialiser t pour dire quel t appartient les ae et cp
                $t= '';

                if ($grpoperation->code_t1==10000) {
                    $t = 'T1';
                } elseif ($grpoperation->code_t2==20000) {
                    $t = 'T2';
                } elseif ($grpoperation->code_t3==30000) {
                    $t = 'T3';
                } elseif ($grpoperation->code_t4==40000) {
                    $t = 'T4';
                }else{ $t = 'Non défini';}

                if ($t == $T ) {
               
                $data = [
                    'AE_sous_operation' => $grpoperation->AE_sous_operation,
                    'CP_sous_operation' => $grpoperation->CP_sous_operation,
                    'AE_ouvert' => $grpoperation->AE_ouvert,
                    'AE_attendu' => $grpoperation->AE_atendu,
                    'CP_ouvert' => $grpoperation->CP_ouvert,
                    'CP_attendu' => $grpoperation->CP_atendu,
                    'AE_notifie' => $grpoperation->AE_notifie,
                    'AE_reporte' => $grpoperation->AE_reporte,
                    'AE_engage' => $grpoperation->AE_engage,
                    'CP_reporte' => $grpoperation->CP_reporte,
                    'CP_notifie' => $grpoperation->CP_notifie,
                    'CP_consomme' => $grpoperation->CP_consome
                ];

                // supprimer les champs avec des valeurs null pour eviter t1 avec d'autres ae et  cp 
                $data = array_filter($data, function ($value) {
                    return !is_null($value);
                });

                // ajouter les données dans le tableau results
                if (!empty($data)) {
                    $results[$T][] = [
                        'code_grp_operation' => $grpoperation->code_grp_operation,
                        'code_operation' => $grpoperation->code_operation,
                        'code_sous_operation' => $grpoperation->code_sous_operation,
                        'AE_CP' => $data
                    ];
                }
            }
            }
                //retourner results
                return response()->json([
                    'code' =>200, //success
                    'message' => 'Données récupérées avec succès.',
                    'results' => $results  
                ]);
        
            } catch (\Exception $e) {
                // en cas d'erreur retourner un message d'erreur 
                return response()->json([
                    'code' => 500, //erreur
                    'message' => 'Une erreur est survenue : ' . $e->getMessage(),
                ], 500); // 500 pour erreur serveur interne (not found)
            }
        
        }
    }
    
        
