<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Applicant;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Lot $lot, Request $request)
    {
        beginTransaction();
        try {
            $applicant = Applicant::where('id', $lot->applicant_id)->first();

            $balance = $lot->balance - $request->input('amount');
            $recievable = $lot->total_recievable + $request->input('amount');
            if($request->input('amount') >= $lot->balance) {
                $lot_status = 'Paid';
            } else {
                $lot_status = 'Partial Payment';
            }

            $applicant->payments()->create([
                'lot_id' => $lot->id,
                'or_no' => $request->input('or_no'),
                'amount' => $request->input('amount'),
                'balance' => $balance,
                'total_recievable' => $recievable
            ]);

            $lot->update([
                'balance' => $balance,
                'total_recievable' => $recievable,
                'status' => $lot_status
            ]);

            commit();
        } catch (Exception $e) {
            rollback();
            throw $e;
        }

        return response()->json($applicant->lots);
    }
}
