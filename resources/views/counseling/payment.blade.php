@extends('layouts.app')

@section('content')
<div class="container max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Pembayaran Konseling</h2>

    <div class="mb-4 p-4 border rounded">
        <h3 class="font-semibold text-lg">{{ $doctor->name }}</h3>
        <p class="text-sm text-gray-600">{{ $doctor->specialization }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
        <select class="w-full border p-2 rounded">
            <option>Transfer Bank</option>
            <option>QRIS</option>
            <option>Virtual Account</option>
        </select>
    </div>

    <div class="mb-4">
        <p class="text-lg">Total Biaya: <strong>Rp150.000</strong></p>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Bayar Sekarang
    </button>
</div>
@endsection
