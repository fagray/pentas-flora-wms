@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')
        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.employees.create') }}" class="btn btn-primary" >New Employee</a>
            </div>
            <h3 class="page-header">Employees</h3>
            
            <employees-list> </employees-list>
        </div><!-- end content -->
    </div>
</div>
@endsection
