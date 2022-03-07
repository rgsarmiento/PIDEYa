<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Poduct;
use App\Http\Requests\StorePoductRequest;
use App\Http\Requests\UpdatePoductRequest;

class PoductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return [
            'success' => true,
            'message' => 'creada/actualizada con éxito',
            'products' => '',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePoductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePoductRequest $request)
    {
       
        $products = $request->products;

        Poduct::where('company_id', $products[0]["company_id"])->delete();
                
        if (count($products) > 0) {
            foreach ($products as $key) {
                $product = new Poduct();
                $product->code = $key['code'];
                $product->description = $key['description'];
                $product->company_id = $key['company_id'];
                $product->price = $key['price'];
                $product->base_quantity = $key['base_quantity'];
                $product->stocks = $key['stocks'];
                $product->save();
            }
            return [
                'success' => true,
                'message' => 'Productos importados con éxito',            
            ];
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poduct  $poduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poduct  $poduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Poduct $poduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoductRequest  $request
     * @param  \App\Models\Poduct  $poduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePoductRequest $request, Poduct $poduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poduct  $poduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poduct $poduct)
    {
        //
    }
}
