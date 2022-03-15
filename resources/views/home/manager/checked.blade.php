@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center mb-5">Checked messages</h2>
            <hr>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            @if ($data->all() == null)
                <h3 class="alert alert-info col-md-4 text-center">
                    No checked message
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

                            @if ($el->status === 1)
                                <form action="{{ route('home.manager.update', ['id' => $el->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-2">
                                        <textarea class="form-control" name="reply_message"
                                            placeholder="Reply">{{ $el->feedback->reply_message }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </form>
                                <form action="{{ route('home.manager.destroy', ['id' => $el->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Recheck</button>
                                </form>
                            @endif

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
