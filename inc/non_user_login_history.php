<?php 
    class non_user_log_table
    {
        private $_dbh;
        private $_table_name = 'non_users_connections';
        public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
        
        public function create_log()
        {
			
			$user_os        =   getOS();
            $user_browser   =   getBrowser();

            if(isset($_SESSION['current_user']) and $_SESSION['current_user'] and !empty($_SESSION['current_user']));
            else
            {
              
			$_SESSION['current_user'] = session_id();
                $log_data = array();
                $log_data['histroy_id'] = null;
                $log_data['SESSIONID'] = session_id();
                $log_data['IP_ADDRESS'] = $_SERVER['REMOTE_ADDR'];
		$log_data['TIMESTAMP'] = date('Y-m-d H:i:s');
                $log_data['BROWSER'] = $user_browser;
                $log_data['OS'] = $user_os ;
				
		return $this->_dbh->insert($log_data);
            }
            return false;
        }
    }
    
?>
