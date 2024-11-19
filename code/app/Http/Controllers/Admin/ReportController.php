<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Support\Facades\DB; // Import DB
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Thống kê tổng doanh thu theo từng danh mục
        $categoryRevenue = DB::table('order_items')
            ->select('products.category_id', DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->groupBy('products.category_id')
            ->get();

        // Tổng số đơn hàng
        $totalOrders = Orders::count();

        // Tổng số khách hàng
        $totalCustomers = DB::table('users')->where('role', 'customer')->count();
        
        // Doanh thu theo ngày từ bảng payments 
        $revenueByDate = DB::table('payments') 
            ->select(DB::raw('DATE(payment_date) as date, SUM(amount) as total_revenue')) 
            ->groupBy('date') 
            ->orderBy('date') // Thêm sắp xếp theo ngày
            ->get(); 

        // Doanh thu theo tháng từ bảng payments 
        $revenueByMonth = DB::table('payments') 
            ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_revenue')) 
            ->groupBy('month') 
            ->orderBy('month') // Thêm sắp xếp theo tháng
            ->get(); 

        // Doanh thu theo năm từ bảng payments 
        $revenueByYear = DB::table('payments') 
            ->select(DB::raw('YEAR(payment_date) as year, SUM(amount) as total_revenue')) 
            ->groupBy('year') 
            ->orderBy('year') // Thêm sắp xếp theo năm
            ->get(); 

        // Doanh thu theo phương thức thanh toán 
        $revenueByPaymentMethod = DB::table('payments') 
            ->select('payment_method', DB::raw('SUM(amount) as total_revenue')) 
            ->groupBy('payment_method') 
            ->get(); 

        // Trả dữ liệu về view
        return view('admin.reports.index', compact(
            'categoryRevenue',
            'totalOrders',
            'totalCustomers',
            'revenueByDate',
            'revenueByMonth',
            'revenueByYear',
            'revenueByPaymentMethod' // Thêm vào compact 
        ));
    }

    // Phương thức để lấy doanh thu theo ngày cho biểu đồ
    public function getIncomeData()
    {
        // Lấy doanh thu theo ngày từ bảng payments
        $dailyIncome = DB::table('payments')
            ->select(DB::raw('DATE(payment_date) as date'), DB::raw('SUM(amount) as total_revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_revenue', 'date'); // Lấy ra dữ liệu theo định dạng key-value

        return response()->json($dailyIncome);
    }

    public function getMonthlyIncomeData()
    {
    // Doanh thu theo tháng từ bảng payments 
    $revenueByMonth = DB::table('payments') 
        ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_revenue')) 
        ->groupBy('month') 
        ->pluck('total_revenue', 'month');

    return response()->json($revenueByMonth);
    }

    public function getYearlyIncomeData()
    {
    // Doanh thu theo năm từ bảng payments 
    $revenueByYear = DB::table('payments') 
        ->select(DB::raw('YEAR(payment_date) as year, SUM(amount) as total_revenue')) 
        ->groupBy('year') 
        ->pluck('total_revenue', 'year');

    return response()->json($revenueByYear);
    }

}
