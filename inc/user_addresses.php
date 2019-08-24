<?php 
    class useraddresses_table
    {
        private $_dbh;
        private $_table_name = 'bpt_user_addresses';
		 public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
		
		
		
		public function retrieve_all_useraddresses()
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
		
		
			public function add_new_useraddresses(array $summery_data)
		{
		    if($summery_data)
		    {
		       return $this->_dbh->insert($summery_data);
		        
		    }
		    return false;
		}
		
		
		
		public function retrieve_useraddresses_by_userid($user_id)
		{
		   $query = "SELECT * from ".$this->_table_name." where USER_ID ='".$user_id."' ";
            $result = $this->_dbh->query($query);
          $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
		public function retrieve_useraddresses_by_userid_active($user_id)
		{
		    $query = "SELECT * from ".$this->_table_name." where USER_ID ='".$user_id."'  AND BASE_ADDRESS = 1";
            $result = $this->_dbh->query($query);
           $result_data = mysqli_fetch_assoc($result);
		    if($result_data['ID'] and !empty($result_data['ID']))
		    {
		        return $result_data;
		    }
		    return false;    
		}
		
		
		  public function update_useraddresses(array $user_data,$condition)
	    {
	        return $this->_dbh->update($user_data, $condition);	        
	    }
		
		
		
	}
?>