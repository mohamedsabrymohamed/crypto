<?php
    require_once 'inc.php';
    $fixed_nav = true; /* This class will add fixed nav class to header */
    require_once 'header.php';
	
?>
  
    <div class="intro" style="background-image:url('<?php echo $images; ?>intro.jpg');">
        <div class="intro__content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="intro__content__title">YOUR GATEWAY TO THE WORLD OF BLOCKCHAIN</h1>
                        <p class="intro__content__p">BitOasis is the Middle East & North Africa's leading digital asset wallet and exchange</p>
                    </div>
                    <div class="col-sm-5 col-sm-offset-1">
                        <form class="reg-form" action="process.php" method="post" data-parsley-validate>
						<input type="hidden" name="form_name" value="new_user_form" />
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div id="register-form" class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email" required data-parsley-trigger="change" data-parsley-type="email">
                            </div>
                            <div class="form-group">
							 <?php $error_msg = "Password  must be 8 characters at least.<br/>Password must cotain only letters and 1 number<br/>at least."?>
                                <input type="password" class="form-control" id='reg_password' required data-parsley-trigger="change" data-parsley-pattern-message="<?php echo $error_msg; ?>" data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" name="password" placeholder="Password" >
                            </div>
							  <div class="form-group">
                                <input type="password" class="form-control" id='reg_confirm_password' required data-parsley-trigger="change" data-parsley-equalto-message="Password mismatch!" data-parsley-equalto="#reg_password" name="confirmpassword"  placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php';?>