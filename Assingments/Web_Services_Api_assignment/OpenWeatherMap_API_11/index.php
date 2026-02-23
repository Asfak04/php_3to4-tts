<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 25px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .result {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>🌤 Weather Dashboard</h2>

    <input type="text" id="city" placeholder="Enter city name">
    <button onclick="getWeather()">Get Weather</button>

    <div class="result" id="result"></div>
</div>

<script>
function getWeather() {
    const city = document.getElementById("city").value;

    if (!city) {
        alert("Please enter city name");
        return;
    }

    fetch("weather_api/weather.php?city=" + city)
        .then(res => res.json())
        .then(data => {
            if (!data.status) {
                document.getElementById("result").innerHTML =
                    `<p style="color:red">${data.message}</p>`;
                return;
            }

            const w = data.data;
            document.getElementById("result").innerHTML = `
                <h3>${w.city}</h3>
                <p>🌡 Temperature: ${w.temperature} °C</p>
                <p>💧 Humidity: ${w.humidity}%</p>
                <p>🌬 Wind Speed: ${w.wind_speed} m/s</p>
                <p>☁ Weather: ${w.weather}</p>
            `;
        })
        .catch(err => console.error(err));
}
</script>

</body>
</html>
