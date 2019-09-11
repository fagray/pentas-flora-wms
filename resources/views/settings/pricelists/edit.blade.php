@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Pricelist</h3>
            <form method="POST" action="{{ route('settings.pricelists.update', $pricelist->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-pricelist :wastes="{{ $wastes }}" :units="{{ $units }}" :pricelist="{{ $pricelist }}"></edit-pricelist>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
