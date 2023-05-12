<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return Inertia::render('Product/index',[
            'products' => $products
        ]);

        // return response()->json([
        //     'products' => $products,
        // ]);
    }

    public function get_all_products()
    {
        $products = Product::all();
        // return Inertia::render('Product/index',[
        //     'products' => $products
        // ]);

        return response()->json([
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        return Inertia::render('Product/create');
        // return Inertia::render('Product/create'.[
        //     'categories' => $categories
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $image = Request::file('image')->store('products', 'public');
        
        // $fileUpload = new FileUpload;
    
        // if($request->file()) {
        //     $file_name = time().'_'.$request->file->getClientOriginalName();
        //     $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

        //     $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
        //     $fileUpload->path = '/storage/' . $file_path;
        //     $fileUpload->save();
        


        $request->validate([
            'name' => 'required|string|max:255',
            // 'category' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_time' => 'required|date|timezone',
        ]);
        // Product::create([
        //     'name' => $request->name,
        //     'category' => $request->category,
        //     'description' => $request->description,
        //     'date_time' => $request->date_time,
        //     'image' =>$request->file->move(public_path('images'), $fileName)
        // ]);

        $product = new Product();
        $product->name = $request->name;
        $product->categoryID = $request->category;
        $product->description = $request->description;
        $product->date_time = $request->date_time;
    
        // $img = $_POST['image'];
        // $folderPath = "images/products/";

        // $image_parts = explode(";base64,", $img);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];

        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = uniqid() . '.png';

        // $image = $folderPath . $fileName;
        // file_put_contents($image, $image_base64);

        // print_r($fileName);
        
        // $image_path = '';

        // if ($request->hasFile('image')) {
        //     $image_path = $request->file('image')->store('images', 'public');
        //     $request->image->move(public_path('images'), $imageName);
        // }

    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);
    
        $product->image = $imageName;


        $product->save();

        return redirect()->route('product.index')->with('message', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product =Product::where("id",$id)->first();
        return Inertia::render('Product/edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required',
            'date_time' => 'required|date|timezone',
        ]);

        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->date_time = $request->date_time;
        $product->save();

        return redirect()->route('product.index')->with('message', 'Product Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('message', 'Product Delete Successfully');
    }

    public function delete($id)
    {
        $product= Product::where('id',$id)->first();
        $product->delete();
        return redirect()->route('product.index')->with('message', 'Product Delete Successfully');
    }

    public function search(Request $request)
    {
        $search = $request->get('s');
        if ($search != null )
        {
            $products = Product::where('name', 'LIKE', "%$search%")
            ->orWhere('description','LIKE',"%$search%")
            ->get();
        }
        // return Inertia::render('Product/index',[
        //     'products' => $products
        // ]);
        return response()->json([
            'products' => $products
        ]);
    }
}
