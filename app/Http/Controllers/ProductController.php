<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product', [
            'products' => Product::select(['title', 'price', 'description', 'id', 'quantity', 'category_id'])
                ->orderBy('id', 'desc')
                ->with('category')
                ->paginate()
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageMetaData = [
            'filename' => $request->image->getClientOriginalName(),
            'size'     => $request->image->getSize(),
            'extension' => $request->image->extension(),
        ];

        $blobImage = $request->image->openFile()->fread($request->image->getSize());

        $data = [
            'title'          => $request->title,
            'description'    => $request->description,
            'price'          => $request->price,
            'quantity'       => $request->quantity,
            'image'          => $blobImage,
            'image_metadata' => $imageMetaData,
            'category_id'    => 1, // test
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now()
        ];

        Product::create($data);
        $imageName = time() . '.' . $request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        return Redirect::route('products.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
