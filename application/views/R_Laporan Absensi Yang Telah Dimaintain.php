    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Laporan Absensi Yang Telah Dimaintain</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Report</a></li>
                    <li class="breadcrumb-item active">Laporan Absensi Yang Telah Dimaintain</li>
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
                <div style=" margin-bottom: 0;" class="form-group row">

                  <div class="col-md-3">
                  <label>Bulan</label>
                  <input class="form-control" type="month"
                    value="<?php if ($postData) {
                      echo $postData['bulan'];
                    } ?>" name='bulan'> &ensp;
                  </div>

                  <div class="col-md-3">
                  <label>Tanggal</label>
                  <select id="tanggal" class="form-control" name="tanggal">
                  <option value="ALL">ALL</option>
                  <?php for ($x = 1; $x <= 31; $x++) { ?>
                    <option value="<?php echo $x ?>"><?php echo $x ?></option>
                  <?php } ?>
                  </select>
                  </div>

                  <div class="col-md-3">
                  <label>Jenis Absen</label>
                  <select id="jenis" class="form-control" name="jenis">
                  <option value="ALL">ALL</option>
                  </select>
                  </div>

                </div>

                <div class="form-group row">

                  <div class="col-md-3">
                  <input class="btn btn-primary" type="button"
                    onclick="submitForm('<?php echo base_url() ?>report/absensi_telah_dimaintain')" value="Tampilkan">

                              <a class="dropdown dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
                                  <i class="fas fa-file-export"></i> Export<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu dropdown-user">
                                  <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/pdf_report_dimaintain')">
                                  <i class="fas fa-file-export"> Export ke pdf</i></a></li>

                                  <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/excel_report_dimaintain')">
                                  <i class="fas fa-file-export"> Export ke excel</i></a></li>

                                  <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/csv_report_dimaintain')">
                                  <i class="fas fa-file-export"> Export ke csv</i></a></li>
                              </ul>

                  </div>

                </div>

              </form>

              <div class="" style="overflow-x: auto;">

              <table>
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
               <?php if ($data) { ?>
                  <?php $counter=1 ?>
                  <?php foreach ($data as $item) { ?>
                    <tr>
                      <td><?php echo $counter;?></td>
                      <td><?php echo $item->tanggal;?></td>
                      <td><?php echo $item->personal_number; ?></td>
                      <td><?php echo $item->nama; ?></td>
                      <td><?php echo $item->masuk_kerja; ?></td>
                      <td><?php echo $item->masuk_kerja_awal; ?></td>
                      <td><?php echo $item->lokasi_masuk; ?></td>
                      <td><?php echo $item->pulang_kerja; ?></td>
                      <td><?php echo $item->pulang_kerja_awal; ?></td>
                      <td><?php echo $item->lokasi_pulang; ?></td>
                      <td><?php echo $item->keterangan; ?></td>
                      <td><?php echo $item->remark; ?></td>
                      <td><?php echo $item->info; ?></td>
                    </tr>
                    <?php $counter++ ?>
                  <?php }?>
                <?php } ?>
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
  $('#tanggal').val(val1);
  $('#jenis').val(val2);
</script>
