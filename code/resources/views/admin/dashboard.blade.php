@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .card-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 5px; /* Giảm khoảng cách giữa các card */
    }

    .card {
        display: flex;
        width: 400px; /* Tăng chiều rộng cho card */
        height: 180px; /* Tăng chiều cao cho card */
        margin: 0; /* Xóa margin dưới card */
        border-radius: 10px;
        transition: transform 0.3s ease;
        color: #fff;
        padding: 10px; /* Thêm padding cho card */
    }

    .card-1 {
    background: linear-gradient(135deg, #8e44ad, #3498db); /* Màu gradient mới cho card 1 (tím đậm - xanh biển) */
    }

    .card-2 {
    background: linear-gradient(135deg, #e74c3c, #f39c12); /* Màu gradient mới cho card 2 (đỏ - cam) */
    }

    .card-3 {
    background: linear-gradient(135deg, #2ecc71, #16a085); /* Màu gradient mới cho card 3 (xanh lá - xanh ngọc) */
    }


    .card-content {
        display: flex;
        width: 100%;
        align-items: center; /* Căn giữa dọc nội dung trong card */
        justify-content: flex-start; /* Căn trái nội dung trong card */
        height: 100%; /* Đảm bảo nội dung chiếm hết chiều cao của card */
    }

    /* Bên trái chứa icon */
    .card-left {
        width: 30%; /* Icon chiếm 30% */
        display: flex;
        justify-content: center;
        align-items: center; /* Căn giữa dọc icon */
        padding: 10px; /* Giảm khoảng cách giữa icon và viền */
    }

    .card-left img {
        width: 60px; /* Kích thước icon */
        height: 60px; /* Kích thước icon */
    }

    /* Vách ngăn */
    .divider {
        width: 2px; /* Độ dày của vách ngăn */
        background-color: #fff; /* Màu sắc của vách ngăn */
        height: 80%; /* Chiều cao của vách ngăn */
    }

    /* Bên phải chứa số lượng và văn bản */
    .card-right {
        flex: 1; /* Phần còn lại chiếm 70% */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Căn giữa dọc cho văn bản */
        padding-left: 10px; /* Thêm khoảng cách bên trái để không sát viền */
        height: 100%; /* Đảm bảo chiếm hết chiều cao của card */
    }

    /* Chia phần bên phải thành 2 hàng */
    .card-right .card-top {
        font-size: 24px; /* Kích thước chữ cho số lượng */
        font-weight: bold;
        border-bottom: 1px solid #fff; /* Đường ngăn cách */
        padding-bottom: 5px; /* Khoảng cách giữa số lượng và văn bản */
        margin-bottom: 5px; /* Khoảng cách giữa số lượng và văn bản */
    }

    .card-right .card-bottom {
        font-size: 16px; /* Kích thước chữ cho tiêu đề */
        text-transform: uppercase; /* Chữ in hoa */
    }

    .chart-container {
        position: relative;
        margin-top: 20px; /* Khoảng cách giữa thẻ card và biểu đồ */
    }

    /* Tùy chỉnh để các tab nằm bên phải */
    .tab-container {
        display: flex;
        justify-content: flex-end; /* Đẩy các tab sang bên phải */
        margin-bottom: 10px; /* Khoảng cách giữa tab và biểu đồ */
    }

    /* Hộp chứa biểu đồ và tab */
    .box-container {
        border: 2px; 
        border-radius: 10px; /* Bo góc */
        padding: 20px; /* Thêm padding cho hộp */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
        background-color: #ffffff; /* Màu nền của hộp */
    }

    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px; /* Khoảng cách giữa header và các thẻ card */
        margin-left: -150px; /* Điều chỉnh khoảng cách bên trái gần với sidebar */
    }
    
    .header img {
        width: 33px; /* Kích thước icon */
        height: 33px; /* Kích thước icon */
        margin-right: 10px; /* Khoảng cách giữa icon và tiêu đề */
    }

    .header h2 {
        font-size: 30px; /* Kích thước chữ tiêu đề */
        margin: 0; /* Bỏ margin để tiêu đề gần với icon hơn */
    }
</style>

<div class="container">
    <div class="header">
        
        <h2>Dashboard</h2>
    </div>

<div class="card-deck">
    <div class="card card-1">
        <div class="card-content">
            
            <div class=""></div>
            <div class="card-right">
                <div class="card-top">{{ $productCount }}</div>
                <div class="card-bottom">Sản phẩm</div>
            </div>
        </div>
    </div>

    <div class="card card-2">
        <div class="card-content">
           
            <div class=""></div>
            <div class="card-right">
                <div class="card-top">{{ $categoryCount }}</div>
                <div class="card-bottom">Danh mục</div>
            </div>
        </div>
    </div>

    <div class="card card-3">
        <div class="card-content">
            
            <div class=""></div>
            <div class="card-right">
                <div class="card-top">{{ $orderCount }}</div>
                <div class="card-bottom">Đơn hàng</div>
            </div>
        </div>
    </div>
</div>


    <div class="row chart-row mt-4">
        <div class="col-md-12">
            <div class="box-container">
            <div class="">
    <h3>Doanh thu theo ngày</h3>
    <div class="chart-container">
        <canvas id="incomeChart"></canvas>
    </div>

    <h3 class="mt-4">Doanh thu theo tháng</h3>
    <div class="chart-container">
        <canvas id="monthlyIncomeChart"></canvas>
    </div>

    <h3 class="mt-4">Doanh thu theo năm</h3>
    <div class="chart-container">
        <canvas id="yearlyIncomeChart"></canvas>
    </div>
    </div>

            </div>
        </div>
    </div>

    <footer class="mt-4 text-center">
        <p>&copy; {{ date('Y') }} Chào mừng bạn đến trang Quản tri viên.</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Doanh thu theo ngày
    fetch('{{ route('admin.reports.getIncomeData') }}')
        .then(response => response.json())
        .then(data => {
            const labels = Object.keys(data); // Ngày
            const revenues = Object.values(data); // Doanh thu

            const ctx = document.getElementById('incomeChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu theo ngày',
                        data: revenues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Doanh thu (VND)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Ngày'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching income data:', error));

    // Doanh thu theo tháng
    fetch('{{ route('admin.reports.getMonthlyIncomeData') }}')
        .then(response => response.json())
        .then(data => {
            const labels = Object.keys(data); // Tháng
            const revenues = Object.values(data); // Doanh thu

            const ctx = document.getElementById('monthlyIncomeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: revenues,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Doanh thu (VND)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tháng'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching monthly income data:', error));

    // Doanh thu theo năm
    fetch('{{ route('admin.reports.getYearlyIncomeData') }}')
        .then(response => response.json())
        .then(data => {
            const labels = Object.keys(data); // Năm
            const revenues = Object.values(data); // Doanh thu

            const ctx = document.getElementById('yearlyIncomeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu theo năm',
                        data: revenues,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Doanh thu (VND)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Năm'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching yearly income data:', error));
</script>
@endsection
