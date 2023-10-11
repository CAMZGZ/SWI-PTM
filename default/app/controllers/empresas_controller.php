<?php
class EmpresasController extends AppController
{
    //Pagina de inicio
    public function index(){
        $this->title='Empresas';
        $this->empresas = (new Empresas())->find();

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
                Input::delete();
            }
            else{
                
                Flash::error('No se registro correctamente');
                
            }
        }


    }
    
}