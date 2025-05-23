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
</style>

<div class="container-fluid mt-4">
  <div class="row g-4">
    <!-- Data Menu -->
    <div class="col-md-8">
      <div class="menu-panel shadow">
        <h5 class="mb-3">Data Menu</h5>

        <!-- Filter Kategori dan Pencarian -->
        <div class="row mb-3">
          <div class="col-md-6">
            <select id="filterKategori" class="form-select">
              <option value="">Semua Kategori</option>
              @foreach($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <input type="text" id="searchMenu" class="form-control" placeholder="Cari menu...">
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
                    <div class="input-group mb-2">
                      <button class="btn btn-outline-secondary btn-sm btn-minus" type="button">-</button>
                      <input type="number" class="form-control form-control-sm text-center qty-input" value="1" min="1" max="{{ $item->stok }}">
                      <button class="btn btn-outline-secondary btn-sm btn-plus" type="button">+</button>
                    </div>
                    <button class="btn btn-success btn-sm btn-add-cart w-100"
                      data-id="{{ $item->id }}"
                      data-nama="{{ $item->nama_menu }}"
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
        <h5 class="mb-3">Keranjang</h5>
        <form action="{{ route('transaksi.simpan') }}" method="POST" onsubmit="return submitKeranjang(event)">
          @csrf
          <div class="mb-2">
            <label>No Bon/Nota</label>
            <input type="text" class="form-control form-control-sm" name="no_bon" value="{{ $newNoBon }}" readonly>
          </div>
          <div class="mb-2">
            <label>Customer</label>
            <select name="customer_id" class="form-select form-select-sm">
              <option value="">Pilih Customer</option>
              @foreach($customers as $cust)
                <option value="{{ $cust->id }}">{{ $cust->nama }}</option>
              @endforeach
            </select>
            <small class="text-muted">*Untuk customer yang sudah terdaftar</small>
          </div>
          <div class="mb-2">
            <label>Atas Nama</label>
            <input type="text" class="form-control form-control-sm" name="atas_nama" placeholder="Nama Pemesan">
          </div>
          <div class="mb-2">
            <h6><i class="fas fa-shopping-cart"></i> List Keranjang</h6>
            <table class="table table-bordered table-sm">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="keranjangList"></tbody>
            </table>
          </div>
          <div class="mb-2">
            <label>Status Pembayaran</label>
            <select name="status_pembayaran" class="form-select form-select-sm">
              <option value="cash">Cash</option>
              <option value="cashless">Cashless</option>
            </select>
          </div>
          <div class="mb-2">
            <label>Order</label>
            <select name="order_type" class="form-select form-select-sm">
              <option value="dine_in">Dine In</option>
              <option value="take_away">Take Away</option>
            </select>
          </div>
          <div class="mb-2">
            <label>Total Bayar</label>
            <input type="text" class="form-control form-control-sm" id="totalBayar" readonly>
          </div>
          <div class="mb-2">
            <label>Pajak (10%)</label>
            <input type="text" class="form-control form-control-sm" id="pajak" readonly>
          </div>
          <div class="mb-3">
            <label>Grand Total</label>
            <input type="text" class="form-control form-control-sm" id="grandTotal" readonly>
          </div>
          <input type="hidden" name="keranjang" id="inputKeranjang">
          <button type="submit" class="btn btn-success mt-3 w-100">Simpan Transaksi</button>
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

  function updateStokDisplay(menuId, newStok) {
    const cardElement = document.querySelector(`[data-id="${menuId}"]`).closest('.card-menu');
    const stokElement = cardElement.querySelector('.stok');
    const qtyInput = cardElement.querySelector('.qty-input');
    const btnAddCart = cardElement.querySelector('.btn-add-cart');
    const inputGroup = cardElement.querySelector('.input-group');
    
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
      
      // Disable dan sembunyikan input group dan tombol
      if (inputGroup) inputGroup.style.display = 'none';
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
      
      // Update max value untuk quantity input
      if (qtyInput) {
        qtyInput.max = newStok;
        if (parseInt(qtyInput.value) > newStok) {
          qtyInput.value = newStok;
        }
        updateQtyButtons(qtyInput);
      }
      
      // Show input group dan tombol jika sebelumnya hidden
      if (inputGroup) inputGroup.style.display = 'flex';
      if (btnAddCart) btnAddCart.style.display = 'block';
      
      // Hapus tombol disabled jika ada
      const disabledBtn = cardElement.querySelector('.btn-disabled-stock');
      if (disabledBtn) disabledBtn.remove();
      
      // Hapus class disabled dari card
      cardElement.classList.remove('card-disabled');
    }
  }

  function updateQtyButtons(input) {
    const btnGroup = input.closest('.input-group');
    const btnMinus = btnGroup.querySelector('.btn-minus');
    const btnPlus = btnGroup.querySelector('.btn-plus');
    const val = parseInt(input.value);
    const min = parseInt(input.min);
    const max = parseInt(input.max);
    
    btnMinus.disabled = val <= min;
    btnPlus.disabled = val >= max;
    
    // Validasi input manual
    if (val > max) {
      input.value = max;
      alert(`Maksimal quantity adalah ${max} (sesuai stok yang tersedia)`);
    } else if (val < min) {
      input.value = min;
    }
  }

  function renderKeranjang() {
    const tbody = document.getElementById('keranjangList');
    tbody.innerHTML = '';
    keranjang.forEach((item, index) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${index + 1}</td>
        <td>${item.nama}</td>
        <td>${item.jumlah}</td>
        <td>Rp ${item.harga.toLocaleString()}</td>
        <td><button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="${item.id}">Hapus</button></td>
      `;
      tbody.appendChild(row);
    });

    hitungTotal();
    updateHiddenInput();
  }

  function hitungTotal() {
    let total = 0;
    keranjang.forEach(item => total += item.harga * item.jumlah);
    const pajak = total * 0.10;
    const grandTotal = total + pajak;

    document.getElementById('totalBayar').value = `Rp ${total.toLocaleString()}`;
    document.getElementById('pajak').value = `Rp ${pajak.toLocaleString()}`;
    document.getElementById('grandTotal').value = `Rp ${grandTotal.toLocaleString()}`;
  }

  function updateHiddenInput() {
    document.getElementById('inputKeranjang').value = JSON.stringify(keranjang);
  }

  // Event listener untuk quantity input
  document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', () => updateQtyButtons(input));
    input.addEventListener('keyup', () => updateQtyButtons(input));
    input.addEventListener('change', () => updateQtyButtons(input));
    updateQtyButtons(input);
  });

  // Event listener untuk tombol plus
  document.querySelectorAll('.btn-plus').forEach(btn =>
    btn.addEventListener('click', function () {
      const input = this.closest('.input-group').querySelector('.qty-input');
      const currentVal = parseInt(input.value);
      const maxVal = parseInt(input.max);
      
      if (currentVal < maxVal) {
        input.value = currentVal + 1;
        input.dispatchEvent(new Event('input'));
      } else {
        alert(`Maksimal quantity adalah ${maxVal} (sesuai stok yang tersedia)`);
      }
    })
  );

  // Event listener untuk tombol minus
  document.querySelectorAll('.btn-minus').forEach(btn =>
    btn.addEventListener('click', function () {
      const input = this.closest('.input-group').querySelector('.qty-input');
      const currentVal = parseInt(input.value);
      const minVal = parseInt(input.min);
      
      if (currentVal > minVal) {
        input.value = currentVal - 1;
        input.dispatchEvent(new Event('input'));
      }
    })
  );

  // Event listener untuk tombol tambah ke keranjang
  document.querySelectorAll('.btn-add-cart').forEach(button =>
    button.addEventListener('click', function () {
      const id = this.dataset.id;
      const nama = this.dataset.nama;
      const harga = parseInt(this.dataset.harga);
      const qtyInput = this.closest('.card').querySelector('.qty-input');
      const jumlah = parseInt(qtyInput.value);
      const cardElement = this.closest('.card-menu');
      const stokElement = cardElement.querySelector('.stok');
      
      // Ambil stok dari elemen atau data-stok
      let currentStok = stokElement ? parseInt(stokElement.textContent) : parseInt(this.dataset.stok);

      // Cek apakah stok mencukupi
      if (currentStok <= 0) {
        alert('Stok habis!');
        return;
      }

      // Cek apakah quantity yang diminta melebihi stok
      if (jumlah > currentStok) {
        alert(`Tidak dapat menambah item. Quantity melebihi stok yang tersedia (${currentStok})`);
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
      
      // Reset quantity input ke 1
      qtyInput.value = 1;
      updateQtyButtons(qtyInput);
      
      renderKeranjang();
    })
  );

  // Event listener untuk hapus item dari keranjang
  document.getElementById('keranjangList').addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-hapus')) {
      const id = e.target.dataset.id;
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
  });
});

function submitKeranjang(event) {
  if (document.getElementById('inputKeranjang').value === '[]' || document.getElementById('inputKeranjang').value === '') {
    alert('Keranjang masih kosong!');
    event.preventDefault();
    return false;
  }
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