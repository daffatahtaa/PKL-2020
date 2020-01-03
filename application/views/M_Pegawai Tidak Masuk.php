    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Tidak Masuk Kerja</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Tidak Masuk Kerja</li>
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

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                  Tambahkan Data Tidak Masuk Kerja
                </button>

              <br>
              <?php if ( validation_errors( )) :?>
                            <div class="alert alert-danger " role="alert" style="margin-top:20px;" >
                                <?php echo validation_errors();?>
                            </div>
              <?php endif; 
                if($this->session->flashdata('tidakMasuk')){ ?>
                  <br>
                    <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                   Proses Penambahan Pegawai Tidak Masuk Berhasil <?php echo $this->session->flashdata('tidakMasuk');
                   ?>
                   </div>
                  <?php }else if($this->session->flashdata('hapusTidakMasukpegawai')){?>
                    <br>
                    <div class="alert alert-danger alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                   Proses Penghapusan Pegawai Tidak Masuk Berhasil <?php echo $this->session->flashdata('hapusTidakMasukpegawai');
                   ?>
                   </div>
                  <?php }?>
              <!-- Modal TAMBAH Pegawai Tidak masuk-->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3  class="modal-title" id="exampleModalLongTitle">Tambahkan Data Tidak Masuk Kerja</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url();?>maintenance_data/insertDataTidakMasuk" method="POST">

                        <div class="form-group row">
                        <label class="col-md-4">Personal Number</label>
                        <div class="col-md-8">
                          <select id="namapegawai" class="js-example-basic-single form-control" name="pegawai" style="width:100%">
                               <option value="">Personal Number</option>
                          </select>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-4">Tanggal</label>
                        <div class="col-md-8">
                          <input class="form-control" type="date" name="tgl">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-4">Deskripsi</label>
                        <div class="col-md-8">
                          <select id="desk" class="js-example-basic-single form-control" name="kode" style="width:100%">
                          <?php foreach($desk as $result ){?>
                            <option value="<?php echo $result['KODE'];?>"> <?php echo $result['KODE'].' - '.$result['DESKRIPSI'];?></option>
                          <?php }?>

                          </select>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-4">Keterangan</label>
                        <div class="col-md-8">
                          <input placeholder="Keterangan" class="form-control" type="text" name="ket">
                        </div>
                        </div>

                        </div>
                        <div class="modal-footer" id="footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                      </form>

                      </div>

                  </div>
                </div>
              </div>
              <!-- akhir modal tambah -->
          <br>
              <table  id="tabelqu" class="table" style="width:100%">
              <thead>
                <tr>
                 <th>No.</th>
                 <th>Personal Number</th>
                 <th>Nama</th>
                 <th>Tanggal</th>
                 <th>Deskripsi</th>
                 <th>Keterangan</th>
                 <th>Hapus</th>
               </tr>
               </thead>
               <tbody>
               <?php
               $counter= 1;
               foreach($tidakmasuk as  $result){ ?>
               <tr>


                 <td><?php echo $counter ?></td>
                 <td><?php echo $result['PERNR'];?></td>
                 <td><?php echo $result['NAMA'];?></td>
                 <td><?php echo date('d M Y', strtotime($result['TANGGAL']));?></td>
                 <td><?php echo $result['KODE'].'-'.$result['DESKRIPSI'];?></td>
                 <td><?php echo $result['KETERANGAN'];?></td>
                 <td><a title="Hapus" href="#" type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#ModalLongHapus<?php echo $result['PERNR'];?>"><i class="fa fa-trash"></i></a></td>
               </tr>
               <!-- MODAL HAPUS -->
               <div class="modal fade" id="ModalLongHapus<?php echo $result['PERNR'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Data Absensi Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusTidakMasuk" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Personal Number</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="personalnumber" value="<?php echo $result['PERNR'];?>" disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Nama</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="namapeg" value="<?php echo $result['NAMA'];?> " disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Tanggal Tidak Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" value="<?php echo $result['TANGGAL'];?> " disabled >
                                  <input class="form-control" type="hidden" name="PERNRlama" value="<?php echo $result['PERNR'];?>">
                                </div>
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>

                <!-- akhir modal hapus -->
              <?php
              $counter++;
                } ?>
              </tbody>
              </table>
            </div>
          </div>
      </div>
        </div>
    </div>
    <script>

$.fn.modal.Constructor.prototype._enforceFocus = function() {

  $(document).ready(function() {
            $('#desk').select2({});
      });

      $(document).ready(function() {
                $('#namapegawai').select2({
                  ajax: {
                  url: '<?php echo base_url();?>maintenance_data/lihatDataPegawai',
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

            });
          });
};
</script>
 <script>
    $(document).ready(function() {
    $('#tabelqu').DataTable({
        "scrollCollapse": true,
    });} );
    </script>
