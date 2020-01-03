    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Pegawai</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>maintenance_data/lihatPegawai">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Pegawai</li>
                  </ol>
              </div>
          </div>
          <div class="card">
            <div style="padding: 20px;">

            <div>
                              <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Tambakan Data Pegawai
                  </button>
                  <br>
                  <?php if ( validation_errors( )) :?>
                                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:20px;" >
                                <button type="button" class="close" data-dismiss="alert">&times;</button>  <?php echo validation_errors();?>
                                </div>
                  <?php endif;
                  if($this->session->flashdata('flash')){ ?>
                  <br>
                    <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                   Proses Perubahan Pegawai Berhasil <?php echo $this->session->flashdata('flash');
                   ?>
                   </div>
                  <?php }else if($this->session->flashdata('hapuspegawai')){?>
                    <br>
                    <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                   Proses Penghapusan Pegawai Berhasil <?php echo $this->session->flashdata('hapuspegawai');
                   ?>
                   </div>
                  <?php }?>
                  <!-- Modal TAMBAH-->
                  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3  class="modal-title" id="exampleModalLongTitle">Tambahkan Data Pegawai</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <form action="<?php echo base_url();?>maintenance_data/tambahPegawai" method="POST" >

                                  <div class="form-group row">
                                  <label class="col-md-4">Personal Number</label>
                                  <div class="col-md-8">
                                  <select class="form-control js-example-basic-single"  name="pernpegawai" id="pernpegawai"  >
                                            <option value="">Personal Number</option>
                                  </select>
                                  </div>
                                  </div>

                                  <div class="form-group row">
                                  <label class="col-md-4">Kode Uker</label>
                                  <div class="col-md-8">
                                  <select class="form-control js-example-basic-single" name="orgeh" id="uker">
                                            <option value="">Unit Kerja</option>
                                  </select>
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
                  <!-- akhir modal tambah -->
              <br>
              <table id="tabelqu" class="table" style="width:100%; margin-bottom:100px;">
                <thead>
                <tr>
                 <th>No.</th>
                 <th>Personal Number</th>
                 <th>Nama</th>
                 <th>Kode Uker</th>
                 <th>Nama Uker</th>
                 <th>Tgl Input</th>
                 <th>Hapus</th>
               </tr>
               </thead>
               <tbody>
               <?php $counter=1;
                $this->load->helper('date');
                $datestring = '%Y%m%d';
                $time = time();
               foreach($pegawaiku as $hasil):?>
               <tr>
                 <td><?php echo $counter ;?></td>
                 <td><?php echo $hasil['PERNR'];?></td>
                 <td><?php echo $hasil['SNAME'];?></td>
                 <td><?php echo $hasil['ORGEH'];?></td>
                 <td><?php echo $hasil['UKER'];?></td>
                 <td><?php echo date('d-F-Y' , strtotime(substr($hasil['CREATE_DATE'],0,10))) ; ?></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $counter;?>"><i class="fa fa-trash"></i></a></td>
                 <!-- Modal Hapus PEGAWAI-->
                    <div class="modal fade" id="ModalLongHapus<?php echo $counter;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Data Pegawai Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusPegawai" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Personal Number</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="personalnumber" value="<?php echo $hasil['PERNR'];?>" disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Nama</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="namapeg" value="<?php echo $hasil['SNAME'];?> " disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Kode Uker</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" value="<?php echo $hasil['UKER'];?> " disabled >
                                  <input class="form-control" type="hidden" name="PERNRlama" value="<?php echo $hasil['PERNR'];?>">
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
                                <!-- akhir modal hapus -->
               </tr>


              <?php $counter++; endforeach; ?>
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
        "scrollCollapse": true

    });} );
    </script>

<script>

    $.fn.modal.Constructor.prototype._enforceFocus = function() {

      $(document).ready(function() {
                $('#pernpegawai').select2({
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
                minimumInputLength : 1
            });
          });
      $(document).ready(function() {
                $('#uker').select2({
                  ajax: {
                  url: '<?php echo base_url();?>maintenance_data/lihatuker',
                  type : 'post',
                  dataType: 'json',
                  delay : 250,
                  data: function(params){
                    return{
                      searchTerm : params.term //search term
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
                minimumInputLength : 2
            });
          });
    };




</script>
