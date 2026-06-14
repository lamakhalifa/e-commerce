@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <a href="/">الرئيسية</a> &gt; <span>{{ $category->name }}</span>
    </div>

    <!-- Title -->
    <div class="page-title-section">
        <h1>قطع <span>{{ $category->name }}</span></h1>
        <p>{{ $category->description }}</p>
    </div>

    <!-- Filter Buttons -->
    <div class="sub-filter-container">

        <button class="sub-filter-btn active"
                onclick="filter('all', this)">
            كل المعروض
        </button>

        @foreach($subCategories as $subCat)
            <button class="sub-filter-btn"
                    onclick="filter('{{ $subCat->id }}', this)">
                {{ $subCat->name }}
            </button>
        @endforeach

    </div>

    <!-- Products -->
    <div class="products-gallery">

        @forelse($products as $product)

            <div class="product-card"
                 data-cat="{{ $product->category_id }}">

                <div class="product-img-box">

                    <img src="{{ $product->media->first() ? $product->media->first()->getUrl() : 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=500&q=80' }}"
                         alt="{{ $product->name }}">

                    <div class="product-hover-mask">

                        <button class="btn-action-cart"
                                onclick="addToCart({{ $product->id }})">
                            <i class="fa-solid fa-cart-plus"></i>
                            إضافة للسلة
                        </button>

                        <a href="{{ route('products.show', $product->id) }}"
                           class="btn-action-details">
                            التفاصيل
                        </a>

                    </div>

                </div>

                <div class="product-info">
                    <h3 class="product-title">{{ $product->name }}</h3>
                    <div class="product-price">
                        {{ number_format($product->price, 2) }} ر.س
                    </div>
                </div>

            </div>

        @empty

            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                لا توجد منتجات حالياً
            </div>

        @endforelse

    </div>

</div>

<!-- 🔔 Toast -->
<div id="toast" class="toast"></div>


<script>

// فلترة الأقسام
function filter(id, btn) {

    document.querySelectorAll('.sub-filter-btn')
        .forEach(b => b.classList.remove('active'));

    btn.classList.add('active');

    document.querySelectorAll('.product-card').forEach(card => {

        const cat = card.dataset.cat;

        if (id === 'all' || cat === id) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }

    });
}


// 🔔 Toast Message
function showToast(message, success = true) {

    const toast = document.getElementById('toast');

    toast.textContent = message;
    toast.style.background = success ? '#2ecc71' : '#e74c3c';

    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 2000);
}


// 🛒 إضافة للسلة (مصّحح بالكامل)
function addToCart(productId) {

    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(async res => {

        const data = await res.json().catch(() => null);

        if (res.status === 401) {
            showToast("سجل دخول أولاً", false);
            return;
        }

        if (!res.ok) {
            showToast(data?.message ?? "حدث خطأ", false);
            return;
        }

        showToast(data.message, true);

    })
    .catch(() => {
        showToast("فشل الاتصال بالسيرفر", false);
    });

}

</script>
@endsection