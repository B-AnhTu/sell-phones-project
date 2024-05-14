<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách các danh mục.
     */
    public function index()
    {
        $categories = Category::orderBy('category_id', 'ASC')->paginate(3);
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'category_name' => $request->input('category_name'),
        ]);

        return Redirect::route('categories.index')->with('success', 'Danh mục đã được thêm thành công!');
    }

    public function redirectToCreate()
    {
        return redirect()->route('categories.create');
    }

    /**
     * Hiển thị form để chỉnh sửa danh mục.
     */
    public function edit($id)
    {
        $category = Category::find($id); // Lấy thông tin của danh mục cần chỉnh sửa
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        $category->category_name = $request->input('category_name');
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    /**
     * Xóa danh mục.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công!');
    }

    /**
     * 7.05
     */

}

