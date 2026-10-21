<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Services\SizeService;
use Exception;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function index()
    {
        try {
            $sizes = $this->sizeService->getAll();
            return view("sizes.index", compact('sizes'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve sizes: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view("sizes.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name',
        ], [
            'name.required' => 'Please enter the size name.',
            'name.unique' => 'This size name already exists.',
        ]);

        try {
            $this->sizeService->store($validated);
            return redirect()->route('sizes.index')->with('success', 'Size created successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to create size: ' . $e->getMessage());
        }
    }

    public function edit(Size $size)
    {
        return view("sizes.edit", compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name,' . $size->id,
        ], [
            'name.required' => 'Please enter the size name.',
            'name.unique' => 'This size name already exists.',
        ]);

        try {
            $this->sizeService->update($validated, $size);
            return redirect()->route('sizes.index')->with('success', 'Size updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update size: ' . $e->getMessage());
        }
    }

    public function destroy(Size $size)
    {
        try {
            if ($size->variants()->exists()) {
                return redirect()->route('sizes.index')->with('error', 'Size is being used by product variants and cannot be deleted!');
            }
            $this->sizeService->destroy($size);
            return redirect()->route('sizes.index')->with('success', 'Size deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('sizes.index')->with('error', 'Failed to delete size: ' . $e->getMessage());
        }
    }
}
