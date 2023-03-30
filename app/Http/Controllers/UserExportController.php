<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class UserExportController extends Controller
{
    public function index() {
        $Data = User::select('users.*', 'roles.name')
                        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('name', '=', 'Cashier')->get();
        
        $PDF = PDF::loadview('master.user.export', compact('Data'));
        
        return $PDF->download('Data Cachier.pdf');
    }
}
