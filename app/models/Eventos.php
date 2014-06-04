<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 02/06/14
 * Time: 23:14
 */

class Eventos extends Eloquent {
    protected $table = 'eventos_evt';
    protected $primaryKey = 'id_evt';
    public $timestamps = false;
} 