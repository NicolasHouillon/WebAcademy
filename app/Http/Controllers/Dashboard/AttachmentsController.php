<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Course;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{

    public function index()
    {
        return view('admin.attachments.index', [
            'attachments' => Attachment::orderBy('id', 'desc')->get()
        ]);
    }

    public function show(Attachment $attachment) {
        return view('admin.attachments.show', [
            'attachment' => $attachment
        ]);
    }

    public function edit(Attachment $attachment)
    {
        return view('admin.attachments.edit', [
            'attachment' => $attachment,
            'courses' => Course::select('id', 'name')->get()
        ]);
    }

    public function update(Request $request, Attachment $attachment)
    {
        $attachment->name = $request->get('name');
        $attachment->course_id = $request->get('course');
        $attachment->save();
        return redirect()->route('admin.attachments.index')->with('success', "Le fichier a bien été mis à jour.");
    }

    public function destroy(Attachment $attachment)
    {
        $attachment->delete();
        return redirect()->route('admin.attachments.index')->with('success', "Le fichier a bien été supprimé.");
    }

}
