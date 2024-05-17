<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Manufacturer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Sử dụng view composer để chia sẻ dữ liệu với view
        View::composer('header.dashboard', function ($view) {
            $categories = Category::all();
            $manufacturers = Manufacturer::all();
            // Bạn có thể thêm các truy vấn khác tại đây

            $view->with('categories', $categories)
                 ->with('manufacturers', $manufacturers);
        });
    }
}
