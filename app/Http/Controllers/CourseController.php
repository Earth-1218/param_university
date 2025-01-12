<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::paginate($request->perpage ?? 10);
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show', compact('course'));
    }

    public function getData(Request $request)
    {
        $query = Course::query();

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
        $totalRecords = Course::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($course) {
                return view('courses.partials.actions', compact('course'))->render();
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
        return view('courses.add-edit');
    }

    public function edit($id)
    {
       $course = Course::find($id);
       return view('courses.add-edit',compact('course'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable',
            'name' => 'required',
            'tenure' => 'required|in:1,2,3,4',
            'semester' => 'required|in:1,2,3,4,5,6,7',
            'fees' => 'required',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'nullable',
            'name' => 'required',
            'tenure' => 'required|in:1,2,3,4',
            'semester' => 'required|in:1,2,3,4,5,6,7',
            'fees' => 'required',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
       $course = Course::find($id);
       $course->delete();
       return redirect()->route('courses.index');
    }


}
