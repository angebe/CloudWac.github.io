<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use File;
use Auth;
use Input;
use Validator;
use Response;
use Illuminate\Http\Request;

class FileController extends Controller {

    public function index() {
        $files = DB::table('files')->get();
        return view('file.fileadd')->with('files', $files);
    }

    public function uploadFiles() {

        $input = Input::all();

        // $rules = array(
        //     'file' => 'image|max:3000',
        //     'mime' => ''
        //     );

        // $validation = Validator::make($input, $rules);

        // if ($validation->fails()) {
        //     return Response::make($validation->errors->first(), 400);
        // }

        $destinationPath = 'uploads'; // upload path
        $fileoriginal = Input::file('file')->getClientOriginalName();
        $filesize = Input::file('file')->getClientSize();
        $mime = Input::file('file')->getClientMimeType();
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move('uploads/'.Auth::id(), $fileName);
        // $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

        if ($upload_success) {
            DB::table('files')->insert(['user_id' => Auth::user()->id, 'originalName' => $fileoriginal, 'renamedFile' => $fileName, 'filesize' => $filesize, 'mime' => $mime]);
        } else {
            return Response::json('error', 400);
        }
    }

    public function show($id)
    {
        $file = DB::table('files')->where('id', $id)->first();
        return view('file.show')->with('file', $file);
    }

    public function edit($id)
    {
        return view('file.edit');
    }

    public function update(Request $request, $id)
    {
        if(\Auth::id()){
            $file = DB::table('files')->where('id', $id)->update(['renamedFile' => $request->name]);

            return redirect('/')->withOk("L'article " . $request->input('name') . " a été modifié.");
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $file = DB::table('files')->where('id', $id)->delete();
        return redirect()->back();
    }
    public function mine()
    {
        $files = DB::table('files')->where('id_users', Auth::user()->id)->paginate(5);
        return view('/')->with('files', $files);
    }
}
