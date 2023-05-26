<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu Paling Banyak Terjual</title>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0 auto;
            width: 564px;
        }
        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }
        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }
        .tg .tg-2dy9 {
            border-color: inherit;
            font-family: "Trebuchet MS", Helvetica, sans-serif !important;
            text-align: center;
            vertical-align: top;
        }
        .tg .tg-7btt {
            border-color: inherit;
            font-weight: bold;
            text-align: center;
            vertical-align: top;
        }
        .tg .tg-fymr {
            border-color: inherit;
            font-weight: bold;
            text-align: left;
            vertical-align: top;
        }
        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body onload="window.print()">
    <table class="tg">
        <colgroup>
            <col style="width: 179px">
            <col style="width: 224px">
            <col style="width: 161px">
        </colgroup>
        <thead>
            <tr>
                <th class="tg-2dy9" colspan="3">
                    <span style="font-weight:bold">GRANDE GARDEN CAFE</span><br>
                    Jl. Kaliandra, Gamoh, Dayurejo, Kecamatan. Prigen, Pasuruan, Jawa Timur, 67157
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-7btt" colspan="3">LAPORAN MENU PALING BANYAK TERJUAL</td>
            </tr>
            <tr>
                <td class="tg-7btt">Nama Menu</td>
                <td class="tg-7btt">Harga</td>
                <td class="tg-7btt">Jumlah Terjual</td>
            </tr>
            @foreach ($menu_favorit as $data)
            <tr>
                <td class="tg-fymr" style="text-align: center">{{ $data->nama_makanan }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->harga }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->total_sum }}</td>
            </tr>
           @endforeach
          </tbody>
        </table>
        <p style="text-align: center; margin-top: 20px;">Penerima,</p>
        <br><br><br><br>
        <p style="text-align: center;">Okta</p>
        <p style="text-align: center;">(Owner Grande Garden Cafe)</p>
    </body>
    </html>