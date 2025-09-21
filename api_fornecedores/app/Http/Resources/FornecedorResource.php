<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FornecedorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nome'       => $this->nome,
            'cnpj'       => $this->cnpj,
            'email'      => $this->email,
            'criado_em'  => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
