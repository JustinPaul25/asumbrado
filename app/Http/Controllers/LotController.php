<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;
use App\Http\Requests\Lot\LotStoreRequest;
use App\Http\Resources\Lot\LotCollection;

class LotController extends Controller
{
    public function checkLot(Request $request)
    {
        $lot = Lot::where('name', 'LIKE', '%'.$request->input('name').'%')
        ->where('block_no', $request->input('block'))
        ->where('lot_no', $request->input('lot'))->first();

        if($lot === null) {
            return response()->json(false);
        } else {
            if($lot->status != '' || $lot->status != null) {
                return response()->json('Not Available');
            } else {
                return response()->json($lot);
            }
        }
    }

    public function List(Request $request)
    {
        $lots = Lot::query();

        if($request->filled('name')) {
            if($request->filled('block')) {
                if($request->filled('lot')) {
                    $lots = Lot::where('name', 'LIKE', '%'.$request->input('name').'%')
                        ->where('block_no', $request->input('block'))
                        ->where('lot_no', $request->input('lot'));
                } else {
                    $lots = Lot::where('name', 'LIKE', '%'.$request->input('name').'%')
                        ->where('block_no', $request->input('block'));
                }
            } else {
                $lots = Lot::where('name', 'LIKE', '%'.$request->input('name').'%');
            }
        }

        $lots = $lots->paginate(20);
        return new LotCollection($lots);
    }

    public function store(LotStoreRequest $request)
    {
        Lot::create([
            'name' => $request->input('name'),
            'area' => $request->input('area'),
            'block_no' => $request->input('block_no'),
            'lot_no' => $request->input('lot_no'),
            'total_price' => $request->input('total_price')
        ]);

        return response()->json('Lot Added');
    }

    public function update(Lot $lot, LotStoreRequest $request)
    {
        $lot->update([
            'name' => $request->input('name'),
            'area' => $request->input('area'),
            'block_no' => $request->input('block_no'),
            'lot_no' => $request->input('lot_no'),
            'total_price' => $request->input('total_price')
        ]);

        return response()->json('Lot updated');
    }

    public function destroy(Lot $lot)
    {
        return response()->json($lot->delete());
    }
}
