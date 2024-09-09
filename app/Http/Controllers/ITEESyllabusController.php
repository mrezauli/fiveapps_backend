<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\IteeSyllabus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class ITEESyllabusController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function index()
    {
        $items = IteeSyllabus::orderByDesc('id')->get();
        return view('itee.syllabus.index', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function create()
    {
        return view('itee.syllabus.create');
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function edit($id)
    {
        $item = IteeSyllabus::findOrFail($id);

        return view('itee.syllabus.edit', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        $message = 'ITEE Syllabus successfully ';
        if ($request->has('id')) {
            $iteeSyllabus = IteeSyllabus::find($request->id);
            $rules['name'] = 'required';
            $rules['syllabus_file'] = 'required|file|max:21000|mimes:pdf';
            $rules['status'] = 'required';
            $message = $message . ' updated';
        } else {
            $iteeSyllabus = new IteeSyllabus();
            $rules['name'] = 'required';
            $rules['syllabus_file'] = 'required|file|max:21000|mimes:pdf';
            $rules['status'] = 'required';
            $message = $message . ' created';
        }
        $request->validate($rules);
        $oldFile = $iteeSyllabus->syllabus_file;
        if ($request->hasFile('syllabus_file')) {
            $file = CustomHelper::fileSystem($request->file('syllabus_file'), "/itee/syllabus/");
        }
        try {
            $iteeSyllabus->name = $request->name;
            $iteeSyllabus->syllabus_file = $file->path ?? $oldFile;
            $iteeSyllabus->status = $request->status;

            if ($iteeSyllabus->save()) {
                if ($request->hasFile('syllabus_file') && $oldFile) {
                    CustomHelper::deleteFile($oldFile);
                }
                return redirect()->route('itee.syllabus.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            if ($request->hasFile('syllabus_file') && $file) {
                CustomHelper::deleteFile($file->path);
            }
            return RedirectHelper::backWithInputFromException();
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function delete($id)
    {
        $iteeSyllabus = IteeSyllabus::find($id);
        if ($iteeSyllabus) {
            if ($iteeSyllabus->delete()) {
                CustomHelper::deleteFile($iteeSyllabus->syllabus_file);
                return redirect()->route('itee.syllabus.index')->with('success', 'Itee Exam Category deleted successfully');
            }
        }
        return redirect()->route('itee.syllabus.index')->with('error', 'Something went wrong');
    }
}
