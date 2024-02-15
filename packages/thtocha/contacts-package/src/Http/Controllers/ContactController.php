<?php

namespace Thtocha\ContactsPackage\Http\Controllers;

use Thtocha\ContactsPackage\Http\Requests\ContactRequest;
use Thtocha\ContactsPackage\Http\Resources\ContactResource;
use Thtocha\ContactsPackage\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::with('phones')->paginate(10);

        return ContactResource::collection($contact);
    }

    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        $contact = Contact::create($data);
        foreach ($data['phones'] as $phone) {
            $contact->phones()->create(['phone_number' => $phone]);
        }

       return response()->json(['message' => 'Contact created successfully', 'data' => new ContactResource($contact)], 201);
    }
}
