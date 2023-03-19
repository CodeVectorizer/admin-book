@extends('layouts.app')

@section('title', 'Create Book')

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
                    <div class="breadcrumb-item"><a href="#">Create</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Book</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Publisher</th>
                                            <th>Year</th>
                                            <th>ISBN</th>
                                            <th>Cover</th>
                                            <th>File</th>
                                            <th>Description</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        @if ($books->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">No data available</td>
                                            </tr>
                                        @endif
                                        @foreach ($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->author }}</td>
                                                <td>{{ $book->publisher }}</td>
                                                <td>{{ $book->year }}</td>
                                                <td>{{ $book->isbn }}</td>
                                                <td><img width="100" height="100"
                                                        src="{{ asset("storage/books/$book->cover") }}" alt="">
                                                </td>
                                                <td><a href="{{ asset("storage/books/$book->file") }}" class="text-primary"
                                                        target="_blank">Download</a></td>
                                                <td>{{ $book->description }}</td>
                                                <td>
                                                    <a href="{{ route('books.edit', $book) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                        class="d-inline">
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
