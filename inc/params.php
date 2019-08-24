<?php 
    class param_table
    {
        private $_dbh;
        private $_table_name = 'bpt_param';
        public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
		
		public function retrieve_params()
		{
			$query = "SELECT * from ".$this->_table_name;
            $result = $this->_dbh->query($query);
            $params_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $params_data[$row['PARAM_NAME']] = $row['PARAM_VALUE'];        
            }
            return $params_data;
		}
		
		 public function update_param($news_data,$condition)
	    {
	        $query ="UPDATE ".$this->_table_name." 
					SET PARAM_VALUE = '".$news_data."'
							WHERE PARAM_ID =  '".$condition."' ";
     
		$result = $this->_dbh->query($query);
		    if($result)
		    {
		        return true;
		    }
		    return false;	        
	    }
	
		 public function update_param_ounce($data)
    {
		$query ="UPDATE ".$this->_table_name." 
					SET PARAM_VALUE = '".$data."'
							WHERE PARAM_ID = 110 ";
     
		$result = $this->_dbh->query($query);
		    if($result)
		    {
		        return true;
		    }
		    return false;	
    }
	

 public function update_gs_param(array $data)
    {
	
		$query ="UPDATE ".$this->_table_name." 
					SET PARAM_VALUE = (CASE WHEN PARAM_ID = 100 THEN '".$data['FB_LINK']."'
							WHEN PARAM_ID = 101 THEN '".$data['TWITTER_LINK']."'
							WHEN PARAM_ID = 102 THEN '".$data['GPLUS_LINK']."'
							WHEN PARAM_ID = 103 THEN '".$data['ANDROID_APP_LINK']."'
							WHEN PARAM_ID = 104 THEN '".$data['IOS_APP_LINK']."'
							WHEN PARAM_ID = 105 THEN '".$data['HOTLINE']."'
							WHEN PARAM_ID = 114 THEN '".$data['CONTACT_US_EMAIL']."'
							WHEN PARAM_ID = 10 THEN '".$data['MAILFROM']."'
							END)
							WHERE PARAM_ID IN (100,101,102,103,104,105,114,10)";
							
							
     
		$result = $this->_dbh->query($query);
		    if($result)
		    {
		        return true;
		    }
		    return false;	
    }


 
	}
?>