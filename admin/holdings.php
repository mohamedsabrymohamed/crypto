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
        <div class="col-sm-9 no-padding">
            <div class="user-page-content">

               <!-- ** Require sidebar **  -->
                <?php require_once 'parts/user-nav.php';?>


           <!-- =======================================================
               @Elattar New
           ======================================================== -->

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">
                    <p>You can see a complete list of Bitcoin addresses assigned to your account. Please don't share the list with anyone, to protect your privacy.</p>
                    <p>To obtain address for receiving Bitcoin, please use <a href="#">receive bitcoin</a> page, where we always create a new receiving address for you, keeping your privacy in mind.</p>
                    <div class="divider"></div>                  
                    <button class="btn btn-success btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                       Show zero balance addresses
                    </button>
                    <div class="collapse" id="collapseExample">   
                        <div class="balance_addresses">
						<?php 
						$useraddresses_table=new useraddresses_table();
						$user_data=$useraddresses_table->retrieve_useraddresses_by_userid(get_login_user_id());
						foreach($user_data as $single_address){
						?>
                            <div><a href="http://blockchain.info/address/<?php echo $single_address['BLOCK_ADDRESS'];?>" target="_blank"><?php echo $single_address['BLOCK_ADDRESS'];?></a></div>
						<?php } ?>
						</div>
                    </div>
                </div> <!-- End user-page-content__desc -->

           <!-- =======================================================
               @Elattar New
           ======================================================== -->


            </div> <!-- End user-page-content -->
        </div> <!-- End cpntent -->
    </div> <!-- End Row -->
</div> <!-- End Container -->


   <!-- ========================
       ** Require Footer **
   ======================== -->
<?php require_once '../footer.php';?>




