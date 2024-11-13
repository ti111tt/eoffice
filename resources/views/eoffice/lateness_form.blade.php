@extends('layouts.app')

@section('content')
    <h2>Formulir Keterlambatan Kehadiran Masuk Kerja</h2>
    <form action="{{ route('eoffice.lateness_form') }}" method="POST">
        @csrf

        <!-- Personal Information Section -->
        <label for="name">Nama:</label>
        <input type="text" name="name" required>

        <label for="employee_id">NIK:</label>
        <input type="text" name="employee_id" required>

        <label for="department">Bagian:</label>
        <input type="text" name="department" required>

        <!-- Lateness Details Section -->
        <h4>Alasan Keterlambatan:</h4>
        <label for="lateness_reason">Alasan Keterlambatan:</label>
        <textarea name="lateness_reason" required></textarea>

        <label for="proof_attachment">Lampirkan Bukti (WA & Foto Selfie Kejadian):</label>
        <input type="file" name="proof_attachment">

        <label for="date">Hari/Tanggal:</label>
        <input type="date" name="date" required>

        <label for="arrival_time">Jam Kehadiran:</label>
        <input type="time" name="arrival_time" required>

        <label for="lateness_duration">Jumlah Keterlambatan (Jam/Menit):</label>
        <input type="time" name="lateness_duration" required>

        <!-- Submission Button -->
        <button type="submit">Submit</button>
    </form>
@endsection
