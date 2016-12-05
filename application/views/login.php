<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/css/login/login.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">

          <div class="row" id="pwd-container">
            <div class="col-md-4"></div>

            <div class="col-md-4">
              <section class="login-form">
                <form method="post" action="#" role="login">
                  <img src="http://i.imgur.com/RcmcLv4.png" class="img-responsive" alt="" />
                  <input type="email" name="email" placeholder="Email" required class="form-control input-lg" value="joestudent@gmail.com" />

                  <input type="password" class="form-control input-lg" id="password" placeholder="Password" required="" />


                  <div class="pwstrength_viewport_progress"></div>


                  <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
                  <div>
                    <a href="#">Create account</a> or <a href="#">reset password</a>
                  </div>

                </form>
              </section>
              </div>

              <div class="col-md-4"></div>


          </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>