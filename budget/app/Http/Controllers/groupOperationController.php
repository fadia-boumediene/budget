<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupOperation;
use App\Models\Portefeuille;
use App\Models\operation;
use App\Models\sousOperation;
use App\Models\ConstruireDPIA;
use App\Models\ConstruireDPIC;
use Carbon\Carbon;
class groupOperationController extends Controller
{
//===================================================================================
                            //insertion DPA
//===================================================================================
    public function insertDPA(Request $request,$port,$prog,$sous_prog,$act, $s_act,$T )
{
   $currentDateTime = Carbon::now();
   $port=intval($port);
  // dd($port);

    //$year = date('Y'); // Récupérer l'année actuelle
    //$sousaction=$s_act.$act.$sous_prog.$prog.$port.$year;
//dd($act);
//dd($T);
//dd($request);
//===================================================================================
                            //insertion T1
//===================================================================================
if($T==1)
{
    // Récupérer les données du formulaire
    $aeData = $request->input('ae');
    $cpData = $request->input('cp');

    // Chemin vers le fichier JSON dans public/assets/titre
    $jsonFilePath = public_path('assets/Titre/dataT1.json');

    // Lire le contenu du fichier JSON
    if (file_exists($jsonFilePath)) {
        $jsonData = json_decode(file_get_contents($jsonFilePath), true);

        // Vérification du décodage JSON
        if ($jsonData === null) {
            return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
        }

        // Vérifier si le JSON est un tableau associatif
        if (!is_array($jsonData) || empty($jsonData)) {
            return response()->json(['error' => 'Le fichier JSON est vide ou mal formaté.'], 404);
        }
    } else {
        // Gérer le cas où le fichier n'existe pas
        return response()->json(['error' => 'Le fichier JSON est introuvable.'], 404);
    }

   // Parcourir les éléments du fichier JSON
foreach ($jsonData as $codeStr => $nom) {
    // S'assurer que le code est une chaîne de caractères
    $code = (string) $codeStr;
        $ae = $aeData[$code] ?? 0.00;
        $cp = $cpData[$code] ?? 0.00;

        // Vérifier si le code est manquant
        if (!$code) {
            return response()->json([
                'success' => false,
                'message' => 'Code manquant pour l\'élément avec nom : '.$nom,
                'code' => 404,
            ]);
        }

        // Vérifier si le nom est manquant
        if (!$nom) {
            return response()->json([
                'success' => false,
                'message' => 'Nom manquant pour l\'élément avec code : '.$code,
                'code' => 404,
            ]);
        }

        // Vérifier si le code représente un groupe d'opérations
        if ($code % 1000 == 0) {
            // Insertion dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_grp_operation' => $code.$s_act],
                ['nom_grp_operation' => $nom, 'num_sous_action' => $s_act,
                 'date_insert_grp_operation' => $currentDateTime]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code.$codeGp.$s_act],
                ['code_grp_operation' => $codeGp.$s_act, 'nom_operation' => $nom,
                 'date_insert_operation' => $currentDateTime]
            );

           // Vérifier la ligne suivante
           $keys = array_keys($jsonData);
           $currentIndex = array_search($codeStr, $keys); // Trouver l'index du code actuel

           if ($currentIndex !== false && isset($keys[$currentIndex + 1])) {
               $nextKey = $keys[$currentIndex + 1]; // Obtenir la clé suivante
               $nextItem = $jsonData[$nextKey]; // Obtenir l'élément suivant par sa clé

               // Récupérer le code correspondant au nom suivant
               $nextCode = $nextKey; // La clé suivante est déjà le code


                // Si la ligne suivante n'est pas une sous-opération
                if ($nextCode && ($nextCode % 100 == 0 || $nextCode % 1000 == 0)) {
                    // Insérer dans sousoperation avec un code spécifique
                    $sousoperation = sousoperation::updateOrCreate(
                        ['code_sous_operation' => $code.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                        ['code_operation' => $code.$codeGp.$s_act, 'nom_sous_operation' => $nom,'code_t1' =>10000,
                         'AE_sous_operation' => floatval(str_replace(',', '', $ae)),
                         'CP_sous_operation' => floatval(str_replace(',', '', $cp))
                         , 'date_insert_SOUSoperation' => $currentDateTime]
                    );


                        // creation de la table  construireDPIA
                        $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                       // dd($portefeuille);

                        if ($portefeuille) {
                            // Création de la table ConstruireDPIA
                            $DPIA = new ConstruireDPIA();


                            $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                            $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                            $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                            $DPIA->AE_dpia_nv = $sousoperation->AE_sous_operation;
                            $DPIA->CP_dpia_nv = $sousoperation->CP_sous_operation;


                            $DPIA->AE_ouvert_dpia = null;
                            $DPIA->AE_atendu_dpia = null;
                            $DPIA->CP_ouvert_dpia = null;
                            $DPIA->CP_atendu_dpia = null;

                            $DPIA->AE_reporte_dpia = null;
                            $DPIA->AE_notifie_dpia = null;
                            $DPIA->AE_engage_dpia = null;
                            $DPIA->CP_reporte_dpia = null;
                            $DPIA->CP_notifie_dpia = null;
                            $DPIA->CP_consome_dpia = null;

                            $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                            $DPIA->id_rp = 1;
                            $DPIA->id_ra = 1;


                            $DPIA->save();
                        } else {
                            // si le portefeuille n'existe pas
                            dd('Portefeuille non trouvé');
                        }

                       // dd( $DPIA);
               // mettre à jour ConstruireDPIA
             /*$DPIA = ConstruireDPIA::whereNull('code_sous_operation')->first();

             if ($DPIA) {

                 $DPIA->update([
                    'code_sous_operation' => $sousoperation->code_sous_operation,
                     'AE_dpia_nv' => $sousoperation->AE_sous_operation,
                     'CP_dpia_nv' => $sousoperation->CP_sous_operation,
                     'date_modification_dpia' => now(),
                 ]);


             $DPIA->save();

                }*/
                }
            }else{
                // Insérer dans sousoperation avec un code spécifique
                $sousoperation=sousoperation::updateOrCreate(
                    ['code_sous_operation' => $code.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                    ['code_operation' => $code.$codeGp.$s_act, 'nom_sous_operation' => $nom,'code_t1' =>10000,
                     'AE_sous_operation' => floatval(str_replace(',', '', $ae)),
                     'CP_sous_operation' => floatval(str_replace(',', '', $cp))
                     , 'date_insert_SOUSoperation' => $currentDateTime]
                );


               // creation de la table  construireDPIA
               $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
               // dd($portefeuille);

                if ($portefeuille) {
                    // Création de la table ConstruireDPIA
                    $DPIA = new ConstruireDPIA();


                    $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                    $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                    $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                    $DPIA->AE_dpia_nv = $sousoperation->AE_sous_operation;
                    $DPIA->CP_dpia_nv = $sousoperation->CP_sous_operation;


                    $DPIA->AE_ouvert_dpia = null;
                    $DPIA->AE_atendu_dpia = null;
                    $DPIA->CP_ouvert_dpia = null;
                    $DPIA->CP_atendu_dpia = null;

                    $DPIA->AE_reporte_dpia = null;
                    $DPIA->AE_notifie_dpia = null;
                    $DPIA->AE_engage_dpia = null;
                    $DPIA->CP_reporte_dpia = null;
                    $DPIA->CP_notifie_dpia = null;
                    $DPIA->CP_consome_dpia = null;

                    $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                    $DPIA->id_rp = 1;
                    $DPIA->id_ra = 1;


                    $DPIA->save();
                } else {
                    // si le portefeuille n'existe pas
                    dd('Portefeuille non trouvé');
                }
                // dd( $DPIA);
           // mettre à jour ConstruireDPIA
          /* $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->first();

           if ($DPIA) {

               $DPIA->update([
                  'code_sous_operation' => $sousoperation->code_sous_operation,
                   'AE_dpia_nv' => $sousoperation->AE_sous_operation,
                   'CP_dpia_nv' => $sousoperation->CP_sous_operation,
                   'date_modification_dpia' => now(),
               ]);


           $DPIA->save();

              }*/
                 }
            }

        // Sinon, il s'agit d'une sous-opération
        else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            $sousoperation= sousoperation::updateOrCreate(
                ['code_sous_operation' => $code.$codeOp.$codeGp.$s_act],
                ['code_operation' => $codeOp.$codeGp.$s_act, 'nom_sous_operation' => $nom,'code_t1' =>10000,
                 'AE_sous_operation' => floatval(str_replace(',', '', $ae)),
                  'CP_sous_operation' => floatval(str_replace(',', '', $cp))
                  , 'date_insert_SOUSoperation' => $currentDateTime]
            );

             // creation de la table  construireDPIA
             $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
             // dd($portefeuille);

              if ($portefeuille) {
                  // Création de la table ConstruireDPIA
                  $DPIA = new ConstruireDPIA();


                  $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                  $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                  $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                  $DPIA->AE_dpia_nv = $sousoperation->AE_sous_operation;
                  $DPIA->CP_dpia_nv = $sousoperation->CP_sous_operation;


                  $DPIA->AE_ouvert_dpia = null;
                  $DPIA->AE_atendu_dpia = null;
                  $DPIA->CP_ouvert_dpia = null;
                  $DPIA->CP_atendu_dpia = null;

                  $DPIA->AE_reporte_dpia = null;
                  $DPIA->AE_notifie_dpia = null;
                  $DPIA->AE_engage_dpia = null;
                  $DPIA->CP_reporte_dpia = null;
                  $DPIA->CP_notifie_dpia = null;
                  $DPIA->CP_consome_dpia = null;

                  $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                  $DPIA->id_rp = 1;
                  $DPIA->id_ra = 1;


                  $DPIA->save();
              } else {
                  // si le portefeuille n'existe pas
                  dd('Portefeuille non trouvé');
              }
            // dd( $DPIA);
             // mettre à jour ConstruireDPIA
            /* $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->first();

             if ($DPIA) {

                 $DPIA->update([
                    'code_sous_operation' => $sousoperation->code_sous_operation,
                     'AE_dpia_nv' => $sousoperation->AE_sous_operation,
                     'CP_dpia_nv' => $sousoperation->CP_sous_operation,
                     'date_modification_dpia' => now(),
                 ]);


             $DPIA->save();

                }*/
        }
    }

    /*return response()->json([
        'success' => true,
        'message' => 'Données insérées avec succès !',
        'code' => 200,
    ]);*/
    return redirect()->back();


//===================================================================================
//                            FIN insertion T1
//==================================================================================
}
//===================================================================================
                            //insertion T2
//===================================================================================
elseif ($T == 2) {
    // Récupérer les données du formulaire
    $aeDataOuvert = $request->input('ae_ouvert');
    $cpDataOuvert = $request->input('cp_ouvert');
    $aeDataAttendu = $request->input('ae_attendu');
    $cpDataAttendu = $request->input('cp_attendu');
    // $currentDateTime = Carbon::now();

    // Chemin vers le fichier JSON dans public/titre
    $jsonFilePath = public_path('assets/Titre/dataT2.json');

    // Lire le contenu du fichier JSON
    if (file_exists($jsonFilePath)) {
        $jsonData = json_decode(file_get_contents($jsonFilePath), true);
    } else {
        // Gérer le cas où le fichier n'existe pas
        return response()->json(['error' => 'Le fichier JSON est introuvable T2.'], 404);
    }

    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
    }

