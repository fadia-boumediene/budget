<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste </title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Liste </h1>

    <table>
        <thead>
            <tr>
                <th>Code Sous-Operation</th>
                <th>Code T1</th>
                <th>AE Sous-Operation</th>
                <th>CP Sous-Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sousopera as $sousopera)
                <tr>
                    <td>{{$sousopera->code_sous_operation}}</td>
                    <td>{{$sousopera->code_t1}}</td>
                    <td>{{$sousopera->AE_sous_operation}}</td>
                    <td>{{$sousopera->CP_sous_operation}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
