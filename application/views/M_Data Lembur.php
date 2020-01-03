    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Lembur</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Lembur</li>
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
                Tambahkan Data Lembur
              </button>
              <br>
              <?php if ( validation_errors( )) :?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:20px;" >
                            <button type="button" class="close" data-dismiss="alert">&times;</button>  <?php echo validation_errors();?>
                            </div>
              <?php endif;
              if($this->session->flashdata('flashLembur')){ ?>
                <br>
                  <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                 Proses Penambahan Pegawai Lembur Berhasil <?php echo $this->session->flashdata('flashLembur');
                 ?>
                 </div>
                <?php }else if($this->session->flashdata('hapusLembur')){?>
                  <br>
                  <div class="alert alert-danger alert-dismissible hide_msg" style="width:100%;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                 Proses Penghapusan Pegawai Lembur Berhasil <?php echo $this->session->flashdata('hapusLembur');
                 ?>
                 </div>
                <?php }?> 
              <!-- Modal TAMBAH-->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3  class="modal-title" id="exampleModalLongTitle">Tambahkan Data Lembur</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url();?>maintenance_data/insertPegawaiLembur" method="POST">

                        <div class="form-group row">
                        <label class="col-md-4">Personal Number</label>
                        <div class="col-md-8">
                          <select id="namapegawai" class="js-example-basic-single form-control" name="pegawai" style="width:100%">
                              <option value="">Personal Number</option>
                          </select>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-4">Jam Lembur Masuk</label>
                        <div class="col-md-8">
                          <input class="form-control" type="time" name="masuk">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-4">Jam Lembur Pulang</label>
                        <div class="col-md-8">
                          <input class="form-control" type="time" name="pulang">
                        </div>
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
              <!-- akhir modal tambah -->

              <table id="tabelqu" class="table" style="">
              <thead>
                  <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Personal Number</th>
                  <th>Nama</th>
                  <th>Jam Lembur Masuk</th>
                  <th>Jam Lembur Keluar</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>

               <?php
               $counter = 1;
               foreach($lembur as $result){?>
               <tr>
                 <td><?php echo $counter;?></td>
                 <td><?php echo date('d M Y' , strtotime(substr($result['CREATE_DATE'],0,10))) ;?></td>
                 <td><?php echo $result['PERNR'];?></td>
                 <td><?php echo $result ['NAMA'];?></td>
                 <td><?php echo $result['LEMBUR_MASUK'];?></td>
                 <td><?php echo $result['LEMBUR_PULANG'];?></td>
                 <td><a  title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $counter;?>"><i class="fa fa-trash"></i></a></td>
                  <!-- Modal Hapus PEGAWAI-->
                  <div class="modal fade" id="ModalLongHapus<?php echo $counter;?>" tabindex="0" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Data Lembur Pegawai Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusLembur" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Personal Number</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="personalnumber" value="<?php echo $result['PERNR'];?>" disabled >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Nama</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="namapeg" value="<?php echo $result['NAMA'];?> " disabled >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jam Lembut Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" value="<?php echo $result['LEMBUR_MASUK'];?> " disabled >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jam Lembur Keluar</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" value="<?php echo $result['LEMBUR_PULANG'];?> " disabled >
                                 <input class="form-control" type="hidden" name="PERNRlama" value="<?php echo $result['PERNR'];?>">
                                 <input class="form-control" type="hidden" name="tgllama" value="<?php echo $result['CREATE_DATE'];?>">
                                </div>
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
               </tr>

              <?php $counter++; }?>
               </tbody>
              </table>

            </div>
        </div>
    </div>
  </div>
</div>


    <script>
    $(document).ready(function() {
    $('#tabelqu').DataTable({
        "scrollCollapse": true,

    });} );
    </script>
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
