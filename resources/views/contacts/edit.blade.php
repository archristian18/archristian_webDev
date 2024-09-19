<!-- resources/views/contacts/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Contact</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Contact</h1>

        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $contact->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input type="text" id="company" name="company" class="form-control" value="{{ old('company', $contact->company) }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $contact->phone) }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Contact</button>
        </form>
    </div>
</body>
</html>
