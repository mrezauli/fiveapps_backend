<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Models\BkiictCoursePdf;
use Exception;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class BKIICTCoursePdfController extends Controller
{

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                if ($request->has('id') && $request->has('latest')) {
                    $pdf = BkiictCoursePdf::find($request->id);
                    if (!$pdf) {
                        throw new Exception('Pdf not found');
                    }
                    if ($pdf->status == 0) {
                        throw new Exception('Pdf is not active');
                    }
                    BkiictCoursePdf::where('id', '!=', $pdf->id)->update(['front' => false]);
                    $pdf->update(['front' => true]);
                    return redirect()->route('bkiict.course_pdf.index')->with('success', $pdf->name . ' set as latest successfully');
                } else {
                    throw new Exception('Invalid request');
                }
            } catch (Exception $e) {
                return redirect()->route('bkiict.course_pdf.index')->with('error', $e->getMessage());
            }
        } else {
            $pdfs = BkiictCoursePdf::orderByDesc('front')->orderByDesc('id')->get();
            return view('bkiict.coursepdf.index', get_defined_vars());
        }
    }
    public function create()
    {
        return view('bkiict.coursepdf.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'file' => 'nullable|file|mimes:pdf|max:6144',
            'status' => 'required|in:1,0',
        ]);

        try {
            if ($request->has('id')) {
                $file = null;
                if ($request->has('file')) {
                    $file = CustomHelper::storeImage($request->file('file'), '/bkiict/pdfs/');
                }
                $pdf = BkiictCoursePdf::find($request->id);
                if (!$pdf) {
                    throw new Exception('Pdf not found');
                }
                $pdf->update(
                    [
                        'name' => $request->name,
                        'file' => $file ?? $pdf->file,
                        'status' => $request->status,
                    ]
                );
                return redirect()->back()->with('success', 'Pdf updated successfully');
            } else {
                if (!$request->hasFile('file')) {
                    throw new Exception('Pdf file is required');
                }
                $file = CustomHelper::storeImage($request->file('file'), '/bkiict/pdfs/');
                BkiictCoursePdf::create(
                    [
                        'name' => $request->name,
                        'file' => $file,
                        'front' => false,
                        'status' => $request->status,
                    ]
                );
                return redirect()->route('bkiict.course_pdf.index')->with('success', 'Pdf created successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
        try {
            $pdf = BkiictCoursePdf::findOrFail($id);
            return view('bkiict.coursepdf.edit', get_defined_vars());
        } catch (Exception $e) {
            return redirect()->route('bkiict.course_pdf.index')->with('error', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $pdf = BkiictCoursePdf::findOrFail($id);
            CustomHelper::deleteFile('/bkiict/pdfs/' . $pdf->file);
            $pdf->delete();
            return redirect()->route('bkiict.course_pdf.index')->with('success', 'Pdf deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('bkiict.course_pdf.index')->with('error', $e->getMessage());
        }

    }
}
