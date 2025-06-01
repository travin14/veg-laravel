<!-- Quantity Picker Modal -->
<div id="cartModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Select Quantity</h3>
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" id="modal_product_id">
            <label class="block mb-2 text-sm text-gray-700">Weight</label>
            <select name="quantity" required class="w-full border rounded px-3 py-2 mb-4">
                <option value="0.25">250 grams</option>
                <option value="0.5">500 grams</option>
                <option value="1">1 kilogram</option>
                <option value="2">2 kilograms</option>
            </select>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white">Add</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(productId) {
        document.getElementById('modal_product_id').value = productId;
        document.getElementById('cartModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('cartModal').classList.add('hidden');
    }
</script>
