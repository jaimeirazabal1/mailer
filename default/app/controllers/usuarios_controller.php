<?php 
class UsuariosController extends AppController{
	public function index(){
		$this->usuarios = Load::model("usuarios")->find("columns: usuarios.id, usuarios.login, usuarios.created, roles.role","join: inner join roles on roles.id = usuarios.roles_id");
	}
	public function create(){
		if (Input::haspost("usuarios")) {
			$usuarios = Load::model("usuarios",Input::post("usuarios"));
			$usuarios->password = md5($usuarios->password);
			if ($usuarios->save()) {
				Flash::valid("Usuario Creado");
			}else{
				Flash::error("No se creo el usuario");
			}
			Router::redirect("usuarios/");
		}
	}
	public function edit($id){
		if (Input::haspost("usuarios")) {
			$usuarios = Load::model("usuarios",Input::post("usuarios"));
			$inputs = Input::post("usuarios");
			if (!empty($inputs['password'])) {
				$usuarios->password = md5($usuarios->password);
			}else{
				/*asigno password antigua*/
				$user = Load::model("usuarios")->find($id);
				$usuarios->password = $user->password;
			}
			if ($usuarios->save()) {
				Flash::valid("Usuario Editado");
			}else{
				Flash::error("No se edito el usuario");
			}
			Router::redirect("usuarios/");
		}
		$this->usuarios = Load::model("usuarios")->find($id);
	}
	public function delete($id){
		$usuario = Load::model("usuarios")->find($id);
		if ($usuario->delete()) {
			Flash::valid("Usuario Eliminado");
		}else{
			Flash::error("No se elimino el usuario");
		}
		Router::redirect("usuarios/");
	}
	public function ver($id){
		$this->usuario = Load::model("usuarios")->find($id);
		$this->contactos = Load::model("usuarios_contactos")->find("join: inner join usuarios on usuarios.id = usuarios_contactos.usuarios_id
																		  inner join contactos on contactos.id = usuarios_contactos.contactos_id",
																	"columns: contactos.nombre, contactos.descripcion, contactos.email, contactos.created, contactos.id");
	}
}

 ?>