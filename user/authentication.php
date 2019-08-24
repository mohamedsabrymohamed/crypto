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
                                $secretkey = 'LFKXQULWGZGWQNCNMJFDI3KZGBYFIYKWLTAGISSQWX35WHILNTH6DHHUSYYLQ6U2';
                             //   print sprintf('<img src="%s"/>',TokenAuth6238::getBarCodeUrl('','',$secretkey,'%2FBPT%2520Crypto%3Amohamed.sabry%2540mail.com'));
                               
                            ?>
							<img src="https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2FBPT%2520Crypto%3Amohamed.sabry%2540mail.com%3Fsecret%3DLFKXQULWGZGWQNCNMJFDI3KZGBYFIYKWLTAGISSQWX35WHILNTH6DHHUSYYLQ6U2%26issuer%3DBPT%2520Crypto">
							
							</div>
                        <div class="col-xs-12 col-sm-8">
                            <div class="divider-sm"></div>
                            <p>Please scan this QR code with Google Authenticator enable 2FA Token .</p>
                            <p> You can Download Google Authenticator App from below links:</p>

                            <span class="downlosd-app">
                            <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank"> <img src="<?php echo $images . 'ios.png'?>" alt="Smiley face" height="80" width="80"></a>
                            </span>
                            <span class="downlosd-app">
                            <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"><img src="<?php echo $images . 'android.png'?>" alt="Smiley face" height="80" width="80"></a>
                            </span>

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