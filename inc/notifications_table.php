<?php 
    class notification_table
    {
        private $_dbh;
        private $_table_name = 'bpt_notifications';
		 public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
		
		
		
		public function retrieve_all_notification()
		{
			$query = "SELECT * from ".$this->_table_name;
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
			public function add_new_notification(array $summery_data)
		{
		    if($summery_data)
		    {
		       return $this->_dbh->insert($summery_data);
		        
		    }
		    return false;
		}
		
		 public function update_notification(array $user_data,$condition)
	    {
	        return $this->_dbh->update($user_data, $condition);	        
	    }
		
		
		
		
		
		public function retrieve_notification($prod_id)
		{
		   $query = "SELECT * from ".$this->_table_name." where ID ='".$prod_id."'";
            $result = $this->_dbh->query($query);
		    $result_data = mysqli_fetch_assoc($result);
		    if($result_data['ID'] and !empty($result_data['ID']))
		    {
		        return $result_data;
		    }
		    return false;		    
		}
		
		
		
		public function retrieve_all_active_notification()
		{
			$query = "SELECT * from ".$this->_table_name." where NOTIFICATION_STATUS = 0";
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
		public function retrieve_all_notification_by_userid_unread($prod_id)
		{
			$query = "SELECT * from ".$this->_table_name." where USER_ID ='".$prod_id."' AND NOTIFICATION_STATUS = 0";
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
		
		
		public function retrieve_all_notification_unread_type($prod_id)
		{
			$query = "SELECT * from ".$this->_table_name." where NOTIFICATION_TYPE ='".$prod_id."' AND NOTIFICATION_STATUS = 0";
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
		
		public function retrieve_all_admin_notification_unread_type()
		{
			$query = "SELECT * from ".$this->_table_name." where `NOTIFICATION_TYPE` IN (1,2) AND NOTIFICATION_STATUS = 0";
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
		
		
		
		
		
		
	}
?>