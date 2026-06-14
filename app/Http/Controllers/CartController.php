<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'سجل دخول أولاً'
            ], 401);
        }

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'message' => 'المنتج غير موجود'
            ], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image ?? null, // 👈 آمن بدون media
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'تمت الإضافة للسلة',
            'cart_count' => count($cart)
        ]);
    }

    public function destroy($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return back()->with('success', 'تم حذف المنتج من السلة');
}
}
