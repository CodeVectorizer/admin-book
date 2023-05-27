@extends('layouts.app')

@section('title', 'List Summary')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Summary</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Summary</a></div>
                    <div class="breadcrumb-item"><a href="#">List</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Summary</h4>
                                <div class="card-header-action">
                                    <form action="{{ route('summaries.index') }}" method="GET">
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
                                            <th>TItle</th>
                                            <th>Content</th>
                                            <th>Student Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        @if ($summaries->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">No data available</td>
                                            </tr>
                                        @endif
                                        @foreach ($summaries as $summary)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $summary->book->title }}</td>
                                                <td>{{ $summary->content }}</td>
                                                <td>{{ $summary->student->user->name }}</td>
                                                <td>{{ $summary->status }}</td>
                                                <td>{{ $summary->created_at->diffForHumans() }}</td>
                                                <td>

                                                    {{-- <a href="{{ route('summaries.edit', $summary->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a> --}}
                                                    {{-- publish --}}
                                                    @if ($summary->status != 'published')
                                                        <a href="{{ route('summaries.publish', $summary->id) }}"
                                                            class="btn btn-primary btn-sm">Approve</a>
                                                    @else
                                                        {{-- unpublish --}}
                                                        <a href="{{ route('summaries.unpublish', $summary->id) }}"
                                                            class="btn btn-danger btn-sm">Reject</a>
                                                    @endif
                                                    {{-- <form action="{{ route('summaries.destroy', $summary->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $summaries->links() }}
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
