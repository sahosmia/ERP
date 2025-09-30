<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Supplier;
use App\Models\Fabric;

class NoteController extends Controller
{
    /**
     * Store a newly created note in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|string',
            'notable_id' => 'required|integer',
            'notable_type' => 'required|string|in:App\Models\Supplier,App\Models\Fabric',
        ]);

        $model = $request->notable_type::findOrFail($request->notable_id);

        $note = new Note([
            'note' => $request->note,
            'added_by' => auth()->id(),
        ]);

        $model->notes()->save($note);

        return back()->with('success', 'Note added successfully.');
    }
}