<?php

class Index extends Public_Controller
{

    public $data;

    function __construct()
    {
        parent::__construct();
		
		$this->load->model('portal_m');
     }

    /**
     * show frontend
     * 
     */
    public function index()
    {
            redirect('admin');
        $this->template
                  ->build('index/main', $data);
    }
	
	function random_pass($length)
		{
			$chars = "123GHJKLMkmnpqNPQRST456789abcdefghijrstuvwxyzABCDEFUVWXYZ";
			$thepassword = '';
			for ($i = 0; $i < $length; $i++)
			{
				$thepassword .= $chars{rand() % (strlen($chars) - 1)};
			}
			return $thepassword;
		}
		//Prayer Request
		
function prayer_request(){
		
		    $name = $_POST['name'];
		    $membership = $_POST['membership'];
		    $phone = $_POST['phone'];
		    $prayer_request =$_POST['description'];
			
			$settings = $this->portal_m->fetch_settings();
		    $from=$settings->sender_id;

			
			$user = $this -> ion_auth -> get_user();
		   
              $form_data = array(
				'request_date' => time(), 
				'first_name' => ucwords($name), 
				'address' => $phone, 
				'second_name' => ucwords($name), 
				'phone_number' => $phone, 
				'membership' => $membership, 
				'prayer_request' => $prayer_request,  
				'created_by' =>  $user_id,   
				'created_on' => time()
			);

            $ok=  $this->portal_m->post_prayers($form_data);
			
			if ($ok)
                {
                        
						 $response["success"] = 1;
                        echo json_encode($response);
						
						// successfully inserted into database
						$this->load->library('sms_gateway');
							$bal = $this->portal_m->get_counter_balance();
							
							if(!$bal->balance == 0){
									$gtype = refNo().'/'.date('m/y',time());
									$country_code = '254';
									
									$ph = $phone;
									$fname = ucwords($name);
									$cha =array ('(',')','-',' ');
									$sp =array ('','','');
									$recipient =  str_replace($cha,$sp,$ph);
									
									$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
									$message='Hi '.$fname.', your prayer request has been received. May you be blessed';
									
									//$this->sms_gateway->sendMessage($new_number, $message,$from);
									$this->sms_m->send_sms($recipient, $message);
									
											$form_data = array(
												'recipient' => $user -> id , 
												'status' => 1, 
												'message' => $message, 
												'sent_to' => 'Prayer Request', 							
												'group_type' => $gtype, 
												'created_by' => $user -> id ,   
												'created_on' => time()
											);

										  $this->portal_m->create_sms($form_data);
							
										//Update SMS counter table
								
											$tt=($bal->balance-1);
											$sms = array( 
											'balance' => $tt, 
											'modified_by' => $user -> id ,   
											'modified_on' => time() );
											
										$this->portal_m->update_counter($sms);
							
							}

                       
                }
                else
                {
                        // failed to insert row
                        $response["success"] = 0;
                        $response["message"] = " An error has occurred";
                        echo json_encode($response);
                }
		
	}
	
	// HBCs
		
