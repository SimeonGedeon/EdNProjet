<?php

namespace App\Http\Controllers;

use App\Models\Pensee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pensees = Pensee::pensees()->paginate(3);

        $count = Pensee::where('est_publie', true)->count();
        $pensedujr = Pensee::latest()->first(); // ou ->orderBy('created_at', 'desc')->first()
        $hasPensees = Pensee::exists();

        return view('home', compact('pensees', 'pensedujr', 'hasPensees', 'count'));
    }
}
