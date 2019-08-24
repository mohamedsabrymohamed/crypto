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

               <!-- ** Page Title **  -->
                <div class="row">
                   <div class="col-sm-6">
                       <h2 class="user-page-content__title">Your Bitcoin receiving address</h2>                       
                   </div>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">


                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <img class="img-responsive" src="<?php 
							$data = $qr_path . '?d=3KS5eXN26UishnenXkoPLoFjEoodhXjQoV&s=8';
							$imageData = base64_encode(file_get_contents($data));
							$src = 'data:image/png;base64,'.$imageData;
							echo $src ?>" alt="">
                        </div>
                        <div class="col-xs-12 col-sm-5">


                           <!-- =======================================================
                               @Elattar New
                           ======================================================== -->

                                <?php if ( ! isset($_GET['receive-form']) ) { ?>
                                 
                                 
                                  <div class="form-group">                  
                                        <input type="text" id="key_input" class="form-control" value="3KS5eXN26UishnenXkoPLoFjEoodhXjQoV" readonly>
                                  </div>
                                   <div class="form-group">
                                        <button id="copy" class="btn btn-success btn-lg">
                                            <span> Copy address</span>
                                        </button>
                                   </div>
                                    <p>Share this address with others and they can send you Bitcoin.</p>
                                    <a class="btn btn-success btn-lg" href="?receive-form" id="toggle-receive-form">request payment via email.</a>
                                    
                                    
                                <?php } else { ?>

                                   
                                    <form class="account-form">

                                        <!-- Inputs Group Row -->
                                         <div class="row">
                                              <div class="col-xs-12">
                                                  <div class="form-group">
                                                    <input type="text" class="form-control" name="recipientEmail"  placeholder="Recipient email address">
                                                  </div>
                                              </div>
                                         </div>


                                        <!-- Inputs Group Row -->
                                         <div class="row">
                                              <div class="col-xs-6">
                                                  <div class="form-group">
                                                    <input type="text" class="form-control" name="amount_in"  placeholder="Amount in">
                                                  </div>
                                              </div>

                                              <div class="col-xs-6">
                                                 <div class="form-group">
                                                    <select class="form-control input-lg">
                                                        <option value="BTC">BTC</option>
                                                        <option value="USD">USD</option>
                                                        <option value="AED">AED</option>
                                                        <option value="LBP">LBP</option>
                                                        <option value="JOD">JOD</option>
                                                        <option value="SAR">SAR</option>
                                                        <option value="BHD">BHD</option>
                                                        <option value="OMR">OMR</option>
                                                        <option value="QAR">QAR</option>
                                                        <option value="KWD">KWD</option>
                                                    </select>
                                                 </div>
                                              </div>
                                         </div>


                                        <!-- Inputs Group Row -->
                                         <div class="row">
                                              <div class="col-xs-12">
                                                  <div class="form-group">
                                                    <input type="text" class="form-control" name="name"  placeholder="your name">
                                                  </div>
                                              </div>
                                         </div>


                                        <!-- Inputs Group Row -->
                                         <div class="row">
                                              <div class="col-xs-12">
                                                  <div class="form-group">
                                                    <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Optional note for recipient"></textarea>
                                                  </div>
                                              </div>
                                         </div>


                                        <!-- Input Submit Row -->
                                        <div class="row">
                                          <div class="col-xs-12">
                                              <button type="submit" class="btn btn-success btn-lg pull-left">Send Request</button>
                                              <a href="http://localhost/crypto/user/receive.php" class="btn btn-default btn-lg pull-right">Cancel</a>
                                          </div>
                                        </div>

                                    </form>

                               
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