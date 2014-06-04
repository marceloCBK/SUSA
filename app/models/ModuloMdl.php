<?php

class ModuloMdl extends Eloquent{
    protected $table = 'susa_modulos_mod';
    protected $primaryKey = 'id_mod';

    public function modulo(){
        return $this->hasMany('ModuloMdl', 'id_fk_mod', 'id_mod')->orderBy('nome_mod');
    }
}