    // Parcourir les éléments du fichier JSON
    foreach ($jsonData as $codeStr => $nom) {
        // S'assurer que le code est une chaîne de caractères
        $code = (string) $codeStr;
        $ae_ouvert = $aeDataOuvert[$code] ?? 0.00;
        $cp_ouvert = $cpDataOuvert[$code] ?? 0.00;
        $ae_attendu = $aeDataAttendu[$code] ?? 0.00;
        $cp_attendu = $cpDataAttendu[$code] ?? 0.00;

        // Vérifier si le code est manquant
        if (!$code) {
            return response()->json([
                'success' => false,
                'message' => 'Code manquant pour l\'élément avec nom : '.$nom,
                'code' => 404,
            ]);
        }

        // Vérifier si le nom est manquant
        if (!$nom) {
            return response()->json([
                'success' => false,
                'message' => 'Nom manquant pour l\'élément avec code : '.$code,
                'code' => 404,
            ]);
        }

        // Vérifier si le code représente un groupe d'opérations
        if ($code % 1000 == 0) {
            // Insertion dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_grp_operation' => $code.$s_act],
                ['nom_grp_operation' => $nom, 'num_sous_action' => $s_act, 'date_insert_grp_operation' => $currentDateTime]
            );

            // Vérifier la ligne suivante
            $keys = array_keys($jsonData);
            $currentIndex = array_search($codeStr, $keys); // Trouver l'index du code actuel

            if ($currentIndex !== false && isset($keys[$currentIndex + 1])) {
                $nextKey = $keys[$currentIndex + 1]; // Obtenir la clé suivante
                $nextItem = $jsonData[$nextKey]; // Obtenir l'élément suivant par sa clé

                // Récupérer le code correspondant au nom suivant
                $nextCode = $nextKey; // La clé suivante est déjà le code

                // Si la ligne suivante n'est pas une sous-opération
                if ($nextCode && $nextCode % 1000 == 0) {
                   // dd($nextCode, $ae_attendu, $cp_attendu);
                    // Insérer dans sousoperation avec un code spécifique
                    $sousoperation=sousoperation::updateOrCreate(
                        ['code_sous_operation' => $code.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                        [
                            'code_operation' =>  $code.$s_act,
                            'nom_sous_operation' => $nom,
                            'code_t2' => 20000,
                            //'AE_sous_operation' => floatval(str_replace(',', '', $ae_attendu)) + floatval(str_replace(',', '', $ae_ouvert)),
                            //'CP_sous_operation' => floatval(str_replace(',', '', $cp_attendu)) + floatval(str_replace(',', '', $cp_ouvert)),
                            'AE_atendu' => floatval(str_replace(',', '', $ae_attendu)),
                            'AE_ouvert' => floatval(str_replace(',', '', $ae_ouvert)),
                            'CP_ouvert' => floatval(str_replace(',', '', $cp_ouvert)),
                            'CP_atendu' => floatval(str_replace(',', '', $cp_attendu)),
                            'date_insert_SOUSoperation' => $currentDateTime
                        ]
                    );


                // creation de la table  construireDPIA
                $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                // dd($portefeuille);

                if ($portefeuille) {

                    $DPIA = new ConstruireDPIA();


                    $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                    $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                    $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                    $DPIA->AE_dpia_nv = null;
                    $DPIA->CP_dpia_nv = null;


                    $DPIA->AE_ouvert_dpia = $sousoperation->AE_ouvert;
                    $DPIA->AE_atendu_dpia = $sousoperation->AE_atendu;
                    $DPIA->CP_ouvert_dpia = $sousoperation->CP_ouvert;
                    $DPIA->CP_atendu_dpia = $sousoperation->CP_atendu;

                    $DPIA->AE_reporte_dpia = null;
                    $DPIA->AE_notifie_dpia = null;
                    $DPIA->AE_engage_dpia = null;
                    $DPIA->CP_reporte_dpia = null;
                    $DPIA->CP_notifie_dpia = null;
                    $DPIA->CP_consome_dpia = null;

                    $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                    $DPIA->id_rp = 1;
                    $DPIA->id_ra = 1;


                    $DPIA->save();
                } else {

                    dd('Portefeuille non trouvé');
                }

                // dd( $DPIA);
                     // mettre à jour ConstruireDPIA
                    /* $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->firstOrFail();
                // vérifiez si les champs sont nuls et update
                $DPIA->update([
                'code_sous_operation'=>$DPIA->code_sous_operation ?? $sousoperation->code_sous_operation,
                'AE_ouvert_dpia' => $DPIA->AE_ouvert_dpia ?? $sousoperation->AE_ouvert,
                'AE_atendu_dpia' => $DPIA->AE_atendu_dpia ?? $sousoperation->AE_atendu,
                'CP_ouvert_dpia' => $DPIA->CP_ouvert_dpia ?? $sousoperation->CP_ouvert,
                'CP_atendu_dpia' => $DPIA->CP_atendu_dpia ?? $sousoperation->CP_atendu,
                ]);

                $DPIA->save();*/
                }


            }else{
                // Insérer dans sousoperation avec un code spécifique
                $sousoperation=sousoperation::updateOrCreate(
                    ['code_sous_operation' => $code.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                    [
                        'code_operation' =>  $code.$s_act,
                        'nom_sous_operation' => $nom,
                        'code_t2' => 20000,
                        //'AE_sous_operation' => floatval(str_replace(',', '', $ae_attendu)) + floatval(str_replace(',', '', $ae_ouvert)),
                        //'CP_sous_operation' => floatval(str_replace(',', '', $cp_attendu)) + floatval(str_replace(',', '', $cp_ouvert)),
                        'AE_atendu' => floatval(str_replace(',', '', $ae_attendu)),
                        'AE_ouvert' => floatval(str_replace(',', '', $ae_ouvert)),
                        'CP_ouvert' => floatval(str_replace(',', '', $cp_ouvert)),
                        'CP_atendu' => floatval(str_replace(',', '', $cp_attendu)),
                        'date_insert_SOUSoperation' => $currentDateTime
                    ]
                );
                 // creation de la table  construireDPIA
                 $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                 // dd($portefeuille);

                 if ($portefeuille) {

                     $DPIA = new ConstruireDPIA();


                     $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                     $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                     $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                     $DPIA->AE_dpia_nv = null;
                     $DPIA->CP_dpia_nv = null;


                     $DPIA->AE_ouvert_dpia = $sousoperation->AE_ouvert;
                     $DPIA->AE_atendu_dpia = $sousoperation->AE_atendu;
                     $DPIA->CP_ouvert_dpia = $sousoperation->CP_ouvert;
                     $DPIA->CP_atendu_dpia = $sousoperation->CP_atendu;

                     $DPIA->AE_reporte_dpia = null;
                     $DPIA->AE_notifie_dpia = null;
                     $DPIA->AE_engage_dpia = null;
                     $DPIA->CP_reporte_dpia = null;
                     $DPIA->CP_notifie_dpia = null;
                     $DPIA->CP_consome_dpia = null;

                     $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                     $DPIA->id_rp = 1;
                     $DPIA->id_ra = 1;


                     $DPIA->save();
                 } else {

                     dd('Portefeuille non trouvé');
                 }

                 // dd( $DPIA);
                   // mettre à jour ConstruireDPIA
                  /* $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->firstOrFail();
                   // vérifiez si les champs sont nuls et update
                   $DPIA->update([
                   'code_sous_operation'=>$DPIA->code_sous_operation ?? $sousoperation->code_sous_operation,
                   'AE_ouvert_dpia' => $DPIA->AE_ouvert_dpia ?? $sousoperation->AE_ouvert,
                   'AE_atendu_dpia' => $DPIA->AE_atendu_dpia ?? $sousoperation->AE_atendu,
                   'CP_ouvert_dpia' => $DPIA->CP_ouvert_dpia ?? $sousoperation->CP_ouvert,
                   'CP_atendu_dpia' => $DPIA->CP_atendu_dpia ?? $sousoperation->CP_atendu,
                   ]);

                   $DPIA->save();*/
            }


        // Vérifier si le code représente une opération
        }elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code.$codeGp.$s_act],
                ['code_grp_operation' =>  $codeGp.$s_act, 'nom_operation' => $nom,
                 'date_insert_operation' => $currentDateTime]
            );

