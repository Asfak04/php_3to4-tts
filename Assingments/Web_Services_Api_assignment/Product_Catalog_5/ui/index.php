<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .container { display: flex; gap: 20px; flex-wrap: wrap; }
        .card {
            background: white;
            padding: 15px;
            width: 250px;
            border-radius: 5px;
            box-shadow: 0 0 10px #ccc;
        }
    </style>
</head>
<body>

<h2>Product Catalog</h2>

<div class="container" id="product-list"></div>

<script>
fetch("../api/products.php")
    .then(response => response.json())
    .then(data => {
        let html = "";
        data.forEach(p => {
            html += `
                <div class="card">
                ${p.image ? `<img src="../uploads/${p.image}" width="200">` : ""}
                    <h3>${p.name}</h3>
                    <p>${p.description ?? ""}</p>
                    <strong>₹${p.price}</strong>
                </div>
            `;
        });
        document.getElementById("product-list").innerHTML = html;
    })
    .catch(err => console.error(err));
</script>


</body>
</html>
