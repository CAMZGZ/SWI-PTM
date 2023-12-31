<?php
class PersonalController extends AppController
{
    //Pagina de inicio
    public function index(){
        $this->title='Personal';
        $this->personal = (new personal())->find("conditions: estatus='1'");

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
        $this->title='Registrar Persona';
        $this->departamentos = (new departamentos())->find("conditions: estatus='1'");

        if(Input::hasPost('persona')){
            $persona =new personal (Input::post('persona'));
            
            if($persona->create()){
                Flash::valid('Persona Guardada');
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
        $this->title='Persona';


    }

    //Actualizar un registro
    public function update($id){
        $this->title='Editar';
        $this->persona = (new personal())->find($id);

        $this->departamentos = (new departamentos())->find("conditions: estatus='1'");
        
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

    //Eliminar (desactivar personal)

    public function eliminar($id){

        $persona = new Personal();
    $persona->find_first($id);
    $persona->estatus = 0;
    $persona->update();
    return Redirect::to('personal');
            
    }

    //Pagina que muestra personal dado de baja
    public function bajas(){
        $this->title='Bajas';
        $this->personal = (new personal())->find("conditions: estatus='0'");
	
    }

      //Reactivar personal

    public function reactivar($id){
    $persona = new Personal();
    $persona->find_first($id);
    $persona->estatus = 1;
    $persona->update();
    return Redirect::to('personal');
            
    }
    
}