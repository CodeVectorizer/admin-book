@extends('layouts.app')

@section('title', 'List Student')

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
                    <div class="breadcrumb-item"><a href="#">List</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Student</h4>
                                <div class="card-header-action d-flex">
                                    <form action="{{ route('students.index') }}" method="GET">
                                        <div class="input-group pr-2">
                                            <input type="text" class="form-control" name="search" placeholder="Search"
                                                value="{{ request()->query('search') }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="{{ route('reset.point') }}"><button class="btn btn-primary">Reset
                                            Point</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>NISN</th>
                                            <th>Class</th>
                                            <th>Address</th>
                                            <th>Point</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        @if ($students->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">No data available</td>
                                            </tr>
                                        @endif
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->user?->name }}</td>
                                                <td>{{ $student->user?->email }}</td>
                                                <td>{{ $student->nik }}</td>
                                                <td>{{ $student->class }}</td>
                                                <td>{{ $student->address }}</td>
                                                <td>{{ $student->point }}</td>
                                                <td>
                                                    <a href="{{ route('students.edit', $student->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('students.destroy', $student->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $students->links() }}

                                </nav>
                            </div>
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
