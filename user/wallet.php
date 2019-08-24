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

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">
                
                    <h3>
                        <span class="label label-balance">
                            Bitcoin balance:
                            <span style="font-weight: bold; display: inline;"><?php 
							$useraddresses_table = new useraddresses_table();
							$user_address_data= $useraddresses_table->retrieve_useraddresses_by_userid_active(get_login_user_id());
							$url='https://blockchain.info/balance?active='.$user_address_data['BLOCK_ADDRESS'];
							$block_address=$user_address_data['BLOCK_ADDRESS'];
							$url_data = json_decode(file_get_contents($url), true);
							$address_balance = $url_data[$block_address]['final_balance'];
							$foo= $address_balance / 100000000 ;
							if ($foo === 0){
								echo $foo;
							}
							else{
								echo number_format((float)$foo, 8, '.', '');
							}
							
							?> BTC</span>   
                        </span>
                    </h3>
                  

                    
               

                </div> <!-- End user-page-content__desc -->
            </div> <!-- End user-page-content -->
        </div> <!-- End cpntent -->
    </div> <!-- End Row -->
</div> <!-- End Container -->


   <!-- ========================
       ** Require Footer **
   ======================== -->
<?php require_once '../footer.php';?>




