<?php 
    class trace_table
    {
        private $_dbh;
        private $_table_name = 'bpt_trace';
		 public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
		
		
		
		public function retrieve_all_trace()
		{
			$query = "SELECT * from ".$this->_table_name." ORDER BY ACT_DATE DESC";
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
			public function add_new_trace(array $summery_data)
		{
		    if($summery_data)
		    {
		       return $this->_dbh->insert($summery_data);
		        
		    }
		    return false;
		}
		
		
		
			public function retrieve_all_trace_for_contact($user_id)
		{
		   $query = "SELECT * from ".$this->_table_name." where TO_CONTACT ='".$user_id."' ORDER BY ACT_DATE DESC";
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