@php
    $isEdit = isset($voucher);
@endphp

<div class="mb-3">
    <label for="code" class="form-label">Kode Voucher</label>
    <input type="text" name="code" id="code" 
           value="{{ old('code', $isEdit ? $voucher->code : '') }}" 
           class="form-control" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $isEdit ? $voucher->description : '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="discount_type" class="form-label">Tipe Diskon</label>
        <select name="discount_type" id="discount_type" class="form-select" required>
            <option value="percent" {{ old('discount_type', $isEdit ? $voucher->discount_type : '') == 'percent' ? 'selected' : '' }}>Persentase</option>
            <option value="fixed" {{ old('discount_type', $isEdit ? $voucher->discount_type : '') == 'fixed' ? 'selected' : '' }}>Potongan Tetap</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="discount_value" class="form-label">Nilai Diskon</label>
        <input type="number" step="0.01" name="discount_value" id="discount_value" 
               value="{{ old('discount_value', $isEdit ? $voucher->discount_value : '') }}" 
               class="form-control" required>
    </div>
</div>

<div class="mb-3">
    <label for="expires_at" class="form-label">Tanggal Kadaluarsa</label>
    <input type="datetime-local" name="expires_at" id="expires_at" 
           value="{{ old('expires_at', $isEdit && $voucher->expires_at ? $voucher->expires_at->format('Y-m-d\TH:i') : '') }}" 
           class="form-control">
</div>
<div class="mb-3">
    <label for="max_usage_per_user" class="form-label">Batas Penggunaan per User</label>
    <input type="number" name="max_usage_per_user" class="form-control" min="1" value="1" required>
</div>


<div class="form-check mb-3">
    <input type="checkbox" name="is_active" id="is_active" value="1" 
           class="form-check-input" 
           {{ old('is_active', $isEdit ? $voucher->is_active : true) ? 'checked' : '' }}>
    <label for="is_active" class="form-check-label">Voucher Aktif</label>
</div>
