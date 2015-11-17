<?php 
Class MensajesController extends AppController{
	public function index($id = null){
		if ($id) {
			$this->usuario = Load::model("usuarios")->find($id);
			$this->mensajes = Load::model("mensajes")->find("usuarios_id='".$id."'");
		}else{
			$this->mensajes = Load::model("mensajes")->find("usuarios_id='".Auth::get('id')."'");
		}
	}
	public function create(){
		if (Input::haspost("mensajes")) {
			$mensaje = Load::model("mensajes",Input::post("mensajes"));
			$mensaje->usuarios_id = Auth::get('id');
			if ($mensaje->save()) {
				Flash::valid("Mensaje Guardado");
			}else{
				Flash::error("No se agrego el mensaje");
			}
		}
	}
	public function edit($id){
		if (Input::haspost("mensajes")) {
			$mensaje = Load::model("mensajes",Input::post("mensajes"));
			$mensaje->usuarios_id = Auth::get('id');
			if ($mensaje->save()) {
				Flash::valid("Mensaje Editado");
				Router::redirect("mensajes/ver/{$mensaje->id}");
			}else{
				Flash::error("No se actualizo el mensaje");
			}
		}
		$this->mensajes = Load::model('mensajes')->find($id);		
	}
	public function ver($id){
		$this->mensaje = Load::model("mensajes")->find($id);
	}
}

 ?>