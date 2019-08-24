<?php 
    class smsverf_table
    {
        private $_dbh;
        private $_table_name = 'bpt_sms_verif';
		 public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
		
		
		
		public function retrieve_all_smsverf()
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
		
		
			public function add_new_smsverf(array $summery_data)
		{
		    if($summery_data)
		    {
		       return $this->_dbh->insert($summery_data);
		        
		    }
		    return false;
		}
		
		
		
			public function retrieve_smsverf_by_id($id)
		{
		   $query = "SELECT * from ".$this->_table_name." where ID ='".$id."' ";
              $result = $this->_dbh->query($query);
           $result_data = mysqli_fetch_assoc($result);
		    if($result_data['ID'] and !empty($result_data['ID']))
		    {
		        return $result_data;
		    }
		    return false;     
		}
		
		
		public function retrieve_smsverf_by_verf_code($verf_code,$user_id)
		{
		   $query = "SELECT * from ".$this->_table_name." where VERIF_CODE ='".$verf_code."' AND USER_ID=".$user_id." ";
            $result = $this->_dbh->query($query);
           $result_data = mysqli_fetch_assoc($result);
		    if($result_data['ID'] and !empty($result_data['ID']))
		    {
		        return $result_data;
		    }
		    return false;    
		}
		
		
		  public function update_smsverf(array $user_data,$condition)
	    {
	        return $this->_dbh->update($user_data, $condition);	        
	    }
		
		
		
	}
?>