@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="page-header">Billing </h2>
    <div class="row">
       
       <div class="col-md-3">
            @include('layouts.main.sidebar')
       </div>
        <div class="col-md-9">
            <div class="float-right">
                {{-- <a href="#"
                   class="btn btn-primary">New Payment</a> --}}
            </div>
            <h2 class="page-header">Payments</h2>
            <payments></payments>
        </div>
    </div>
</div>
@endsection

