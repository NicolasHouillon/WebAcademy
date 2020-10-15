<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param Attachment $attachment
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Attachment $attachment)
    {
        Storage::delete($attachment->file);
        $attachment->delete();
        return back();
    }

}
