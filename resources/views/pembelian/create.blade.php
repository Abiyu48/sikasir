@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Pembelian</h4>
    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tanggal Pembelian</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <table class="table table-bordered" id="item-table">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Harga Beli</th>
                    <th><button type="button" class="btn btn-sm btn-primary" onclick="addRow()">+</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="menu_id[]" class="form-control" required>
                            <option value="">Pilih Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="jumlah[]" class="form-control" required></td>
                    <td><input type="number" name="harga_beli[]" class="form-control" step="0.01" required></td>
                    <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function addRow() {
    let table = document.querySelector('#item-table tbody');
    let row = table.insertRow();

    row.innerHTML = `
        <td>
            <select name="menu_id[]" class="form-control" required>
                <option value="">Pilih Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" name="jumlah[]" class="form-control" required></td>
        <td><input type="number" name="harga_beli[]" class="form-control" step="0.01" required></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button></td>
    `;
}

function removeRow(button) {
    button.closest('tr').remove();
}
</script>
@endsection
