<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES DEPENSES DE TRANSFERTS</title>
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

        .head4{
        background-color:#DCE6F1;
    }
    .vert4{
            background-color:#EBF1DE;
        }
    .total4{
        background-color:#EBF1DE;
    }

 
    </style>
</head>
<body>

<!--h1>LISTE DES DEPENSES DE TRANSFERTS:</h1-->


<table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th>PROGRAMME {{ $prog->nom_prog }}</th>
            <th>Code</th>
            <td>{{ $codeprg }}</th>
            <th colspan="2" class="head4">T4 DANS LE DPIC</th>
        </tr>


        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
                @endphp
            <th>Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <th>Code</th>
            <td>{{ $codesousprg}}</th>
            <th class="head4">AE </th>
            <th class="head4">CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);
                @endphp
            <th>Action {{ $action->nom_action }}</th>
            <th>Code</th>
            <td>{{ $codeact }}</th>
            <td>{{ $resultstructur['T4']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T4']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </thead>
  
</table>

<div class="table-diviser"></div> 
<table>
        <thead>
            <tr>
                <th rowspan="3">Code</th>
                <th rowspan="3"> T4. DEPENSES DE TRANSFERT </th>
                <th rowspan="3" class="vert4"> Dispositifs d'interventions</th>
                <th class="aecp" colspan="6" style="text-align: center;">MONTANT ANNEE (N)</th>
            </tr>
            <tr>
         
                <th class="aecp" style="text-align: center;" >AE </th>
                <th class="aecp"  style="text-align: center;">CP </th>
            </tr>

        </thead>
        <tbody>
      
            
            @if(!empty($resultstructur['T4']['groupedData']))
              @foreach ($resultstructur['T4']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);
                @endphp
                <tr class="group-row">
                <td class="code">{{$codegrp}}</td>
                <td style=" font-weight: bold; ">{{ $namesT4[$codegrp ] ?? 'Nom non trouvé' }}</td>
                <td class="vert4">{{ $namesT4[$codegrp ] ?? 'Nom non trouvé' }}</td>
                <td class="aecp">{{ $groupData['group']['values']['ae_grpop'] ?? 'N/A' }}</td>
                <td class="aecp">{{ $groupData['group']['values']['cp_grpop'] ?? 'N/A' }}</td>
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop">
                   <td class="code">{{ $codeop }}</td>
                <td>{{ $namesT4[$codeop] ?? 'Nom non trouvé' }}</td>
                <td class="vert4">{{ $namesT4[$codegrp ] ?? 'Nom non trouvé' }}</td>
                <td class="aecp">{{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td class="aecp">{{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row">
                   <td class="code">{{ $codeop }}</td>
                <td>{{ $namesT4[$codeop] ?? 'Nom non trouvé' }}</td>
                <td class="vert4">{{ $namesT4[$codegrp ] ?? 'Nom non trouvé' }}</td>
                <td class="aecp">{{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td class="aecp">{{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);
                @endphp
                <tr>
                    <td class="code">{{ $codeextr }}</td>
                    <td>{{ $namesT4[$codeextr]?? 'Nom non trouvé' }}</td>
                    <td class="vert4">{{ $namesT4[$codegrp ] ?? 'Nom non trouvé' }}</td>
                    <td class="aecp">{{ $sousOp['values']['ae_sousop'] ?? 'N/A' }}</td>
                    <td class="aecp">{{ $sousOp['values']['cp_sousuop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach

        @else
        @foreach ($namesT4 as $code => $name)
                   
                   <tr>
                       <td style="text-align: center;" class="code">{{ $code }}</td>
                       <td >{{ $name }}</td>
                       <td class="vert4"></td>
                       <td class="aecp" style="text-align: center; ">-</td>
                       <td class="aecp" style="text-align: center; ">-</td>
                   </tr>
               @endforeach
           @endif

</tbody>

<tfoot>
    @if(!empty($resultstructur['T4']['groupedData']))
        <tr  class="total4">
            <td colspan="3" style="text-align: center; font-weight: bold;font-size:20px;">TOTAL</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">{{ $resultstructur['T4']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td style="text-align: center; font-weight: bold; font-size:20px;">{{ $resultstructur['T4']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    @else 
    <tr  class="total4">
            <td colspan="3" style="text-align: center; font-weight: bold;font-size:20px;">TOTAL</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">-</td>
            <td style="text-align: center; font-weight: bold; font-size:20px;">-</td>
        </tr>
    @endif
    </tfoot>
    </table>
    </div>
</body>
</html>
