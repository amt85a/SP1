<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Agency;
use App\Models\CarModel;
use App\Models\User;
use App\Models\UserDrivers;
use MongoDB\Driver\Session;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use function Laravel\Prompts\alert;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::getCustomRoute('booking/desk');
        //dd($bookings);
        return view('booking.index', ['bookings' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agencies = Agency::get();
        $carModels = CarModel::getCustomRoute('carModel');
        $drivers = UserDrivers::getCustomRoute('user/drivers');
        return view('booking.create', ['agencies' => $agencies, 'carModels' => $carModels, 'drivers' => $drivers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
       \Illuminate\Support\Facades\Session::flash('success', 'Réservation créée avec succès! Notre équipe vous affectera un véhicule d\'ici peu.');
       session()->flash('success', 'Réservation créée avec succès! Notre équipe vous affectera un véhicule d\'ici peu.');
        //dd($request);
        if ($request->path == "go") {
            $path  = 1;
        }
        else if($request->path == "roundTrip"){
            $path  = 2;
        }
        if (!$request->endAgency) {
            $endAgency = $request->beginAgency;
        }
        else {
            $endAgency = $request->endAgency;
        }
        $booking = Booking::create([
            'beginDate' => $request->beginDate,
            'endingDate' => $request->endingDate,
            'user_id' => (int)$request->driver,
            'car_id' => (int)$request->carModel,
            'status_id' => 1,
            'path_id' => $path,
            'beginAgency_id' => (int)$request->beginAgency,
            'endAgency_id' => (int)$endAgency,
        ]);


        //dd($request->beginDate, $request->endingDate, (int)$request->driver, (int)$request->carModel, $path, (int)$request->beginAgency, (int)$endAgency);

        if ($booking->id) {
            //$session = session();
            //dd($session);

            //dd($booking);
            session()->flash('success', 'Réservation créée avec succès! Notre équipe vous affectera un véhicule d\'ici peu.');
            return to_route('booking.index');
        }
        else {

            session()->flash('error', 'Impossible de créer la réservation! Veuillez vérifier les informations saisies dans le formulaire.');
        }
       // dd($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $booking = Booking::getOne('/'.$id.'/web');
        //dd($booking);
        return view('booking.show',['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Booking::deleteOne('/'.$id);
        return to_route('booking.index');
    }
}
