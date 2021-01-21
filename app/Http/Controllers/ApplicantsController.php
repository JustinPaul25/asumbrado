<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Agent;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Applicant\ApplicantCollection;
use App\Http\Requests\Applicant\ApplicantStoreRequest;
use App\Http\Resources\Applicant\Applicant as ApplicantResource;

class ApplicantsController extends Controller
{
    public function applyLot(Applicant $applicant, Request $request)
    {
        $balance = $request->input('total_price') - $request->input('downpayment');
        if($request->input('downpayment') == $request->input('total_price')) {
            $status = "Paid";
        } else {
            $status = "Partial Payment" ;
        }

        DB::beginTransaction();
        try {
            if($request->input('id') == '') {
                $lot = Lot::create([
                    'applicant_id' => $applicant->id,
                    'agent_id' => $request->input('agent_id'),
                    'name' => $request->input('lot_name'),
                    'area' => $request->input('area'),
                    'status' => $status,
                    'block_no' => $request->input('block_no'),
                    'lot_no' => $request->input('lot_no'),
                    'total_price' => $request->input('total_price'),
                    'monthly_payment' => $request->input('monthly'),
                    'balance' => $balance,
                    'months' => $request->input('months')
                ]);
            } else {
                $lot = Lot::where('id', $request->input('id'))->first();
                $lot->update([
                    'applicant_id' => $applicant->id,
                    'status' => $status,
                    'agent_id' => $request->input('agent_id'),
                    'monthly_payment' => $request->input('monthly'),
                    'balance' => $balance,
                    'months' => $request->input('months')
                ]);
            }

            $applicant->payments()->create([
                'lot_id' => $lot->id,
                'or_no' => $request->input('or_no'),
                'amount' => $request->input('downpayment')
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        return response()->json($applicant->lots);
    }

    public function list(Request $request)
    {
        $agents = Applicant::query();
        if($request->filled('search')) {
            $agents = Applicant::where('name', 'LIKE', '%'.$request->input('search').'%');
        }
        
        $agents = $agents->paginate(20);
        return new ApplicantCollection($agents);
    }

    public function store(ApplicantStoreRequest $request)
    {
        $amount = 0;
        $balance = 0;
        $amount = $request->input('downpayment');
        $balance = $request->input('total_price') - $request->input('initial_payment');
        if($request->input('initial_payment') >= $request->input('total_price')) {
            $status = 'Paid';
        } else {
            $status = 'Partial';
        }

        DB::beginTransaction();
        try {
            $applicant = Applicant::create([
                'date_applied' => Carbon::now(),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'birth_place' => $request->input('birth_place'),
                'birth_date' => $request->input('birth_date'),
                'email' => $request->input('email'),
                'mobile_number' => $request->input('mobile_number'),
                'occupation' => $request->input('occupation'),
                'employers_name' => $request->input('employers_name'),
                'civil_status' => $request->input('civil_status'),
                'spouse' => $request->input('spouse'),
                'reference_one_name' => $request->input('reference_one_name'),
                'reference_one_address' => $request->input('reference_one_address'),
                'reference_one_mobile_no' => $request->input('reference_one_mobile_no'),
                'reference_one_relationship' => $request->input('reference_one_relationship'),
                'reference_two_name' => $request->input('reference_two_name'),
                'reference_two_address' => $request->input('reference_two_address'),
                'reference_two_mobile_no' => $request->input('reference_two_mobile_no'),
                'reference_two_relationship' => $request->input('reference_two_relationship'),
            ]);

            $agent_id = '';

            if($request->filled('agent_name')) {
                $agent = Agent::create([
                    'name' => $request->input('agent_name'),
                    'rate' => $request->input('agent_rate')
                ]);

                $agent_id = $agent->id;
            }

            $applicant->lots()->create([
                'agent_id' => $agent_id,
                'name' => $request->input('lot_name'),
                'area' => $request->input('area'),
                'status' => $status,
                'block_no' => $request->input('block_no'),
                'lot_no' => $request->input('lot_no'),
                'total_price' => $request->input('total_price'),
                'monthly_payment' => $request->input('monthly_payment'),
                'total_recievable' => $request->input('initial_payment'),
                'balance' => $balance,
                'months' => $request->input('months')
            ]);
            
            $applicant->payments()->create([
                'lot_id' => $applicant->lots[0]->id,
                'or_no' => $request->input('or_no'),
                'amount' => $request->input('initial_payment'),
                'total_recievable' => $request->input('initial_payment'),
                'balance' => $balance
            ]);
        DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        $applicant = new ApplicantResource($applicant);

        return response()->json($applicant);
    }
}
