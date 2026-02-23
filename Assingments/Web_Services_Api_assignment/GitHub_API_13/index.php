<!DOCTYPE html>
<html>
<head>
    <title>GitHub User Finder</title>
    <style>
        body { font-family: Arial; }
        img { width: 80px; border-radius: 50%; }
        ul { padding-left: 20px; }
    </style>
</head>
<body>

<h2>🔍 GitHub User Search</h2>

<input type="text" id="username" placeholder="Enter GitHub username">
<button onclick="searchUser()">Search</button>

<div id="user"></div>
<ul id="repos"></ul>

<script>
function searchUser() {
    const username = document.getElementById("username").value;

    fetch(`github_api/user.php?username=${username}`)
        .then(res => res.json())
        .then(user => {
            if (user.status !== "success") {
                alert("User not found");
                return;
            }

            document.getElementById("user").innerHTML = `
                <img src="${user.avatar}">
                <p><a href="${user.profile}" target="_blank">${user.username}</a></p>
            `;

            return fetch(`github_api/repos.php?username=${username}`);
        })
        .then(res => res.json())
        .then(data => {
            let list = "";
            data.repositories.forEach(repo => {
                list += `<li>
                    <a href="${repo.url}" target="_blank">${repo.name}</a>
                    ⭐ ${repo.stars} | ${repo.language ?? 'N/A'}
                </li>`;
            });
            document.getElementById("repos").innerHTML = list;
        });
}
</script>

</body>
</html>
