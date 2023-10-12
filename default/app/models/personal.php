<?php
class Personal extends ActiveRecord
{
    public function initialize(){
        $this->belongs_to('Departamentos', 'model: Departamentos', 'fk: departamento_id');
    }
}