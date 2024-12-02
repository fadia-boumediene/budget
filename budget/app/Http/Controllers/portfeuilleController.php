<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;

use App\Models\SousAction;
use App\Models\SousProgramme;
use App\Models\Multimedia;
use App\Models\ConstruireDPIA;
use App\Models\ConstruireDPIC;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Services\CalculDpia;
class portfeuilleController extends Controller
{

    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }



//============================ Creating Table =============================//






    //================================= Pour suivi Methode =====================//

    function show_prsuiv($path)
    {
        //$path=$request->all();

        $id=explode('_',$path);
        $num=$id[0];
        $cat=$id[1];
       // dd($id);
        $paths=[];
        if($cat == "all")
        {

            $por=Portefeuille::findOrFail($num);

            $paths=['code_port'=>$por->num_portefeuil];

        }
       if($cat == 'prog' )
       {
        $progms=Programme::where('num_prog',intval($num))->get();
       // dd($progms);
        $paths=['code_port'=>$progms[0]->num_portefeuil,'programme'=>$progms[0]->num_prog];
       // dd($paths);
       }

        if($cat == 'sprog')
        {
                $sprog=SousProgramme::where('num_sous_prog',intval($num))->first();
                $progms=Programme::where('num_prog',$sprog->num_prog)   ->first();
                $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$progms->num_prog,'sous Programme'=>$sprog->num_sous_prog];
             //    dd($paths);
        }
        if($cat == 'act' )
        {
            $act=Action::where('num_action',intval($num))->first();
            $sprog=SousProgramme::where('num_sous_prog',$act->num_sous_prog)->first();
            $progms=Programme::where('num_prog',$sprog->num_prog)->first();
            $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$progms->num_prog,'sous Programme'=>$sprog->num_sous_prog,'Action'=>$act->num_action];
             //   dd($paths);
        }
        $leng=count($paths);
      //  dd($leng);
      if($leng > 0)
      {
        return view('Portfail-in.prsuiv',compact('paths','leng'));
      }
      else
      {
        return redirect()->back()->withErrors(['error' => 'Your error message here']);
      }
    }
    //================================= End ====================================//
//===================================================================================
                                //affichage du portrefeuille
