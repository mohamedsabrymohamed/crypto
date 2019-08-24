<?php require_once 'inc.php'; ?>



<!DOCTYPE html>
<html lang="en">

<head>

 
 
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="author">
    <meta content="" name="description">
    
    <!-- Title -->
    <title>Crypto Project</title>
    <!-- Fav Icon -->
    <!--<link href="images/favicon.ico" rel="shortcut icon">-->
    <!--Google fonts Playfair Display + Lato-->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

   
    <!-- ==== Start StyleSheets Links ===================================-->
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css">
    <link rel="stylesheet" href="<?php echo $css; ?>ionicons.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>magnific-popup.css">
    <link rel="stylesheet" href="<?php echo $css; ?>style.css">
    <link rel="stylesheet" href="<?php echo $css; ?>responsive.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo $css; ?>parsley.css">
    <!-- ==== End StyleSheets Links =====================================-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
   

    <body class="<?php  echo isset($page_class) ? $page_class : ' ';?>">

        <!--####################################################################
        ############    01 -  header .     ############
        #################################################################### -->
            <header id="header" class="header <?php echo isset($fixed_nav) ? 'fixed-header' : ' ';?> ">
               <div class="container">
                   <div class="row">
                       <div class="col-sm-2">
                           <div class="logo">
                               <a href="index.php"><img src="<?php echo $images; ?>logo.png" class="imng-responsive" alt="logo" title="logo"></a>
                            </div>
                       </div>
                       <div class="col-sm-10">
                            <nav class="nav">
                                <ul class="main-nav pull-right">

                                    <li>
                                        <span class="main-nav__currancy">1 BTC = <b>
                                            <?php 
                                                $json = file_get_contents('https://blockchain.info/ticker');
                                                $obj = json_decode($json,JSON_PRETTY_PRINT);
                                                echo $obj["USD"]["15m"];
                                            ?>
                                            USD </b>
                                        </span>
                                    </li>
                                    <li>
                                      <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Support
                                          <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a href="#">Submit support ticket</a></li>
                                          <li><a href="#">Frequently asked questions</a></li>
                                          <li><a href="#">Blog</a></li>
                                        </ul>
                                      </div>
                                    </li> 

                                    <?php

                                         if(!is_user_login()) {

                                            echo '<li><a href="login.php" class="btn btn-link light-text">Login</a></li>';    

                                        } else { ?>

										
										 <li>
                                      <div class="btn-group" role="group">
                                        <div class="notifications-btn dropdown-toggle" onclick="setSelectedTestPlan();"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										 
                                          <i class="ion-android-notifications"></i>
                                          <span class="notif-count" >
										  <?php 
										    $user_table = new user_table();
											$user_type=$user_table->retrieve_user(get_login_user_id());
				   
										   $notification_table=new notification_table();
										   if($user_type['USER_TYPE'] == 2){
											$notification_data=$notification_table->retrieve_all_notification_unread_type(2);
											$count_notif=count($notification_data);
											}
											elseif($user_type['USER_TYPE'] == 1){
											$notification_data=$notification_table->retrieve_all_notification_unread_type(1);
											$count_notif=count($notification_data);
											}
											echo $count_notif;
										  ?>
										  </span>
										  
                                        </div>
                                        <ul class="dropdown-menu">
											 <?php foreach($notification_data as $single_notif){	?>
										 <li><a><?php echo $single_notif['NOTIFICATION_TEXT'];?></a></li>
											 <?php } ?>
                                         </ul>
                                      </div>
                                    </li> 
									
                                            <li class="user">
											<?php 
											$user_table= new user_table();
											$user_data=$user_table->retrieve_user(get_login_user_id());
											?>
                                                <img src="<?php echo $images . 'avatar.png'?>" alt="avatar" class="img-circle pull-left">
                                                <div class="user__name pull-right"><?php echo $user_data['FULL_NAME'];?></div>

                                                <ul class="dropdown-menu">
                                                    <li><a href="wallet.php">My Wallet</a></li>
                                                    <li><a href="#">Trading Exchange</a></li>
													<?php 
													if ($user_data['USER_TYPE'] == 2){
														$query          = $_SERVER['PHP_SELF'];
														$path           = pathinfo( $query );
														
													?>
                                                    <li><a href="<?php if ($path['dirname'] == '/crypto'){ echo 'user/account.php';} else{echo 'account.php';}?>">Settings</a></li>
													<?php 
													  }else{
													?>
													<li><a href="holdings.php">Settings</a></li>
													  <?php }?>
                                                    <li><a href="../auth/logout.php">Log out</a></li>
                                                </ul>                                                
                                            </li>
											

                                        <?php }

                                       if(!is_user_login()) {

                                            echo '<li><a href="signup.php" class="btn btn-success">Sign up</a></li>';    

                                        }
                                    ?>
                                   
                                </ul>
                            </nav>
                       </div>
                   </div>
               </div>
            </header>
			
			
			
			
		