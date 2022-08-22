<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }


    public function products_search()
    {
        return [
            'items' => Product::where('fa_title', 'LIKE', '%' . \request('q') . '%')->get()
        ];
    }

    public function products_search_vue()
    {
        return response([
            'items' => Product::where('fa_title', 'LIKE', '%' . \request('q') . '%')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->fa_title,
                ];
            })
        ]);
    }

    public function users_search()
    {
        return [
            'items' => User::where('email', 'LIKE', '%' . \request('q') . '%')
                ->orWhere('name', 'LIKE', '%' . \request('q') . '%')
                ->orWhere('username', 'LIKE', '%' . \request('q') . '%')
                ->get()
        ];
    }
}
