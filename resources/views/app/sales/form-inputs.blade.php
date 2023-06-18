<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="payment_method_id" label="Payment Method" required>
            <option disabled selected>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="product_id" label="Product" required>
            <option disabled selected>Please select the Product</option>
            @foreach($products as $product)
            <option value="{{ $product['id'] }}" data-price="{{ $product['price'] }}">{{ $product['name'] }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="item_price" name="item_price" label="Item Price" enabled></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="quantity" name="quantity" label="Quantity" step="1" required />
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="total_price" name="total_price" label="Total Price" step="0.01" placeholder="Total Price" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="subtotal_sales" name="subtotal_sales" label="Subtotal Sales" step="0.01" placeholder="Subtotal Sales" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="service_tax" name="service_tax" label="Service Tax" step="0.01" placeholder="Service Tax" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="total_sales" name="total_sales" label="Total Sales" step="0.01" placeholder="Total Sales" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            <option value="completed">Completed</option>
            <option value="refunded">Refunded</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="refunded_reason" label="Refunded Reason" maxlength="255"></x-inputs.textarea>
    </x-inputs.group>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemPriceInput = document.getElementById('item_price');
        const quantityInput = document.getElementById('quantity');
        const totalPriceInput = document.getElementById('total_price');
        const subtotalSalesInput = document.getElementById('subtotal_sales');
        const serviceTaxInput = document.getElementById('service_tax');
        const totalSalesInput = document.getElementById('total_sales');

        itemPriceInput.addEventListener('input', calculateTotalPrice);
        quantityInput.addEventListener('input', calculateTotalPrice);

        const productSelect = document.getElementById('product_id');
        productSelect.addEventListener('change', showPrice);

        function showPrice() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const productPrice = parseFloat(selectedOption.getAttribute('data-price'));
            const itemPriceInput = document.getElementById('item_price');
            itemPriceInput.value = productPrice.toFixed(2);
        }

        function calculateTotalPrice() {
            const itemPrice = parseFloat(itemPriceInput.value);
            const quantity = parseInt(quantityInput.value);

            if (!isNaN(itemPrice) && !isNaN(quantity)) {
                const total = (itemPrice * quantity).toFixed(2);
                totalPriceInput.value = total;
                calculateSubtotalSales();
                calculateServiceTax();
                calculateTotalSales();
            }
        }

        function calculateSubtotalSales() {
            const totalPrices = document.querySelectorAll('input[name="total_price"]');
            let subtotalSales = 0;

            totalPrices.forEach(function(totalPriceInput) {
                const total = parseFloat(totalPriceInput.value);
                if (!isNaN(total)) {
                    subtotalSales += total;
                }
            });

            subtotalSalesInput.value = subtotalSales.toFixed(2);
        }

        function calculateServiceTax() {
            const subtotalSales = parseFloat(subtotalSalesInput.value);
            if (!isNaN(subtotalSales)) {
                const tax = (subtotalSales * 0.06).toFixed(2);
                serviceTaxInput.value = tax;
            }
        }

        function calculateTotalSales() {
            const serviceTax = parseFloat(serviceTaxInput.value);
            const subtotalSales = parseFloat(subtotalSalesInput.value);
            if (!isNaN(serviceTax) && !isNaN(subtotalSales)) {
                const total = (serviceTax + subtotalSales).toFixed(2);
                totalSalesInput.value = total;
            }
        }
    });
</script>