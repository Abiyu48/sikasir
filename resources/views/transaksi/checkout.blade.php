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
  --primary-color: #2563eb;
  --primary-hover: #1d4ed8;
  --success-color: #059669;
  --danger-color: #dc2626;
  --warning-color: #d97706;
  --gray-50: #f9fafb;
  --gray-100: #f3f4f6;
  --gray-200: #e5e7eb;
  --gray-300: #d1d5db;
  --gray-400: #9ca3af;
  --gray-500: #6b7280;
  --gray-600: #4b5563;
  --gray-700: #374151;
  --gray-800: #1f2937;
  --gray-900: #111827;
  --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
  --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

.checkout-container {
  min-height: 100vh;
  background: white;
  position: relative;
}

.checkout-header {
  position: relative;
  z-index: 1;
}

.checkout-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--gray-800);
  margin: 0;
  text-shadow: none;
}

.checkout-subtitle {
  color: var(--gray-600);
  font-size: 1.1rem;
  margin: 0.5rem 0 0 0;
}

.checkout-badge {
  background: var(--gray-100);
  border: 1px solid var(--gray-300);
  border-radius: 2rem;
  padding: 0.75rem 1.5rem;
  color: var(--gray-700);
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.info-card, .order-card {
  background: white;
  border-radius: 1.5rem;
  box-shadow: var(--shadow-xl);
  border: 1px solid var(--gray-200);
  overflow: hidden;
  position: relative;
  z-index: 1;
}

.info-card-header, .order-card-header {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
  color: white;
  padding: 1.5rem;
  font-weight: 600;
  display: flex;
  justify-content: between;
  align-items: center;
}

.item-count {
  background: rgba(255,255,255,0.2);
  padding: 0.25rem 0.75rem;
  border-radius: 1rem;
  font-size: 0.875rem;
}

.info-card-body {
  padding: 1.5rem;
}

.info-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1rem 0;
  border-bottom: 1px solid var(--gray-100);
}

.info-item:last-child {
  border-bottom: none;
}

.info-icon {
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
  border-radius: 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1rem;
  flex-shrink: 0;
}

.info-content label {
  font-size: 0.875rem;
  color: var(--gray-500);
  font-weight: 500;
  margin: 0 0 0.25rem 0;
  display: block;
}

.info-content p {
  font-weight: 600;
  color: var(--gray-800);
  margin: 0;
  font-size: 1rem;
}

.payment-status {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border-radius: 0.75rem;
  font-weight: 600;
  font-size: 0.875rem;
}

.payment-status.cash {
  background: #dcfdf4;
  color: var(--success-color);
}

.payment-status.card {
  background: #dbeafe;
  color: var(--primary-color);
}

.order-items {
  padding: 1.5rem;
}

.order-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 1.5rem;
  margin-bottom: 1rem;
  background: var(--gray-50);
  border-radius: 1rem;
  border: 1px solid var(--gray-200);
  transition: all 0.3s ease;
}

.order-item:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
  border-color: var(--primary-color);
}

.item-info {
  display: flex;
  gap: 1rem;
  flex: 1;
}

.item-image {
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
  border-radius: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.25rem;
  flex-shrink: 0;
}

.item-details {
  flex: 1;
}

.item-name {
  font-weight: 600;
  color: var(--gray-800);
  margin: 0 0 0.25rem 0;
  font-size: 1.1rem;
}

.item-note {
  color: var(--gray-500);
  font-size: 0.875rem;
  margin: 0 0 0.5rem 0;
  font-style: italic;
}

.item-meta {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.quantity {
  background: var(--primary-color);
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 0.5rem;
  font-size: 0.875rem;
  font-weight: 500;
}

.unit-price {
  color: var(--gray-500);
  font-size: 0.875rem;
}

.item-pricing {
  text-align: right;
  flex-shrink: 0;
}

.tax {
  color: var(--gray-500);
  font-size: 0.75rem;
  margin-bottom: 0.25rem;
}

.total-price {
  font-weight: 700;
  color: var(--primary-color);
  font-size: 1.1rem;
}

.grand-total {
  background: linear-gradient(135deg, var(--gray-50), white);
  border-top: 2px solid var(--gray-200);
  padding: 1.5rem;
  margin-top: 1rem;
}

.total-breakdown {
  margin-bottom: 1rem;
}

.subtotal-line, .tax-line {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
  color: var(--gray-600);
  font-size: 0.95rem;
}

.final-total {
  display: flex;
  justify-content: space-between;
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--primary-color);
  padding-top: 1rem;
  border-top: 2px solid var(--primary-color);
}

