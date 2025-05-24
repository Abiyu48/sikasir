@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - $penjualan->no_bon </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    :root {
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #4CAF50;
        --warning-color: #FF9800;
        --danger-color: #f44336;
        --info-color: #2196F3;
        --dark-color: #2c3e50;
        --light-color: #f8f9fa;
        --shadow-light: 0 2px 10px rgba(0,0,0,0.1);
        --shadow-medium: 0 4px 20px rgba(0,0,0,0.15);
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .container-fluid {
        padding: 2rem;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(var(--info-color) 100%);
        border-radius: var(--border-radius);
        padding: 2rem;
        color: white;
        box-shadow: var(--shadow-medium);
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .transaction-number {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 1.2rem;
        font-weight: 600;
    }
    .transaction-number i {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .page-subtitle {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    /* Summary Cards */
    .summary-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    .card-header-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        color: var(--dark-color);
        border-bottom: 1px solid #e9ecef;
    }

    .card-header-modern i {
        font-size: 1.2rem;
        color: var(--primary-color);
    }

    .card-content {
        padding: 1.5rem;
    }

    /* Customer Info */
    .customer-info {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .customer-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(var(--info-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .customer-details h4 {
        margin: 0 0 0.5rem 0;
        color: var(--dark-color);
        font-weight: 600;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #666;
    }

    .contact-item i {
        width: 16px;
        color: var(--primary-color);
    }

    /* Transaction Details */
    .transaction-details {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item .label {
        font-weight: 500;
        color: #666;
        font-size: 0.9rem;
    }

    .detail-item .value {
        font-weight: 600;
        color: var(--dark-color);
    }

    .transaction-id {
        background: white;
        color: var(--info-color);
        border: 2px solid var(--info-color);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    /* Badge Modern */
    .badge-modern {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-primary {
        background: linear-gradient(var(--info-color));
        color: white;
    }

    .badge-info {
        background: linear-gradient(135deg, var(--info-color), #21CBF3);
        color: white;
    }

    .badge-secondary {
        background: #e9ecef;
        color: var(--dark-color);
    }

    /* Status Card */
    .status-card .card-content {
        text-align: center;
    }

    .payment-status {
        padding: 1rem 0;
    }

    .status-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .status-indicator i {
        font-size: 3rem;
    }

    .status-indicator span {
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 1px;
    }

    .status-success {
        color: var(--success-color);
    }

    .status-warning {
        color: var(--warning-color);
    }

    .status-secondary {
        color: #6c757d;
    }

    .status-description {
        font-size: 0.9rem;
        color: #666;
        margin: 0;
    }

    /* Items Card */
    .items-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-light);
        overflow: hidden;
    }

    .card-header-items {
        background: linear-gradient(135deg, var(--dark-color) 0%, #34495e 100%);
        color: white;
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-items h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header-items p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .items-count {
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
    }

    .items-content {
        padding: 2rem;
    }

    /* Items Grid */
    .items-grid {
        display: grid;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .item-card {
        background: #f8f9fa;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .item-card:hover {
        background: white;
        border-color: var(--info-color);
        box-shadow: var(--shadow-light);
    }

    .item-number {
        width: 40px;
        height: 40px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
    }

    .item-info {
        flex: 1;
    }

    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .item-name {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-color);
    }

    .item-code {
        background: var(--secondary-color);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .item-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        color: #666;
    }

    .quantity {
        background: var(--info-color);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .subtotal {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--success-color);
    }

    /* Total Section */
    .total-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        border-top: 3px solid var(--primary-color);
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .total-row:last-child {
        border-bottom: none;
    }

    .total-row.grand-total {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--success-color);
        background: white;
        margin: 1rem -1.5rem -1.5rem -1.5rem;
        padding: 1.5rem;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #666;
    }

    .empty-icon {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        padding: 2rem 0;
    }

    .action-buttons .btn {
        padding: 1rem 2rem;
        border-radius: var(--border-radius);
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-print {
        background: linear-gradient(135deg, var(--dark-color), #34495e);
        color: white;
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
    }

    .btn-email {
        background: linear-gradient(135deg, var(--info-color), #1976D2);
        color: white;
    }

    .btn-duplicate {
        background: linear-gradient(135deg, var(--warning-color), #F57C00);
        color: white;
    }

    .action-buttons .btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
    }

    /* Header button styling */
    .header-right .btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid white;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .header-right .btn:hover {
        background: white;
        color: var(--info-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-light);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .page-title {
            font-size: 1.5rem;
            flex-direction: column;
        }

        .transaction-number {
            font-size: 1rem;
        }

        .items-grid {
            grid-template-columns: 1fr;
        }

        .item-card {
            flex-direction: column;
            text-align: center;
        }

        .item-header {
            flex-direction: column;
            gap: 0.5rem;
        }

        .item-details {
            flex-direction: column;
            gap: 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            justify-content: center;
        }
    }
</style>
<body>
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header">
                <div class="header-content">
                    <div class="header-left">
                        <h2 class="page-title">
                            <i class="fas fa-receipt"></i>
                            Detail Transaksi
                            <span class="transaction-number">#{{ $penjualan->no_bon }}</span>
                        </h2>
                        <p class="page-subtitle">Informasi lengkap transaksi dan detail pembelian</p>
                    </div>
                    <div class="header-right">
                        <a href="{{ route('laporan.show', $penjualan->customer_id) }}" class="btn">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Transaction Summary Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="summary-card">
                <div class="card-header-modern">
                    <i class="fas fa-user-circle"></i>
                    <span>Informasi Customer</span>
                </div>
                <div class="card-content">
                    <div class="customer-info">
                        <div class="customer-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="customer-details">
                            <h4>{{ $penjualan->customer->nama }}</h4>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $penjualan->customer->telepon ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $penjualan->customer->alamat ?? 'Alamat tidak tersedia' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Details Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="summary-card">
                <div class="card-header-modern">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Detail Transaksi</span>
                </div>
                <div class="card-content">
                    <div class="transaction-details">
                        <div class="detail-item">
                            <span class="label">Nomor Transaksi</span>
                            <span class="value transaction-id">{{ $penjualan->no_bon }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Tanggal & Waktu</span>
                            <span class="value">{{ $penjualan->formatted_tanggal ?? date('d M Y, H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Kasir</span>
                            <span class="value">{{ $penjualan->user->name ?? 'Administrator' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Tipe Order</span>
                            <span class="value">
                                @if($penjualan->order_type == 'dine_in')
                                    <span class="badge badge-modern badge-primary">
                                        <i class="fas fa-utensils"></i> Dine In
                                    </span>
                                @elseif($penjualan->order_type == 'takeaway')
                                    <span class="badge badge-modern badge-info">
                                        <i class="fas fa-shopping-bag"></i> Take Away
                                    </span>
                                @else
                                    <span class="badge badge-modern badge-secondary">{{ ucfirst($penjualan->order_type) }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Card -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="summary-card status-card">
                <div class="card-header-modern">
                    <i class="fas fa-credit-card"></i>
                    <span>Status Pembayaran</span>
                </div>
                <div class="card-content">
                    <div class="payment-status">
                        @if($penjualan->status_pembayaran == 'cash')
                            <div class="status-indicator status-success">
                                <i class="fas fa-check-circle"></i>
                                <span>LUNAS</span>
                            </div>
                            <p class="status-description">Pembayaran telah diterima dengan lengkap</p>
                        @elseif($penjualan->status_pembayaran == 'belum_lunas')
                            <div class="status-indicator status-warning">
                                <i class="fas fa-clock"></i>
                                <span>BELUM LUNAS</span>
                            </div>
                            <p class="status-description">Menunggu pembayaran dari customer</p>
                        @else
                            <div class="status-indicator status-secondary">
                                <i class="fas fa-question-circle"></i>
                                <span>{{ strtoupper($penjualan->status_pembayaran) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Details -->
    <div class="row">
        <div class="col-12">
            <div class="items-card">
                <div class="card-header-items">
                    <div class="header-left">
                        <h3><i class="fas fa-list-ul"></i> Detail Pembelian</h3>
                        <p>Daftar item yang dibeli dalam transaksi ini</p>
                    </div>
                    <div class="header-right">
                        <div class="items-summary">
                            <span class="items-count">{{ $penjualan->details->count() }} Item</span>
                        </div>
                    </div>
                </div>

                @if($penjualan->details->count() > 0)
                <div class="items-content">
                    <div class="items-grid">
                        @foreach($penjualan->details as $index => $detail)
                        <div class="item-card">
                            <div class="item-number">{{ $index + 1 }}</div>
                            <div class="item-info">
                                <div class="item-header">
                                    <h4 class="item-name">{{ $detail->menu->nama ?? 'Menu tidak ditemukan' }}</h4>
                                    @if($detail->menu && $detail->menu->kode)
                                        <span class="item-code">{{ $detail->menu->kode }}</span>
                                    @endif
                                </div>
                                <div class="item-details">
                                    <div class="price-info">
                                        <span class="unit-price">Rp {{ number_format($detail->harga, 0, ',', '.') }}</span>
                                        <span class="multiply">×</span>
                                        <span class="quantity">{{ $detail->jumlah }}</span>
                                    </div>
                                    <div class="subtotal">
                                        Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Total Section -->
                    <div class="total-section">
                        <div class="total-row">
                            <span class="total-label">Total Item</span>
                            <span class="total-value">{{ $penjualan->details->sum('jumlah') }} Pcs</span>
                        </div>
                        <div class="total-row">
                            <span class="total-label">Subtotal</span>
                            <span class="total-value">{{ $penjualan->formatted_total ?? 'Rp ' . number_format($penjualan->details->sum(function($detail) { return $detail->jumlah * $detail->harga; }), 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row grand-total">
                            <span class="total-label">Grand Total</span>
                            <span class="total-value">{{ $penjualan->formatted_total ?? 'Rp ' . number_format($penjualan->details->sum(function($detail) { return $detail->jumlah * $detail->harga; }), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h4>Tidak Ada Item</h4>
                    <p>Belum ada item yang ditambahkan ke transaksi ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="action-buttons">
                <button class="btn btn-print" onclick="window.print()">
                    <i class="fas fa-print"></i>
                    <span>Cetak Struk</span>
                </button>
                <button class="btn btn-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    <span>Kirim via WhatsApp</span>
                </button>
                <button class="btn btn-email">
                    <i class="fas fa-envelope"></i>
                    <span>Kirim Email</span>
                </button>
                <button class="btn btn-duplicate">
                    <i class="fas fa-copy"></i>
                    <span>Duplikat Transaksi</span>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection