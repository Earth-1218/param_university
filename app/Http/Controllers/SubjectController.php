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
        $query = Subject::query();
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;
        $query->skip($offset)->take($limit);
        $subjects =  $query->paginate($request->perpage ?? 10);
        return view('subjects.index', compact('subjects'));
    }

    public function show($id)
    {
        $subject = Subject::find($id);
        return view('subjects.show', compact('subject'));
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
        $data = $query->orderBy('id','desc')->get();

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
       $subject = Subject::find($id);
       return view('subjects.add-edit',compact('subject'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required',
            'name' => 'required',
            'semester' => 'required|in:1,2,3,4,5,6,7,8'
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

        $lesson = Subject::findOrFail($id);
        $lesson->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject)
    {
       dd($subject);
       return redirect()->route('subjects.index');
    }
}
