<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreNoteRequest $request)
    {

        $validated = $request->validated();

        $notableType =  $validated['notable_type'];

        if (!class_exists($notableType)) {
            return back()->with('error', 'Invalid notable type provided.');
        }

        $notable = $notableType::find($validated['notable_id']);

        if (!$notable) {
            return back()->with('error', 'The associated record could not be found.');
        }
        // return $notable;

        $note = new Note();
        $note->note = $validated['note'];
        $note->notable_id = $notable->id;
        $note->notable_type = $notableType;
        $note->added_by = Auth::id();
        $note->save();

        return back()->with('success', 'Note added successfully.');
    }
}
