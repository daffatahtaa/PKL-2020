    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Lembur Otomatis</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Lembur Otomatis</li>
                  </ol>
              </div>
          </div>
          <div class="card">
            <div style="padding: 20px;">

            <div class="">
            <div class="">

              <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Tambakan Data Lembur Otomatis
  </button>
  <br>
  <?php if ( validation_errors( )) :?>
                <div class="alert alert-danger alert-dismissible " role="alert" style="margin-top:20px;" >
                <button type="button" class="close" data-dismiss="alert">&times;</button>   <?php echo validation_errors();?>
                </div>
  <?php endif; 
  if($this->session->flashdata('flash')){ ?>
    <br>
      <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
     Proses Penambahan Pegawai Lembur Otomatis Berhasil <?php echo $this->session->flashdata('flash');
     ?>
     </div>
    <?php }else if($this->session->flashdata('hapuspegawaiLembur')){?>
      <br>
      <div class="alert alert-danger alert-dismissible hide_msg" style="width:100%;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
     Proses Penghapusan Pegawai Lembur Otomatis Berhasil <?php echo $this->session->flashdata('hapuspegawaiLembur');
     ?>
     </div>
    <?php }?> 
  <!-- Modal TAMBAH-->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h3  class="modal-title" id="exampleModalLongTitle">Tambahkan Data Pegawai</h3>
        </div>
        <div class="modal-body">
                <form class="form-inline" action="<?php echo base_url();?>maintenance_data/C_TambahPegawaiLemburOtomatis" method="POST" >
                  <label><span style="margin-right:1.9em">Personal Number  </span>      :</label>
                  <select  name="pernpegawai" id="pernpegawai" class="js-example-basic-single"  style="width: 60%; ">
                                            <option value="">--PILIH PEGAWAI--</option>
                  </select>
                  <br>
                  <br>

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
  </div>
              <?php if($lemburotomatis != null ){
              ?>
                <br>
                  <table id="tabelqu" class="table" style="width:100%; margin-bottom:100px;">
                <thead>
                <tr>
                 <th>No.</th>
                 <th>Personal Number</th>
                 <th>Nama</th>
                 <th>Waktu Lembur</th>
                 <th>Hapus</th>
                </tr>
               </thead>
               <tbody>
               <?php $counter=1;
                $this->load->helper('date');
                $datestring = '%Y%m%d';
                $time = time();
               foreach($lemburotomatis as $hasil):?>
               <tr>
                 <td><?php echo $counter ;?></td>
                 <td><?php echo $hasil['PERNR'];?></td>
                 <td><?php echo $hasil['NAMA'];?></td>
                 <td><?php echo date('d-F-Y' , strtotime(substr($hasil['CREATE_DATE'],0,10))) ; ?></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $counter;?>"><i class="fa fa-trash"></i></a></td>
                 <!-- Modal Hapus PEGAWAI-->
                    <div class="modal fade" id="ModalLongHapus<?php echo $counter;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Data Lembur Otomatis Pegawai Berikut?</h3>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/C_HapusPegawaiLemburOtomatis" method="POST" >
                                        <label><span style="margin-right:1.9em">Personal Number  </span>      :</label>
                                        <input class="form-control" type="text" name="personalnumber" value="<?php echo $hasil['PERNR'];?>" disabled>
                                        <br>
                                        <label><span style="margin-right:7.5em">Nama </span>      :</label>
                                        <input class="form-control" type="text" name="namapeg" value="<?php echo $hasil['NAMA'];?> " disabled>
                                        <input class="form-control" type="hidden" name="PERNRlama" value="<?php echo $hasil['PERNR'];?>">
                                        <input class="form-control" type="hidden" name="tgllama" value="<?php echo $hasil['CREATE_DATE'];?>">

                                      <br>
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

               <div class="">

              <?php $counter++; endforeach; ?>
              </tbody>
              </table>
              <?php }else{
                echo  "|Belum ada data pegawai|";
              }
              ?>
            </div>
            </div>

        </div>
    </div>
  </div>
</div>
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
}
</script>
<script>
    $(document).ready(function() {
    $('#tabelqu').DataTable({

        "scrollCollapse": true,

    });} );
    </script>
