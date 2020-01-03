<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-md-5 col-8 align-self-center">
              <h3 class="text-themecolor m-b-0 m-t-0">Data Hari Libur</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>maintenance_data/C_hariLibur">Data Hari Libur</a></li>
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
            Tambahkan Hari Libur
          </button>

          <br>
          <?php if ( validation_errors( )) :?>
                        <div class="alert alert-danger " role="alert" style="margin-top:20px;" >
                            <?php echo validation_errors();?>
                        </div>
          <?php endif; ?>
          <!-- Modal TAMBAH-->
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3  class="modal-title" id="exampleModalLongTitle">Tambahkan Hari Libur</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="<?php echo base_url();?>maintenance_data/tambahHariLibur" method="POST">

                    <div class="form-group row">
                    <label class="col-md-4">Tanggal</label>
                    <div class="col-md-8">
                      <input class="form-control" type="date" name="tgl">
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-4">Jenis Hari Libur</label>
                    <div class="col-md-8">
                      <label class="custom-control custom-radio">
                          <input checked class="custom-control-input" type="radio" name="jenlibur" value=1>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-description">Hari Libur Nasional</span>
                      </label>
                      <label class="custom-control custom-radio">
                          <input checked class="custom-control-input" type="radio" name="jenlibur" value=2>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-description">Cuti Bersama</span>
                      </label>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-4">Keterangan</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" name="ket">
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
      <br>

          <table  id="tabelqu" class="table">
            <thead>
              <tr>
             <th>No.</th>
             <th>Tanggal</th>
             <th>Keterangan</th>
             <th>Jenis Hari Libur</th>
             <th>Hapus</th>
              </tr>
            </thead>
              <tbody>
             <?php
             $counter=1;
             foreach($harilibur as $result ){
               ?>
            <tr>
             <td><?php echo $counter;?></td>
             <td> <?php echo date('d M Y' , strtotime(substr($result['POSISI'],0,10))) ; ?></td>
             <td><?php echo $result['KETERANGAN']?></td>
             <td><?php if($result['JENIS']== 1){
               echo "HARI LIBUR NASIONAL" ;
             }else if($result['JENIS']==2){
               echo " CUTI BERSAMA ";
             }?></td>
             <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $counter;?>"><i class="fa fa-trash"></i></a></td>
                   <!-- Modal Hapus PEGAWAI-->
                   <div class="modal fade" id="ModalLongHapus<?php echo $counter;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Data Hari Libur Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusHariLibur" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Tanggal</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="personalnumber" value="<?php echo date('d M Y' , strtotime(substr($result['POSISI'],0,10))) ;?>" disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jenis Hari libur</label>
                                <div class="col-md-8">
                                <input class="form-control" type="text" value="<?php if($result['JENIS']== 1){
                                                                                    echo "HARI LIBUR NASIONAL" ;
                                                                                  }else if($result['JENIS']==2){
                                                                                    echo " CUTI BERSAMA ";
                                                                                  }?>" disabled >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Keterangan</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="namapeg" value="<?php echo $result['KETERANGAN'];?> " disabled>
                                </div>
                                </div>

                                    <input class="form-control" type="hidden" name="posisiLama" value="<?php echo $result['POSISI'];?>">
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
             <?php
              $counter++;} ?>
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
