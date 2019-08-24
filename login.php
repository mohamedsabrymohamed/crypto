
    <?php require_once 'header.php'; ?>

   
    <div class="page-content page-content-min-height section-padding gray--bg" style="background-image:url('images/intro.jpg');">
        <div class="container">
            <div class="row">

                       
                       
                       
                       
                       <?php if ( isset($_GET['2fa']) && $_GET['2fa'] == 'Y' ) {?>

                            <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                              <div class="form-wrapper authenticat-code">
                             
                                       <h1 class="form-wrapper__title text-center">Please enter your Google Authenticator 2FA Token </h1>
									   <?php 
									   if (isset($_GET['errcd']) && $_GET['errcd'] == 'Y'){
									   ?>
									   <h1 class="form-wrapper__title text-center" style="color:red">Invalid 2FA Token </h1>
									   <?php } ?>
                                        <form class="reg-form" action="process.php" method="post">
                                            <input type="hidden" name="form_name" value="2fa_auth_form" />
											 <input type="hidden" name="uid" value="<?php echo $_GET['uid'];?>" />
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="2fa_code" placeholder=" 2FA Token">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-lg btn-block">Authenticate</button>
                                        </form>
                           
                                </div>
                            </div>
                        <?php } else { ?>
    
                            <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                              <div class="form-wrapper">
                                   <h1 class="form-wrapper__title text-center">Login</h1>
                                  <?php if ( isset($_GET['sucreg']) && $_GET['sucreg'] == 'y') { ?>
                                   <p class="text-center">Thank you for registration. Please Login with your email and password.</p>
                                  <?php } 
                                  else if (isset($_GET['u_no_Actv_error']) && $_GET['u_no_Actv_error'] == 'Y'){
                                  ?>
                                   <p class="text-center" style="color: red;"><?php echo $_SESSION['u_no_Actv_error'];?></p>
                                    <?php } 
                                  else if (isset($_GET['errup']) && $_GET['errup'] == 'Y'){
                                  ?>
                                  <p class="text-center" style="color: red;"><?php echo $_SESSION['wrong_u_p'];?></p>
                                    <?php } 
                                  else if (isset($_GET['u_maximum_number_error']) && $_GET['u_maximum_number_error'] == 'Y'){
                                  ?>
                                  <p class="text-center" style="color: red;"><?php echo $_SESSION['u_maximum_number_error'];?></p>
                                   <?php } 
                                  else if (isset($_GET['u_no_em_verf']) && $_GET['u_no_em_verf'] == 'Y'){
                                  ?>
                                  <p class="text-center" style="color: red;"><?php echo $_SESSION['u_no_em_verf'];?></p>
                                   <?php } 
                                   ?>
                                <form class="reg-form"  action="process.php" method="post">
                                    <input type="hidden" name="form_name" value="user_login_form" />
                                    <div id="register-form" class="form-group">
                                        <input type="email" class="form-control" name='user_name' placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name='password' placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">login</button>
                                </form>

                                <div class="form-text text-left">
                                    <a href="reset-password.php" class="block"> Forgot password?</a>
                                    <span class="block">  Don't have an account? <a href="signup.php"> Sign Up</a></span>
                                </div>
                              </div>
                            </div>


                        <?php } ?>
                       
                       



            </div>
        </div>
    </div>

    <?php require_once 'footer.php';?>