<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Services\FornecedorService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FornecedorResource;
use App\Http\Requests\IndexFornecedorRequest;
use App\Http\Requests\StoreFornecedorRequest;

class FornecedorController extends Controller
{
    public function __construct(
        protected FornecedorService $fornecedorService
    ) {}

    public function store(StoreFornecedorRequest $request)
    {
        $fornecedor = $this->fornecedorService->create($request->validated());
        return new FornecedorResource($fornecedor);
    }

    public function index(IndexFornecedorRequest $request)
    {
        $fornecedores = Fornecedor::query()
            ->when($request->q, fn($q) => $q->where('nome', 'like', "%{$request->q}%"))
            ->when($request->email, fn($q) => $q->where('email', $request->email))
            ->when($request->cnpj, fn($q) => $q->where('cnpj', $request->cnpj))
            ->orderByDesc('created_at')
            ->paginate($request->limit ?? 15);

        return FornecedorResource::collection($fornecedores);
    }
}
