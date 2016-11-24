<?php

Class Comite extends CI_Model{
    
    public function set($campo,$valor){
          $this->$campo = $valor;
    }

    public function get($campo){
          return $this->$campo;
    }
}

