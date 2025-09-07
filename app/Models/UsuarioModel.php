<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    protected $allowedFields = ['nombre', 'user', 'Password', 'correo', 'estado', 'rol', 'dui'];
    protected $useTimestamps = true;
}
