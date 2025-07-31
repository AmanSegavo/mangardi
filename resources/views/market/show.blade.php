<form action="{{ route('market.purchase.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Input tersembunyi untuk menghantar ID akaun yang hendak dibeli -->
    <input type="hidden" name="market_account_id" value="{{ $account->id }}">

    <!-- Pilihan Kaedah Bayaran -->
    <div>
        <label for="payment_method">Kaedah Bayaran</label>
        <select name="payment_method" required>
            <option value="bca">BCA</option>
            <option value="gopay">GoPay</option>
            <!-- ...pilihan lain... -->
        </select>
    </div>

    <!-- Muat Naik Bukti Pembayaran -->
    <div>
        <label for="payment_proof">Muat Naik Bukti Pembayaran</label>
        <input type="file" name="payment_proof" required>
    </div>

    <button type="submit">Sahkan Pembelian</button>
</form>
