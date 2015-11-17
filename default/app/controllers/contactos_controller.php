<?php 
class ContactosController extends AppController{
	public function create($id){
		if ($id) {
			if (Input::haspost("contactos")) {
				$contacto = Load::model("contactos",Input::post("contactos"));
				if ($contacto->save()) {
					Flash::valid("Contacto Creado");
					$usuario_contacto = Load::model("usuarios_contactos");
					$usuario_contacto->usuarios_id = $id;
					$usuario_contacto->contactos_id = Load::model("contactos")->last_id();
					if ($usuario_contacto->save()) {
						$usuario = Load::model("usuarios")->find($id);
						Flash::valid("Contacto Agregado a Usuario ".$usuario->login);
					}else{
						Flash::error("No se agrego el contacto al usuario ".$usuario->login);
					}
				}else{
					Flash::valid("No se creó el contacto");
				}
			}
		}
		$this->usuario = Load::model("usuarios")->find($id);
	}
	public function usuario($id){
		$this->usuario = Load::model("usuarios")->find($id);
		$this->contactos = Load::model("usuarios_contactos")->find("join: inner join usuarios on usuarios.id = usuarios_contactos.usuarios_id
																		  inner join contactos on contactos.id = usuarios_contactos.contactos_id",
																	"columns: contactos.nombre, contactos.descripcion, contactos.email, contactos.created, contactos.id",
																	"conditions: usuarios_id = '$id'");		
	}
	public function miscontactos(){
		if (Auth::is_valid()) {
			# code...
			$id = Auth::get("id");
			$this->usuario = Load::model("usuarios")->find($id);
			$this->contactos = Load::model("usuarios_contactos")->find("join: inner join usuarios on usuarios.id = usuarios_contactos.usuarios_id
																			  inner join contactos on contactos.id = usuarios_contactos.contactos_id",
																		"columns: contactos.nombre, contactos.descripcion, contactos.email, contactos.created, contactos.id",
																		"conditions: usuarios_id = '$id'");	
		}else{
			Flash::warning("Usuario no autenticado");
			Router::redirect("index/login");
		}
	}
}


 ?>