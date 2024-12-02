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
            background-color: #2d92fd; /* Couleur plus sombre pour les programmes principaux */
            color: rgb(8, 8, 8);
        }

        .subprogram-title {
            font-weight: bold;
            background-color: #e5e7e9; /* Couleur grise pour les sous-programmes */
            color: rgb(17, 16, 16);
        }
    </style>
</head>
<body>
    <H1>1 CREDITS OUVERTS PAR LA LOI DE FINANCES ET REPARTIS PARLE DECRET DE REPARTITION </H1>
    <table>

            <thead>
                <tr>
                    <th class="subprogram-title"></th>
                    <th class="subprogram-title"></th>
                    <th colspan="2">T1</th>
                    <th colspan="2">T2</th>
                    <th colspan="2">T3</th>
                    <th colspan="2">T4</th>
                    <th colspan="2">Total</th>
                </tr>
                <tr>
                    <th>Code</th>
                    <th>Programme et sous-programmes</th>
                    <th>AE</th>
                    <th>CP</th>
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
                {{-- Parcours des programmes --}}
                @foreach ($programmes as $programme)
                    <tr class="program-title">
                        <td>{{ $programme['code_prog'] }}</td>
                        <td>{{ $programme['nom_prog'] }}</td>
                        <td colspan="10"></td>
                    </tr>

                    {{-- Parcours des sous-programmes --}}
                    @foreach ($programme['sous_programmes'] as $sousProgramme)
                        <tr class="subprogram-title">
                            <td>{{ $sousProgramme['code_sous_prog'] }}</td>
                            <td>{{ $sousProgramme['nom_sous_prog'] }}</td>

                            {{-- Récupération des crédits pour chaque période T1, T2, T3, T4 --}}
                            @php $totalAe = 0; $totalCp = 0; @endphp
                            @foreach (['T1', 'T2', 'T3', 'T4'] as $t)
                                @php
                                    $ae = $sousProgramme['credits']['AE_init_' . strtolower($t)] ?? 0;
                                    $cp = $sousProgramme['credits']['CP_init_' . strtolower($t)] ?? 0;
                                    $totalAe += $ae;
                                    $totalCp += $cp;
                                @endphp
                                <td>{{ $ae }}</td>
                                <td>{{ $cp }}</td>
                            @endforeach

                            {{-- Colonnes pour les totaux AE et CP --}}
                            <td>{{ $totalAe }}</td>
                            <td>{{ $totalCp }}</td>
                        </tr>
                    @endforeach
                @endforeach

                {{-- Ligne de total général --}}
                <tr>
                    <th colspan="2">TOTAL(1) DES CREDITS OUVERTS PART LA LOI DE FINANCES DE L'ANNEE POUR LE PORTEFUILLE</th>
                    @php
                        $grandTotalAe = 0;
                        $grandTotalCp = 0;

                        foreach ($programmes as $programme) {
                            foreach ($programme['sous_programmes'] as $sousProgramme) {
                                foreach (['T1', 'T2', 'T3', 'T4'] as $t) {
                                    $grandTotalAe += $sousProgramme['credits']['AE_init_' . strtolower($t)] ?? 0;
                                    $grandTotalCp += $sousProgramme['credits']['CP_init_' . strtolower($t)] ?? 0;
                                }
                            }
                        }
                    @endphp
                    <th colspan="8"></th>
                    <th>{{ $grandTotalAe }}</th>
                    <th>{{ $grandTotalCp }}</th>
                </tr>
            </tbody>
        </table>
</body>
</html>
