<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        $hidePage = true;  
    } else {
        $hidePage = false;  
    }
?>


<?php
    require_once(__DIR__ . "/../config/mysql.php");
    require_once(__DIR__ . "/../config/databaseconnect.php");

    $contactStatement = $mysqlClient->prepare("SELECT * from contact_info");
    $contactStatement->execute();
    $contact = $contactStatement->fetchAll();

    $email = $contact[0]['email'];
    $linkedin = $contact[0]['linkedin'];
    $github = $contact[0]['github'];
    $telephone = $contact[0]['telephone'];
    $localisation = $contact[0]['localisation'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Anthony Stark</title>
    <link rel="icon" href="https://logodix.com/logo/1918757.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">
</head>

<body>
   

    <nav>
        <div class="nav-content">
            <div class="logo">AS</div>
            <div class="nav-links">
                <a href="../index.php">Accueil</a>
                <a href="about.php">À propos</a>
                <a href="contact.php" class="active">Contact</a>
            </div>
            <div class="nav-img">
                <img src="../images/user.png" alt="User Icon" class="user-icon">
                <div class="dropdown">
                    <?php if (!$hidePage): ?>
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


    <main>
 
        <div class="page-content <?php echo $hidePage ? 'hidden' : ''; ?>">
            <section class="contact">
                <h1>Contact</h1>
                <div class="contact-content">
                    <form id="contact-form" method="POST" action="contact.php">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name='name' required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name='email' required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name='message' required></textarea>
                        </div>
                        <button type="submit">Envoyer</button>
                    </form>

                    <div class="contact-info">
                        <h2>Informations de contact :</h2>
                        <ul>
                            <li>Email: <?php echo $email; ?></li>
                            <li>LinkedIn: <?php echo $linkedin; ?></li>
                            <li>GitHub: <?php echo $github; ?></li>
                            <li>Téléphone: <?php echo $telephone; ?></li>
                            <li>Localisation: <?php echo $localisation; ?></li>
                        </ul>
                    </div>
                </div>

                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $post_nom = $_POST['name'];
                        $post_email = $_POST['email'];
                        $post_message = $_POST['message'];

                        require_once(__DIR__.'/../config/mysql.php');
                        $connexion = mysqli_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DB_NAME);

                        $sql = "INSERT INTO messages (`nom`, `email`, `message`) VALUES ('$post_nom', '$post_email', '$post_message')";

                        if (mysqli_query($connexion, $sql)) {
                            echo "<div class='success-message'>Nouveau message envoyé avec succès.</div>";
                        } else {
                            echo "<div class='error-message'>Erreur : " . $sql . "<br>" . mysqli_error($connexion) . "</div>";
                        }
                    }
                ?>
            </section>
        </div>

         <?php if ($hidePage): ?>
            <div class="messagess">
                Vous devez être connecté pour accéder à cette page. <a href="login.php">Se connecter</a>
            </div>
        <?php endif; ?>
    </main>
   

    <?php
    if (!isset($_SESSION['id'])) {
        
        $hidePage = true;  
        echo "<footer class='fixeddd'> <p>© 2024 Anthony Stark. Tous droits réservés.</p> </footer>";
    } else {
        $hidePage = false;  
        echo "<footer> <p>© 2024 Anthony Stark. Tous droits réservés.</p> </footer>";
        
    }
?>

</body>

</html>
