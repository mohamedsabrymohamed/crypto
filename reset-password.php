
    <?php require_once 'header.php'; ?>

   
   
   
        <div class="page-content page-content-min-height section-padding gray--bg">
            <div class="container">
                <div class="row">

               <?php

                if ( isset($_GET['token']) && ! empty($_GET['token']) ) { ?>

                        <div class="col-xs-12">
                          <div class="form-wrapper">
                            <p>
                                We have emailed the instructions on how to reset your password to <b> mohamed.sabry@mail.com </b>. Please follow the instructions in the email to complete the process.

                                The email may not be sent if given email address is not registered
                            </p>
                          </div>
                        </div>
                    
                <?php } elseif ( isset($_GET['forget_password']) && ! empty($_GET['forget_password']) )  { ?>
                       
                        <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                          <div class="form-wrapper">
                               <h1 class="form-wrapper__title text-center">New Password</h1>
                                <form class="reg-form">
                                    <div id="register-form" class="form-group">
                                        <input type="password" class="form-control" name="reset-emeail" id="exampleInputEmail1" placeholder="Password">
                                    </div>
                                    <div id="register-form" class="form-group">
                                        <input type="password" class="form-control" name="reset-emeail" id="exampleInputEmail1" placeholder="Retype Password">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">login</button>
                                </form>
                          </div>
                        </div>
                    
                    
                <?php } else { ?>

                        <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4">
                          <div class="form-wrapper">
                               <h1 class="form-wrapper__title text-center">Forgotten Password</h1>
                                <form class="reg-form">
                                    <div id="register-form" class="form-group">
                                        <input type="email" class="form-control" name="reset-emeail" id="exampleInputEmail1" placeholder="Email">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">login</button>
                                </form>
                          </div>
                        </div>

                <?php } ?>
 
                </div>
            </div>
        </div>

    <?php require_once 'footer.php';?>