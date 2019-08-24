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


               <!-- ** Page Title **  -->
                <div>
                    <h2 class="user-page-content__title">Approved Requests</h2>
                </div>

               <!-- ** Page Table **  -->
                <div class="user-page-content__desc">
                    <div class="table-responsive">

                        <div id="canel-pop" class="popup">
                            <i class="ion-android-close close-pop"></i>
                            <div class="popup__content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                           <h2 class="light-text">Cancelation Reason</h2>
                                            <form class="account-form">
                                              <!-- Input hidden with the bill ID value -->
                                               <input type="hidden" id="bill-input-cancel-id" value="444">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Cancelation Reason"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-lg btn-block ">Submit</button>
                                            </form>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table dataTable">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Full Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Bill Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bill-id" data-id="1">#1</td>
                                    <td>Ahmed Elattar</td>
                                    <td><span>$</span> 458</td>
                                    <td>Jan 15, 2018 14:39</td>
                                    <td>
                                        <a class="popup-link" href="https://as.ftcdn.net/r/v1/pics/ea2e0032c156b2d3b52fa9a05fe30dedcb0c47e3/landing/images_photos.jpg">
                                            <img src="https://as.ftcdn.net/r/v1/pics/ea2e0032c156b2d3b52fa9a05fe30dedcb0c47e3/landing/images_photos.jpg" alt="" width="40" height="40">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bill-id" data-id="1">#1</td>
                                    <td>Ahmed Elattar</td>
                                    <td><span>$</span> 458</td>
                                    <td>Jan 15, 2018 14:39</td>
                                    <td>
                                        <a class="popup-link" href="https://as.ftcdn.net/r/v1/pics/ea2e0032c156b2d3b52fa9a05fe30dedcb0c47e3/landing/images_photos.jpg">
                                            <img src="https://as.ftcdn.net/r/v1/pics/ea2e0032c156b2d3b52fa9a05fe30dedcb0c47e3/landing/images_photos.jpg" alt="" width="40" height="40">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bill-id" data-id="1">#1</td>
                                    <td>Ahmed Elattar</td>
                                    <td><span>$</span> 458</td>
                                    <td>Jan 15, 2018 14:39</td>
                                    <td>
                                        <a class="popup-link" href="https://as.ftcdn.net/r/v1/pics/ea2e0032c156b2d3b52fa9a05fe30dedcb0c47e3/landing/images_photos.jpg">
                                            <img src="https://as.ftcdn.net/r/v1/pics/ea2e0032c156b2d3b52fa9a05fe30dedcb0c47e3/landing/images_photos.jpg" alt="" width="40" height="40">
                                        </a>
                                    </td>
                                </tr>
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




