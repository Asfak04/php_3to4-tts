<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 40px;
            text-align: center;
        }
        input {
            padding: 10px;
            width: 200px;
        }
        button {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .card {
            margin-top: 20px;
            display: inline-block;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<h2>🌤️ Weather Checker</h2>

<input type="text" id="city" placeholder="Enter city">
<button onclick="getWeather()">Check</button>

<div id="result"></div>

<script>
function getWeather() {
    const city = document.getElementById("city").value;

    fetch(`../api/weather.php?city=${city}`)
        .then(res => res.json())
        .then(result => {
            if (result.status) {
                document.getElementById("result").innerHTML = `
                    <div class="card">
                        <h3>${result.data.city}</h3>
                        <p>🌡️ Temp: ${result.data.temperature} °C</p>
                        <p>💧 Humidity: ${result.data.humidity}%</p>
                        <p>☁️ Weather: ${result.data.weather}</p>
                    </div>
                `;
            } else {
                alert(result.message);
            }
        })
        .catch(err => console.error(err));
}
</script>

</body>
</html>
