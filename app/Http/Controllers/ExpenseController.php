<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = Expense::paginate($request->perpage ?? 10);
        return view('expenses.index', compact('expenses'));
    }

    public function show($id)
    {
        $expense = Expense::find($id);
        return view('expenses.show', compact('expense'));
    }

    public function getData(Request $request)
    {
        $query = Expense::query();

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
        $totalRecords = Expense::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($expense) {
                return view('expenses.partials.actions', compact('expense'))->render();
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
        return view('expenses.add-edit');
    }

    public function edit($id)
    {
       $expense = Expense::find($id);
       return view('expenses.add-edit',compact('expense'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
            'remarks' => 'required',
            'date' => 'required|date',
            'payment_instrument' => 'required',
            'payment_through' => 'required',
            'payment_ref_no' => 'required',
        ]);

        Expense::create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required',
            'remarks' => 'required',
            'date' => 'required|date',
            'payment_instrument' => 'required',
            'payment_through' => 'required',
            'payment_ref_no' => 'required',
        ]);

        $expense = Expense::find($id);
        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }
}