            // Vérifier la ligne suivante
            $keys = array_keys($jsonData);
            $currentIndex = array_search($codeStr, $keys); // Trouver l'index du code actuel

            if ($currentIndex !== false && isset($keys[$currentIndex + 1])) {
                $nextKey = $keys[$currentIndex + 1]; // Obtenir la clé suivante
                $nextItem = $jsonData[$nextKey]; // Obtenir l'élément suivant par sa clé

                // Récupérer le code correspondant au nom suivant
                $nextCode = $nextKey; // La clé suivante est déjà le code

                // Si la ligne suivante n'est pas une sous-opération
                if ($nextCode && ($nextCode % 100 == 0 || $nextCode % 1000 == 0)) {
                   // dd($nextCode, $ae_attendu, $cp_attendu);
                    // Insérer dans sousoperation avec un code spécifique
                    $sousoperation=sousoperation::updateOrCreate(
                        ['code_sous_operation' => $code.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                        [
                            'code_operation' =>  $code.$codeGp.$s_act,
                            'nom_sous_operation' => $nom,
                            'code_t2' => 20000,
                            //'AE_sous_operation' => floatval(str_replace(',', '', $ae_attendu)) + floatval(str_replace(',', '', $ae_ouvert)),
                            //'CP_sous_operation' => floatval(str_replace(',', '', $cp_attendu)) + floatval(str_replace(',', '', $cp_ouvert)),
                            'AE_atendu' => floatval(str_replace(',', '', $ae_attendu)),
                            'AE_ouvert' => floatval(str_replace(',', '', $ae_ouvert)),
                            'CP_ouvert' => floatval(str_replace(',', '', $cp_ouvert)),
                            'CP_atendu' => floatval(str_replace(',', '', $cp_attendu)),
                            'date_insert_SOUSoperation' => $currentDateTime
                        ]
                    );
                     // creation de la table  construireDPIA
                $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                // dd($portefeuille);

                if ($portefeuille) {

                    $DPIA = new ConstruireDPIA();


                    $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                    $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                    $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                    $DPIA->AE_dpia_nv = null;
                    $DPIA->CP_dpia_nv = null;


                    $DPIA->AE_ouvert_dpia = $sousoperation->AE_ouvert;
                    $DPIA->AE_atendu_dpia = $sousoperation->AE_atendu;
                    $DPIA->CP_ouvert_dpia = $sousoperation->CP_ouvert;
                    $DPIA->CP_atendu_dpia = $sousoperation->CP_atendu;

                    $DPIA->AE_reporte_dpia = null;
                    $DPIA->AE_notifie_dpia = null;
                    $DPIA->AE_engage_dpia = null;
                    $DPIA->CP_reporte_dpia = null;
                    $DPIA->CP_notifie_dpia = null;
                    $DPIA->CP_consome_dpia = null;

                    $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                    $DPIA->id_rp = 1;
                    $DPIA->id_ra = 1;


                    $DPIA->save();
                } else {

                    dd('Portefeuille non trouvé');
                }

                // dd( $DPIA);
                       // mettre à jour ConstruireDPIA
                     //  $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->firstOrFail();
                // vérifiez si les champs sont nuls et update
              /*  $DPIA->update([
                'code_sous_operation'=>$DPIA->code_sous_operation ?? $sousoperation->code_sous_operation,
                'AE_ouvert_dpia' => $DPIA->AE_ouvert_dpia ?? $sousoperation->AE_ouvert,
                'AE_atendu_dpia' => $DPIA->AE_atendu_dpia ?? $sousoperation->AE_atendu,
                'CP_ouvert_dpia' => $DPIA->CP_ouvert_dpia ?? $sousoperation->CP_ouvert,
                'CP_atendu_dpia' => $DPIA->CP_atendu_dpia ?? $sousoperation->CP_atendu,
                ]);

                $DPIA->save();*/

                }
            }else{
                // Insérer dans sousoperation avec un code spécifique
                $sousoperation=sousoperation::updateOrCreate(
                    ['code_sous_operation' => $code.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                    [
                        'code_operation' =>  $code.$codeGp.$s_act,
                        'nom_sous_operation' => $nom,
                        'code_t2' => 20000,
                        //'AE_sous_operation' => floatval(str_replace(',', '', $ae_attendu)) + floatval(str_replace(',', '', $ae_ouvert)),
                        //'CP_sous_operation' => floatval(str_replace(',', '', $cp_attendu)) + floatval(str_replace(',', '', $cp_ouvert)),
                        'AE_atendu' => floatval(str_replace(',', '', $ae_attendu)),
                        'AE_ouvert' => floatval(str_replace(',', '', $ae_ouvert)),
                        'CP_ouvert' => floatval(str_replace(',', '', $cp_ouvert)),
                        'CP_atendu' => floatval(str_replace(',', '', $cp_attendu)),
                        'date_insert_SOUSoperation' => $currentDateTime
                    ]
                );
                 // creation de la table  construireDPIA
                 $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                 // dd($portefeuille);

                 if ($portefeuille) {

                     $DPIA = new ConstruireDPIA();


                     $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                     $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                     $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                     $DPIA->AE_dpia_nv = null;
                     $DPIA->CP_dpia_nv = null;


                     $DPIA->AE_ouvert_dpia = $sousoperation->AE_ouvert;
                     $DPIA->AE_atendu_dpia = $sousoperation->AE_atendu;
                     $DPIA->CP_ouvert_dpia = $sousoperation->CP_ouvert;
                     $DPIA->CP_atendu_dpia = $sousoperation->CP_atendu;

                     $DPIA->AE_reporte_dpia = null;
                     $DPIA->AE_notifie_dpia = null;
                     $DPIA->AE_engage_dpia = null;
                     $DPIA->CP_reporte_dpia = null;
                     $DPIA->CP_notifie_dpia = null;
                     $DPIA->CP_consome_dpia = null;

                     $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                     $DPIA->id_rp = 1;
                     $DPIA->id_ra = 1;


                     $DPIA->save();
                 } else {

                     dd('Portefeuille non trouvé');
                 }

                 // dd( $DPIA);
                   // mettre à jour ConstruireDPIA
                  /* $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->firstOrFail();
                   // vérifiez si les champs sont nuls et update
                   $DPIA->update([
                   'code_sous_operation'=>$DPIA->code_sous_operation ?? $sousoperation->code_sous_operation,
                   'AE_ouvert_dpia' => $DPIA->AE_ouvert_dpia ?? $sousoperation->AE_ouvert,
                   'AE_atendu_dpia' => $DPIA->AE_atendu_dpia ?? $sousoperation->AE_atendu,
                   'CP_ouvert_dpia' => $DPIA->CP_ouvert_dpia ?? $sousoperation->CP_ouvert,
                   'CP_atendu_dpia' => $DPIA->CP_atendu_dpia ?? $sousoperation->CP_atendu,
                   ]);

                   $DPIA->save();*/
            }

        // Sinon, il s'agit d'une sous-opération
        }else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            $sousoperation= sousoperation::updateOrCreate(
                ['code_sous_operation' => $code.$codeOp.$codeGp.$s_act],
                [
                    'code_operation' =>  $code.$codeGp.$s_act,
                    'nom_sous_operation' => $nom,
                    'code_t2' => 20000,
                    //'AE_sous_operation' => floatval(str_replace(',', '', $ae_attendu)) + floatval(str_replace(',', '', $ae_ouvert)),
                    //'CP_sous_operation' => floatval(str_replace(',', '', $cp_attendu)) + floatval(str_replace(',', '', $cp_ouvert)),
                    'AE_atendu' => floatval(str_replace(',', '', $ae_attendu)),
                    'AE_ouvert' => floatval(str_replace(',', '', $ae_ouvert)),
                    'CP_ouvert' => floatval(str_replace(',', '', $cp_ouvert)),
                    'CP_atendu' => floatval(str_replace(',', '', $cp_attendu)),
                    'date_insert_SOUSoperation' => $currentDateTime
                ]
            );
             // creation de la table  construireDPIA
             $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
             // dd($portefeuille);

             if ($portefeuille) {

                 $DPIA = new ConstruireDPIA();


                 $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                 $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                 $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                 $DPIA->AE_dpia_nv = null;
                 $DPIA->CP_dpia_nv = null;


                 $DPIA->AE_ouvert_dpia = $sousoperation->AE_ouvert;
                 $DPIA->AE_atendu_dpia = $sousoperation->AE_atendu;
                 $DPIA->CP_ouvert_dpia = $sousoperation->CP_ouvert;
                 $DPIA->CP_atendu_dpia = $sousoperation->CP_atendu;

                 $DPIA->AE_reporte_dpia = null;
                 $DPIA->AE_notifie_dpia = null;
                 $DPIA->AE_engage_dpia = null;
                 $DPIA->CP_reporte_dpia = null;
                 $DPIA->CP_notifie_dpia = null;
                 $DPIA->CP_consome_dpia = null;

                 $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                 $DPIA->id_rp = 1;
                 $DPIA->id_ra = 1;


                 $DPIA->save();
             } else {

                 dd('Portefeuille non trouvé');
             }

             // dd( $DPIA);
             // mettre à jour ConstruireDPIA
            /* $DPIA = ConstruireDPIA::whereNull('code_sous_operation')->firstOrFail();
             // vérifiez si les champs sont nuls et update
             $DPIA->update([
            'code_sous_operation'=>$DPIA->code_sous_operation ?? $sousoperation->code_sous_operation,
             'AE_ouvert_dpia' => $DPIA->AE_ouvert_dpia ?? $sousoperation->AE_ouvert,
             'AE_atendu_dpia' => $DPIA->AE_atendu_dpia ?? $sousoperation->AE_atendu,
             'CP_ouvert_dpia' => $DPIA->CP_ouvert_dpia ?? $sousoperation->CP_ouvert,
             'CP_atendu_dpia' => $DPIA->CP_atendu_dpia ?? $sousoperation->CP_atendu,
             ]);

             $DPIA->save();*/
        }
    } // fin boucle

    //dd($request);
    return response()->json([
        'success' => true,
        'message' => 'Données insérées avec succès !',
        'code' => 200,
    ]);
    return redirect()->back();

    //===================================================================================
    // FIN insertion T2
    //===================================================================================
}

