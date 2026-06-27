@extends('layouts.app')

@section('title', 'Collections - Maison de Hoor')

@section('content')

<!-- Page Header -->
<div style="text-align: center; padding: 4rem 2rem; background-color: rgba(255, 252, 247, 0.95);">
    <h1 style="font-size: 2.8rem; font-weight: 700; color: #2c2c2c; text-transform: uppercase; letter-spacing: 2px;">CATALOG</h1>
    <div style="width: 60px; height: 3px; background: #B49F79; margin: 1rem auto;"></div>
</div>

<!-- Collections Grid -->
<section style="padding: 4rem 2rem; background-color: #fff;">
    <div class="container">
        <div class="row g-4">
            @php
                $collections = \App\Models\Collection::all();
            @endphp
            
            @foreach($collections as $collection)
            <div class="col-md-6">
                <div style="position: relative; height: 350px; overflow: hidden; border-radius: 8px; cursor: pointer; transition: all 0.3s; group">
                    <a href="{{ route('collections.show', $collection->slug) }}" style="text-decoration: none; display: block; width: 100%; height: 100%;">
                        @if($collection->media_type === 'photo' && $collection->media)
                            <img src="{{ Storage::url($collection->media) }}" alt="{{ $collection->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        @elseif($collection->media_type === 'video' && $collection->media)
                            <video style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" autoplay muted loop playsinline>
                                <source src="{{ Storage::url($collection->media) }}" type="video/mp4">
                            </video>
                        @elseif($collection->video)
                            <video style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" autoplay muted loop playsinline>
                                <source src="{{ route('videos.stream', $collection->video->id) }}" type="video/mp4">
                            </video>
                        @else
                            <div style="width: 100%; height: 100%; background: #FFFCF7; display: flex; align-items: center; justify-content: center; color: #999;">
                                Media not uploaded yet
                            </div>
                        @endif
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(44, 44, 44, 0.5), rgba(139, 115, 85, 0.3)); display: flex; align-items: center; justify-content: center;">
                            <h2 style="color: white; font-size: 2.2rem; font-weight: 700; text-align: center; letter-spacing: 1px; text-transform: uppercase;">{{ $collection->name }}</h2>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .collection-card {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .collection-card:hover img {
        transform: scale(1.08);
    }

    .collection-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }
</style>

@endsection
