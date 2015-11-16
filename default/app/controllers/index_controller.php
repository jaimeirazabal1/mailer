<?php

/**
 * Controller por defecto si no se usa el routes
 * 
 */
Load::models("usuarios");
class IndexController extends AppController
{

    public function index()
    {
        
    }
    public function blank(){

    }
    public function buttons(){

    }
    public function flot(){

    }
    public function forms(){

    }
    public function grid(){

    }
    public function icons(){

    }
    public function login(){
        View::template('login');
        $usuarios = new Usuarios();
        if (Input::post("usuarios")) {
            # code...
            $pwd = $usuarios->cript(Input::post("usuarios")['clave']);
            $usuario = Input::post("usuarios")['nombre'];

            $auth = new Auth("model", "class: usuarios", "nombre: $usuario", "clave: $pwd");
            if ($auth->authenticate()) {
                View::template('default');
                Router::redirect("index/index");
            } else {
                Flash::error("Falló");
            }
        }
    }
    public function newuser(){
        View::template("login");
        if (Input::post("usuarios")) {
            $post_usuarios = Input::post("usuarios");
            if ($post_usuarios['clave'] != $post_usuarios['clave2']) {
                Flash::error("Las Claves no coinciden");
                return;
            }
            $new_user = new Usuarios(Input::post("usuarios"));
            /*usuario por default*/
            $new_user->clave = $new_user->cript($new_user->clave);
            $new_user->rol = "C";
            if ($new_user->save()) {
                Flash::valid("Usuario Creado!");
            }else{
                Flash::error("No se Creó el Usuario");
            }
        }

    }
    public function get_empresas(){
        $tags = Load::model("usuarios")->find("columns: empresa","group: empresa");
        $array_tags = array();
        foreach ($tags as $key => $value) {
            $array_tags[] = $value->empresa;
        }
        View::select(null,"json");
        $this->data = $array_tags;  
    }
    public function logout(){
        Auth::destroy_identity();
        Router::redirect("index/login");
    }
    public function morris(){

    }
    public function notifications(){

    }
    public function panels_wells(){

    }
    public function tables(){

    }
    public function typography(){
    	
    }

}
