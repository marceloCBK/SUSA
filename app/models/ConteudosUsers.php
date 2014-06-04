<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 28/05/14
 * Time: 21:52
 */

class ConteudosUsers extends Eloquent {
    protected $table = 'conteudos_usuarios_cus';
    protected $primaryKey = 'id_cus';
    public $timestamps = false;

    public function conteudos(){
        return $this->belongsTo('Conteudos', 'id_con_cus', 'id_con');
    }
} 