<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResouce;
use App\Models\Clientes;
use App\Traits\HttpResponse;
use Illuminate\Foundation\Console\CliDumper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    use HttpResponse;
    public function index()
    {
        return ClienteResouce::collection(Clientes::all());
    }

    
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'nome'=> 'required|string|max:255',
            'telefone'=> 'required| string| max:15',
            'email'=> 'required|email|string|max:255'

        ]);

        if($validator->fails()){
             return $this->error('Data Invalid', 422, $validator->errors());
         }

        $create= Clientes::create($validator->validate());

        if($create){
            return $this->response('Cliente created', 200,  new ClienteResouce($create));
        }
        
        return $this->error('Cliente not created', 400, $create);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ClienteResouce(Clientes::where('id',$id)->first());
    }

    public function update(Request $request, $id)
    {
        
        $validator= Validator::make($request->all(),[
            'nome'=> 'required|string|max:255',
            'telefone'=> 'required| string| max:15',
            'email'=> 'required|email|string|max:255'

        ]);

     

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }
        
        $validated = $validator->validate();

        $clientes= Clientes::find($id);

        $updated= $clientes->update([
            'nome'=> $validated['nome'],
            'telefone'=> $validated['telefone'],
            'email'=> $validated['email'],
        ]);

        if ($updated) {
            return $this->response('Cliente update success', 200,  new ClienteResouce($clientes));
        }
        return $this->error('Cliente not update', 400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clientes = Clientes::find($id);

        $deleted= $clientes->delete();

        if ($deleted) {
            return $this->response('Cliente deleted success', 200);
        }
        return $this->response('Cliente not deleted', 200);
    }
}
