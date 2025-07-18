<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;

use App\Traits\ResponseTrait;

class AgentController extends Controller
{
    use ResponseTrait;
 public function index()
    {
        $agents = Agent::all();
        return self::responseJSON($agents);
    }
       public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'code_name' => 'required|string|unique:agents',
            'active' => 'boolean',
        ]);

        $agent = Agent::create($validated);
        return self::responseJSON($agent, "created", 201);
    }

       public function show($id)
    {
        $agent = Agent::find($id);
        if (!$agent) {
            return $this->fail("Agent not found", "error", 404);
        }

        return self::responseJSON($agent);
    }

    public function update(Request $request, $id)
    {
        $agent = Agent::find($id);
        if (!$agent) {
            return $this->fail("Agent not found", "error", 404);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'code_name' => 'sometimes|string|unique:agents,code_name,' . $id,
            'active' => 'boolean',
        ]);

        $agent->update($validated);
        return self::responseJSON($agent);
    }
      public function destroy($id)
    {
        $agent = Agent::find($id);
        if (!$agent) {
            return $this->fail("Agent not found", "error", 404);
        }

        $agent->delete();
        return self::responseJSON("Agent deleted");
    }


}
