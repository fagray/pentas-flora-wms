@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="float-right">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary" >New Job Order</a>
            </div>
            <h3 class="page-header">Job Orders</h3>
            <jobs></jobs>
        </div>
    </div>
</div>

@endsection
