@extends('layouts.app')

@section('content')
    <h1>eOffice Dashboard</h1>
    <p>Welcome to the eOffice system. You can manage documents, mails, and leave requests here.</p>

    <ul>
        <li><a href="{{ route('eoffice.documents') }}">Documents</a></li>
        <li><a href="{{ route('eoffice.incoming-mails') }}">Incoming Mails</a></li>
        <li><a href="{{ route('eoffice.outgoing-mails') }}">Outgoing Mails</a></li>
        <li><a href="{{ route('eoffice.leave-requests') }}">Leave Requests</a></li>
    </ul>
@endsection
