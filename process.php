<?php
require_once('inc.php');


	$notification = array();
	$notification['error'] = array();
	$notification['success'] = array();
	if($_POST)
	{
		$form_name = $_POST['form_name'];
		if($form_name and !empty($form_name))
		{
			switch($form_name)
			{
				
			
				case 'user_login_form':
                {
							 
				$form_type = $_POST['form_type'];
				$user_email = $_POST['user_name'];
				$user_password = $_POST['password'];
				$user_table = new user_table();
				$user_id = $user_table->verify_user($user_email, $user_password);
				$user_type=$user_table->retrieve_user($user_id);
				$login_table = new log_table();
          		$get_login_data=$login_table->retrieve_login_by_user($user_id);
				$wrong_table=new wronglog_table();
				$wrong_table_data=$wrong_table->retrieve_wronglogin_by_user($user_id);
				$wrong_attemp_count=count($wrong_table_data);
          		$count_login=count($get_login_data);
					if($count_login > 10 ){
							 $reason="maximum number of pcs";
							  $wrong_table->create_wronglogin_log($reason);
							  $notification['error'][] = "You have logged in from 10diffrent locations. Please Logout from one to be able to login";
							  $_SESSION['u_maximum_number_error']= "You have logged in from 10 diffrent locations. Please Logout from one to be able to login";
							  $redirect_path = 'login.php';
							 ?><script type="text/javascript">window.location = '<?php echo $redirect_path."?u_maximum_number_error=Y"; ?>'; </script><?php
								}
						
					elseif (empty($user_id)){
							$reason="wrong username or password";
							$wrong_table->create_wronglogin_log($reason);
							$notification['error'][] = "Please check username or password.";
							$_SESSION['wrong_u_p']= "Please check username or password.";
							$notification_string = create_notification_string($notification);
							$redirect_path = 'login.php';
							 ?><script type="text/javascript">window.location = '<?php echo $redirect_path."?errup=Y"; ?>'; </script><?php

								}
					elseif ($user_type['ACTIVATED'] != 1){
							$reason="deactivated";
							$wrong_table->create_wronglogin_log($reason);
							
							$notification['error'][] = "Please contact website admin To active your account.";
							$_SESSION['u_no_Actv_error']= "Please contact website admin To active your account.";
							$redirect_path = 'login.php';
							 ?><script type="text/javascript">window.location = '<?php echo $redirect_path."?u_no_Actv_error=Y"; ?>'; </script><?php
								}
						
					elseif ($user_type['EMAIL_VERF'] != 1){
							$reason="email not verified";
							$wrong_table->create_wronglogin_log($reason);
							
							$notification['error'][] = "Please go to your email to verify your account.";
							$_SESSION['u_no_em_verf']= "Please go to your email to verify your account.";
							$redirect_path = 'login.php';
							 ?><script type="text/javascript">window.location = '<?php echo $redirect_path."?u_no_em_verf=Y"; ?>'; </script><?php
								}
					elseif($user_type['SMS_VERF'] != 1){
							$reason="SMS not verified";
							$wrong_table->create_wronglogin_log($reason);
							
							$redirect_path = 'signup.php';
							$Encryption = new Encryption();
							$encoded_id=$Encryption->encode($user_type['ID']);
							$phone=$user_type['MOBILE'];
							?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?verfmob=yes&umob='.$phone.'&uid='.$encoded_id; ?>'; </script><?php
							
							
						}
                  
				
					elseif($user_id and !empty($user_id))
						{
							
						
						
							$return = $ajaxresutreturn;
							$user_type2=$user_table->retrieve_user($user_id);
							$login_table = new log_table();
							if($user_type2['USER_TYPE'] == 2){
								
								$log_table = new log_table();
								$login_data= $log_table->retrieve_login_by_user_ID($user_id);
							
								if (count($login_data)== 0){
									unset( $_SESSION['language']);	
									$_SESSION['user_id'] = $user_id;
									$_SESSION['timeout'] = time();

									$param_table = new param_table();
									$param_data = $param_table->retrieve_params();
									$_SESSION['web_session_timeout'] = $param_data['SESSION_TIMEOUT'];

									$log_table = new log_table();
									$log_table->create_login_log();
									if(is_user_verified())
										{
										$redirect_path = 'user/authentication.php';
										?><script type="text/javascript">window.location = '<?php echo $redirect_path;?>'; </script><?php
										}
								}
								else{
									
									if ($user_type2['ENABLE_TWO_WAY_AUTH']  == 1){
									if(is_user_verified())
										{
											$Encryption = new Encryption();
											$id_encoded= $Encryption->encode($user_id);
									$redirect_path = 'login.php?2fa=Y&uid='.$id_encoded;
									?><script type="text/javascript">window.location = '<?php echo $redirect_path;?>'; </script><?php
								}
								}
								else{
									
									unset( $_SESSION['language']);	
									$_SESSION['user_id'] = $user_id;
									$_SESSION['timeout'] = time();

									$param_table = new param_table();
									$param_data = $param_table->retrieve_params();
									$_SESSION['web_session_timeout'] = $param_data['SESSION_TIMEOUT'];

									$log_table = new log_table();
									$log_table->create_login_log();
									if(is_user_verified())
										{
										$redirect_path = 'user/wallet.php';
										?><script type="text/javascript">window.location = '<?php echo $redirect_path;?>'; </script><?php
										}
									
								}
									
								}
								
								
							}
							elseif ($user_type2['USER_TYPE'] == 1) {
								
								unset( $_SESSION['language']);	
									$_SESSION['user_id'] = $user_id;
									$_SESSION['timeout'] = time();

									$param_table = new param_table();
									$param_data = $param_table->retrieve_params();
									$_SESSION['web_session_timeout'] = $param_data['SESSION_TIMEOUT'];

									$log_table = new log_table();
									$log_table->create_login_log();
									if(is_user_verified())
										{
										$redirect_path = 'admin/';
										?><script type="text/javascript">window.location = '<?php echo $redirect_path;?>'; </script><?php
										}
							}
							
							
						
						}

                   
                    break;
                }
				
				
				case '2fa_auth_form' :
				{
						$Encryption = new Encryption();
						$user_id = $Encryption->decode($_POST['uid']);
						$fa_code = $_POST['2fa_code'];
						require_once('inc/2fa/rfc6238.php');
						$secretkey = 'LFKXQULWGZGWQNCNMJFDI3KZGBYFIYKWLTAGISSQWX35WHILNTH6DHHUSYYLQ6U2';
						if (TokenAuth6238::verify($secretkey,$fa_code)) {
									unset( $_SESSION['language']);	
									$_SESSION['user_id'] = $user_id;
									$_SESSION['timeout'] = time();

									$param_table = new param_table();
									$param_data = $param_table->retrieve_params();
									$_SESSION['web_session_timeout'] = $param_data['SESSION_TIMEOUT'];

									$log_table = new log_table();
									$log_table->create_login_log();
									
									$redirect_path = 'user/wallet.php';
							?><script type="text/javascript">window.location = '<?php echo $redirect_path;?>'; </script><?php
						} else {
							$redirect_path = 'login.php?2fa=Y&errcd=Y';
							?><script type="text/javascript">window.location = '<?php echo $redirect_path;?>'; </script><?php
						}
				
					break;
				}
				
				
				
				case 'new_user_form':
				{
						$errors = array();
						$user_data = array();
						$user_data['ID'] = null;
						$user_data['FIRST_NAME'] = $_POST['first_name'];
						$user_data['LAST_NAME'] = $_POST['last_name'];
						$user_data['EMAIL'] = $_POST['email'];
						$user_data['ENABLE_TWO_WAY_AUTH'] = 1;
						$user_data['USER_TYPE'] = 2;
						$user_data['PASSWORD'] = $_POST['password'];
						$user_data['confirm_password'] = $_POST['confirmpassword'];
						$user_data['CREATED_DATE'] = date("Y-m-d H:i:s");
					
					if(count($notification['error']) == 0)
					{
						$user_table=new user_table();
						$user_id = $user_table->add_new_user($user_data);
						
						$trans_info =array();
						$trans_info['ACT_NUMBER']=rand(00000000,99999999);
						$trans_info['USER_ID']=get_login_user_id();
						$trans_info['ACTION']='New user registration :'.$user_id;
						$trans_info['LAST_VALUE']=$_POST['first_name'].' '.$_POST['last_name'];
						$trace_table=new trace_table();
						$trace_data= $trace_table->add_new_trace($trans_info);
						}

					$errors = $notification['error'];
					if($errors and count($errors)>0)
					{
						$notification_string = create_notification_string($notification);
					
						?><script type="text/javascript">window.location = '<?php echo 'index.php'; ?>'; </script><?php

					}
					else
						{
							
								$user_table = new user_table();
								$hash = $user_table->generate_confirmation_hash($user_id);
								if($hash != false)
								{
									
								$user_email = $_POST['email'];
								$subject='Account Confirmation';
								$param_table = new param_table();
								$param_data = $param_table->retrieve_params();
								$BASE_WEBSITE = $param_data['BASE_URL'];
								$message_body = 'Dear Customer,<br/><br/>'.$_POST['first_name'].' '.$_POST['last_name'];
								$message_body .= 'Thank you for your registration. Please click on this link to activate your account<br/><br/>';
								$password_url = $BASE_WEBSITE.'process.php?confirmation='.$hash;
								$message_body .= '<a href="'.$password_url.'">Confirmation Link</a><br/><br/>';
								
								
								
								$from = 'info@bprotrader.com';
								require_once 'inc/class.phpmailer/PHPMailerAutoload.php';
								$phpmailer = new PHPMailer();
								$phpmailer->CharSet = 'UTF-8';
								$phpmailer->addAddress($user_email);
								$phpmailer->setFrom($from);
								$phpmailer->addReplyTo($from);
								$phpmailer->Subject = $subject;
								$phpmailer->isHTML(true);
								$phpmailer->Body = $message_body;
								$phpmailer->Send();
									
								}
							
							$notification_table=new notification_table();
							$add_notif_data=array();
							$add_notif_data['USER_ID'] = $user_id;
							$add_notif_data['NOTIFICATION_TYPE'] = 1;
							$add_notif_data['NOTIFICATION_TEXT']='Add New User From Registration:'.$_POST['first_name'].' ' .$_POST['last_name'];
							$add_notif_data['CREATED_BY']=$user_id;
							$add_notif_data['CREATED_DATE'] = date("Y-m-d H:i:s");
							$add_notification=$notification_table->add_new_notification($add_notif_data);
							
							$redirect_path = 'signup.php';
							?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?verfem=yes'; ?>'; </script><?php

						}

					break;
				}
				
				
				case 'user_phone' : 
				{
						$Encryption = new Encryption();
						$user_id=$Encryption->decode($_POST['user_id']);
						$user_where = '`ID`='.$user_id;
						$user_data=array();
						$user_data['MOBILE'] = '+'.$_POST['country_id'].$_POST['phone_number'];
						$user_table = new user_table();
                        $return = $user_table->update_user($user_data, $user_where);
						if ($return){
							$sms_data=array();
							$sms_data['USER_ID']= $user_id;
							$phone= '+'.$_POST['country_id'].$_POST['phone_number'];
							$sms_data['VERIF_CODE']=rand(00000000,99999999);
							$sms_data['VERIF_TYPE'] = 'Account Verification';
							$sms_data['VERIF_DATE']= date("Y-m-d H:i:s");
							$smsverf_table=new smsverf_table();
							$return=$smsverf_table->add_new_smsverf($sms_data);
							
							//send sms
								require_once 'send_sms.php';
								send_sms($phone , $sms_data['VERIF_CODE']);
							
							
								$redirect_path = 'signup.php';
								$Encryption = new Encryption();
								$encoded_id = $Encryption->encode($user_id);
								?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?verfmob=yes&umob='.$phone.'&uid='.$encoded_id; ?>'; </script><?php
							
							
							
						}
					break;
				}
				
				
				
				case 'user_phone_verf' : 
				{
					
						$conf_code=$_POST['conf_code'];
						$Encryption = new Encryption();
						$user_id=$Encryption->decode($_POST['user_id']);
						$smsverf_table=new smsverf_table();
						$data_sms=$smsverf_table->retrieve_smsverf_by_verf_code($conf_code,$user_id);
						
						if ($data_sms['STATUS']==0){
								
								$user_where = '`ID`='.$user_id;
								$user_data=array();
								$user_data['SMS_VERF'] = 1;
								$user_data['ACTIVATED'] = 1;
								$user_table = new user_table();
								$return = $user_table->update_user($user_data, $user_where);
								if ($return){
								
									$sms_where = '`ID`='.$data_sms['ID'];
									$sms_data=array();
									$sms_data['STATUS'] = 1;
									$smsverf_table=new smsverf_table();
									$return=$smsverf_table->update_smsverf($sms_data,$sms_where);
									
									$usercurrentbalance_data=array();
									$usercurrentbalance_data['ID']=NULL;
									$usercurrentbalance_data['USER_ID']=$user_id;
									$usercurrentbalance_data['CURRENT_BALANCE']=0;
									$usercurrentbalance_data['LAST_MODIFIED']=date("Y-m-d H:i:s");
									$usercurrentbalance_table=new usercurrentbalance_table();
									$add_data=$usercurrentbalance_table->add_new_usercurrentbalance($usercurrentbalance_data);
									
									//new address
									$param_table = new param_table();
									$param_data = $param_table->retrieve_params();
									$BASE_WEBSITE = $param_data['BASE_URL'];
									$call_back_url = $BASE_WEBSITE;
									$xpub = $param_data['BTC_XPUB'];
									$key = $param_data['BTC_API_KEY'];
									$call_back_url = urlencode('http://bprotrader.com/crypto/test.php');
									$url='https://api.blockchain.info/v2/receive?xpub='.$xpub.'&key='.$key.'&callback='.$call_back_url.' ';
									$url_data = json_decode(file_get_contents($url), true);
									$newaddress = $url_data["address"];
									
									$useraddresses_table = new useraddresses_table();
									$user_address_data = array();
									$user_address_data['USER_ID'] = $user_id;
									$user_address_data['BLOCK_ADDRESS'] = $newaddress;
									$user_address_data['CREATED_DATE'] = date("Y-m-d H:i:s");
									$user_address_data['BASE_ADDRESS'] = 1;
									$add_new_address = $useraddresses_table->add_new_useraddresses($user_address_data);

									$redirect_path = 'login.php';
									?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?sucreg=y'?>'; </script><?php
									
								}
							
							
						}
						
					break;
				}
				
				
				
				
				
				case 'edit_basic_data' : 
				{
					
						$Encryption = new Encryption();
						$user_id=$Encryption->decode($_POST['user_id']);
						$user_where = '`ID`='.$user_id;
						$user_data=array();
						$user_data['FIRST_NAME'] = $_POST['first_name'];
						$user_data['LAST_NAME'] = $_POST['last_name'];
						$user_data['ADDRESS'] = $_POST['street'];
						$user_data['COUNTRY'] = $_POST['user_country'];
						$user_data['CITY'] = $_POST['city'];
						$user_data['POSTAL_CODE'] = $_POST['postalcode'];
						$user_data['MODIFIED_BY'] = $user_id;
						$user_data['MODIFIED_DATE'] = date("Y-m-d H:i:s");
						$user_table = new user_table();
						$return = $user_table->update_user($user_data, $user_where);
						if ($return){
								
									$trans_info =array();
									$trans_info['ACT_NUMBER']=rand(00000000,99999999);
									$trans_info['USER_ID']=get_login_user_id();
									$trans_info['ACTION']='Update user basic info :'.$user_id;
									$trans_info['LAST_VALUE']=$_POST['first_name'].' '.$_POST['last_name'];
									$trace_table=new trace_table();
									$trace_data= $trace_table->add_new_trace($trans_info);
									$redirect_path = 'user/account.php';
									?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?sucgen=y'?>'; </script><?php
									
								}
							
							
						
						
					break;
				}
				
				
				
				case 'edit_bank_data' : 
				{
						
						$Encryption = new Encryption();
						$user_id=$Encryption->decode($_POST['user_id']);
						$userbank_table=new userbank_table();
						$user_bank_data=$userbank_table->retrieve_userbank_by_userid($user_id);
						if (!empty($user_bank_data['ID'])){
							$user_where = '`ID`='.$user_bank_data['ID'];
							$user_data=array();
							$user_data['BANK_NAME'] = $_POST['bank_name'];
							$user_data['IBN'] = $_POST['iban'];
							$user_data['BANK_ACCOUNT'] = $_POST['bank_account'];
							$user_data['BRANCH_NAME'] = $_POST['branch_name'];
							$user_data['BANK_ADDRESS'] = $_POST['bank_address'];
							$user_data['BANK_LEGAL_NAME'] = $_POST['personal_bank_account'];
							$userbank_table = new userbank_table();
							$return = $userbank_table->update_userbank($user_data, $user_where);
							
									$trans_info =array();
									$trans_info['ACT_NUMBER']=rand(00000000,99999999);
									$trans_info['USER_ID']=get_login_user_id();
									$trans_info['ACTION']='Update user bank info :'.$user_id;
									$trans_info['LAST_VALUE']=$$user_id;
									$trace_table=new trace_table();
									$trace_data= $trace_table->add_new_trace($trans_info);
									$redirect_path = 'user/bank.php';
									?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?sucbnk=y'?>'; </script><?php
						}
						else{
							$user_data=array();
							$user_data['USER_ID'] = $user_id;
							$user_data['BANK_NAME'] = $_POST['bank_name'];
							$user_data['IBN'] = $_POST['iban'];
							$user_data['BANK_ACCOUNT'] = $_POST['bank_account'];
							$user_data['BRANCH_NAME'] = $_POST['branch_name'];
							$user_data['BANK_ADDRESS'] = $_POST['bank_address'];
							$user_data['BANK_LEGAL_NAME'] = $_POST['personal_bank_account'];
							$userbank_table = new userbank_table();
							$return = $userbank_table->add_new_userbank($user_data);
									$trans_info =array();
									$trans_info['ACT_NUMBER']=rand(00000000,99999999);
									$trans_info['USER_ID']=get_login_user_id();
									$trans_info['ACTION']='Update user bank info :'.$user_id;
									$trans_info['LAST_VALUE']=$$user_id;
									$trace_table=new trace_table();
									$trace_data= $trace_table->add_new_trace($trans_info);
									$redirect_path = 'user/bank.php';
									?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?sucbnk=y'?>'; </script><?php
						}
						
					
							
							
						
						
					break;
				}
				
				
				
				
				
				
				case 'request_reset_password' : 
				{
					
						$Encryption = new Encryption();
						$sms_verf_id=$Encryption->decode($_POST['sid']);
						$smsverf_table=new smsverf_table();
						$smsverf_data=$smsverf_table->retrieve_smsverf_by_id($sms_verf_id);
						if (!empty($smsverf_data['ID'])){
							
							if ($smsverf_data['VERIF_CODE'] == $_POST['sms_ode']){
								$user_table = new user_table();
								$user_data  = $user_table->retrieve_user(get_login_user_id());
								
								if($user_data)
									{
										$password_string = hash('SHA256',$_POST['original_password']);
										$user_password = hash('SHA256',$user_data['SALT'].$password_string);
										if($user_password == $user_data['PASSWORD'])
										{
											$password = $_POST['new_password'];
											$confirm_password = $_POST['repeat_new_password'];
													   
											 if($password and !empty($password) and $confirm_password and !empty($confirm_password))
													{
														
														$user_data = array();
														$user_data['ID'] = get_login_user_id();
														$user_data['PASSWORD'] = $_POST['new_password'];
														$user_data['confirm_password'] = $_POST['repeat_new_password'];
														$user_table = new user_table();
														$return = $user_table->update_user_password($user_data);
														
														$sms_where = '`ID`='.$sms_verf_id;
														$sms_data=array();
														$sms_data['STATUS'] = 1;
														$smsverf_table=new smsverf_table();
														$return=$smsverf_table->update_smsverf($sms_data,$sms_where);
														
														$redirect_path = 'user/passwords.php';
														?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?done_pass=y'?>'; </script><?php
													}
										}
										else{
											$redirect_path = 'user/passwords.php?reset-password';
											?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?wrong_or_pass=y'?>'; </script><?php
										}
									}
							}
							else{
								
								$redirect_path = 'user/passwords.php?reset-password';
								?><script type="text/javascript">window.location = '<?php echo $redirect_path.'&error_sm_code=y'?>'; </script><?php
							}
							
						}
							break;
				}
				
				// end of users
				
				
				
				
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				
				
				
               

			}
		}
	}
										//////////////////  End Of Post //////////////////
	
										//////////////////  GET Start//////////////////

	if($_GET)
	{
	   
	  
		$hash_code = @$_GET['confirmation'];
	    if($hash_code and !empty($hash_code))
	    {
	        $notification['error'][] = 'Invalid Confirmation Code';
			$_SESSION['hash_succ'] = $notification_string;
	        $notification_string = create_notification_string($notification);
	        $redirect_path = create_url('index.php?hash_succ='.$notification_string);
	        if(strlen($hash_code)>64)
	        {
	            $user_table = new user_table();
	            $user_id = $user_table->validate_confirmation_hash($hash_code);
	            if($user_id and !empty($user_id))
	            {
	                $validation_status = $user_table->confirm_user($user_id);
	                $notification['error'] = array();
	                $notification['error'][] = 'Something went wrong. Please Try Again.';
					$_SESSION['hash_succ'] = $notification_string;
	                $notification_string = create_notification_string($notification);
					
	                $redirect_path = create_url('index.php?hash_succ='.$notification_string);
	                if($validation_status)
	                {
						$Encryption = new Encryption();
						$encoded_id=$Encryption->encode($user_id);
						$notification_string= 'Thank you for email confirmation. Our support will review your account and send you email after confirmation.';
						$_SESSION['hash_succ'] = $notification_string;
						$redirect_path = create_url('signup.php?entmo='.$encoded_id);
	                   
	                }
	            }	            	            
	        }
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		
		$session_id = @$_GET['session_id'];
	    if($session_id and !empty($session_id))
	    {
	        $log_table=new log_table();
			$log_data=$log_table->update_login_user_by_session($session_id);
			 $redirect_path = 'user/sessions.php';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		$sessuser_id = @$_GET['sessuser_id'];
	    if($sessuser_id and !empty($sessuser_id))
	    {
			$Encryption = new Encryption();
			$user_id = $Encryption->decode($sessuser_id);
	        $log_table=new log_table();
			$cur_session_id=session_id();
			$log_data=$log_table->update_login_user_by_userid($user_id,$cur_session_id);
			 $redirect_path = 'user/sessions.php';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		
		//user
		$deluid = @$_GET['deluid'];
	    if($deluid and !empty($deluid))
	    {
			
	        $notification_string = create_notification_string($notification);
			$Encryption = new Encryption();
			$user_id=$Encryption->decode($deluid);
			$user_table = new user_table();
            $user_data = $user_table->retrieve_user($user_id);

			if ($user_data){
					$trans_info =array();
					$trans_info['ACT_NUMBER']=rand(00000000,99999999);
					$trans_info['USER_ID']=get_login_user_id();
					$trans_info['ACTION']='Delete user from:'.$user_id;
					$trans_info['LAST_VALUE']=$user_data['FULL_NAME'];
					$trace_table=new trace_table();
					$trace_data= $trace_table->add_new_trace($trans_info);
					$user_table = new user_table();
					$user_delete = $user_table->delete_user($user_id);
			}
			 $redirect_path = 'admin/users.php';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?deleteu=Y'; ?>'; </script><?php
	    }
		
		
		//activate user
		
		$activate_user_id = @$_GET['actus'];
	    if($activate_user_id and !empty($activate_user_id))
	    {
			
	        $notification_string = create_notification_string($notification);
			$Encryption = new Encryption();
			$user_id=$Encryption->decode($activate_user_id);
			$user_table = new user_table();
            $user_data = $user_table->retrieve_user($user_id);

			if ($user_data){
					$trans_info =array();
					$trans_info['ACT_NUMBER']=rand(00000000,99999999);
					$trans_info['USER_ID']=get_login_user_id();
					$trans_info['ACTION']='Activate user:'.$user_id;
					$trans_info['LAST_VALUE']=$user_data['FULL_NAME'];
					$trace_table=new trace_table();
					$trace_data= $trace_table->add_new_trace($trans_info);
					
					$user_data=array();
					$user_data['ACTIVATED'] = 1;
					$user_data['MODIFIED_BY'] = get_login_user_id();
					$user_data['MODIFIED_DATE'] = date("Y-m-d H:i:s");	
					$user_id=$user_id;
					$user_where = '`ID`='.$user_id;
					$user_table = new user_table();
					$return = $user_table->update_user($user_data,$user_where);
			}
			 $redirect_path = 'admin/users.php';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?actiu=Y'; ?>'; </script><?php
	    }
		
		
		//deactivate user
		
		$deactivate_user_id = @$_GET['deactus'];
	    if($deactivate_user_id and !empty($deactivate_user_id))
	    {
			
	        $notification_string = create_notification_string($notification);
	       $Encryption = new Encryption();
			$user_id=$Encryption->decode($deactivate_user_id);
			$user_table = new user_table();
            $user_data = $user_table->retrieve_user($user_id);

			if ($user_data){
					$trans_info =array();
					$trans_info['ACT_NUMBER']=rand(00000000,99999999);
					$trans_info['USER_ID']=get_login_user_id();
					$trans_info['ACTION']='Deactivate user:'.$user_id;
					$trans_info['LAST_VALUE']=$user_data['FULL_NAME'];
					$trace_table=new trace_table();
					$trace_data= $trace_table->add_new_trace($trans_info);
					
					$user_data=array();
					$user_data['ACTIVATED'] = 0;
					$user_data['MODIFIED_BY'] = get_login_user_id();
					$user_data['MODIFIED_DATE'] = date("Y-m-d H:i:s");	
					$user_id=$user_id;
					$user_where = '`ID`='.$user_id;
					$user_table = new user_table();
					$return = $user_table->update_user($user_data,$user_where);
			}
			 $redirect_path = 'admin/users.php';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path.'?deactiu=Y'; ?>'; </script><?php
	    }
		
		
		
		
		
		// 2fa disable begin
		
		
		$disfa = @$_GET['disfa'];
	    if($disfa and !empty($disfa))
	    {
			$Encryption = new Encryption();
			$user_id = $Encryption->decode($_GET['uid']);
	        
			$user_table = new user_table();
			$hash = $user_table->generate_disable_fa_hash($user_id);
			if($hash != false)
			{
				
			$user_email = $_POST['email'];
			$subject='Enable 2FA Factor';
			$param_table = new param_table();
			$param_data = $param_table->retrieve_params();
			$BASE_WEBSITE = $param_data['BASE_URL'];
			$message_body = 'Dear Customer,<br/><br/>'.$_POST['first_name'].' '.$_POST['last_name'];
			$message_body .= 'Please click on this link to Disable 2FA Factor<br/><br/>';
			$password_url = $BASE_WEBSITE.'process.php?faact='.$hash;
			$message_body .= '<a href="'.$password_url.'">Enable 2FA Factor</a><br/><br/>';
			
			
			
			$from = 'info@bprotrader.com';
			require_once 'inc/class.phpmailer/PHPMailerAutoload.php';
			$phpmailer = new PHPMailer();
			$phpmailer->CharSet = 'UTF-8';
			$phpmailer->addAddress($user_email);
			$phpmailer->setFrom($from);
			$phpmailer->addReplyTo($from);
			$phpmailer->Subject = $subject;
			$phpmailer->isHTML(true);
			$phpmailer->Body = $message_body;
			$phpmailer->Send();
				
			}
			$redirect_path = 'user/authentication.php?fasent=Y';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		
		
		
		$faact = @$_GET['faact'];
	    if($faact and !empty($faact))
	    {
	        $notification['error'][] = 'Invalid Confirmation Code';
			$_SESSION['hash_succ'] = $notification_string;
	        $notification_string = create_notification_string($notification);
	        $redirect_path = create_url('index.php?hash_succ='.$notification_string);
	        if(strlen($faact)>64)
	        {
	            $user_table = new user_table();
	            $user_id = $user_table->validate_confirmation_hash($faact);
	            if($user_id and !empty($user_id))
	            {
	                $validation_status = $user_table->disable_fa($user_id);
	                $notification['error'] = array();
	                $notification['error'][] = 'Something went wrong. Please Try Again.';
					$_SESSION['hash_succ'] = $notification_string;
	                $notification_string = create_notification_string($notification);
					
	                $redirect_path = create_url('index.php?hash_succ='.$notification_string);
	                if($validation_status)
	                {
						$Encryption = new Encryption();
						$encoded_id = $Encryption->encode($user_id);
						$notification_string= 'Thank you for email confirmation. Our support will review your account and send you email after confirmation.';
						$_SESSION['hash_succ'] = $notification_string;
						$redirect_path = create_url('user/authentication.php?disable=suc');
	                   
	                }
	            }	            	            
	        }
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		
		
		//2fa enable begin
		
		
		$enbfa = @$_GET['enbfa'];
	    if($enbfa and !empty($enbfa))
	    {
			
			$Encryption = new Encryption();
			$user_id = $Encryption->decode($_GET['uid']);
	        
			$user_table = new user_table();
			$hash = $user_table->generate_enable_fa_hash($user_id);
			if($hash != false)
			{
				
			$user_email = $_POST['email'];
			$subject='Enable 2FA Factor';
			$param_table = new param_table();
			$param_data = $param_table->retrieve_params();
			$BASE_WEBSITE = $param_data['BASE_URL'];
			$message_body = 'Dear Customer,<br/><br/>'.$_POST['first_name'].' '.$_POST['last_name'];
			$message_body .= 'Please click on this link to Enable 2FA Factor<br/><br/>';
			$password_url = $BASE_WEBSITE.'process.php?fadeact='.$hash;
			$message_body .= '<a href="'.$password_url.'">Enable 2FA Factor</a><br/><br/>';
			
			
			
			$from = 'info@bprotrader.com';
			require_once 'inc/class.phpmailer/PHPMailerAutoload.php';
			$phpmailer = new PHPMailer();
			$phpmailer->CharSet = 'UTF-8';
			$phpmailer->addAddress($user_email);
			$phpmailer->setFrom($from);
			$phpmailer->addReplyTo($from);
			$phpmailer->Subject = $subject;
			$phpmailer->isHTML(true);
			$phpmailer->Body = $message_body;
			$phpmailer->Send();
				
			}
			$redirect_path = 'user/authentication.php?fasent=Y';
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		
		
		
		$fadeact = @$_GET['fadeact'];
	    if($fadeact and !empty($fadeact))
	    {
	        $notification['error'][] = 'Invalid Confirmation Code';
			$_SESSION['hash_succ'] = $notification_string;
	        $notification_string = create_notification_string($notification);
	        $redirect_path = create_url('index.php?hash_succ='.$notification_string);
	        if(strlen($fadeact)>64)
	        {
	            $user_table = new user_table();
	            $user_id = $user_table->validate_confirmation_hash($fadeact);
	            if($user_id and !empty($user_id))
	            {
	                $validation_status = $user_table->enable_fa($user_id);
	                $notification['error'] = array();
	                $notification['error'][] = 'Something went wrong. Please Try Again.';
					$_SESSION['hash_succ'] = $notification_string;
	                $notification_string = create_notification_string($notification);
					
	                $redirect_path = create_url('index.php?hash_succ='.$notification_string);
	                if($validation_status)
	                {
						$Encryption = new Encryption();
						$encoded_id=$Encryption->encode($user_id);
						$notification_string= 'Thank you for email confirmation. Our support will review your account and send you email after confirmation.';
						$_SESSION['hash_succ'] = $notification_string;
						$redirect_path = create_url('user/authentication.php?enable=suc');
	                   
	                }
	            }	            	            
	        }
	        ?><script type="text/javascript">window.location = '<?php echo $redirect_path; ?>'; </script><?php
	    }
		
		
		
		
		
		
		

	}
	

	
	
										//////////////////  End Of Get //////////////////
?>
