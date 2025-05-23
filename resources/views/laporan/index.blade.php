@extends('layouts.app')

@section('title', 'Laporan Penjualan per Customer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Penjualan per Customer</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Customer</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Total Transaksi</th>
                                    <th>Total Penjualan</th>
                                    <th>Transaksi Terakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $customer->nama }}</strong>
                                    </td>
                                    <td>{{ $customer->telepon ?? '-' }}</td>
                                    <td>{{ Str::limit($customer->alamat ?? '-', 30) }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $customer->penjualan_count }} transaksi
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-success">
                                            Rp {{ number_format($customer->penjualan_sum_total ?? 0, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        @if($customer->penjualan->count() > 0)
                                            {{ $customer->penjualan->first()->formatted_tanggal }}
                                        @else
                                            <span class="text-muted">Belum ada transaksi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('laporan.show', $customer->id) }}" 
                                               class="btn btn-sm btn-primary" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i> hellp
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <br>
                                        Belum ada data customer
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $customers->firstItem() ?? 0 }} sampai {{ $customers->lastItem() ?? 0 }} 
                            dari {{ $customers->total() }} customer
                        </div>
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th {
        vertical-align: middle;
        text-align: center;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        margin-right: 2px;
    }
    .badge {
        font-size: 0.875em;
    }
</style>
@endpush
@endsection