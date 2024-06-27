<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     private $pagamentos= ['C'=>'Credito','D'=>'Debito','P'=> 'Pixe','Di'=> 'Dinheiro'];

    public function toArray(Request $request): array
    {
        $status = $this->status;
        return [
            
            'cliente' => [
                'nome' => $this->cliente->nome,
                'telefone' => $this->cliente->telefone,
                'email' => $this->cliente->email,
            ],
            'profissional' => [
                'nome' => $this->profissional->nome,
                'telefone' => $this->profissional->telefone,
                'email' => $this->profissional->email,
            ],
            'servico'=>[
                'tipo' =>$this->servico->tipo,
                'descricao' =>$this->servico->descricao,
                'duracao' =>$this->servico->duracao,
            ],
            'id'=>$this->id,
            'data'=> Carbon::parse($this->data)->format('d/m/Y'),
            'horas'=>Carbon::parse($this->hora)->format('H:i'),
            'pagamento'=> $this->pagamentos[$this->pagamento],
            'valor'=> 'R$'.number_format($this->preco,2, ',', '.'),
            'status_pagamento'=> $status ? 'Pago' : 'Não Pagou',
            'data_pagamento'=>$status ? Carbon::parse($this->data_pagamento)->format('d/m/Y H:i:s') : null,
            'paymer'=>$status ? Carbon::parse($this->data_pagamento)->diffForHumans() : null,
        ];
    }
}
