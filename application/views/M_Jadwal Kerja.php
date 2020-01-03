    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Jadwal Kerja</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Jadwal Kerja</li>
                  </ol>
              </div>
          </div>
          <div class="card">
            <div style="padding: 20px;">
            <?php if ( validation_errors( )) {?>
                                <div class="alert alert-danger alert-dismissible " role="alert" style="margin-top:20px;" >
                                <button type="button" class="close" data-dismiss="alert">&times;</button>  <?php echo validation_errors();?>
                                </div>
            <?php }else if($this->session->flashdata('editJadwalKerja')){ ?>
                  <br>
                    <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                   Proses Perubahan Jadwal Kerja Berhasil <?php echo $this->session->flashdata('editJadwalKerja');
                   ?>
                   </div>



         <?php   } ?>
                <form action="<?php echo base_url();?>maintenance_data/C_EditJadwalKerja" Method="POST">

                  <div class="form-group row">
                  <label class="col-md-4">Timezone</label>
                  <div class="col-md-8">
                    <select class="form-control" name="timezone">
                    <option value="WIB">WIB</option>
                    <option value="WIT">WIT</option>
                    <option value="WITA">WITA</option>
                    </select>
                  </div>
                  </div>

                  <div class="form-group row">
                  <label class="col-md-4">Jam Masuk Kerja</label>
                  <div class="col-md-8">
                    <input class="form-control" type="time" name="jammasuk" value="0">
                  </div>
                  </div>

                  <div class="form-group row">
                  <label class="col-md-4">Jam Pulang Kerja</label>
                  <div class="col-md-8">
                    <input class="form-control" type="time" name="jampulang" value="0">
                  </div>
                  </div>
                  <input class="btn btn-primary" type="submit" value="Simpan">
                </form>
              </div>
              </div>
              </div>

        </div>
