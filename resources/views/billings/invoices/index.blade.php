@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="page-header">Billing </h2>
    <div class="row">
       
       <div class="col-md-3">
            @include('layouts.main.sidebar')
       </div>
        <div class="col-md-9">
            {{-- <div class="float-right">
                <a href="{{ route('invoices.create') }}"
                   class="btn btn-primary">New Consignment Note</a>
            </div> --}}
            <h2 class="page-header">Consignment Notes</h2>
            <invoices></invoices>
        </div>
    </div>
</div>
@endsection

