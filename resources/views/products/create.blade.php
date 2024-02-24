<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<form method="post" id="productForm" action="{{ route('products.store') }}">
@csrf 
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Including Price</th>
            <th>Selling Price</th>
            <th>Total Cost</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="productRows">
        <tr>
            <td>
                <select style="width: 99%" class="product-name" name="product_name[]" onchange="updateUnitPrice(this)">
                    <option value="Select Product">Select Product</option>
                    <option value="Food">Food</option>
                    <option value="Dress">Dress</option>
                    <option value="Other">Other</option>
                </select>
            </td>
            <td><input type="number" min="1" name="quantity[]" oninput="calculate(this)"></td>
            <td><input type="number" min="1" name="unit_price[]" readonly></td>
            <td><input type="number" min="1" name="including_price[]" value="50" readonly></td>
            <td><input type="number" min="1" name="selling_price[]" readonly></td>
            <td><input type="number" min="1" name="total_cost[]" readonly></td>
            <td><button type="button" class="deleteRow">Delete</button></td>
        </tr>
    </tbody>
</table>

<button type="button" onclick="addProduct()">Add Row</button>
<button type="submit">Submit</button>
<span style="margin-right:350px; float: right;" id="totalAmount">Total Amount: 0</span>
</form>

<script>
    var totalAmount = 0;
    function addProduct() {
    var newRow = document.createElement('tr');
    newRow.innerHTML = `
    <td>
                <select style="width: 99%" class="product-name" name="product_name[]" onchange="updateUnitPrice(this)">
                    <option value="Select Product">Select Product</option>
                    <option value="Food">Food</option>
                    <option value="Dress">Dress</option>
                    <option value="Other">Other</option>
                </select>
            </td>
            <td><input type="number" min="1" name="quantity[]" oninput="calculate(this)"></td>
            <td><input type="number" min="1" name="unit_price[]" readonly></td>
            <td><input type="number" min="1" name="including_price[]" value="50" readonly></td>
            <td><input type="number" min="1" name="selling_price[]" readonly></td>
            <td><input type="number" min="1" name="total_cost[]" readonly></td>
            <td><button type="button" class="deleteRow">Delete</button></td>
    `;
    document.getElementById('productRows').appendChild(newRow);
    
}

    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("deleteRow")) {
            e.target.closest("tr").remove();
        }
    });

    function updateUnitPrice(selectElement) {
    var unitPriceInput = selectElement.closest('tr').querySelector('input[name="unit_price[]"]');
    if (selectElement.value === "Select Product") {
        unitPriceInput.value = "";
    } else if (selectElement.value === "Food") {
        unitPriceInput.value = 200;
    } else if (selectElement.value === "Dress") {
        unitPriceInput.value = 300;
    } else {
        unitPriceInput.value = 100;
    }
}


    function calculate(inputElement) {
        var parentRow = inputElement.parentElement.parentElement;
        var quantityInput = parentRow.querySelector('input[name="quantity[]"]');
        var unitPriceInput = parentRow.querySelector('input[name="unit_price[]"]');
        var sellingPriceInput = parentRow.querySelector('input[name="selling_price[]"]');
        var totalCostInput = parentRow.querySelector('input[name="total_cost[]"]');
        var includingPriceInput = parentRow.querySelector('input[name="including_price[]"]');
        
        if (!quantityInput || !unitPriceInput || !sellingPriceInput || !totalCostInput || !includingPriceInput) {
            console.error("Failed to locate input element.");
            return;
        }
        
        var quantity = parseFloat(quantityInput.value);
        var unitPrice = parseFloat(unitPriceInput.value);
        var includingPrice = parseFloat(includingPriceInput.value);
        
        if (!isNaN(quantity) && !isNaN(unitPrice) && !isNaN(includingPrice)) {
            var sellingPrice = quantity * unitPrice;
            var totalCost = sellingPrice + includingPrice;
            
            sellingPriceInput.value = sellingPrice.toFixed(2);
            totalCostInput.value = totalCost.toFixed(2);
            totalAmount += totalCost;
        } else {
            sellingPriceInput.value = "";
            totalCostInput.value = "";
        }
        document.getElementById('totalAmount').textContent = "Total Amount: " + totalAmount.toFixed(2);
    }
</script>

</body>
</html>
