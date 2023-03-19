@extends('layouts.app')

@section('title', 'Edit Summary')

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
                    <div class="breadcrumb-item"><a href="#">Edit</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('csummaries.edit', ['id' => $summary->id]) }}">
                                <div class="card-header">
                                    <h4>Edit Summary</h4>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6 col-lg-6">
                                        {{-- form description --}}
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror " name="description" required=""
                                                style="height: 100px;">
                                        {{ summary->content }}
                                        </textarea>
                                            @error('content')
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
