<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $lessons = Lesson::paginate($request->perpage ?? 10);
        return view('lessons.index', compact('lessons'));
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);
        return view('lessons.show', compact('lesson'));
    }

    public function getData(Request $request)
    {
        $query = Lesson::query();

        // Determine the offset and limit for custom pagination
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;

        $query->skip($offset)->take($limit);

        // Apply search filter if provided
        if (!empty($request->search)) {
            $searchValue = $request->search;
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', "%{$searchValue}%");
            });
        }

        // Get the total count for pagination (ignores skip and take)
        $totalRecords = Lesson::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($lesson) {
                return view('lessons.partials.actions', compact('lesson'))->render();
            })
            ->rawColumns(['actions']) // Allow HTML in 'actions' column
            ->with([
                'draw' => intval($request->draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
            ])
            ->make(true);
    }

    public function add()
    {
        return view('lessons.add-edit');
    }

    public function edit($id)
    {
        $lesson = Lesson::find($id);
        return view('lessons.add-edit', compact('lesson'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|numeric',
            'name' => 'required',
            'headline' =>'required',
            'description'=>'required',
            'notes' =>'required',
            'downloadable_pdf' =>'required|file|mimes:pdf',
        ]);

        if ($request->hasFile('downloadable_pdf')) {
            $file = $request->file('downloadable_pdf');
            $timestamp = time();
            $extension = $file->getClientOriginalExtension();
            $filename = "lesson_" . $timestamp . "." . $extension;
            $validated['downloadable_pdf'] = $filename;
            $file->storeAs('lessons', $filename, 'public');
        }

        Lesson::create($validated);

        return redirect()->route('lessons.index')->with('success', 'Student added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'subject_id' => 'required|numeric',
            'name' => 'required',
            'headline' =>'required',
            'description'=>'required',
            'notes' =>'required',
            'downloadable_pdf' =>'required|file|mimes:pdf',
        ]);
        
        if ($request->hasFile('downloadable_pdf')) {
            $file = $request->file('downloadable_pdf');
            $timestamp = time();
            $extension = $file->getClientOriginalExtension();
            $filename = "lesson_" . $timestamp . "." . $extension;
            $validated['downloadable_pdf'] = $filename;
            $file->storeAs('lessons', $filename, 'public');
        }

        $student = Lesson::findOrFail($id);
        $student->update($validated);

        return redirect()->route('lessons.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Lesson::find($id);
        if ($student->downloadable_pdf) {
            Storage::disk('public')->delete('lessons/' . $student->downloadable_pdf);
        }
        $student->delete();
        return redirect()->route('lessons.index');
    }
}
