<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        /* Reset some basic styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .checkout-card {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .checkout-card h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .checkout-card p {
            margin-bottom: 30px;
            color: #555;
            font-size: 16px;
        }

        /* Customize Razorpay button */
        .razorpay-payment-button {
            background-color: #528FF0 !important;
            color: white !important;
            border: none !important;
            padding: 12px 25px !important;
            font-size: 16px !important;
            border-radius: 8px !important;
            cursor: pointer !important;
            transition: background 0.3s ease !important;
        }

        .razorpay-payment-button:hover {
            background-color: #3a6dd5 !important;
        }

        /* Responsive */
        @media (max-width: 500px) {
            .checkout-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="checkout-card">
        <h2>Pay ₹{{ $amount }}</h2>
        <p>Complete your purchase securely with Razorpay</p>
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
    </div>
</body>
</html>
