<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::paginate($request->perpage ?? 10);
        return view('students.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('students.show', compact('student'));
    }

    public function getData(Request $request)
    {
        $query = Student::query();

        // Determine the offset and limit for custom pagination
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;

        $query->skip($offset)->take($limit);

        // Apply search filter if provided
        if (!empty($request->search)) {
            $searchValue = $request->search;
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', "%{$searchValue}%")
                    ->orWhere('enrollment_no', 'like', "%{$searchValue}%")
                    ->orWhere('email', 'like', "%{$searchValue}%");
            });
        }

        // Get the total count for pagination (ignores skip and take)
        $totalRecords = Student::count();

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

    public function add()
    {
        return view('students.add-edit');
    }

    public function edit($id)
    {
       $student = Student::find($id);
       return view('students.add-edit',compact('student'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_no' => 'required|unique:students',
            'course_id' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'aadhaar_no' => 'required|unique:students',
            'mobile_no' => 'required',
            'email' => 'required|email|unique:students',
            'gender' => 'required',
            'dob' => 'required|date',
            'about' => 'nullable',
            'merital_status' => 'required',
            'joining_date' => 'required|date',
            'departure_date' => 'required|date',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'enrollment_no' => 'required',
            'course_id' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'aadhaar_no' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'dob' => 'required|date',
            'about' => 'nullable',
            'merital_status' => 'required',
            'joining_date' => 'required|date',
            'departure_date' => 'required|date',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
       $student = Student::find($id);
       $student->delete();
       return redirect()->route('students.index');
    }


}