//===================================================================================

    function affich_portef($id)
    {
        // Récupérer tous les portefeuilles de la base de données
          //  $portefeuilles = Portefeuille::all();
          $art=Article::get();
          $por=Portefeuille::findOrFail($id);
          $progms=Programme::where('num_portefeuil',$id)->get();
          $allprogram=[];
          $allsous_prog=[];
          $allaction=[];
          $allsous_action=[];
          $resultats=0;
           $allresult=0;
           $AE_All_sous_act=0;
           $CP_All_sous_act=0;
           $AE_All_act=0;
           $CP_All_act=0;
           $AE_All_sous_prog=0;
           $CP_All_sous_prog=0;
           $AE_All_prog=0;
           $CP_All_prog=0;

           // $tesitng = SousAction::with(['GroupOperation.Operation'])->get();
          //  dd($tesitng);

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
                                     $resultats = $this->CalculDpia->calculdpiaFromPath($id, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                    // dd($resultats);
                                      /*try {
                                          $resultats = $this->CalculDpia->calculdpiaFromPath($id, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                      } catch (\Exception $e) {

                                          $resultats="null";
                                      }*/
                                      if(isset($resultats))
                                      {
                                        foreach($resultats as $Tresult)
                                        {
                                           // dd($Tresult);
                                            $AE_All_sous_act+=$Tresult['total'][0]['values']['totalAE'];
                                            $CP_All_sous_act+=$Tresult['total'][0]['values']['totalCP'];
                                        }

                                      }
                                      else
                                        {
                                            $resultats=[];
                                        }
                                     // dd($resultats);

                                      array_push($allsous_action,['num_act'=>$listsousact->num_sous_action,'init_AE'=>$listsousact->AE_sous_action,'init_CP'=>$listsousact->CP_sous_action,'TotalAE'=>$AE_All_sous_act,'TotalCP'=>$CP_All_sous_act,'data'=>$listsousact,'Tports'=>$resultats]);

                                  }

                              }
                              foreach($allsous_action as $sact)
                              {
                                $AE_All_act+=$sact['TotalAE'];
                                $CP_All_act+=$sact['TotalCP'];
                              }
                          array_push($allaction,['num_act'=>$listact->num_action,'init_AE'=>$listact->AE_action,'init_CP'=>$listact->CP_action,'TotalAE'=>$AE_All_act,'TotalCP'=>$CP_All_act,'data'=>$listact,'sous_action'=>$allsous_action]);
                          $allsous_action=[];
                          }
                      }
                      foreach($allaction as $sact)
                              {
                                $AE_All_sous_prog+=$sact['TotalAE'];
                                $CP_All_sous_prog+=$sact['TotalCP'];

                              }

                      array_push($allsous_prog,['id_sous_prog'=>$sprog->num_sous_prog,'init_AE'=>$sprog->AE_sous_prog,'init_CP'=>$sprog->CP_sous_prog,'TotalAE'=>$AE_All_sous_prog,'TotalCP'=>$CP_All_sous_prog,'data'=>$sprog,'Action'=>$allaction]);
               //      dd($allsous_prog);
                      $allaction=[];
              }

              foreach($allsous_prog as $sact)
                              {
                                $AE_All_prog+=$sact['TotalAE'];
                                $CP_All_prog+=$sact['TotalCP'];
                              }
              array_push($allprogram,['id_prog'=>$progm->num_prog,'init_AE'=>$progm->AE_prog,'init_CP'=>$progm->CP_prog,'TotalAE'=>$AE_All_prog,'TotalCP'=>$CP_All_prog, 'data'=>$progm,'sous_program'=>$allsous_prog]);
              $allsous_prog=[];
          }
          //dd($art);
          $allport=[
              'id'=>$id,
              'TotalAE'=>$por->AE_portef,
              'TotalCP'=>$por->CP_portef,
              'prgrammes'=>$allprogram,
          ];
         //    dd($allprogram[1]['sous_program'][2]);
      // Passer les données à la vue
      return view('Portfail-in.index', compact('allport','art'));


    // Passer les données à la vue

    }
    //affichage formulaire
    function form_portef()
    {
        return view('Portfail-in.creation');
    }
//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_portef(Request $request)
{
    // Validation de la requête
    $request->validate([
        'num_portefeuil' => 'required',
        'Date_portefeuille' => 'required|date'
    ]);

    // Concatenation du numéro de portefeuille avec l'année
    $num = $request->num_portefeuil;

    // Vérification si le portefeuille existe dans la base de données
    $portefeuille = Portefeuille::where('num_portefeuil', $num)->first();

    if ($portefeuille) {
        return response()->json([
            'exists' => true,
            'nom_journal' => $portefeuille->nom_journal,
            'num_journal' => $portefeuille->num_journal,
            'AE_portef' => $portefeuille->AE_portef,
            'CP_portef' => $portefeuille->CP_portef,
            'Date_portefeuille' => $portefeuille->Date_portefeuille,
        ]);
    }

    return response()->json(['exists' => false]);
}

//===================================================================================
                                //FIN CHECK
//===================================================================================
//===================================================================================
                                // creation du portefeuille
