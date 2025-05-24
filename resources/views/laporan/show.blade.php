@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    /* Modern Color Palette */
    :root {
        --primary-blue: #4A90E2;
        --success-green: #7ED321;
        --warning-orange: #F5A623;
        --danger-red: #D0021B;
        --purple: #9013FE;
        --dark-blue: #2C3E50;
        --light-blue: #E3F2FD;
        --shadow: 0 4px 20px rgba(0,0,0,0.1);
        --shadow-hover: 0 8px 30px rgba(0,0,0,0.15);
    }

    body {
        min-height: 100vh;
    }

    /* Modern Header Card */
    .modern-header-card {
        background: linear-gradient(var(--primary-blue));
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow);
        color: white;
    }

    .customer-avatar {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .customer-name {
        color: white;
        font-weight: 700;
        font-size: 28px;
    }

    .customer-subtitle {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
    }

    .btn-modern-back {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-modern-back:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        transform: translateY(-2px);
    }

    /* Info Cards */
    .info-card {
        border-radius: 20px;
        border: none;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 120px;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .info-card-blue { background: linear-gradient(135deg, #4A90E2, #357ABD); }
    .info-card-green { background: linear-gradient(135deg, #7ED321, #5BA515); }
    .info-card-orange { background: linear-gradient(135deg, #F5A623, #E8940F); }
    .info-card-purple { background: linear-gradient(135deg, #9013FE, #7B1FA2); }

    .info-card-body {
        padding: 20px;
        color: white;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .info-content {
        margin-left: 15px;
    }

    .info-content h6 {
        font-size: 12px;
        margin-bottom: 5px;
        opacity: 0.8;
        font-weight: 500;
    }

    .info-content h4 {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    /* Modern Cards */
    .modern-card {
        border-radius: 20px;
        border: none;
        box-shadow: var(--shadow);
        background: white;
    }

    .modern-card-header {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-bottom: none;
        border-radius: 20px 20px 0 0 !important;
        padding: 25px 30px;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-blue), #357ABD);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    /* Address Card */
    .address-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--danger-red), #B71C1C);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    .address-text {
        font-size: 16px;
        color: #333;
        font-weight: 500;
    }

    /* Modern Table */
    .modern-table {
        background: white;
    }

    .modern-table thead th {
        background: linear-gradient( #667eea);
        color: white;
        border: none;
        padding: 20px 15px;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
    }

    .modern-table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
        text-align: center;
    }

    .transaction-row {
        transition: all 0.3s ease;
    }

    .transaction-row:hover {
        background: linear-gradient(135deg, #f8f9ff, #f0f4ff);
        transform: scale(1.01);
    }

    .transaction-id strong {
        color: var(--primary-blue);
        font-weight: 700;
    }

    .transaction-date {
        color: #666;
        font-size: 14px;
    }

    .transaction-total {
        color: var(--success-green);
        font-weight: 700;
        font-size: 16px;
    }

    /* Modern Badges */
    .modern-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-success {
        background: linear-gradient(135deg, #7ED321, #5BA515);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #F5A623, #E8940F);
        color: white;
    }

    .badge-primary {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        color: white;
    }

    .badge-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .badge-secondary {
        background: linear-gradient(135deg, #6c757d, #5a6268);
        color: white;
    }

    .kasir-info {
        color: #666;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    /* Action Button - Fixed for proper display */
    .btn-modern-action {
        background: linear-gradient(var(--primary-blue));
        border: none;
        color: white;
        border-radius: 25px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-modern-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.4);
        color: white;
        text-decoration: none;
    }

    /* Transaction Summary */
    .transaction-summary {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 25px 30px;
        border-radius: 0 0 20px 20px;
    }

    .total-amount {
        color: var(--success-green);
        font-weight: 700;
        font-size: 24px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e9ecef, #dee2e6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        color: #6c757d;
        margin: 0 auto 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .customer-name {
            font-size: 22px;
        }
        
        .info-card {
            height: auto;
            margin-bottom: 15px;
        }
        
        .info-card-body {
            padding: 15px;
        }
        
        .modern-table {
            font-size: 12px;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 10px 8px;
        }
    }
</style>
<body>
    <div class="container-fluid">
    <!-- Modern Header with Gradient -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card modern-header-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="customer-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="customer-name mb-1">{{ $customer->nama }}</h2>
                                <p class="customer-subtitle mb-0">Detail Informasi Customer</p>
                            </div>
                        </div>
                        <a href="{{ route('laporan.index') }}" class="btn btn-modern-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Info Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card info-card-blue">
                <div class="info-card-body">
                    <div class="info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-content">
                        <h6>Nama Customer</h6>
                        <h4>{{ $customer->nama }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card info-card-green">
                <div class="info-card-body">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-content">
                        <h6>Telepon</h6>
                        <h4>{{ $customer->telepon ?? '-' }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card info-card-orange">
                <div class="info-card-body">
                    <div class="info-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="info-content">
                        <h6>Total Transaksi</h6>
                        <h4>{{ $customer->penjualan->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card info-card-purple">
                <div class="info-card-body">
                    <div class="info-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="info-content">
                        <h6>Total Penjualan</h6>
                        <h4>Rp {{ number_format($customer->penjualan->sum('total'), 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($customer->alamat)
    <!-- Address Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="address-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ml-3">
                            <h6 class="mb-1 text-muted">Alamat Customer</h6>
                            <p class="mb-0 address-text">{{ $customer->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Transaction History -->
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header modern-card-header">
                    <div class="d-flex align-items-center">
                        <div class="header-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="mb-0">Riwayat Transaksi</h4>
                            <p class="mb-0 text-muted">Daftar semua transaksi customer</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($customer->penjualan->count() > 0)
                    <div class="table-responsive">
                        <table class="table modern-table mb-0">
                            <thead>
                                <tr>
                                    <th>No. Bon</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Kasir</th>
                                    <th>Tipe Order</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->penjualan as $penjualan)
                                <tr class="transaction-row">
                                    <td>
                                        <div class="transaction-id">
                                            <strong>{{ $penjualan->no_bon }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="transaction-date">
                                            {{ $penjualan->formatted_tanggal }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="transaction-total">
                                            {{ $penjualan->formatted_total }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($penjualan->status_pembayaran == 'lunas')
                                            <span class="modern-badge badge-success">
                                                <i class="fas fa-check-circle"></i> Lunas
                                            </span>
                                        @elseif($penjualan->status_pembayaran == 'belum_lunas')
                                            <span class="modern-badge badge-warning">
                                                <i class="fas fa-clock"></i> Belum Lunas
                                            </span>
                                        @else
                                            <span class="modern-badge badge-secondary">
                                                {{ ucfirst($penjualan->status_pembayaran) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="kasir-info">
                                            <i class="fas fa-user-tie"></i>
                                            {{ $penjualan->user->name ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($penjualan->order_type == 'dine_in')
                                            <span class="modern-badge badge-primary">
                                                <i class="fas fa-utensils"></i> Dine In
                                            </span>
                                        @elseif($penjualan->order_type == 'takeaway')
                                            <span class="modern-badge badge-info">
                                                <i class="fas fa-shopping-bag"></i> Take Away
                                            </span>
                                        @else
                                            <span class="modern-badge badge-secondary">
                                                {{ ucfirst($penjualan->order_type) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('laporan.detail', $penjualan->id) }}" 
                                           class="btn btn-modern-action"
                                           title="Lihat Detail Transaksi">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Total Summary -->
                    <div class="transaction-summary">
                        <div class="summary-content">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="mb-0">Total Keseluruhan Transaksi</h5>
                                    <p class="mb-0 text-muted">{{ $customer->penjualan->count() }} transaksi berhasil</p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h3 class="total-amount mb-0">
                                        Rp {{ number_format($customer->penjualan->sum('total'), 0, ',', '.') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h5>Belum Ada Transaksi</h5>
                        <p class="text-muted">Customer ini belum melakukan transaksi apapun</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection