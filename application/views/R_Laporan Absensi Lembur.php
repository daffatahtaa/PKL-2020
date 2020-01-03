    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Laporan Absensi Lembur</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Report</a></li>
                    <li class="breadcrumb-item active">Laporan Absensi Lembur</li>
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

                  <div class="form-group row">

                  <div class="col-md-3">
                    <label>Bulan</label>
                    <input name='bulan' class="form-control" type="month"
                      value="<?php if ($postData) {
                        echo $postData['bulan'];
                        } ?>">
                  </div>

                  </div>

                <div class="form-group row">
                  <div class="col-lg-3">
                  <input class="btn btn-primary" type="button"
                    onclick="submitForm('<?php echo base_url() ?>report/absensi_lembur')" value="Tampilkan">

                              <a class="dropdown dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
                                  <i class="fas fa-file-export"></i> Export<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu dropdown-user">
                                  <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/pdf_report_lembur')">
                                  <i class="fas fa-file-export"> Export ke pdf</i></a></li>

                                  <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/excel_report_lembur')">
                                  <i class="fas fa-file-export"> Export ke excel</i></a></li>

                                  <li><a class="btn" onclick="submitForm('<?php echo base_url() ?>report/csv_report_lembur')">
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
                 <th>Personal Number</th>
                 <th>Nama</th>
                 <th>Lembur Masuk</th>
                 <th>Lokasi Absen Masuk</th>
                 <th>Lembur Pulang</th>
                 <th>Lokasi Absen Pulang</th>
                 <th>Created By</th>

               </tr>
                <?php if ($data) { ?>
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
</script>
