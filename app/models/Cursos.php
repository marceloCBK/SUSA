<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 15/06/14
 * Time: 23:35
 */

class Cursos extends Eloquent {
    protected $table = 'cursos_cur';
    protected $primaryKey = 'id_cur';
    public $timestamps = false;
} 