<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
      <div class="row page-titles">
          <div class="col-md-5 col-8 align-self-center">
              <h3 class="text-themecolor m-b-0 m-t-0">Data Absensi</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>maintenance_data/lihatPegawai">Maintenance Data</a></li>
                <li class="breadcrumb-item active">Data Absensi</li>
              </ol>
          </div>
      </div>
      <div class="card">
        <div style="padding: 20px;">
               <?php if($this->session->flashdata('edits')){ ?>
                  <br>
                    <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                   Proses Perubahan ABsensi Berhasil <?php echo $this->session->flashdata('edits');?>
               </div>
               <?php }?>
                   
               
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
               <?php if ( validation_errors( )) :?>
                                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:20px;" >
                                <button type="button" class="close" data-dismiss="alert">&times;</button>  <?php echo validation_errors();?>
                                </div>
                  <?php endif; ?>
            <form action="<?php echo base_url();?>maintenance_data/data_absensi" method="POST" id='form1' >
              <div class="form-group row" style="margin-bottom:0;">
                <div class="col-md-4">
                <label>Bulan</label>
                <input class="form-control" type="month" id="bulan"
                  value="" name='bulan'> &ensp;
                </div>
                <div class="col-md-4">
                <label>Tanggal</label>
                <select id="tanggal" class="form-control" name="tanggal">
                <option value="ALL">ALL</option>
                <?php for ($x = 1; $x <= 31; $x++) { ?>
                  <option value="<?php  if($x == 1 || $x<=9){
                      echo '0'.$x;
                    }else{
                        echo $x;
                      }
                    ?>"><?php echo $x ?></option>
                <?php } ?>
                </select>
                </div>
                <div class="col-md-4 col-sm-2">
                <label>Jenis Absen</label>
                <select id="jenis" class="form-control" name="jenis">
                <option value="ALL">ALL</option>
                </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                <input  class="btn btn-primary" type="button"
                  onclick="submitForm('<?php echo base_url() ?>maintenance_data/data_absensi')" value="Tampilkan">
                </div>
              </div>
          </form>
            <div style="overflow-x: auto;">
            <table id="tabelqu" class="table" >
            <thead>
              <tr>
               <th>No.</th>
               <th>Edit</th>
               <th>Tanggal</th>
               <th>PN</th>
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
             <?php if (isset($data)) { ?>
                  <?php $counter=1 ?>
                  <?php foreach ($data as $item) { ?>
                    <tr>
                      <td><?php echo $counter;?></td>
                      <td><a title="Edit" role="button" href="#" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalLongEdit<?php echo $counter;?>"><i class="fa fa-edit"></i></a></td>
                      <td><?php echo  $item['POSISI'];?></td>
                      <td><?php echo $item['PERNR'];; ?></td>
                      <td><?php echo $item['NAMA']; ?></td>
                      <td><?php echo substr($item['MASUK_KERJA'],0,8).' '.substr($item['MASUK_KERJA'],17,3); ?></td>
                      <td><?php echo substr($item['MASUK_KERJA_OLD'],0,8).' '.substr($item['MASUK_KERJA_OLD'],17,3); ?></td>
                      <td><?php echo $item['MASUK_KERJA_EDC']; ?></td>
                      <td><?php echo substr($item['PULANG_KERJA'],0,8).' '.substr($item['PULANG_KERJA'],17,3); ?></td>
                      <td><?php echo substr($item['PULANG_KERJA_OLD'],0,8).' '.substr($item['PULANG_KERJA_OLD'],17,3); ?></td>
                      <td><?php echo $item['PULANG_KERJA_EDC']; ?></td>
                      <td><?php echo $item['KET']; ?></td>
                      <td><?php echo $item['REMARK']; ?></td>
                      <td><?php echo $item['INFO']; ?></td>
                                <!-- Modal Edit pegawai-->
              <div class="modal fade" id="ModalLongEdit<?php echo $counter;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Merubah Data Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/editDataAbsensi" method="POST" >
                                <div class="form-group row">
                                <label class="col-md-4">Tanggal: </label>
                                <div class="col-md-8">
                                  <input class="form-control" type="Text" name="posisi" value="<?php echo date('l, F d , Y' , strtotime(substr($item['POSISI'],0,10)));?>" disabled >
                                  <input class="form-control" type="hidden" name="posisi" value="<?php echo $item['TANGGAL'];?> "  >
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-4">Personal Number: </label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="pern" value="<?php echo $item['PERNR'];?> " disabled  >
                                  <input class="form-control" type="hidden" name="pern" value="<?php echo $item['PERNR'];?> "  >
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-4">Nama Pegawai: </label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="nama" value="<?php echo $item['NAMA'];?>" disabled  >
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-4">Masuk Kerja</label>
                                <div class="col-md-8">
                                  <?php if ( substr($item['MASUK_KERJA'],0,8) < substr($item['JADWAL_KERJA_MASUK'],0,8) and $item['MASUK_KERJA'] == "00:00:00.0000000"   ){
                                  ?>
                                  <input class="form-control" type="time" name="jamMasuk" value="<?php echo substr($item['MASUK_KERJA'],0,8);?>" disabled >
                                  <input class="form-control" type="hidden" name="jamMasuk" value ="<?php echo substr($item['MASUK_KERJA'],0,8) ;?>" >
                                  <input class="form-control" type="hidden" name="jamMasukAwal" value ="<?php echo substr($item['MASUK_KERJA'],0,8) ;?>" >
                                <?php  }else{?>
                                  <input class="form-control" type="time" name="jamMasuk" value="<?php echo substr($item['MASUK_KERJA'],0,8);?>" >
                                  <input class="form-control" type="hidden" name="jamMasukAwal" value ="<?php echo substr($item['MASUK_KERJA'],0,8) ;?>" >
                                <?php }?>                                 
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-4">Pulang Kerja</label>
                                <div class="col-md-8">
                                  <?php if ($item['PULANG_KERJA'] > $item['JADWAL_KERJA_PULANG'] and $item['PULANG_KERJA'] != "00:00:00.0000000"   ){
                                  ?>
                                  <input class="form-control" type="time" name="jamPulang" value="<?php echo substr($item['PULANG_KERJA'],0,8) ;
                                ?>" disabled >
                                <input class="form-control" type="hidden" name="jamPulang" value="<?php echo substr($item['PULANG_KERJA'],0,8) ;
                                ?>" >
                                <input class="form-control" type="hidden" name="jamPulangAwal" value ="<?php echo substr($item['PULANG_KERJA'],0,8) ;?>" >
                              <?php  }else{?>
                                <input class="form-control" type="time" name="jamPulang" value="<?php echo substr($item['PULANG_KERJA'],0,8) ;?>" >
                                <input class="form-control" type="hidden" name="jamPulangAwal" value ="<?php echo substr($item['PULANG_KERJA'],0,8) ;?>" >
                  <?php }?>
                  </div>
                  </div>
                  <div class="form-group row">
                  <label class="col-md-4">Koreksi </label>
                  <div class="col-md-8">
                  <select id="jeniskoreksi" class="jeniskoreksi js-example-basic-single" name="kode" style="width:100%">
                      <option value="">--Pilih Koreksi---</option>
                  </select>
                  </div>
                  </div>
                  <div class="form-group row">
                  <label class="col-md-4">Keterangan </label>
                  <div class="col-md-8">
                    <textarea  class="form-control" type="text" rows="5" name="ket"  ></textarea>
                  </div>
                  </div>
                </div>
                <input class="form-control" type="hidden" id="bulan1"
                  value="" name='bulan'>
                <div class="modal-footer" id="footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

              </form>
            </div>
          </div>
        </div>
        <!-- AKhir modal Edit -->
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

<script>
    $(document).ready(function() {
    $('#tabelqu').DataTable({
        "scrollCollapse": true

    });} );
</script>
<script type="text/javascript">
  function submitForm(action) {
    var form = document.getElementById('form1');
    form.action = action;
    form.submit();
  }
</script>
<script>
    $(document).ready(function() {
                $('#jenis').select2({
                  ajax: {
                  url: '<?php echo base_url();?>maintenance_data/lihatJenisAbsen',
                  type : 'post',
                  dataType: 'json',
                  delay : 250,
                  data: function(params){
                    return{
                      keyword : params.term //search term
                    };
                  },
                  processResults :function(response){
                    return{
                      results : response
                    };
                  },
                  cache:true

    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                minimumInputLength : 1
            });
          });
</script>
<script type="text/javascript">
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
                  }
                 ?>';      
            
  $('#tanggal').val(val1);
  $('#jenis').val(val2);
  $('#bulan').val(val3);
  $('#bulan1').val(val3);

</script>
<script>
 $.fn.modal.Constructor.prototype._enforceFocus = function() {
    $(document).ready(function() {
                $('.jeniskoreksi').select2({
                  ajax: {
                  url: '<?php echo base_url();?>maintenance_data/lihatJenisAbsen',
                  type : 'post',
                  dataType: 'json',
                  delay : 250,
                  data: function(params){
                    return{
                      keyword : params.term //search term
                    };
                  },
                  processResults :function(response){
                    return{
                      results : response
                    };
                  },
                  cache:true
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                minimumInputLength : 1
            });
          });
 };
</script>