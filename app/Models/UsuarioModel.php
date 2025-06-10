<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    protected $allowedFields = ['nombre', 'user', 'Password', 'correo', 'estado', 'rol', 'dui', 'created_at', 'updated_at', 'last_login'];
    protected $useTimestamps = true;
}
