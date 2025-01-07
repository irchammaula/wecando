

<div class="container">
    <h1 class="mt-4">Daftar Transaksi</h1>

    @if ($transactions->count() > 0)
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Trx ID</th>
                    <th>Nomor Tujuan</th>
                    <th>Kode Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->trxid_api }}</td>
                        <td>{{ $transaction->phone }}</td>
                        <td>{{ $transaction->code }}</td>
                        <td>{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td>
                            @switch($transaction->status)
                                @case(0) <span class="badge bg-secondary">Belum Diproses</span> @break
                                @case(1) <span class="badge bg-warning">Pending</span> @break
                                @case(2) <span class="badge bg-danger">Gagal</span> @break
                                @case(3) <span class="badge bg-info">Refund</span> @break
                                @case(4) <span class="badge bg-success">Sukses</span> @break
                                @default <span class="badge bg-dark">Unknown</span>
                            @endswitch
                        </td>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $transactions->links() }}
        </div>
    @else
        <p class="text-center mt-4">Belum ada transaksi.</p>
    @endif
</div>
