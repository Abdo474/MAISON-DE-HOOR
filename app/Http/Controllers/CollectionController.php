<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        return view('collections.index');
    }

    public function show($slug, Request $request)
    {
        $collection = Collection::where('slug', $slug)->firstOrFail();
        $query = Product::where('collection_id', $collection->id)->with(['productImages']);

        // Price filter
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Color filter
        if ($request->has('color') && $request->color != '') {
            $query->whereJsonContains('colors', $request->color);
        }

        $products = $query->paginate(12);

        // Get all unique colors from ALL products in this collection (unfiltered)
        $allProductColors = Product::where('collection_id', $collection->id)
            ->whereNotNull('colors')
            ->pluck('colors')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('collections.show', compact('collection', 'products', 'allProductColors'));
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'slug' => 'required|string',
            'name' => 'required|string|max:255',
        ]);

        $collection = Collection::where('slug', $request->slug)->first();

        if (!$collection) {
            return response()->json([
                'success' => false,
                'message' => 'Collection not found'
            ], 404);
        }

        $collection->update(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => 'Collection name updated successfully',
            'collection' => $collection
        ]);
    }
}
