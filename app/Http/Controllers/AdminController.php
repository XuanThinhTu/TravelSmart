<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\product;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::orderBy('id', 'asc')->get();

        $totalcategories = $categories->count();

        return view('admin.category', [
            'categories' => $categories,
            'totalcategories' => $totalcategories
        ]);
    }

    public function searchByKeyword(Request $request)
    {
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



    public function add_category(Request $request)
    {
        try {
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



    public function delete_category($id)
    {

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







    //function for User

    public function userSearchByKeyword(Request $request)
    {
        // Get the search keyword from the request
        $keyword = $request->get('keyword');

        // Fetch the products that match the keyword (for pagination)
        $user = User::where('name', 'like', '%' . $keyword . '%')->paginate(5);

        // Fetch the total count of products that match the keyword (ignoring pagination)
        $totalUsers = User::where('name', 'like', '%' . $keyword . '%')->count();

        // Pass both the products and the total count to the view
        return view('admin.user', [
            'users' => $user,
            'totalusers' => $totalUsers
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




    public function add_user()
    {
        return view('admin.add_user');
    }



    public function save_user(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'password' => Hash::make($validatedData['password']),
            ]);

            toastr()->closeButton()->addSuccess('User Added Successfully'); // Success notification

            return redirect()->route('view_user')->with('msg', 'User added successfully.');
        } catch (\Exception $e) {
            // Display the error message directly to the user
            return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add user: ' . $e->getMessage()]);
        }
    }



    public function delete_user($id)
    {

        $data = User::find($id);

        $data->delete();

        toastr()->closeButton()->addSuccess('User Deleted Successfully'); //https://php-flasher.io/library/toastr/


        return redirect()->back();
    }



    // Show the edit user form
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
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
        $user->update($request->all());

        toastr()->closeButton()->addSuccess('User Added Successfully');

        return redirect()->route('view_user')->with('msg', 'User updated successfully.');
    }





    // function for country


    public function countrySearchByKeyword(Request $request)
    {
        // Get the search keyword from the request
        $keyword = $request->get('keyword');

        // Fetch the products that match the keyword (for pagination)
        $country = country::where('name', 'like', '%' . $keyword . '%')->paginate(5);

        // Fetch the total count of products that match the keyword (ignoring pagination)
        $totalcountries = country::where('name', 'like', '%' . $keyword . '%')->count();

        // Pass both the products and the total count to the view
        return view('admin.country', [
            'countrys' => $country,
            'totalcountries' => $totalcountries
        ]);
    }


    public function view_country()
    {
        // Load countrys and order by id in descending order, then paginate
        $countrys = Country::orderBy('id', 'desc')->paginate(5);

        $totalcountries = Country::count();

        return view('admin.country', [
            'countrys' => $countrys,
            'totalcountries' => $totalcountries
        ]);
    }

   
    public function add_country()
    {
        return view('admin.add_country');
    }

    public function save_country(Request $request)
    {
        $validatedData = $request->validate([
            'country_code' => 'required|string|max:8|unique:country',
            'country_name' => 'required|string|max:64',
        ]);

        try {
            Country::create([
                'country_code' => $validatedData['country_code'],
                'country_name' => $validatedData['country_name'],
            ]);

            toastr()->closeButton()->addSuccess('Country Added Successfully'); // Success notification

            return redirect()->route('view_country')->with('msg', 'Country added successfully.');
        } catch (\Exception $e) {
            // Display the error message 
            return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add country: ' . $e->getMessage()]);
        }
    }

    public function delete_country($id)
    {
        $country = Country::find($id);

        if ($country) {
            $country->delete();

            toastr()->closeButton()->addSuccess('Country Deleted Successfully');

            return redirect()->back()->with('msg', 'Country deleted successfully.');
        }

        return redirect()->back()->withErrors(['msg' => 'Country not found.']);
    }

    // Show the edit country form
    public function edit_country($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.edit_country', compact('country'));
    }

    // Update the country
    public function update_country(Request $request, $id)
    {
        $request->validate([
            'country_code' => 'required|string|max:8|unique:country,country_code,' . $id,
            'country_name' => 'required|string|max:64',
        ]);

        $country = Country::findOrFail($id);
        $country->update($request->only(['country_code', 'country_name']));

        toastr()->closeButton()->addSuccess('Country Updated Successfully');

        return redirect()->route('view_country')->with('msg', 'Country updated successfully.');
    }



// CityController.php

public function citySearchByKeyword(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch the cities that match the keyword (for pagination)
    $cities = City::where('city_name', 'like', '%' . $keyword . '%')->paginate(5);

    // Fetch the total count of cities that match the keyword (ignoring pagination)
    $totalCities = City::where('city_name', 'like', '%' . $keyword . '%')->count();

    // Pass both the cities and the total count to the view
    return view('admin.city', [
        'cities' => $cities,
        'totalCities' => $totalCities
    ]);
}

public function view_city()
{
    // Load cities and order by id in descending order, then paginate
    $cities = City::orderBy('id', 'desc')->paginate(5);

    $totalCities = City::count();

    return view('admin.city', [
        'citys' => $cities,
        'totalCities' => $totalCities
    ]);
}

public function add_city()
{
    $countries = Country::all(); // Fetch all countries
    return view('admin.add_city', compact('countries'));
}

public function save_city(Request $request)
{
    $validatedData = $request->validate([
        'city_name' => 'required|string|max:255',
        'country_id' => 'required|exists:country,id', 
    ]);

    try {
        City::create([
            'city_name' => $validatedData['city_name'],
            'country_id' => $validatedData['country_id'],
        ]);

        toastr()->closeButton()->addSuccess('City Added Successfully'); 

        return redirect()->route('view_city')->with('msg', 'City added successfully.');
    } catch (\Exception $e) {
        // Display the error message 
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add city: ' . $e->getMessage()]);
    }
}

public function delete_city($id)
{
    $city = City::find($id);

    if ($city) {
        $city->delete();

        toastr()->closeButton()->addSuccess('City Deleted Successfully');

        return redirect()->back()->with('msg', 'City deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'City not found.']);
}

// Show the edit city form
public function edit_city($id)
{
    $city = City::findOrFail($id);
    $countries = Country::all(); 
    return view('admin.edit_city', compact('city', 'countries'));
}

// Update the city
public function update_city(Request $request, $id)
{
    $request->validate([
        'city_name' => 'required|string|max:255',
        'country_id' => 'required|exists:country,id',
    ]);

    $city = City::findOrFail($id);
    $city->update($request->only(['city_name', 'country_id']));

    toastr()->closeButton()->addSuccess('City Updated Successfully');

    return redirect()->route('view_city')->with('msg', 'City updated successfully.');
}






    // function for hotel

    public function hotelSearchByKeyword(Request $request)
    {
        // Get the search keyword from the request
        $keyword = $request->get('keyword');

        // Fetch the products that match the keyword (for pagination)
        $hotel = hotel::where('hotel_name', 'like', '%' . $keyword . '%')->paginate(5);

        // Fetch the total count of products that match the keyword (ignoring pagination)
        $totalhotels = hotel::where('hotel_name', 'like', '%' . $keyword . '%')->count();

        // Pass both the products and the total count to the view
        return view('admin.hotel', [
            'hotels' => $hotel,
            'totalhotels' => $totalhotels
        ]);
    }



    public function view_hotel()
    {
        // Load hotels and order by id in descending order, then paginate
        $hotels = Hotel::orderBy('id', 'desc')->paginate(5);

        $totalhotels = Hotel::count();

        return view('admin.hotel', [
            'hotels' => $hotels,
            'totalhotels' => $totalhotels
        ]);
    }
}
