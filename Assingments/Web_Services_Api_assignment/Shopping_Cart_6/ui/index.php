<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background: #343a40;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            color: white;
            text-decoration: none;
            background: #28a745;
            padding: 8px 14px;
            border-radius: 4px;
        }

        header a:hover {
            background: #218838;
        }

        h2 {
            margin: 0;
        }

        .container {
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 15px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 18px;
        }

        .card p {
            font-size: 14px;
            color: #555;
            min-height: 40px;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin: 8px 0;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <h2>🛍️ Product Catalog</h2>

    <a href="cart.php" id="cart-btn">
        🛒 View Cart (<span id="cart-count">0</span>)
    </a>
</header>

<div class="container" id="product-list"></div>

<script>
fetch("../api/products.php")
    .then(response => response.json())
    .then(data => {
        let html = "";
        data.forEach(p => {
            html += `
                <div class="card">
                    ${p.image ? `<img src="../uploads/${p.image}">` : ""}
                    <h3>${p.name}</h3>
                    <p>${p.description ?? ""}</p>
                    <div class="price">₹${p.price}</div>

                    <button onclick="addToCart(
                        ${p.id},
                        '${p.name.replace(/'/g, "\\'")}',
                        ${p.price},
                        '${p.image ?? ""}'
                    )">
                        Add to Cart
                    </button>
                </div>
            `;
        });
        document.getElementById("product-list").innerHTML = html;
    })
    .catch(err => console.error(err));

function addToCart(id, name, price, image) {
    const payload = {
        id: id,
        name: name,
        price: price,
        qty: 1,
        image: image
    };

    fetch("../api/cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(() => {
        alert("✅ Product added to cart");
        loadCartCount(); // 🔥 update count instantly
    })
    .catch(err => console.error(err));
}


function loadCartCount() {
    fetch("../api/cart.php")
        .then(res => res.json())
        .then(cart => {
            let count = 0;
            cart.forEach(item => count += item.qty);
            document.getElementById("cart-count").innerText = count;
        })
        .catch(err => console.error(err));
}
loadCartCount()

</script>

</body>
</html>
