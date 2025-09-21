<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFornecedorRequest;

class FornecedorController extends Controller
{
    public function store(StoreFornecedorRequest $request)
    {
        $fornecedor = Fornecedor::create($request->validated());
        return response()->json($fornecedor, 201);
    }

    public function index(Request $request)
    {
        $q = $request->get('q', '');

        $validated = $request->validate([
            'q'      => 'nullable|string|max:255',
            'page'   => 'nullable|integer|min:1',
            'limit'  => 'nullable|integer|min:1|max:100',
        ]);

        $q     = $validated['q'] ?? '';
        $limit = $validated['limit'] ?? 10;

        $fornecedores = Fornecedor::where('nome', 'LIKE', "%{$q}%")
            ->orderByDesc('created_at')
            ->paginate($limit);

        return response()->json($fornecedores);
    }
}
