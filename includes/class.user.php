<?php 
include "dbh-inc.php";
class User{
	protected $db;
	public function __construct(){
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}

	public function reg_user($request){
		
		extract($request);

		$password = md5($password);

		
		$query = "SELECT * FROM users WHERE user='$user' OR email='$email'";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;
		$created_at=date("Y-m-d h:i:s");

		if($count_row == 0){
			$query = "INSERT INTO users SET user='$user', password='$password', firstname='$firstname', email='$email', lastname='$lastname',phonenumber='$phonenumber',displayname='$displayname',registrationTimestamp='$created_at' ";

			$result = $this->db->query($query) or die($this->db->error);

			return true;
		}
		else{return false;}


	}


	/*** for login process ***/
	public function check_login($emailusername, $password){

		$password = md5($password);
		
		$query = "SELECT id from users WHERE email='$emailusername' and password='$password'";
		
		$result = $this->db->query($query) or die($this->db->error);

		
		$user_data = $result->fetch_array(MYSQLI_ASSOC);

		$count_row = $result->num_rows;


		
		if ($count_row == 1) {
	            $_SESSION['login'] = true; // this login var will use for the session thing
	            $_SESSION['id'] = $user_data['id'];
	            return true;
	        }

	        else{return false;}


	    }


	    public function get_fullname($uid){
	    	$query = "SELECT firstname FROM users WHERE id = $uid";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	$user_data = $result->fetch_array(MYSQLI_ASSOC);
	    	echo $user_data['firstname'];

	    }

	    /*** starting the session ***/
	    public function get_session(){
	    	return $_SESSION['login'];
	    }

	    public function user_logout() {
	    	$_SESSION['login'] = FALSE;
	    	unset($_SESSION);
	    	session_destroy();
	    }




	    public function forgotpassword($emailusername){

	    	$token = base64_encode($emailusername);

	    	$query = "SELECT * FROM users  WHERE email = '$emailusername'";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	$count_row = $result->num_rows;


	    	if($count_row==1)
	    	{

	    		$html = "Hello $emailusername<br/><br/>";

	    		$html.= "For reset password <a href='http://www.shsustudents.com/resetpassword.php?token=".$token."'>Click here</a><br/><br/>";

	    		$html.= "Thanks";

			// Always set content-type when sending HTML email
	    		$headers = "MIME-Version: 1.0" . "\r\n";
	    		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
	    		$headers .= 'From: admin@shsustudents.com' . "\r\n";

			//$msg = "For reset password Please <a href='resetpassword.php?token='".$token."''>Click here </a>";

	    		$send_mail=mail($emailusername,"Reset password",$html, $headers);

	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}

	    }

	    public function verify_password($email,$password){

	    	$password = md5($password);
	    	$query = "UPDATE users set password='$password'  WHERE email = '$email'";
	    	$result = $this->db->query($query) or die($this->db->error);
	    	return true;
	    }

	    public function redirect($page) {
	    	header("location:index.php");
	    }


	    public function allData($table,$uid){

	    	$query = "SELECT * FROM $table where user_id=$uid";
	    	$result = $this->db->query($query) or die($this->db->error);
	    	return $result;
	    }

	    public function insert_books($request){
	    	extract($request);

	    	$query = "INSERT INTO books SET user_id=$user_id,course_name='$course_name', course_number='$course_number', fname='$fname', lname='$lname', description='$description' ";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}
	    }

	    public function insert_tutor($request){
	    	extract($request);

	    	$query = "INSERT INTO tutor SET user_id=$user_id,course_name='$course_name', course_number='$course_number', rating='$rating' ";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}
	    }

	    public function insert_house($request){
	    	extract($request);

	    	$query = "INSERT INTO house SET user_id=$user_id,address='$address', bedroom='$bedroom', bathroom='$bathroom', lease_length='$lease_length', city='$city', state='$state', zipcode='$zipcode', description='$description' ";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}

	    }	

	    public function edit_data($table,$id){

	    	$query = "SELECT * FROM $table WHERE id = $id";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	return $result;

	    }	

	    public function update_books($request){
	    	extract($request);

	    	$query = "UPDATE books set course_name='$course_name',course_number='$course_number',fname='$fname',lname='$lname',description='$description'  WHERE id = '$id'";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}

	    }	

	    public function update_house($request){
	    	extract($request);

	    	$query = "UPDATE house set address='$address',bedroom='$bedroom',bathroom='$bathroom',lease_length='$lease_length',city='$city',state='$state',zipcode='$zipcode',description='$description'  WHERE id = '$id'";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}

	    }	

	    public function update_tutor($request){
	    	extract($request);

	    	$query = "UPDATE tutor set course_number='$course_number',course_name='$course_name',rating='$rating' WHERE id = '$id'";

	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}

	    }	

	    public function delete_row($table,$id){
	    	$query = "DELETE FROM $table where id=$id";
	    	$result = $this->db->query($query) or die($this->db->error);

	    	if($result)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}

	    }	


	}
