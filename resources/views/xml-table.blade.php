

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XML Parsing Example</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>thang</th>
            <th>kdjendok</th>
            <th>kdsatker</th>
            <th>kddept</th>
            <th>kdunit</th>
            <th>kdprogram</th>
            <th>kdgiat</th>
            <th>kdoutput</th>
            <th>kdlokasi</th>
            <th>kdkabkota</th>
            <th>kddekon</th>
            <th>kdsoutput</th>
            <th>kdkmpnen</th>
            <th>kdskmpnen</th>
            <th>kdakun</th>
            <th>kdkppn</th>
            <th>kdbeban</th>
            <th>kdjnsban</th>
            <th>kdctarik</th>
            <th>register</th>
            <th>carahitung</th>
            <th>prosenphln</th>
            <th>prosenrkp</th>
            <th>prosenrmp</th>
            <th>kppnrkp</th>
            <th>kppnrmp</th>
            <th>kppnphln</th>
            <th>regdam</th>
            <th>kdluncuran</th>
            <th>kdib</th>
            <th>levelrev</th>
            <th>revrkaklke</th>
            <th>revdipake</th>
            <th>uraiblokir</th>
            <th>kdblokir</th>
        </tr>
        @foreach($xmlData->c_akun as $akun)
        <tr>
            <td>{{ $akun->thang }}</td>
            <td>{{ $akun->kdjendok }}</td>
            <td>{{ $akun->kdsatker }}</td>
            <td>{{ $akun->kddept }}</td>
            <td>{{ $akun->kdunit }}</td>
            <td>{{ $akun->kdprogram }}</td>
            <td>{{ $akun->kdgiat }}</td>
            <td>{{ $akun->kdoutput }}</td>
            <td>{{ $akun->kdlokasi }}</td>
            <td>{{ $akun->kdkabkota }}</td>
            <td>{{ $akun->kddekon }}</td>
            <td>{{ $akun->kdsoutput }}</td>
            <td>{{ $akun->kdkmpnen }}</td>
            <td>{{ $akun->kdskmpnen }}</td>
            <td>{{ $akun->kdakun }}</td>
            <td>{{ $akun->kdkppn }}</td>
            <td>{{ $akun->kdbeban }}</td>
            <td>{{ $akun->kdjnsban }}</td>
            <td>{{ $akun->kdctarik }}</td>
            <td>{{ $akun->register }}</td>
            <td>{{ $akun->carahitung }}</td>
            <td>{{ $akun->prosenphln }}</td>
            <td>{{ $akun->prosenrkp }}</td>
            <td>{{ $akun->prosenrmp }}</td>
            <td>{{ $akun->kppnrkp }}</td>
            <td>{{ $akun->kppnrmp }}</td>
            <td>{{ $akun->kppnphln }}</td>
            <td>{{ $akun->regdam }}</td>
            <td>{{ $akun->kdluncuran }}</td>
            <td>{{ $akun->kdib }}</td>
            <td>{{ $akun->levelrev }}</td>
            <td>{{ $akun->revrkaklke }}</td>
            <td>{{ $akun->revdipake }}</td>
            <td>{{ $akun->uraiblokir }}</td>
            <td>{{ $akun->kdblokir }}</td>
        </tr>
        @endforeach
</body>
</body>
</html>
