@extends('layouts.app')

@section('title', 'Create Student')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Student</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Student</a></div>
                    <div class="breadcrumb-item"><a href="#">Create</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('students.store') }}" method="POST">
                                @csrf
                                <div class="card-header">
                                    <h4>Create Student</h4>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6 col-lg-6">
                                        {{-- form name --}}
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror "
                                                name="name" value="{{ old('name') }}" required="">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form email --}}
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror "
                                                name="email" value="{{ old('email') }}" required="">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form password --}}
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text"
                                                class="form-control @error('password') is-invalid @enderror "
                                                name="password" value="{{ old('password') }}" required="">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form nik --}}
                                        <div class="form-group">
                                            <label>NISN</label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror "
                                                name="nik" value="{{ old('nik') }}" required="">
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form class --}}
                                        <div class="form-group">
                                            <label>Class</label>
                                            <input type="text" class="form-control @error('class') is-invalid @enderror "
                                                name="class" value="{{ old('class') }}" required="">
                                            @error('class')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form address --}}
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror " name="address"
                                                value="{{ @old('address') }}" required="">
                                            @error('address')
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
