<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SousOperation;
use App\Models\Portefeuille;
use App\Models\ModificationT;
use App\Models\ConstruireDPIA;
use Illuminate\Support\Facades\DB;

class modificationController extends Controller
{
    //fct update sous operation et insert dpia ac motif update
    public function updateSousOperation(Request $request)
    {
       
        //récupérer les données de request
        $data = $request->all();
        //dd($data);
        // déterminer le type de données reçues est ce qu'ils sont T ou les valeurs qui sont dans tableau T[]
        $Tport = $data['Tport']; //arrey_key_first permet de récupérer la clé principale du tableau (t1 t2 t3 t4...)
        $resultats = $data['result']; //les valeurs [code_sous_op,ae et cp]
        //dd($Tport);
        //dd( $resultats );
        //validation
        if (!in_array($Tport, ['1', '2', '3', '4'])) {
            return response()->json(['erreur' => 'Type de T invalide reçu '], 400);
        }

        $validated = $request->validate([
            'result.*.code' => 'required|string|exists:sous_operations,code_sous_operation',
        ]);
        
        try {

            foreach ($resultats as $resultat) {
                $code = $resultat['code']; // récupérer le code
                $values = $resultat['value']; 
    
            // récupérer la ligne d'entrée
            $sousOperation = SousOperation::where('code_sous_operation', $code)->firstOrFail();
            //dd($sousOperation);
           // modification d'aprés les t
            switch ($Tport) {
                case '1':
                    $this->ModifT1($sousOperation, $values);
                    break;

                case '2':
                    $this->ModifT2($sousOperation, $values);
                    break;

                case '3':
                    $this->ModifT3($sousOperation, $values);
                    break;

                case '4':
                    $this->ModifT4($sousOperation, $values);
                    break;
            }
        }

            return response()->json(['message' => 'Mise à jour réussie et ajout dans ConstruireDPIA'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour ou de l\'ajout', 'details' => $e->getMessage()], 500);
        }
    }

