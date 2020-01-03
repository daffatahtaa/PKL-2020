<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<div class="page-wrapper">
                <div class="container-fluid">
                  <div class="row page-titles">
                      <div class="col-md-5 col-8 align-self-center">
                          <h3 class="text-themecolor m-b-0 m-t-0">Home</h3>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Home</a></li>
                          </ol>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-lg-12">
                          <div class="card">
                              <div class="card-body">
                                  <h4 class="card-title">Absensi Pegawais</h4>
                                  <form action="<?php echo base_url() ?>home/index" method="POST" id='form1'>
                                    <div class="form-group row" >

                                      <div class="col-md-3">
                                      <label>Tahun</label>
                                      <input id='tahun' class="form-control" type="number" min="1980" max="2099" name="tahun" value="">
                                      </div>

                                      <div class="col-md-3">
                                      <label>Bulan</label>
                                      <select id='bulan' class="form-control" name="bulan">
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

                                    </div>

                                      <div class="form-group row">

                                        <div class="col-md-3">
                                          <input  class="btn btn-primary"
                                            type='submit' value="Tampilkan">
                                        </div>

                                      </div>

                                    </form>
                                    	<canvas id="myChart"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
          </div>
        </div>
        <script>
          var ctx = document.getElementById("myChart").getContext('2d');
      		var myChart = new Chart(ctx, {
      			type: 'horizontalBar',
      			data: {
      				labels: [<?php
                  $i = 0;
                  foreach ($data as $item) {
                    echo $item['PERNR'].',';
                    if ($this->session->userdata['logged_in']['role'] === 'Admin') {
                        $data['role']=1;
                    }elseif ($this->session->userdata['logged_in']['role'] === 'Div') {
                        $data['role']=2;
                    }
                    $data['orgeh']=$this->session->userdata['logged_in']['uker'];
                    $query = $this->db->query("EXEC SP_REPORT_BI
                    ".$data['role'].",".$postData['typePosisi'].",'BI'
                    ,'".$data['orgeh']."','".$data['orgeh']."','".$postData['posisi']."'
                    ,'".$item['PERNR']."','KERJA NORMAL'");
                    if ($query->result()) {
                      foreach ($query->result() as $value) {
                        $data_masuk[$i] = $value->JUMLAH;
                      }
                    }else {
                      $data_masuk[$i] = 0;
                    }
                    $query2 = $this->db->query("EXEC SP_REPORT_BI
                    ".$data['role'].",".$postData['typePosisi'].",'BI'
                    ,'".$data['orgeh']."','".$data['orgeh']."','".$postData['posisi']."'
                    ,'".$item['PERNR']."','TERLAMBAT MASUK'");
                    if ($query2->result()) {
                      foreach ($query2->result() as $value) {
                        $data_terlambat[$i] =  $value->JUMLAH;
                      }
                    }else {
                      $data_terlambat[$i] =  0;
                    }
                    $query3 = $this->db->query("EXEC SP_REPORT_BI
                    ".$data['role'].",".$postData['typePosisi'].",'BI'
                    ,'".$data['orgeh']."','".$data['orgeh']."','".$postData['posisi']."'
                    ,'".$item['PERNR']."','LAIN-LAIN'");
                    if ($query3->result()) {
                      foreach ($query3->result() as $value) {
                        $data_lain[$i] =  $value->JUMLAH;
                      }
                    }else {
                      $data_lain[$i] =  0;
                    }
                    $i++;
                  }
                  ?>
              ],
      				datasets: [{
      					label: 'Masuk',
      					data: <?php echo json_encode($data_masuk); ?>,
      					backgroundColor: [
      					'#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb'
      					],
      					borderColor: [
      					'#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb',
                '#17c0eb'
      					],
      					borderWidth: 1
      				},

              {
                label: 'Terlambat',
                data: <?php echo json_encode($data_terlambat); ?>,
                backgroundColor: [
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40'
                ],
                borderColor: [
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40',
                  '#ffaf40'
                ],
                borderWidth: 1
              },

              {
      					label: 'Lain-Lain',
      					data: <?php echo json_encode($data_lain); ?>,
      					backgroundColor: [
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5'
      					],
      					borderColor: [
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5',
                  '#7efff5'
      					],
      					borderWidth: 1
      				}
            ]
      			},
      			options: {
              title: {
                        display: true,
                        position: "top",
                        text: "Rekap Absensi Pegawai",
                        fontSize: 18,
                        fontColor: "#000000"
                      },
      				scales: {
      					yAxes: [{
      						ticks: {
      							beginAtZero:true
      						}
      					}]
      				}
      			}
      		});
      	</script>
<script type="text/javascript">
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
  $('#bulan').val(val3);
  $('#tahun').val(val4);
</script>
