<?php

namespace App\Http\Controllers;

use App\Models\Product_M;
use Gloudemans\Shoppingcart\Facades\Cart;
//you can use "use Cart" instead since we added the service to app providers
;use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function cart(){
//        Cart::destroy();
        return view('cart');
    }
    //Adding to cart
    public function add_to_cart(Request $request, Product_M $product_M){
//        dd($request->price);
        //Using Cart package
        $cartItem = Cart::add([
            'id' => $product_M->id,
            'name' => $product_M->name,
            'qty' => $request->qty,
            'price' => $product_M->price
        ]);
        /* Important note:
        When you use the cart package, when you want to access a particular field it talks to the database, problem is it knows only the predefined fields like id name qty price, the image in the other hand
         a custom field, therefore it requires you to either publish the package and override it or simply tell it which model to use */

        Cart::associate($cartItem->rowId,'App\Models\Product_M');
//        To display the content of the cart use Cart::content(Cart::content()
        session()->flash('success','Product Added To Cart Successfully');
        return redirect()->route('cart');
    }
    //Cart main page rapid add
    public function cart_rapid_add(Request $request, Product_M $product_M){
//        dd($request->price);
        //Using Cart package
        $cartItem = Cart::add([
            'id' => $product_M->id,
            'name' => $product_M->name,
            //rapid add 1 item default if a user wants to add more he must visit his shopping cart
            'qty' => 1,
            'price' => $product_M->price
        ]);
        /* Important note:
        When you use the cart package, when you want to access a particular field it talks to the database, problem is it knows only the predefined fields like id name qty price, the image in the other hand
         a custom field, therefore it requires you to either publish the package and override it or simply tell it which model to use */

        Cart::associate($cartItem->rowId,'App\Models\Product_M');
//        To display the content of the cart use Cart::content(Cart::content()
        session()->flash('success','Product Added To Cart Successfully');
        return redirect()->back();
    }

    public function cart_delete($id)
    {
//        dd($id);
        Cart::remove($id);
        session()->flash('success','Product removed From Cart Successfully');
        return redirect()->route('cart');
    }
    // Increment shopping cart item quantity
    public function cart_increment($productId,$quantity)
    {
//        dd($productId.' '.$quantity);
        Cart::update($productId, $quantity + 1);
        session()->flash('success','Product removed From Cart Successfully');
        return redirect()->back();
    }
    //Decrementing shopping cart item quantity
    public function cart_decrement($productId,$quantity)
    {
        Cart::update($productId, $quantity - 1);
        session()->flash('success','Product removed From Cart Successfully');
        return redirect()->back();
    }



}
