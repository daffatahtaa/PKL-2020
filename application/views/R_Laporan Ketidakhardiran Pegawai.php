    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Laporan Ketidakhadiran Pegawai</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Report</a></li>
                    <li class="breadcrumb-item active">Laporan Ketidakhadiran Pegawai</li>
                  </ol>
              </div>
          </div>

          <div class="card">
            <div style="padding: 20px;">

            <div>
              <style>
              table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
              }

              td {
                border: 1px solid #dddddd;
                text-align: center;
                padding: 8px;
              }
              th {
                border: 1px solid #dddddd;
                text-align: center;
                padding: 8px;
              }
              tr:nth-child(even) {
                background-color: #dddddd;
              }
              </style>
              <div class="col-lg-12">

              <form action="" method="POST" id='form1'>

                <div class="form-group row" style=" margin-bottom: 0;">

                <div class="col-md-3">
                <label>Dari Bulan</label>
                <input class="form-control" type="month" value="<?php if ($postData) {
                      echo $postData['awal'];
                    } ?>" name='awal'> &ensp;
                </div>

                <div class="col-md-3">
                  <label>Sampai Bulan</label>
                  <input class="form-control" type="month" value="<?php if ($postData) {
                      echo $postData['akhir'];
                    } ?>" name='akhir'>
                </div>

                <div class="col-md-3">
                  <label>Pekerja</label>
                  <select id="pekerja" class="form-control" name="pekerja">
                  <option value="ALL">ALL</option>
                  <option value="1">ORG</option>
                  <option value="2">OUTS</option>
                  </select>
                </div>

                </div>

                <div class="form-group row">

                <div class="col-md-3">
                  <button type="button" class="btn btn-primary"
                    onclick="submitForm('<?php echo base_url() ?>report/ketidakhadiran_pegawai')">
                  Tampilkan
                  </button>

                    <a class="dropdown dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
                    <i class="fas fa-file-export"></i> Export<b class="caret"></b></a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/pdf_report_ketidakhadiran')">
                                <i class="fas fa-file-export"> Export ke pdf</i></a></li>

                                <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/excel_report_ketidakhadiran')">
                                <i class="fas fa-file-export"> Export ke excel</i></a></li>

                                <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/csv_report_ketidakhadiran')">
                                <i class="fas fa-file-export"> Export ke csv</i></a></li>
                            </ul>

                </div>
              </div>

              </form>
            </div>
          </div>


<div  style="clear:left; overflow-x: scroll;">
              <table id='tabel1' class="table">
                <thead>
                  <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Posisi</th>
                    <th rowspan="2">PerNr</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Perusahaan</th>
                    <th colspan="6">Jumlah Hadir</th>
                    <th colspan="23">Jumlah Tidak Hadir</th>
                    <th rowspan="2">Keterangan</th>
                  </tr>
                  <tr>
                    <th>HKJ</th>
                    <th>Weekend</th>
                    <th>Libur</th>
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
                  </tr>
               </thead>
               <tbody>
                <?php if ($data) { ?>
                  <?php $counter=1 ?>
                  <?php foreach ($data as $item) { ?>
                  <tr>
                    <td><?php echo $counter;?></td>
                    <td><?php echo $item->POSISI;?></td>
                    <td><?php echo $item->PERNR;?></td>
                    <td><?php echo $item->NAMA;?></td>
                    <td><?php echo $item->PERUSAHAAN;?></td>
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
                <?php } ?>
               </tbody>
              </table>

            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
  function submitForm(action) {
    var form = document.getElementById('form1');
    form.action = action;
    form.submit();
  }
  var val1 = '<?php if ($postData) {
                echo $postData['pekerja'];
                }else{
                  echo "PSA";
                } ?>';
  $('#pekerja').val(val1);
</script>
<script>
$(document).ready(function() {
$('#tabel1').DataTable({
  scrollCollapse: true,
  paging: true,
  "lengthChange": true,
  columnDefs:[
    {width:'20%', targets:0}
  ],
  fixedColumns: true
});
} );
</script>