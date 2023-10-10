<?php
 
class EmpresasController extends AppController
{
    public function index(){
        $this->empresas = (new Empresas())->find();
        
    }

    public function create(){
        if(Input::hasPost('empresa')){
            $empresa =new Empresas (Input::post('empresa'));
            
            if($empresa->create()){
                Flash::valid('Empresa Guardada');
                Input::delete();
            }
            else{
                
                Flash::error('No se registro correctamente');
                
            }
        }

    }
    public function show(){

    }
    
}