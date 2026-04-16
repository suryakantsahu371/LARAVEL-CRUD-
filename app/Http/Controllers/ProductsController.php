<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::orderBy('created_at', 'desc')->get();

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('products.create'); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    
       


{
    $request->validate([
        'name' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'description' => 'required',
        'price' => 'required',
        'status' => 'required'
    ]);

    // check file 


    if ($request->hasFile('image')) {

        $image = $request->file('image');

        // Create unique name
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Move to folder
        $image->move(public_path('images'), $imageName);

    }

    // Save data
    Products::create([
        'name' => $request->name,
        'image' => $imageName,
        'description' => $request->description,
        'price' => $request->price,
        'status' => $request->status
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully');
}

    public function show($id)
    {
         return "Product ID: " . $id;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Products::find($id);

        return view('products.edit',[
            'product' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $products = Products::findOrFail($id);
         $oldimage = $products->image;

// validation
     $validator = Validator::make($request->all(), [
    'name' => 'required',
    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    'description' => 'required',
    'price' => 'required',
    'status' => 'required'
      ]);

    if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
    }

    // old image name
     $imageName = $oldimage;

// Check file 
     if ($request->hasFile('image')) {

    // Delete old image
      if ($oldimage && File::exists(public_path('images/' . $oldimage))) {
        File::delete(public_path('images/' . $oldimage));
    }

     $image = $request->file('image');

    // Unique name
     $imageName = time() . '.' . $image->getClientOriginalExtension();

    // Move file
     $image->move(public_path('images'), $imageName);
}

//  UPDATE (not create)
      $products->update([
    'name' => $request->name,
    'image' => $imageName,
    'description' => $request->description,
    'price' => $request->price,
    'status' => $request->status
      ]);

// Redirect
return redirect()->route('products.edit', $products->id)
    ->with('success', 'Product updated successfully');

    }
//         $products = Products::findOrFail($id);
//         $oldimage=$products->image;

//         $validator=validator::make($request->all(),[
//         'name' => 'required',
//         'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
//         'description' => 'required',
//         'price' => 'required',
//         'status' => 'required'
//     ]);

//     // Check file exist
//       $imageName=null;
//     if ($request->hasFile('image')) {

//             if ($oldimage != null && File::exists(public_path('images/' . $oldimage))) {

//             File::delete(public_path('images/' . $oldimage));
//         }
//         $image = $request->file('image');

//         // Create unique name
//         $imageName = time() . '.' . $image->getClientOriginalExtension();

//         // Move to folder
//         $image->move(public_path('images'), $imageName);

//     }

//     // Save data
//     Products::create([
//         'name' => $request->name,
//         'image' => $imageName,
//         'description' => $request->description,
//         'price' => $request->price,
//         'status' => $request->status
//     ]);

//    if ($validator->fails()){
//         return redirect()->back()->withErrors($validator)->withInput();
//     }
//     return redirect()->route('products.edit', $products->id)->with('success', 'Product updated successfully');
//     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
                $products = Products::findOrFail($id);

                if ($products->image != null && File::exists(public_path('images/' .$products->image))) {

            File::delete(public_path('images/' . $products->image));
                }
            $products->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
        }

    