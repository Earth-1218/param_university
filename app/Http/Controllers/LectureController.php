<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        $lectures = Lecture::paginate($request->perpage ?? 10);
        return view('lectures.index', compact('lectures'));
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);
        return view('lectures.show', compact('lecture'));
    }

    public function getData(Request $request)
    {
        $query = Lecture::query();

        // Determine the offset and limit for custom pagination
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;

        $query->skip($offset)->take($limit);

        // Apply search filter if provided
        if (!empty($request->search)) {
            $searchValue = $request->search;
            $query->where(function ($q) use ($searchValue) {
                $q->where('title', 'like', "%{$searchValue}%")
                    ->orWhere('course_id', 'like', "%{$searchValue}%")
                    ->orWhere('subject_id', 'like', "%{$searchValue}%")
                    ->orWhere('start', 'like', "%{$searchValue}%")
                    ->orWhere('end', 'like', "%{$searchValue}%")
                    ->orWhere('duration', 'like', "%{$searchValue}%")
                    ->orWhere('total_marks', 'like', "%{$searchValue}%")
                    ->orWhere('passing_marks', 'like', "%{$searchValue}%");
            });
        }

        // Get the total count for pagination (ignores skip and take)
        $totalRecords = Lecture::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($student) {
                return view('students.partials.actions', compact('student'))->render();
            })
            ->rawColumns(['actions']) // Allow HTML in 'actions' column
            ->with([
                'draw' => intval($request->draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
            ])
            ->make(true);
    }

    public function create()
    {
        return view('lectures.add-edit');
    }

    public function add()
    {
        return view('lectures.add-edit');
    }

    public function edit($id)
    {
        $lecture = Lecture::find($id);
        return view('lectures.add-edit', compact('lecture'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faculty_id' => 'required|integer',
            'course_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'lesson_id' => 'required|integer',
            'duration' => 'required|integer',
            'comments' => 'required',
            'status' => 'required|in:pening,ongoing,completed',
        ]);

        Lecture::create($validated);

        return redirect()->route('lectures.index')->with('success', 'Lecture added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'faculty_id' => 'required|integer',
            'course_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'lesson_id' => 'required|integer',
            'duration' => 'required|integer',
            'comments' => 'required',
            'status' => 'required|in:pening,ongoing,completed',
        ]);

        $lecture = Lecture::find($id);
        $lecture->update($validated);

        return redirect()->route('lectures.index')->with('success', 'Lecture updated successfully!');
    }

    public function destroy($id)
    {
        $lecture = Lecture::find($id);
        $lecture->delete();
        return redirect()->route('lectures.index')->with('success', 'Lecture deleted successfully!');
    }
}