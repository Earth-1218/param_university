<?php

namespace App\Http\Controllers;

use App\Models\ManagementTeam;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManagementStaffController extends Controller
{
    public function index(Request $request)
    {
        $managementstaff = Student::paginate($request->perpage ?? 10);
        return view('management-staff.index', compact('managementstaff'));
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('management-staff.show', compact('managementstaff'));
    }

    public function getData(Request $request)
    {
        $query = ManagementTeam::query();

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
        $totalRecords = ManagementTeam::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($managementstaff) {
                return view('management-staff.partials.actions', compact('managementstaff'))->render();
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
        return view('management-staff.add-edit');
    }

    public function edit($id)
    {
       $student = ManagementTeam::find($id);
       return view('management-staff.add-edit',compact('student'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'dob' => 'required|date',
            'about' => 'nullable',
            'department' => 'required',
            'joining_date' => 'required|date',
        ]);

        ManagementTeam::create($validated);
        return redirect()->route('management-staff.index')->with('success', 'Staff added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'dob' => 'required|date',
            'about' => 'nullable',
            'department' => 'required',
            'joining_date' => 'required|date',
        ]);

        $managementstaff = ManagementTeam::find($id);
        $managementstaff->update($validated);

        return redirect()->route('management-staff.index')->with('success', 'Staff updated successfully!');
    }

    public function destroy($id)
    {
       $managementstaff = ManagementTeam::find($id);
       $managementstaff->delete();
       return redirect()->route('management-staff.index');
    }
}
