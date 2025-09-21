<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Http\Requests\IndexFornecedorRequest;
use App\Http\Requests\StoreFornecedorRequest;

class FornecedorController extends Controller
{
    public function store(StoreFornecedorRequest $request)
    {
        $fornecedor = Fornecedor::create($request->validated());

        return response()->json($fornecedor, 201);
    }

    public function index(IndexFornecedorRequest $request)
    {
        $q = $request->get('q', '');
        $validated = $request->validated();

        $q     = $validated['q'] ?? '';
        $limit = $validated['limit'] ?? 10;

        $fornecedores = Fornecedor::where('nome', 'LIKE', "%{$q}%")
            ->orderByDesc('created_at')
            ->paginate($limit);

        return response()->json($fornecedores);
    }
}