    private function ModifT1(SousOperation $sousOperation, $values)
    {
       
     // dd($values,$sousOperation);
      //extrair le num de portefeuille les 7 premiers chiffres
      $codeSousOperation = $sousOperation->code_sous_operation;
      //dd( $codeSousOperation);
      $numPortefeuille = substr($codeSousOperation, 0, 7); 
      //dd( $numPortefeuille );
      $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();
  
        //update dans sous operation
        $sousOperation->update([
            'AE_sous_operation' => $values['ae'] ?? $sousOperation->AE_sous_operation, //si existe ok sinn aucune modif (ae_sous_op sera utilisé)
            'CP_sous_operation' => $values['cp'] ?? $sousOperation->CP_sous_operation,
            'date_update_SOUSoperation' => now(),
        ]);
        //dd($sousOperation);
        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' =>  $sousOperation->code_sous_operation,
            'motif_dpia' => 'Modification T1',
            'date_creation_dpia' => $portefeuille ? $portefeuille->Date_portefeuille : null, 
            'AE_dpia_nv' => $values['ae'] ?? $sousOperation->AE_sous_operation, //si existe ok sinn aucune modif (ae_sous_op sera utilisé)
            'CP_dpia_nv' => $values['cp'] ?? $sousOperation->CP_sous_operation,
            'date_modification_dpia' => now(),
            'AE_ouvert_dpia' => null,
            'AE_atendu_dpia' => null,
            'CP_ouvert_dpia' => null,
            'CP_atendu_dpia' => null,
            'AE_reporte_dpia' => null,
            'AE_notifie_dpia' => null,
            'AE_engage_dpia' => null,
            'CP_reporte_dpia' => null,
            'CP_notifie_dpia' => null,
            'CP_consome_dpia' => null,
            'id_rp' => 1,
            'id_ra' => 1,
          
        ]);
    }

    private function ModifT2(SousOperation $sousOperation, $values)
    {
        //extrair le num de portefeuille les 7 premiers chiffres
      $codeSousOperation = $sousOperation->code_sous_operation;
      //dd( $codeSousOperation);
      $numPortefeuille = substr($codeSousOperation, 0, 7); 
      //dd( $numPortefeuille );
      $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();
  
        $sousOperation->update([
            'AE_ouvert' => $values['ae_ouvert'] ?? $sousOperation->AE_ouvert,
            'AE_atendu' => $values['ae_atendu'] ?? $sousOperation->AE_atendu,
            'CP_ouvert' => $values['cp_ouvert'] ?? $sousOperation->CP_ouvert,
            'CP_atendu' => $values['cp_atendu'] ?? $sousOperation->CP_atendu,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
           'code_sous_operation' =>  $sousOperation->code_sous_operation,
            'motif_dpia' => 'Modification T2',
            'date_creation_dpia' => $portefeuille->Date_portefeuille,
            'date_modification_dpia' => now(),
           
            'AE_dpia_nv' => null,
            'CP_dpia_nv' => null,
    
            'AE_ouvert_dpia' => $values['ae_ouvert'] ?? $sousOperation->AE_ouvert,
            'AE_atendu_dpia' => $values['ae_atendu'] ?? $sousOperation->AE_atendu,
            'CP_ouvert_dpia' => $values['cp_ouvert'] ?? $sousOperation->CP_ouvert,
            'CP_atendu_dpia' => $values['cp_atendu'] ?? $sousOperation->CP_atendu,
    
            'AE_reporte_dpia' => null,
            'AE_notifie_dpia' => null,
            'AE_engage_dpia' => null,
            'CP_reporte_dpia' => null,
            'CP_notifie_dpia' => null,
            'CP_consome_dpia' => null,
            'id_rp' => 1,
            'id_ra' => 1,
         
        ]);
    }

    private function ModifT3(SousOperation $sousOperation, $values)
    {
        //extrair le num de portefeuille les 7 premiers chiffres
      $codeSousOperation = $sousOperation->code_sous_operation;
      //dd( $codeSousOperation);
      $numPortefeuille = substr($codeSousOperation, 0, 7); 
      //dd( $numPortefeuille );
      $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();
  
        
        $sousOperation->update([
            'AE_reporte' => $values['ae_reporte'] ?? $sousOperation->AE_reporte,
            'CP_reporte' => $values['cp_reporte'] ?? $sousOperation->CP_reporte,
            'AE_notifie' => $values['ae_notifie'] ?? $sousOperation->AE_notifie,
            'CP_notifie' => $values['cp_notifie'] ?? $sousOperation->CP_notifie,
            'AE_engage' => $values['ae_engage'] ?? $sousOperation->AE_engage,
            'CP_consome' => $values['cp_consome'] ?? $sousOperation->CP_consome,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
           'code_sous_operation' =>  $sousOperation->code_sous_operation,
           'motif_dpia' => 'Modification T3',
           'date_creation_dpia' => $portefeuille->Date_portefeuille,
           'date_modification_dpia' => now(),
                           
            'AE_dpia_nv' => null,
            'CP_dpia_nv' => null,
                    
            'AE_ouvert_dpia' => null,
            'AE_atendu_dpia' => null,
            'CP_ouvert_dpia' => null,
            'CP_atendu_dpia' => null,
                    
            'AE_reporte_dpia' => $values['ae_reporte'] ?? $sousOperation->AE_reporte,
            'AE_notifie_dpia' =>  $values['ae_notifie'] ?? $sousOperation->AE_notifie,
            'AE_engage_dpia' => $values['ae_engage'] ?? $sousOperation->AE_engage,
            'CP_reporte_dpia' => $values['cp_reporte'] ?? $sousOperation->CP_reporte,
            'CP_notifie_dpia' => $values['cp_notifie'] ?? $sousOperation->CP_notifie,
            'CP_consome_dpia' => $values['cp_consome'] ?? $sousOperation->CP_consome,
            'id_rp' => 1,
            'id_ra' => 1,
        ]);
    }

    private function ModifT4(SousOperation $sousOperation, $values)
            {
        //extrair le num de portefeuille les 7 premiers chiffres
        $codeSousOperation = $sousOperation->code_sous_operation;
        //dd( $codeSousOperation);
        $numPortefeuille = substr($codeSousOperation, 0, 7); 
        //dd( $numPortefeuille );
        $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();

        $sousOperation->update([
            'AE_sous_operation' => $values['ae'] ?? $sousOperation->AE_sous_operation,
            'CP_sous_operation' => $values['cp'] ?? $sousOperation->CP_sous_operation,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' =>  $sousOperation->code_sous_operation,
            'motif_dpia' => 'Modification T4',
            'date_creation_dpia' => $portefeuille->Date_portefeuille,
            'date_modification_dpia' =>now(),
                        
            'AE_dpia_nv' =>$values['ae'] ?? $sousOperation->AE_sous_operation,
            'CP_dpia_nv' =>$values['cp'] ?? $sousOperation->CP_sous_operation,
                
            'AE_ouvert_dpia' => null,
            'AE_atendu_dpia' => null,
            'CP_ouvert_dpia' => null,
            'CP_atendu_dpia' => null,
                
            'AE_reporte_dpia' => null,
            'AE_notifie_dpia' => null,
            'AE_engage_dpia' => null,
            'CP_reporte_dpia' => null,
            'CP_notifie_dpia' => null,
            'CP_consome_dpia' => null,
            'id_rp' => 1,
            'id_ra' => 1,
                
        ]);
    }

    //insérer dans la table moddif
    public function insertModif(Request $request)
    {
        //récupéreer lees données 
        $modifications = $request->all();

        foreach ($modifications as $modif) {
            // valider les données reçues
            $validated = validator($modif, [
            'ref' => 'required|integer',
            'AE_T1' => 'required|numeric',//rçoit
            'CP_T1' => 'required|numeric',
            'AE_T2' => 'required|numeric',
            'CP_T2' => 'required|numeric',
            'AE_T3' => 'required|numeric',
            'CP_T3' => 'required|numeric',
            'AE_T4' => 'required|numeric',
            'CP_T4' => 'required|numeric',
            'T_port_env' => 'required|string',
            'AE_env_T' => 'required|numeric',
            'CP_env_T' => 'required|numeric',
            'Sous_prog_env' => 'required|string',
            'type' => 'required|string',
            'cible' => 'required|string',
            'status' => 'required|boolean',
            ])->validate();

            //initialiser lees var 
            $AE_env_T1 = 0;
            $CP_env_T1 = 0;

            $AE_env_T2 = 0;
            $CP_env_T2 = 0;

            $AE_env_T3 = 0;
            $CP_env_T3 = 0;

            $AE_env_T4 = 0;
            $CP_env_T4 = 0;

            $codeT1 = $codeT2 = $codeT3 = $codeT4 = null;
        // remplir les colonnes d'envoi en fonction de T_port_env
        switch ($validated['T_port_env']) {
            case 'T1':
                $AE_env_T1 = $validated['AE_env_T'];
                $CP_env_T1 = $validated['CP_env_T'];
                $codeT1 =T1::value('code_t1');

                break;
            case 'T2':
                $AE_env_T2 = $validated['AE_env_T'];
                $CP_env_T2 = $validated['CP_env_T'];
                $codeT2 =T2::value('code_t2');
              
                break;
            case 'T3':
                $AE_env_T3 = $validated['AE_env_T'];
                $CP_env_T3 = $validated['CP_env_T'];
                $codeT3 = T3::value('code_t3');
               
                break;
            case 'T4':
                $AE_env_T4 = $validated['AE_env_T'];
                $CP_env_T4 = $validated['CP_env_T'];
                $codeT4 = T4::value('code_t4');
               
                break;
        }

        if ($validated['AE_T1'] != 0 || $validated['CP_T1'] != 0) {
            $codeT1 = T1::value('code_t1');
        }
        if ($validated['AE_T2'] != 0 || $validated['CP_T2'] != 0) {
            $codeT2 = T2::value('code_t2');
        }
        if ($validated['AE_T3'] != 0 || $validated['CP_T3'] != 0) {
            $codeT3 = T3::value('code_t3');
        }
        if ($validated['AE_T4'] != 0 || $validated['CP_T4'] != 0) {
            $codeT4 = T4::value('code_t4');
        }

        // insérer les données dans la table modif
        ModificationT::insert([
            'date_modif' => now(),

            'AE_envoi_t1' => $AE_env_T1,
            'CP_envoi_t1' => $CP_env_T1,
            'AE_envoi_t2' => $AE_env_T2,
            'CP_envoi_t2' =>$CP_env_T2 ,
            'AE_envoi_t3' => $AE_env_T3,
            'CP_envoi_t3' =>$CP_env_T3 ,
            'AE_envoi_t4' => $AE_env_T4,
            'CP_envoi_t4' =>  $CP_env_T4,

           
            'AE_recoit_t1' => $validated['AE_T1'] ,
            'CP_recoit_t1' => $validated['CP_T1'],
            'AE_recoit_t2' => $validated['AE_T2'],
            'CP_recoit_t2' => $validated['CP_T2'],
            'AE_recoit_t3' => $validated['AE_T3'],
            'CP_recoit_t3' => $validated['CP_T3'],
            'AE_recoit_t4' =>$validated['AE_T4'] ,
            'CP_recoit_t4' =>$validated['CP_T4'],

            'situation_modif' => $validated['status'],
            'type_modif' => $validated['type'],
            'id_art' => $validated['ref'], 
            
            'code_t1' => $codeT1,
            'code_t2' => $codeT2,
            'code_t3' => $codeT3,
            'code_t4' => $codeT4,

          
           
        ]);
    }

    return response()->json(['message' => 'Modifications insérées avec succès'], 200);
}
       
}
