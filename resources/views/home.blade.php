@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Centers</div>
                    <app-component :items="{{ json_encode($items) }}"></app-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