//===================================================================================
    function creat_portef(Request $request)
    {

         // Validation des données
         $request->validate([
            //'file' => 'required|file|mimes:jpg,png,pdf|max:2048', // Validation du fichier
            'num_journal' => 'required',
            'nom_journal' => 'required',
            'AE_portef' => 'required',
            'CP_portef' => 'required',
            'Date_portefeuille' => 'required|date',
        ]);
        //si le portefeuiille existe donc le modifier
        $portefeuille = Portefeuille::where('num_portefeuil', $request->num_portefeuil)->first();
        if ($portefeuille) {
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->Date_portefeuille;
        $portefeuille->id_min =1;//periodiquement
        $portefeuille->save();

return response()->json([
    'success' => true,
    'message' => 'Portefeuille ajouté ou modifié avec succès.',
    'code' => 404,
]);

}else{
    //dd($request);

        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = $request->num_portefeuil;
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->Date_portefeuille;
        $portefeuille->id_min =1;//periodiquement
        $portefeuille->save();

    }
        if($portefeuille)
        {
            $DPIC = new ConstruireDPIC();

            $DPIC->date_creation_dpic = $portefeuille->Date_portefeuille; // elle prend la date de creation du portfeuille

            $DPIC->AE_dpic_nv = $portefeuille->AE_portef;
            $DPIC->CP_dpic_nv = $portefeuille->CP_portef;

            $DPIC->id_rff = 1; //apres elle sera avec auth:user il prend le compte qui est deja authentifié
            $DPIC->id_rp = 1;
            $DPIC->save();
            return response()->json([
                'success' => true,
                'message' => 'Portefeuille ajouté ou modifié avec succès.',
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
//======================================================================================
                                // FIN creation du portefeuille
//===================================================================================

//======================================================================================
                                // Modification du portefeuille
//===================================================================================
function update_portef(Request $request)
{

     // Validation des données
     $request->validate([
        'num_journal' => 'required',
        'nom_journal' => 'required',
        'AE_portef' => 'required',
        'CP_portef' => 'required',
        'Date_portefeuille' => 'required|date',
    ]);


    // Récupérer la ligne de la table en fonction de 'numsouaction'
    $portefeuille = Portefeuille::where('num_portefeuil', $request->num_portefeuil)->first();
    $portefeuille = new Portefeuille();
    $portefeuille->nom_journal = $request->nom_journal;
    $portefeuille->num_journal = $request->num_journal;
    $portefeuille->AE_portef = $request->AE_portef;
    $portefeuille->CP_portef = $request->CP_portef;
    $portefeuille->Date_portefeuille = $request->Date_portefeuille;
    $portefeuille->id_min =1;//periodiquement
    $portefeuille->save();

    if($portefeuille)
        {
            return response()->json([
                'success' => true,
                'message' => 'Portefeuille modifié avec succès.',
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
//======================================================================================
                                // FIN Modification du portefeuille/ upload fille pdf
//===================================================================================
public function uploadPDF(Request $request)
{
    $request->validate([
        'pdf_file' => 'mimes:pdf,jpg,jpeg,png|max:2048', // Limite à 2 MB
        'related_id' => 'required'
     ]);


        // Valider le fichier PDF



           $file = $request->file('pdf_file');
           $path = $file->store('pdf_files', 'public'); // Enregistre dans storage/app/public/pdf_files
        //  dd($file);
          // Insérer les détails dans la base de données (table multimedia)
          $media= DB::table('multimedia')->insert([
              'nom_fichier' => $file->getClientOriginalName(),
              'filepath' => $path,
              'filetype' => $file->getClientMimeType(),
              'size' => $file->getSize(),
              'uploaded_by' => 1, // Assurez-vous que l'utilisateur est connecté
              'related_id' => $request->input('related_id'),

          ]);
          //dd($media);

          // Enregistrer le fichier PDF
          if ($request->hasFile('pdf_file')) {


             if($media)
             {
             // dd($media);
              return response()->json([
                'code'=>200,
                'message' => 'Fichier téléchargé avec succès.']);
             }
            else
             {
          //  dd($media);
             return response()->json(['message' => 'Aucun fichier sélectionné.','code'=>400], 400);

             }



       } else {
            return response()->json(['message' => 'Aucun fichier sélectionné.'], 400);
          }

}
}
