<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak QR</title>
    <style>
        body {
          background: #555;
        }
        
        .content {
          max-width: 500px;
          margin: auto;
          background: white;
          padding: 40px;
        }
        </style>
</head>
<body onload="window.print()">
    <div class="content">
        <table style="undefined;table-layout: fixed; width: 360px">
            <colgroup>
            <col style="width: 120px">
            <col style="width: 120px">
            <col style="width: 120px">
            {{-- <col style="width: 180px">
            <col style="width: 180px"> --}}
            </colgroup>
            <thead>
              <tr>
                <th colspan="3">PESAN DISINI</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                {{-- <td colspan="3">PESAN DISINI</td> --}}
                <td class="tg-fymr">{!! QrCode::size(300)->generate(Request::url('https://6c2129e63586-12817177712444975226.ngrok-free.app')) !!}</td>
                {{-- <td class="tg-fymr">{!! QrCode::size(300)->generate(Request::url('http://127.0.0.1:8000/guest/dashboard')) !!}</td> --}}
                <td colspan="3" rowspan="3">
                </td>
              </tr>
              <tr>
                <td colspan="3">USERNAME : {{ ($cetakStruk->room) }}</td>
            </tr>
            <tr>
            <td colspan="3">PASSWORD : {{ ($cetakStruk->room) }}</td>
        
            </tr>
            </tbody>
            </table> 
    </div>
 
</body>
</html>