		function hbcs(){
			
			  $posts = $this->portal_m->all_hbcs();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
						
					$u = $this->portal_m->find_member($p->overall_leader);
					
					  $json['pid'] = $p->id;
					  $json['title'] = 'Name: '.ucwords($p->name);
					  $json['intro'] = 'Estate: '.ucwords($p->estate);
					  $json['description'] = 'Leader: '.ucwords($u->first_name).' '.ucwords($u->last_name);
					  $json['created_on'] = 'Meeting day: '.$p->meeting_day.' - Time:'.$p->meeting_time;
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
		

		// HBCs
		
		function ministries(){
			
			  $posts = $this->portal_m->all_ministries();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
						
					$u = $this->portal_m->find_member($p->leader);
					
					  $json['pid'] = $p->id;
					  $json['title'] = ucwords($p->name);
					  $json['intro'] = substr($p->description,0,200).'...';
					  $json['description'] = 'Tel: '.$p->mobile.' Email: '.$p->email;
					  $json['created_on'] = 'Leader: '.ucwords($u->first_name).' '.ucwords($u->last_name);
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
		

		
	
		
		//New Member
		
    function mobile_register()
        {
                //$this->load->library('mobile');
                $response = array();

				$first_name=$_POST['first_name'];
				$last_name=$_POST['last_name'];
				
				$gender=$_POST['gender'];
				$dob=$_POST['dob'];
				$phone1=$_POST['phone1'];
				$phone2=$_POST['phone2'];
				
				$email=$_POST['email'];
				$county=$_POST['county'];
				$estate=$_POST['estate'];
				$marital_status=$_POST['marital_status'];
				$address=$_POST['address'];
				
				$password = $this->random_pass(6);
				
				if($first_name == '' || $last_name == '' || $phone1 == '' ){
					
					redirect('/');
				}

                else{
                $username = $email;
                $fone = $phone1;
                $email = $email;
                $password = $password;
				
				//print_r($password);die;

                $additional_data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone' => $phone1,
                    'user_type' => 2,
                    'me' => 1,
                );
				
                if ($uid = $this->ion_auth->register($username, $password, $email, $additional_data))
                {
						
						$form_data = array(
							'first_name'=>ucwords($first_name),
							'last_name'=>ucwords($last_name),
							'gender'=>$gender,
							'dob'=>strtotime($dob),
							'phone1'=>$phone1,
							'phone2'=>$phone2,
							'email'=>$email,
							'status'=>0,
							'county'=>$county,
							'location'=>ucwords($estate),
							'date_joined'=>time(),
							'marital_status'=>$marital_status,
							'address'=>$address,
							'created_on'=>time(),
							'created_by'=>$uid
						
						);
						
                       
                        $ok = $this->portal_m->create_member($form_data);
                        //add to Member Group
                        $this->ion_auth->add_to_group(2, $uid);
						
						$settings = $this->portal_m->fetch_settings();
		                $from=$settings->sender_id;
					   $mem_code=$settings->member_code_initial;
					   
					   
						
						$ref="";
							if($ok<10){
								$ref = "00";
							}
							elseif($ok>9 && $ok<99){
								$ref = "0";
							}
							elseif($ok>99){
								$ref = "";
							}
							//$full_code = $mem_code.'-'.$ref.''.$ok;
							
							$full_code = $mem_code.'/0'.date('y').'/00'.$ok;
							$update_code = array( 
								'member_code' =>$full_code
								);
						$this->portal_m->update_member($ok, $update_code);
						
						//*********************SMS NEW MEMBER ***********************
						    
							
					        $this->load->library('sms_gateway');
							$bal = $this->portal_m->get_counter_balance();
							
							if(!$bal->balance == 0){
									$gtype = refNo().'/'.date('m/y',time());
									$country_code = '254';
									
									$ph = $this->input->post('phone1');
									$fname = $first_name;
									$cha =array ('(',')','-',' ');
									$sp =array ('','','');
									$recipient =  str_replace($cha,$sp,$ph);
									
									$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
									$message='Hi '.$fname.', we thank you for choosing to become a member of our church. Your Membership Code is '.$full_code.' Username: '.$email.' Password: '.$password;
									
									//$this->sms_gateway->sendMessage($new_number, $message,$from);
									$this->sms_m->send_sms($recipient, $message);
									
											$form_data = array(
												'recipient' => $ok, 
												'status' => 1, 
												'message' => $message, 
												'sent_to' => 'church member', 							
												'group_type' => $gtype, 
												'created_by' => $user -> id ,   
												'created_on' => time()
											);

										  $this->portal_m->create_sms($form_data);
							
										//Update SMS counter table
								
											$tt=($bal->balance-1);
											$sms = array( 
											'balance' => $tt, 
											'modified_by' => $user -> id ,   
											'modified_on' => time() );
											
										$this->portal_m->update_counter($sms);
							
							}

                }

                if ($additional_data)
                {
                        // successfully inserted into database

                        $response["success"] = 1;
                        $response["message"] = "Profile successfully created.";
                        // echoing JSON response
                        echo json_encode($response);
                }
                else
                {
                        // failed to insert row
                        $response["success"] = 0;
                        $response["message"] = " An error has occurred";

                        // echoing JSON response
                        echo json_encode($response);
                }
        }
		
}

	
		// Announcements
		
		function announcements(){
			
			  $posts = $this->portal_m->all_announcements();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
					
					  $json['pid'] = $p->id;
					  $json['title'] = ucwords($p->title);
					  $json['intro'] = substr($p->brief_description,0,45).'...';
					  $json['description'] = ucwords($p->brief_description);
					  $json['created_on'] = 'Posted On: '.date('d M Y',$p->created_on);
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
		
		// Video Sermons
		
		function video_sermons(){
			
			  $posts = $this->portal_m->all_videos();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
					
					  $json['pid'] = $p->id;
					  $json['title'] = ucwords($p->title);
					  $json['intro'] = substr($p->description,0,100).'...';
					  $json['description'] = ucwords($p->value);
					  $json['created_on'] = 'Posted On: '.date('d M Y',$p->created_on);
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
		// Events
		
		function events(){
			
			  $posts = $this->portal_m->all_events();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
					
					  $json['pid'] = $p->id;
					  $json['title'] = ucwords($p->title);
					  $json['intro'] = substr($p->description,0,45).'...';
					  $json['dates'] = 'From: '.date('d/m/Y',$p->start_date).' To: '.date('d/m/Y',$p->end_date);
					  $json['venue'] = 'Venue: '.$p->venue;
					  $json['description'] = ucwords($p->description);
					  $json['created_on'] = 'Posted On: '.date('d M Y',$p->created_on);
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
		// Meetings
		
		function meetings(){
			
			  $posts = $this->portal_m->all_meetings();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
					
					  $json['pid'] = $p->id;
					  $json['title'] = ucwords($p->title);
					  $json['intro'] = substr($p->description,0,45).'...';
					  $json['dates'] = 'From: '.date('d/m/Y',$p->start_date).' To: '.date('d/m/Y',$p->end_date);
					  $json['venue'] = 'Venue: '.$p->venue;
					  $json['guests'] = 'Guests: '.ucwords($p->guests);
					  $json['description'] = ucwords($p->description);
					  $json['created_on'] = 'Posted On: '.date('d M Y',$p->created_on);
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
	
	
		// Meetings
		
		function sermons(){
			
			  $posts = $this->portal_m->all_sermons();
			  
			  //print_r($posts);die;
			  $json = array();
			
			$response["products"] = array();
			
			if(!empty($posts)){
					foreach($posts as $p){
					
					  $json['pid'] = $p->id;
					  $json['title'] = ucwords($p->title);
					  $json['intro'] = substr($p->sermon_theme,0,45).'...';
					 // $json['intro'] = ucwords($p->sermon_theme);
					  $json['dates'] = 'Date: '.date('d/m/Y',$p->service_date);
					  $json['venue'] = 'Leader: '.ucwords($p->service_leader);
					  $json['guests'] = '1st '.ucwords($p->first_service).' - 2nd '.ucwords($p->second_service);
					  $json['description'] = ucwords($p->description);
					  $json['created_on'] = 'Posted On: '.date('d M Y',$p->created_on);
					  array_push($response["products"], $json);
					}
					 $response["success"] = 1;
					 //$response["title"] =  $title;
					echo json_encode($response);
			  }
			  else{
				  // no data found
				$response["success"] = 0;
				$response["message"] = "No Posts at the moment";
				// echo no users JSON
				echo json_encode($response);
			  }
			
		}
	
	

    public function contact($result = NULL)
    {
        $this->template->title(lang('web_contact'));
        $this->_set_rules();

        if ($this->form_validation->run() == FALSE)
        {
            $this->template->build('index/contact');
        }
        else
        {
            $form_data = array(
                'name' => $this->input->post('name', TRUE),
                'lastname' => $this->input->post('lastname', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'comments' => $this->input->post('comments', TRUE)
            );

            $this->load->library('email');

            $this->email->from('admin@admin.com', 'Codeigniter');
            $this->email->to('admin@admin.com');

            $this->email->subject('Contact Form');

            $message = $this->load->view('index/email/formcontact.tpl.php', $form_data, TRUE);

            $this->email->message($message);

            if ($this->email->send())
            {
                $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_mail_ok')));
                redirect('contact');
            }
            else
            {
                $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_mail_ko')));
                redirect('contact');
            }
        }
    }

    /**
     * Set rules for form
     * @return void
     */
    private function _set_rules()
    {
//validate form input
        $this->form_validation->set_rules('name', 'lang:web_name', 'required|trim|xss_clean|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('lastname', 'lang:web_lastname', 'required|trim|xss_clean|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('email', 'lang:web_email', 'required|trim|valid_email|xss_clean');
        $this->form_validation->set_rules('phone', 'lang:web_phone', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('comments', 'lang:web_comments', 'required|trim|xss_clean');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
    }

}
