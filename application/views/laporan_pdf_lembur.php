<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi Lembur</title>
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

    <h2>Laporan Absensi Lembur</h2>

    <table style="width:100%">
        <thead>
            <tr>
                <th colspan="9">Printed on <?php echo date("d M Y") ?></th>
            </tr>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Personal Number</th>
                <th>Nama</th>
                <th>Lembur Masuk</th>
                <th>Lokasi Absen Masuk</th>
                <th>Lembur Pulang</th>
                <th>Lokasi Absen Pulang</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter=1 ?>
            <?php foreach ($data as $item) { ?>
                <tr>
                <td><?php echo $counter;?></td>
                <td><?php echo $item->tanggal;?></td>
                <td><?php echo $item->personalnumber; ?></td>
                <td><?php echo $item->nama; ?></td>
                <td><?php echo $item->lembur_masuk; ?></td>
                <td><?php echo $item->lokasi_masuk; ?></td>
                <td><?php echo $item->lembur_pulang; ?></td>
                <td><?php echo $item->lokasi_pulang; ?></td>
                <td><?php echo $item->created_by; ?></td>
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
                <th style=" border: #ffffff ;" colspan="5"></th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
