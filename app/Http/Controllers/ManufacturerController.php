<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.manufacturer.list', compact('manufacturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'manufacturer_name' => 'required|string|max:255',
        ]);

        Manufacturer::create([
            'manufacturer_name' => $request->manufacturer_name,
        ]);

        return redirect()->route('manufacturer.index')->with('success', 'Hãng đã được thêm thành công!');
    }

    public function edit($id) 
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturers = Manufacturer::all();
        return view('admin.manufacturer.list', compact('manufacturer', 'manufacturers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'manufacturer_name' => 'required|string|max:255',
        ]);

        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->manufacturer_name = $request->manufacturer_name;
        $manufacturer->save();

        return redirect()->route('manufacturer.index');
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->delete();
        return redirect()->back();
    }
}
