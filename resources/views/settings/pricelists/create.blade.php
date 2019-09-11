@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="page-header">New Pricelist</h3>
            <form method="POST" action="{{ route('settings.pricelists.store') }}">
                {{ csrf_field() }}
                <add-pricelist :units="{{ $units }}" :wastes="{{ $wastes }}"></add-pricelist>
                @include('layouts.bottom-nav')
            </form>
        </div><!-- end content -->
    </div>
</div>
@endsection
