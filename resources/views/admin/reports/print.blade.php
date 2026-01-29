<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="no-print">
        <button onclick="window.print()">Cetak Laporan</button>
    </div>

    <div class="header">
        <h2>PERPUSTAKAAN DIGITAL</h2>
        <h3>Laporan Peminjaman Buku</h3>
        <p>Periode: {{ $start_date }} s/d {{ $end_date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $index => $b)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $b->user->name }}</td>
                <td>{{ $b->book->title }}</td>
                <td>{{ $b->borrow_date }}</td>
                <td>{{ $b->return_date }}</td>
                <td>{{ $b->fine > 0 ? 'Rp ' . number_format($b->fine, 0, ',', '.') : '-' }}</td>
                <td>{{ ucfirst($b->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Diketahui Oleh,</p>
        <br><br><br>
        <p>Kepala Perpustakaan</p>
    </div>

</body>

</html>