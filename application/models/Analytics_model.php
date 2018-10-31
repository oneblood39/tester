<?php

class Analytics_model extends CI_Model
{
	    public function __construct()
    {
        $this->load->database();
        parent::__construct();
    }

  public function sonuckaydet(){ 
	                $data = array(
                    'profile_name' =>  $this->input->post('profilname'),
					 'total_sessions' => $this->input->post('sessions'),
					  'city' => $this->input->post('cities'),
					   'data_date' => $this->input->post('dates'),
					    'total_visits' => $this->input->post('visits'),
						 'total_pageviews' => $this->input->post('pageviews')
                   
                );

               $kayit=$this->db->insert("analytics_data",$data);  
			   
			   if ($kayit) { echo '<center>Veritabanına kayıt işlemi gerçekleşti</center>';} else { }
			   
			   header( "refresh:1; url=http://localhost/codeigniter/" );
  
  }



}



?>