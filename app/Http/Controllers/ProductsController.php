<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Product_M;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        return view('admin.products.index')->with('products',Product_M::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        // since we used a custom request there is no need to validate here, that is already been done

        $img = $request->file('image');
        $img_full_name = $img->getClientOriginalName();
        $img_extension = $img->getClientOriginalExtension();

        //Plain old php, it's better than using explode method
        $img_name = pathinfo($img_full_name, PATHINFO_FILENAME);

        $img_new_name = $img_name.'_'.time().'.'.$img_extension;

        //Moving image
        $request->file('image')->move(public_path('uploads/products'),$img_new_name);

        // This makes the code cleaner and allows us to focus on the logic
       Product_M::create([
           'name' => $request->name,
           'price' => $request->price,
           'image' =>  $img_new_name,
           'description' => $request->description
       ]);
        session()->flash('success','Product Created Successfully');
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product_M $product_M)
    {
        //
    }


    public function edit(Product_M $product_M)
    {
//        dd($product_M);
        return view('admin.products.edit')->with('product',$product_M);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_M $product_M)
    {
//        dd("here");
        if ($request->hasFile('image'))
        {
        $img = $request->file('image');
        $img_full_name = $img->getClientOriginalName();
        $img_extension = $img->getClientOriginalExtension();

        //Plain old php, it's better than using explode method
        $img_name = pathinfo($img_full_name, PATHINFO_FILENAME);

        $img_new_name = $img_name.'_'.time().'.'.$img_extension;

        //Deleting old product image
           File::delete(public_path('uploads/products/'.$product_M->image));

        //Moving image
        $request->file('image')->move(public_path('uploads/products'),$img_new_name);

        //updating only image
            $product_M->image = $img_new_name;
            $product_M->update();
        }

        // This makes the code cleaner and allows us to focus on the logic
        $product_M->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        session()->flash('success','Product Updated Successfully');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_M $product_M)
    {

//        dd(public_path('uploads/products'.$product_M->image));

        //Deleting old product image
        //method 1:
//     File::delete(public_path('uploads/products/'.$product_M->image));
        //asset also work
        ////File::delete(asset('uploads/products/'.$product_M->image));
//      Method 3
        unlink(public_path('uploads/products/'.$product_M->image));
        //Method 4: using assessors or mutators in the model, but I don't recommend it
        $product_M->delete();
        session()->flash('success','Product Deleted Successfully');
        return redirect(route('products.index'));
    }
}
