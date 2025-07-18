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
    
        // $agents = Agent::all()->filter(fn($a) => $a->active);//filters data

     
        // $agents = Agent::where('active', true)->orderBy('name')->get();

        // $agents = Agent::limit(10)->get();//result limiting

      
        // Agent::chunk(100, function ($agents) {
        //     foreach ($agents as $agent) {
        //        
        //     }
        // });

   
        // foreach (Agent::cursor() as $agent) {
        //
        // }
         // $agent = Agent::firstOrCreate(
        //     ['code_name' => $data['code_name']],
        //     ['name' => $data['name'], 'active' => $data['active'] ?? true]
        // );
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
