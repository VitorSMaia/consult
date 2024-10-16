<?php

namespace App\Http\Controllers;

use Dompdf\Options;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        $pdf = PDF::loadView('pdf', $data);
        $options = new Options();
        $options->set('isJavascriptEnabled', TRUE);
        return $pdf->download('document.pdf');
    }
}
