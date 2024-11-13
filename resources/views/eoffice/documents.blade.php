@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark">
                <div class="card-header bg-dark text-white">
                    <h1 class="mb-0">Documents</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('eoffice.documents.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="text-white">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="category" class="text-white">Category:</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="sekolah">Sekolah</option>
                                <option value="mantan guru">Mantan Guru</option>
                                <option value="guru baru">Guru Baru</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file" class="text-white">File:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" required>
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Document</button>
                    </form>

                    <h2 class="text-white">Categories</h2>
                    <div class="list-group mb-4">
                        <a href="{{ route('eoffice.documents.category', 'sekolah') }}" class="list-group-item list-group-item-action bg-dark text-white">Sekolah</a>
                        <a href="{{ route('eoffice.documents.category', 'mantan guru') }}" class="list-group-item list-group-item-action bg-dark text-white">Mantan Guru</a>
                        <a href="{{ route('eoffice.documents.category', 'guru baru') }}" class="list-group-item list-group-item-action bg-dark text-white">Guru Baru</a>
                    </div>

                    <h2 class="text-white">Uploaded Documents</h2>
                    <div class="list-group">
                        @foreach($documents as $document)
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                            <div>
                                <strong>{{ $document->title }}</strong> ({{ $document->category }})
                            </div>
                            <div>
                                <a href="{{ asset('storage/' . $document->file_path) }}" download class="btn btn-outline-primary btn-sm mr-2">Download</a>
                                @if(in_array(pathinfo($document->file_path, PATHINFO_EXTENSION), ['pdf', 'jpg', 'jpeg', 'png']))
                                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-outline-success btn-sm">View</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection