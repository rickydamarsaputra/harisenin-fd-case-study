<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Product;
use App\Models\ProductAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('pages.product.index', compact('products'));
    }

    public function createView()
    {
        return view('pages.product.create');
    }

    public function createAction(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'assets' => 'required'
        ]);

        $product = Product::create([
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name, '_'),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        foreach ($request->file('assets') as $asset) {
            $uploaded_file_url = Cloudinary::upload($asset->getRealPath())->getSecurePath();

            $asset = Asset::create([
                'name' => $asset->getClientOriginalName(),
                'path' => $uploaded_file_url,
                'size' => $asset->getSize()
            ]);

            $product_asset = ProductAsset::create([
                'asset_id' => $asset->id,
                'product_id' => $product->id
            ]);
        }

        return redirect()->route('product.index');
    }

    public function updateView($slug)
    {
        $product = Product::where('product_slug', '=', $slug)->first();
        return view('pages.product.update', compact('product'));
    }

    public function updateAction($slug, Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $product = Product::where('product_slug', '=', $slug)->first();

        if ($request->has('assets')) {
            foreach ($request->file('assets') as $asset) {
                $uploaded_file_url = Cloudinary::upload($asset->getRealPath())->getSecurePath();

                $asset = Asset::create([
                    'name' => $asset->getClientOriginalName(),
                    'path' => $uploaded_file_url,
                    'size' => $asset->getSize()
                ]);

                $product_asset = ProductAsset::create([
                    'asset_id' => $asset->id,
                    'product_id' => $product->id
                ]);
            }
        }

        $product->update([
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name, '_'),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index');
    }

    public function delete($slug)
    {
        $product = Product::where('product_slug', '=', $slug)->first();
        $product_assets = ProductAsset::where('product_id', '=', $product->id)->get();

        foreach ($product_assets as $product_asset) {
            $asset = Asset::find($product_asset->asset_id);
            $asset->delete();
        }

        $product->delete();

        return redirect()->back();
    }

    public function deleteAsset($id)
    {
        $product_asset = ProductAsset::find($id);
        $asset = Asset::find($product_asset->asset_id);

        $product_asset->delete();
        $asset->delete();

        return redirect()->back();
    }
}
