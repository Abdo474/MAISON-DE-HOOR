@extends('layouts.app')

@section('title', 'Create Collection - Admin')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Card -->
                <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <h1 style="font-size: 1.8rem; color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">
                        ➕ Create Collection
                    </h1>
                    <p style="color: #999; margin-bottom: 2rem; font-size: 0.95rem;">Add a new collection to your store</p>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.collections.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Collection Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            @error('name')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div style="margin-bottom: 2rem;">
                            <label for="description" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4" value="{{ old('description') }}"
                                      style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s; font-family: inherit; resize: none;"
                                      onfocus="this.style.borderColor='#B49F79'"
                                      onblur="this.style.borderColor='#E0E0E0'"></textarea>
                            @error('description')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Media Section -->
                        <div style="background: #F9F9F9; padding: 2rem; border-radius: 8px; margin-bottom: 2rem; border: 2px solid #E0E0E0;">
                            <h3 style="font-size: 1.1rem; color: #2C2C2C; font-weight: 700; margin-bottom: 1.5rem; margin-top: 0;">
                                📸 Collection Media (Optional)
                            </h3>

                            <!-- Media Type Choice -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 1rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    Choose Media Type
                                </label>
                                <div style="display: flex; gap: 15px;">
                                    <label style="display: flex; align-items: center; cursor: pointer;">
                                        <input type="radio" name="media_type" value="photo" checked style="margin-right: 8px; cursor: pointer;">
                                        <span style="color: #4A4A4A; font-size: 0.95rem;">Photo</span>
                                    </label>
                                    <label style="display: flex; align-items: center; cursor: pointer;">
                                        <input type="radio" name="media_type" value="video" style="margin-right: 8px; cursor: pointer;">
                                        <span style="color: #4A4A4A; font-size: 0.95rem;">Video</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Photo Upload -->
                            <div id="photoUpload" style="display: block;">
                                <label for="media_photo" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    Upload Photo
                                </label>
                                <div style="border: 2px dashed #B49F79; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                     id="photoDropZone"
                                     onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#C893A0'"
                                     onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#B49F79'">
                                    <input type="file" id="media_photo" name="media_photo" accept="image/*" style="display: none;">
                                    <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload photo or drag and drop</p>
                                    <p style="color: #999; margin: 0; font-size: 0.9rem;">JPG, PNG, GIF (Max 10MB)</p>
                                    <img id="photoPreview" src="" alt="" style="display:none; max-height: 120px; margin-top: 10px; border-radius: 6px; object-fit: cover;">
                                </div>
                                @error('media_photo')
                                    <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Video Upload -->
                            <div id="videoUpload" style="display: none;">
                                <label for="media_video" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    Upload Video
                                </label>
                                <div style="border: 2px dashed #C893A0; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                     id="videoDropZone"
                                     onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#B49F79'"
                                     onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#C893A0'">
                                    <input type="file" id="media_video" name="media_video" accept="video/*" style="display: none;">
                                    <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload video or drag and drop</p>
                                    <p style="color: #999; margin: 0; font-size: 0.9rem;">MP4, WebM (Max 100MB)</p>
                                    <p id="videoFileName" style="color: #666; margin: 0.5rem 0 0; font-size: 0.85rem;"></p>
                                </div>
                                @error('media_video')
                                    <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" style="flex: 1; padding: 12px; background: #B49F79; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                    onmouseover="this.style.background='#C893A0'"
                                    onmouseout="this.style.background='#B49F79'">
                                ✅ Create Collection
                            </button>
                            <a href="{{ route('admin.collections') }}" style="flex: 1; padding: 12px; background: #999; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center;"
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
    // Toggle media type sections
    document.querySelectorAll('input[name="media_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const photoUpload = document.getElementById('photoUpload');
            const videoUpload = document.getElementById('videoUpload');
            if (this.value === 'photo') {
                photoUpload.style.display = 'block';
                videoUpload.style.display = 'none';
            } else {
                photoUpload.style.display = 'none';
                videoUpload.style.display = 'block';
            }
        });
    });

    // Photo drag and drop
    const photoDropZone = document.getElementById('photoDropZone');
    const photoInput = document.getElementById('media_photo');
    const photoPreview = document.getElementById('photoPreview');

    photoDropZone.addEventListener('click', () => photoInput.click());

    photoInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                photoPreview.src = ev.target.result;
                photoPreview.style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    photoDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        photoDropZone.style.borderColor = '#C893A0';
        photoDropZone.style.background = '#F9F4F0';
    });

    photoDropZone.addEventListener('dragleave', () => {
        photoDropZone.style.borderColor = '#B49F79';
        photoDropZone.style.background = '#FFFCF7';
    });

    photoDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        photoDropZone.style.borderColor = '#B49F79';
        photoDropZone.style.background = '#FFFCF7';
        photoInput.files = e.dataTransfer.files;
        photoInput.dispatchEvent(new Event('change'));
    });

    // Video drag and drop
    const videoDropZone = document.getElementById('videoDropZone');
    const videoInput = document.getElementById('media_video');
    const videoFileName = document.getElementById('videoFileName');

    videoDropZone.addEventListener('click', () => videoInput.click());

    videoInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            videoFileName.textContent = 'Selected: ' + e.target.files[0].name;
        }
    });

    videoDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        videoDropZone.style.borderColor = '#B49F79';
        videoDropZone.style.background = '#F9F4F0';
    });

    videoDropZone.addEventListener('dragleave', () => {
        videoDropZone.style.borderColor = '#C893A0';
        videoDropZone.style.background = '#FFFCF7';
    });

    videoDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        videoDropZone.style.borderColor = '#C893A0';
        videoDropZone.style.background = '#FFFCF7';
        videoInput.files = e.dataTransfer.files;
        videoInput.dispatchEvent(new Event('change'));
    });
</script>

@endsection
