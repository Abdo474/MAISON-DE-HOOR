@extends('layouts.app')

@section('title', 'CREATIONS - Maison de Hoor')

@section('content')
<section style="min-height: 100vh; padding: 40px 0; background-color: #FFFCF7;">
    <div style="max-width: 1600px; margin: 0 auto; padding: 0 20px;">
        <!-- Header -->
        <div style="margin-bottom: 40px; text-align: center;">
            <h1 style="font-size: 3rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; margin-bottom: 15px;">
                OUR CREATIONS
            </h1>
            <p style="color: #4A4A4A; font-size: 1rem; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                Handcrafted luxury pieces for the discerning woman
            </p>
        </div>

        <div style="display: flex; gap: 40px;">
            <!-- Left Sidebar - Filters -->
            <div id="filterSidebar" style="width: 250px; flex-shrink: 0;">
                <!-- Hide Filters Button -->
                <button onclick="document.getElementById('filterSidebar').style.display='none'; document.getElementById('showFiltersBtn').style.display='block';" 
                        style="display: none; width: 100%; margin-bottom: 20px; padding: 12px; background: white; border: 1px solid #E0E0E0; border-radius: 4px; cursor: pointer; font-weight: 600; color: #2C2C2C; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;"
                        id="hideFiltersBtn">
                    HIDE FILTERS ☰
                </button>

                <!-- Collections Filter -->
                <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #E0E0E0;">
                    <h3 style="font-size: 0.85rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 15px; cursor: pointer; display: flex; justify-content: space-between; align-items: center;"
                        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? 'block' : 'none'; this.querySelector('i').style.transform = this.querySelector('i').style.transform === 'rotate(180deg)' ? 'rotate(0deg)' : 'rotate(180deg)'">
                        ALL COLLECTIONS
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
                    </h3>
                    <div style="display: block;">
                        @foreach($collections as $col)
                            <label style="display: flex; align-items: center; margin-bottom: 12px; cursor: pointer; font-size: 0.9rem; color: #4A4A4A;">
                                <input type="checkbox" {{ request('collection_id') == $col->id ? 'checked' : '' }} 
                                       onchange="applyCollectionFilter(this.checked ? '{{ $col->id }}' : '')"
                                       style="width: 18px; height: 18px; margin-right: 10px; cursor: pointer; accent-color: #B49F79;">
                                {{ $col->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Color Filter (appears only when collection is selected) -->
                @if($selectedCollectionId && count($allProductColors) > 0)
                <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #E0E0E0;">
                    <h3 style="font-size: 0.85rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 15px; cursor: pointer; display: flex; justify-content: space-between; align-items: center;"
                        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? 'block' : 'none'; this.querySelector('i').style.transform = this.querySelector('i').style.transform === 'rotate(180deg)' ? 'rotate(0deg)' : 'rotate(180deg)'">
                        COLOR
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
                    </h3>
                    <div style="display: block;">
                        @foreach($allProductColors as $color)
                            <label style="display: flex; align-items: center; margin-bottom: 12px; cursor: pointer; font-size: 0.9rem; color: #4A4A4A;">
                                <input type="checkbox" 
                                       value="{{ $color }}"
                                       {{ request('color') == $color ? 'checked' : '' }}
                                       onchange="applyColorFilter(this.value, this.checked)"
                                       style="width: 18px; height: 18px; margin-right: 10px; cursor: pointer; accent-color: #B49F79;">
                                {{ $color }}
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Price Filter -->
                <div>
                    <h3 style="font-size: 0.85rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 20px;">
                        PRICE
                    </h3>
                    
                    <div id="priceSlider" style="margin-bottom: 20px;"></div>
                    
                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 15px;">
                        <input type="text" id="minPriceInput" placeholder="0" 
                               style="width: 60px; padding: 6px 8px; border: 1px solid #D0D0D0; border-radius: 3px; font-size: 0.85rem; text-align: center;"
                               onfocus="this.style.borderColor='#B49F79'"
                               onblur="this.style.borderColor='#D0D0D0'">
                        <span style="color: #999;">-</span>
                        <input type="text" id="maxPriceInput" placeholder="18350"
                               style="width: 60px; padding: 6px 8px; border: 1px solid #D0D0D0; border-radius: 3px; font-size: 0.85rem; text-align: center;"
                               onfocus="this.style.borderColor='#B49F79'"
                               onblur="this.style.borderColor='#D0D0D0'">
                    </div>
                    
                    <!-- Filter Button -->
                    <button onclick="applyPriceFilter()" 
                            style="width: 100%; padding: 10px; background: #B49F79; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;"
                            onmouseover="this.style.background='#C893A0'"
                            onmouseout="this.style.background='#B49F79'">
                        APPLY FILTER
                    </button>
                </div>
            </div>

            <!-- Right Content Area -->
            <div style="flex: 1;">
                <!-- Top Bar - Controls -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #E0E0E0;">
                    <button id="showFiltersBtn" onclick="document.getElementById('filterSidebar').style.display='block'; this.style.display='none'; document.getElementById('hideFiltersBtn').style.display='block';"
                            style="padding: 8px 16px; background: white; border: 1px solid #E0E0E0; border-radius: 4px; cursor: pointer; font-weight: 600; color: #B49F79; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; display: none;">
                        SHOW FILTERS ☰
                    </button>

                    <!-- Sorting -->
                    <div style="display: flex; gap: 20px; align-items: center;">
                        <select onchange="if(this.value) { const url = new URL(window.location); url.searchParams.set('sort', this.value); window.location.href = url.toString(); }"
                                style="padding: 6px 12px; background: white; border: none; font-weight: 600; color: #2C2C2C; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; cursor: pointer;">
                            <option value="" {{ !request('sort') || request('sort') == 'best_selling' ? 'selected' : '' }}>BEST SELLING</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>PRICE: LOW TO HIGH</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>PRICE: HIGH TO LOW</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>NEWEST</option>
                        </select>
                    </div>

                    <!-- Grid View Toggle -->
                    <div style="display: flex; gap: 10px;">
                        <button onclick="setGridColumns(2)" data-columns="2"
                                style="width: 32px; height: 32px; display: grid; grid-template-columns: 1fr 1fr; gap: 4px; padding: 4px; background: white; border: 2px solid #E0E0E0; border-radius: 3px; cursor: pointer;">
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                        </button>
                        <button onclick="setGridColumns(3)" data-columns="3"
                                style="width: 32px; height: 32px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 3px; padding: 4px; background: white; border: 2px solid #B49F79; border-radius: 3px; cursor: pointer;">
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                            <div style="background: #B49F79; border-radius: 2px;"></div>
                        </button>
                        <button onclick="setGridColumns(4)" data-columns="4"
                                style="width: 32px; height: 32px; display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 2px; padding: 4px; background: white; border: 2px solid #E0E0E0; border-radius: 3px; cursor: pointer;">
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                            <div style="background: #B49F79; border-radius: 1px;"></div>
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div id="productsGrid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                        @foreach($products as $product)
                            @php
                                $allImages = [];
                                if ($product->image) $allImages[] = route('products.media', $product);
                                foreach ($product->productImages as $pi) $allImages[] = route('product-images.media', $pi);
                            @endphp
                            <div style="cursor: pointer;">
                                <!-- Image -->
                                <div style="height: 350px; background: #F4F4F4; overflow: hidden; border-radius: 4px; margin-bottom: 15px; position: relative;"
                                     @if(count($allImages) > 1)
                                         data-first-image="{{ $allImages[0] }}"
                                         onmouseenter="startImageCycle(this, {{ json_encode($allImages) }})"
                                         onmouseleave="stopImageCycle(this)"
                                     @endif>
                                    @if(count($allImages) > 0)
                                        <a href="{{ route('products.show', $product) }}" style="text-decoration: none; display:block; width:100%; height:100%;">
                                            <img src="{{ $allImages[0] }}" alt="{{ $product->name }}"
                                                 style="width: 100%; height: 100%; object-fit: cover; transition: opacity 0.4s ease;">
                                        </a>
                                        @if(count($allImages) > 1)
                                            <!-- Image dots indicator -->
                                            <div style="position:absolute; bottom:8px; left:50%; transform:translateX(-50%); display:flex; gap:5px; z-index:2;">
                                                @foreach($allImages as $i => $imgUrl)
                                                    <span style="width:6px; height:6px; border-radius:50%; background:{{ $i === 0 ? 'white' : 'rgba(255,255,255,0.5)' }}; transition:background 0.3s;"></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #E0E0E0; color: #999;">
                                            No Image
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <h4 style="font-size: 0.95rem; color: #2C2C2C; font-weight: 600; margin-bottom: 8px; text-align: center;">
                                    <a href="{{ route('products.show', $product) }}" style="color: inherit; text-decoration: none;">
                                        {{ $product->name }}
                                    </a>
                                </h4>
                                
                                <p style="font-size: 0.9rem; color: #999; margin: 0; text-align: center; margin-bottom: 12px;">
                                    Dhs. {{ number_format($product->price, 2) }} AED
                                </p>

                                <!-- Stock Status -->
                                @if($product->stock == 0)
                                    <div style="text-align: center; padding: 8px; background: #F4F4F4; border-radius: 3px; font-size: 0.85rem; color: #999; font-weight: 600;">
                                        OUT OF STOCK
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div style="margin-top: 50px; display: flex; justify-content: center;">
                            {{ $products->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div style="text-align: center; padding: 100px 20px;">
                        <div style="font-size: 4rem; margin-bottom: 20px; color: #B49F79;">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h2 style="font-size: 2rem; color: #2C2C2C; margin-bottom: 15px; font-weight: 700;">
                            No Creations Yet
                        </h2>
                        <p style="font-size: 1.1rem; color: #4A4A4A; margin-bottom: 30px;">
                            No creations match your filters. Try adjusting your search.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .noUi-target {
            background: #E0E0E0;
            border-radius: 4px;
            border: none;
            box-shadow: none;
            height: 6px;
        }
        .noUi-connects {
            background: #2C2C2C;
            border-radius: 4px;
        }
        .noUi-draggable {
            cursor: grab;
        }
        .noUi-draggable:active {
            cursor: grabbing;
        }
        .noUi-handle {
            width: 20px;
            height: 20px;
            right: -10px;
            top: -7px;
            border-radius: 50%;
            background: #2C2C2C;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            cursor: grab;
        }
        .noUi-handle.noUi-handle-lower {
            z-index: 5;
        }
        .noUi-handle.noUi-handle-upper {
            z-index: 4;
        }
        .noUi-handle:active {
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            cursor: grabbing;
        }
        
        @media (max-width: 768px) {
            #filterSidebar {
                display: none;
                position: fixed;
                left: 0;
                top: 0;
                width: 250px;
                height: 100vh;
                background: white;
                z-index: 1000;
                overflow-y: auto;
                padding: 20px;
                box-shadow: 0 0 20px rgba(0,0,0,0.2);
            }
            #filterSidebar.active {
                display: block;
            }
            div > div:first-of-type > div > div {
                flex-direction: column;
            }
            #productsGrid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>

    <script>
        let currentColumns = 3;

        function setGridColumns(columns) {
            currentColumns = columns;
            const grid = document.getElementById('productsGrid');
            grid.style.gridTemplateColumns = `repeat(${columns}, 1fr)`;
            
            // Update button styles
            document.querySelectorAll('[data-columns]').forEach(btn => {
                btn.style.borderColor = btn.dataset.columns == columns ? '#B49F79' : '#E0E0E0';
            });
        }

        function applyCollectionFilter(collectionId) {
            const url = new URL(window.location);
            if (collectionId) {
                url.searchParams.set('collection_id', collectionId);
                // Remove color filter when changing collection since colors are specific to collection
                url.searchParams.delete('color');
            } else {
                url.searchParams.delete('collection_id');
                url.searchParams.delete('color');
            }
            window.location.href = url.toString();
        }

        function applyColorFilter(color, isChecked) {
            const url = new URL(window.location);
            if (isChecked) {
                url.searchParams.set('color', color);
            } else {
                url.searchParams.delete('color');
            }
            window.location.href = url.toString();
        }

        function applyPriceFilter() {
            const minPrice = document.getElementById('minPriceInput').value;
            const maxPrice = document.getElementById('maxPriceInput').value;
            
            const url = new URL(window.location);
            if (minPrice) {
                url.searchParams.set('min_price', minPrice);
            } else {
                url.searchParams.delete('min_price');
            }
            if (maxPrice) {
                url.searchParams.set('max_price', maxPrice);
            } else {
                url.searchParams.delete('max_price');
            }
            window.location.href = url.toString();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('priceSlider');
            const minInput = document.getElementById('minPriceInput');
            const maxInput = document.getElementById('maxPriceInput');
            
            const currentMin = {{ request('min_price', 0) }};
            const currentMax = {{ request('max_price', 18350) }};
            
            if (slider && typeof noUiSlider !== 'undefined') {
                noUiSlider.create(slider, {
                    start: [currentMin, currentMax],
                    connect: true,
                    range: {
                        'min': 0,
                        'max': 18350
                    },
                    step: 1,
                    tooltips: false,
                    format: {
                        to: (value) => Math.round(value),
                        from: (value) => Number(value)
                    }
                });
                
                slider.noUiSlider.on('update', function(values) {
                    minInput.value = values[0];
                    maxInput.value = values[1];
                });
                
                minInput.addEventListener('change', function() {
                    slider.noUiSlider.set([this.value, null]);
                });
                maxInput.addEventListener('change', function() {
                    slider.noUiSlider.set([null, this.value]);
                });
            }
        });

        // ── Image cycling on hover ──
        const cycleTimers = new WeakMap();

        function startImageCycle(container, images) {
            if (images.length <= 1) return;
            let index = 0;
            const img = container.querySelector('img');
            const dots = container.querySelectorAll('span');

            const timer = setInterval(() => {
                index = (index + 1) % images.length;

                // Fade out → swap src → fade in
                img.style.opacity = '0';
                setTimeout(() => {
                    img.src = images[index];
                    img.style.opacity = '1';
                }, 400);

                // Update dots
                dots.forEach((d, i) => {
                    d.style.background = i === index ? 'white' : 'rgba(255,255,255,0.5)';
                });
            }, 2000);

            cycleTimers.set(container, timer);
        }

        function stopImageCycle(container) {
            const timer = cycleTimers.get(container);
            if (timer) {
                clearInterval(timer);
                cycleTimers.delete(container);
            }
            // Reset to first image
            const img = container.querySelector('img');
            const dots = container.querySelectorAll('span');
            if (img) {
                img.style.opacity = '0';
                setTimeout(() => {
                    img.src = container.dataset.firstImage || img.src;
                    img.style.opacity = '1';
                }, 200);
            }
            dots.forEach((d, i) => {
                d.style.background = i === 0 ? 'white' : 'rgba(255,255,255,0.5)';
            });
        }
    </script>
</section>
@endsection
