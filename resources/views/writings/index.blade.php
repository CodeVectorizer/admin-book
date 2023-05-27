@extends('layouts.app')

@section('title', 'List Writing')

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
                    <div class="breadcrumb-item"><a href="#">List</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Writing</h4>
                                <div class="card-header-action">
                                    <form action="{{ route('writings.index') }}" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search"
                                                value="{{ request()->query('search') }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Title</th>
                                            {{-- <th>Description</th> --}}
                                            {{-- <th>Cover</th> --}}
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        @if ($writings->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">No data available</td>
                                            </tr>
                                        @endif
                                        @foreach ($writings as $writing)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $writing->student->user->name }}</td>
                                                <td>{{ $writing->title }}</td>
                                                <td>{{ $writing->content }}</td>
                                                <td>{{ $writing->status }}</td>
                                                <td>
                                                    <a href="{{ route('writings.publish', $writing->id) }}"
                                                        class="btn btn-success btn-sm">Publish</a>
                                                    <a href="{{ route('writings.unpublish', $writing->id) }}"
                                                        class="btn btn-danger btn-sm">Unpublish</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $writings->links() }}
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
