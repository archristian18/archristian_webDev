<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .button-group .btn {
            margin-right: 10px;
        }
        .button-group .logout-btn {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Contacts</h1>

        <div class="button-group mb-3">
            <!-- Button to redirect to create contact page -->
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Create New Contact</a>

            <!-- Logout button -->
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" class="logout-btn">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endif
        </div>

        <input type="text" id="search" placeholder="Search contacts..." class="form-control mb-3">

        <div id="contacts-list">
            @include('contacts.partials.contact-list')
        </div>

        <div class="d-flex justify-content-center">
            {{ $contacts->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle search functionality
            const searchInput = document.getElementById('search');
            const contactsList = document.getElementById('contacts-list');

            searchInput.addEventListener('keyup', function () {
                const query = this.value;

                fetch('{{ route('contacts.search') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ query })
                })
                .then(response => response.json())
                .then(data => {
                    contactsList.innerHTML = data.html;
                    // Update pagination if necessary
                    if (data.pagination) {
                        document.querySelector('.pagination').innerHTML = data.pagination;
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            // Handle delete functionality
            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('delete-contact')) {
                    if (confirm('Are you sure you want to delete this contact?')) {
                        fetch(e.target.dataset.url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                e.target.closest('tr').remove();
                            }
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>
