<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('welcome', compact('categories'));
    }

    public function createView()
    {
        return view('pages.category.create');
    }

    public function createAction(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'asset' => 'required|image'
        ]);

        $uploaded_file_url = Cloudinary::upload($request->file('asset')->getRealPath())->getSecurePath();

        $asset = Asset::create([
            'name' => $request->file('asset')->getFilename(),
            'path' => $uploaded_file_url,
            'size' => $request->file('asset')->getSize()
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '_'),
            'asset_id' => $asset->id
        ]);

        return redirect()->route('category.index');
    }

    public function updateView($slug)
    {
        $category = Category::where('category_slug', '=', $slug)->first();
        return view('pages.category.update', compact('category'));
    }

    public function updateAction($slug, Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $category = Category::where('category_slug', '=', $slug)->first();
        $asset = Asset::find($category->asset_id);

        if ($request->has('asset')) {
            $uploaded_file_url = Cloudinary::upload($request->file('asset')->getRealPath())->getSecurePath();

            $asset->update([
                'name' => $request->file('asset')->getFilename(),
                'path' => $uploaded_file_url,
                'size' => $request->file('asset')->getSize()
            ]);
        } else {
            $category->update([
                'category_name' => $request->category_name,
                'category_slug' => Str::slug($request->category_name, '_'),
            ]);
        }

        return redirect()->route('category.index');
    }

    public function delete($slug)
    {
        $category = Category::where('category_slug', '=', $slug)->first();
        $asset = Asset::find($category->asset_id);

        $category->delete();
        $asset->delete();

        return redirect()->back();
    }
}
