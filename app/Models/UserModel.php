<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $allowedFields = [
        'nombre', 'user', 'Password', 'correo', 'estado', 'rol', 'dui'
    ];

    public function getUserByUsername(string $username)
    {
        return $this->where('user', $username)
                    ->where('estado', 1) // assuming 1 = active user
                    ->first();
    }
}