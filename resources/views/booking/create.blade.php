@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('content_header')
    <h1 class="m-0 text-dark">{{__("Book")}}</h1>
@stop
@php
    $heads=[
        __('Model'),
        __('NbSeat'),
        __('Logo'),
        __('Choice'),

    ];
@endphp
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <form method="POST" id="bookingForm" action="{{route('booking.store')}}">
                        @csrf
                        <div class="card-body-box-profile" id="step1">
                            <div class="form-group">
                                <label for="beginAgency">Agence de départ: </label>
                                <x-adminlte-select2 name="beginAgency" id="beginAgency" data-placeholder="Sélectionnez une agence de départ...">
                                    @foreach($agencies as $agency)
                                        <option value="{{$agency->id}}" label="{{$agency->location}}">{{$agency->location}}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                            <div class="form-group">
                                <label for="beginDate">Date de départ : </label>
                                <input type="date" value="2024-04-09" class="form-control" id="beginDate" name="beginDate" placeholder="Date de départ">
                                <br><label>Demi-journée du départ : </label><br>
                                <input type="radio" id="beginMorning" name="beginTime" value="beginMorning">
                                <label for="beginMorning">Matin</label><br>
                                <input type="radio" id="beginAfternoon" name="beginTime" value="beginAfternoon">
                                <label for="beginAfternoon">Après-midi</label>
                            </div>
                            <div class="form-group">
                                <label>Type de trajet : </label><br>
                                <input type="radio" id="go" name="path" value="go" onclick="document.getElementById('endDiv').style.display = 'block'">
                                <label for="go">Aller simple</label><br>
                                <input type="radio" id="roundTrip" name="path" value="roundTrip" onclick="document.getElementById('endDiv').style.display = 'none'">
                                <label for="roundTrip">Aller-retour</label>
                            </div>
                            <div id="endDiv">
                                <div class="form-group">
                                    <label for="endAgency">Agence de d'arrivée: </label>
                                    <x-adminlte-select2 name="endAgency" id="endAgency" data-placeholder="Sélectionnez une agence d'arrivée...">
                                        @foreach($agencies as $agency)
                                            <option value="{{$agency->id}}" label="{{$agency->location}}">{{$agency->location}}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="endDate">Date d'arrivée : </label>
                                <input type="date" value="2024-04-09" class="form-control" id="endingDate" name="endingDate" placeholder="Date d'arrivée">
                                <br><label>Demi-journée de l'arrivée : </label><br>
                                <input type="radio" id="endMorning" name="endTime" value="endMorning">
                                <label for="endMorning">Matin</label><br>
                                <input type="radio" id="endAfternoon" name="endTime" value="endAfternoon">
                                <label for="endAfternoon">Après-midi</label>
                            </div>
                        </div>


                        <div class="card-body-box-profile" id="step2">
                            <div class="form-group">
                                <x-adminlte-datatable id="table_cars" :heads="$heads">
                                    @foreach($carModels as $car)
                                        <tr>
                                            <td>{{$car->name}}</td>
                                            <td>{{$car->nbSeat}}</td>
                                            <td>{{$car->logo}}</td>
                                            <td><input type="radio" name="carModel" id="{{$car->id}}" value="{{$car->id}}"></td>
                                        </tr>
                                    @endforeach
                                </x-adminlte-datatable>
                            </div>
                        </div>


                        <div class="card-body-box-profile" id="step3">
                            <div class="form-group">
                                <label for="driver">Choix du conducteur</label>
                                <x-adminlte-select2 name="driver" id="driver" data-placeholder="">
                                    @foreach($drivers as $driver)
                                        <option label="{{$driver->firstName . " " . $driver->lastName . " " . $driver->phoneNumber}}" value="{{$driver->id}}">{{$driver->firstName . " " . $driver->lastName . " " . $driver->phoneNumber}}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button onclick="showStep(-1)" type="button" id="prevBtn" class="btn btn-primary fc-left">Previous</button>
                            <button onclick="showStep(1)" type="button" id="nextBtn" class="btn btn-primary fc-right">Next</button>
                            <input type="submit" class="btn btn-primary fc-right" id="submit_button"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        let currentStep = 1
        nextBtn = document.getElementById("nextBtn")
        prevBtn = document.getElementById("prevBtn")
        step1 = document.getElementById("step1")
        step2 = document.getElementById("step2")
        step3 = document.getElementById("step3")
        endDiv = document.getElementById("endDiv")
        submitButton = document.getElementById("submit_button")
        step2.style.display = "none";
        step3.style.display = "none";
        prevBtn.style.display = "none";
        endDiv.style.display = "none";
        submitButton.style.display = "none";


        function showStep(number) {
            currentStep = currentStep + number
            if (currentStep === 1) {
                step1.style.display = "block"
                step2.style.display = "none"
                step3.style.display = "none"
                prevBtn.style.display = "none"
            }
            if (currentStep === 2) {
                step1.style.display = "none"
                step2.style.display = "block"
                step3.style.display = "none"
                prevBtn.style.display = "block"
            }
            if (currentStep === 3) {
                step1.style.display = "none"
                step2.style.display = "none"
                step3.style.display = "block"
                prevBtn.style.display = "block"
                nextBtn.style.display = "none"
                submitButton.style.display = "block"
            }
        }
    </script>

@endsection

