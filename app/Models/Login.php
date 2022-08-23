<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Login extends Authenticatable implements JWTSubject // Model
{
    use HasFactory, Notifiable;

    protected $table      = 'login';
    protected $primaryKey = 'ID_Login';
    protected $fillable   = [
        'Usuario', 'Contrasena', 'Fecha_Creacion_Login','Estado_Login', 'ID_Empleado'
    ];
    public $timestamps = false;

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function getAuthPassword()
    {
        return $this->Contrasena;
    }
}
