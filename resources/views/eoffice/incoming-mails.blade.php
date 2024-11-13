@extends('layouts.app')

@section('content')
    <h1>Incoming Mails</h1>
    
    <form action="{{ route('eoffice.incoming-mails.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Subject:</label>
            <input type="text" name="subject" required>
        </div>
        <div>
            <label>Sender:</label>
            <input type="text" name="sender" required>
        </div>
        <div>
            <label>File:</label>
            <input type="file" name="file" required>
        </div>
        <button type="submit">Upload Incoming Mail</button>
    </form>

    <hr>

    <h2>Uploaded Incoming Mails</h2>
    <ul>
        @foreach($incomingMails as $mail)
            <li>{{ $mail->subject }} from {{ $mail->sender }} - <a href="{{ asset('storage/' . $mail->file_path) }}">Download</a></li>
        @endforeach
    </ul>
@endsection
