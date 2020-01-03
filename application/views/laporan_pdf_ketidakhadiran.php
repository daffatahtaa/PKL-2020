<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Ketidakhadiran Pegawai</title>
    <!-- Bootstrap Core CSS -->
    <style>
        body, h2 {
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
            border: 1px solid #dddddd ;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            /* background-color: #dddddd; */
        }
    </style>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

</head>
<body>

        <h2>Laporan Ketidakhadiran Pegawai</h2>

        <table id="example" class="table" style="width:100%">
            <thead>
              <tr>
                <th colspan="42" style=" border: #ffffff ;"></th>
              </tr>
              <tr>
                <th colspan="42">Printed on <?php echo date("d M Y") ?></th>
              </tr>
              <tr>
                <th>No.</th>
                <th>POSISI</th>
                <th>PERNR</th>
                <th>NAMA</th>
                <th>PERUSAHAAN</th>
                <th>TIPE</th>
                <th>BULAN</th>
                <th>TAHUN</th>
                <th>ORGEH</th>
                <th>NAMA_ORGEH</th>
                <th>ORGEH_INDUK</th>
                <th>NAMA_ORGEH_INDUK</th>
                <th>HKJ</th>
                <th>WEEKEND</th>
                <th>LIBUR</th>
                <th>HD</th>
                <th>TM</th>
                <th>CP</th>
                <th>PC</th>
                <th>TK</th>
                <th>ST</th>
                <th>DL</th>
                <th>PJ</th>
                <th>PD</th>
                <th>NA</th>
                <th>SK</th>
                <th>TW</th>
                <th>CT</th>
                <th>CB</th>
                <th>ISS</th>
                <th>IM</th>
                <th>HDD</th>
                <th>PP</th>
                <th>LH</th>
                <th>MD</th>
                <th>PA</th>
                <th>KA</th>
                <th>BA</th>
                <th>PG</th>
                <th>IH</th>
                <th>IP</th>
                <th>KETERANGAN</th>
              </tr>
            </thead>
            <tbody>
              <?php $counter=1 ?>
              <?php foreach ($data as $item) { ?>
              <tr>
                <td><?php echo $counter;?></td>
                <td><?php echo $item->POSISI;?></td>
                <td><?php echo $item->PERNR;?></td>
                <td><?php echo $item->NAMA;?></td>
                <td><?php echo $item->PERUSAHAAN;?></td>
                <td><?php echo $item->TIPE;?></td>
                <td><?php echo $item->BULAN;?></td>
                <td><?php echo $item->TAHUN;?></td>
                <td><?php echo $item->ORGEH;?></td>
                <td><?php echo $item->NAMA_ORGEH;?></td>
                <td><?php echo $item->ORGEH_INDUK;?></td>
                <td><?php echo $item->NAMA_ORGEH_INDUK;?></td>
                <td><?php echo $item->HKJ;?></td>
                <td><?php echo $item->WEEKEND;?></td>
                <td><?php echo $item->LIBUR;?></td>
                <td><?php echo $item->HD;?></td>
                <td><?php echo $item->TM;?></td>
                <td><?php echo $item->CP;?></td>
                <td><?php echo $item->PC;?></td>
                <td><?php echo $item->TK;?></td>
                <td><?php echo $item->ST;?></td>
                <td><?php echo $item->DL;?></td>
                <td><?php echo $item->PJ;?></td>
                <td><?php echo $item->PD;?></td>
                <td><?php echo $item->NA;?></td>
                <td><?php echo $item->SK;?></td>
                <td><?php echo $item->TW;?></td>
                <td><?php echo $item->CT;?></td>
                <td><?php echo $item->CB;?></td>
                <td><?php echo $item->ISS;?></td>
                <td><?php echo $item->IM;?></td>
                <td><?php echo $item->HDD;?></td>
                <td><?php echo $item->PP;?></td>
                <td><?php echo $item->LH;?></td>
                <td><?php echo $item->MD;?></td>
                <td><?php echo $item->PA;?></td>
                <td><?php echo $item->KA;?></td>
                <td><?php echo $item->BA;?></td>
                <td><?php echo $item->PG;?></td>
                <td><?php echo $item->IH;?></td>
                <td><?php echo $item->IP;?></td>
                <td><?php echo $item->KETERANGAN;?></td>
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
                    <th style=" border: #ffffff ;" colspan="38"></th>
                </tr>
            </tfoot>

        </table>
</body>
</html>
