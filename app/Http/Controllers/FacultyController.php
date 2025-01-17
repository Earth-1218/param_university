<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        $faculties = Faculty::paginate($request->perpage ?? 10);
        return view('faculties.index', compact('faculties'));
    }

    public function show($id)
    {
        $faculty = Faculty::find($id);
        return view('faculties.show', compact('faculty'));
    }

    public function getData(Request $request)
    {
        $query = Faculty::query();

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
        $totalRecords = Faculty::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($faculty) {
                return view('faculties.partials.actions', compact('faculty'))->render();
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
        return view('faculties.add-edit');
    }

    public function edit($id)
    {
       $faculty = Faculty::find($id);
       return view('faculties.add-edit',compact('faculty'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required',
            'subject_id' => 'required',
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'merital_status' => 'required',
            'designation' => 'required',
            'about' => 'required',
            'joining_date' => 'required',
            'departure_date' => 'required',
            'experience' => 'required',
        ]);

        Faculty::create($validated);

        return redirect()->route('faculties.index')->with('success', 'faculty added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required',
            'subject_id' => 'required',
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'merital_status' => 'required',
            'designation' => 'required',
            'about' => 'required',
            'joining_date' => 'required',
            'departure_date' => 'required',
            'experience' => 'required',
        ]);

        $faculty = Faculty::findOrFail($id);
        $faculty->update($validated);

        return redirect()->route('faculties.index')->with('success', 'faculty updated successfully!');
    }

    public function destroy($id)
    {
       $faculty = Faculty::find($id);
       $faculty->delete();
       return redirect()->route('faculties.index');
    }


}
