<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        // $invoices = DB::table('invoices')
        //     ->join('customers', 'invoices.CustomerId', '=', 'customers.CustomerId')
        //     ->orderBy('invoices.InvoiceDate', 'DESC')
        //     ->get();
        // // dd($invoices);

        $invoices = Invoice::with(['customer'])->orderBy('invoices.InvoiceDate', 'DESC')->get();

        return view('invoices/index', [
            'invoices' => $invoices,
            'invoiceCount' => count($invoices),
        ]);
    }

    public function show($invoiceId)
    {

        $invoice = Invoice::with(
            [
                'invoiceItems.track',
                'invoiceItems.track.album',
                'invoiceItems.track.album.artist',
            ]
        )->find($invoiceId);

        return view('invoices/show', [
            'invoice' => $invoice
        ]);
    }
}