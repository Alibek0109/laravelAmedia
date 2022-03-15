@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center mb-3">Applications</h2>
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
                        <img src="{{ asset($el->file) }}" style="width: 300px; height: 400px;" class="py-2"
                            alt="">
                        <div class="card-body">
                            <h3>Subject: {{ $el->subject }}</h3>
                            <h5>Message: {{ $el->message }}</h5>
                            @if($el->created_at != $el->updated_at)
                            <p class="text-primary">Updated</p>
                            @endif
                            <p>Created: {{ $el->created_at->format('d F Y. H:i:s') }}</p>
                            <div class="row">
                                <div class="col-md-3"> <a href="{{ route('home.user.edit', ['id' => $el->id]) }}"
                                        class="btn btn-warning">Edit</a>
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('home.user.destroy', ['id' => $el->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            @if ($el->status == 0)
                                <p class="text-muted">Under review</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