.action-section {
  margin-top: 2rem;
  padding: 1.5rem;
  background: white;
  border-radius: 1.5rem;
  box-shadow: var(--shadow-lg);
}

.secondary-actions {
  display: flex;
  gap: 1rem;
}

.btn-secondary, .btn-danger, .btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: 600;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 1rem;
  position: relative;
  overflow: hidden;
}

.btn-secondary {
  background: var(--gray-100);
  color: var(--gray-700);
  border: 1px solid var(--gray-300);
}

.btn-secondary:hover {
  background: var(--gray-200);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
  color: var(--gray-800);
}

.btn-danger {
  background: var(--danger-color);
  color: white;
}

.btn-danger:hover {
  background: #b91c1c;
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
  color: white;
}

.btn-primary {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
  color: white;
  font-size: 1.1rem;
  padding: 1rem 2rem;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
  filter: brightness(1.1);
}

.btn-primary:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

.empty-cart {
  background: white;
  border-radius: 1.5rem;
  padding: 4rem 2rem;
  text-align: center;
  box-shadow: var(--shadow-xl);
}

.empty-icon {
  font-size: 4rem;
  color: var(--gray-400);
  margin-bottom: 1.5rem;
}

.empty-cart h4 {
  color: var(--gray-700);
  margin-bottom: 1rem;
}

.empty-cart p {
  color: var(--gray-500);
  margin-bottom: 2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .checkout-title {
    font-size: 2rem;
  }
  
  .order-item {
    flex-direction: column;
    gap: 1rem;
  }
  
  .item-pricing {
    text-align: left;
    width: 100%;
  }
  
  .action-section .d-flex {
    flex-direction: column;
  }
  
  .secondary-actions {
    order: 2;
    justify-content: center;
  }
  
  .primary-action {
    order: 1;
    text-align: center;
  }
}

/* Animation */
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

.info-card, .order-card, .action-section {
  animation: fadeInUp 0.6s ease-out;
}

.order-item {
  animation: fadeInUp 0.6s ease-out;
}

/* Loading animation */
@keyframes spin {
  to { transform: rotate(360deg); }
}

