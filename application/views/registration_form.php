<?php
    if ($this->session->userdata['logged_in']['role'] === 'sti' ):
?>

    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Menambahkan User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_user/m_pengelolaan_user">Manage User</a></li>
                    <li class="breadcrumb-item active">Menambahkan User</li>
                </ol>
            </div>
        </div>
        <div id="login">
          <div class="card">
            <div style="padding:20px;">

          <div class="page-header">
            <h2>Registration Form</h2>
            </div>
                    <form method="POST" action="<?php echo base_url().'user_authentication/new_user_registration' ?>" >
                    <?php
                    if ($this->session->flashdata('errors')){
                        echo '<div class="alert alert-danger">';
                        echo $this->session->flashdata('errors');
                        echo "</div>";
                    }
                    ?>
                        <div class="form-group row">
                            <label for="id" class="col-md-2 col-form-label">Username</label>

                            <div class="col-md-6">
                                <input id="id" placeholder="Username" type="text" class="form-control" name="id" value="" required autocomplete="id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-2 col-form-label">Role</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role">
                                    <option value="" disabled selected>Pilih Jenis Role</option>
                                    <option value='Admin'>Admin</option>
                                    <option value='Div'>div</option>
                                    <option value='sti'>sti</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="uker" class="col-md-2 col-form-label">Unit Kerja</label>

                            <div class="col-md-6">
                                <select id="datatest" placeholder="Unit Kerja" class="js-example-basic-single form-control !important" name="uker">
                                    <option value="0" disabled selected>Pilih Unit Kerja</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passwd" class="col-md-2 col-form-label ">Password</label>

                            <div class="col-md-6">
                                <input id="passwd" placeholder="Password" type="password" class="form-control !important" name="passwd" required autocomplete="new-passwd">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Buat Akun
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
      </div>
  </div>
</div>
</div>
<script>

    jQuery(document).ready(function($) {
        $('.js-example-basic-single').select2({
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

</script>
<?php endif; ?>
