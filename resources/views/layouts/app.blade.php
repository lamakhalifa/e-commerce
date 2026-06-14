<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeSpace | أثاث منزلي راقٍ</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- Sidebar Toggle -->
    <input type="checkbox" id="menu-cb">
    <label for="menu-cb" class="sidebar-overlay"></label>

    <!-- Sidebar -->
    <aside class="sidebar">
        <label for="menu-cb" class="close-sidebar">
            <i class="fa-solid fa-xmark"></i>
        </label>

        <nav class="sidebar-nav">
            <a href="#">غرف المعيشة</a>
            <a href="#">غرف النوم</a>
            <a href="#">المطابخ</a>
            <a href="#">الديكورات</a>
            <a href="#">استشارات التصميم</a>
            <a href="#">اتصل بنا</a>
        </nav>
    </aside>

    <!-- Header -->
    <header>
        <div class="logo">LuxeSpace</div>

        <nav>
            <a href="#">غرف المعيشة</a>
            <a href="#">غرف النوم</a>
            <a href="#">المطابخ</a>
            <a href="#">الديكورات</a>
            <a href="#">استشارات التصميم</a>
            <a href="#">اتصل بنا</a>
        </nav>

        <div class="header-icons">
            <i class="fa-solid fa-bag-shopping icon-btn"></i>

              <a href="{{ route('cart.index') }}" class="icon-btn" title="تسجيل الدخول / إنشاء حساب">
                <i class="fa-solid fa-bag-shopping icon-btn"></i>
            </a>

            <a href="{{ route('login') }}" class="icon-btn" title="تسجيل الدخول / إنشاء حساب">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>

            <label for="menu-cb" class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>

        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <h3>LuxeSpace</h3>
                <p>
                    نحن نصنع مساحات عصرية تدمج بين الفخامة المعمارية والراحة الفائقة
                    لتناسب أسلوب حياتك الرفيع.
                </p>

                <div class="footer-socials">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>

            <!-- Desktop Links -->
            <div class="footer-links">
                <h4>المنتجات</h4>
                <ul>
                    <li><a href="#">مجموعات الكنب</a></li>
                    <li><a href="#">طاولات الطعام</a></li>
                    <li><a href="#">وحدات الإضاءة</a></li>
                    <li><a href="#">خزائن الملابس</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>الشركة</h4>
                <ul>
                    <li><a href="#">من نحن</a></li>
                    <li><a href="#">المصممون</a></li>
                    <li><a href="#">الاستدامة</a></li>
                    <li><a href="#">الوظائف</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>الدعم</h4>
                <ul>
                    <li><a href="#">الاستشارات</a></li>
                    <li><a href="#">سياسة التوصيل</a></li>
                    <li><a href="#">الضمان والصيانة</a></li>
                    <li><a href="#">الأسئلة الشائعة</a></li>
                </ul>
            </div>

            <!-- Mobile Accordion -->
            <div class="footer-accordion">

                <details class="footer-accordion-item">
                    <summary>المنتجات</summary>
                    <ul>
                        <li><a href="#">مجموعات الكنب</a></li>
                        <li><a href="#">طاولات الطعام</a></li>
                        <li><a href="#">وحدات الإضاءة</a></li>
                        <li><a href="#">خزائن الملابس</a></li>
                    </ul>
                </details>

                <details class="footer-accordion-item">
                    <summary>الشركة</summary>
                    <ul>
                        <li><a href="#">من نحن</a></li>
                        <li><a href="#">المصممون</a></li>
                        <li><a href="#">الاستدامة</a></li>
                        <li><a href="#">الوظائف</a></li>
                    </ul>
                </details>

                <details class="footer-accordion-item">
                    <summary>الدعم والخدمات</summary>
                    <ul>
                        <li><a href="#">الاستشارات</a></li>
                        <li><a href="#">سياسة التوصيل</a></li>
                        <li><a href="#">الضمان والصيانة</a></li>
                        <li><a href="#">الأسئلة الشائعة</a></li>
                    </ul>
                </details>

            </div>

        </div>

        <!-- Bottom -->
        <div class="footer-bottom">
            <p>© 2026 جميع الحقوق محفوظة لـ LuxeSpace.</p>
            <p>صنع بكل حب وبطابع مودرن راقٍ.</p>
        </div>

    </footer>

</body>

</html>