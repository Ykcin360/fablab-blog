// Récupère le contexte du canvas
const ctx_users = document.getElementById("users-chart").getContext("2d");
const ctx_chats = document.getElementById("chats-chart").getContext("2d");
const ctx_posts = document.getElementById("posts-chart").getContext("2d");

// Appelle l'API pour récupérer le nombre d'utilisateurs
fetch("/api/users/count")
    .then((response) => response.json())
    .then((data) => {
        // Crée le graphe circulaire avec les données récupérées
        new Chart(ctx_users, {
            type: "doughnut",
            data: {
                labels: ["Users"],
                datasets: [
                    {
                        label: "Users",
                        data: [data.count],
                        backgroundColor: ["#4A5568"],
                        class: ["dark:text-gray-200"]
                    },
                ],
            },
        });
    });

// Appelle l'API pour récupérer le nombre de messages
fetch("/api/chats/count")
    .then((response) => response.json())
    .then((data) => {
        // Crée le graphe circulaire avec les données récupérées
        new Chart(ctx_chats, {
            type: "doughnut",
            data: {
                labels: ["Chats"],
                datasets: [
                    {
                        label: "Chats",
                        data: [data.count],
                        backgroundColor: ["#FF7F50"],
                    },
                ],
            },
        });
    });

// Appelle l'API pour récupérer le nombre de publications
fetch("/api/posts/count")
    .then((response) => response.json())
    .then((data) => {
        // Crée le graphe circulaire avec les données récupérées
        new Chart(ctx_posts, {
            type: "doughnut",
            data: {
                labels: ["Posts"],
                datasets: [
                    {
                        label: "Posts",
                        data: [data.count],
                        backgroundColor: ["#5c6ac4"],
                    },
                ],
            },
        });
    });
