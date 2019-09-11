@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')
       
        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.customers.create') }}"
                   class="btn btn-primary">New Customer</a>
            </div>
            <h3 class="page-header">Customers</h3>
            <customers></customers>
        </div>
    </div>
</div>
@endsection