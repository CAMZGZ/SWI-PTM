<?php
class EmpresasController extends AppController
{
    //Pagina de inicio
    public function index(){
        $this->title='Empresas';
        $this->empresas = (new Empresas())->find("conditions: estatus='1'");

        // Paso el resultado de la consulta que sera mostrada en el datagrid
        $this->jEmpresas = Load::model('empresas')->find();

        /* paso un array con los campos que quiero mostrar en la datagrid
        *  El key de cada campo del ser el nombre a mostrarse en el tr de la tabla
        *  El value el campo de la tabla
        */ 
        $this->json = array('id' => 'id',
        'razon_social' => 'razon_social',
        'rfc' => 'rfc');
	
    }

    //Registrar en base de datos
    public function create(){
        $this->title='Registrar Empresa';

        if(Input::hasPost('empresa')){
            $empresa =new Empresas (Input::post('empresa'));
            
            if($empresa->create()){
                Flash::valid('Empresa Guardada');
                Input::delete();
                return Redirect::to('empresas');
            }
            else{
                
                Flash::error('No se registro correctamente');
                
            }
        }

    }

    //Mostrar desde la base de datos (un elemento en especifico)
    public function show($id){
        
        $this->empresa = (new Empresas())->find($id);
        $this->title='Empresa';


    }

    //Actualizar un registro
    public function update($id){
        $this->title='Editar';
        
        $this->empresa = (new Empresas())->find($id);
        if(Input::hasPost('empresa')){
                      
            if($this->empresa->update(Input::post('empresa'))){
                
                Flash::valid('Empresa Modificada');
                return Redirect::to('empresas');
                Input::delete();
            }
            else{
                
                Flash::error('No se registro correctamente');
                
            }
        }


    }

    public function eliminar($id){

        $empresa = new Empresas();
    $empresa->find_first($id);
    $empresa->estatus = 0;
    $empresa->update();
    return Redirect::to('empresas');

        //$sql = "UPDATE empresa SET estatus = 0 WHERE id = $id";
        //$this->empresa = (new Empresas())->find($id);
        //$this->empresa->update(Input::post($sql));
        //return Redirect::to('empresas');
            
    }
        //Pagina que muestra empresas dadas de baja
        public function bajas(){
            $this->title='Bajas';
            $this->empresas = (new empresas())->find("conditions: estatus='0'");
        
        }
    
          //Reactivar personal
    
        public function reactivar($id){
        $empresa = new Empresas();
        $empresa->find_first($id);
        $empresa->estatus = 1;
        $empresa->update();
        return Redirect::to('empresas');
                
        }
}