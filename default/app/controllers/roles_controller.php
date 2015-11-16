<?php 
class RolesController extends AppController{
	public function index(){
		$this->roles = Load::model("roles")->find();
	}
	public function create(){
		if (Input::haspost("roles")) {
			$roles = Load::model("roles",Input::post("roles"));
			$roles->password = md5($roles->password);
			if ($roles->save()) {
				Flash::valid("Role Creado");
			}else{
				Flash::error("No se creo el role");
			}
			Router::redirect("roles/");
		}
	}
	public function edit($id){
		if (Input::haspost("roles")) {
			$roles = Load::model("roles",Input::post("roles"));
			if ($roles->save()) {
				Flash::valid("role Editado");
			}else{
				Flash::error("No se Editó el role");
			}
			Router::redirect("roles/");
		}
		$this->roles = Load::model("roles")->find($id);
	}
	public function delete($id){
		$role = Load::model("roles")->find($id);
		if ($role->delete()) {
			Flash::valid("role Eliminado");
		}else{
			Flash::error("No se elimino el role");
		}
		Router::redirect("roles/");
	}
}

 ?>