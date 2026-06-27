<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Video;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        $collectionsCount = Collection::count();
        $videosCount = Video::count();
        
        return view('admin.dashboard', compact('collectionsCount', 'videosCount'));
    }

    /**
     * Manage collections
     */
    public function collections()
    {
        $collections = Collection::all();
        return view('admin.collections.index', compact('collections'));
    }

    /**
     * Create collection form
     */
    public function createCollection()
    {
        return view('admin.collections.create');
    }

    /**
     * Store new collection
     */
    public function storeCollection(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media_type' => 'nullable|in:photo,video',
            'media_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media_video' => 'nullable|file|max:102400',
        ]);

        // Auto-generate a unique slug from name
        $validated['slug'] = $this->generateUniqueCollectionSlug($validated['name']);

        // Handle media upload (do not depend only on selected radio value)
        if ($request->hasFile('media_video')) {
            $validated['media'] = $request->file('media_video')->store('collections', 'public');
            $validated['media_type'] = 'video';
        } elseif ($request->hasFile('media_photo')) {
            $validated['media'] = $request->file('media_photo')->store('collections', 'public');
            $validated['media_type'] = 'photo';
        } else {
            // If no media type selected or no file uploaded
            $validated['media'] = null;
            $validated['media_type'] = null;
        }

        Collection::create($validated);

        return redirect()->route('admin.collections')->with('success', 'Collection created successfully');
    }

    /**
     * Edit collection form
     */
    public function editCollection(Collection $collection)
    {
        $collection->load('video');
        return view('admin.collections.edit', compact('collection'));
    }

    /**
     * Update collection
     */
    public function updateCollection(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|file|max:102400',
            'media_type' => 'nullable|in:photo,video',
            'media_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media_video' => 'nullable|file|max:102400',
        ]);

        // Auto-generate a unique slug from name (ignore current collection)
        $validated['slug'] = $this->generateUniqueCollectionSlug($validated['name'], $collection->id);

        // Handle new media format (do not depend only on selected radio value)
        if ($request->hasFile('media_video')) {
            // Delete old media if exists
            if ($collection->media) {
                \Storage::disk('public')->delete($collection->media);
            }
            $validated['media'] = $request->file('media_video')->store('collections', 'public');
            $validated['media_type'] = 'video';
        } elseif ($request->hasFile('media_photo')) {
            // Delete old media if exists
            if ($collection->media) {
                \Storage::disk('public')->delete($collection->media);
            }
            $validated['media'] = $request->file('media_photo')->store('collections', 'public');
            $validated['media_type'] = 'photo';
        }

        // Legacy video handling (keep for backward compatibility)
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $videoData = file_get_contents($file->getRealPath());
            
            // Delete old video if exists
            if ($collection->video) {
                $collection->video->delete();
            }
            
            // Create new video
            $video = Video::create([
                'name' => $collection->name . ' Video',
                'filename' => $file->getClientOriginalName(),
                'collection_id' => $collection->id,
                'video_data' => $videoData,
                'file_size' => filesize($file->getRealPath()),
            ]);
            
            // Link the video to the collection
            $validated['video_id'] = $video->id;
        }

        $collection->update($validated);

        return redirect()->route('admin.collections')->with('success', 'Collection updated successfully');
    }

    /**
     * Delete collection
     */
    public function deleteCollection(Collection $collection)
    {
        $collection->delete();
        return back()->with('success', 'Collection deleted successfully');
    }

    private function generateUniqueCollectionSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'collection';
        $slug = $baseSlug;
        $counter = 1;

        $exists = Collection::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists();

        while ($exists) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;

            $exists = Collection::query()
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists();
        }

        return $slug;
    }

    /**
     * Manage products
     */
    public function products(Request $request)
    {
        $products = Product::with('collection')->get();
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Create product form
     */
    public function createProduct()
    {
        $collections = Collection::all();
        $minPrice = Product::min('price') ?? 0;
        $maxPrice = Product::max('price') ?? 0;
        return view('admin.products.create', compact('collections', 'minPrice', 'maxPrice'));
    }

    /**
     * Store new product
     */
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'collection_id' => 'required|exists:collections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'colors' => 'nullable|array',
            'colors.*' => 'string|max:50',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Store colors as JSON array
        $validated['colors'] = $request->input('colors', []);

        $product = Product::create($validated);

        // Handle multiple additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imgFile) {
                $path = $imgFile->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }

    /**
     * Edit product form
     */
    public function editProduct(Product $product)
    {
        $collections = Collection::all();
        $minPrice = Product::min('price') ?? 0;
        $maxPrice = Product::max('price') ?? 0;
        return view('admin.products.edit', compact('product', 'collections', 'minPrice', 'maxPrice'));
    }

    /**
     * Update product
     */
    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'collection_id' => 'required|exists:collections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    /**
     * Delete product
     */
    public function deleteProduct(Product $product)
    {
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully');
    }

}
