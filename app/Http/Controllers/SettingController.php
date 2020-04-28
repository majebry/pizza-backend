<?php

namespace App\Http\Controllers;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(
            config('app_settings')
        );
    }
}
