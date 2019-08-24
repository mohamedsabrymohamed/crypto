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

               <!-- ** Page Title **  -->
                <div>
                    <h2 class="user-page-content__title">Browser sessions</h2>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Platform</th>
                                <th>Browser</th>
                                <th>IP</th>
                                <th>Last activity</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
						<?php 
						$log_table=new log_table();
						$log_data=$log_table->retrieve_login_by_user_ID_active(get_login_user_id());
						$Encryption = new Encryption();
						$user_id=$Encryption->encode(get_login_user_id());
						foreach($log_data as $single_log){
						?>
                            <tr>
                                <td><?php echo $single_log['OS'];?></td>
                                <td><?php echo $single_log['BROWSER'];?></td>
                                <td><?php echo $single_log['IP_ADDRESS'];?></td>
                                <td><?php echo $single_log['TIMESTAMP'];?></td>
                                <td><a <?php $cur_session_id=session_id();
								if ($single_log['SESSIONID'] == $cur_session_id){}else{echo 'href="../process.php?session_id='.$cur_session_id.'"';}?> class="<?php $cur_session_id=session_id();
								if ($single_log['SESSIONID'] == $cur_session_id){}else{echo 'logout';}?>"><?php $cur_session_id=session_id();
								if ($single_log['SESSIONID'] == $cur_session_id){echo 'Current Session';}else{echo 'Logout';}?></a></td>
                            </tr>
                           <?php } ?>
                        </tbody>
                    </table>
                    
                    <a href="../process.php?sessuser_id=<?php echo $user_id;?>" class="btn btn-success btn-lg"> Logout all other sessions </a>
                    
                </div> <!-- End user-page-content__desc -->
            </div> <!-- End user-page-content -->
        </div> <!-- End cpntent -->
    </div> <!-- End Row -->
</div> <!-- End Container -->


   <!-- ========================
       ** Require Footer **
   ======================== -->
<?php require_once '../footer.php';?>




