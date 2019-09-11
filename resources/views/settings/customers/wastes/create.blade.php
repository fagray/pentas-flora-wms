@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Add Waste Items For {{ $customer->display_name }} </h3>
            <form method="POST" action="{{ route('settings.customers.wastes.store',$customer->id) }}">
                {{ csrf_field() }}
                <add-customer-waste-items :customer="{{ $customer }}" :waste-items="{{ $wasteItems }}"></add-customer-waste-items>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
