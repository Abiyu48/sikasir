@extends('layouts.app')

@section('content')
<style>
  .card-menu {
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  .card-menu img {
    height: 150px;
    object-fit: cover;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
  }
  .card-menu .card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .card-menu .menu-name {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .card-menu .card-body small {
    color: #666;
  }
  .card-menu .btn-add-cart {
    margin-top: auto;
  }
  .keranjang-panel, .menu-panel {
    max-height: 85vh;
    overflow-y: auto;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
  }
  .menu-panel {
    background: #ffffff;
  }
  .table-sm td, .table-sm th {
    font-size: 0.85rem;
    padding: 6px;
  }
  .stock-habis {
    color: #dc3545;
    font-weight: bold;
  }
  .card-disabled {
    opacity: 0.6;
    position: relative;
  }
  .card-disabled::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    z-index: 1;
    border-radius: 0.5rem;
  }

  .form-control::-webkit-outer-spin-button,
  .form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  /* Style untuk field yang required */
  .form-select.is-invalid {
    border-color: #dc3545;
  }
  
  .invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
  }

  /* New styles for checkout section */
  .checkout-header {
    background: #e8f4fd;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-weight: 600;
    color: #2c5282;
  }

  .keranjang-table {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .keranjang-table .table {
    margin-bottom: 0;
  }

  .keranjang-table .table thead th {
    background: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 12px 8px;
  }

  .keranjang-table .table tbody td {
    padding: 10px 8px;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.85rem;
  }

  .customer-section {
    background: white;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .total-section {
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #e9ecef;
  }

  .total-row:last-child {
    border-bottom: none;
    font-weight: 600;
    font-size: 1.1rem;
    color: #2c5282;
  }

  .btn-checkout {
    background: #10b981;
    border: none;
    padding: 12px;
    font-weight: 600;
    border-radius: 8px;
    margin-top: 15px;
  }

  .btn-checkout:hover {
    background: #059669;
  }

  .quantity-controls {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .quantity-controls .btn {
    width: 25px;
    height: 25px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
  }

  .quantity-controls input {
    width: 40px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 2px;
  }

  .voucher-section {
    display: none; /* Hidden as per requirement */
  }

  /* Category Cards Styles */
/* Updated Category Cards Styles - No Icons */
.category-section {
  background: white;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 20px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.category-cards {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  padding-bottom: 10px;
  margin-bottom: 20px;
}

.category-card {
  min-width: 100px;
  padding: 12px 16px;
  border-radius: 25px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 1px solid #e0e0e0;
  background: #f8f9fa;
  color: #6c757d;
  font-weight: 500;
  font-size: 0.85rem;
  white-space: nowrap;
  position: relative;
  overflow: hidden;
}

.category-card:hover {
  background: white;
  color: #495057;
  border-color: #dee2e6;
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.category-card.active {
  background: #2196F3;
  color: white;
  border-color: #2196F3;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
}

.category-card .category-name {
  font-weight: 500;
  font-size: 0.85rem;
  margin: 0 0 4px 0;
}

.category-card .category-count {
  font-size: 0.75rem;
  opacity: 0.8;
  margin: 0;
}

/* All Categories Card - special styling */
.category-card.all-categories {
  background: #f8f9fa;
  color: #6c757d;
  border: 1px solid #e0e0e0;
}

.category-card.all-categories:hover {
  background: white;
  color: #495057;
  border-color: #dee2e6;
}

.category-card.all-categories.active {
  background: #2196F3;
  color: white;
  border-color: #2196F3;
}
</style>

<div class="container-fluid mt-4">
  <div class="row g-4">
    <!-- Data Menu -->
    <div class="col-md-8">
      <div class="menu-panel shadow">
        <h5 class="mb-3">Data Menu</h5>

        <!-- Category Cards Section -->
        <div class="category-section">
          <h6 class="mb-3">Pilih Kategori</h6>
          <div class="category-cards">
            <!-- All Categories Card -->
            <div class="category-card all-categories active" data-kategori-id="">
              <div class="category-name">Semua</div>
              <div class="category-count">{{ $menu->count() }} item</div>
            </div>

            <!-- Dynamic Category Cards -->
            @foreach($kategori as $kat)
              @php
                $menuCount = $menu->where('kategori_id', $kat->id)->count();
              @endphp
              <div class="category-card" data-kategori-id="{{ $kat->id }}">
                <div class="category-name">{{ $kat->nama }}</div>
                <div class="category-count">{{ $menuCount }} item</div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Search Section -->
        <div class="row mb-3">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
              <input type="text" id="searchMenu" class="form-control" placeholder="Cari menu berdasarkan nama...">
            </div>
          </div>
        </div>

        <!-- Daftar Menu -->
        <div class="row" id="menuList">
          @foreach($menu as $item)
            <div class="col-md-4 mb-3 menu-item" data-kategori-id="{{ $item->kategori->id ?? '' }}">
              <div class="card card-menu shadow-sm {{ $item->stok == 0 ? 'card-disabled' : '' }}">
                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_menu }}">
                <div class="card-body">
                  <h6 class="menu-name">{{ $item->nama }}</h6>
                  <p class="mb-1">
                    <small>Kategori: {{ $item->kategori->nama  ?? '-' }}</small><br>
                    <small>Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}</small><br>
                    <small>Stok: 
                      @if($item->stok == 0)
                        <span class="stock-habis">STOK HABIS</span>
                      @else
                        <span class="stok">{{ $item->stok }}</span>
                      @endif
                    </small>
                  </p>
                  @if($item->stok > 0)
                    <button class="btn btn-success btn-sm btn-add-cart w-100"
                      data-id="{{ $item->id }}"
                      data-nama="{{ $item->nama}}"
                      data-harga="{{ $item->harga }}"
                      data-stok="{{ $item->stok }}">Tambah ke Keranjang</button>
                  @else
                    <div class="text-center mt-3">
                      <button class="btn btn-secondary btn-sm w-100" disabled>Stok Habis</button>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Keranjang -->
    <div class="col-md-4">
      <div class="keranjang-panel shadow">
        <div class="checkout-header">
          <i class="fas fa-receipt me-2"></i>Nama Pelanggan ✏️
        </div>

        <form action="{{ route('transaksi.simpan') }}" method="POST" onsubmit="return submitKeranjang(event)">
          @csrf
          
          <!-- Customer Selection -->
          <div class="customer-section">
            <label class="form-label mb-2">Pilih Kasir <span class="text-danger">*</span></label>
            <select name="customer_id" id="customerSelect" class="form-select" required>
              <option value="">Pilih Kasir</option>
              @foreach($customers as $cust)
                <option value="{{ $cust->id }}">{{ $cust->nama }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback" id="customerError"></div>

          <!-- Cart Items -->
          <div class="keranjang-table">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 50%">Item</th>
                  <th style="width: 15%">Qty</th>
                  <th style="width: 25%">Harga</th>
                  <th style="width: 10%"></th>
                </tr>
              </thead>
              <tbody id="keranjangList">
                <!-- Cart items will be populated here -->
              </tbody>
            </table>
          </div>

          <!-- Order Details -->
          <div class="customer-section mt-3">
            <div class="row">
              <div class="col-6">
                <label class="form-label mb-2">Pembayaran</label>
                <select name="status_pembayaran" class="form-select form-select-sm">
                  <option value="cash">Cash</option>
                  <option value="cashless">Cashless</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label mb-2">Order Type</label>
                <select name="order_type" class="form-select form-select-sm">
                  <option value="dine_in">Dine In</option>
                  <option value="take_away">Take Away</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Total Section -->
          <div class="total-section">
            <div class="total-row">
              <span>Subtotal</span>
              <span id="subtotalDisplay">Rp 0</span>
            </div>
            <div class="total-row">
              <span>Tax (10%)</span>
              <span id="taxDisplay">Rp 0</span>
            </div>
            <div class="total-row">
              <span>Total</span>
              <span id="totalDisplay">Rp 0</span>
            </div>
          </div>

          <!-- Hidden Inputs -->
          <input type="hidden" name="no_bon" value="{{ $newNoBon }}">
          <input type="hidden" name="keranjang" id="inputKeranjang">
          
          <button type="submit" class="btn btn-success btn-checkout w-100">
            <i class="fas fa-check me-2"></i>Proses Pesanan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let keranjang = [];

  // Fungsi untuk menghilangkan pesan error
  function clearFieldError(fieldId, errorId) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(errorId);
    
    field.classList.remove('is-invalid');
    errorDiv.textContent = '';
  }

  // Fungsi untuk menampilkan pesan error
  function showFieldError(fieldId, errorId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(errorId);
    
    field.classList.add('is-invalid');
    errorDiv.textContent = message;
  }

  // Event listener untuk customer select
  document.getElementById('customerSelect').addEventListener('change', function() {
    if (this.value !== '') {
      clearFieldError('customerSelect', 'customerError');
    }
  });

  function updateStokDisplay(menuId, newStok) {
    const cardElement = document.querySelector(`[data-id="${menuId}"]`).closest('.card-menu');
    const stokElement = cardElement.querySelector('.stok');
    const btnAddCart = cardElement.querySelector('.btn-add-cart');
    
    if (newStok <= 0) {
      // Jika stok habis
      if (stokElement) {
        stokElement.innerHTML = '<span class="stock-habis">STOK HABIS</span>';
        stokElement.className = '';
      } else {
        // Jika elemen stok belum ada, buat elemen baru
        const stokContainer = cardElement.querySelector('small:last-of-type');
        stokContainer.innerHTML = 'Stok: <span class="stock-habis">STOK HABIS</span>';
      }
      
      // Disable dan sembunyikan tombol
      if (btnAddCart) {
        btnAddCart.style.display = 'none';
        // Buat tombol disabled jika belum ada
        if (!cardElement.querySelector('.btn-disabled-stock')) {
          const disabledBtn = document.createElement('button');
          disabledBtn.className = 'btn btn-secondary btn-sm w-100 btn-disabled-stock';
          disabledBtn.disabled = true;
          disabledBtn.textContent = 'Stok Habis';
          btnAddCart.parentNode.appendChild(disabledBtn);
        }
      }
      
      // Tambahkan class disabled ke card
      cardElement.classList.add('card-disabled');
    } else {
      // Jika masih ada stok
      if (stokElement) {
        stokElement.textContent = newStok;
        stokElement.className = 'stok';
      } else {
        // Update elemen stok
        const stokContainer = cardElement.querySelector('small:last-of-type');
        stokContainer.innerHTML = `Stok: <span class="stok">${newStok}</span>`;
      }
      
      // Show tombol jika sebelumnya hidden
      if (btnAddCart) btnAddCart.style.display = 'block';
      
      // Hapus tombol disabled jika ada
      const disabledBtn = cardElement.querySelector('.btn-disabled-stock');
      if (disabledBtn) disabledBtn.remove();
      
      // Hapus class disabled dari card
      cardElement.classList.remove('card-disabled');
    }
  }

  function renderKeranjang() {
    const tbody = document.getElementById('keranjangList');
    tbody.innerHTML = '';
    
    if (keranjang.length === 0) {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td colspan="4" class="text-center text-muted py-4">
          <i class="fas fa-shopping-cart fa-2x mb-2 d-block"></i>
          Keranjang masih kosong
        </td>
      `;
      tbody.appendChild(row);
    } else {
      keranjang.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>
            <div class="fw-semibold">${item.nama}</div>
            <small class="text-muted">Rp ${item.harga.toLocaleString()}</small>
          </td>
          <td>
            <div class="quantity-controls">
              <button type="button" class="btn btn-outline-secondary btn-sm btn-qty-minus" data-id="${item.id}">-</button>
              <input type="number" class="qty-display" value="${item.jumlah}" readonly>
              <button type="button" class="btn btn-outline-secondary btn-sm btn-qty-plus" data-id="${item.id}">+</button>
            </div>
          </td>
          <td class="fw-semibold">Rp ${(item.harga * item.jumlah).toLocaleString()}</td>
          <td>
            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-id="${item.id}">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    hitungTotal();
    updateHiddenInput();
  }

  function hitungTotal() {
    let subtotal = 0;
    keranjang.forEach(item => subtotal += item.harga * item.jumlah);
    const tax = subtotal * 0.10;
    const total = subtotal + tax;

    document.getElementById('subtotalDisplay').textContent = `Rp ${subtotal.toLocaleString()}`;
    document.getElementById('taxDisplay').textContent = `Rp ${tax.toLocaleString()}`;
    document.getElementById('totalDisplay').textContent = `Rp ${total.toLocaleString()}`;
  }

  function updateHiddenInput() {
    document.getElementById('inputKeranjang').value = JSON.stringify(keranjang);
  }

  // Event listener untuk tombol tambah ke keranjang (quantity default = 1)
  document.querySelectorAll('.btn-add-cart').forEach(button =>
    button.addEventListener('click', function () {
      const id = this.dataset.id;
      const nama = this.dataset.nama;
      const harga = parseInt(this.dataset.harga);
      const jumlah = 1; // Default quantity = 1
      const cardElement = this.closest('.card-menu');
      const stokElement = cardElement.querySelector('.stok');
      
      // Ambil stok dari elemen atau data-stok
      let currentStok = stokElement ? parseInt(stokElement.textContent) : parseInt(this.dataset.stok);

      // Cek apakah stok mencukupi
      if (currentStok <= 0) {
        alert('Stok habis!');
        return;
      }

      // Update keranjang
      const existing = keranjang.find(item => item.id === id);
      if (existing) {
        existing.jumlah += jumlah;
      } else {
        keranjang.push({ id, nama, harga, jumlah, originalStok: parseInt(this.dataset.stok) });
      }

      // Update tampilan stok
      updateStokDisplay(id, currentStok - jumlah);
      
      renderKeranjang();
    })
  );

  // Event listener untuk hapus item dari keranjang dan update quantity
  document.getElementById('keranjangList').addEventListener('click', function (e) {
    if (e.target.closest('.btn-hapus')) {
      const id = e.target.closest('.btn-hapus').dataset.id;
      const itemToRemove = keranjang.find(item => item.id === id);
      
      if (itemToRemove) {
        // Kembalikan stok ketika menghapus item dari keranjang
        const cardElement = document.querySelector(`[data-id="${id}"]`).closest('.card-menu');
        const stokElement = cardElement.querySelector('.stok');
        let currentStok = stokElement ? parseInt(stokElement.textContent) : 0;
        
        // Update tampilan stok (kembalikan stok)
        updateStokDisplay(id, currentStok + itemToRemove.jumlah);
        
        // Hapus item dari keranjang
        keranjang = keranjang.filter(item => item.id !== id);
        renderKeranjang();
      }
    }

    // Handle quantity buttons in cart
    if (e.target.closest('.btn-qty-plus')) {
      const id = e.target.closest('.btn-qty-plus').dataset.id;
      const item = keranjang.find(item => item.id === id);
      const cardElement = document.querySelector(`[data-id="${id}"]`).closest('.card-menu');
      const stokElement = cardElement.querySelector('.stok');
      let currentStok = stokElement ? parseInt(stokElement.textContent) : 0;
      
      if (currentStok > 0) {
        item.jumlah += 1;
        updateStokDisplay(id, currentStok - 1);
        renderKeranjang();
      } else {
        alert('Stok tidak mencukupi!');
      }
    }

    if (e.target.closest('.btn-qty-minus')) {
      const id = e.target.closest('.btn-qty-minus').dataset.id;
      const item = keranjang.find(item => item.id === id);
      
      if (item.jumlah > 1) {
        const cardElement = document.querySelector(`[data-id="${id}"]`).closest('.card-menu');
        const stokElement = cardElement.querySelector('.stok');
        let currentStok = stokElement ? parseInt(stokElement.textContent) : 0;
        
        item.jumlah -= 1;
        updateStokDisplay(id, currentStok + 1);
        renderKeranjang();
      }
    }
  });

  // Category filter event listener
  document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('click', function () {
      const selectedKategori = this.dataset.kategoriId;
      const menuItems = document.querySelectorAll('.menu-item');
      
      // Update active category
      document.querySelectorAll('.category-card').forEach(c => c.classList.remove('active'));
      this.classList.add('active');
      
      // Filter menu items
      menuItems.forEach(item => {
        if (selectedKategori === '' || item.dataset.kategoriId === selectedKategori) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  // Search menu
  document.getElementById('searchMenu').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
      const menuName = item.querySelector('.menu-name').textContent.toLowerCase();
      if (menuName.includes(searchTerm)) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
    
    // Reset category selection when searching
    if (searchTerm.length > 0) {
      document.querySelectorAll('.category-card').forEach(c => c.classList.remove('active'));
    }
  });

  // Initial render
  renderKeranjang();
});

function submitKeranjang(event) {
  let hasError = false;
  
  // Validasi keranjang
  const keranjangData = document.getElementById('inputKeranjang').value;
  if (keranjangData === '[]' || keranjangData === '' || keranjangData === null) {
    alert('Keranjang masih kosong!');
    event.preventDefault();
    return false;
  }
  
  // Validasi customer
  const customerSelect = document.getElementById('customerSelect');
  if (customerSelect.value === '' || customerSelect.value === null) {
    showFieldError('customerSelect', 'customerError', 'Customer harus dipilih!');
    hasError = true;
  }
  

  if (hasError) {
    event.preventDefault();
    
    // Scroll ke field pertama yang error
    const firstErrorField = document.querySelector('.is-invalid');
    if (firstErrorField) {
      firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
      firstErrorField.focus();
    }
    
    return false;
  }
  
  return true;
}

// Fungsi untuk reset stok ketika halaman di-refresh atau ada kesalahan
function resetAllStok() {
  document.querySelectorAll('.btn-add-cart').forEach(button => {
    const id = button.dataset.id;
    const originalStok = parseInt(button.dataset.stok);
    updateStokDisplay(id, originalStok);
  });
  keranjang = [];
  renderKeranjang();
}
</script>
@endpush