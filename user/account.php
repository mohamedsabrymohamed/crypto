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
	   if (isset($_GET['sucgen']) && $_GET['sucgen']=='y'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">Your general information has been updated successfully.</p>
	   <?php
	   } 
	   ?>
        <div class="col-sm-9 no-padding">
            <div class="user-page-content">

               <!-- ** Require sidebar **  -->
                <?php require_once 'parts/user-nav.php';?>

               <!-- ** Page Title **  -->
                <div>
                    <h2 class="user-page-content__title">General</h2>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">
					<?php 
					$user_table= new user_table();
					$user_data=$user_table->retrieve_user(get_login_user_id());
					?>
                    <form class="account-form"  action="../process.php" method="post">
					<input type="hidden" name="form_name" value="edit_basic_data" />
					<input type="hidden" name="user_id" value="<?php 
					$Encryption = new Encryption();
					echo $Encryption->encode(get_login_user_id());?>" />
                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-2">
                                <label>Full Name</label>                                 
                             </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" value="<?php echo $user_data['FIRST_NAME'];?>" placeholder="First Name">
                                  </div>
                              </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" value="<?php echo $user_data['LAST_NAME'];?>" placeholder="Last Name">
                                  </div>
                              </div>
                         </div>

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-2">
                                <label>Residence address</label>                                 
                             </div>
                              <div class="col-md-10">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="street" value="<?php echo $user_data['ADDRESS'];?>"   placeholder="street">
                                  </div>
                              </div>
                              <div class="col-md-offset-2 col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="city" value="<?php echo $user_data['CITY'];?>"   placeholder="City">
                                  </div>
                              </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="postalcode" value="<?php echo $user_data['POSTAL_CODE'];?>"   placeholder="postal Code">
                                  </div>
                              </div>
                              <div class="col-md-offset-2 col-md-5">
                                 <div class="form-group">
                                      <select class="form-control input-lg" name="user_country">
										  <?php
										 $country_table=new country_table();
										 $country_data=$country_table->retrieve_all_country();
										 $cont_country=$user_data['COUNTRY'];
										 foreach($country_data as $single_data)
												{
												$selected="";
												$contry_name = $single_data['NAME'];
												$contry_id = $single_data['ID'];
												 if($cont_country == $contry_id)
												{
													$selected = "selected='selected'";
												}
										 ?>
										 <option value="<?php echo $contry_id; ?>" <?php echo $selected; ?>><?php echo $contry_name;?></option>
                                         <?php }?>
                                      </select>
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




