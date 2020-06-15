<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $CKEditor = $request->input('CKEditor');
        $funcNum = $request->input('CKEditorFuncNum');
        $message = $url = '';
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if ($file->isValid()) {
                $filename = uniqid().'_'.$file->getClientOriginalName();

                $path = public_path().'/uploads';
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }

                $file->move('uploads', $filename);
                $url = asset('uploads/'.$filename);
            } else {
                $message = 'An error occurred while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        @header('Content-type: text/html; charset=utf-8');
        echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
