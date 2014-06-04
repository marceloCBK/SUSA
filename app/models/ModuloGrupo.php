<?php

class ModuloGrupo extends Eloquent{
    protected $table = 'susa_modulos_grupo_mod';
    protected $primaryKey = 'id_mog';
    public $timestamps = false;
    /*
        public function categoria(){
            return $this->belongsTo('CategoriaMdl', 'id_cat_con', 'id_cat');
        }

        public function fotoGaleria(){
            return $this->belongsTo('FotoGaleriaMdl', 'id_con', '_fk_gft');
        }


        public function uploads(){
            return $this->hasMany('UploadsMdl', 'id_fk_upl');
        }
    */
}
