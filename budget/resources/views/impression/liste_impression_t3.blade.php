<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC</title>
    <style>
      
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: white;
          
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-diviser {
        margin: 20px 0; /* la distance entre les 2 tables */
       
    }

    .first-table {
            width: 50%; 
            margin-bottom: 20px; 
            margin: 0 auto;
      
        }

        .head3{
            background-color:#DCE6F1;
        }
       .vert3{
            background-color:#EBF1DE;
        }

        .total3{
          
          background-color:#EBF1DE;

        }

        .aecp{
            background-color:#FDE9D9;
        }

    </style>
</head>
<body>

<!--h1>LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC:</h1-->


<table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th style="text-align: center; ">PROGRAMME {{ $prog->nom_prog }}</th>
            <th style="text-align: center; ">Code {{ $codeprg }}</th>
            <th colspan="2" class="head3" style="text-align: center; ">T3 DANS LE DPIC</th>
        </tr>


        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
                @endphp
            <th style="text-align: center; ">Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <th style="text-align: center; ">Code {{ $codesousprg}}</th>
            <th style="text-align: center; " class="head3">AE </th>
            <th style="text-align: center; " class="head3">CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);
                @endphp
            <th style="text-align: center; ">Action {{ $action->nom_action }}</th>
            <th style="text-align: center; ">Code {{ $codeact }}</th>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </thead>

</table>

