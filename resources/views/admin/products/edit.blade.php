@extends('layouts.app')

@section('title', 'Edit Product - Admin')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card -->
                <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <h1 style="font-size: 1.8rem; color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">
                        Edit Product
                    </h1>
                    <p style="color: #999; margin-bottom: 2rem; font-size: 0.95rem;">Update product details</p>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Product Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            @error('name')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Collection -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="collection_id" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Collection
                            </label>
                            <select id="collection_id" name="collection_id" required
                                    style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                    onfocus="this.style.borderColor='#B49F79'"
                                    onblur="this.style.borderColor='#E0E0E0'">
                                @foreach($collections as $collection)
                                    <option value="{{ $collection->id }}" {{ $product->collection_id == $collection->id ? 'selected' : '' }}>
                                        {{ $collection->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('collection_id')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="price" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Price
                            </label>
                            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            <small style="color: #999; display: block; margin-top: 0.5rem;">Existing prices range: ${{ number_format($minPrice, 2) }} - ${{ number_format($maxPrice, 2) }}</small>
                            @error('price')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="stock" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Stock Quantity
                            </label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            @error('stock')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div style="margin-bottom: 2rem;">
                            <label for="description" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4"
                                      style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s; font-family: inherit; resize: none;"
                                      onfocus="this.style.borderColor='#B49F79'"
                                      onblur="this.style.borderColor='#E0E0E0'">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Product Image -->
                        <div style="margin-bottom: 2rem;">
                            <label for="image" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Product Image (Optional)
                            </label>
                            
                            <!-- Current Image -->
                            @if($product->image)
                                <div style="background: white; padding: 1.5rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #E0E0E0;">
                                    <p style="color: #666; margin: 0 0 1rem; font-weight: 600;">Current Image:</p>
                                    <img src="{{ route('products.media', $product) }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px; border-radius: 6px;">
                                </div>
                            @endif
                            
                            <div style="border: 2px dashed #B49F79; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                 id="dropZone"
                                 onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#C893A0'"
                                 onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#B49F79'">
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                                <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload or drag and drop</p>
                                <p style="color: #999; margin: 0; font-size: 0.9rem;">JPG, PNG, GIF (Max 5MB)</p>
                                <p style="color: #666; margin: 0.5rem 0 0; font-size: 0.85rem;" id="fileName"></p>
                            </div>
                            @error('image')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" style="flex: 1; padding: 12px; background: #B49F79; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                    onmouseover="this.style.background='#C893A0'"
                                    onmouseout="this.style.background='#B49F79'">
                                ✅ Update Product
                            </button>
                            <a href="{{ route('admin.products') }}" style="flex: 1; padding: 12px; background: #999; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center;"
                               onmouseover="this.style.background='#888'"
                               onmouseout="this.style.background='#999'">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('image');
    const fileName = document.getElementById('fileName');

    dropZone.addEventListener('click', () => fileInput.click());
    
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            fileName.textContent = 'Selected: ' + e.target.files[0].name;
        }
    });

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#C893A0';
        dropZone.style.background = '#F9F4F0';
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.style.borderColor = '#B49F79';
        dropZone.style.background = '#FFFCF7';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#B49F79';
        dropZone.style.background = '#FFFCF7';
        
        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            fileName.textContent = 'Selected: ' + e.dataTransfer.files[0].name;
        }
    });
</script>

@endsection
