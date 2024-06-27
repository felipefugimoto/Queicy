<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgendamentoResource;
use App\Models\Agendamento;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendamentoController extends Controller
{
    use HttpResponse;
    public function index()
    {
        return AgendamentoResource::collection(Agendamento::all());
    }


    
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'cliente_id'=> 'required',
            'servico_id'=> 'required',
            'profissional_id'=> 'required',
            'data'=> 'required|date_format:Y-m-d',
            'hora'=> 'required|date_format:H:i',
            'status'=> 'required|numeric|between:0,1',
            'pagamento'=> 'required|max:2',
            'preco'=> 'required|numeric',
            'data_pagamento'=> 'nullable|date_format:Y-m-d H:i:s'

        ]);

        if($validator->fails()){
             return $this->error('Data Invalid', 422, $validator->errors());
         }

         $create= Agendamento::create($request->all());

         if($create){
            return $this->response('Agenda created', 200,  new AgendamentoResource($create));
        }
        
        return $this->error('Agenda not created', 400, $create);

    }

    public function show($id)
    {
        return new AgendamentoResource(Agendamento::where('id',$id)->first());
    }

  
    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'cliente_id'=> 'required',
            'servico_id'=> 'required',
            'profissional_id'=> 'required',
            'data'=> 'required|date_format:Y-m-d',
            'hora'=> 'required|date_format:H:i',
            'status'=> 'required|numeric|between:0,1',
            'pagamento'=> 'required|max:2',
            'preco'=> 'required|numeric',
            'data_pagamento'=> 'nullable|date_format:Y-m-d H:i:s'

        ]);

        if($validator->fails()){
             return $this->error('Data Invalid', 422, $validator->errors());
         }

         $validated = $validator->validate();

         $agendamento = Agendamento::find($id);

         $updated = $agendamento->update([
            'cliente_id'=>  $validated['cliente_id'],
            'servico_id'=> $validated['servico_id'] ,
            'profissional_id'=> $validated['profissional_id'] ,
            'data'=>  $validated['data'],
            'hora'=> $validated['hora'] ,
            'status'=>  $validated['status'],
            'pagamento'=>  $validated['pagamento'],
            'preco'=> $validated['preco'] ,

         ]);

         if ($updated) {
            return $this->response('Agendamento update success', 200,  new AgendamentoResource($agendamento));
        }
        return $this->error('Agendamento not update', 400);

    }

    
    public function destroy($id)
    {
        $agendamento = Agendamento::find($id);

        $deleted= $agendamento->delete();

        if ($deleted) {
            return $this->response('Agendamento deleted success', 200);
        }
        return $this->response('Agendamento not deleted', 200);
    }
}
