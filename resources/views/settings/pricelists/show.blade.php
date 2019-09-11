@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Pricelist > {{ $pricelist->name }} </h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Waste Desc</th>
                        <th>SRP</th>
                        <th>Listed Price (Custom price)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pricelist->wastes as $waste)
                        <tr>
                            <td> ({{ $waste->code }}) {{ $waste->name }} </td>
                            <td> {{ $waste->unit_price }} </td>
                            <td> {{ $waste->pivot->unit_price }} </td>
                            
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection
