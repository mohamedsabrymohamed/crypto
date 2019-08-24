<?php 
	require_once '../auth/auth_required.php';
    require_once '../inc.php';
    $page_class = 'user-page'; /* This class will be added to body element */
    require_once '../header.php';
?>

<div class="container">
    <div class="row">

       <!-- ========================
           ** sidebar **
       ======================== -->

        <div class="col-sm-3 no-padding">
            <?php require_once 'parts/user-sidebar.php';?>            
        </div>

       <!-- ========================
           ** Content **
       ======================== -->

        <div class="col-sm-9 no-padding">
            <div class="user-page-content">

               <!-- ** Require sidebar **  -->
                <?php require_once 'parts/user-nav.php';?>

               <!-- ** Page Title **  -->
			   <?php 
						   if(isset($_GET['send_code']) && $_GET['send_code'] == 'Y'){
						?>
                       <p class="text-center password_code">Code Sent To your MOBILE</p>
						   <?php }?>
						   
						      <?php 
						   if(isset($_GET['done_pass']) && $_GET['done_pass'] == 'y'){
						?>
                       <p class="text-center password_code">Password Changed Successfully</p>
						   <?php }?>
						   
						  <?php 
						   if(isset($_GET['error_sm_code']) && $_GET['error_sm_code'] == 'y'){
						?>
                       <p class="text-center password_code">Wrong SMS Code</p>
						   <?php }?>
						   
						     <?php 
						   if(isset($_GET['wrong_or_pass']) && $_GET['wrong_or_pass'] == 'y'){
						?>
                       <p class="text-center password_code">Wrong Original Password</p>
						   <?php }?>
                <div>
                    <h2 class="user-page-content__title">Passwords</h2>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">

                   <?php if ( ! isset($_GET['reset-password']) ) { ?>
                       
                        <p>To change your password, please click on the button below. Security code will be send to your phone number +20 ******* 123</p>
                        <a href="?reset-password" class="btn btn-success btn-lg"> Request password change </a>
                        
                    <?php } else {
							
								
					?>
						
						<form class="account-form" action="../process.php" method="post">
							<input type="hidden" name="form_name" value="request_reset_password" />
							<input type="hidden" name="sid" value="<?php echo $_GET['smid'];?>" />
                            <!-- Inputs Group Row -->
                             <div class="row">
                                 <div class="col-md-5">
                                    <label>SMS code</label>                                 
                                 </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="sms_ode"  placeholder="SMS code"> 
										<a href="../pass_reset_request.php?sid=<?php 
										$Encryption = new Encryption();
										echo  $Encryption->encode(get_login_user_id());?>" class="sms-code-btn">Send Code</a>
                                      </div>
                                  </div>
                             </div>
	
                            <!-- Inputs Group Row -->
                             <div class="row">
                                 <div class="col-md-5">
                                    <label>Original password</label>                                 
                                 </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="original_password"  placeholder="Original password">
                                      </div>
                                  </div>
                             </div>

                            <!-- Inputs Group Row -->
                             <div class="row">
                                 <div class="col-md-5">
                                    <label>New password</label>                                 
                                 </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                        <input type="password" class="form-control" name="new_password"  placeholder="New password">
                                      </div>
                                  </div>
                             </div>

                            <!-- Inputs Group Row -->
                             <div class="row">
                                 <div class="col-md-5">
                                    <label>Repeat new password</label>                                 
                                 </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                        <input type="password" class="form-control" name="repeat_new_password"  placeholder="Repeat new password">
                                      </div>
                                  </div>
                             </div>
                             

                            <!-- Input Submit Row -->
                            <div class="row">
                              <div class="col-xs-10">
                                  <button type="submit" class="btn btn-success btn-lg pull-right">Update</button>
                              </div>
                            </div>

                        </form>                        
                        
                    <?php } ?>
                    
                    
                </div> <!-- End user-page-content__desc -->
            </div> <!-- End user-page-content -->
        </div> <!-- End cpntent -->
    </div> <!-- End Row -->
</div> <!-- End Container -->


   <!-- ========================
       ** Require Footer **
   ======================== -->
<?php require_once '../footer.php';?>




