<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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



    


    public function view_user()
{
    // Load users and order by id in descending order, then paginate
    $users = User::orderBy('id', 'desc')->paginate(5);

    $totalUsers = User::count();

    return view('admin.user', [
        'users' => $users,
        'totalusers' => $totalUsers
    ]);
}

    


    

public function add_user() {
    return view('admin.add_user'); 
}

    

    // Store a newly created user
    public function save_user(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']), // Hash the password
        ]);

        toastr()->closeButton()->addSuccess('User Added Successfully'); // Success notification

        return redirect()->route('view_user')->with('msg', 'User added successfully.');

    } catch (\Exception $e) {
        // Display the error message directly to the user
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add user: ' . $e->getMessage()]);
    }
}

    



    // public function delete_product($id) {

    //     $data = product::find($id);

    //     $image_path = public_path('products/' . $data->image);

    //     if (file_exists($image_path)) {

    //         unlink($image_path);
    //     }

    //     $data->delete();

    //     toastr()->closeButton()->addSuccess('Product Deleted Successfully'); //https://php-flasher.io/library/toastr/


    //     return redirect()->back();
    // }

    public function delete_user($id) {

        $data = User::find($id);

        $data->delete();

        toastr()->closeButton()->addSuccess('User Deleted Successfully'); //https://php-flasher.io/library/toastr/


        return redirect()->back();
    }



 


    // Show the edit user form
    public function editUser ($id)
    {
        $user = User::findOrFail($id); // Fetch user by ID
        return view('admin.edit_user', compact('user')); // Pass user to the view
    }

    // Update the user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'usertype' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all()); // Update user with request data

        toastr()->closeButton()->addSuccess('User Added Successfully'); // Success notification
        
        return redirect()->route('view_user')->with('msg', 'User updated successfully.');
        }


    


  
}








