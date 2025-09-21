<?php

namespace App\Services;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class FornecedorService
{
    public function sanitizeCnpj(string $cnpj): string
    {
        return preg_replace('/\D/', '', $cnpj);
    }

    public function create(array $data): Fornecedor
    {
        return DB::transaction(function () use ($data) {
            $data['cnpj'] = $this->sanitizeCnpj($data['cnpj']);

            if (strlen($data['cnpj']) !== 14) {
                throw ValidationException::withMessages([
                    'cnpj' => 'CNPJ inválido.',
                ]);
            }

            return Fornecedor::create($data);
        });
    }
}
