<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Penjualan</title>
    <style>
        body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; color: #333; }
        .header { text-align:center; margin-bottom:20px; }
        .header h2 { margin:0; }
        .info-table td { padding:5px 0; }
        .table { width:100%; border-collapse:collapse; margin-top:20px; }
        .table th, .table td { border:1px solid #999; padding:8px; text-align:left; }
        .right { text-align:right; }
        .total-box { margin-top: 20px; width: 100%; text-align: right; }
        .footer { margin-top:40px; text-align:center; font-size:11px; color:#777; }
    </style>
</head>
<body>

<div class="header">
    <h2><strong>INVOICE PENJUALAN</strong></h2>
    <small>SIPUTRA - Sistem Informasi Putra Samudera</small>
</div>

<!-- Informasi Umum -->
<table class="info-table" width="100%">
    <tr>
        <td>
            <strong>No. Invoice:</strong> INV-{{ str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }} <br>
            <strong>Tanggal:</strong> {{ $penjualan->tanggal }} <br>
            <strong>Gudang:</strong> {{ $penjualan->gudang->nama_gudang }}
        </td>
        <td class="right">
            <strong>Customer:</strong> {{ $penjualan->customer->nama_customer }} <br>
            <strong>No HP:</strong> {{ $penjualan->customer->no_hp }} <br>
            <strong>Alamat:</strong> {{ $penjualan->customer->alamat }}
        </td>
    </tr>
</table>


<!-- Detail Penjualan -->
<table class="table">
    <thead>
        <tr>
            <th style="width:5%;">No</th>
            <th style="width:25%;">Nama Ikan</th>
            <th style="width:15%;">Jumlah (Kg)</th>
            <th style="width:20%;">Harga / Kg</th>
            <th style="width:20%;">Subtotal</th>
        </tr>
    </thead>

    <tbody>
        @php $grandTotal = 0; @endphp

        @foreach ($penjualan->detail as $i => $d)
        @php $grandTotal += $d->subtotal; @endphp
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $d->ikan->nama }}</td>
            <td>{{ number_format($d->jumlah, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($d->harga_jual, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- GRAND TOTAL -->
<div class="total-box">
    <h3>Total Pembayaran: <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></h3>
</div>

<div class="footer">
    <hr>
    <p>Dokumen ini dibuat otomatis oleh sistem SIPUTRA.</p>
</div>

</body>
</html>
