<?php 
	require_once '../auth/auth_required.php';
    require_once '../inc.php';
	$user_table= new user_table();
	$user_data=$user_table->retrieve_user(get_login_user_id());
	$user_type= $user_data['USER_TYPE'];
	if ($user_type !=1){
	header('Location: ../user/');
	}
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
	   if (isset($_GET['deleteu']) && $_GET['deleteu']=='Y'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">User Deleted Successfully.</p>
	   <?php
	   } 
	   ?>
	   
	   <?php 
	   if (isset($_GET['deactiu']) && $_GET['deactiu']=='Y'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">User Deactivated Successfully.</p>
	   <?php
	   } 
	   ?>
	   
	    <?php 
	   if (isset($_GET['actiu']) && $_GET['actiu']=='Y'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">User Activated Successfully.</p>
	   <?php
	   } 
	   ?>
        <div class="col-sm-9 no-padding">
            <div class="user-page-content">


               <!-- ** Page Title **  -->
                <div>
                    <h2 class="user-page-content__title">Users</h2>
                </div>

               <!-- ** Page Table **  -->
                <div class="user-page-content__desc">
                    <div class="table-responsive">
                        <table class="table dataTable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Country</th>
                                    <th>Created Date </th>
                                    <th>Actions </th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							$user_table = new user_table();
							$user_data = $user_table->retrieve_all_users();
							$country_table=new country_table();
							$Encryption = new Encryption();
							foreach($user_data as $single_data){
								
								$uid=$Encryption->encode($single_data['ID']);
							?>
                                <tr>
                                    <td><?php echo $single_data['FULL_NAME'];?></td>
                                    <td><?php echo $single_data['EMAIL'];?></td>
                                    <td><?php echo $single_data['MOBILE'];?></td>
                                    <td><?php 
									$country_data=$country_table->retrieve_country_by_id($single_data['COUNTRY']);
									echo $country_data['NAME'];?></td>
                                    <td><?php echo $single_data['CREATED_DATE'];?></td>
                                    <td>
									<?php 
										if ($single_data['ACTIVATED'] == 0 ){
										?>	
                                        <a href="../process.php?actus=<?php echo $uid;?>" class="btn btn-warning sm-btn show-canel-pop">Activate</a>
										<?php } else{?>
										<a href="../process.php?deactus=<?php echo $uid;?>" class="btn btn-warning sm-btn show-canel-pop">Deactivate</a>
										<?php }?>
									   <a href="../process.php?deluid=<?php echo $uid;?>"" class="btn btn-danger sm-btn"><i class="ion-android-delete"></i></a>
                                    </td>
                                </tr>
							<?php } ?>
                                
                            </tbody>
                        </table>


                    </div>
                </div> <!-- End user-page-content__desc -->
            </div> <!-- End user-page-content -->
        </div> <!-- End cpntent -->
    </div> <!-- End Row -->
</div> <!-- End Container -->


   <!-- ========================
       ** Require Footer **
   ======================== -->
<?php require_once '../footer.php';?>




