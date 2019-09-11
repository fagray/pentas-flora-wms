@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.pricelists.create') }}"
                   class="btn btn-primary">New Pricelist</a>
            </div>
            <h3 class="page-header">Pricelists</h3>
            <pricelists></pricelists>
        </div>
    </div>
</div>
@endsection