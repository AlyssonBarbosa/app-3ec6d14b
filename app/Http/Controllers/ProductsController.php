<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            Product::create($request->input());
            DB::commit();

            return $this->response([], 'Produto criado com sucesso!', 201);
        } catch (\Throwable $th) {            
            DB::rollback();
            $this->response($th, 'Não foi possível cadastrar o produto!', 400);
        }
    }
}
