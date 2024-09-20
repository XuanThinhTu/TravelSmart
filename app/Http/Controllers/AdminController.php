<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Category;
use App\Models\City;
use App\Models\Contract;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\HotelService;
use App\Models\product;
use App\Models\RoomType;
use App\Models\TicketType;
use App\Models\TransportService;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    


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







//function for roomtype

public function roomtypeSearchByKeyword(Request $request)
{
    $keyword = $request->get('keyword');

    $roomTypes = RoomType::where('type_name', 'like', '%' . $keyword . '%')->paginate(5);
    $totalRoomTypes = RoomType::where('type_name', 'like', '%' . $keyword . '%')->count();

    return view('admin.roomtype', compact('roomTypes', 'totalRoomTypes'));
}

public function view_roomtype()
{
    $roomTypes = RoomType::orderBy('id', 'desc')->paginate(5);
    $totalRoomTypes = RoomType::count();

    return view('admin.roomtype', compact('roomTypes', 'totalRoomTypes'));
}

public function add_roomtype()
{
    return view('admin.add_roomtype');
}

public function save_roomtype(Request $request)
{
    $validatedData = $request->validate([
        'type_name' => 'required|string|max:64|unique:room_type,type_name',
    ]);

    try {
        RoomType::create($validatedData);

        toastr()->closeButton()->addSuccess('Room Type Added Successfully'); 
        return redirect()->route('view_roomtype')->with('msg', 'Room type added successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add room type: ' . $e->getMessage()]);
    }
}

public function delete_roomtype($id)
{
    $roomType = RoomType::find($id);

    if ($roomType) {
        $roomType->delete();
        toastr()->closeButton()->addSuccess('Room Type Deleted Successfully');
        return redirect()->back()->with('msg', 'Room type deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'Room type not found.']);
}












    // View all hotel services
    public function viewHotelServices()
    {
        $hotelServices = HotelService::with(['hotel', 'roomType'])->paginate(5);
        return view('admin.hotel_service', compact('hotelServices'));
    }

    // Show the form to add a new hotel service
    public function addHotelService()
    {
        $hotels = Hotel::all(); // Fetch all hotels
        $roomTypes = RoomType::all(); // Fetch all room types
        return view('admin.add_hotel_service', compact('hotels', 'roomTypes'));
    }

    // Save a new hotel service
    public function saveHotelService(Request $request)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotel,id',
            'room_type_id' => 'required|exists:room_type,id',
            'service_price' => 'required|numeric|min:0',
            'active' => 'required|in:Active,Inactive',
        ]);

        try {
            HotelService::create($validatedData);

            toastr()->closeButton()->addSuccess('Hotel Service Added Successfully');
            return redirect()->route('view_hotel_services')->with('msg', 'Hotel service added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add hotel service: ' . $e->getMessage()]);
        }
    }

    // Show the edit hotel service form
    public function editHotelService($id)
    {
        $hotelService = HotelService::findOrFail($id);
        $hotels = Hotel::all();
        $roomTypes = RoomType::all();
        return view('admin.edit_hotel_service', compact('hotelService', 'hotels', 'roomTypes'));
    }

    // Update the hotel service
    public function updateHotelService(Request $request, $id)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotel,id',
            'room_type_id' => 'required|exists:room_type,id',
            'service_price' => 'required|numeric|min:0',
            'active' => 'required|in:Active,Inactive',
        ]);

        $hotelService = HotelService::findOrFail($id);
        $hotelService->update($validatedData);

        toastr()->closeButton()->addSuccess('Hotel Service Updated Successfully');
        return redirect()->route('view_hotel_services')->with('msg', 'Hotel service updated successfully.');
    }

    // Delete the hotel service
    public function deleteHotelService($id)
    {
        $hotelService = HotelService::find($id);

        if ($hotelService) {
            $hotelService->delete();
            toastr()->closeButton()->addSuccess('Hotel Service Deleted Successfully');
            return redirect()->back()->with('msg', 'Hotel service deleted successfully.');
        }

        return redirect()->back()->withErrors(['msg' => 'Hotel service not found.']);
    }








    // function for hotel



        // View all hotels
     
