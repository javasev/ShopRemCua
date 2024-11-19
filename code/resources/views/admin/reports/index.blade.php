@extends('layouts.admin')

@section('title', 'Báo cáo')

@section('content')

<style>
    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px; /* Khoảng cách giữa header và các thẻ card */
        margin-left: -150px; /* Điều chỉnh khoảng cách bên trái gần với sidebar */
    }
    
    .header img {
        width: 30px; /* Kích thước icon */
        height: 30px; /* Kích thước icon */
        margin-right: 10px; /* Khoảng cách giữa icon và tiêu đề */
    }

    .header h2 {
        font-size: 30px; /* Kích thước chữ tiêu đề */
        margin: 0; /* Bỏ margin để tiêu đề gần với icon hơn */
    }
</style>

<div class="container">
    <div class="header">
        
        <h2>Báo Cáo</h2>
    </div>
<div class="container my-5">
    <!-- Section: Cards -->
    <div class="row my-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số đơn hàng</h5>
                    <h2 class="card-text">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số khách hàng</h5>
                    <h2 class="card-text">{{ $totalCustomers }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Doanh thu theo ngày -->
    <div class="section mt-4">
        <h3>Doanh thu theo ngày</h3>
        <canvas id="revenueByDateChart" style="max-height: 400px;"></canvas>
    </div>

    <!-- Section: Doanh thu theo tháng -->
    <div class="section mt-4">
        <h3>Doanh thu theo tháng</h3>
        <canvas id="revenueByMonthChart" style="max-height: 400px;"></canvas>
    </div>

    <!-- Section: Doanh thu theo năm -->
    <div class="section mt-4">
        <h3>Doanh thu theo năm</h3>
        <canvas id="revenueByYearChart" style="max-height: 400px;"></canvas>
    </div>

    <!-- Section: Doanh thu theo danh mục -->
    <div class="section mt-4">
        <h3>Doanh thu theo danh mục</h3>
        <canvas id="revenueByCategoryChart" style="max-height: 400px;"></canvas>
    </div>

    <!-- Section: Doanh thu theo phương thức thanh toán -->
    <div class="section mt-4">
        <h3>Doanh thu theo phương thức thanh toán</h3>
        <canvas id="revenueByPaymentMethodChart" style="max-height: 400px;"></canvas>
    </div>
</div>

<script>
// Biểu đồ Doanh thu theo ngày
const revenueByDateCtx = document.getElementById('revenueByDateChart').getContext('2d');
const revenueByDateChart = new Chart(revenueByDateCtx, {
    type: 'line',
    data: {
        labels: @json($revenueByDate->pluck('date')),
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueByDate->pluck('total_revenue')),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            fill: true,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Tổng doanh thu (VND)'
                }
            }
        }
    }
});

// Biểu đồ Doanh thu theo tháng
const revenueByMonthCtx = document.getElementById('revenueByMonthChart').getContext('2d');
const revenueByMonthChart = new Chart(revenueByMonthCtx, {
    type: 'bar',
    data: {
        labels: @json($revenueByMonth->pluck('month')),
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueByMonth->pluck('total_revenue')),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Tổng doanh thu (VND)'
                }
            }
        }
    }
});

// Biểu đồ Doanh thu theo năm
const revenueByYearCtx = document.getElementById('revenueByYearChart').getContext('2d');
const revenueByYearChart = new Chart(revenueByYearCtx, {
    type: 'pie',
    data: {
        labels: @json($revenueByYear->pluck('year')),
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueByYear->pluck('total_revenue')),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Doanh thu theo năm'
            }
        }
    }
});

// Biểu đồ Doanh thu theo danh mục
const revenueByCategoryCtx = document.getElementById('revenueByCategoryChart').getContext('2d');
const revenueByCategoryChart = new Chart(revenueByCategoryCtx, {
    type: 'bar',
    data: {
        labels: @json($categoryRevenue->pluck('category_id')),
        datasets: [{
            label: 'Doanh thu',
            data: @json($categoryRevenue->pluck('total_revenue')),
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Tổng doanh thu (VND)'
                }
            }
        }
    }
});

// Biểu đồ Doanh thu theo phương thức thanh toán
const revenueByPaymentMethodCtx = document.getElementById('revenueByPaymentMethodChart').getContext('2d');
const revenueByPaymentMethodChart = new Chart(revenueByPaymentMethodCtx, {
    type: 'pie',
    data: {
        labels: @json($revenueByPaymentMethod->pluck('payment_method')),
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueByPaymentMethod->pluck('total_revenue')),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)' // Màu cho thanh toán trực tuyến
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)' // Màu cho thanh toán trực tuyến
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Doanh thu theo phương thức thanh toán'
            }
        }
    }
});
</script>
@endsection
<!-- Thêm Chart.js từ CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>