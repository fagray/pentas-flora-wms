@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Customer</h3>
            <form method="POST" action="{{ route('settings.customers.update', $customer->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-customer :customer="{{ $customer }}"></edit-customer>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
