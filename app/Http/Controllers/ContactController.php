<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('user_id', auth()->id())->paginate(2);
    
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'phone' => 'nullable|numeric',
            'email' => 'required|email|unique:contacts,email',
        ]);
    
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->company = $request->input('company');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->user_id = auth()->id();
        $contact->save();
    
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact->delete();
        return response()->json(['success' => true]);
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Paginate results
        $contacts = Contact::where('name', 'like', '%' . $query . '%')
                            ->paginate(2);
    
        // Render the contact list and pagination HTML
        $html = view('contacts.partials.contact-list', compact('contacts'))->render();
        $pagination = view('contacts.partials.pagination', ['contacts' => $contacts])->render();
    
        return response()->json([
            'html' => $html,
            'pagination' => $pagination,
        ]);
    }

    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable|string|max:15',
        ]);

        $contact->update($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }
}

