
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau CREDITS 088+089</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f1eeee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #d8d3d3;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #5a5b5c; /* Couleur en-têtes */
            color: rgb(10, 10, 10);
        }

        tr:nth-child(even) {
            background-color: #f5f4f4; /* Ligne alternative */
        }

        tr:hover {
            background-color: #0c0a0a; /* Effet survol */
        }

        .program-title {
            font-weight: bold;
            background-color: #2d92fd; /* Couleur programmes*/
            color: rgb(8, 8, 8);
        }

        .subprogram-title {
            font-weight: bold;
            background-color: #e5e7e9; /* Couleur  sous-programmes */
            color: rgb(17, 16, 16);
        }
    </style>
</head>
<body>
    <H1>2 CREDITS ATTENDUS DEVENUS DISPONIBLES EN COURS DE L'ANNEE</H1>
    <table>
        <thead>
            <tr>
                <th>RATTACHEMENT DES CREDITS ATTENDUS DEVENUS DISPONIBLE PAR</th>

                <th colspan="2">T1</th>
                <th colspan="2">T2</th>
                <th colspan="2">T3</th>
                <th colspan="2">T4</th>


            </tr>
            <tr>

                <th>Programme et sous-programmes</th>
                <th>AE</th>
                <th>CP</th>
                <th>AE</th>
                <th>CP</th>
                <th>AE</th>
                <th>CP</th>
                <th>AE</th>
                <th>CP</th>

            </tr>


        </thead>
        <tbody>

            @foreach ($programmes as $programme)
            <tr class="program-title">

                <td>{{ $programme['nom_prog'] }}</td>
                <td colspan="8"></td>
            </tr>
            @foreach ($programme['sous_programmes'] as $sousProgramme)
            <tr class="subprogram-title">
                <td>{{ $sousProgramme['nom_sous_prog'] }}</td>


                @foreach (['T1', 'T2', 'T3', 'T4'] as $t)
                     <td>{{ $sousProgramme['AE_sous_prog'] }}</td>
                     <td>{{ $sousProgramme['CP_sous_prog'] }}</td>

                    <td>{{ $sousProgramme['credits_disponibles'][$t]['ae'] ?? 0 }}</td>
                    <td>{{ $sousProgramme['credits_disponibles'][$t]['cp'] ?? 0 }}</td>
                @endforeach
            </tr>
        @endforeach
    @endforeach

    {{-- Ligne pour le total général --}}
    <tr>
        <th>TOTAL(3) DES AUTRES CREDITS OUVERTS POUR LE PORTEFUILLE DES PROGRAMMES</th>
        @php
            $grandTotalAe = 0;
            $grandTotalCp = 0;

            foreach ($programmes as $programme) {
                foreach ($programme['sous_programmes'] as $sousProgramme) {
                    foreach (['T1', 'T2', 'T3', 'T4'] as $t) {
                        $grandTotalAe += $sousProgramme['credits_disponibles'][$t]['AE_sous_prog'] ?? 0;
                        $grandTotalCp += $sousProgramme['credits_disponibles'][$t]['CP_sous_prog'] ?? 0;
                    }
                }
            }
        @endphp
        <th>{{ $grandTotalAe }}</th>
        <th>{{ $grandTotalCp }}</th>
    </tr>
</tbody>
</table>


</html>
