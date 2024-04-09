@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('content_header')
    <h1 class="m-0 text-dark">{{__('Booking')}} n°{{$booking[0]->id}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="row-col-m-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>{{__('Id')}} : &nbsp;</b><span class="float-right">{{$booking[0]->id}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('BeginDate')}} : &nbsp;</b><span class="float-right">{{$booking[0]->beginDate}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('EndingDate')}} : &nbsp;</b><span class="float-right">{{$booking[0]->endingDate}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('CarModel')}} : &nbsp;</b><span class="float-right">{{$booking[0]->model}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('CarLicencePlate')}} : &nbsp;</b><span class="float-right">{{$booking[0]->licensePlate}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('AgencyAddress')}} : &nbsp;</b><span class="float-right">{{$booking[0]->agencyPostalCode.$booking[0]->agencyLocation}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('AgencyName')}} : &nbsp;</b><span class="float-right">{{$booking[0]->agencyName}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('DriverName')}} : &nbsp;</b><span class="float-right">{{$booking[0]->firstName.'  '.$booking[0]->lastName}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('DriverPhoneNumber')}} : &nbsp;</b><span class="float-right">{{$booking[0]->driverPhoneNumber}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('StatusName')}} : &nbsp;</b><span class="float-right">{{$booking[0]->status}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('PathType')}} : &nbsp;</b><span class="float-right">{{$booking[0]->pathType}}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>



@stop
