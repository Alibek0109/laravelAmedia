@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h2 class="text-center">Application form</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('home.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                </div>
                <div class="form-group mb-2">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="form-group">
                    <label for="file">Upload file</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="width:100px">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection
