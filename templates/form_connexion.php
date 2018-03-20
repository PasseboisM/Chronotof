<title>Connexion - Chronotof</title>
</head>
<body>
<?php include('morceaux/header.html'); ?>
<h1>Connexion</h1>
<main>
    <form method="post" action="index.php?page=connexion">
        <?php
        if (isset($verife)) {
            if ($verife) {
                echo '<p>Pseudo/Mot de passe incorect</p>';
            }
        }
        ?>
        <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" required autofocus>
        </div>
        <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>
        <div>
            <label for="connect">Rester connecté(e) :</label>
            <input type="checkbox" name="connect" id="connect" checked>
        </div>
        <input type="submit" value="Se connecter">
    </form>
</main>