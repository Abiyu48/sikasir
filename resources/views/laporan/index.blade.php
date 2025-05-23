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
    :root {
        --primary-color: #667eea;
        --primary-dark: #5a67d8;
        --primary-light: #a3bffa;
        --secondary-color: #4c51bf;
        --success-color: #48bb78;
        --warning-color: #ed8936;
        --danger-color: #f56565;
        --info-color: #2196F3;
        --light-bg: #f7fafc;
        --white: #ffffff;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e0;
        --gray-400: #a0aec0;
        --gray-500: #718096;
        --gray-600: #4a5568;
        --gray-700: #2d3748;
        --gray-800: #1a202c;
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --border-radius: 12px;
        --border-radius-sm: 8px;
    }

    /* Page Header Styles */
    .page-header {
        background: linear-gradient(var(--info-color));
        padding: 2rem;
        border-radius: var(--border-radius);
        color: white;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-lg);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .page-subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .btn-export {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-sm);
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .btn-export:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
    }

    /* Modern Card Styles */
    .modern-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        background: var(--white);
    }

    .modern-card .card-header {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        padding: 1.5rem 2rem;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 0;
        display: flex;
        align-items: center;
    }

    .card-title i {
        color: var(--primary-color);
    }

    /* Search Input */
    .search-input {
        border: 1px solid var(--gray-300);
        border-radius: var(--border-radius-sm) 0 0 var(--border-radius-sm);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-search {
        background: var(--primary-color);
        border: 1px solid var(--primary-color);
        color: white;
        border-radius: 0 var(--border-radius-sm) var(--border-radius-sm) 0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .btn-search:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    /* Table Styles */
    .modern-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background: linear-gradient(var(--info-color));
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 1rem;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modern-table thead th:first-child {
        border-radius: var(--border-radius-sm) 0 0 0;
    }

    .modern-table thead th:last-child {
        border-radius: 0 var(--border-radius-sm) 0 0;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--gray-100);
    }

    .modern-table tbody tr:hover {
        background: var(--gray-50);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .modern-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        border: none;
    }

    /* Customer Info Styles */
    .customer-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(var(--info-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .customer-details {
        display: flex;
        flex-direction: column;
    }

    .customer-name {
        font-weight: 600;
        color: var(--gray-700);
        font-size: 1rem;
    }

    .customer-id {
        font-size: 0.8rem;
        color: var(--gray-500);
    }

    .row-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: var(--gray-100);
        color: var(--gray-600);
        border-radius: 50%;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Badge Styles */
    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: var(--border-radius-sm);
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-primary {
        background: linear-gradient(var(--info-color));
        color: white;
    }

    .badge-secondary {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    /* Sales Amount */
    .total-sales {
        font-weight: 700;
        color: var(--success-color);
        font-size: 1.1rem;
    }

    .phone-number, .address, .last-transaction {
        color: var(--gray-600);
        font-size: 0.95rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: var(--border-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-view {
        background: var(--info-color);
        color: white;
    }

    .btn-view:hover {
        background: #3182ce;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(66, 153, 225, 0.4);
    }

    .btn-edit {
        background: var(--warning-color);
        color: white;
    }

    .btn-edit:hover {
        background: #dd6b20;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(237, 137, 54, 0.4);
    }

    /* Empty State */
    .empty-state {
        padding: 4rem 2rem;
    }

    .empty-illustration {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 1.5rem;
    }

    .empty-state h4 {
        color: var(--gray-600);
        margin-bottom: 0.5rem;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        border-top: 1px solid var(--gray-200);
        background: var(--gray-50);
    }

    .showing-text {
        color: var(--gray-600);
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .modern-card .card-header {
            padding: 1rem;
        }
        
        .pagination-wrapper {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .customer-info {
            flex-direction: column;
            text-align: center;
        }
    }

    /* Animation for loading */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table-row {
        animation: fadeInUp 0.6s ease forwards;
    }

    .table-row:nth-child(even) {
        animation-delay: 0.1s;
    }

    .modern-card {
        animation: fadeInUp 0.8s ease forwards;
    }
</style>
<body>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="page-header mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-chart-line me-2"></i>
                            Laporan Penjualan per Customer
                        </h1>
                        <p class="page-subtitle">Analisis data penjualan berdasarkan customer</p>
                    </div>
                    <div class="page-actions">
                        <button class="btn btn-export">
                            <i class="fas fa-download me-2"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card modern-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-users me-2"></i>
                            Data Customer
                        </h3>
                        <div class="card-tools">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Cari customer...">
                                <button class="btn btn-search" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th>Nama Customer</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Total Transaksi</th>
                                    <th class="text-center">Total Penjualan</th>
                                    <th class="text-center">Transaksi Terakhir</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr class="table-row">
                                    <td class="text-center">
                                        <span class="row-number">
                                            {{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="customer-info">
                                            <div class="customer-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="customer-details">
                                                <strong class="customer-name">{{ $customer->nama }}</strong>
                                                <small class="customer-id text-muted">ID: {{ $customer->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="phone-number">
                                            @if($customer->telepon)
                                                <i class="fas fa-phone me-1"></i>
                                                {{ $customer->telepon }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span class="address" title="{{ $customer->alamat ?? '-' }}">
                                            @if($customer->alamat)
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ Str::limit($customer->alamat, 30) }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">
                                            <i class="fas fa-shopping-cart me-1"></i>
                                            {{ $customer->penjualan_count }} transaksi
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="total-sales">
                                            Rp {{ number_format($customer->penjualan_sum_total ?? 0, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($customer->penjualan->count() > 0)
                                            <span class="last-transaction">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $customer->penjualan->first()->formatted_tanggal }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-clock me-1"></i>
                                                Belum ada transaksi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('laporan.show', $customer->id) }}" 
                                               class="btn btn-action btn-view" 
                                               title="Lihat Detail"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn btn-action btn-edit" 
                                                    title="Edit Customer"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center empty-state">
                                        <div class="empty-illustration">
                                            <i class="fas fa-users-slash"></i>
                                        </div>
                                        <h4>Belum ada data customer</h4>
                                        <p class="text-muted">Customer yang telah melakukan transaksi akan muncul di sini</p>
                                        <button class="btn btn-primary mt-3">
                                            <i class="fas fa-plus me-2"></i>
                                            Tambah Customer
                                        </button>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            <span class="showing-text">
                                Menampilkan {{ $customers->firstItem() ?? 0 }} sampai {{ $customers->lastItem() ?? 0 }} 
                                dari {{ $customers->total() }} customer
                            </span>
                        </div>
                        <div class="pagination-links">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Search functionality
    document.querySelector('.search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.table-row');
        
        rows.forEach(row => {
            const customerName = row.querySelector('.customer-name').textContent.toLowerCase();
            const phone = row.querySelector('.phone-number').textContent.toLowerCase();
            
            if (customerName.includes(searchTerm) || phone.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
@endsection