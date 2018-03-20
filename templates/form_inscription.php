<title>Inscription - Chronotof</title>
</head>
<body>
<?php include('morceaux/header.html'); ?>
<h1>Inscription</h1>
<main>
    <form method="post" action="">
        <?php
        if (isset($pseudoE)) {
            if ($pseudoE) {
                echo '<p>Pseudo déja utilisé, veuillez en choirsir un autre</p>';
            }
        }

        if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdpV']) && isset($_POST['email']) && isset($_POST['age'])) {
            if ($_POST['mdp'] !== $_POST['mdpV']) {
                echo '<p>Mots de passe différents</p>';
            }
        }
        ?>
        <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" required autofocus>
        </div>
        <div>
            <label for="mdp"
                <?php
                if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdpV']) && isset($_POST['email']) && isset($_POST['age'])) {
                    if ($_POST['mdp'] !== $_POST['mdpV']) {
                        echo 'style="color: red"';
                    }
                }
                ?>>Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>
        <div>
            <label for="mdpV" <?php
            if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdpV']) && isset($_POST['email']) && isset($_POST['age'])) {
                if ($_POST['mdp'] !== $_POST['mdpV']) {
                    echo 'style="color: red"';
                }
            }
            ?>>Confirmation du mot de passe :</label>
            <input type="password" name="mdpV" id="mdpV" required>
        </div>
        <div>
            <label for="email">E-mail :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="age">Âge :</label>
            <input type="number" name="age" id="age" min="3" max="120"/>
        </div>
        <div>
            <label for="connect">Rester connecté(e) :</label>
            <input type="checkbox" name="connect" id="connect" checked>
        </div>
        <input type="submit" value="S'incrire">
    </form>
</main>