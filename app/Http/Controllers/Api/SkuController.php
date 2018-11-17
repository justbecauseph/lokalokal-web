<?php

namespace LokaLocal\Http\Controllers\Api;

use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;
use LokaLocal\Sku;

class SkuController extends Controller
{
    public function index()
    {
        return Sku::all();
    }

    public function show($id)
    {
        return Sku::where('code', $id)->firstOrFail();
    }
}
