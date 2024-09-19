<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->company }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <!-- Actions like Edit/Delete -->
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <button data-url="{{ route('contacts.destroy', $contact->id) }}" class="btn btn-sm btn-danger delete-contact">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No contacts found</td>
            </tr>
        @endforelse
    </tbody>
</table>
