<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES CREDITS DES DEPENSES DE FONCTIONNEMENT</title>
    <style>
        .table_handler
        {
            width: 100%;
        }
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
        margin: 10px 0; /* la distance entre les 2 tables */
       
    }

    .first-table {
            width: 50%; 
            margin-bottom:20px; 
            margin: 0 auto;
           

        }
    .first-table thead
    {
          
    }
    .t2
    {
        background-color:#DDD9C4;
    }
    .headt2{
        background-color:#DCE6F1;
    }

    .total2{
        background-color:#76933C;
        color:white;
        font-size:20px;
    }
    .controle{
        background-color:#76933C;
        color:white;
        font-size:20px;
    }
    </style>
</head>
<body>

<!--h1>LES CREDITS DES DEPENSES DE FONCTIONNEMENT :</h1-->

<table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th style="text-align:center; ">PROGRAMME {{ $prog->nom_prog }}</th>
            <th style="text-align:center; ">Code</th>
            <td style="text-align:center; ">{{ $codeprg }}</th>
            <th colspan="2" class ="headt2" style="text-align:center; ">T2 DANS LE DPIC</th>
        </tr>


        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
                @endphp
            <th style="text-align:center; ">Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <th style="text-align:center; ">Code</th>
            <td style="text-align:center; ">{{ $codesousprg}}</th>
            <th class="headt2" style="text-align:center; ">AE </th>
            <th class="headt2" style="text-align:center; ">CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);
                @endphp
            <th style="text-align: center; ">Action {{ $action->nom_action }}</th>
            <th style="text-align: center; ">Code</th>
            <td style="text-align: center; ">{{ $codeact }}</th>
            <td style="text-align: center; "> {{ $resultstructur['T2']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T2']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </thead>
  
       
    
</table>

<div class="table-diviser"></div> 
<div class="table_handler">
<table>
        <thead>
            <tr>
                <th rowspan="2" class="t2" style="text-align: center; ">Code</th>
                <th rowspan="2" class="t2" style="text-align: center; " >T2. DEPENSES DE FONCTIONNEMENT DES SERVICES </th>

                <th colspan="2" class="t2" style="text-align: center; ">CREDITS OUVERTS</th>
                <th colspan="2" class="t2" style="text-align: center; ">CREDITS ATTENDUS DEVENUS DISPONIBLES</th>
                <th colspan="2" class="t2" style="text-align: center; ">TOTAL CREDITS DISPONIBLES</th>
            </tr>
            <tr>
         
            <th style="text-align: center; ">AE </th>
            <th style="text-align: center; "> CP </th>

            <th style="text-align: center; ">AE </th>
            <th style="text-align: center; ">CP </th>

            <th style="text-align: center; ">AE </th>
            <th style="text-align: center; ">CP </th>
            </tr>
        </thead>
        <tbody>
        @if(!empty($resultstructur['T2']['groupedData']))
                @foreach ($resultstructur['T2']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);
                @endphp
                <tr class="group-row2">
                <td class="code2" style="text-align: center; ">{{$codegrp}}</td>
                <td style=" font-weight: bold; ">{{ $namesT2[$codegrp ] ?? 'Nom non trouvé' }}</td>

                <td style="text-align: center; ">{{ $groupData['group']['values']['ae_ouvertgrpop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $groupData['group']['values']['cp_ouvertgrpop'] ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ $groupData['group']['values']['ae_attendugrpop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $groupData['group']['values']['cp_attendugrpop'] ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ $groupData['group']['values']['totalAEgrpop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $groupData['group']['values']['totalCPgrpop'] ?? 'N/A' }}</td>
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop2">
                   <td class="code2" style="text-align: center; ">{{ $codeop }}</td>
                <td>{{ $namesT2[$codeop] ?? 'Nom non trouvé' }}</td>

                <td style="text-align: center; ">{{ $operationData['operation']['values']['ae_ouvertop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['cp_ouvertop'] ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ $operationData['operation']['values']['ae_attenduop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['cp_attenduop'] ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ $operationData['operation']['values']['totalAEop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['totalCPop'] ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row2">
                   <td class="code2" style="text-align: center; ">{{ $codeop }}</td>
                <td>{{ $namesT2[$codeop] ?? 'Nom non trouvé' }}</td>

                <td style="text-align: center; ">{{ $operationData['operation']['values']['ae_ouvertop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['cp_ouvertop'] ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ $operationData['operation']['values']['ae_attenduop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['cp_attenduop'] ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ $operationData['operation']['values']['totalAEop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['totalCPop'] ?? 'N/A' }}</td>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);
                @endphp
                <tr>
                    <td class="code2" style="text-align: center; ">{{ $codeextr }}</td>
                    <td>{{ $namesT2[$codeextr]?? 'Nom non trouvé' }}</td>

                    <td style="text-align: center; ">{{ $sousOp['values']['ae_ouvertsousop'] ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ $sousOp['values']['cp_ouvertsousop'] ?? 'N/A' }}</td>

                    <td style="text-align: center; ">{{ $sousOp['values']['ae_attendusousop'] ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ $sousOp['values']['cp_attendsousuop'] ?? 'N/A' }}</td>

                    <td style="text-align: center; "> {{ $sousOp['values']['totalAEsousop'] ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ $sousOp['values']['totalCPsousop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach
        
        @else 
        @foreach ($namesT2 as $code => $name)
                   
                <tr>
                    <td style="text-align: center;" class="code">{{ $code }}</td>
                    <td >{{ $name }}</td>
                  
                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>

                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>

                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>
                </tr>
            @endforeach
            @endif
    </tbody>
    <tfoot>
    @if(!empty($resultstructur['T2']['groupedData']))
        <tr class="total2">
            <td colspan="2" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS</td>
            <td style="text-align: center;">{{ $resultstructur['T2']['total'][0]['values']['totalAEouvrtvertical'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $resultstructur['T2']['total'][0]['values']['totalCPouvrtvertical'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $resultstructur['T2']['total'][0]['values']['totalAEattenduvertical'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $resultstructur['T2']['total'][0]['values']['totalCPattenduvertical'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $resultstructur['T2']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $resultstructur['T2']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>

        <tr class="controle">
            <td colspan="2" style="text-align: center; font-weight: bold;">CONTRÔLE DE COHERENCE</td>
            <td style="text-align: center;">{{ $sousOp['values']['ae_ouvertsousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $sousOp['values']['ae_attendusousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $sousOp['values']['cp_ouvertsousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $sousOp['values']['cp_attendsousuop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $sousOp['values']['totalAEsousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ $sousOp['values']['totalCPsousop_NONREPARTIS'] ?? 'N/A' }}</td>
        </tr>
    @else
        <tr class="total2">
            <td colspan="2" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
        </tr>

        <tr class="controle">
            <td colspan="2" style="text-align: center; font-weight: bold;">CONTRÔLE DE COHERENCE</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
        </tr>
    @endif
</tfoot>

</table>
</div>
</body>
</html>
