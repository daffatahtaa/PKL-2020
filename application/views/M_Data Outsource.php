    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">

          <div class="row page-titles">
              <div class="col-md-5 col-8 align-self-center">
                  <h3 class="text-themecolor m-b-0 m-t-0">Data Outsource</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>home">Maintenance Data</a></li>
                    <li class="breadcrumb-item active">Data Outsource</li>
                  </ol>
              </div>
          </div>
          <div class="card">
            <div style="padding: 20px;">
            <?php if ( validation_errors( )) :?>
                                <div class="alert alert-danger alert-dismissible " role="alert" style="margin-top:20px;" >
                                <button type="button" class="close" data-dismiss="alert">&times;</button>  <?php echo validation_errors();?>
                                </div>
            <?php endif;?>

              <form action="<?php echo base_url();?>maintenance_data/insertPegawaiOutsource" Method="POST">

                <div class="form-group row">
                <label class="col-md-4">Personal Number SIPO</label>
                <div class="col-md-8">
                <select class="form-control js-example-basic-single" name="pernpegawai" id="pernpegawai" >
                          <option value="">Pegawai Outsource</option>
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
                <input class="btn btn-primary reset" type="reset" value="Cancel"/>
                <input class="btn btn-primary" type="submit" value="Simpan"> &ensp;
              </form>
            </div>
          </div>
        </div>

        </div>
        <script>


  $(document).ready(function() {
    $('#pernpegawai').select2({
                  ajax: {
                  url: '<?php echo base_url();?>maintenance_data/lihatPegawaiOutsource',
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




</script>
