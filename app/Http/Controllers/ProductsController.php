<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidValueException;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateQuantity;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function updateQuantityOnlySku(ProductUpdateQuantity $request, string $sku)
    {
        try {
            $quantity = $request->quantity;

            $product = Product::where('sku', $sku)->first();

            if (!$product) {
                throw new ModelNotFoundException("Product not found");
            }
            
            if ($product->quantity + $quantity < 0) {
                throw new InvalidValueException("Value is higher than allowed");
            }

            $product->update(['quantity' => $product->quantity + $request->quantity]);

            return $this->response($product, "Quantidade atualizada com sucesso", 200);
            
        } catch (ModelNotFoundException | InvalidValueException $exception) {
            return $this->response($exception->getMessage(), "Não foi possivel processar esta operação", 400);
        } catch (\Throwable $th) {
            return $this->response($th, "Erro no servidor", 500);
        }
    }
}
