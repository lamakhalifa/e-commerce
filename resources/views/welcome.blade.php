@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="hero">
            <div class="hero-text">
                <h1>اصنع <span>الفخامة والراحة</span><br>بأثاث راقٍ وصناعة يدوية</h1>
                <p>خامات طبيعية فاخرة، تصاميم معمارية فريدة، واهتمام فائق بالتفاصيل لتجعل من منزلك لوحة فنية تنبض
                    بالدفء.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary">تصفح المجموعات <i class="fa-solid fa-arrow-left"></i></button>
                    <button class="btn">حجز استشارة <i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                </div>
            </div>
            <div class="hero-image-side">
                <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80"
                    alt="أثاث راقي" class="hero-img">
                <div class="badge-customers"><i class="fa-solid fa-star" style="color: #d4af37;"></i> +15,000 منزل تم
                    تأثيثه</div>
            </div>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <h3>+120</h3>
                <p>قطع أثاث حصرية</p>
            </div>
            <div class="stat-card">
                <h3>100%</h3>
                <p>أخشاب مستدامة</p>
            </div>
            <div class="stat-card">
                <h3>+45</h3>
                <p>خيار من الأقمشة</p>
            </div>
            <div class="stat-card">
                <h3>15 سنة</h3>
                <p>ضمان ممتد</p>
            </div>
        </section>

        <section>
            <div class="section-header">
                <div class="section-title">
                    <p>التصنيفات</p>
                    <h2>تصفح <span>حسب غرف المنزل</span></h2>
                </div>
            </div>

            <div class="rooms-masonry">

                @foreach ($rooms as $index => $room)
                    <a href="{{ url('/category/' . $room->id) }}"
                        class="room-card
               @if ($index == 0) grid-large
               @elseif($index == 1) grid-tall
               @else grid-small @endif
               ">
                        <img src="{{ $room->getFirstMediaUrl('images') }}" alt="{{ $room->name }}">

                        <div class="room-overlay">
                            <h3>{{ $room->name }}</h3>

                            <span>
                                تصفح {{ $room->products()->count() }} منتج
                                <i class="fa-solid fa-arrow-left"></i>
                            </span>
                        </div>

                    </a>
                @endforeach

            </div>
        </section>

        <section>
            <div class="section-header">
                <div class="section-title">
                    <p>المجموعة الأحدث</p>
                    <h2>قطع <span>نالت إعجاب عملائنا</span></h2>
                </div>
                <a href="#" class="view-all">عرض الكتالوج بالكامل <i
                        class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>

            <div class="products-grid">
                <!-- منتج 1 -->
                <div class="product-card">
                    <div class="product-img-box">
                        <span class="fav-icon"><i class="fa-regular fa-heart"></i></span>
                        <img src="https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=500&q=80"
                            alt="كرسي مخملي">
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-title">مقعد "أورورا" المخملي <i
                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        <div class="product-price">$340</div>
                    </div>
                </div>

                <!-- منتج 2 -->
                <div class="product-card">
                    <div class="product-img-box">
                        <span class="fav-icon"><i class="fa-regular fa-heart"></i></span>
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=500&q=80"
                            alt="أريكة مفردة">
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-title">أريكة الاسترخاء المفردة <i
                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        <div class="product-price">$410</div>
                    </div>
                </div>

                <!-- منتج 3 -->
                <div class="product-card">
                    <div class="product-img-box">
                        <span class="fav-icon"><i class="fa-regular fa-heart"></i></span>
                        <img src="https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&w=500&q=80"
                            alt="طاولة قهوة">
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-title">طاولة رويال الهندسية <i
                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        <div class="product-price">$280</div>
                    </div>
                </div>

                <!-- منتج 4 -->
                <div class="product-card">
                    <div class="product-img-box">
                        <span class="fav-icon"><i class="fa-regular fa-heart"></i></span>
                        <img src="https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=500&q=80"
                            alt="إضاءة مودرن">
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-title">إضاءة "نورديك" الأرضية <i
                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        <div class="product-price">$195</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- قيم البراند الأربعة -->
        <section class="values-grid">
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-tree"></i></div>
                <h4>استدامة بيئية</h4>
                <p>نعتمد بالكامل على أخشاب طبيعية من مصادر بيئية مسؤولة.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-compass-drafting"></i></div>
                <h4>تصاميم حصرية</h4>
                <p>كل قطعة مرسومة ومصممة خصيصاً لبراندنا وغير مكررة.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>اتقان ومسؤولية</h4>
                <p>نلتزم بأعلى معايير الفحص ومراقبة الجودة والتحمل.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-couch"></i></div>
                <h4>راحة لا تضاهى</h4>
                <p>الجمال لا يتعارض مع الراحة؛ نهتم بهندسة المقاعد الفاخرة.</p>
            </div>
        </section>
    @endsection
