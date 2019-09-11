@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">New Workshop Under {{ $customer->display_name }} </h3>
            <form method="POST" action="{{ route('settings.customers.workshops.store', $customer->id) }}">
                {{ csrf_field() }}
                <add-workshop :customer=" {{ $customer }} "></add-workshop>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
