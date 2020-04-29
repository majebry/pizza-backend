<?php

namespace App\Http\Controllers;

use App\Order;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = Order::with(['client', 'items'])->latest();

        // filter with client name when given
        $orders->when($request->client_name, function ($query) use ($request) {
            $query->whereHas('client', function ($clientQuery) use ($request) {
                $clientQuery->where('name', 'LIKE', "%{$request->client_name}%");
            });
        });

        // filter with client phone when given
        $orders->when($request->client_phone, function ($query) use ($request) {
            $query->whereHas('client', function ($clientQuery) use ($request) {
                $clientQuery->where('phone', 'LIKE', "%{$request->client_phone}%");
            });
        });

        $response = $orders->paginate();

        $response->getCollection()->transform(function ($order) {
            return [
                'id'                =>  $order->id,
                'client_name'       =>  $order->client->name,
                'client_address'    =>  $order->client->address,
                'client_phone'      =>  $order->client->phone,
                'total_price'       =>  $order->total_price,
                'currency'          =>  $order->currency,
                'created_at'        =>  $order->created_at->diffForHumans()
            ];
        });

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
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
        $order = $client->orders()->create([
            'delivery_cost' => config('app_settings.delivery_cost'),
            'currency' => $request->currency
        ]);

        foreach ($request->cart_items as $item) {
            $pizza = Pizza::findOrFail($item['pizzaId']);
            $pizzaPrice = $request->currency === 'usd' ? $pizza->price_in_usd : $pizza->price_in_euro;

            $order->items()->save(new OrderItem([
                'pizza_id'   => $item['pizzaId'],
                'sold_price' => $pizzaPrice,
                'quantity'   => $item['quantity']
            ]));
        }

        return response()->json($order->load('items'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(
            Order::with('client', 'items.pizza')->findOrFail($id)
        );
    }
}
