    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Ubah Password</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Ubah Password</a></li>
                  </ol>
              </div>
          </div>
          <div class="card">
            <div style="padding: 20px;">

              <br>
                <?php
                if ($this->session->flashdata('errors')){
                    echo '<div class="alert alert-danger">';
                    echo $this->session->flashdata('errors');
                    echo "</div>";
                } else if ($this->session->flashdata('success')){
                  echo '<div class="alert alert-success">';
                  echo $this->session->flashdata('success');
                  echo "</div>";
              }
                ?>

                <div class="form-group row">
                <label class="col-md-4">User ID</label>
                <div class="col-md-8">
                  <input class="form-control" type="text" name="userid" value="<?php echo $this->session->userdata['logged_in']['id'] ?>" disabled>
                </div>
                </div>

                <div class="form-group row">
                <label class="col-md-4">Kode Uker</label>
                <div class="col-md-8">
                  <input  class="form-control" type="text" name="userid" value="<?php echo $this->session->userdata['logged_in']['uker'] ?>" disabled>
                </div>
                </div>

                <div class="form-group row">
                <label class="col-md-4">Role</label>
                <div class="col-md-8">
                  <input class="form-control" type="text" name="userid" value="<?php echo $this->session->userdata['logged_in']['role'] ?>" disabled>
                </div>
                </div>

                <form method="post" action="<?php echo base_url('manage_user/ganti_password/'.$this->session->userdata['logged_in']['id']);?>">
                  <div class="form-group row">
                  <label class="col-md-4">Password Baru</label>
                  <div class="col-md-8">
                    <input  class="form-control" type="password" name="passwd">
                  </div>
                  </div>

                  <div class="form-group row">
                  <label class="col-md-4">Konfirmasi Password Baru</label>
                  <div class="col-md-8">
                    <input  class="form-control" type="password" name="passwdconf">
                  </div>
                  </div>

                <input class="btn btn-primary" type="submit" value="Ubah"> &ensp;
                </form>
              <br>
            </div>

        </div>
      </div>
    </div>
