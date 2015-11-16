<?php 
class TestController extends AppController{
	public function index(){
		
		Flash::info("Estamos en la acción {$this->action_name}");
	}
 
	protected function before_filter(){
		// Verificando si el rol del usuario actual tiene permisos para la acción a ejecutar
		if(!$this->acl->is_allowed($this->userRol, $this->controller_name, $this->action_name)){
			Flash::error("Acceso negado");
			return false;
		}
	}
}
 ?>