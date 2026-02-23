<!DOCTYPE html>
<html>
<head>
    <title>Twitter Hashtag Search</title>
    <style>
        body { font-family: Arial; }
        .tweet { border-bottom: 1px solid #ddd; padding: 10px; margin-bottom: 10px; }
        img { width: 50px; border-radius: 50%; vertical-align: middle; }
    </style>
</head>
<body>

<h2>🐦 Twitter Hashtag Search</h2>

<input type="text" id="hashtag" placeholder="Enter hashtag without #">
<button onclick="getTweets()">Search</button>

<div id="tweets"></div>

<script>
function getTweets() {
    const hashtag = document.getElementById("hashtag").value;

    fetch(`api/tweets.php?hashtag=${hashtag}`)
        .then(res => res.json())
        .then(data => {
            if (data.status !== "success") {
                alert("Failed to fetch tweets");
                return;
            }

            let html = "";
            data.tweets.forEach(t => {
                html += `
                    <div class="tweet">
                        <img src="${t.profile_image}" alt="Profile">
                        <b>${t.name} (@${t.username})</b><br>
                        ${t.text}<br>
                        <small>${new Date(t.created_at).toLocaleString()}</small>
                    </div>
                `;
            });

            document.getElementById("tweets").innerHTML = html;
        });
}
</script>

</body>
</html>
