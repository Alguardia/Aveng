<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        $hidePage = true;  
    } else {
        $hidePage = false;  
    }
?>

<?php
    require_once(__DIR__."/../config/mysql.php");
    require_once(__DIR__."/../config/databaseconnect.php");

    $aboutStatement = $mysqlClient->prepare("SELECT * FROM about");
    $aboutStatement->execute();
    $about = $aboutStatement->fetchAll();

    $description = $about[0]['description'];
    $parcour = $about[0]['parcour'];
    $competences = $about[0]['competences'];
    $competencesArray = explode(',', $competences);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Anthony Stark</title>
    <link rel="icon" href="https://logodix.com/logo/1918757.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/about.css">
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="logo">AS</div>
            <div class="nav-links">
                <a href="../index.php" >Accueil</a>
                <a href="about.php" class="active">À propos</a>
                <a href="contact.php">Contact</a>
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
            <section class="about">
                <h1>À propos de moi</h1>
                <div class="about-content">
                    <div class="about-text">
                        <p><?php echo $description ?></p>
                        <h2>Compétences :</h2>
                        <div class="skills">
                            <?php 
                                if ($competences) {
                                    foreach ($competencesArray as $competence) {
                                        echo "<div class='skill'>" . $competence . "</div>";
                                    }
                                } else {
                                    echo "Aucune compétence trouvée.";
                                }
                            ?>
                        </div>
                        <h2>Parcours :</h2>
                        <p><?php echo $parcour ?></p>
                    </div>
                </div>
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
