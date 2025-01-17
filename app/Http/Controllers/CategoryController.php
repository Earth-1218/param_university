<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::paginate($request->perpage ?? 10);
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = category::find($id);
        return view('categories.show', compact('category'));
    }

    public function getData(Request $request)
    {
        $query = category::query();

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
        $totalRecords = category::count();

        // Get the total count after applying filters
        $filteredRecords = $query->count();

        // Fetch the data for the current page
        $data = $query->get();

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($category) {
                return view('categories.partials.actions', compact('category'))->render();
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
        return view('categories.add-edit');
    }

    public function edit($id)
    {
       $category = category::find($id);
       return view('categories.add-edit',compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        category::create($validated);

        return redirect()->route('categories.index')->with('success', 'category added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
          'name' => 'required'
        ]);

        $category = category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'category updated successfully!');
    }

    public function destroy($id)
    {
       $category = category::find($id);
       $category->delete();
       return redirect()->route('categories.index');
    }
}
