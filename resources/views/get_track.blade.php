@extends('layouts.app')
@push('track-script')
    <script src="{{ asset('js/tracking.js') }}"></script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ route('detect-carrier') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="track_number" class="form-control @error('track_number') is-invalid @enderror" placeholder="Enter track number">
                            @error('track_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-info track_number_button text-white">Отправить</button>
                    </form>
                    <div id="track-result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
