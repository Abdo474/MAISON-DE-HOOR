<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Collection;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function media(Product $product)
    {
        if (!$product->image || !Storage::disk('public')->exists($product->image)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($product->image));
    }

    public function imageMedia(ProductImage $productImage)
    {
        if (!$productImage->image || !Storage::disk('public')->exists($productImage->image)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($productImage->image));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['collection', 'productImages']);
        
        // Filter by collection
        $selectedCollectionId = null;
        if ($request->has('collection_id') && $request->collection_id != '') {
            $query->where('collection_id', $request->collection_id);
            $selectedCollectionId = $request->collection_id;
        }
        
        // Filter by price
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Filter by color
        if ($request->has('color') && $request->color != '') {
            $query->whereJsonContains('colors', $request->color);
        }
        
        // Sorting
        $sort = $request->get('sort', 'best_selling');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc'); // best selling
        }
        
        $products = $query->paginate(12);
        $collections = \App\Models\Collection::all();
        
        // Get all product colors for the selected collection (unfiltered by color)
        $allProductColors = [];
        if ($selectedCollectionId) {
            $collectionProducts = Product::where('collection_id', $selectedCollectionId)->get();
            foreach ($collectionProducts as $product) {
                if ($product->colors && is_array($product->colors)) {
                    $allProductColors = array_unique(array_merge($allProductColors, $product->colors));
                }
            }
            sort($allProductColors);
        }
        
        return view('products.index', compact('products', 'collections', 'allProductColors', 'selectedCollectionId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $collections = Collection::all();
        return view('products.create', compact('collections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'collection_id' => 'required|exists:collections,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['productImages']);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $collections = Collection::all();
        return view('products.edit', compact('product', 'collections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'collection_id' => 'required|exists:collections,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
