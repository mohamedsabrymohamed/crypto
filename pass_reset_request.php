<?php 
require_once 'inc.php';
require_once 'send_sms.php';
if (ISSET($_GET['sid']) && !empty($_GET['sid'])){
		$Encryption = new Encryption();
		
		$user_id=$Encryption->decode($_GET['sid']);
		$user_table = new user_table();
		$user_data=$user_table->retrieve_user($user_id);
		$sms_data=array();
		$sms_data['USER_ID']= get_login_user_id();
		$phone= $user_data['MOBILE'];
		$sms_data['VERIF_CODE']=rand(00000000,99999999);
		$sms_data['VERIF_TYPE'] = 'Request Reset Password';
		$sms_data['VERIF_DATE']= date("Y-m-d H:i:s");
		$smsverf_table=new smsverf_table();
		$return=$smsverf_table->add_new_smsverf($sms_data);
		if (!empty($return)){
		send_sms($phone , $sms_data['VERIF_CODE']);
		
			$redirect_path = $_SERVER['HTTP_REFERER'];
			$Encryption = new Encryption();
			$smsm_id=$Encryption->encode($return);
			?><script type="text/javascript">window.location = '<?php echo $redirect_path.'&send_code=Y&smid='.$smsm_id?>'; </script><?php
		
	}
}

?>