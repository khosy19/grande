<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    {{-- <title>GRANDE GARDEN CAFE</title> --}}
    <style>
        @media print {
            /* Gaya cetak struk */
            .struk {
                font-family: Arial, sans-serif;
                font-size: 10pt;
                line-height: 1.2;
                margin: 0;
                padding: 10px;
                width: 80mm; /* Lebar struk 80mm */
            }
            .judul  {
                word-spacing: 1px;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Konten struk -->
    <div class="struk">
        <h3 class="judul">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grande Garden Cafe</h3>
        <p>Jl. Kaliandra, Gamoh, Dayurejo, Kec. Prigen, Pasuruan, Jawa Timur 67157</p>
        <p>================================</p>
        <p>No Transaksi : {{ $cetak_struk->invoice }}</p>
        <p>Nama Barang: {{ $cetak_struk->nama_makanan }}</p>
        <p>Harga: {{ $cetak_struk->harga }}</p>
        <p>Jumlah: {{ $cetak_struk->jumlah }}</p>
        <p>Total Tagihan: {{ $cetak_struk->total }}</p>
        <p>Waktu Selesai: {{ $cetak_struk->finish_time }}</p>
        <p>================================</p>
        <p>Waktu Terbayar: {{ $cetak_struk->finish_time }}</p>
    
        {{-- <p>Deskripsi: {{ $data->name }}</p>
        <p>Nomor Meja: {{ $data->room }}</p> --}}
    </div>

    <!-- Tombol cetak -->
    {{-- <button onclick="window.print()">Cetak</button>
    <a href="{{ route('transaksi_kasir') }}" class="btn btn-danger btn-round">
        <i class="material-icons">arrow_back</i> Back
    </a> --}}
</body>
</html>
