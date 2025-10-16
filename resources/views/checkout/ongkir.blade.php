@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-5">
                    <h2 class="mb-4 text-center" style="font-weight: bold; font-size: 24px; color: #333;">Cek Ongkir</h2>

                    <form action="{{ route('cek-ongkir') }}" method="POST">
                        @csrf

                        <!-- Kota Tujuan -->
                        <div class="mb-4">
                            <label for="destination" class="form-label" style="font-size: 14px; font-weight: 600;">Kota Tujuan</label>
                            <select name="destination" id="destination" class="form-select" style="border-radius: 8px; border: 1px solid #ccc; padding: 12px; font-size: 14px;">
                                @foreach($cities as $city)
                                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Berat Barang -->
                        {{-- <div class="mb-4">
                            <label for="weight" class="form-label" style="font-size: 14px; font-weight: 600;">Berat Barang (gram)</label>
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="Contoh: 1000" style="border-radius: 8px; border: 1px solid #ccc; padding: 12px; font-size: 14px;">
                        </div> --}}
                        <input type="hidden" name="weight" id="weight" value="{{ $totalWeight }}">

                        <!-- Kurir -->
                        <div class="mb-4">
                            <label for="courier" class="form-label" style="font-size: 14px; font-weight: 600;">Kurir</label>
                            <select name="courier" id="courier" class="form-select" style="border-radius: 8px; border: 1px solid #ccc; padding: 12px; font-size: 14px;">
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit"  class="btn btn-red hvr-sweep-to-right dark-sweep" style="font-size: 16px; padding: 12px;">Hitung Ongkir</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
