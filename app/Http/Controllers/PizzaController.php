<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPizzaRequest;
use App\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetPizzaRequest $request)
    {
        $pizzas = Pizza::query();

        // filter with specific ids if needed
        $pizzas->when(array_key_exists('ids', $request->validated()), function($query) use ($request) {
            $query->whereIn('id', $request->validated()['ids']);
        });

        // paginate results if needed
        if ($request->per_page) {
            $response = $pizzas->paginate($request->per_page);
        }

        // or just return a list
        else {
            $response = ['data' => $pizzas->get()];
        }

        return response()->json($response);
    }
}
