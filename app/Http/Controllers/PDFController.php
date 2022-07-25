<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class PDFController extends Controller
{
    public function export_user_pdf(){

        $users = User::all();

        $pdf  = PDF::loadview('RealProgrammer', compact('users')); 
     
        return $pdf->download('realprogrammer.pdf');

    }
}
