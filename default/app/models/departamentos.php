<?php
class Departamentos extends ActiveRecord
{
    public function initialize(){
        $this->has_many('Personal', 'model: Personal', 'fk: departamento_id');
    }
}