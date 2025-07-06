@extends('layouts.app') 
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Verifikasi Pembayaran</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pengguna</th>
                            <th>Dokter</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingPayments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->user->nama_user ?? 'N/A' }}</td>
                                <td>{{ $payment->doctor->nama_user ?? 'N/A' }}</td>
                                <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>{{ strtoupper($payment->method) }} - {{ strtoupper($payment->payment_detail) }}</td>
                                <td>{{ $payment->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    {{-- Link untuk melihat bukti transfer di tab baru --}}
                                    <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                                <td>
                                    {{-- Form untuk tombol "Setujui" --}}
                                    <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menyetujui pembayaran ini?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-circle"></i> Setujui
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada pembayaran yang menunggu verifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Link untuk pagination --}}
            <div class="mt-3">
                {{ $pendingPayments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection