@extends('layouts.app')

@section('title', 'Edit Collection - Admin')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card -->
                <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <h1 style="font-size: 1.8rem; color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">
                        Edit Collection
                    </h1>
                    <p style="color: #999; margin-bottom: 2rem; font-size: 0.95rem;">Update collection details and manage video</p>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.collections.update', $collection) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                Collection Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $collection->name) }}" required
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
                            <textarea id="description" name="description" rows="4"
                                      style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s; font-family: inherit; resize: none;"
                                      onfocus="this.style.borderColor='#B49F79'"
                                      onblur="this.style.borderColor='#E0E0E0'">{{ old('description', $collection->description) }}</textarea>
                            @error('description')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Media Section -->
                        <div style="background: #F9F9F9; padding: 2rem; border-radius: 8px; margin-bottom: 2rem; border: 2px solid #E0E0E0;">
                            <h3 style="font-size: 1.1rem; color: #2C2C2C; font-weight: 700; margin-bottom: 1.5rem; margin-top: 0;">
                                📸 Collection Media
                            </h3>

                            <!-- Current Media -->
                            @if($collection->media_type === 'photo' && $collection->media)
                                <div style="background: white; padding: 1.5rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #E0E0E0;">
                                    <p style="color: #666; margin: 0 0 1rem; font-weight: 600;">Current Photo:</p>
                                    <img src="{{ Storage::url($collection->media) }}" alt="{{ $collection->name }}" 
                                         style="width: 100%; max-height: 300px; border-radius: 6px; object-fit: cover;">
                                </div>
                            @elseif($collection->media_type === 'video' && $collection->media)
                                <div style="background: white; padding: 1.5rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #E0E0E0;">
                                    <p style="color: #666; margin: 0 0 1rem; font-weight: 600;">Current Video:</p>
                                    <video style="width: 100%; max-height: 300px; border-radius: 6px; background: #000;" controls>
                                        <source src="{{ Storage::url($collection->media) }}">
                                    </video>
                                </div>
                            @elseif($collection->video)
                                <div style="background: white; padding: 1.5rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #E0E0E0;">
                                    <p style="color: #666; margin: 0 0 1rem; font-weight: 600;">Current Video (Legacy):</p>
                                    <video style="width: 100%; max-height: 300px; border-radius: 6px; background: #000;" controls>
                                        <source src="{{ route('videos.stream', $collection->video->id) }}">
                                    </video>
                                    <p style="color: #999; margin: 1rem 0 0; font-size: 0.9rem;">
                                        Size: {{ number_format($collection->video->file_size / 1024 / 1024, 2) }}MB
                                    </p>
                                </div>
                            @else
                                <p style="color: #999; font-size: 0.95rem; margin-bottom: 1.5rem;">No media uploaded yet</p>
                            @endif

                            <!-- Media Type Choice -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 1rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    Choose Media Type to Upload
                                </label>
                                <div style="display: flex; gap: 15px;">
                                    <label style="display: flex; align-items: center; cursor: pointer;">
                                        <input type="radio" name="media_type" value="photo" {{ $collection->media_type === 'photo' ? 'checked' : '' }} style="margin-right: 8px; cursor: pointer;">
                                        <span style="color: #4A4A4A; font-size: 0.95rem;">Photo</span>
                                    </label>
                                    <label style="display: flex; align-items: center; cursor: pointer;">
                                        <input type="radio" name="media_type" value="video" {{ $collection->media_type === 'video' ? 'checked' : '' }} style="margin-right: 8px; cursor: pointer;">
                                        <span style="color: #4A4A4A; font-size: 0.95rem;">Video</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Photo Upload -->
                            <div id="photoUploadEdit" style="display: {{ $collection->media_type === 'video' ? 'none' : 'block' }};">
                                <label for="media_photo_edit" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    Replace Photo (Optional)
                                </label>
                                <div style="border: 2px dashed #B49F79; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                     id="photoDropZoneEdit"
                                     onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#C893A0'"
                                     onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#B49F79'">
                                    <input type="file" id="media_photo_edit" name="media_photo" accept="image/*" style="display: none;">
                                    <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload photo or drag and drop</p>
                                    <p style="color: #999; margin: 0; font-size: 0.9rem;">JPG, PNG, GIF (Max 10MB)</p>
                                    <img id="photoPreviewEdit" src="" alt="" style="display:none; max-height: 120px; margin-top: 10px; border-radius: 6px; object-fit: cover;">
                                </div>
                            </div>

                            <!-- Video Upload -->
                            <div id="videoUploadEdit" style="display: {{ $collection->media_type === 'photo' ? 'none' : 'block' }};">
                                <label for="media_video_edit" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    Replace Video (Optional)
                                </label>
                                <div style="border: 2px dashed #C893A0; border-radius: 6px; padding: 2rem; text-align: center; background: #FFFCF7; cursor: pointer; transition: all 0.3s;"
                                     id="videoDropZoneEdit"
                                     onmouseover="this.style.background='#F9F4F0'; this.style.borderColor='#B49F79'"
                                     onmouseout="this.style.background='#FFFCF7'; this.style.borderColor='#C893A0'">
                                    <input type="file" id="media_video_edit" name="media_video" accept="video/*" style="display: none;">
                                    <p style="color: #2C2C2C; font-weight: 600; margin: 0 0 0.5rem;">Click to upload video or drag and drop</p>
                                    <p style="color: #999; margin: 0; font-size: 0.9rem;">MP4, WebM (Max 100MB)</p>
                                    <p id="videoFileNameEdit" style="color: #666; margin: 0.5rem 0 0; font-size: 0.85rem;"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" style="flex: 1; padding: 12px; background: #B49F79; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                    onmouseover="this.style.background='#C893A0'"
                                    onmouseout="this.style.background='#B49F79'">
                                ✅ Update Collection
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
            const photoUpload = document.getElementById('photoUploadEdit');
            const videoUpload = document.getElementById('videoUploadEdit');
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
    const photoDropZoneEdit = document.getElementById('photoDropZoneEdit');
    const photoInputEdit = document.getElementById('media_photo_edit');
    const photoPreviewEdit = document.getElementById('photoPreviewEdit');

    photoDropZoneEdit.addEventListener('click', () => photoInputEdit.click());

    photoInputEdit.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                photoPreviewEdit.src = ev.target.result;
                photoPreviewEdit.style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    photoDropZoneEdit.addEventListener('dragover', (e) => {
        e.preventDefault();
        photoDropZoneEdit.style.borderColor = '#C893A0';
        photoDropZoneEdit.style.background = '#F9F4F0';
    });

    photoDropZoneEdit.addEventListener('dragleave', () => {
        photoDropZoneEdit.style.borderColor = '#B49F79';
        photoDropZoneEdit.style.background = '#FFFCF7';
    });

    photoDropZoneEdit.addEventListener('drop', (e) => {
        e.preventDefault();
        photoDropZoneEdit.style.borderColor = '#B49F79';
        photoDropZoneEdit.style.background = '#FFFCF7';
        photoInputEdit.files = e.dataTransfer.files;
        photoInputEdit.dispatchEvent(new Event('change'));
    });

    // Video drag and drop
    const videoDropZoneEdit = document.getElementById('videoDropZoneEdit');
    const videoInputEdit = document.getElementById('media_video_edit');
    const videoFileNameEdit = document.getElementById('videoFileNameEdit');

    videoDropZoneEdit.addEventListener('click', () => videoInputEdit.click());

    videoInputEdit.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            videoFileNameEdit.textContent = 'Selected: ' + e.target.files[0].name;
        }
    });

    videoDropZoneEdit.addEventListener('dragover', (e) => {
        e.preventDefault();
        videoDropZoneEdit.style.borderColor = '#B49F79';
        videoDropZoneEdit.style.background = '#F9F4F0';
    });

    videoDropZoneEdit.addEventListener('dragleave', () => {
        videoDropZoneEdit.style.borderColor = '#C893A0';
        videoDropZoneEdit.style.background = '#FFFCF7';
    });

    videoDropZoneEdit.addEventListener('drop', (e) => {
        e.preventDefault();
        videoDropZoneEdit.style.borderColor = '#C893A0';
        videoDropZoneEdit.style.background = '#FFFCF7';
        videoInputEdit.files = e.dataTransfer.files;
        videoInputEdit.dispatchEvent(new Event('change'));
    });
</script>

@endsection
