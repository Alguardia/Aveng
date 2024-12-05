<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Framework - Anthony Stark</title>
    <link rel="icon" href="https://logodix.com/logo/1918757.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/projects.css">
</head>
<body>
    <?php 
        session_start();
          require_once(__DIR__."/../config/mysql.php");
          require_once(__DIR__."/../config/databaseconnect.php");
        $markStatement = $mysqlClient->prepare("SELECT * FROM projets WHERE projet_name='Mark Framework'");
        $markStatement->execute();
        $mark = $markStatement->fetchAll();
        $name = $mark[0]['projet_name'];
        $description = $mark[0]['description'];
        $technoString = $mark[0]['techno'];
        $technoArray = explode(',', $technoString);
        $fonctionString = $mark[0]['fonction'];
        $fonctionArray = explode(',', $fonctionString);
    ?>
    <?php
    if (!isset($_SESSION['id'])) {
        
        $hidePage = true;  
    } else {
        $hidePage = false;  
        
    }
?>

<nav>
    <div class="nav-content">
        <div class="logo">AS</div>
        <div class="nav-links">
            <a href="../index.php" class="active">Accueil</a>
            <a href="../pages/about.php">À propos</a>
            <a href="../pages/contact.php">Contact</a>
        </div>
        <div class="nav-img">
            <img src="../images/user.png" alt="User Icon" class="user-icon">
            <div class="dropdown">
                <?php if ($hidePage == false): ?>
                    <span class="user-name"><?php echo $_SESSION['prenom']; ?></span>
                    <div class="dropdown-content">
                        <a href="../pages/profile.php?id=<?php echo $_SESSION['id']; ?>">Profil</a>
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                            <a href="../pages/admin_panel.php">Messagerie</a>
                        <?php endif; ?>
                        <a href="../pages/logout.php">Déconnexion</a>
                        
                    </div>
                <?php else: ?>
                    <a href="../pages/login.php" class="login-link">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
    <main>
    <div class="page-content <?php echo $hidePage ? 'hidden' : ''; ?>">
        <article class="project-details">
            <header class="project-header">
                <h1><?php echo $name?></h1>
                <p class="project-subtitle">Framework JavaScript nouvelle génération</p>
            </header>

            <section class="project-overview">
                <div class="project-image">
                    <img src="../images/mark.jpg" alt="Mark Framework Demo" id="mark_img">
                </div>
                <div class="project-description">
                    <h2>Vue d'ensemble</h2>
                    <p><?php echo $description?></p>
                    
                    <h3>Technologies utilisées</h3>

                    <?php 
                        if ($technoString) {
                            echo "<ul class='tech-list'>";
                            foreach ($technoArray as $techno) {
                                echo "<li>" . $techno . "</li>";
                            }
                            echo "</ul>";
                        }
                        else {
                            echo "Aucune technologie trouvée.";
                        }
                    ?>

                    <h3>Caractéristiques</h3>
                    <?php 
                        if ($fonctionString) {
                            echo "<ul>";
                            foreach ($fonctionArray as $fonction) {
                                echo "<li>" . $fonction . "</li>";
                            }
                            echo "</ul>";
                        }
                        else {
                            echo "Aucune fonctionnalitée trouvée.";
                        }
                    ?>
                </div>
            </section>

            <section class="project-details-section">
                <h2>Exemple d'utilisation</h2>
                <div class="code-example">
                    <pre><code>
import { createApp } from 'mark-framework';

const app = createApp({
    state: {
        count: 0
    },
    template: `
        <div>
            <h1>{{ count }}</h1>
            <button @click="increment">+1</button>
        </div>
    `,
    methods: {
        increment() {
            this.count++;
        }
    }
});

app.mount('#app');
                    </code></pre>
                </div>
            </section>
        </article>
    </div>
    </main>
    <?php if ($hidePage): ?>
        <div class="messagess">
            Vous devez être connecté pour accéder à cette page. <a href="pages/login.php">Se connecter</a>
        </div>
    <?php endif; ?>

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