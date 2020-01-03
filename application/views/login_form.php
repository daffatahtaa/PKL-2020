<html>
<?php
    if (isset($this->session->userdata['logged_in'])) {

    header("location: http://localhost/login/user_authentication/user_login_process");
    }
    
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <!--alerts CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url() ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">

</head>
<body>

  <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
          <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
  </div>

<section id="wrapper">

  <div class="login-register" style="background-color:#1e88e5;">
    <div class="login-box card">
      <div class="card-body">

        <?php if($this->session->flashdata('logout')){ ?>
                 <div class="alert alert-success alert-dismissible hide_msg" style="width:100%;" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                Proses logout <?php echo $this->session->flashdata('logout');?>
                </div>
        <?php }?>
            <?php if($this->session->flashdata('errors')){ ?>
                    <div class="alert alert-danger alert-dismissible hide_msg" style="width:100%;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            Error login <?php echo $this->session->flashdata('errors');?>
                    </div>
            <?php }?>

            <div id="main">
                <div id="login">
                  <form class="form-horizontal form-material" action="<?php echo base_url('user_authentication/user_login_process'); ?>" method="post">
                    <h2 class="box-title m-b-40 text-center">Login Portal Absensi BRI</h2>
                    <?php echo form_open('user_authentication/user_login_process'); ?>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input class="form-control" required="" type="text" name="id" id="id" placeholder="Username"/><br />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input class="form-control" required="" type="password" name="passwd" id="passwd" placeholder="Password"/><br/>
                      </div>
                    </div>

                    <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <input required="" class="form-control" type="text" placeholder="Captcha" name="captcha" value=""/>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <a href="javascript:void(0);" class="refreshCaptcha"><i class="fas fa-sync-alt"></i></a>
                        <span id="captImg"><?php echo $captchaImg; ?></span>
                      </div>
                    </div>

                  </div>


                    <div class="form-group text-center m-t-50">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                  </form>

                </div>
            </div>

      </div>
    </div>
  </div>

  </section>

  <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="<?php echo base_url() ?>js/jquery.slimscroll.js"></script>
  <!--Wave Effects -->
  <script src="<?php echo base_url() ?>js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="<?php echo base_url() ?>js/sidebarmenu.js"></script>
  <!--stickey kit -->
  <!-- Sweet-Alert  -->
  <script src="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>

  <script src="<?php echo base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
  <!--Custom JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/custom.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/custom.js"></script>
  <!-- ============================================================== -->
  <!-- Style switcher -->
  <!-- ============================================================== -->
  <script src="<?php echo base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- captcha refresh code -->
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>

<script type="text/javascript">
    $( document ).ready(function(){
       $('.hide_msg').delay(2000).slideUp();
    });
</script>

</body>
</html>
