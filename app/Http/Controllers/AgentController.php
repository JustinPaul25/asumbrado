<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Resources\Agent\AgentCollection;

class AgentController extends Controller
{
    public function listSelect()
    {
        return new AgentCollection(Agent::all());
    }

    public function list(Request $request)
    {
        $agents = Agent::query();
        if($request->filled('search')) {
            $agents = Agent::where('name', 'LIKE', '%'.$request->input('search').'%');
        }
        
        $agents = $agents->paginate(20);
        return new AgentCollection($agents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:agents|max:255',
        ]);

        Agent::create([
            'name' => $request->input('name')
        ]);

        return response()->json('agent saved!');
    }

    public function update(Agent $agent, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:agents,name,' . $agent->id,
        ]);

        $agent->update([
            'name' => $request->input('name')
        ]);

        return response()->json('updated successfully');
    }

    public function destroy(Agent $agent)
    {
        return response()->json(
            $agent->delete()
        );
    }
}
