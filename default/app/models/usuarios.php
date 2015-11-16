<?php 
class Usuarios extends ActiveRecord{
	protected function initialize(){
    	$this->validates_uniqueness_of("nombre");
   	}
	public function cript($password){
		return md5($password);
	}
}

 ?>