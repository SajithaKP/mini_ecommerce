<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>Pay ₹{{ $amount }}</h2>

    <form action="{{ route('payment.verify') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ $key }}"
                data-amount="{{ $amount * 100 }}"
                data-currency="INR"
                data-order_id="{{ $order_id }}"
                data-buttontext="Pay with Razorpay"
                data-name="Mini E-Commerce"
                data-description="Test Transaction"
                data-prefill.name="{{ auth()->user()->name }}"
                data-prefill.email="{{ auth()->user()->email }}"
                data-theme.color="#528FF0">
        </script>
    </form>
</body>
</html>
