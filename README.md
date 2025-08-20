Mini E-Commerce Website (Laravel)

This is a simple Laravel-based e-commerce application built for a machine test. It supports user authentication, product browsing, cart functionality, and order placement with stock management.

---

## 🚀 Features

- User Registration & Login (Laravel Breeze)
- Product Listing (with stock info)
- Add to Cart (with stock validation)
- Buy Now (simulate purchase)
- Order data stored in database
- Seeded sample products
- Uses Laravel's validation rules
- admin can add,edit,delet product
- user can view and buy product
- payment gateway(Razorpay)

---

 1. Clone the Project

    git clone https://github.com/yourusername/mini-ecommerce.git
    cd mini-ecommerce

2. Install Dependencies

        composer install
        npm install
        npm run dev
3. Update your database credentials in .env:

        DB_DATABASE=mini_ecommerce
4. Run Migrations and Seeders

    php artisan migrate --seed
5. Start the Server

    php artisan serve
    Now visit: http://127.0.0.1:8000
