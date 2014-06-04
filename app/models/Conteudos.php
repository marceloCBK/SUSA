<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 23/05/14
 * Time: 23:00
 */

class Conteudos extends Eloquent {
    protected $table = 'conteudos_con';
    protected $primaryKey = 'id_con';
    public $timestamps = false;

    public function autores(){
        return $this->hasMany('ConteudosUsers', 'id_con_cus', 'id_con');
    }
    public function arquivos(){
        return $this->hasMany('Arquivos', 'id_fk_arq', 'id_con');
    }
} 