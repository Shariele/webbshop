<?php

class Cart{
	private $id;
	private $name;
	private $amount;
	private $price;
	private $cart;

	public function __construct($id, $name, $amount, $price){
		$this->id = $id;
		$this->name = $name;
		$this->amount = $amount;
		$this->price = $price;
	}

	// Medlemsfunktioner
	public function id($id){
		$this->id = $id;
	}
	public function Set_name($name){
		$this->name = $name;
	}
	public function Set_amount($amount){
		$this->amount = $amount;
	}
	public function Set_price($price){
		$this->price = $price;
	}
	public function Set_cart($cart){
		for($i = 0; $i <= $cart->Length + 1; $i++){
			if(empty($cart[$i])){
				$cart[$i] = array(
					array($id, $name, $amount, $price)
				);
			}
		}
	}

	public function Get_id(){
		return $this->id;
	}
	public function Get_name(){
		return $this->name;
	}
	public function Get_amount(){
		return $this->amount;
	}
	public function Get_price(){
		return $this->price;
	}
	public function Get_cart(){
		return $this->cart;
	}
}


?>

