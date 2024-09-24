<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class groupOperationController extends Controller
{
//===================================================================================
                            //insertion DPA
//===================================================================================
    public function insertDPA(Request $request, $t1, $t2, $t3, $t4, $num_sous_action)
{
//===================================================================================
                            //insertion T1
//===================================================================================
    if($t1==1)
    {
     // Récupérer les données du formulaire
     $aeData = $request->input('ae');
     $cpData = $request->input('cp');

     // Chemin vers le fichier JSON dans public/titre
$jsonFilePath = public_path('titre/dataT1.json');

// Lire le contenu du fichier JSON
if (file_exists($jsonFilePath)) {
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);


} else {
    // Gérer le cas où le fichier n'existe pas
    return response()->json(['error' => 'Le fichier JSON est introuvable.'], 404);
}


    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
    }

     foreach ($jsonData as $item) {
        $code = $item['code']?? null;
        $nom = $item['nom'] ?? '';
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
                ['code_grp_operation' => $code],
                ['nom_grp_operation' => $nom, 'num_sous_action' => $num_sous_action]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code],
                ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => $ae, 'CP_operation' => $cp]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            sousoperation::updateOrCreate(
                ['code_sous_operation' => $code],
                ['code_operation' => $codeOp, 'nom_sous_operation' => $nom, 'AE_sous_operation' => $ae, 'CP_sous_operation' => $cp]
            );
        }
    }
    return response()->json([
        'success' => true,
        'message' => 'Données insérées avec succès !',
        'code' => 200,
    ]);

//===================================================================================
                            // FIN insertion T1
//===================================================================================

}
//===================================================================================
                            //insertion T2
//===================================================================================
elseif($t2==2)
{
    // Récupérer les données du formulaire
    $aeDataOuvert = $request->input('ae_ouvert');
    $cpDataOuvert = $request->input('cp_ouvert');
    $aeDataAttendu = $request->input('ae_attendu');
    $cpDataAttendu = $request->input('cp_attendu');

     // Chemin vers le fichier JSON dans public/titre
$jsonFilePath = public_path('titre/dataT2.json');

// Lire le contenu du fichier JSON
if (file_exists($jsonFilePath)) {
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);


} else {
    // Gérer le cas où le fichier n'existe pas
    return response()->json(['error' => 'Le fichier JSON est introuvable.'], 404);
}


    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
    }


    foreach ($jsonData as $item) {
       $code = $item['code']?? null;
       $nom = $item['nom'] ?? '';
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
               ['code_grp_operation' => $code],
               ['nom_grp_operation' => $nom, 'num_sous_action' => $num_sous_action]
           );
       }
       // Vérifier si le code représente une opération
       elseif ($code % 100 == 0) {
           $codeGp = floor($code / 1000) * 1000;

           // Insertion dans la table operation
           Operation::updateOrCreate(
               ['code_operation' => $code],
               ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => ($ae_attendu+$ae_ouvert),
               'CP_operation' => ($cp_attendu+$cp_ouvert),  'AE_atendu' => $ae_attendu,  'AE_ouvert' => $ae_ouvert,
                'CP_ouvert' => $cp_ouvert,'CP_ouvert' => $cp_ouvert]
           );
       }
       // Sinon, il s'agit d'une sous-opération
       else {
           $codeOp = floor($code / 100) * 100;

           // Insertion dans la table sousoperation
           sousoperation::updateOrCreate(
               ['code_sous_operation' => $code],
               ['code_operation' => $codeOp, 'nom_sous_operation' => $nom,'AE_sous_operation' => ($ae_attendu+$ae_ouvert),
               'CP_sous_operation' => ($cp_attendu+$cp_ouvert),  'AE_atendu' => $ae_attendu,  'AE_ouvert' => $ae_ouvert,
                'CP_ouvert' => $cp_ouvert,'CP_ouvert' => $cp_ouvert]
           );
       }
   }
   return response()->json([
    'success' => true,
    'message' => 'Données insérées avec succès !',
    'code' => 200,
]);

