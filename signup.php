    <?php require_once 'header.php'; ?>

  
    <div class="page-content page-content-min-height section-padding gray--bg">
        <div class="container">
            <div class="row">
  
                <?php if ( isset($_GET['entmo']) && ! empty($_GET['entmo']) ) { ?>

                    <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                      <div class="form-wrapper">
                           <h1 class="form-wrapper__title text-center">Phone Number</h1>
                           <p class="text-center"> Please save your phone number with us. We will text you a verification code every time you login. </p>
                            <form class="reg-form" action="process.php" method="post">
								<input type="hidden" name="form_name" value="user_phone" />
								<input type="hidden" name="user_id" value="<?php echo $_GET['entmo'];?>" />
								
                                 <div class="form-group">
                                      <select class="form-control input-lg" name='country_id'>
									  <?php
									  $country_table=new country_table();
									  $country_data=$country_table->retrieve_all_country();
									  foreach ($country_data as $single_country){
									  ?>
                                          <option value="<?php echo $single_country['PHONECODE'];?>">+<?php echo $single_country['PHONECODE'].' '.$single_country['NAME'];?></option>
                                          <?php 
									  }
										  ?>
                                      </select>
                                 </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name='phone_number' placeholder="Phone number">
                                </div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                            </form>
                      </div>
                    </div>

                <?php } elseif ( isset($_GET['verfmob']) && $_GET['verfmob'] == 'yes') { ?>

                    <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                      <div class="form-wrapper">
                           <h1 class="form-wrapper__title text-center">Verify Phone Number</h1>
                           <p> We sent s text message with confirmation code to <b> <?php echo '+'.$_GET['umob'];?> </b> </p>
                            <form class="reg-form" action="process.php" method="post">
							<input type="hidden" name="form_name" value="user_phone_verf" />
							<input type="hidden" name="user_id" value="<?php echo $_GET['uid'];?>" />
                                <div class="form-group">
                                    <input type="text" class="form-control" name="conf_code" placeholder="Confirmation Code">
                                </div>
                              <div class="checkbox">
                                  <input type="checkbox" required> I agree to BitOasis <a href="#">Terms of use</a> and <a href="#">Privacy policy </a>
                              </div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                            </form>
                            <div class="form-text text-center">
                                <a href="signup.php?entmo=<?php echo $_GET['uid'];?>">Enter diffrent number</a>
                            </div>
                      </div>
                    </div>
					
					
					
			<?php } elseif ( isset($_GET['verfem']) && $_GET['verfem'] == 'yes') { ?>

                    <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                      <div class="form-wrapper">
                           <p>Thank you for registration. Please check your email for for verification link .</p>
                            
                      </div>
                    </div>

                <?php } else {?>

                    <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                      <div class="form-wrapper">
                           <h1 class="form-wrapper__title text-center">Sign Up</h1>
                            
                       <form class="reg-form" action="process.php" method="post" data-parsley-validate>
						<input type="hidden" name="form_name" value="new_user_form" />
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div id="register-form" class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email" required data-parsley-trigger="change" data-parsley-type="email">
                            </div>
                            <div class="form-group">
							 <?php $error_msg = "Password  must be 8 characters at least.<br/>Password must cotain only letters and 1 number<br/>at least."?>
                                <input type="password" class="form-control" id='reg_password' required data-parsley-trigger="change" data-parsley-pattern-message="<?php echo $error_msg; ?>" data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" name="password" placeholder="Password" >
                            </div>
							  <div class="form-group">
                                <input type="password" class="form-control" id='reg_confirm_password' required data-parsley-trigger="change" data-parsley-equalto-message="Password mismatch!" data-parsley-equalto="#reg_password" name="confirmpassword"  placeholder="Confirm Password">
                            </div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Sign Up</button>
                            </form>
                            <div class="form-text text-center">
                                Have an account? <a href="login.php"> Log In</a>
                            </div>
                      </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
   
   

    <?php require_once 'footer.php';?>