public function view_hotel()
{
    // Load hotels and order by id in descending order, then paginate
    $hotels = Hotel::with('city')->orderBy('id', 'desc')->paginate(5);

    $totalHotels = Hotel::count();

    return view('admin.hotel', [
        'hotels' => $hotels,
        'totalHotels' => $totalHotels
    ]);
}

public function hotelSearchByKeyword(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch hotels that match the keyword (for pagination)
    $hotels = Hotel::with('city')
        ->where('hotel_name', 'like', '%' . $keyword . '%')
        ->paginate(5);

    // Fetch the total count of hotels that match the keyword (ignoring pagination)
    $totalHotels = Hotel::where('hotel_name', 'like', '%' . $keyword . '%')->count();

    // Pass both the hotels and the total count to the view
    return view('admin.hotel', [
        'hotels' => $hotels,
        'totalHotels' => $totalHotels
    ]);
}

public function add_hotel()
{
    $cities = City::all(); // Fetch all cities
    return view('admin.add_hotel', compact('cities'));
}

public function save_hotel(Request $request)
{
    $validatedData = $request->validate([
        'hotel_name' => 'required|string|max:255',
        'city_id' => 'required|exists:city,id',
        'hotel_address' => 'required|string|max:255',
        'details' => 'nullable|string',
        'active' => 'required|in:Active,Inactive',
        'available_from' => 'required|date',
        'available_to' => 'required|date|after_or_equal:available_from',
    ]);

    try {
        Hotel::create($validatedData);

        toastr()->closeButton()->addSuccess('Hotel Added Successfully');

        return redirect()->route('view_hotel')->with('msg', 'Hotel added successfully.');
    } catch (\Exception $e) {
        // Display the error message 
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add hotel: ' . $e->getMessage()]);
    }
}

public function edit_hotel($id)
{
    $hotel = Hotel::findOrFail($id);
    $cities = City::all(); // Fetch all cities for the dropdown
    return view('admin.edit_hotel', compact('hotel', 'cities'));
}

public function update_hotel(Request $request, $id)
{
    $validatedData = $request->validate([
        'hotel_name' => 'required|string|max:255',
        'city_id' => 'required|exists:city,id',
        'hotel_address' => 'required|string|max:255',
        'details' => 'nullable|string',
        'active' => 'required|in:Active,Inactive',
        'available_from' => 'required|date',
        'available_to' => 'required|date|after_or_equal:available_from',
    ]);

    $hotel = Hotel::findOrFail($id);
    $hotel->update($validatedData);

    toastr()->closeButton()->addSuccess('Hotel Updated Successfully');

    return redirect()->route('view_hotel')->with('msg', 'Hotel updated successfully.');
}

