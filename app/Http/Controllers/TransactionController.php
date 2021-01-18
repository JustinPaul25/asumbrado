<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\Transaction\TransactionCollection;

class TransactionController extends Controller
{
    public function income()
    {
        return response()->json(Payment::sum('amount'));
    }

    public function applicantList(Request $request)
    {
        $transactions = Payment::where('applicant_id', $request->input('applicant_id'))->paginate(20);
        return new TransactionCollection($transactions);
    }

    public function list(Request $request)
    {
        $transactions = Payment::query();
        if($request->input('type') == 'specific') {
            if($request->filled('date')) {
                $transactions = Payment::whereDate('created_at', '=', date($request->input('date')));
            }
        } else {
            if($request->filled('to') && $request->filled('from')) {
                $transactions = Payment::whereBetween('created_at', [date($request->input('from')), date($request->input('to'))]);
            }
        }
        
        $transactions = $transactions->paginate(20);

        return new TransactionCollection($transactions);
    }

    public function lot(Lot $lot)
    {
        return response()->json($lot->payments);
    }

    public function print($type, $from = null, $to = null)
    {
        $transactions = Payment::query();
        $date = date("d-M-Y");

        if($type == 'specific') {
            if($from == !null) {
                $date = $from;
                $transactions = Payment::whereDate('created_at', '=', date($from));
            }
        } else {
            $date = $from.' ~ '.$to;
            $transactions = Payment::whereBetween('created_at', [date($from), date($to)]);    
        }

        $datas = $transactions->orderBy('created_at', 'DESC')->get();

        return view('transaction-print', compact('datas', 'date'));
    }
}
