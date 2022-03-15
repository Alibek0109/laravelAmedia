@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center mb-3">Checked messages</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($data->all() == null)
                <h3 class="alert alert-info col-md-4 text-center">
                    No applications
                </h3>
            @else
                @foreach ($data as $el)
                    <div class="card m-2" style="width: 320px;">
                        <img src="{{ asset($el->file) }}" style="width: 300px; height: 400px;" class="py-2" alt="">
                        <div class="card-body">
                            <h3>Subject: {{ $el->subject }}</h3>
                            <h5>Message: {{ $el->message }}</h5>
                            <p>Created: {{$el->created_at->format('d F Y. H:i:s')}}</p>
                            <hr>
                            <h4>Reply from Manager: <span class="text-primary">{{$el->feedback->reply_message}}</span> </h4>
                            <p class="mb-3">Created: {{$el->feedback->created_at->format('d F Y. H:i:s')}}</p>
                            @if($el->status == 1)
                            <p class="text-primary">Verified</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
