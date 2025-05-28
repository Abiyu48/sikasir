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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-container {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            position: relative;
        }

        .main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .struk-content {
            padding: 32px 28px;
            background: #ffffff;
        }

        .header {
            text-align: center;
            padding-bottom: 24px;
            margin-bottom: 24px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 1px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header .subtitle {
            font-size: 14px;
            color: #667eea;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .header p {
            font-size: 13px;
            color: #718096;
            margin: 4px 0;
            line-height: 1.4;
        }

        .info-section {
            margin-bottom: 24px;
            background: #f7fafc;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .info-grid {
            display: grid;
            gap: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
        }

        .info-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 13px;
        }

        .info-value {
            color: #2d3748;
            font-weight: 500;
            font-size: 13px;
        }

        .items-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }

        .items-header {
            font-size: 16px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
        }

        .item {
            margin-bottom: 16px;
            padding: 16px;
            background: #f7fafc;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .item:last-child {
            margin-bottom: 0;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .item-name {
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
        }

        .item-total {
            font-weight: 700;
            color: #667eea;
            font-size: 14px;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #718096;
        }

        .quantity-price {
            font-weight: 500;
        }

        .tax-info {
            font-style: italic;
        }

        .totals-section {
            background: #f7fafc;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-top: 24px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 14px;
        }

        .total-row.subtotal {
            color: #718096;
            font-weight: 500;
        }

        .total-row.tax {
            color: #ed8936;
            font-weight: 600;
        }

        .total-row.grand-total {
            font-weight: 700;
            font-size: 18px;
            color: #2d3748;
            border-top: 2px solid #e2e8f0;
            padding-top: 16px;
            margin-top: 12px;
        }

        .total-amount {
            font-family: 'Courier New', monospace;
        }

        .footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .footer-message {
            font-size: 16px;
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .footer-submessage {
            font-size: 14px;
            color: #718096;
            margin-bottom: 12px;
        }

        .footer-timestamp {
            font-size: 12px;
            color: #a0aec0;
            font-family: 'Courier New', monospace;
        }

        .actions {
            padding: 24px 28px;
            background: #f7fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            flex: 1;
            min-width: 140px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
            border: 1px solid #cbd5e0;
        }

        .btn-secondary:hover {
            background: #cbd5e0;
            color: #2d3748;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-cash {
            background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
            color: #22543d;
        }

        .status-cashless {
            background: linear-gradient(135deg, #bee3f8 0%, #90cdf4 100%);
            color: #1a365d;
        }

        .order-dine-in {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            color: #9c4221;
        }

        .order-take-away {
            background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%);
            color: #553c9a;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
                display: block;
                margin: 0;
                font-size: 12px;
            }

            .main-container {
                box-shadow: none;
                border: none;
                border-radius: 0;
                max-width: none;
                width: 100%;
                margin: 0;
                page-break-inside: avoid;
            }

            .main-container::before {
                display: none;
            }

            .actions {
                display: none;
            }

            .struk-content {
                padding: 15px;
                margin: 0;
            }

            .header {
                padding-bottom: 12px;
                margin-bottom: 12px;
            }

            .header h1 {
                font-size: 20px;
                margin-bottom: 4px;
            }

            .header .subtitle {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .header p {
                font-size: 11px;
                margin: 2px 0;
            }

            .header::after {
                display: none;
            }

            .info-section {
                margin-bottom: 15px;
                padding: 12px;
                background: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .info-row {
                padding: 4px 0;
            }

            .info-label, .info-value {
                font-size: 11px;
            }

            .items-section {
                padding: 12px;
                margin: 15px 0;
                background: white !important;
                border: 1px solid #ddd !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .items-header {
                font-size: 13px;
                margin-bottom: 10px;
                padding-bottom: 8px;
            }

            .item {
                margin-bottom: 10px;
                padding: 8px;
                background: #f8f8f8 !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                border-left: 2px solid #667eea !important;
            }

            .item-name, .item-total {
                font-size: 12px;
            }

            .item-details {
                font-size: 10px;
            }

            .totals-section {
                padding: 12px;
                margin-top: 15px;
                background: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .total-row {
                padding: 4px 0;
                font-size: 12px;
            }

            .total-row.grand-total {
                font-size: 14px;
                padding-top: 8px;
                margin-top: 8px;
            }

            .footer {
                margin-top: 20px;
                padding-top: 15px;
            }

            .footer-message {
                font-size: 13px;
                margin-bottom: 4px;
            }

            .footer-submessage {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .footer-timestamp {
                font-size: 10px;
            }

            .status-badge {
                padding: 3px 8px;
                font-size: 9px;
                background: #e2e8f0 !important;
                color: #4a5568 !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            /* Force single page */
            @page {
                size: A4;
                margin: 0.5in;
            }

            * {
                page-break-inside: avoid;
            }

            .struk-content {
                page-break-inside: avoid;
                max-height: none;
            }
        }

        /* Responsive */
        @media (max-width: 540px) {
            body {
                padding: 12px;
            }

            .main-container {
                max-width: 100%;
            }

            .struk-content {
                padding: 24px 20px;
            }

            .actions {
                padding: 20px;
                flex-direction: column;
            }

            .btn {
                min-width: auto;
                width: 100%;
            }

            .info-section {
                padding: 16px;
            }

            .items-section {
                padding: 16px;
            }

            .totals-section {
                padding: 20px;
            }
        }

        @media (max-width: 380px) {
            .header h1 {
                font-size: 24px;
            }

            .item-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .item-details {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="struk-content" id="struk-content">
            <!-- Header -->
            <div class="header">
                <h1>RESTO KITA</h1>
                <div class="subtitle">Premium Dining</div>
                <p>Jl. Contoh No. 123, Kota Bandung</p>
                <p>Telp: (021) 123-4567</p>
                <p>Email: info@restokita.com</p>
            </div>

            <!-- Info Transaksi -->
            <div class="info-section">
                <div class="info-grid">
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
            </div>

            <!-- Items -->
            <div class="items-section">
                <div class="items-header">Detail Pesanan</div>
                @foreach($penjualan->detailPenjualan as $detail)
                <div class="item">
                    <div class="item-header">
                        <span class="item-name">{{ $detail->menu->nama }}</span>
                        <span class="item-total">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="item-details">
                        <span class="quantity-price">{{ $detail->jumlah }}x @ Rp {{ number_format($detail->harga, 0, ',', '.') }}</span>
                        <span class="tax-info">Pajak: Rp {{ number_format($detail->pajak, 0, ',', '.') }}</span>
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
                    <span class="total-amount">Rp {{ number_format($subtotalBeforeTax, 0, ',', '.') }}</span>
                </div>
                <div class="total-row tax">
                    <span>Pajak (10%):</span>
                    <span class="total-amount">Rp {{ number_format($totalTax, 0, ',', '.') }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>TOTAL BAYAR:</span>
                    <span class="total-amount">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-message">Terima kasih atas kunjungan Anda!</div>
                <div class="footer-submessage">Selamat menikmati hidangan dan sampai jumpa kembali</div>
                <div class="footer-timestamp">{{ now()->format('d/m/Y H:i:s') }}</div>
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
            <a href="#" class="btn btn-secondary">
                📋 Lihat Semua
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
            // Optional: redirect setelah print
            // window.location.href = '{{ route("transaksi.index") }}';
        });

        // Smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.item, .info-section, .totals-section');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>