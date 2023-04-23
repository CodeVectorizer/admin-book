@extends('layouts.app')

@section('title', 'Edit Book')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Book</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Book</a></div>
                    <div class="breadcrumb-item"><a href="#">Edit</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="POST" action="{{ route('books.update', ['book' => $book]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Book</h4>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6 col-lg-6">
                                        {{-- form title --}}
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror "
                                                name="title" value="{{ $book->title }}" required="">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form publisher --}}
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <input type="text"
                                                class="form-control @error('publisher') is-invalid @enderror "
                                                name="publisher" value="{{ $book->publisher }}" required="">
                                            @error('publisher')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form author --}}
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input type="text"
                                                class="form-control @error('author') is-invalid @enderror " name="author"
                                                value="{{ $book->author }}" required="">
                                            @error('author')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form year --}}
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control @error('year') is-invalid @enderror "
                                                name="year" value="{{ $book->year }}" required="">
                                            @error('year')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">

                                        {{-- form isbn --}}
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input type="text" class="form-control @error('isbn') is-invalid @enderror "
                                                name="isbn" value="{{ $book->isbn }}" required="">
                                            @error('isbn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form cover file --}}
                                        <div class="form-group">
                                            <label>Cover</label>

                                            <input type="file" class="form-control @error('cover') is-invalid @enderror "
                                                name="cover" value="{{ asset('storage/books/' . $book->cover) }}">
                                            @if ($book->cover)
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('storage/books/' . $book->cover) }}" alt=""
                                                        class="imagecheck-image">
                                                </figure>
                                            @endif
                                            @error('cover')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form file --}}
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror "
                                                name="file" value="{{ asset('storage/books/' . $book->file) }}">
                                            @error('file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form description --}}
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror "
                                                name="description" "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        required="" style="height: 100px;">
                                        {{ $book->description }}
                                        </textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
