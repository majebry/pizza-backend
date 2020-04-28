<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Client;
use App\OrderItem;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderRequest $request)
    {
        // select the client if already existed, otherwise create a new one
        $client = Client::where('phone', $request->phone)->first();

        if (! $client) {
            $client = new Client();
            $client->phone = $request->phone;
        }

        $client->name = $request->name;
        $client->address = $request->address;

        $client->save();

        // create the order
        $order = $client->orders()->create();

        foreach ($request->cart_items as $item) {
            $pizza = Pizza::findOrFail($item['pizzaId']);
            $pizzaPrice = $request->currency === 'usd' ? $pizza->price_in_usd : $pizza->price_in_euro;

            $order->items()->save(new OrderItem([
                'pizza_id'   => $item['pizzaId'],
                'sold_price' => $pizzaPrice,
                'currency'   => $request->currency,
                'quantity'   => $item['quantity']
            ]));
        }

        return response()->json($order->load('items'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
