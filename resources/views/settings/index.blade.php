@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">General Settings</h3>
            <form method="POST"
                    enctype="multipart/form-data"
                  action="{{ route('settings.store') }}">
                {{ csrf_field() }}
            <general-settings :settings="{{ $settings }}"></general-settings>
            @include('layouts.bottom-nav')
            </form>
        </div>
    </div>
</div>
@endsection