//===================================================================================
                            //FIN insertion T2
//===================================================================================
}
//===================================================================================
                            // insertion T3
//===================================================================================
elseif ($t3==3) {
       // Récupérer les données du formulaire
       $aeDataReporte = $request->input('AE_reporte');
       $aeDataNotifie = $request->input('AE_notifie');
       $aeDataEngage = $request->input('AE_engage');

       $cpDataReporte = $request->input('CP_reporte');
       $cpDataNotifie = $request->input('CP_notifie');
       $cpDataConsome = $request->input('CP_consome');
  // Chemin vers le fichier JSON dans public/titre
  $jsonFilePath = public_path('titre/dataT3.json');

  // Lire le contenu du fichier JSON
  if (file_exists($jsonFilePath)) {
      $jsonData = json_decode(file_get_contents($jsonFilePath), true);


  } else {
      // Gérer le cas où le fichier n'existe pas
      return response()->json(['error' => 'Le fichier JSON est introuvable.'], 404);
  }


      if (json_last_error() !== JSON_ERROR_NONE) {
          return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
      }

       foreach ($jsonData as $item) {
          $code = $item['code']?? null;
          $nom = $item['nom'] ?? '';


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
                  ['code_grp_operation' => $code],
                  ['nom_grp_operation' => $nom, 'num_sous_action' => $num_sous_action]
              );
          }

          // Vérifier si le code représente une opération
          elseif ($code % 100 == 0) {
              $codeGp = floor($code / 1000) * 1000;

              // Insertion dans la table operation
              Operation::updateOrCreate(
                  ['code_operation' => $code],
                  ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => ($ae_reporte+$ae_notifie+$ae_engage),
                  'CP_operation' => ($cp_reporte+$cp_notifie+$cp_consome),  'AE_reporte' => $ae_reporte,
                  'AE_notifie' => $ae_notifie,'AE_engage' => $ae_engage,'CP_reporte' => $cp_reporte,
                  'CP_notifie' => $cp_notifie,'CP_consome' => $cp_consome]
              );
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
elseif ($t4==4) {
// Récupérer les données du formulaire
$aeData = $request->input('ae');
$cpData = $request->input('cp');

  // Chemin vers le fichier JSON dans public/titre
  $jsonFilePath = public_path('titre/dataT4.json');

  // Lire le contenu du fichier JSON
  if (file_exists($jsonFilePath)) {
      $jsonData = json_decode(file_get_contents($jsonFilePath), true);


  } else {
      // Gérer le cas où le fichier n'existe pas
      return response()->json(['error' => 'Le fichier JSON est introuvable.'], 404);
  }


      if (json_last_error() !== JSON_ERROR_NONE) {
          return response()->json(['error' => 'Erreur lors du décodage du fichier JSON.'], 404);
      }

foreach ($jsonData as $item) {
   $code = $item['code']?? null;
   $nom = $item['nom'] ?? '';
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
           ['code_grp_operation' => $code],
           ['nom_grp_operation' => $nom, 'num_sous_action' => $num_sous_action]
       );
   }
   // Vérifier si le code représente une opération
   elseif ($code % 100 == 0) {
       $codeGp = floor($code / 1000) * 1000;

       // Insertion dans la table operation
       Operation::updateOrCreate(
           ['code_operation' => $code],
           ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => $ae, 'CP_operation' => $cp]
       );
   }
   // Sinon, il s'agit d'une sous-opération
   else {
       $codeOp = floor($code / 100) * 100;

       // Insertion dans la table sousoperation
       sousoperation::updateOrCreate(
           ['code_sous_operation' => $code],
           ['code_operation' => $codeOp, 'nom_sous_operation' => $nom, 'AE_sous_operation' => $ae, 'CP_sous_operation' => $cp]
       );
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
