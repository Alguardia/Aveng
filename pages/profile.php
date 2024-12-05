<?php 
    require_once(__DIR__."/../config/mysql.php");
    require_once(__DIR__."/../config/databaseconnect.php");

    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }

    $user_id = $_GET['id'];
    $profileStatement = $mysqlClient->prepare("SELECT * FROM users WHERE id = :id");
    $profileStatement->bindParam(':id', $user_id);
    $profileStatement->execute();
    $profile = $profileStatement->fetch();

    if ($profile) {
        $prenom = $profile['prenom'];
        $nom = $profile['nom'];
    } else {
        echo "Utilisateur introuvable.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="https://logodix.com/logo/1918757.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="logo">AS</div>
            <div class="nav-links">
                <a href="../index.php">Accueil</a>
                <a href="about.php">À propos</a>
                <a href="contact.php">Contact</a>
            </div>
            <div class="nav-img">
                <img src="../images/user.png" alt="User Icon" class="user-icon">
                <div class="dropdown">
                    <?php if (isset($_SESSION['prenom'])): ?>
                        <span class="user-name"><?php echo $_SESSION['prenom']; ?></span> 
                        <div class="dropdown-content">
                            <a href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profil</a>
                            <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                                <a href="admin_panel.php">Messagerie</a>
                            <?php endif; ?>
                            <a href="logout.php">Déconnexion</a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="login-link">Connexion</a> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <h1>Bienvenue sur votre profil</h1>
    <h2>Bonjour <?php echo $nom . " " . $prenom; ?></h2>
    
    <form id="password-to-check-form" method="POST">
        <label for="password_to_check" >Veuillez entrer votre mot de passe : </label>
        <input name="password_to_check" type="password"></input>
        <button type="submit">Verification</nutton>
    </form>
    </section>

    <!-- <script>
        function fetchPosts(apiUrl) {
            // Effectuer une requête GET à l'API
            fetch(apiUrl)
                .then(response => {
                // Vérification de la réponse (status HTTP 200)
                if (!response.ok) {
                    throw new Error('Erreur de réseau');
                }
                return response.json(); // Conversion de la réponse en JSON
                })
                .then(data => {
                // Si la requête réussit, on affiche les posts
                console.log(data);
                // Boucle pour afficher les posts dans le DOM
                data.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.innerHTML = `<h3>${post.title}</h3><p>${post.body}</p>`;
                    document.body.appendChild(postElement); // Ajouter chaque post dans le body
                });
                })
                .catch(error => {
                // Gestion des erreurs
                console.error('Erreur:', error);
        });

        function checkPassword(passwordToCheck) {
            hash_password_to_check = strHash(passwordToCheck, 'SHA-1');
            alert(hash_password_to_check);
        };

        const form = document.querySelector("#password-to-check-form");
        alert(test)
        form.addEventListener("submit", (event) => {
            event.preventDefault()
            const formData = new FormData(form)
            alert(formData)
        });

} -->
    <!-- </script> -->
    
</body>
</html>
