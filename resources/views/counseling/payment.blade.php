@extends('layouts.app')

@section('content')
<div class="container max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Pembayaran Konseling</h2>

    <div class="mb-4 border-b pb-4">
        <h3 class="text-lg font-semibold">{{ $doctor->name }}</h3>
        <p class="text-sm text-gray-600">{{ $doctor->specialization }}</p>
    </div>

    <form method="POST" action="{{ route('counseling.processPayment', $doctor->id) }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-medium">Metode Pembayaran</label>
            <select name="method" class="w-full border rounded p-2" required>
                <option value="transfer">Transfer Bank</option>
                <option value="qris">QRIS</option>
                <option value="va">Virtual Account</option>
            </select>
        </div>

        <div class="mb-4 text-lg">
            Total Biaya: <strong>Rp{{ number_format($doctor->price, 0, ',', '.') }}</strong>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Bayar Sekarang
        </button>
    </form>
</div>
@endsection
