@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h2 class="text-center">Application form</h2>

            <form action="{{ route('home.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject"
                        placeholder="Subject" value="{{old('subject')}}">
                    @error('subject')
                        <div class="alert alert-danger py-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                        placeholder="Message">{{old('message')}}</textarea>
                    @error('message')
                        <div class="alert alert-danger py-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file">Upload file</label>
                    <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file"
                        required>
                    @error('file')
                        <div class="alert alert-danger py-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="width:100px">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection
