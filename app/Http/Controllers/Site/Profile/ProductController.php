<?php

namespace App\Http\Controllers\Site\Profile;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Rules\WordCount;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function body_edit(Product $product)
    {
        if ($product->status == 'published' || $product->status == 'stop') {
            return view('site.profile.pages.products.body-edit', compact('product'));
        }

        abort(404);
    }

    public function body_edit_store(Request $request, Product $product)
    {
        $request->validate([
            'body' => [new WordCount(400)],
        ]);


        $product->update([
            'body' => $request->body
        ]);

        return redirect(route('profile.products'))->with([
            'success' => 'محصول با موفقیت ویرایش شد'
        ]);

    }
}
