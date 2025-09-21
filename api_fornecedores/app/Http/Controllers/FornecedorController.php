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

        $fornecedores = Fornecedor::where('nome', 'LIKE', "%{$q}%")
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();

        return response()->json($fornecedores);
    }
}
