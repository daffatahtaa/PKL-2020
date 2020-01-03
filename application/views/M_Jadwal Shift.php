    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Jadwal Shift</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>maintenance_data/lihatPegawai">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Jadwal Shift</li>
                  </ol>
              </div>
          </div>
          <div class="card">
            <div style="padding: 20px;">
            <?php if ( validation_errors( )) {?>
                                <div class="alert alert-danger alert-dismissible " role="alert" style="margin-top:20px;" >
                                <button type="button" class="close" data-dismiss="alert">&times;</button>  <?php echo validation_errors();?>
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


              <table>
                <tr>
                 <th>Jenis</th>
                 <th>Jadwal Masuk</th>
                 <th>Jadwal Keluar</th>
                 <th>Edit</th>
                 <th>Hapus</th>
               </tr>
               <?php
               if ($lihatjadwalshift) {
                $shift1=1;
                $shift2=2;
                $shift3=3;
                
                foreach ($lihatjadwalshift as $result){
               ?>
               <tr>
                 <td>Shift 1</td>
                 <td><?php echo  substr($result['JADWAL_SHIFT1_MASUK'],0,8)." ".$result['TIMEZONE'];?></td>
                 <td><?php echo  substr($result ['JADWAL_SHIFT1_PULANG'],0,8)." ".$result['TIMEZONE'];?></td>
                 <td><a title="Edit" role="button" href="#" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalLongEdit<?php echo $shift1;?>"><i class="fa fa-edit"></i></a></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $shift1;?>"><i class="fa fa-trash"></i></a></td>
              <!-- Modal Hapus Shift1-->
              <div class="modal fade" id="ModalLongHapus<?php echo $shift1;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Jadwal Shift Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusJadwalShift" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="jadwalMasuk" value="<?php echo substr($result['JADWAL_SHIFT1_MASUK'],0,8)." ".$result['TIMEZONE'];?>" disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Pulang</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="JadwalPulang" value="<?php  echo substr($result ['JADWAL_SHIFT1_PULANG'],0,8)." ".$result['TIMEZONE'];?> " disabled>
                                  <input class="form-control" type="hidden" name="shift" value = <?php echo $shift1?> >
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
                      <!-- AKhir modal hapus -->
                      <!-- Modal Edit Shift1-->
              <div class="modal fade" id="ModalLongEdit<?php echo $shift1;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Merubah Jadwal Shift Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/editJadwalShift" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="time" name="jadwalMasuk" value="<?php echo substr($result['JADWAL_SHIFT1_MASUK'],0,5);?>" >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Pulang</label>
                                <div class="col-md-8">
                                <input class="form-control" type="time" name="jadwalPulang" value="<?php echo substr($result['JADWAL_SHIFT1_PULANG'],0,5);?>" >
                                  <input class="form-control" type="hidden" name="shift" value = <?php echo $shift1;?> >
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
                      <!-- AKhir Edit modal -->
               </tr>
               <tr>
                 <td>Shift 2</td>
                 <td><?php echo  substr($result ['JADWAL_SHIFT2_MASUK'],0,8)." ".$result['TIMEZONE'];?></td>
                 <td><?php echo  substr($result ['JADWAL_SHIFT2_PULANG'],0,8)." ".$result['TIMEZONE'];?></td>
                 <td><a title="Edit" role="button" href="#" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalLongEdit<?php echo $shift2;?>"><i class="fa fa-edit"></i></a></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $shift2;?>"><i class="fa fa-trash"></i></a></td>
                <!-- Modal Hapus Shift2-->
                <div class="modal fade" id="ModalLongHapus<?php echo $shift2;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Jadwal Shift Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusJadwalShift" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="jadwalMasuk" value="<?php echo substr($result['JADWAL_SHIFT2_MASUK'],0,8)." ".$result['TIMEZONE'];?>" disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Pulang</label>
                                <div class="col-md-8">
                                <input class="form-control" type="hidden" name="shift" value = <?php echo $shift2;?> >
                                  <input class="form-control" type="text" name="jadwalPulang" value="<?php  echo substr($result ['JADWAL_SHIFT2_PULANG'],0,8)." ".$result['TIMEZONE'];?> " disabled>
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
                      <!-- AKhir modal hapus -->
                      <!-- Modal Edit Shift2-->
              <div class="modal fade" id="ModalLongEdit<?php echo $shift2;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Merubah Jadwal Shift Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/EditJadwalShift" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="time" name="jadwalMasuk" value="<?php echo substr($result['JADWAL_SHIFT2_MASUK'],0,5);?>" >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Pulang</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="time" name="jadwalPulang" value="<?php  echo substr($result ['JADWAL_SHIFT2_PULANG'],0,5);?> " >
                                  <input class="form-control" type="hidden" name="shift" value = <?php echo $shift2;?> >
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
                      <!-- AKhir modal Edit -->
               </tr>
               <tr>
                 <td>Shift 3</td>
                 <td><?php echo  substr($result ['JADWAL_SHIFT3_MASUK'],0,8)." ".$result['TIMEZONE'];?></td>
                 <td><?php echo  substr($result['JADWAL_SHIFT3_PULANG'],0,8)." ".$result['TIMEZONE'];?></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalLongEdit<?php echo $shift3;?>"><i class="fa fa-edit"></i></a></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalLongHapus<?php echo $shift3;?>"><i class="fa fa-trash"></i></a></td>
                <!-- Modal Hapus Shift3-->
                <div class="modal fade" id="ModalLongHapus<?php echo $shift3;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Menghapus Jadwal Shift Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/hapusJadwalShift" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="text" name="personalnumber" value="<?php echo substr($result['JADWAL_SHIFT3_MASUK'],0,8)." ".$result['TIMEZONE'];?>" disabled>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Pulang</label>
                                <div class="col-md-8">
                                <input class="form-control" type="hidden" name="shift" value = <?php echo $shift3;?> >
                                  <input class="form-control" type="text" name="namapeg" value="<?php  echo substr($result ['JADWAL_SHIFT3_PULANG'],0,8)." ".$result['TIMEZONE'];?> " disabled>
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
                      <!-- AKhir modal hapus -->
                      <!-- Modal Edit Shift3-->
              <div class="modal fade" id="ModalLongEdit<?php echo $shift3;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Anda Yakin Merubah Jadwal Shift Berikut?</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <form action="<?php echo base_url();?>maintenance_data/EditJadwalShift" method="POST" >

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Masuk</label>
                                <div class="col-md-8">
                                  <input class="form-control" type="time" name="jadwalMasuk" value="<?php echo substr($result['JADWAL_SHIFT3_MASUK'],0,5);?>" >
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-4">Jadwal Pulang</label>
                                <div class="col-md-8">
                                <input class="form-control" type="time" name="jadwalPulang" value="<?php echo substr($result['JADWAL_SHIFT3_PULANG'],0,5);?>" >
                                  <input class="form-control" type="hidden" name="shift" value = <?php echo $shift3;?> >
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
                      <!-- AKhir modal Edt -->
               </tr>
             <?php  }}else{
               ?>
               <tr>
                 <td>Shift 1</td>
                 <td>Tidak ada</td>
                 <td>Tidak ada</td>
                 <td><a><i class="fa fa-edit"></i></a></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=""><i class="fa fa-trash"></i></a></td>
               </tr>
               <tr>
                 <td>Shift 2</td>
                 <td>Tidak ada</td>
                 <td>Tidak ada</td>
                 <td><a><i class="fa fa-edit"></i></a></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=""><i class="fa fa-trash"></i></a></td>
               </tr>
               <tr>
                 <td>Shift 3</td>
                 <td>Tidak ada</td>
                 <td>Tidak ada</td>
                 <td><a><i class="fa fa-edit"></i></a></td>
                 <td><a title="Hapus" role="button" href="#" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=""><i class="fa fa-trash"></i></a></td>
               </tr>
               <?php  } ?>
              </table>

            </div>
        </div>
    </div>
  </div>
</div>
