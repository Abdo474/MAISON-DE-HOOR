@extends('layouts.app')

@section('title', 'Create Product - Admin')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card -->
                <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <h1 style="font-size: 1.8rem; color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">
                        ➕ Create Product
                    </h1>
                    <p style="color: #999; margin-bottom: 2rem; font-size: 0.95rem;">Add a new product to your store</p>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Product Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
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
                                <option value="">Select a collection</option>
                                @foreach($collections as $collection)
                                    <option value="{{ $collection->id }}" {{ old('collection_id') == $collection->id ? 'selected' : '' }}>
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
                            <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" required
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
                            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0" required
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
                                      onblur="this.style.borderColor='#E0E0E0'">{{ old('description') }}</textarea>
                            @error('description')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Colors -->
                        <div style="margin-bottom: 2rem;">
                            <label style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Colors
                            </label>
                            <div style="display: flex; gap: 8px; margin-bottom: 10px;">
                                <input type="text" id="colorInput" placeholder="e.g. Beige, Navy Blue, Ivory..."
                                       style="flex: 1; padding: 10px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 0.95rem; transition: border-color 0.3s;"
                                       onfocus="this.style.borderColor='#B49F79'"
                                       onblur="this.style.borderColor='#E0E0E0'"
                                       onkeydown="if(event.key==='Enter'){event.preventDefault();addColor();}">
                                <button type="button" onclick="addColor()"
                                        style="padding: 10px 18px; background: #B49F79; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.9rem; white-space: nowrap;"
                                        onmouseover="this.style.background='#C893A0'"
                                        onmouseout="this.style.background='#B49F79'">
                                    + Add Color
                                </button>
                            </div>
                            <div id="colorTags" style="display: flex; flex-wrap: wrap; gap: 8px; min-height: 36px; padding: 8px; border: 1px dashed #E0E0E0; border-radius: 6px; background: #FAFAFA;"></div>
                            <div id="colorInputsContainer"></div>
                            <small style="color: #999; font-size: 0.82rem; margin-top: 6px; display: block;">Type a color name and press Enter or click "Add Color"</small>
                        </div>

                        <!-- Product Image -->
                        <div style="margin-bottom: 2rem;">
                            <label for="image" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Main Product Image (Optional)
                            </label>
                            <div style="border: 2px dashed #B49F79; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                 id="dropZone"
                                 onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#C893A0'"
                                 onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#B49F79'">
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                                <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload main image</p>
                                <p style="color: #999; margin: 0; font-size: 0.9rem;">JPG, PNG, GIF (Max 5MB)</p>
                                <p style="color: #666; margin: 0.5rem 0 0; font-size: 0.85rem;" id="fileName"></p>
                                <img id="mainPreview" src="" alt="" style="display:none; max-height: 120px; margin-top: 10px; border-radius: 6px; object-fit: cover;">
                            </div>
                            @error('image')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Additional Images -->
                        <div style="margin-bottom: 2rem;">
                            <label style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Additional Images (Optional)
                            </label>
                            <div style="border: 2px dashed #C893A0; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                 id="multiDropZone"
                                 onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#B49F79'"
                                 onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#C893A0'">
                                <input type="file" id="images" name="images[]" accept="image/*" multiple style="display: none;">
                                <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload multiple images</p>
                                <p style="color: #999; margin: 0; font-size: 0.9rem;">Select multiple files at once (JPG, PNG, GIF – Max 5MB each)</p>
                            </div>
                            <div id="imagePreviews" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 12px;"></div>
                            @error('images.*')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" style="flex: 1; padding: 12px; background: #B49F79; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                    onmouseover="this.style.background='#C893A0'"
                                    onmouseout="this.style.background='#B49F79'">
                                ✅ Create Product
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
    // ── Main image drop zone ──
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('image');
    const fileName = document.getElementById('fileName');
    const mainPreview = document.getElementById('mainPreview');

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            fileName.textContent = 'Selected: ' + file.name;
            const reader = new FileReader();
            reader.onload = (ev) => {
                mainPreview.src = ev.target.result;
                mainPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
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
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    // ── Multiple images ──
    const multiDropZone = document.getElementById('multiDropZone');
    const imagesInput = document.getElementById('images');
    const imagePreviews = document.getElementById('imagePreviews');

    multiDropZone.addEventListener('click', () => imagesInput.click());

    imagesInput.addEventListener('change', () => renderPreviews(imagesInput.files));

    multiDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        multiDropZone.style.borderColor = '#B49F79';
        multiDropZone.style.background = '#F9F4F0';
    });

    multiDropZone.addEventListener('dragleave', () => {
        multiDropZone.style.borderColor = '#C893A0';
        multiDropZone.style.background = '#FFFCF7';
    });

    multiDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        multiDropZone.style.borderColor = '#C893A0';
        multiDropZone.style.background = '#FFFCF7';
        imagesInput.files = e.dataTransfer.files;
        renderPreviews(e.dataTransfer.files);
    });

    function renderPreviews(files) {
        imagePreviews.innerHTML = '';
        Array.from(files).forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = (ev) => {
                const wrapper = document.createElement('div');
                wrapper.style.cssText = 'position:relative; width:90px; height:90px;';
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.cssText = 'width:90px; height:90px; object-fit:cover; border-radius:6px; border:2px solid #E0E0E0;';
                const label = document.createElement('span');
                label.textContent = i + 1;
                label.style.cssText = 'position:absolute; top:4px; left:4px; background:rgba(180,159,121,0.85); color:white; font-size:0.75rem; font-weight:700; padding:2px 6px; border-radius:10px;';
                wrapper.appendChild(img);
                wrapper.appendChild(label);
                imagePreviews.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }

    // ── Colors ──
    const colors = [];

    function addColor() {
        const input = document.getElementById('colorInput');
        const value = input.value.trim();
        if (!value || colors.includes(value)) {
            input.focus();
            return;
        }
        colors.push(value);
        renderColorTags();
        input.value = '';
        input.focus();
    }

    function removeColor(index) {
        colors.splice(index, 1);
        renderColorTags();
    }

    function renderColorTags() {
        const tags = document.getElementById('colorTags');
        const hidden = document.getElementById('colorInputsContainer');
        tags.innerHTML = '';
        hidden.innerHTML = '';

        colors.forEach((color, i) => {
            // Visible tag
            const tag = document.createElement('span');
            tag.style.cssText = 'display:inline-flex; align-items:center; gap:6px; padding:5px 12px; background:#B49F79; color:white; border-radius:20px; font-size:0.85rem; font-weight:600;';
            tag.innerHTML = `${color} <button type="button" onclick="removeColor(${i})" style="background:none; border:none; color:white; cursor:pointer; font-size:1rem; line-height:1; padding:0; font-weight:700;">&times;</button>`;
            tags.appendChild(tag);

            // Hidden input
            const inp = document.createElement('input');
            inp.type = 'hidden';
            inp.name = 'colors[]';
            inp.value = color;
            hidden.appendChild(inp);
        });

        if (colors.length === 0) {
            tags.innerHTML = '<span style="color:#BBB; font-size:0.85rem;">No colors added yet</span>';
        }
    }

    // Init
    renderColorTags();
</script>

@endsection
