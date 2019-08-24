<?php 
    class paymentmethods_table
    {
        private $_dbh;
        private $_table_name = 'bpt_payment_methods';
		 public function __construct()
        {
            $this->_dbh = new db_connection($this->_table_name);
        }
		
		
		
		public function retrieve_all_paymentmethods()
		{
			$query = "SELECT * from ".$this->_table_name. " ORDER BY ID DESC";
            $result = $this->_dbh->query($query);
            $trans_data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $trans_data[] = $row;        
            }
            return $trans_data;
		}
		
		
			public function add_new_paymentmethods(array $summery_data)
		{
		    if($summery_data)
		    {
		       return $this->_dbh->insert($summery_data);
		        
		    }
		    return false;
		}
		
		 public function update_paymentmethods(array $user_data,$condition)
	    {
	        return $this->_dbh->update($user_data, $condition);	        
	    }
		
		
		public function delete_paymentmethods($productid)
		{
			$product_id = $productid;
			
		   $query = "DELETE FROM ".$this->_table_name." 
					WHERE  
					ID =".$product_id."";
					 
            $result = $this->_dbh->query($query);
		   
		    if($result)
		    {
		        return true;
		    }
		    return false;		    
		}
		
		
		public function retrieve_paymentmethods($user_id)
		{
		   $query = "SELECT * from ".$this->_table_name." where ID ='".$user_id."'";
            $result = $this->_dbh->query($query);
		    $result_data = mysqli_fetch_assoc($result);
		    if($result_data['ID'] and !empty($result_data['ID']))
		    {
		        return $result_data;
		    }
		    return false;		    
		}
		
		
		
		
		
		
		
		
		
		
		
	}
?>