@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Checkout Pesanan</h3>
        </div>
        <div class="card-body">
          <!-- Info Transaksi -->
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="info-group">
                <label class="fw-bold">Nama Customer:</label>
                <p class="mb-2">{{ $nama_customer ?? 'Guest' }}</p>
              </div>
              <div class="info-group">
                <label class="fw-bold">Tanggal/Waktu:</label>
                <p class="mb-2">{{ $tanggal ?? date('d-m-Y H:i:s') }}</p>
              </div>
              <div class="info-group">
                <label class="fw-bold">No. Bon:</label>
                <p class="mb-2">{{ $no_bon ?? 'TRX-' . date('YmdHis') }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-group">
                <label class="fw-bold">Status Pembayaran:</label>
                <span class="badge bg-{{ $metode_pembayaran === 'cash' ? 'success' : 'primary' }}">
                  {{ ucfirst($metode_pembayaran ?? 'Belum Ditentukan') }}
                </span>
              </div>
            </div>
          </div>

          @if(isset($keranjang) && count($keranjang) > 0)
          <!-- Tabel Pesanan -->
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="table-dark">
                <tr>
                  <th width="40%">Menu</th>
                  <th width="10%" class="text-center">Qty</th>
                  <th width="20%" class="text-end">Harga Satuan</th>
                  <th width="15%" class="text-end">Pajak (10%)</th>
                  <th width="15%" class="text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($keranjang as $item)
                  @php 
                    $harga = $item['harga'] ?? 0;
                    $jumlah = $item['jumlah'] ?? 1;
                    $pajak = $harga * 0.1;
                    $total = ($harga + $pajak) * $jumlah;
                    $grandTotal += $total;
                  @endphp
                  <tr>
                    <td>
                      <strong>{{ $item['nama'] ?? 'Menu Tidak Diketahui' }}</strong>
                      @if(isset($item['keterangan']) && !empty($item['keterangan']))
                        <br><small class="text-muted">{{ $item['keterangan'] }}</small>
                      @endif
                    </td>
                    <td class="text-center">{{ $jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($pajak, 0, ',', '.') }}</td>
                    <td class="text-end"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot class="table-secondary">
                <tr>
                  <th colspan="4" class="text-end">Grand Total:</th>
                  <th class="text-end text-success">
                    <h5 class="mb-0">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h5>
                  </th>
                </tr>
              </tfoot>
            </table>
          </div>

          <!-- Form Actions -->
          <div class="row mt-4">
            <div class="col-12">
              <div class="d-flex justify-content-between flex-wrap gap-2">
                <div>
                  <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Transaksi
                  </a>
                  <a href="{{ route('checkout.batal') }}" class="btn btn-danger ms-2">
                    <i class="fas fa-times"></i> Batalkan Pesanan
                  </a>
                </div>
                <div>
                  <form action="{{ route('checkout.konfirmasi') }}" method="POST" class="d-inline" id="checkoutForm">
                    @csrf
                    
                    <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                      <i class="fas fa-check"></i> Konfirmasi Pesanan
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @else
            <!-- Keranjang Kosong -->
            <div class="text-center py-5">
              <div class="mb-3">
                <i class="fas fa-shopping-cart fa-3x text-muted"></i>
              </div>
              <h4 class="text-muted">Keranjang Kosong</h4>
              <p class="text-muted">Belum ada item yang ditambahkan ke keranjang.</p>
              <a href="{{ route('transaksi.index') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Item
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
.info-group {
  margin-bottom: 1rem;
}
.info-group label {
  color: #6c757d;
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
  display: block;
}
.table th {
  vertical-align: middle;
}
.table td {
  vertical-align: middle;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('checkoutForm');
  const submitBtn = document.getElementById('submitBtn');
  
  if (form && submitBtn) {
    form.addEventListener('submit', function(e) {
      // Disable button to prevent double submission
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
      
      // Re-enable button after 5 seconds as fallback
      setTimeout(function() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Konfirmasi Pesanan';
      }, 5000);
    });
  }
});
</script>
@endpush
@endsection