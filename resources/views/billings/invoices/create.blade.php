@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h3 class="page-header">New Consignment Note</h3>
    <form method="POST"
          action="{{ route('invoices.store') }}">
        {{ csrf_field() }}
        <add-invoice :job="{{ $job }}" :customer="{{ $customer }}"></add-invoice>
        @include('layouts.bottom-nav')
    </form>
        </div>
    </div>
</div>
@endsection