<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Asegúrate de que el usuario esté logueado (AuthFilter ya debería haberlo hecho, pero es una doble verificación)
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Por favor, inicia sesión para acceder a esta página.');
            return redirect()->to('/login');
        }

        // Verifica si el rol del usuario es 'admin'
        if (session()->get('rol') !== 'admin') {
            // Si no es admin, redirige a una página de error o al dashboard normal
            session()->setFlashdata('error', 'No tienes permisos para acceder a esta sección.');
            return redirect()->to('/dashboard'); // O a una página de "Acceso Denegado"
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita hacer nada después de la petición
    }
}