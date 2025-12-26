<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Tour;
use App\Models\Country;
use App\Models\Booking;
use App\Models\Personnel;
use App\Models\City;
use App\Models\HotelCategory;
use App\Models\TourType;
use App\Models\BookingParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->ID_role != 1) {
                abort(403, 'Доступ запрещен');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $stats = [
            'clients' => Client::count(),
            'tours' => Tour::count(),
            'bookings' => Booking::count(),
            'countries' => Country::count(),
            'personnel' => Personnel::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    public function tables(Request $request)
    {
        $table = $request->get('table', 'clients');
        
        $tables = [
            'clients' => 'Клиенты',
            'tours' => 'Туры', 
            'countries' => 'Страны',
            'bookings' => 'Бронирования',
            'personnel' => 'Персонал',
            'cities' => 'Города',
            'hotel_categories' => 'Категории отелей',
            'tour_types' => 'Типы туров',
            'booking_participants' => 'Участники бронирований',
        ];
        
        if (!array_key_exists($table, $tables)) {
            abort(404, 'Таблица не найдена');
        }
        
        $data = [];
        $columns = [];
        
        switch($table) {
            case 'clients':
                //$data = Client::with(['role', 'personnel'])->get();
                break;
            case 'tours':
                $data = Tour::with(['country', 'city', 'tourType'])->get();
                break;
            case 'bookings':
                $data = Booking::with(['client', 'tour'])->get();
                break;
            case 'countries':
                $data = Country::all();
                break;
            case 'personnel':
                $data = Personnel::all();
                break;
            case 'cities':
                $data = City::all();
                break;
            case 'hotel_categories':
                $data = HotelCategory::all();
                break;
            case 'tour_types':
                $data = TourType::all();
                break;
            case 'booking_participants':
                $data = BookingParticipant::all();
                break;
        }
        
        if ($data->count() > 0) {
            $columns = array_keys($data->first()->getAttributes());
        }
        
        return view('admin.tables', compact('data', 'columns', 'table', 'tables'));
    }

    public function queries()
    {
        $queries = [
            '1. Все туры' => Tour::with(['country', 'city'])->get(),
            '2. Клиенты с их турами' => Client::with(['bookings.tour'])->get(),
            '3. Страны со стоимостью туров' => Country::with(['tours' => function($q) {
                $q->select('ID_country', 'price');
            }])->get(),
            '4. Туры по типам' => Tour::with('tourType')->get(),
            '5. Клиенты с бронированиями за последний месяц' => Client::whereHas('bookings', function($q) {
                $q->whereBetween('booking_date', [now()->subMonth(), now()]);
            })->get(),
            '6. Клиенты с суммой покупок > 1000' => Client::withSum('bookings', 'total_cost')
                ->having('bookings_sum_total_cost', '>', 1000)
                ->get(),
            '7. Доступные для бронирования туры' => Tour::where('Available_seats', '>', 0)->get(),
            '8. Клиенты с забронированными турами' => Client::whereHas('bookings.tour.tourType')->get(),
            '9. Туры со свободными местами' => Tour::where('Available_seats', '>', 0)->get(),
            '10. Все клиенты с общей суммой покупок' => Client::withSum('bookings', 'total_price')->get(),
        ];

        return view('admin.queries', compact('queries'));
    }

    public function quickAdd(Request $request)
    {
        $request->validate([
            'table' => 'required|string',
        ]);

        $table = $request->table;
        $data = $request->except(['_token', 'table']);
        
        $allowedTables = [
            'clients', 'tours', 'countries', 'bookings', 'personnel', 
            'cities', 'hotel_categories', 'tour_types', 'booking_participants'
        ];
        
        if (!in_array($table, $allowedTables)) {
            return back()->with('error', 'Недопустимая таблица');
        }
        
        try {
            DB::table($table)->insert($data);
            return back()->with('success', 'Запись успешно добавлена');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при добавлении записи: ' . $e->getMessage());
        }
    }

    public function quickEdit(Request $request, $table, $id)
    {
        $data = $request->except(['_token', '_method']);
        
        $allowedTables = [
            'clients', 'tours', 'countries', 'bookings', 'personnel', 
            'cities', 'hotel_categories', 'tour_types', 'booking_participants'
        ];
        
        if (!in_array($table, $allowedTables)) {
            return back()->with('error', 'Недопустимая таблица');
        }
        
        try {
            DB::table($table)->where('id', $id)->update($data);
            return back()->with('success', 'Запись успешно обновлена');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при обновлении записи: ' . $e->getMessage());
        }
    }

    public function quickDelete($table, $id)
    {
        $allowedTables = [
            'clients', 'tours', 'countries', 'bookings', 'personnel', 
            'cities', 'hotel_categories', 'tour_types', 'booking_participants'
        ];
        
        if (!in_array($table, $allowedTables)) {
            return back()->with('error', 'Недопустимая таблица');
        }
        
        try {
            DB::table($table)->where('id', $id)->delete();
            return back()->with('success', 'Запись успешно удалена');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при удалении записи: ' . $e->getMessage());
        }
    }
}