public function delete_hotel($id)
{
    $hotel = Hotel::find($id);

    if ($hotel) {
        $hotel->delete();

        toastr()->closeButton()->addSuccess('Hotel Deleted Successfully');

        return redirect()->back()->with('msg', 'Hotel deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'Hotel not found.']);
}






//function for ticket type
public function ticketTypeSearchByKeyword(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch the ticket types that match the keyword (for pagination)
    $ticketTypes = TicketType::where('type_name', 'like', '%' . $keyword . '%')->paginate(5);

    // Fetch the total count of ticket types that match the keyword (ignoring pagination)
    $totalTicketTypes = TicketType::where('type_name', 'like', '%' . $keyword . '%')->count();

    // Pass both the ticket types and the total count to the view
    return view('admin.ticket_type', [
        'ticketTypes' => $ticketTypes,
        'totalTicketTypes' => $totalTicketTypes,
    ]);
}

public function view_ticketType()
{
    // Load ticket types and order by id in descending order, then paginate
    $ticketTypes = TicketType::orderBy('id', 'desc')->paginate(5);
    $totalTicketTypes = TicketType::count();

    return view('admin.ticket_type', [
        'ticketTypes' => $ticketTypes,
        'totalTicketTypes' => $totalTicketTypes,
    ]);
}

public function add_ticketType()
{
    return view('admin.add_ticket_type'); // No extra data needed for adding
}

public function save_ticketType(Request $request)
{
    $validatedData = $request->validate([
        'type_name' => 'required|string|max:255',
    ]);

    try {
        TicketType::create([
            'type_name' => $validatedData['type_name'],
        ]);

        toastr()->closeButton()->addSuccess('Ticket Type Added Successfully');

        return redirect()->route('view_ticketType')->with('msg', 'Ticket Type added successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add Ticket Type: ' . $e->getMessage()]);
    }
}



public function delete_ticketType($id)
{
    $ticketType = TicketType::find($id);

    if ($ticketType) {
        $ticketType->delete();

        toastr()->closeButton()->addSuccess('Ticket Type Deleted Successfully');

        return redirect()->back()->with('msg', 'Ticket Type deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'Ticket Type not found.']);
}





















public function transportServiceSearchByKeyword(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch the transport services that match the keyword (for pagination)
    $transportServices = TransportService::whereHas('fromCity', function($query) use ($keyword) {
        $query->where('city_name', 'like', '%' . $keyword . '%');
    })->orWhereHas('toCity', function($query) use ($keyword) {
        $query->where('city_name', 'like', '%' . $keyword . '%');
    })->paginate(5);

    // Fetch the total count of transport services that match the keyword (ignoring pagination)
    $totalServices = TransportService::whereHas('fromCity', function($query) use ($keyword) {
        $query->where('city_name', 'like', '%' . $keyword . '%');
    })->orWhereHas('toCity', function($query) use ($keyword) {
        $query->where('city_name', 'like', '%' . $keyword . '%');
    })->count();

    // Pass both the transport services and the total count to the view
    return view('admin.transport_service', [
        'transportServices' => $transportServices,
        'totalServices' => $totalServices
    ]);
}

public function view_transport_service()
{
    // Load transport services and order by id in descending order, then paginate
    $transportServices = TransportService::orderBy('id', 'desc')->paginate(5);
    $totalServices = TransportService::count();

    return view('admin.transport_service', [
        'transportServices' => $transportServices,
        'totalServices' => $totalServices
    ]);
}

public function add_transport_service()
{
    $ticketTypes = TicketType::all(); // Fetch all ticket types
    $cities = City::all(); // Fetch all cities
    return view('admin.add_transport_service', compact('ticketTypes', 'cities'));
}

public function save_transport_service(Request $request)
{
    $validatedData = $request->validate([
        'ticket_type_id' => 'required|exists:ticket_type,id',
        'from_city_id' => 'required|exists:city,id', 
        'to_city_id' => 'required|exists:city,id',
        'service_price' => 'required|numeric|min:0',
        'active' => 'required|in:Active,Inactive',
    ]);

    try {
        TransportService::create([
            'ticket_type_id' => $validatedData['ticket_type_id'],
            'from_city_id' => $validatedData['from_city_id'],
            'to_city_id' => $validatedData['to_city_id'],
            'service_price' => $validatedData['service_price'],
            'active' => $validatedData['active'],
        ]);

        toastr()->closeButton()->addSuccess('Transportation Service Added Successfully');

        return redirect()->route('view_transport_service')->with('msg', 'Transportation service added successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add transportation service: ' . $e->getMessage()]);
    }
}

public function delete_transport_service($id)
{
    $transportService = TransportService::find($id);

    if ($transportService) {
        $transportService->delete();

        toastr()->closeButton()->addSuccess('Transportation Service Deleted Successfully');

        return redirect()->back()->with('msg', 'Transportation service deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'Transportation service not found.']);
}

// Show the edit transportation service form
public function edit_transport_service($id)
{
    $transportService = TransportService::findOrFail($id);
    $ticketTypes = TicketType::all(); 
    $cities = City::all(); 
    return view('admin.edit_transport_service', compact('transportService', 'ticketTypes', 'cities'));
}

// Update the transportation service
public function update_transport_service(Request $request, $id)
{
    $request->validate([
        'ticket_type_id' => 'required|exists:ticket_type,id',
        'from_city_id' => 'required|exists:city,id',
        'to_city_id' => 'required|exists:city,id',
        'service_price' => 'required|numeric|min:0',
        'active' => 'required|in:Active,Inactive',
    ]);

    $transportService = TransportService::findOrFail($id);
    $transportService->update($request->only(['ticket_type_id', 'from_city_id', 'to_city_id', 'service_price', 'active']));

    toastr()->closeButton()->addSuccess('Transportation Service Updated Successfully');

    return redirect()->route('view_transport_service')->with('msg', 'Transportation service updated successfully.');
}



















//function for contract



public function contractSearchByKeyword(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch contracts that match the keyword (for pagination)
    $contracts = Contract::whereHas('user', function($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%'); // Adjust the column as needed
    })->orWhereHas('agent', function($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%'); // Adjust the column as needed
    })->orWhereHas('hotelService', function($query) use ($keyword) {
        $query->where('service_name', 'like', '%' . $keyword . '%'); // Adjust the column as needed
    })->orWhereHas('transportService', function($query) use ($keyword) {
        $query->where('service_name', 'like', '%' . $keyword . '%'); // Adjust the column as needed
    })->paginate(5);

    // Fetch the total count of contracts that match the keyword (ignoring pagination)
    $totalContracts = Contract::whereHas('user', function($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
    })->orWhereHas('agent', function($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
    })->orWhereHas('hotelService', function($query) use ($keyword) {
        $query->where('service_name', 'like', '%' . $keyword . '%');
    })->orWhereHas('transportService', function($query) use ($keyword) {
        $query->where('service_name', 'like', '%' . $keyword . '%');
    })->count();

    // Pass both the contracts and the total count to the view
    return view('admin.contracts', [
        'contracts' => $contracts,
        'totalContracts' => $totalContracts
    ]);
}


public function view_contracts()
{
    // Load contracts and paginate
    $contracts = Contract::orderBy('id', 'desc')->paginate(5);
    $totalContracts = Contract::count();

    return view('admin.contracts', [
        'contracts' => $contracts,
        'totalContracts' => $totalContracts
    ]);
}

public function add_contract()
{
    $users = User::all(); // Fetch all users
    $agents = Agent::all(); // Fetch all agents
    $hotelServices = HotelService::all(); // Fetch all hotel services
    $transportServices = TransportService::all(); // Fetch all transport services

    return view('admin.add_contract', compact('users', 'agents', 'hotelServices', 'transportServices'));
}

public function save_contract(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'agent_id' => 'required|exists:agent,id',
        'hotel_service_id' => 'nullable|exists:hotel_service,id',
        'transport_service_id' => 'nullable|exists:transport_services,id',
        'total_price' => 'required|numeric|min:0',
        'payment_date' => 'required|date',
        'paid_status' => 'required|in:Paid,Not Paid',
    ]);

    try {
        Contract::create($validatedData);

        toastr()->closeButton()->addSuccess('Contract Added Successfully');

        return redirect()->route('view_contracts')->with('msg', 'Contract added successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add contract: ' . $e->getMessage()]);
    }
}

public function edit_contract($id)
{
    $contract = Contract::findOrFail($id);
    $users = User::all();
    $agents = Agent::all();
    $hotelServices = HotelService::all();
    $transportServices = TransportService::all();

    return view('admin.edit_contract', compact('contract', 'users', 'agents', 'hotelServices', 'transportServices'));
}

public function update_contract(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'agent_id' => 'required|exists:agent,id',
        'hotel_service_id' => 'nullable|exists:hotel_service,id',
        'transport_service_id' => 'nullable|exists:transport_services,id',
        'total_price' => 'required|numeric|min:0',
        'payment_date' => 'required|date',
        'paid_status' => 'required|in:Paid,Not Paid',
    ]);

    $contract = Contract::findOrFail($id);
    $contract->update($request->only(['user_id', 'agent_id', 'hotel_service_id', 'transport_service_id', 'total_price', 'payment_date', 'paid_status']));

    toastr()->closeButton()->addSuccess('Contract Updated Successfully');

    return redirect()->route('view_contracts')->with('msg', 'Contract updated successfully.');
}

