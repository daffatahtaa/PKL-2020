<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi Detail</title>
    <style>
        body {
            font-family: Calibri;
            font-size: 12px;
        }
        .page-break {
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            /* background-color: #dddddd; */
        }
    </style>
</head>
<body>

    <h2>Laporan Absensi Detail</h2>

    <table style="width:100%">
        <thead>
            <tr>
                <th colspan="13">Printed on <?php echo date("d M Y") ?></th>
            </tr>
            <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>PerNr</th>
            <th>Nama</th>
            <th>Masuk Kerja</th>
            <th>Masuk Kerja Awal</th>
            <th>Lokasi Absen Masuk</th>
            <th>Pulang Kerja</th>
            <th>Pulang Kerja Awal</th>
            <th>Lokasi Absen Pulang</th>
            <th>Keterangan</th>
            <th>Remark</th>
            <th>Info</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter=1 ?>
            <?php foreach ($data as $item) { ?>
                <tr>
                <td><?php echo $counter;?></td>
                <td><?php echo $item->TANGGAL;?></td>
                <td><?php echo $item->PERNR;?></td>
                <td><?php echo $item->NAMA;?></td>
                <td><?php echo $item->MASUK_KERJA;?></td>
                <td><?php echo $item->MASUK_KERJA_EDC;?></td>
                <td><?php echo $item->LOKASI_ABSEN_MASUK;?></td>
                <td><?php echo $item->PULANG_KERJA;?></td>
                <td><?php echo $item->PULANG_KERJA_EDC;?></td>
                <td><?php echo $item->LOKASI_ABSEN_PULANG;?></td>
                <td><?php echo $item->KET;?></td>
                <td><?php echo $item->REMARK;?></td>
                <td><?php echo $item->INFO;?></td>
                </tr>
            <?php $counter++ ?>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align: center" colspan="2">Dibuat Oleh,
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?php echo $this->session->userdata['logged_in']['id']; ?>
                </th>
                <br>
                <th colspan="2">
                Unit Kerja,
                <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?php echo $this->session->userdata['logged_in']['uker']; ?>
                </th>
                <th style="border: #ffffff;" colspan="9"></th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
