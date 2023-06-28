<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan FCFS</title>
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
                <th class="tg-2dy9" colspan="7">
                    <span style="font-weight:bold">GRANDE GARDEN CAFE</span><br>
                    Jl. Kaliandra, Gamoh, Dayurejo, Kecamatan. Prigen, Pasuruan, Jawa Timur, 67157
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-7btt" colspan="7">LAPORAN Antrian FCFS</td>
            </tr>
            <tr>
                <td class="tg-7btt">Invoice</td>
                <td class="tg-7btt">Arrival Time</td>
                <td class="tg-7btt">Start Time</td>
                <td class="tg-7btt">Burst Time</td>
                <td class="tg-7btt">Finish Time</td>
                <td class="tg-7btt">Waiting Time</td>
                {{-- <td class="tg-7btt">TAT</td> --}}
            </tr>
            @foreach ($laporan_fcfs as $data)
            <tr>
                <td class="tg-fymr" style="text-align: center">{{ $data->invoice }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->waktu_tiba }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->start_time }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->burst_time }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->finish_time }}</td>
                <td class="tg-0pky" style="text-align: center">{{ $data->waiting_time }}</td>
                {{-- <td class="tg-0pky" style="text-align: center">{{ $data->tat }}</td> --}}
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