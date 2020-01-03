<div class="page-wrapper">
<div class="container-fluid">
  <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
          <h3 class="text-themecolor m-b-0 m-t-0">Edit Data User</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_user/m_pengelolaan_user">Manage User</a></li>
            <li class="breadcrumb-item active">Edit Data User</li>
          </ol>
      </div>
  </div>
  <div class="card">
    <div style="padding: 20px;">

<form method="post" action="<?php echo base_url('user_authentication/update/'.$item->Id);?>">
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


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Uker:</strong>
                <select id="datatest" class="js-example-basic-single !important form-control" name="uker">
                    <option value="<?php echo $item->uker; ?>"><?php echo $item->uker; ?> -
                        <?php echo $item->ket_uker; ?></option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select class="form-control" id="role" name="role">
                    <option value="<?php echo $item->role; ?>" ><?php echo $item->role; ?></option>
                    <option value='Admin'>Admin</option>
                    <option value='Div'>div</option>
                    <option value='sti'>sti</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="<?php echo base_url('');?>"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
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
