<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $incomes = Income::paginate($request->perpage ?? 10);
        return view('incomes.index', compact('incomes'));
    }

    public function show($id)
    {
        $income = Income::find($id);
        return view('incomes.show', compact('income'));
    }

    public function getData(Request $request)
    {
        $query = Income::query();

        // Determine the offset and limit for custom pagination
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;

        $query->skip($offset)->take($limit);

        // Apply search filter if provided
        if (!empty($request->search)) {
            $searchValue = $request->search;
            $query->where(function ($q) use ($searchValue) {
                $q->where('category', 'like', "%{$searchValue}%")
                    ->orWhere('remarks', 'like', "%{$searchValue}%")
                    ->orWhere('date', 'like', "%{$searchValue}%");
            });
        }

        // Get the total count for pagination (ignores skip and take)
        $totalRecords = Income::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($income) {
                return view('incomes.partials.actions', compact('income'))->render();
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
        return view('incomes.add-edit');
    }

    public function edit($id)
    {
       $income = Income::find($id);
       return view('incomes.add-edit',compact('income'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sponsor_id' => 'required',
            'category' => 'required',
            'remarks' => 'required',
            'date' => 'required|date',
            'payment_instrument' => 'required',
            'payment_through' => 'required',
            'payment_ref_no' => 'required',
        ]);

        Income::create($validated);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sponsor_id' => 'required',
            'category' => 'required',
            'remarks' => 'required',
            'date' => 'required|date',
            'payment_instrument' => 'required',
            'payment_through' => 'required',
            'payment_ref_no' => 'required',
        ]);

        $income = Income::find($id);
        $income->update($validated);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
    }

    public function destroy($id)
    {
        $income = Income::find($id);
        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
    }
}