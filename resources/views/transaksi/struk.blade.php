<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan - {{ $penjualan->no_bon }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .struk-container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .struk-content {
            padding: 20px;
            background: white;
        }

        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
            margin: 2px 0;
        }

        .info-section {
            margin-bottom: 15px;
            font-size: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #666;
        }

        .items-section {
            border-top: 1px dashed #333;
            border-bottom: 1px dashed #333;
            padding: 10px 0;
            margin: 15px 0;
        }

        .item {
            margin-bottom: 8px;
            font-size: 12px;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            color: #333;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 11px;
            margin-top: 2px;
        }

        .totals-section {
            margin-top: 15px;
            font-size: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            padding: 2px 0;
        }

        .total-row.subtotal {
            color: #666;
        }

        .total-row.tax {
            color: #e67e22;
        }

        .total-row.grand-total {
            font-weight: bold;
            font-size: 14px;
            color: #2c3e50;
            border-top: 1px solid #333;
            padding-top: 8px;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #333;
            font-size: 11px;
            color: #666;
        }

        .footer p {
            margin: 3px 0;
        }

        .actions {
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-1px);
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #219a52;
            transform: translateY(-1px);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-cash {
            background: #e8f5e8;
            color: #27ae60;
        }

        .status-cashless {
            background: #e3f2fd;
            color: #2196f3;
        }

        .order-dine-in {
            background: #fff3e0;
            color: #ff9800;
        }

        .order-take-away {
            background: #f3e5f5;
            color: #9c27b0;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk-container {
                box-shadow: none;
                border-radius: 0;
                max-width: none;
                width: 100%;
            }

            .actions {
                display: none;
            }

            .struk-content {
                padding: 10px;
            }

            .header h1 {
                font-size: 20px;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .struk-container {
                max-width: 100%;
            }

            .actions {
                padding: 15px;
            }

            .btn {
                display: block;
                margin: 5px 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="struk-container">
        <div class="struk-content" id="struk-content">
            <!-- Header -->
            <div class="header">
                <h1>RESTO KITA</h1>
                <p>Jl. Contoh No. 123, Kota</p>
                <p>Telp: (021) 123-4567</p>
                <p>Email: info@restokita.com</p>
            </div>

            <!-- Info Transaksi -->
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">No. Bon:</span>
                    <span class="info-value">{{ $penjualan->no_bon }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal:</span>
                    <span class="info-value">{{ $penjualan->tanggal->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kasir:</span>
                    <span class="info-value">{{ $penjualan->customer->nama ?? $penjualan->atas_nama ?? 'Guest' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Pembayaran:</span>
                    <span class="info-value">
                        <span class="status-badge {{ $penjualan->status_pembayaran == 'cash' ? 'status-cash' : 'status-cashless' }}">
                            {{ $penjualan->status_pembayaran == 'cash' ? 'Tunai' : 'Non-Tunai' }}
                        </span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tipe Order:</span>
                    <span class="info-value">
                        <span class="status-badge {{ $penjualan->order_type == 'dine_in' ? 'order-dine-in' : 'order-take-away' }}">
                            {{ $penjualan->order_type == 'dine_in' ? 'Dine In' : 'Take Away' }}
                        </span>
                    </span>
                </div>
            </div>

            <!-- Items -->
            <div class="items-section">
                @foreach($penjualan->detailPenjualan as $detail)
                <div class="item">
                    <div class="item-header">
                        <span>{{ $detail->menu->nama }}</span>
                        <span>{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="item-details">
                        <span>{{ $detail->jumlah }}x @ {{ number_format($detail->harga, 0, ',', '.') }}</span>
                        <span>Pajak: {{ number_format($detail->pajak, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Totals -->
            <div class="totals-section">
                @php
                    // Hitung subtotal sebelum pajak (harga * jumlah)
                    $subtotalBeforeTax = $penjualan->detailPenjualan->sum('subtotal_before_tax');
                    
                    $totalTax = $penjualan->detailPenjualan->sum('pajak');
                    
                    // Total keseluruhan
                     $grandTotal = $subtotalBeforeTax + $totalTax;
                @endphp
                
                <div class="total-row subtotal">
                    <span>Subtotal:</span>
                    <span>Rp {{ number_format($subtotalBeforeTax, 0, ',', '.') }}</span>
                </div>
                <div class="total-row tax">
                    <span>Pajak (10%):</span>
                    <span>Rp {{ number_format($totalTax, 0, ',', '.') }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>TOTAL:</span>
                    <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Terima kasih atas kunjungan Anda!</p>
                <p>Selamat menikmati hidangan</p>
                <p>{{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions">
            <button onclick="window.print()" class="btn btn-primary">
                🖨️ Cetak Struk
            </button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-success">
                ➕ Transaksi Baru
            </a>
            <a class="btn btn-secondary">
                📋 Lihat Semua Transaksi
            </a>
        </div>
    </div>

    <script>
        // Auto focus untuk print
        window.addEventListener('load', function() {
            // Jika ada parameter print di URL, otomatis print
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('print') === 'true') {
                setTimeout(() => {
                    window.print();
                }, 500);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+P untuk print
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
            
            // Escape untuk kembali ke transaksi
            if (e.key === 'Escape') {
                window.location.href = '{{ route("transaksi.index") }}';
            }
        });

        // Print notification
        window.addEventListener('beforeprint', function() {
            console.log('Mencetak struk...');
        });

        window.addEventListener('afterprint', function() {
            console.log('Struk selesai dicetak');
        });
    </script>
</body>
</html>