@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://js.stripe.com/v3/"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

    .cart-wrapper {
        font-family: 'IBM Plex Sans Arabic', sans-serif;
        background-color: #f4f3ef;
        color: #2a2a2a;
        padding: 40px 20px;
        min-height: 100vh;
        direction: rtl;
    }

    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 40px;
    }

    .cart-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cart-title span {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: #8c7662;
    }

    /* قسم المنتجات في السلة */
    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .cart-item {
        background-color: #eae8e1;
        border-radius: 18px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        position: relative;
        transition: transform 0.3s ease;
    }

    .cart-item:hover {
        transform: translateY(-2px);
    }

    .item-details {
        display: flex;
        align-items: center;
        gap: 20px;
        flex: 1;
    }

    .item-img {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        object-fit: cover;
        background-color: #f4f3ef;
    }

    .item-info h3 {
        font-size: 16px;
        font-weight: 600;
        color: #2a2a2a;
        margin-bottom: 6px;
    }

    .item-info p {
        font-size: 13px;
        color: #707070;
    }

    /* التحكم بالكمية */
    .quantity-control {
        display: flex;
        align-items: center;
        background-color: #f4f3ef;
        border-radius: 30px;
        padding: 4px;
        gap: 10px;
    }

    .qty-btn {
        background: transparent;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        color: #2a2a2a;
        transition: color 0.2s;
    }

    .qty-btn:hover {
        color: #8c7662;
    }

    .qty-val {
        font-size: 14px;
        font-weight: 600;
        min-width: 20px;
        text-align: center;
    }

    /* الأسعار والحذف */
    .item-actions {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .item-price {
        font-size: 16px;
        font-weight: 700;
        color: #8c7662;
        min-width: 90px;
        text-align: left;
    }

    .btn-remove {
        background: transparent;
        border: none;
        color: #a0a0a0;
        font-size: 16px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .btn-remove:hover {
        color: #dc3545;
    }

    /* ملخص الطلب الجانبي */
    .cart-summary {
        background-color: #eae8e1;
        border-radius: 20px;
        padding: 30px;
        height: fit-content;
        position: sticky;
        top: 40px;
    }

    .summary-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding-bottom: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #606060;
        margin-bottom: 15px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 700;
        color: #2a2a2a;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding-top: 15px;
        margin-top: 15px;
    }

    .summary-row.total span {
        color: #8c7662;
    }

    /* كود الخصم */
    .coupon-box {
        display: flex;
        gap: 10px;
        margin: 20px 0;
    }

    .coupon-input {
        flex: 1;
        background-color: #f4f3ef;
        border: 1px solid transparent;
        border-radius: 30px;
        padding: 10px 16px;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color 0.3s;
    }

    .coupon-input:focus {
        border-color: #8c7662;
    }

    .btn-checkout {
        background-color: #8c7662;
        color: #ffffff;
        border: none;
        width: 100%;
        padding: 15px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        transition: background-color 0.3s;
        margin-top: 20px;
    }

    .btn-checkout:hover {
        background-color: #2a2a2a;
    }

    .btn-checkout:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .back-to-shop {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #707070;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        margin-top: 25px;
        transition: color 0.2s;
    }

    .back-to-shop:hover {
        color: #8c7662;
    }

    /* نموذج البطاقة من Stripe */
    #card-element {
        background: #f4f3ef;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px solid transparent;
        transition: border-color 0.3s;
        margin-bottom: 5px;
    }
    
    #card-errors {
        color: #dc3545;
        font-size: 13px;
        margin-top: 8px;
    }
    
    /* نموذج بيانات العميل */
    .customer-info {
        margin-bottom: 20px;
    }
    
    .customer-input {
        width: 100%;
        background-color: #f4f3ef;
        border: 1px solid transparent;
        border-radius: 12px;
        padding: 12px 16px;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
        margin-bottom: 12px;
        box-sizing: border-box;
    }
    
    .customer-input:focus {
        border-color: #8c7662;
    }

    /* رسائل الخطأ أو النجاح الآتية من السيرفر */
    .alert {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
    }
    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    /* حالة السلة فارغة */
    .empty-cart {
        text-align: center;
        padding: 50px 20px;
        background-color: #eae8e1;
        border-radius: 20px;
    }

    .empty-cart i {
        font-size: 60px;
        color: #8c7662;
        margin-bottom: 15px;
    }

    .empty-cart h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    @media (max-width: 992px) {
        .cart-container {
            grid-template-columns: 1fr;
        }
        .cart-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .item-actions {
            width: 100%;
            justify-content: space-between;
            border-top: 1px solid rgba(0,0,0,0.03);
            padding-top: 12px;
        }
        .item-price {
            text-align: right;
        }
        .btn-remove {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    }
</style>

<div class="cart-wrapper">
    <div class="cart-container">
        
        <div>
            <h1 class="cart-title">حقيبة <span>التسوق</span></h1>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <div class="cart-items-list" id="cart-items-list">
                @if(count($cart) > 0)
                    @foreach($cart as $id => $item)
                        <div class="cart-item">
                            <div class="item-details">
                                <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=150&q=80' }}" class="item-img" alt="{{ $item['name'] }}">
                                <div class="item-info">
                                    <h3>{{ $item['name'] }}</h3>
                                    <p>السعر الفردي: {{ number_format($item['price'], 2) }} ر.س</p>
                                </div>
                            </div>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button class="qty-btn" onclick="updateQty(this, -1)"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">{{ $item['quantity'] }}</span>
                                    <button class="qty-btn" onclick="updateQty(this, 1)"><i class="fa-solid fa-plus"></i></button>
                                </div>
                                <div class="item-price" data-single="{{ $item['price'] }}">
                                    {{ number_format($item['price'] * $item['quantity'], 2) }} ر.س
                                </div>
                                
                                <form action="{{ route('cart.destroy', $id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه القطعة من سلتك؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-cart">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <h3>حقيبة التسوق فارغة حالياً</h3>
                        <p>تصفح تصاميمنا الفريدة وأضف ما ينال إعجابك.</p>
                    </div>
                @endif
            </div>

            <a href="/" class="back-to-shop">
                <i class="fa-solid fa-arrow-right"></i> العودة لمتابعة التسوق
            </a>
        </div>

        <aside class="cart-summary">
            <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                @csrf
                
                <h2 class="summary-title" style="margin-top: 10px;">بيانات العميل</h2>
                
                <div class="customer-info">
                    <input type="text" name="name" id="customer-name" class="customer-input" placeholder="الاسم الكامل المكتوب على البطاقة" required>
                    <input type="email" name="email" id="customer-email" class="customer-input" placeholder="البريد الإلكتروني" required>
                </div>

                <h2 class="summary-title" style="margin-top: 20px;">بيانات البطاقة</h2>

                <div style="margin: 15px 0;">
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                </div>

                <div class="coupon-box">
                    <input type="text" name="coupon_code" class="coupon-input" id="coupon-code" placeholder="أدخل كود الخصم...">
                </div>
                
                <h2 class="summary-title" style="margin-top: 25px;">ملخص الطلب</h2>
                
                <div class="summary-row">
                    <span>المجموع الفرعي</span>
                    <span id="subtotal">{{ number_format($total, 2) }} ر.س</span>
                </div>
                
                <div class="summary-row">
                    <span>الشحن والتوصيل</span>
                    <span style="color: #4b6b2a; font-weight: 500;">مجاني</span>
                </div>

                <div class="summary-row total">
                    <span>الإجمالي الإجمالي</span>
                    <span id="grand-total">{{ number_format($total, 2) }} ر.س</span>
                </div>

                <button type="submit" id="payment-button" class="btn-checkout" {{ count($cart) == 0 ? 'disabled' : '' }}>
                    <i class="fa-solid fa-lock"></i> <span id="btn-text">تأكيد الدفع الآمن ({{ number_format($total, 2) }} ر.س)</span>
                </button>
            </form>
        </aside>

    </div>
</div>

<script>
    // جلب مفتاح Stripe العام المستضاف في البيئة الخاصة بك
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    
    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '14px',
                fontFamily: 'IBM Plex Sans Arabic, sans-serif',
                color: '#2a2a2a',
                '::placeholder': {
                    color: '#a0a0a0'
                }
            }
        }
    });
    card.mount('#card-element');
    
    card.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const paymentButton = document.getElementById('payment-button');
        const btnText = document.getElementById('btn-text');
        
        paymentButton.disabled = true;
        btnText.innerText = 'جاري الاتصال بـ Stripe...';
        
        const options = {
            name: document.getElementById('customer-name').value
        };
        
        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
                document.getElementById('card-errors').textContent = result.error.message;
                paymentButton.disabled = false;
                btnText.innerText = 'تأكيد الدفع الآمن';
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });
    
    function stripeTokenHandler(token) {
        const form = document.getElementById('payment-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        
        document.getElementById('btn-text').innerText = 'جاري معالجة الطلب بسيرفراتنا...';
        form.submit();
    }
    
    // دوال الواجهة لتعديل شكل الحساب مؤقتاً عند تعديل العميل للكميات قبل التحديث الفعلي بالباك اند
    function recalculateTotal() {
        let total = 0;
        document.querySelectorAll('.item-price').forEach(price => {
            total += parseFloat(price.innerText.replace(/[^0-9.-]+/g, ""));
        });
        
        const formatted = total.toLocaleString('en-US', {minimumFractionDigits: 2}) + " ر.س";
        document.getElementById('subtotal').innerText = formatted;
        document.getElementById('grand-total').innerText = formatted;
        document.getElementById('btn-text').innerText = `تأكيد الدفع الآمن (${formatted})`;
    }
    
    function updateQty(btn, change) {
        const valSpan = btn.parentElement.querySelector('.qty-val');
        let currentVal = parseInt(valSpan.innerText);
        currentVal += change;
        if(currentVal < 1) return;
        valSpan.innerText = currentVal;
        
        const actionsDiv = btn.closest('.item-actions');
        const priceDiv = actionsDiv.querySelector('.item-price');
        const singlePrice = parseFloat(priceDiv.getAttribute('data-single'));
        priceDiv.innerText = (singlePrice * currentVal).toLocaleString('en-US', {minimumFractionDigits: 2}) + " ر.س";
        
        recalculateTotal();
            }
</script>
@endsection