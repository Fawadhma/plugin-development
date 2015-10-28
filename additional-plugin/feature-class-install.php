<?php

 class feature_install
   {
	 
	 function install_table()
	    {
		 $this->creat_table();
	    }
	 
	
	 function creat_table()
	    {
	   
	   global $wpdb;
	   $table_name = $wpdb->prefix."features";
	   $table_creat = "CREATE TABLE $table_name( id int(11) NOT NULL auto_increment,
	                                            first_name varchar(255) NOT NULL,
												last_name varchar(255) NOT NULL,
												question text NOT NULL,
												UNIQUE KEY id (id))";
												
	  require_once( ABSPATH.'wp-admin/includes/upgrade.php' );
	  dbDelta( $table_creat );	
	    }
		
	  function insert_data( $new,$lnew,$qnew)
	     {
		$this->name = $new;
		$this->lname = $lnew;
		$this->question = $qnew;
		 
		 
	     global $wpdb;
		 $table_name = $wpdb->prefix."features";
		 $data = array( first_name => $this->name, last_name => $this->lname, question => $this->question );
		 $wpdb->insert($table_name,$data);
		 
		 
	     }
    }



?>