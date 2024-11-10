<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Products;
use App\Models\Category;
use App\Models\Brand;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $minPrice = Products::min('price') ?? 0;
        $maxPrice = Products::max('price') ?? 10000;

        $categories = Category::all();
        $brandies = Brand::all();


        $brandProductCounts = Brand::withCount('products')->get()->pluck('products_count', 'id')->toArray();

        View::share('minPrice', $minPrice);
        View::share('maxPrice', $maxPrice);

        View::share('categories', $categories);
        View::share('brandies', $brandies);

        View::share('brandProductCounts', $brandProductCounts);
    }
}
