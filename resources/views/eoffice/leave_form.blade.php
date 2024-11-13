<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    
    <style>
        body {
            background-color: #333;
        }
        .card {
            background-color: #fff;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h1 class="mb-0">Leave Request Form</h1>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('eoffice.leave_form') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="employee_id">Employee ID:</label>
                                <input type="text" class="form-control" name="employee_id" required>
                            </div>
                            <div class="form-group">
                                <label for="position">Position:</label>
                                <input type="text" class="form-control" name="position" required>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch:</label>
                                <input type="text" class="form-control" name="branch" required>
                            </div>
                            <div class="form-group">
                                <label for="application_date">Application Date:</label>
                                <input type="date" class="form-control" name="application_date" required>
                            </div>
                            <div class="form-group">
                                <label for="leave_type">Leave Type:</label>
                                <input type="text" class="form-control" name="leave_type" required>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="form-group">
                                <label for="total_days">Total Days:</label>
                                <input type="number" class="form-control" name="total_days" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_address">Contact Address:</label>
                                <input type="text" class="form-control" name="contact_address" required>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason:</label>
                                <textarea class="form-control" name="reason" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>