@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Центр - {{$center->center_name}}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <map-component
                                    :items="{{ json_encode([$center]) }}"
                            ></map-component>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 offset-md-3    ">
                            <table class="table table-responsive">
                                <tr>
                                    <td>Название:</td>
                                    <td>{{ $center->center_name }}</td>
                                </tr>
                                <tr>
                                    <td>Телефон:</td>
                                    <td>{{ $center->phone  }}</td>
                                </tr>
                                <tr>
                                    <td>Федеральный округ:</td>
                                    <td>{{ $center->okrug }}</td>
                                </tr>
                                <tr>
                                    <td>Регион:</td>
                                    <td>{{ $center->region->name }}</td>
                                </tr>
                                <tr>
                                    <td>Населенный пункт:</td>
                                    <td>{{ $center->city->name }}</td>
                                </tr>
                                <tr>
                                    <td>Адрес:</td>
                                    <td>{{ $center->address[0]->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    table td{
        font-size: 2rem;
    }
</style>
