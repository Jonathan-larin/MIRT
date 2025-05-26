<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // --- Mock values (replace with real DB queries or models) ---
        $data = [
            'inventory_value' => 154000,
            'available_motorcycles' => 12,
            'rented_motorcycles' => 8,
            'low_inventory_alerts' => 3,
            'pending_orders' => 4,
            'pending_maintenance' => 2,
            'current_date' => strftime('%e de %B, %Y')
        ];

        return view('dashboard', $data);
    }
}
