<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            margin: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0;
            color: #333;
        }

        .back-btn {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            max-width: 80px;
            border-radius: 4px;
        }

        .qty-input {
            width: 50px;
            text-align: center;
        }

        button {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            background-color: #dc3545;
            transition: background 0.2s;
        }

        button:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th {
                display: none;
            }
            td {
                text-align: left;
                padding-left: 50%;
                position: relative;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<header>
    <h2>Your Cart</h2>
    <a href="index.php" class="back-btn">⬅ Back to Products</a>
</header>

<table id="cart-table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="cart-body"></tbody>
</table>

<script>
// Fetch and display cart
function loadCart() {
    fetch("../api/cart.php")
        .then(res => res.json())
        .then(cart => {
            let rows = "";
            let grandTotal = 0;
            cart.forEach(item => {
                const total = item.price * item.qty;
                grandTotal += total;
                rows += `
                    <tr>
                        <td data-label="Image">${item.image ? `<img src="../uploads/${item.image}">` : ''}</td>
                        <td data-label="Product">${item.name}</td>
                        <td data-label="Price">₹${item.price.toFixed(2)}</td>
                        <td data-label="Qty">
                            <input type="number" min="1" value="${item.qty}" class="qty-input"
                                onchange="updateQty(${item.id}, this.value)">
                        </td>
                        <td data-label="Total">₹${total.toFixed(2)}</td>
                        <td data-label="Action">
                            <button onclick="removeItem(${item.id})">Remove</button>
                        </td>
                    </tr>
                `;
            });
            if (!cart.length) {
                rows = "<tr><td colspan='6' style='text-align:center;'>Cart is empty</td></tr>";
            } else {
                rows += `
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Grand Total:</strong></td>
                        <td><strong>₹${grandTotal.toFixed(2)}</strong></td>
                    </tr>
                `;
            }
            document.getElementById("cart-body").innerHTML = rows;
        });
}

function updateQty(id, qty) {
    fetch("../api/cart.php?id=" + id, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id, qty: qty })
    })
    .then(res => res.json())
    .then(data => {
        console.log("Updated:", data);
        loadCart();
    });
}

function removeItem(id) {
    fetch("../api/cart.php?id=" + id, {
        method: "DELETE"
    })
    .then(res => res.json())
    .then(data => {
        console.log("Removed:", data);
        loadCart();
    });
}

// initial load
loadCart();
</script>

</body>
</html>
