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
	   <?php 
	   if (isset($_GET['sucbnk']) && $_GET['sucbnk']=='y'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">Your bank information has been updated successfully.</p>
	   <?php
	   } 
	   ?>
        <div class="col-sm-9 no-padding">
            <div class="user-page-content">

               <!-- ** Require sidebar **  -->
                <?php require_once 'parts/user-nav.php';?>

               <!-- ** Page Title **  -->
                <div>
                    <h2 class="user-page-content__title">Bank</h2>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">
					<?php 
					$userbank_table= new userbank_table();
					$userbank_data=$userbank_table->retrieve_userbank_by_userid(get_login_user_id());
					?>
                   <form class="account-form"  action="../process.php" method="post">
					<input type="hidden" name="form_name" value="edit_bank_data" />
					<input type="hidden" name="user_id" value="<?php 
					$Encryption = new Encryption();
					echo $Encryption->encode(get_login_user_id());?>" />

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-7">
                                <label>Bank name</label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="bank_name" value="<?php echo  $userbank_data['BANK_NAME'];?>" placeholder="Bank name">
                                  </div>
                              </div>
                         </div>

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-7">
                                <label>IBAN</label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="iban" value="<?php echo  $userbank_data['IBN'];?>"  placeholder="IBAN">
                                  </div>
                              </div>
                         </div>

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-7">
                                <label>Bank account</label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="bank_account" value="<?php echo  $userbank_data['BANK_ACCOUNT'];?>"  placeholder="Bank account">
                                  </div>
                              </div>
                         </div>

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-7">
                                <label>Branch name (optional for UAE)</label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="branch_name" value="<?php echo  $userbank_data['BRANCH_NAME'];?>"   placeholder="Branch name">
                                  </div>
                              </div>
                         </div>


                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-7">
                                <label>Bank address (optional for UAE)</label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                   <textarea class="form-control" name="bank_address" cols="30" rows="3"  placeholder="Bank address"> <?php echo  $userbank_data['BANK_ADDRESS'];?></textarea>
                                  </div>
                              </div>
                         </div>

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-7">
                                <label>Your personal bank account holder <b>Legal name</b></label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="personal_bank_account" value="<?php echo  $userbank_data['BANK_LEGAL_NAME'];?>"    placeholder="Your personal bank account holder Legal name">
                                  </div>
                              </div>
                         </div>

                        <!-- Input Submit Row -->
                        <div class="row">
                          <div class="col-xs-12">
                              <button type="submit" class="btn btn-success btn-lg pull-right">Save</button>
                          </div>
                        </div>

                    </form>
                </div> <!-- End user-page-content__desc -->
            </div> <!-- End user-page-content -->
        </div> <!-- End cpntent -->
    </div> <!-- End Row -->
</div> <!-- End Container -->


   <!-- ========================
       ** Require Footer **
   ======================== -->
<?php require_once '../footer.php';?>




