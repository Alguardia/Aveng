<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Messages</title>
    <link rel="icon" href="https://logodix.com/logo/1918757.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>
<?php 
    session_start();
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        // Redirection si l'utilisateur n'est pas administrateur
        header('Location: ../index.php');
        exit();
    }

?>
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
                        <span class="user-name"><?php echo $_SESSION['prenom']; ?></span>
                        <div class="dropdown-content">
                        <a href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profil</a>
                            <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                            <a href="admin_panel.php">Messagerie</a>
                        <?php endif; ?>
                            <a href="logout.php">Déconnexion</a>
                        </div>
               
            </div>
        </div>
    </nav>

    <div id="titre_admin"><h1>Message reçu</h1></div>
    <?php



    require_once(__DIR__ . "/../config/mysql.php");
    require_once(__DIR__ . "/../config/databaseconnect.php");
 

    $messagesStatement = $mysqlClient->prepare("SELECT * from messages  ORDER BY time DESC");
    $messagesStatement->execute();
    $messages = $messagesStatement->fetchAll();

    foreach ($messages as $message) {
        $nom = $message['nom'];
        $email = $message['email'];
        $message_content = $message['message'];
        $time = $message['time'];
        

        echo "<div class='about-content1'>";
        echo "<div class='message-entry'>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($time) . "</p>"; 
        echo "<p><strong>Nom:</strong> " . htmlspecialchars($nom) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message_content)) . "</p>";
        echo "</div>";
        echo "</div>";
    }
    ?>


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