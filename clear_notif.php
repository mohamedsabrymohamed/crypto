<?php
require_once 'inc.php';

$notification_table=new notification_table();
$user_table = new user_table();
$user_type=$user_table->retrieve_user($_POST['uid']);
if($user_type['USER_TYPE'] == 2){
$user_data = array();
$user_data['NOTIFICATION_STATUS'] = 1;
$user_where = '`NOTIFICATION_TYPE`= 2';

$notif_update=$notification_table->update_notification($user_data, $user_where);	
}
elseif($user_type['USER_TYPE'] == 1){
$user_data = array();
$user_data['NOTIFICATION_STATUS'] = 1;
$user_where = '`NOTIFICATION_TYPE`= 1';

$notif_update=$notification_table->update_notification($user_data, $user_where);

}




?>