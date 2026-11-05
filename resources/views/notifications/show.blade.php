@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notification Details</div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $notification->title }}</h5>
                        <p class="card-text">{{ $notification->message }}</p>
                        <p class="card-text"><small class="text-muted">Received at: {{ $notification->created_at }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
