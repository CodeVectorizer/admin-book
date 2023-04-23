@extends('layouts.app')

@section('title', 'Lihat Summary')

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
                    <div class="breadcrumb-item"><a href="#">Create</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Content</th>
                                            <th>Status</th>
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
                                                <td>{{ $summary->student->user->name }}</td>
                                                <td>{{ $summary->content }}</td>
                                                <td>{{ $summary->status }}</td>
                                                <td>

                                                    {{-- <a href="{{ route('summaries.edit', $summary->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a> --}}
                                                    {{-- publish --}}
                                                    <a href="{{ route('summaries.publish', $summary->id) }}"
                                                        class="btn btn-success btn-sm">Publish</a>
                                                    {{-- unpublish --}}
                                                    <a href="{{ route('summaries.unpublish', $summary->id) }}"
                                                        class="btn btn-danger btn-sm">Unpublish</a>
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
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
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
