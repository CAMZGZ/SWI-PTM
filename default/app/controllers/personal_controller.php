<?php
class personalController extends AppController
{
    //Pagina de inicio
    public function index(){
        $this->title='personal';
        $this->personal = (new personal())->find();

        // Paso el resultado de la consulta que sera mostrada en el datagrid
        $this->jpersonal = Load::model('personal')->find();

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
        $this->title='Registrar persona';

        if(Input::hasPost('persona')){
            $persona =new personal (Input::post('persona'));
            
            if($persona->create()){
                Flash::valid('persona Guardada');
                Input::delete();
            }
            else{
                
                Flash::error('No se registro correctamente');
                
            }
        }

    }

    //Mostrar desde la base de datos (un elemento en especifico)
    public function show($id){
        
        $this->persona = (new personal())->find($id);
        $this->title='persona';


    }

    //Actualizar un registro
    public function update($id){
        $this->title='Editar';
        $this->persona = (new personal())->find($id);
        
        if(Input::hasPost('persona')){
                      
            if($this->persona->update(Input::post('persona'))){
                Flash::valid('persona Modificada');
                Input::delete();
            }
            else{
                
                Flash::error('No se registro correctamente');
                
            }
        }


    }
    
}