<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Hotel;
use App\Models\Product;
use App\Models\TransportService;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $totalContracts = Contract::count();
        $totalUsers = User::count();
        $totalHotel = Hotel::count();
        $totalTransportService = TransportService::count();
        
        // Fetch all contracts
        $contracts = Contract::orderBy('id', 'desc')->get(); // Execute the query to get the contracts
    
        return view('admin.index', [
            'totalContracts' => $totalContracts,
            'totalUsers' => $totalUsers,
            'totalHotel' => $totalHotel,
            'totalTransportService' => $totalTransportService,
            'contracts' => $contracts, // Pass the retrieved contracts to the view
        ]);
    }
    

    public function home() {
        
        return view('home.index');
    }

    
}
