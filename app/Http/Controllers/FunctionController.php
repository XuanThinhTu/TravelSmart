<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function search(Request $request)
    {
        // Lấy các thông tin từ form
        $destination = $request->input('destination');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $guests = $request->input('guests');
        $roomType = $request->input('room_type');
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        // Tạo query ban đầu
        $query = DB::table('hotel_service')
                ->join('hotel', 'hotel_service.hotel_id', '=', 'hotel.id')
                ->join('city', 'hotel.city_id', '=', 'city.id')
                ->join('room_type', 'hotel_service.room_type_id', '=', 'room_type.id')
                ->select('hotel_service.*', 'hotel.hotel_name', 'room_type.type_name', 'city.city_name');

        // Điều kiện tìm kiếm theo từng trường
        if ($destination) {
            $query->where('city.city_name', 'LIKE', "%{$destination}%");
        }

        if ($checkIn && $checkOut) {
            $query->where('available_from', '<=', $checkIn)
                  ->where('available_to', '>=', $checkOut);
        }

        if ($guests) {
            // Nếu cần lọc theo số lượng khách, có thể thêm logic vào đây
        }

        if ($roomType) {
            $query->where('room_type.type_name', $roomType);
        }

        if ($priceMin && $priceMax) {
            $query->whereBetween('hotel_service.service_price', [$priceMin, $priceMax]);
        }

        // Lấy kết quả
        $results = $query->get();

        // Trả về view kết quả
        return view('home.viewSearch', compact('results'));
    }
}
