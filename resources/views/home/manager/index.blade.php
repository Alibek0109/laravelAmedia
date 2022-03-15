@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center mb-5">New messages</h2>
            <hr>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($data->all() == null)
                <h3 class="alert alert-info col-md-4 text-center">
                    No new message
                </h3>
            @else
                @foreach ($data as $el)
                    <div class="card m-2" style="width: 320px;">
                        <img src="{{ asset($el->file) }}" style="width: 300px; height: 400px;" class="py-2"
                            alt="">
                        <div class="card-body">
                            <h3>Subject: {{ $el->subject }}</h3>
                            <h5>Message: {{ $el->message }}</h5>
                            <h5>Name: {{ $el->user->name }}</h5>
                            <h5>Email: {{ $el->user->email }}</h5>
                            <p>Created: {{ $el->created_at->format('d F Y. H:i:s') }}</p>
                            <hr>

                            @if ($el->status === 0)
                                <form action="{{ route('home.manager.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <textarea class="form-control" name="reply_message"
                                            placeholder="Reply"></textarea>

                                    </div>
                                    <input type="hidden" name="user_id" value="{{ $el->user->id }}">
                                    <input type="hidden" name="app_id" value="{{ $el->id }}">
                                    <button type="submit" class="btn btn-primary">Reply</button>
                                </form>
                            @endif

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
