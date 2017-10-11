<?php

class User{
	private $username;
	private $user_type;
	private $id;
	private $email;
	private $full_name;
	private $residental_adress;
	private $zip_code;
	private $country;
	private $mobile;
	private $city;
	private $region;

	public function __construct($username, $user_type, $id, $email, $full_name, $residental_adress, $zip_code, $country,  $mobile, $city, $region){
		$this->username = $username;
		$this->user_type = $user_type;
		$this->id = $id;
		$this->email = $email;
		$this->full_name = $full_name;
		$this->residental_adress = $residental_adress;
		$this->zip_code = $zip_code;
		$this->country = $country;
		$this->mobile = $mobile;
		$this->city = $city;
		$this->region = $region;
	}

	// Medlemsfunktioner
	public function Set_name($username){
		$this->username = $username;
	}
	public function Set_type($user_type){
		$this->user_type = $user_type;
	}
	public function Set_id($id){
		$this->id = $id;
	}
	public function Set_email($email){
		$this->email = $email;
	}
	public function Set_full_name($full_name){
		$this->full_name = $full_name;
	}
	public function Set_residental($residental_adress){
		$this->residental_adress = $residental_adress;
	}
	public function Set_zip_code($zip_code){
		$this->zip_code = $zip_code;
	}
	public function Set_country($country){
		$this->country = $country;
	}
	public function Set_mobile($mobile){
		$this->mobile = $mobile;
	}
	public function Set_city($city){
		$this->city = $city;
	}
	public function Set_region($region){
		$this->region = $region;
	}

	public function Get_name(){
		return $this->username;
	}
	public function Get_type(){
		return $this->user_type;
	}
	public function Get_id(){
		return $this->id;
	}
	public function Get_email(){
		return $this->email;
	}
	public function Get_full_name(){
		return $this->full_name;
	}
	public function Get_residental(){
		return $this->residental_adress;
	}
	public function Get_zip_code(){
		return $this->zip_code;
	}
	public function Get_country(){
		return $this->country;
	}
	public function Get_mobile(){
		return $this->mobile;
	}
	public function Get_city(){
		return $this->city;
	}
	public function Get_region(){
		return $this->region;
	}


}
?>