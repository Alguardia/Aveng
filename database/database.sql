-- Database Creation
CREATE DATABASE IF NOT EXISTS `site`;
USE `site`;

-- Table Creation
CREATE TABLE IF NOT EXISTS `projets` (
    `projet_id` INT AUTO_INCREMENT PRIMARY KEY,
    `projet_name` TEXT NOT NULL,
    `description` TEXT NOT NULL,
    `techno` TEXT NOT NULL,
    `fonction` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `about` (
    `description` TEXT NOT NULL,
    `parcour` TEXT NOT NULL,
    `competences` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `contact_info` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255),
    `linkedin` VARCHAR(255),
    `github` VARCHAR(255),
    `telephone` VARCHAR(20),
    `localisation` VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(30),
    `email` VARCHAR(50),
    `message` TEXT,
    `time` DATETIME DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `prenom` VARCHAR(30),
    `nom` VARCHAR(30),
    `username` VARCHAR(30),
    `password` VARCHAR(256),
    `admin` BOOLEAN
);

-- Removing Old Data
DELETE FROM `projets`;
DELETE FROM `about`;

-- Data Insertion
INSERT INTO `projets` (`projet_name`, `description`, `techno`, `fonction`)
VALUES 
('J.A.R.V.I.S', 
'J.A.R.V.I.S (Just A Rather Very Intelligent System) est un assistant virtuel conçu pour automatiser la gestion de projet et améliorer la productivité des équipes de développement.', 
'Node.js,OpenAI API,WebSocket,Express.js', 
'Analyse automatique du code, Suggestions doptimisation, Gestion des tâches intelligente, Intégration avec GitHub'),
('Mark Framework',
'Mark Framework est un framework JavaScript moderne conçu pour offrir des performances exceptionnelles et une expérience de développement optimale.',
'JavaScript,WebAssembly,Rust (compilation),WebGL',
'Rendu ultra-rapide,Support WebAssembly natif,Hot Module Replacement,Zero-config'),
('Projet Ultron',
'Ultron est un système de sécurité avancé utilisant l`intelligence artificielle pour détecter et prévenir les menaces en temps réel.',
'Python,TensorFlow,OpenCV,FastAPI',
'Détection d`anomalies,Analyse comportementale,Alertes en temps réel,Dashboard sécurisé'),
('F.R.I.D.A.Y',
'F.R.I.D.A.Y est une interface de gestion de tâches intelligente qui utilise l`apprentissage automatique pour optimiser la productivité.',
'React,Node.js,MongoDB,Socket.IO',
'Planification intelligente,Suggestions contextuelles,Collaboration en temps réel,Analyses prédictives'),
('Jerico',
'Jerico est un assistant virtuel conçu pour la gestion des missions et l’optimisation des performances des équipes de développement. Ce système permet de suivre l’avancement des projets, d`analyser les performances des tâches en temps réel, et de fournir des recommandations automatiques pour améliorer la productivité et la qualité des projets. Il intègre des outils modernes d`intelligence artificielle pour analyser les données de projet et propose des solutions intelligentes adaptées à chaque contexte. ',
'Node.js,OpenAI API,WebSocket,Express.js,MongoDB,GitHub API,Jest',
'Suivi de l`avancement des missions,Analyse en temps réel des performances,Recommandations automatiques,Gestion intelligente des tâches,Intégration avec GitLab/GitHub');

INSERT INTO `about` (`description`, `parcour`, `competences`)
VALUES
('Diplômé en génie informatique du MIT, je suis passionné par l`innovation technologique et le développement de solutions qui changent la vie des gens.',
'Avec plus de 5 ans d`expérience dans le développement fullstack, j`ai contribué à des projets innovants dans des domaines variés comme l`IA, la cybersécurité et le développement web',
'HTML/CSS/JS/PHP,Python,React,Node.js,AWS,Linux / Windows,Machine Learning');

INSERT INTO contact_info (email, linkedin, github, telephone, localisation)
VALUES ('anthony.stark@jarvis.com', '@anthonystark', '@Anthony-stark', '+33 07 38 68 59 85', 'Paris');

INSERT INTO `users` (`prenom`,`nom`,`username`,`password`,`admin`)
VALUES ('Bassem','Bama','root','4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2',true);