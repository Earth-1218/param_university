<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::paginate($request->perpage ?? 10);
        return view('students.index', compact('subjects'));
    }

    public function show($id)
    {
        $subjects = Subject::find($id);
        return view('students.show', compact('subject'));
    }

    public function getData(Request $request)
    {
        $query = Subject::query();

        // Determine the offset and limit for custom pagination
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;

        $query->skip($offset)->take($limit);

        // Apply search filter if provided
        if (!empty($request->search)) {
            $searchValue = $request->search;
            $query->where(function ($q) use ($searchValue) {
                $q->where('id', 'like', "%{$searchValue}%");
            });
        }

        // Get the total count for pagination (ignores skip and take)
        $totalRecords = Subject::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($subject) {
                return view('subjects.partials.actions', compact('subject'))->render();
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
        return view('subjects.add-edit');
    }

    public function edit($id)
    {
       $student = Subject::find($id);
       return view('subject.add-edit',compact('subject'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required',
            'name' => 'required'
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required',
            'name' => 'required'
        ]);

        $student = Subject::findOrFail($id);
        $student->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
       $subject = Subject::find($id);
       $subject->delete();
       return redirect()->route('subjects.index');
    }


}
