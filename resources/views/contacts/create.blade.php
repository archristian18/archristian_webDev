<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contact</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create Contact</h1>

        <!-- Display error messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" name="company" class="form-control" id="company" placeholder="Enter company" value="{{ old('company') }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter phone" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Contact</button>
        </form>
    </div>
</body>
</html>
