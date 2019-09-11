@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       
        @include('layouts.settings.sidebar')
        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.processing-centres.create') }}" class="btn btn-primary" >New Processing Centre</a>
            </div>
            <h3 class="page-header">Processing Centres</h3>
            <processing-centres-list> </processing-centres-list>
        </div><!-- end content -->
    </div>
</div>
@endsection
