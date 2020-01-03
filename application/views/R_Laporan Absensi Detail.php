    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Laporan Absensi Detail</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Report</a></li>
                    <li class="breadcrumb-item active">Laporan Absensi Detail</li>
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
              <form action="" method="POST" id='form1'>
                <div class="form-group row" style="margin-bottom:0;">

                  <div class="col-md-2">
                  <label>Tahun</label>
                  <input id='tahun' name='tahun' type="number" class='form-control'
                    min="1980" max="2099" step="1"> &ensp;
                  </div>

                  <div class="col-md-2">
                  <label>Bulan</label>
                  <select id="bulan" class="form-control" name="bulan">
                  <option value="ALL">ALL</option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                  </select>
                  </div>

                  <div class="col-md-2">
                  <label>Tanggal</label>
                  <select id="tanggal" class="form-control" name="tanggal">
                  <option value="ALL">ALL</option>
                  <option value="01">1</option>
                  <option value="02">2</option>
                  <option value="03">3</option>
                  <option value="04">4</option>
                  <option value="05">5</option>
                  <option value="06">6</option>
                  <option value="07">7</option>
                  <option value="08">8</option>
                  <option value="09">9</option>
                  <?php for ($x = 10; $x <= 31; $x++) { ?>
                    <option value="<?php echo $x ?>"><?php echo $x ?></option>
                  <?php } ?>
                  </select>
                  </div>

                  <div class="col-md-2">
                  <label>Jenis Absen</label>
                  <select id="jenis" class="form-control" name="jenis">
                  <option value="ALL">ALL</option>
                  <option value="CP">Cepat Pulang</option>
                  <option value="TM">Terlambat Masuk</option>
                  <option value="TAP">Tidak Absen Pulang</option>
                  <option value="TAM">Tidak Masuk Kerja</option>
                  <!--<option value="LMBR">Lembur</option> belom bisa gaada tbl lembur-->
                  </select>
                  </div>

                </div>

                <div class="form-group row">

                  <div class="col-md-6">
                  <input  class="btn btn-primary" type="button"
                    onclick="submitForm('<?php echo base_url() ?>report/absensi_detail')" value="Tampilkan">

                    <a class="dropdown dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
                        <i class="fas fa-file-export"></i> Export<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/pdf_report_absensidetail')">
                        <i class="fas fa-file-export"> Export ke pdf</i></a></li>

                        <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/excel_report_absensidetail')">
                        <i class="fas fa-file-export"> Export ke excel</i></a></li>

                        <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/csv_report_absensidetail')">
                        <i class="fas fa-file-export"> Export ke csv</i></a></li>
                    </ul>

                  </div>
                </div>
            </form>

              <div class="" style="overflow-x: auto;">

              <table id='tabel1' class="table">
              <thead>
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
               <?php if ($data) { ?>
                  <?php $counter=1 ?>
                  <?php foreach ($data as $item) { ?>
                    <tr>
                      <td><?php echo $counter;?></td>
                      <td><?php echo $item->TANGGAL;?></td>
                      <td><?php echo $item->PERNR; ?></td>
                      <td><?php echo $item->NAMA; ?></td>
                      <td><?php echo $item->MASUK_KERJA; ?></td>
                      <td><?php echo $item->MASUK_KERJA_EDC; ?></td>
                      <td><?php echo $item->LOKASI_ABSEN_MASUK; ?></td>
                      <td><?php echo $item->PULANG_KERJA; ?></td>
                      <td><?php echo $item->PULANG_KERJA_EDC; ?></td>
                      <td><?php echo $item->LOKASI_ABSEN_PULANG; ?></td>
                      <td><?php echo $item->KET; ?></td>
                      <td><?php echo $item->REMARK; ?></td>
                      <td><?php echo $item->INFO; ?></td>
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
                echo $postData['tanggal'];
                }else{
                  echo "ALL";
                } ?>';
  var val2 = '<?php if ($postData) {
                echo $postData['jenis'];
                }else{
                  echo "ALL";
                } ?>';
  var val3 = '<?php if ($postData) {
                echo $postData['bulan'];
                }else{
                  echo "01";
                } ?>';
  var val4 = '<?php if ($postData) {
                echo $postData['tahun'];
                }else{
                  echo 2019;
                } ?>';
  $('#tanggal').val(val1);
  $('#jenis').val(val2);
  $('#bulan').val(val3);
  $('#tahun').val(val4);
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
