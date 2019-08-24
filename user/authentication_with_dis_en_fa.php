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
	   if (isset($_GET['fasent']) && $_GET['fasent']=='Y'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">Please Check your email to Disable 2FA Factor.</p>
	   <?php
	   } 
	   ?>
	   
	     <?php 
	   if (isset($_GET['disable']) && $_GET['disable']=='suc'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">2FA Factor has been disabled.</p>
	   <?php
	   } 
	   ?>
	   
	   
	     <?php 
	   if (isset($_GET['enable']) && $_GET['enable']=='suc'){
	   ?>
	   <p class="text-center" style="color: #5cb85c;font-size: 22px;">2FA Factor has been enabled.</p>
	   <?php
	   } 
	   ?>
        <div class="col-sm-9 no-padding">
            <div class="user-page-content">


               <!-- ** Require sidebar **  -->
                <?php require_once 'parts/user-nav.php';?>


               <!-- ** Page Title **  -->
                <div class="row">
                   <div class="col-sm-6">
                       <h2 class="user-page-content__title">Enable Google Authenticator</h2>                       
                   </div>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">


                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <?php
                                require_once('../inc/2fa/rfc6238.php');
                                $secretkey = 'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQQQ';
                                print sprintf('<img src="%s"/>',TokenAuth6238::getBarCodeUrl('','',$secretkey,'BPT%20Crypto'));
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-5">


                           <!-- =======================================================
                               @Elattar New
                           ======================================================== -->

                                    <p>Enable Google Authenticator 2FA .</p>
									<?php 
									$user_table= new user_table();
									$user_data=$user_table->retrieve_user(get_login_user_id());
									if ($user_data['ENABLE_TWO_WAY_AUTH'] == 1){
									?>
									<a class="btn btn-success btn-lg" href="../process.php?disfa=y&uid=<?php echo base64_encode(get_login_user_id());?>" id="toggle-receive-form"> Disable </a>
									<?php } else{?>
									<a class="btn btn-success btn-lg" href="../process.php?enbfa=y&uid=<?php echo base64_encode(get_login_user_id());?>" id="toggle-receive-form"> Enable </a>
									<?php } ?>
                                    
                                    
               

                               <!-- =======================================================
                                  End  @Elattar New
                               ======================================================== -->


                        </div>
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


    <script>
        document.getElementById("copy").onclick = function() {
            document.getElementById("key_input").select();
            document.execCommand('copy');
        }          
    </script>