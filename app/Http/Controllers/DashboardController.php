<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // إجمالي الطلبات
        $ordersCount = Order::count();

        // إجمالي العملاء
        $usersCount = User::count();

        $categoriesCount = Category::count();



        return view('admin.dashboard', compact('ordersCount', 'usersCount', 'categoriesCount'));
    }

    public function charts()
    {
        $salesTotal = OrderDetails::selectRaw('SUM(quantity * price) as total')->value('total');

        // إجمالي المنتجات
        $productsCount = Product::count();

        // إحصائيات المبيعات الشهرية
        $salesPerMonth = OrderDetails::selectRaw('MONTH(orders.created_at) as month, SUM(order_details.quantity * order_details.price) as total')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // تجهيز بيانات الرسم البياني
        $months = range(1, 12);
        $salesData = [];
        foreach ($months as $month) {
            $salesData[] = $salesPerMonth[$month] ?? 0;
        }

        return view('admin.chart', compact('salesTotal', 'productsCount', 'salesData'));
    }




    public function search(Request $request)
    {
        $searchKey = $request->searchkey;


        $category = Category::where('name_en', 'like', "%$searchKey%")
            ->orWhere('name_ar', 'like', "%$searchKey%")
            ->first();

        if ($category) {

            $products = $category->product()->paginate(6);
        } else {

            $products = Product::where('name_en', 'like', "%$searchKey%")
                ->orWhere('name_ar', 'like', "%$searchKey%")
                ->paginate(6);
        }

        return view('admin.products.product', compact('products', 'searchKey'));
    }
    public function getProducts($category_id)
    {

        $products = Product::where('category_id', $category_id)->paginate(3);
        // dd($products);

        return view('admin.products.product', compact('products'));
    }

    // public function AllCategories(){
    //     $categories=Category::paginate(3);
    //     $products=Product::paginate(3);

    //     return view('admin.products.category',compact('categories','products'));
    // }
    public function getAllProducts()
    {

        $products = Product::orderBy('category_id', 'asc')->paginate(2);
        // dd($products);

        return view('admin.products.product', compact('products'));
    }
    public function ProdutDetails($id)
    {
        $product = Product::with('category', 'images')->where('id', $id)->first();

        $priceRange = $product->price * 0.10;
        $minPrice = $product->price - $priceRange;
        $maxPrice = $product->price + $priceRange;

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            // ->whereBetween('price',[$minPrice,$maxPrice])
            ->inRandomOrder()->limit(3)->get();

        return view('admin.products.productdetails', compact('product', 'relatedProducts'));
    }
    public function getCategories()
    {
        $categories = Category::paginate(3);
        $products = Product::latest()->take(3)->get();

        // dd($reult);
        return view('welcome', compact('categories', 'products'));
    }

    public function AllCategoriesforadmin()
    {
        $categories = Category::paginate(3);
        $products = Product::paginate(3);

        return view('admin.products.category', compact('categories', 'products'));
    }

    public function productTableAdmin()
    {
        $products = Product::all();
        // dd($products);

        return view('admin.products.productTable', compact('products'));
    }

    public function recentorders()
    {
        $recentOrders = Order::with(['user', 'order_details'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.recentorders', compact('recentOrders'));
    }
    public function getUsers()
    {
        $users=User::with(['order.order_details'])->get();
        return view('admin.users', compact('users'));
    }
}
