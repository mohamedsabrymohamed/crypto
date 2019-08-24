<?php 
    class wronglog_table
    {
        private $_dbh;
        private $_table_name = 'wrong_login_hist';
        public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
        
        public function create_wronglogin_log($wrong_reason)
        {
            $user_os        =   getOS();
			$user_browser   =   getBrowser();

	    $log_data = array();
            if($_SERVER['REMOTE_ADDR'] and !empty($_SERVER['REMOTE_ADDR']))
            {
                $log_data['histroy_id'] = null;
                $log_data['IP_ADDRESS'] = $_SERVER['REMOTE_ADDR'];
				$log_data['TIMESTAMP'] = DATE('Y-m-d H:i:s');
				$log_data['BROWSER'] = $user_browser;
				$log_data['OS'] = $user_os ;
				$log_data['WRONG_REASON'] = $wrong_reason;
				return $this->_dbh->insert($log_data);
            }
            return false;        
        }
		
		public function retrieve_wronglogin_by_user($id)
		{
			
			$query = "SELECT * FROM ".$this->_table_name."  
						where 
						IP_ADDRESS LIKE '".$id."'
						AND `TIMESTAMP` > (now() - interval 10 minute)";
            $result = $this->_dbh->query($query);
            $login_data = array();
			
            while($row = mysqli_fetch_assoc($result))
            {
                $login_data[] = $row;        
            }
            return $login_data;
		}


			public function retrieve_wronglogin_by_user_ID($id)
		{
			
			$query = "SELECT * FROM ".$this->_table_name."  
						where 
						IP_ADDRESS LIKE '".$id."'
						AND `TIMESTAMP` > (now() - interval 10 minute)
						";
            $result = $this->_dbh->query($query);
            $login_data = array();
			
            while($row = mysqli_fetch_assoc($result))
            {
                $login_data[] = $row;        
            }
            return $login_data;
		}
		
		
		
    }
    
?>
