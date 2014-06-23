<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 15/06/14
 * Time: 23:35
 */

class Comentarios extends Eloquent {
    protected $table = 'comentarios_com';
    protected $primaryKey = 'id_com';
    public $timestamps = false;

    public function conteudo(){
        return $this->belongsTo('Conteudo', 'id_con_com', 'id_con');
    }

    public function usuario(){
        return $this->belongsTo('Usuarios', 'id_usr_com', 'id_usr');
    }
} 