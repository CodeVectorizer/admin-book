@extends('layouts.app')

@section('title', 'Create Writing')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Writing</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Writing</a></div>
                    <div class="breadcrumb-item"><a href="#">Create</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('writings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Create Writing</h4>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6 col-lg-6">
                                        {{-- form title --}}
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror "
                                                name="title" value="{{ old('title') }}" required="">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Cover</label>
                                            <input type="file" class="form-control @error('cover') is-invalid @enderror "
                                                name="cover" value="@old('cover'))" required="">
                                            @error('cover')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        {{-- form title --}}
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror "
                                                name="description" value="{{ old('description') }}" required="">
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        {{-- form cover file --}}

                                        {{-- form content --}}
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror " name="content" required=""
                                                style="width: 100%">
                                        {{ old('content') }}
                                        </textarea>
                                            @error('content')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card-footer text-left">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
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
