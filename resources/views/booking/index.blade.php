@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('content_header')
    <h1 class="m-0 text-dark">{{__("Bookings")}}</h1>
@stop
@php
    $heads=[
        __('Id'),
        __('Driver'),
        __('Status'),
        __('Actions'),

    ];

    $btnRead = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" type="button">
    <i class = "fa fa-lg fa-fw fa-eye"></i></button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
    <i class="fa fa-lg fa-fw fa-trash"></i></button>';
@endphp



@section('plugins.Datatables', true)

@section('content')
    @if(session()->has('success'))
        <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Succès!</strong><button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="toast-body">{{session()->get('success')}}</div></div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table_meters" :heads="$heads">
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->id}}</td>
                                <td>{{$booking->firstName}} {{$booking->lastName}}</td>
                                <td>{{$booking->status}}</td>
                                <td><a href="{{route('booking.show', $booking->id)}}">{!! $btnRead !!}</a>
                                    <form method="POST" action="{{route('booking.destroy',$booking->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit">{!! $btnDelete !!}</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
@stop