//===================================================================================
                            // insertion T3
//===================================================================================
elseif ($T==3) {
    //dd($request);
       // Récupérer les données du formulaire
       $aeDataReporte = $request->input('ae_reporte');
       $aeDataNotifie = $request->input('ae_notifie');
       $aeDataEngage = $request->input('ae_engage');

       $cpDataReporte = $request->input('cp_reporte');
       $cpDataNotifie = $request->input('cp_notifie');
       $cpDataConsome = $request->input('cp_consome');
  // Chemin vers le fichier JSON dans public/titre
  $jsonFilePath = public_path('assets/Titre/dataT3.json');

  // Lire le contenu du fichier JSON
  if (file_exists($jsonFilePath)) {
      $jsonData = json_decode(file_get_contents($jsonFilePath), true);


  } else {
      // Gérer le cas où le fichier n'existe pas
      return response()->json(['error' => 'Le fichier JSON est introuvable T3.'], 404);
  }


      if (json_last_error() !== JSON_ERROR_NONE) {
          return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
      }

    /*  $numRows = count($jsonData);
      for ($i = 0; $i < $numRows; $i++) {
          $item = $jsonData[$i];
          $code = $item['code']?? null;
          $nom = $item['nom'] ?? '';*/
       // Parcourir les éléments du fichier JSON
foreach ($jsonData as $codeStr => $nom) {
    // S'assurer que le code est une chaîne de caractères
    $code = (string) $codeStr;

          $ae_reporte = $aeDataReporte[$code] ?? 0.00;
          $ae_notifie = $aeDataNotifie[$code] ?? 0.00;
          $ae_engage = $aeDataEngage[$code] ?? 0.00;

          $cp_reporte = $cpDataReporte[$code] ?? 0.00;
          $cp_notifie = $cpDataNotifie[$code] ?? 0.00;
          $cp_consome = $cpDataConsome[$code] ?? 0.00;
          // Vérifier si le code est manquant
          if (!$code) {
            return response()->json([
                'success' => false,
                'message' => 'Code manquant pour l\'élément avec nom : '.$nom,
                'code' => 404,
            ]);

          }

        // Vérifier si le nom est manquant
        if (!$nom) {
            return response()->json([
                'success' => false,
                'message' => 'Nom manquant pour l\'élément avec code : '.$code,
                'code' => 404,
            ]);

        }


          // Vérifier si le code représente un groupe d'opérations
          if ($code % 1000 == 0) {
              // Insertion dans la table groupoperation
              GroupOperation::updateOrCreate(
                  ['code_grp_operation' => $code.$s_act],
                  ['nom_grp_operation' => $nom, 'num_sous_action' => $s_act,
                  'date_insert_grp_operation' => $currentDateTime]
              );
          }

          // Vérifier si le code représente une opération
          elseif ($code % 100 == 0) {
              $codeGp = floor($code / 1000) * 1000;

              // Insertion dans la table operation
              Operation::updateOrCreate(
                  ['code_operation' => $code.$codeGp.$s_act],
                  ['code_grp_operation' => $codeGp.$s_act, 'nom_operation' => $nom,
                  'date_insert_operation' => $currentDateTime]
              );

               /*// Vérifier la ligne suivante
               $nextItem = $jsonData[$i + 1];
               $nextCode = $nextItem['code'] ?? null;*/
             // Vérifier la ligne suivante
             $keys = array_keys($jsonData);
             $currentIndex = array_search($codeStr, $keys); // Trouver l'index du code actuel

             if ($currentIndex !== false && isset($keys[$currentIndex + 1])) {
                 $nextKey = $keys[$currentIndex + 1]; // Obtenir la clé suivante
                 $nextItem = $jsonData[$nextKey]; // Obtenir l'élément suivant par sa clé

                 // Récupérer le code correspondant au nom suivant
                 $nextCode = $nextKey; // La clé suivante est déjà le code

                    // Si la ligne suivante n'est pas une sous-opération
                    if ($nextCode && ($nextCode % 100 == 0 || $nextCode % 1000 == 0)) {
                      // Insérer dans sousoperation avec un code spécifique
                      $sousoperation=sousoperation::updateOrCreate(
                          ['code_sous_operation' =>$code.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                          ['code_operation' =>$code.$codeGp.$s_act,
                          'nom_sous_operation' => $nom,
                          'code_t3' => 30000,

                          'AE_reporte' => floatval(str_replace(',', '', $ae_reporte)),
                          'AE_notifie' =>floatval(str_replace(',', '', $ae_notifie)) ,
                          'AE_engage' => floatval(str_replace(',', '', $ae_engage)),

                          'CP_reporte' => floatval(str_replace(',', '', $cp_reporte)),
                          'CP_notifie' =>floatval(str_replace(',', '', $cp_notifie)),
                          'CP_consome' => floatval(str_replace(',', '', $cp_consome))
                          , 'date_insert_SOUSoperation' => $currentDateTime]
                      );
                       // creation de la table  construireDPIA
                $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                // dd($portefeuille);

                if ($portefeuille) {

                    $DPIA = new ConstruireDPIA();


                    $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                    $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                    $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                    $DPIA->AE_dpia_nv = null;
                    $DPIA->CP_dpia_nv = null;


                    $DPIA->AE_ouvert_dpia = null;
                    $DPIA->AE_atendu_dpia = null;
                    $DPIA->CP_ouvert_dpia = null;
                    $DPIA->CP_atendu_dpia = null;

                    $DPIA->AE_reporte_dpia = $sousoperation->AE_reporte;
                    $DPIA->AE_notifie_dpia = $sousoperation->AE_notifie;
                    $DPIA->AE_engage_dpia = $sousoperation->AE_engage;
                    $DPIA->CP_reporte_dpia = $sousoperation->CP_reporte;
                    $DPIA->CP_notifie_dpia = $sousoperation->CP_notifie;
                    $DPIA->CP_consome_dpia = $sousoperation->CP_consome;

                    $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                    $DPIA->id_rp = 1;
                    $DPIA->id_ra = 1;


                    $DPIA->save();
                } else {

                    dd('Portefeuille non trouvé');
                }

                // dd( $DPIA);
                    }

          }else{
            // Insérer dans sousoperation avec un code spécifique
            $sousoperation=sousoperation::updateOrCreate(
                ['code_sous_operation' =>$code.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                ['code_operation' =>$code.$codeGp.$s_act,
                'nom_sous_operation' => $nom,
                'code_t3' => 30000,

                'AE_reporte' => floatval(str_replace(',', '', $ae_reporte)),
                'AE_notifie' =>floatval(str_replace(',', '', $ae_notifie)) ,
                'AE_engage' => floatval(str_replace(',', '', $ae_engage)),

                'CP_reporte' => floatval(str_replace(',', '', $cp_reporte)),
                'CP_notifie' =>floatval(str_replace(',', '', $cp_notifie)),
                'CP_consome' => floatval(str_replace(',', '', $cp_consome))
                , 'date_insert_SOUSoperation' => $currentDateTime]
            );
                   // creation de la table  construireDPIA
                   $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
                   // dd($portefeuille);

                   if ($portefeuille) {

                       $DPIA = new ConstruireDPIA();


                       $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                       $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                       $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                       $DPIA->AE_dpia_nv = null;
                       $DPIA->CP_dpia_nv = null;


                       $DPIA->AE_ouvert_dpia = null;
                       $DPIA->AE_atendu_dpia = null;
                       $DPIA->CP_ouvert_dpia = null;
                       $DPIA->CP_atendu_dpia = null;

                       $DPIA->AE_reporte_dpia = $sousoperation->AE_reporte;
                       $DPIA->AE_notifie_dpia = $sousoperation->AE_notifie;
                       $DPIA->AE_engage_dpia = $sousoperation->AE_engage;
                       $DPIA->CP_reporte_dpia = $sousoperation->CP_reporte;
                       $DPIA->CP_notifie_dpia = $sousoperation->CP_notifie;
                       $DPIA->CP_consome_dpia = $sousoperation->CP_consome;

                       $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                       $DPIA->id_rp = 1;
                       $DPIA->id_ra = 1;


                       $DPIA->save();
                   } else {

                       dd('Portefeuille non trouvé');
                   }

                   // dd( $DPIA);
          }
        }

      }

      return response()->json([
        'success' => true,
        'message' => 'Données insérées avec succès !',
        'code' => 200,
    ]);
//===================================================================================
                            //FIN insertion T3
//===================================================================================

}
//===================================================================================
                            // insertion T4
//===================================================================================
else{
// Récupérer les données du formulaire
//dd($request);
$aeData = $request->input('ae');
$cpData = $request->input('cp');

  // Chemin vers le fichier JSON dans public/titre
  $jsonFilePath = public_path('assets/Titre/dataT4.json');

  // Lire le contenu du fichier JSON
  if (file_exists($jsonFilePath)) {
      $jsonData = json_decode(file_get_contents($jsonFilePath), true);


  } else {
      // Gérer le cas où le fichier n'existe pas
      return response()->json(['error' => 'Le fichier JSON est introuvable T4.'], 404);
  }


      if (json_last_error() !== JSON_ERROR_NONE) {
          return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
      }

      /*$numRows = count($jsonData);
      for ($i = 0; $i < $numRows; $i++) {
          $item = $jsonData[$i];
   $code = $item['code']?? null;
   $nom = $item['nom'] ?? '';
   */
  // Parcourir les éléments du fichier JSON
foreach ($jsonData as $codeStr => $nom) {
    // S'assurer que le code est une chaîne de caractères
    $code = (string) $codeStr;
   $ae = $aeData[$code] ?? 0.00;
   $cp = $cpData[$code] ?? 0.00;

   // Vérifier si le code est manquant
   if (!$code) {
    return response()->json([
        'success' => false,
        'message' => 'Code manquant pour l\'élément avec nom : '.$nom,
        'code' => 404,
    ]);

  }

// Vérifier si le nom est manquant
if (!$nom) {
    return response()->json([
        'success' => false,
        'message' => 'Nom manquant pour l\'élément avec code : '.$code,
        'code' => 404,
    ]);

}

   // Vérifier si le code représente un groupe d'opérations
   if ($code % 1000 == 0) {
       // Insertion dans la table groupoperation
       GroupOperation::updateOrCreate(
           ['code_grp_operation' => $code.$s_act],
           ['nom_grp_operation' => $nom, 'num_sous_action' => $s_act,
           'date_insert_grp_operation' => $currentDateTime]
       );
   }
   // Vérifier si le code représente une opération
   elseif ($code % 100 == 0) {
       $codeGp = floor($code / 1000) * 1000;

       // Insertion dans la table operation
       Operation::updateOrCreate(
           ['code_operation' => $code.$codeGp.$s_act],
           ['code_grp_operation' =>  $codeGp.$s_act, 'nom_operation' => $nom,
           //'AE_operation' => floatval(str_replace(',', '',  $ae)),
           //'CP_operation' => floatval(str_replace(',', '',  $cp)),
           'date_insert_operation' => $currentDateTime]
       );
   }
   // Sinon, il s'agit d'une sous-opération
   else {
       $codeOp = floor($code / 100) * 100;

       // Insertion dans la table sousoperation
       $sousoperation=sousoperation::updateOrCreate(
           ['code_sous_operation' => $code.$codeGp.$s_act],
           ['code_operation' => $code.$codeGp.$s_act, 'nom_sous_operation' => $nom
           ,'code_t4' => 40000, 'date_insert_SOUSoperation' => $currentDateTime]
       );
              // creation de la table  construireDPIA
              $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
              // dd($portefeuille);

               if ($portefeuille) {
                   // Création de la table ConstruireDPIA
                   $DPIA = new ConstruireDPIA();


                   $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                   $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                   $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                   $DPIA->AE_dpia_nv = $sousoperation->AE_sous_operation;
                   $DPIA->CP_dpia_nv = $sousoperation->CP_sous_operation;


                   $DPIA->AE_ouvert_dpia = null;
                   $DPIA->AE_atendu_dpia = null;
                   $DPIA->CP_ouvert_dpia = null;
                   $DPIA->CP_atendu_dpia = null;

                   $DPIA->AE_reporte_dpia = null;
                   $DPIA->AE_notifie_dpia = null;
                   $DPIA->AE_engage_dpia = null;
                   $DPIA->CP_reporte_dpia = null;
                   $DPIA->CP_notifie_dpia = null;
                   $DPIA->CP_consome_dpia = null;

                   $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                   $DPIA->id_rp = 1;
                   $DPIA->id_ra = 1;


                   $DPIA->save();
               } else {
                   // si le portefeuille n'existe pas
                   dd('Portefeuille non trouvé');
               }
               // dd( $DPIA);

       /* // Vérifier la ligne suivante
        $nextItem = $jsonData[$i + 1];
        $nextCode = $nextItem['code'] ?? null;*/
        // Vérifier la ligne suivante
        // Vérifier la ligne suivante
        $keys = array_keys($jsonData);
        $currentIndex = array_search($codeStr, $keys); // Trouver l'index du code actuel

        if ($currentIndex !== false && isset($keys[$currentIndex + 1])) {
            $nextKey = $keys[$currentIndex + 1]; // Obtenir la clé suivante
            $nextItem = $jsonData[$nextKey]; // Obtenir l'élément suivant par sa clé

            // Récupérer le code correspondant au nom suivant
            $nextCode = $nextKey; // La clé suivante est déjà le code

        // Si la ligne suivante n'est pas une sous-opération
        if ($nextCode && ($nextCode % 100 == 0 || $nextCode % 1000 == 0)) {
            // Insérer dans sousoperation avec un code spécifique
           $sousoperation= sousoperation::updateOrCreate(
                ['code_sous_operation' =>  $code.$codeOp.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
                ['code_operation' => $codeOp.$codeGp.$s_act, 'nom_sous_operation' => $nom,
                'AE_sous_operation' => $ae,
                'code_t4' => 40000,
                'CP_sous_operation' =>floatval(str_replace(',', '',  $cp))
                , 'date_insert_SOUSoperation' => $currentDateTime]
            );

             // creation de la table  construireDPIA
             $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
             // dd($portefeuille);

              if ($portefeuille) {
                  // Création de la table ConstruireDPIA
                  $DPIA = new ConstruireDPIA();


                  $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
                  $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
                  $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

                  $DPIA->AE_dpia_nv = $sousoperation->AE_sous_operation;
                  $DPIA->CP_dpia_nv = $sousoperation->CP_sous_operation;


                  $DPIA->AE_ouvert_dpia = null;
                  $DPIA->AE_atendu_dpia = null;
                  $DPIA->CP_ouvert_dpia = null;
                  $DPIA->CP_atendu_dpia = null;

                  $DPIA->AE_reporte_dpia = null;
                  $DPIA->AE_notifie_dpia = null;
                  $DPIA->AE_engage_dpia = null;
                  $DPIA->CP_reporte_dpia = null;
                  $DPIA->CP_notifie_dpia = null;
                  $DPIA->CP_consome_dpia = null;

                  $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
                  $DPIA->id_rp = 1;
                  $DPIA->id_ra = 1;


                  $DPIA->save();
              } else {
                  // si le portefeuille n'existe pas
                  dd('Portefeuille non trouvé');
              }
              // dd( $DPIA);
        }
   }else{
     $sousoperation=sousoperation::updateOrCreate(
        ['code_sous_operation' =>  $code.$codeOp.$codeGp.$s_act], // Code spécifique pour indiquer qu'il ne s'agit pas d'une véritable sous-opération
        ['code_operation' => $codeOp.$codeGp.$s_act, 'nom_sous_operation' => $nom,
        'AE_sous_operation' => $ae,
        'code_t4' => 40000,
        'CP_sous_operation' =>floatval(str_replace(',', '',  $cp))
        , 'date_insert_SOUSoperation' => $currentDateTime]
    );

     // creation de la table  construireDPIA
     $portefeuille = Portefeuille::where('num_portefeuil', $port)->first();
     // dd($portefeuille);

      if ($portefeuille) {
          // Création de la table ConstruireDPIA
          $DPIA = new ConstruireDPIA();


          $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille;
          $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
          $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

          $DPIA->AE_dpia_nv = $sousoperation->AE_sous_operation;
          $DPIA->CP_dpia_nv = $sousoperation->CP_sous_operation;


          $DPIA->AE_ouvert_dpia = null;
          $DPIA->AE_atendu_dpia = null;
          $DPIA->CP_ouvert_dpia = null;
          $DPIA->CP_atendu_dpia = null;

          $DPIA->AE_reporte_dpia = null;
          $DPIA->AE_notifie_dpia = null;
          $DPIA->AE_engage_dpia = null;
          $DPIA->CP_reporte_dpia = null;
          $DPIA->CP_notifie_dpia = null;
          $DPIA->CP_consome_dpia = null;

          $DPIA->code_sous_operation = $sousoperation->code_sous_operation;
          $DPIA->id_rp = 1;
          $DPIA->id_ra = 1;


          $DPIA->save();
      } else {
          // si le portefeuille n'existe pas
          dd('Portefeuille non trouvé');
      }
      // dd( $DPIA);
   }
}
}
return response()->json([
    'success' => true,
    'message' => 'Données insérées avec succès !',
    'code' => 200,
]);
//===================================================================================
                            //FIN insertion T4
//===================================================================================
}

}
}
