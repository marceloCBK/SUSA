<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 31/05/14
 * Time: 16:15
 */

class Arquivos extends Eloquent {
    protected $table = 'arquivos_arq';
    protected $primaryKey = 'id_arq';
    public $timestamps = false;

    public function conteudo(){
        return $this->belongsTo('Conteudo', 'id_fk_arq', 'id_arq');
    }
} 