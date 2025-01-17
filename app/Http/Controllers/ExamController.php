<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $exams = Exam::paginate($request->perpage ?? 10);
        return view('exams.index', compact('exams'));
    }

    public function show($id)
    {
        $exam = Exam::find($id);
        return view('exams.show', compact('exam'));
    }

    public function getData(Request $request)
    {
        $query = Exam::query();

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
        $totalRecords = Exam::count();

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
        return view('exams.add-edit');
    }

    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('exams.add-edit', compact('exam'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'subject_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'duration' => 'required',
            'total_marks' => 'required',
            'passing_marks' => 'required',
        ]);

        Exam::create($validated);

        return redirect()->route('exams.index')->with('success', 'Exam added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'subject_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'duration' => 'required',
            'total_marks' => 'required',
            'passing_marks' => 'required',
        ]);

        $exam = Exam::find($id);
        $exam->update($validated);

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully!');
    }

    public function destroy($id)
    {
        $exam = Exam::find($id);
        $exam->delete();

        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully!');
    }
}