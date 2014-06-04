<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 23/05/14
 * Time: 23:00
 */
use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableInterface;

class Usuarios extends Eloquent implements UserInterface {
    protected $table = 'susa_usuarios_usr';
    protected $primaryKey = 'id_usr';
    public $timestamps = false;

    protected $hidden = array('senha_usr');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id_usr;
    }

    public function getAuthPassword()
    {
        return $this->senha_usr;
    }
/*
    public function getReminderEmail()
    {
        return $this->email_usr;
    }

    public function setPasswordAttribute($pass){

        $this->attributes['senha_usr'] = Hash::make($pass);

    }*/
} 