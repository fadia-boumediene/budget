<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES CREDITS DES DEPENSES DE PERSONNEL </title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: white; 
       
        }
        .highlight {
            background-color: white;
        }
        .bold {
            font-weight: bold;
        }

        .group-row1 {
            background-color: #FDE9D9; 
         
        }
        .with-sousop1{
            background-color: #EEECE1 ; 
        }
       
        .total1 {
            background-color:#60497A; 
            color:white;

        }
        .table-diviser {
        margin: 20px 0; /* la distance entre les 2 tables */
       
    }

    .first-table {
            width: 50%; 
            margin-bottom: 20px; 
            margin: 0 auto;
        }

    .headt1{
        background-color:#DDD9C4;
    }
    .code1 ,.t1{
            background-color:#DCE6F1;
        }

    </style>
</head>
<body>
    <!--h1>LES CREDITS DES DEPENSES DE PERSONNEL : </h1-->
    <table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th style="text-align: center; ">Code {{ $codeprg }}</th>
            <th style="text-align: center; ">PROGRAMME {{ $prog->nom_prog }}</th>
            <th colspan="2" class="headt1" style="text-align: center; ">T1</th>
        </tr>


        <tr>
                
                <th class="headt1" style="text-align: center; ">Code</th>
                <th class="headt1" style="text-align: center; ">LE PROGRAMME ET SES SOUS PROGRAMMES</th>
                <th style="text-align: center; "> AE </th>
                <th style="text-align: center; ">CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);

                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
             
                @endphp
            <!--th>Action {{ $action->nom_action }}</th>
            <th>Code</th>
            <td>{{ $codeact }}</th-->
            <td style="text-align: center; ">{{ $codesousprg}}</th>
            <th style="text-align: center; ">Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <td style="text-align: center; ">{{ $resultstructur['T1']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ $resultstructur['T1']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
        <tr>
                
            <th colspan="2" class="headt1" style="text-align: center; ">TOTAL DES CREDITS DISPONIBLES</th>
            <td class="headt1" style="text-align: center; ">{{ $resultstructur['T1']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td class="headt1" style="text-align: center; ">{{ $resultstructur['T1']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </thead>
    
</table>
<div class="table-diviser"></div> 
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center; ">Code</th>
                <th rowspan="2" class="t1" style="text-align: center; ">T1. DEPENSES DE PERSONNEL</th>
                @php
                    $sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $lastchiffre = end($sousprog);
                @endphp

                <th colspan="2" style="text-align: center; ">Code {{ $lastchiffre }} - Sous Programme {{ $sousProgramme->nom_sous_prog }}</th>
            </tr>
            <tr>
         
                <th style="text-align: center; ">AE </th>
                <th style="text-align: center; ">CP </th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($resultstructur['T1']['groupedData']))
                @foreach ($resultstructur['T1']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);
                @endphp
                <tr class="group-row1" >
                <td class="code1" style="text-align: center; " >{{$codegrp}}</td>
                <td style="text-align: center; "> {{ $names[$codegrp ] ?? 'Nom non trouvé' }}</td>
                <td style="text-align: center; ">{{ $groupData['group']['values']['ae_grpop'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $groupData['group']['values']['cp_grpop'] ?? 'N/A' }}</td>
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop1">
                   <td class="code1 " style="text-align: center; ">{{ $codeop }}</td>
                <td >{{ $names[$codeop] ?? 'Nom non trouvé' }}</td>
                <td style="text-align: center; " > {{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row1">
                   <td class="code1" style="text-align: center; ">{{ $codeop }}</td>
                <td >{{ $names[$codeop] ?? 'Nom non trouvé' }}</td>
                <td style="text-align: center; ">{{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td style="text-align: center; " > {{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);
                @endphp
                <tr>
                    <td class="code1" style="text-align: center; ">{{ $codeextr }}</td>
                    <td>{{ $names[$codeextr]?? 'Nom non trouvé' }}</td>
                    <td style="text-align: center; ">{{ $sousOp['values']['ae_sousop'] ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ $sousOp['values']['cp_sousuop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach
        
        @else

        @foreach ($names as $code => $name)
                   
                <tr>
                    <td style="text-align: center;" class="code1">{{ $code }}</td>
                    <td >{{ $name }}</td>
                   
                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
    @if(!empty($resultstructur['T1']['groupedData']))
        <tr  class="total1">
            <td colspan="2" style="text-align: center; font-weight: bold;font-size:20px;">TOTAL</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">{{ $resultstructur['T1']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td style="text-align: center; font-weight: bold; font-size:20px;">{{ $resultstructur['T1']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    @else 
    <tr  class="total1">
            <td colspan="2" style="text-align: center; font-weight: bold;font-size:20px;">TOTAL</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">-</td>
            <td style="text-align: center; font-weight: bold; font-size:20px;">-</td>
        </tr>
    @endif
    </tfoot>
    </table>
    </div>
</body>

</html>