.fa-spin {
  animation: spin 1s linear infinite;
}
</style>
<body>
  <div class="checkout-container">
  <div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
        <!-- Header Section -->
        <div class="checkout-header mb-5">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="checkout-title">
                <i class="fas fa-shopping-bag me-3"></i>
                Checkout Pesanan
              </h1>
              <p class="checkout-subtitle">Periksa kembali pesanan Anda sebelum konfirmasi</p>
            </div>
            <div class="col-md-4 text-md-end">
              <div class="checkout-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Transaksi Aman</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <!-- Transaction Info Card -->
          <div class="col-lg-4">
            <div class="info-card">
              <div class="info-card-header">
                <h5><i class="fas fa-info-circle me-2"></i>Informasi Transaksi</h5>
              </div>
              <div class="info-card-body">
                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-user"></i>
                  </div>
                  <div class="info-content">
                    <label>Nama Kasir</label>
                    <p>{{ $nama_customer ?? 'Guest' }}</p>
                  </div>
                </div>
                
                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                  <div class="info-content">
                    <label>Tanggal & Waktu</label>
                    <p>{{ $tanggal ?? date('d-m-Y H:i:s') }}</p>
                  </div>
                </div>
                
                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-receipt"></i>
                  </div>
                  <div class="info-content">
                    <label>No. Bon</label>
                    <p>{{ $no_bon ?? 'TRX-' . date('YmdHis') }}</p>
                  </div>
                </div>
                
                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-credit-card"></i>
                  </div>
                  <div class="info-content">
                    <label>Status Pembayaran</label>
                    <div class="payment-status {{ $metode_pembayaran === 'cash' ? 'cash' : 'card' }}">
                      <i class="fas fa-{{ $metode_pembayaran === 'cash' ? 'money-bill-wave' : 'credit-card' }}"></i>
                      {{ ucfirst($metode_pembayaran ?? 'Belum Ditentukan') }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Order Items Card -->
          <div class="col-lg-8">
            @if(isset($keranjang) && count($keranjang) > 0)
            <div class="order-card">
              <div class="order-card-header">
                <h5><i class="fas fa-list-ul me-2"></i>Detail Pesanan</h5>
                <span class="item-count">{{ count($keranjang) }} Item</span>
              </div>
              
              <div class="order-items">
                @php $grandTotal = 0; @endphp
                @foreach($keranjang as $index => $item)
                  @php 
                    $harga = $item['harga'] ?? 0;
                    $jumlah = $item['jumlah'] ?? 1;
                    $pajak = $harga * 0.1;
                    $total = ($harga + $pajak) * $jumlah;
                    $grandTotal += $total;
                  @endphp
                  <div class="order-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="item-info">
                      <div class="item-image">
                        <i class="fas fa-utensils"></i>
                      </div>
                      <div class="item-details">
                        <h6 class="item-name">{{ $item['nama'] ?? 'Menu Tidak Diketahui' }}</h6>
                        @if(isset($item['keterangan']) && !empty($item['keterangan']))
                          <p class="item-note">{{ $item['keterangan'] }}</p>
                        @endif
                        <div class="item-meta">
                          <span class="quantity">
                            <i class="fas fa-times"></i> {{ $jumlah }}
                          </span>
                          <span class="unit-price">Rp {{ number_format($harga, 0, ',', '.') }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="item-pricing">
                      <div class="tax">
                        <small>Pajak (10%): Rp {{ number_format($pajak, 0, ',', '.') }}</small>
                      </div>
                      <div class="total-price">
                        Rp {{ number_format($total, 0, ',', '.') }}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              
              <!-- Grand Total -->
              <div class="grand-total">
                <div class="total-breakdown">
                  <div class="subtotal-line">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($grandTotal / 1.1, 0, ',', '.') }}</span>
                  </div>
                  <div class="tax-line">
                    <span>Pajak (10%)</span>
                    <span>Rp {{ number_format($grandTotal - ($grandTotal / 1.1), 0, ',', '.') }}</span>
                  </div>
                </div>
                <div class="final-total">
                  <span>Total Pembayaran</span>
                  <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-section">
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="secondary-actions">
                  <a href="{{ route('transaksi.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                  </a>
                  <a href="{{ route('checkout.batal') }}" class="btn-danger">
                    <i class="fas fa-times"></i>
                    <span>Batalkan</span>
                  </a>
                </div>
                <div class="primary-action">
                  <form action="{{ route('checkout.konfirmasi') }}" method="POST" id="checkoutForm">
                    @csrf
                    <button type="submit" class="btn-primary" id="submitBtn">
                      <span class="btn-text">
                        <i class="fas fa-check"></i>
                        Konfirmasi Pesanan
                      </span>
                      <span class="btn-loading" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i>
                        Memproses...
                      </span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
            @else
            <!-- Empty Cart -->
            <div class="empty-cart">
              <div class="empty-icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <h4>Keranjang Kosong</h4>
              <p>Belum ada item yang ditambahkan ke keranjang.</p>
              <a href="{{ route('transaksi.index') }}" class="btn-primary">
                <i class="fas fa-plus"></i>
                <span>Tambah Item</span>
              </a>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('checkoutForm');
  const submitBtn = document.getElementById('submitBtn');
  const btnText = submitBtn.querySelector('.btn-text');
  const btnLoading = submitBtn.querySelector('.btn-loading');
  
  if (form && submitBtn) {
    form.addEventListener('submit', function(e) {
      // Disable button and show loading state
      submitBtn.disabled = true;
      btnText.style.display = 'none';
      btnLoading.style.display = 'flex';
      
      // Re-enable button after 10 seconds as fallback
      setTimeout(function() {
        submitBtn.disabled = false;
        btnText.style.display = 'flex';
        btnLoading.style.display = 'none';
      }, 10000);
    });
  }
  
  // Add smooth scrolling for better UX
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
  
  // Add hover effects to order items
  document.querySelectorAll('.order-item').forEach(item => {
    item.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-4px)';
    });
    
    item.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
});
</script>
</body>
</html>
@endsection