<?php

//Används för att göra ett objekt till en array.
class Cart implements ArrayAccess {
	private $container;

	public function __construct($id, $name, $amount, $price){
		$this->container = array($id, $name, $amount, $price);
	}

	//Hämta värdet från arrayen där $key är fältets nummer.
	public function offsetGet ($key) {
        return $this->container[$key];
    }
    //Hämtar hela arrayen.
    public function getCart () {
        return $this->container;
    }

    //Sätt in värden i arrayen där $key är fält och $value är värdet som ska sättas i fältet.
    public function offsetSet($key,$value) {
        $this->container[$key] = $value;
    }

    //Ta bort data från arrayen.
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    //Kollar om data finns i indexet i arrayen.
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
}
?>