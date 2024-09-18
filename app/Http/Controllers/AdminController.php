<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function view_category() {
        $categories = Category::orderBy('id', 'asc')->get();

        $totalcategories = $categories->count();

        return view('admin.category', [
            'categories' => $categories,
            'totalcategories' => $totalcategories
        ]);
    }

    public function searchByKeyword(Request $request) {
        // Get the search keyword from the request
        $keyword = $request->get('keyword');
    
        // Fetch the categories that match the keyword
        $categories = Category::where('category_name', 'like', '%' . $keyword . '%')->get();
        
        // Get the total count of matching categories
        $totalCategories = $categories->count();
    
        // Pass both the categories and the total count to the view
        return view('admin.category', [
            'categories' => $categories,
            'totalcategories' => $totalCategories
        ]);
    }
    


    public function add_category( Request $request) {
        try{
             $category = new Category;

            $category->category_name = $request->category_name;

            $category->save();

            toastr()->closeButton()->addSuccess('Category Added Successfully'); //https://php-flasher.io/library/toastr/

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->addError('Failed to add Category: ' . $e->getMessage());
            return redirect()->back();
        }
       
    }



    public function delete_category($id) {

        $data = Category::find($id);

        $data->delete();

        toastr()->closeButton()->addSuccess('Category Deleted Successfully'); //https://php-flasher.io/library/toastr/


        return redirect()->back();
    }

    public function editCategory($id)
    {
        $category = Category::find($id);

        // Redirect if category not found
        if (!$category) {
            return redirect()->route('view_category')->with('msg', 'Category not found');
        }

        return view('admin.edit_category', ['category' => $category]);
    }

    // Method to update the category
    public function update(Request $request)
    {
       

        $category = Category::find($request->id);

        if ($category) {
            $category->category_name = $request->category_name;
            $category->save();

            // return redirect()->back()->with('msg', 'Category updated successfully'); //giu o trang edit_category/id va hien flash msg
            return redirect('/view_category')->with('msg', 'Category updated successfully'); //quay ve trang admin.category va hien flash msg
        }

        return redirect()->back()->with('msg', 'Category not found');
    }







    //function for Product

    public function productSearchByKeyword(Request $request) {
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch the products that match the keyword (for pagination)
    $products = Product::where('title', 'like', '%' . $keyword . '%')->paginate(5);

    // Fetch the total count of products that match the keyword (ignoring pagination)
    $totalProducts = Product::where('title', 'like', '%' . $keyword . '%')->count();

    // Pass both the products and the total count to the view
    return view('admin.products', [
        'products' => $products,
        'totalproducts' => $totalProducts
    ]);
}



    public function add_product() {
        $categories = Category::get();
        return view('admin.add_product', ['categories' => $categories]);
    }


    public function view_product()
{
    // Load products with their categories
    $products = Product::with('category')->orderBy('id', 'desc')->paginate(5);

    $totalproducts = Product::count();

    return view('admin.products', [
        'products' => $products,
        'totalproducts' => $totalproducts
    ]);
}

    


    

    // add if else or try and catch 
    //because now even there is an error it won't alert the user
    public function save(Request $request) {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            $data = new Product;
    
            $data->title = $request->title;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->discount_price = $request->discount_price;
            $data->quantity = $request->quantity;
            $data->category_id = $request->category_id;
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products'), $imageName);
                $data->image = $imageName;
            }
    
            $data->save();
            toastr()->addSuccess('Product Added Successfully');
            return redirect('view_product');
        } catch (\Exception $e) {
            toastr()->addError('Failed to add product: ' . $e->getMessage());
        }
    
        return redirect('add_product');
    }
    


    public function delete_product($id) {

        $data = product::find($id);

        $image_path = public_path('products/' . $data->image);

        if (file_exists($image_path)) {

            unlink($image_path);
        }

        $data->delete();

        toastr()->closeButton()->addSuccess('Product Deleted Successfully'); //https://php-flasher.io/library/toastr/


        return redirect()->back();
    }



    public function editProduct($id)
    {
        // Retrieve the product by ID
        $product = Product::findOrFail($id);

        // Retrieve all categories
        $categories = Category::all();

        // Pass data to the view
        return view('admin.edit_product', compact('product', 'categories'));
    }
    


    public function updateProduct(Request $request)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // optional image validation
        ]);

        // Find the product by ID
        $product = Product::findOrFail($request->id);

        // Update product details
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category_id');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            // Store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
            $product->image = $imageName;
        }

        // Save the updated product
        $product->save();

        // Redirect with success message
        return redirect()->route('view_product', ['id' => $product->id])
                         ->with('msg', 'Product updated successfully!');
    }
}








