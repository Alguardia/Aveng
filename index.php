<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anthony Stark - Développeur Fullstack</title>
    <link rel="icon" href="https://logodix.com/logo/1918757.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php
    session_start();
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
            <a href="pages/about.php">À propos</a>
            <a href="pages/contact.php">Contact</a>
        </div>
        <div class="nav-img">
            <img src="images/user.png" alt="User Icon" class="user-icon">
            <div class="dropdown">
                <?php if ($hidePage == false): ?>
                    <span class="user-name"><?php echo $_SESSION['prenom']; ?></span>
                    <div class="dropdown-content">
                        <a href="pages/profile.php?id=<?php echo $_SESSION['id']; ?>">Profil</a>
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                            <a href="pages/admin_panel.php">Messagerie</a>
                        <?php endif; ?>
                        <a href="pages/logout.php">Déconnexion</a>
                        
                    </div>
                <?php else: ?>
                    <a href="pages/login.php" class="login-link">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
 
    <main>
    <div class="page-content <?php echo $hidePage ? 'hidden' : ''; ?>">
        <main>
            <section class="hero">
                <div class="hero-content">
                    <h1>Anthony Stark</h1>
                    <h2>Développeur Fullstack & Innovateur</h2>
                    <p>Créateur de solutions technologiques avancées</p>
                    <button class="download-btn">
                        <a class="download2-btn" href="CV-Anthony_STARK.pdf">Télécharger CV</a>
                    </button>
                </div>
            </section>

            <section id="education">
                <h2>Parcours</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <h3>Master en Sécurité Informatique</h3>
                        <p>École Supérieure d'Ingénierie Numérique - 2022</p>
                    </div>
                    <div class="timeline-item">
                        <h3>Bachelor en Développement Full Stack</h3>
                        <p>Institut Technologique de Digital Innovation - 2020</p>
                    </div>
                </div>
            </section>

            <section class="projects">
                <h2>Projets Innovants</h2>
                <div class="project-grid">
                    <div class="project-card" onclick="window.location.href='projects/jarvis.php'">
                        <h3>J.A.R.V.I.S</h3>
                        <p>Assistant virtuel intelligent pour la gestion de projet</p>
                        <span class="tech-stack">Node.js • AI • API</span>
                    </div>
                    <div class="project-card" onclick="window.location.href='projects/mark.php'">
                        <h3>Mark Framework</h3>
                        <p>Framework JavaScript hautement performant</p>
                        <span class="tech-stack">JavaScript • WebAssembly</span>
                    </div>
                    <div class="project-card" onclick="window.location.href='projects/ultron.php'">
                        <h3>Projet Ultron</h3>
                        <p>Système de sécurité automatisé</p>
                        <span class="tech-stack">Python • Machine Learning</span>
                    </div>
                    <div class="project-card" onclick="window.location.href='projects/friday.php'">
                        <h3>F.R.I.D.A.Y</h3>
                        <p>Interface de gestion de tâches intelligente</p>
                        <span class="tech-stack">React • Node.js</span>
                    </div>
                    <div class="project-card" onclick="window.location.href='projects/jerico.php'">
                        <h3>Jerico</h3>
                        <p>Assistant virtuel conçu pour la gestion des missions</p>
                        <span class="tech-stack">React • Node.js</span>
                    </div>
                </div>
            </section>
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