<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ilovepdf\Ilovepdf;

class PdfController extends Controller
{
    public function index()
    {
        return view('compresspdf'); // Menampilkan form upload
    }

    public function mergePdf(Request $request)
    {

        // you can call task class directly
        // to get your key pair, please visit https://developer.ilovepdf.com/user/projects
        $ilovepdf = new Ilovepdf('project_public_id', 'project_secret_key');

        // and get the task tool
        $myTask = $ilovepdf->newTask('merge');

        // file var keeps info about server file id, name...
        // it can be used latter to cancel a specific file
        $fileA = $myTask->addFile('/path/to/file/document_a.pdf');
        $fileB = $myTask->addFile('/path/to/file/document_b.pdf');

        // and set name for output file.
        // the task will set the correct file extension for you.
        $myTask->setOutputFilename('merged_filename');

        // process files
        $myTask->execute();

        // and finally download file. If no path is set, it will be downloaded on current folder
        $myTask->download('path/to/download');
    }
}