<div class="table-diviser"></div> 
<table>
        <thead>
            <tr>
                <th rowspan="3" style="text-align: center; ">Code</th>
                <th class="vert3"  rowspan="3" style="text-align: center; "> T3. DEPENSES D'INVESTISSEMENT </th>

                <th class="vert3" rowspan="3"style="text-align: center; "> N° DE DECISION D'INSCRIPTION</th>
                <th class="vert3"  rowspan="3" style="text-align: center; ">INTITULE DE L'OPERATION D'INVESTISSEMENT PUBLIC (PROJET)</th>
                <th class="aecp " colspan="6"  style="text-align: center;">ANNEE EN COURS (N)</th>
            </tr>
            <tr>
         
                <th class="aecp " colspan="3" style="text-align: center;" >AE </th>
                <th  class="aecp " colspan="3" style="text-align: center;">CP </th>
            </tr>


            <tr>
            <th class="aecp " style="text-align: center; ">AE REPORTEE  <br> 31-12-{{$years-1}} </th>
            <th class="aecp " style="text-align: center; ">AE NOTIFIEE  <br> {{$years}}</th>
            <th class="aecp " style="text-align: center; ">AE ENGAGEE  <br> AU  <br> 31-12-{{$years-1}} </th>

            <th class="aecp ">CP REPORTES  <br> 31-12-{{$years-1}}</th>
            <th class="aecp ">CP NOTIFIES  <br> {{$years}}</th>
            <th class="aecp ">CP CONSOMMES  <br> Au  <br> 31-12-{{$years-1}} </th>
            </tr>

        </thead>
        <tbody>
            @if(!empty($resultstructur['T3']['groupedData']))
                @foreach ($resultstructur['T3']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);

                 $i=0;
                @endphp
            <tr class="group-row">
                <td style="text-align: center; " class="code">{{$codegrp}}</td>
                <td colspan="3" style=" font-weight: bold; ">{{$namesT3[$codegrp] }}</td>
                <!--td>{{$namesT3[$codegrp ] ?? Néant}}</td> 

                <td>{{$namesT3[$codegrp ]  ?? Néant }}</td--> 

                <td class="aecp " style="text-align: center; ">{{ $groupData['group']['values']['ae_reportegrpop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $groupData['group']['values']['ae_notifiegrpop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $groupData['group']['values']['ae_engagegrpop'] ?? 'N/A' }}</td>
              
                <td class="aecp " style="text-align: center; ">{{ $groupData['group']['values']['cp_reportegrpop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $groupData['group']['values']['cp_notifiegrpop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $groupData['group']['values']['cp_consomegrpop'] ?? 'N/A' }}</td>
               
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);

                     $nom_sepa=explode('-', $namesT3[$codeop ]);
                      $nom=end($nom_sepa);

                    $nom_separ=explode('-', $namesT3[$codeop ]);
                    $nomfirst=reset($nom_separ);

                    // compter le nbr total d'op dans le groupe
                        //$totalOperations = count($operationData['sousOperations']);
                        $totalOperations = count($groupData['operations']);
                      //  dd($totalOperations);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop">
                  
                   <td rowspan={{$totalOperations}} class="code"></td>        <!--td class="code">{{ $codeop }}</td-->
    
                   <td >{{$namesT3[$codegrp]}}</td>

                   <td >{{$nomfirst ?? Néant}}</td> 

                   <td class="vert3">{{$nom  ?? Néant }}</td> 

                <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['ae_reporteop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['ae_notifieop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['ae_engageop'] ?? 'N/A' }}</td>

                <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['cp_reporteop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['cp_notifieop'] ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['cp_consomeop'] ?? 'N/A' }}</td>
           </tr>
              
               @else
                <tr class="operation-row">
              
                   <td  class="code" ></td>      <!--td class="code">{{ $codeop }}</td-->
                   <td  >{{$namesT3[$codegrp]}}</td>
                   <td >{{$nomfirst ?? Néant}}</td> 

                   <td class="vert3">{{$nom ?? Néant }}</td> 


                    <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['ae_reporteop'] ?? 'N/A' }}</td>
                    <td class="aecp "  style="text-align: center; ">{{ $operationData['operation']['values']['ae_notifieop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['ae_engageop'] ?? 'N/A' }}</td>

                    <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['cp_reporteop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['cp_notifieop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $operationData['operation']['values']['cp_consomeop'] ?? 'N/A' }}</td>
                </tr>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);

                    $nom_sepa=explode('-', $namesT3[$codeop ]);
                      $nom=end($nom_sepa);

                    $nom_separ=explode('-', $namesT3[$codeop ]);
                    $nomfirst=reset($nom_separ);
                @endphp
                <tr>
                    <td style="text-align: center; " class="code">{{ $codeextr }}</td>

                    <td>{{$namesT3[$codegrp]}}</td>

                    <td>{{$nomfirst ?? Néant}}</td> 

                    <td class="vert3">{{$nom ?? Néant}}</td> 

                    <td class="aecp " style="text-align: center; ">{{ $sousOp['values']['ae_reportesousop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $sousOp['values']['ae_notifiesousop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $sousOp['values']['ae_engagesousop'] ?? 'N/A' }}</td>

                    <td class="aecp " style="text-align: center; ">{{ $sousOp['values']['cp_reportesousuop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $sousOp['values']['cp_notifiesousop'] ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ $sousOp['values']['cp_consomesousop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach

        @else
            
                @foreach ($namesT3 as $code => $name)
                   @php
                      $nom_sepa=explode('-', $namesT3[$code  ]);
                      $nom=end($nom_sepa);

                    $nom_separ=explode('-', $namesT3[$code  ]);
                    $nomfirst=reset($nom_separ);
                   @endphp
                <tr>
                    <td style="text-align: center;" class="code">{{ $code }}</td>
                    <td >{{ $name }}</td>
                    <td >{{$namee ??'Néant'}}</td>
                    <td class="vert3">{{  $namee  ??'Néant'}}</td>
                    <td class="aecp" style="text-align: center;"> - </td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                </tr>
            @endforeach
        @endif

    </tbody>
    <tfoot>
       @if(!empty($resultstructur['T3']['groupedData']))
        <tr  class="total3">
            <td colspan="4" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS </td>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalAEreportevertical'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalAEnotifievertical'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalAEengagevertical'] ?? 'N/A' }}</td>

            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalCPreportevertical'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalCPnotifievertical'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T3']['total'][0]['values']['totalCPconsomevertical'] ?? 'N/A' }}</td>

      
        </tr>
        @else 
        <tr  class="total3">
            <td colspan="4" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS </td>
            <td style="text-align: center; ">- </td>
            <td style="text-align: center; ">- </td>
            <td style="text-align: center; ">- </td>
            <td style="text-align: center; ">- </td>
            <td style="text-align: center; ">- </td>
            <td style="text-align: center; ">- </td>

      
        </tr>
    @endif
    </tfoot>
    </table>
    </div>
</body>
</html>
