@extends('layouts.app')

@section('title', 'Manage Videos - Admin')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <!-- Header -->
        <div style="margin-bottom: 3rem;">
            <h1 style="font-size: 2rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; margin-bottom: 0.5rem;">
                Manage Videos
            </h1>
            <p style="color: #999; margin: 0;">View and delete collection videos</p>
        </div>

        @if ($videos->count())
            <!-- Videos Grid -->
            <div class="row g-4">
                @foreach ($videos as $video)
                    <div class="col-md-6 col-lg-4">
                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s;"
                             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)'"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'">
                            
                            <!-- Video Preview -->
                            <div style="height: 200px; background: #F4F4F4; display: flex; align-items: center; justify-content: center; color: #999;">
                            </div>

                            <!-- Video Info -->
                            <div style="padding: 1.5rem;">
                                <h3 style="color: #2C2C2C; font-weight: 700; margin: 0 0 0.5rem; word-break: break-word;">
                                    {{ Str::limit($video->name, 40) }}
                                </h3>
                                <p style="color: #999; font-size: 0.85rem; margin: 0.5rem 0;">
                                    {{ number_format($video->file_size / 1024 / 1024, 2) }} MB
                                </p>
                                <p style="color: #999; font-size: 0.85rem; margin: 0.5rem 0;">
                                    {{ $video->created_at->format('M d, Y') }}
                                </p>

                                <!-- Actions -->
                                <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
                                    <a href="{{ route('videos.stream', $video->id) }}" target="_blank" style="flex: 1; padding: 8px 12px; background: #B49F79; color: white; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; text-align: center; transition: all 0.3s;"
                                       onmouseover="this.style.background='#C893A0'"
                                       onmouseout="this.style.background='#B49F79'">
                                        Preview
                                    </a>
                                    <form action="{{ route('admin.videos.delete', $video) }}" method="POST" class="d-inline" style="flex: 1;" onsubmit="return confirm('Delete this video?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="width: 100%; padding: 8px 12px; background: #dc3545; color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 0.8rem; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;"
                                                onmouseover="this.style.background='#c82333'"
                                                onmouseout="this.style.background='#dc3545'">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div style="background: white; border-radius: 12px; padding: 4rem; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                <h2 style="color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem;">No Videos Yet</h2>
                <p style="color: #999; font-size: 1rem; margin-bottom: 2rem;">
                    Upload videos from the collection upload page to see them here.
                </p>
                <a href="{{ route('videos.upload.page') }}" style="display: inline-block; padding: 12px 30px; background: #B49F79; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                   onmouseover="this.style.background='#C893A0'"
                   onmouseout="this.style.background='#B49F79'">
                    Upload Videos
                </a>
            </div>
        @endif

        <!-- Back Link -->
        <div style="margin-top: 3rem; text-align: center;">
            <a href="{{ route('admin.dashboard') }}" style="color: #B49F79; text-decoration: none; font-weight: 600; font-size: 0.95rem;">
                ← Back to Admin Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
