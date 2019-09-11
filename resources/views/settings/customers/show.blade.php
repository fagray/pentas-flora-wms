@extends('layouts.app')

@section('content')
    <div class="container">
    
        <view-customer :customer="{{ $customer }}"> </view-customer>
        
    </div>
@endsection
