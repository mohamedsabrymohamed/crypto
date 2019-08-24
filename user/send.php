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
                       <h2 class="user-page-content__title">Send Bitcoin</h2>                       
                   </div>
                   <div class="col-sm-6">
                        <h3>
                            <span class="label label-balance">
                                Bitcoin balance:
                                <span style="font-weight: bold; display: none;">0 BTC</span>
                                <span style="font-weight: bold; display: inline;">0 BTC</span>   
                            </span>
                        </h3>
                   </div>
                </div>

               <!-- ** Page Form **  -->
                <div class="user-page-content__desc">

                    <form class="account-form">

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-2">
                                <label>Send to Bitcoin address</label>                                 
                             </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="Send_to_Bitcoin_address"  placeholder="Send to Bitcoin address">
                                  </div>
                              </div>
                         </div>

                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-2">
                                <label>Recipient name</label>                                 
                             </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="recipient_name"  placeholder="Recipient name">
                                  </div>
                              </div>
                         </div>



                        <!-- Inputs Group Row -->
                         <div class="row">
                             <div class="col-md-2">
                                <label>Amount in</label>                                 
                             </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="amount_in"  placeholder="Amount in">
                                  </div>
                              </div>

                              <div class="col-md-3">
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
                             <div class="col-md-2">
                                <label>Note</label>                                 
                             </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="note"  placeholder="Note">
                                  </div>
                              </div>
                         </div>

                        <!-- Input Submit Row -->
                        <div class="row">
                          <div class="col-xs-12 col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success btn-lg pull-left">Confirm</button>
                              <button type="submit" class="btn btn-default btn-lg pull-right">Get Fee</button>
                          </div>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <p>Dynamic fees based on transaction volume on the blockchain are calculated by BitOasis and added to your transactions. Fees can range from 0.0004-0.005 BTC in most cases. You can customize fees here, but confirmation time might be unpredictable.</p>
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