public function delete_contract($id)
{
    $contract = Contract::find($id);

    if ($contract) {
        $contract->delete();

        toastr()->closeButton()->addSuccess('Contract Deleted Successfully');

        return redirect()->back()->with('msg', 'Contract deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'Contract not found.']);
}









//function for agent

public function agentSearchByKeyword(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->get('keyword');

    // Fetch the agents that match the keyword (for pagination)
    $agents = Agent::where('first_name', 'like', '%' . $keyword . '%')
                   ->orWhere('last_name', 'like', '%' . $keyword . '%')
                   ->orWhere('agent_code', 'like', '%' . $keyword . '%')
                   ->paginate(5);

    // Fetch the total count of agents that match the keyword (ignoring pagination)
    $totalAgents = Agent::where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('agent_code', 'like', '%' . $keyword . '%')
                        ->count();

    // Pass both the agents and the total count to the view
    return view('admin.agent', [
        'agents' => $agents,
        'totalAgents' => $totalAgents
    ]);
}

public function view_agent()
{
    // Load agents and order by id in descending order, then paginate
    $agents = Agent::orderBy('id', 'desc')->paginate(5);
    $totalAgents = Agent::count();

    return view('admin.agent', [
        'agents' => $agents,
        'totalAgents' => $totalAgents
    ]);
}

public function add_agent()
{
    return view('admin.add_agent');
}

public function save_agent(Request $request)
{
    $validatedData = $request->validate([
        'agent_code' => 'required|string|max:45|unique:agent,agent_code',
        'first_name' => 'required|string|max:45',
        'last_name' => 'required|string|max:45',
        'active' => 'required|in:Working,Retired',
    ]);

    try {
        Agent::create([
            'agent_code' => $validatedData['agent_code'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'active' => $validatedData['active'],
        ]);

        toastr()->closeButton()->addSuccess('Agent Added Successfully'); 

        return redirect()->route('view_agent')->with('msg', 'Agent added successfully.');
    } catch (\Exception $e) {
        // Display the error message 
        return redirect()->back()->withInput()->withErrors(['msg' => 'Failed to add agent: ' . $e->getMessage()]);
    }
}

public function edit_agent($id)
{
    $agent = Agent::findOrFail($id);
    return view('admin.edit_agent', compact('agent'));
}

public function update_agent(Request $request, $id)
{
    $request->validate([
        'agent_code' => 'required|string|max:45|unique:agent,agent_code,' . $id,
        'first_name' => 'required|string|max:45',
        'last_name' => 'required|string|max:45',
        'active' => 'required|in:Working,Retired',
    ]);

    $agent = Agent::findOrFail($id);
    $agent->update($request->only(['agent_code', 'first_name', 'last_name', 'active']));

    toastr()->closeButton()->addSuccess('Agent Updated Successfully');

    return redirect()->route('view_agent')->with('msg', 'Agent updated successfully.');
}

public function delete_agent($id)
{
    $agent = Agent::find($id);

    if ($agent) {
        $agent->delete();

        toastr()->closeButton()->addSuccess('Agent Deleted Successfully');

        return redirect()->back()->with('msg', 'Agent deleted successfully.');
    }

    return redirect()->back()->withErrors(['msg' => 'Agent not found.']);
}

}
    

