<?php if (!empty($utilisateurs)) : ?>
    <h1>Navigation entre les utilisateurs</h1>
    <div id="userContainer">
        <!-- L'utilisateur actif sera affiché ici -->
        <h2 id="userName"><?= htmlspecialchars($utilisateurs[0]['UTILISATEUR_NOM'] . ' ' . $utilisateurs[0]['UTILISATEUR_PRENOM']) ?></h2>
        <p id="userEmail"><?= htmlspecialchars($utilisateurs[0]['UTILISATEUR_MAIL']) ?></p>
    </div>
    <div class="navigation-buttons">
        <button id="prevButton" onclick="showPrevious()">Précédent</button>
        <button id="nextButton" onclick="showNext()">Suivant</button>
    </div>

    <script>
        // Tableau PHP converti en tableau JS
        const users = [
            <?php foreach ($utilisateurs as $user) : ?>
                {
                    name: '<?= addslashes($user['UTILISATEUR_NOM'] . ' ' . $user['UTILISATEUR_PRENOM']) ?>',
                    email: '<?= addslashes($user['UTILISATEUR_MAIL']) ?>'
                },
            <?php endforeach; ?>
        ];

        let currentIndex = 0; // Index de l'utilisateur actif

        // Références des éléments DOM
        const userName = document.getElementById("userName");
        const userEmail = document.getElementById("userEmail");
        const prevButton = document.getElementById("prevButton");
        const nextButton = document.getElementById("nextButton");

        // Fonction pour mettre à jour l'affichage
        function updateDisplay() {
            userName.textContent = users[currentIndex].name;
            userEmail.textContent = users[currentIndex].email;

            // Activer ou désactiver les boutons en fonction de la position
            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex === users.length - 1;
        }

        // Fonction pour afficher l'utilisateur précédent
        function showPrevious() {
            if (currentIndex > 0) {
                currentIndex--;
                updateDisplay();
            }
        }

        // Fonction pour afficher l'utilisateur suivant
        function showNext() {
            if (currentIndex < users.length - 1) {
                currentIndex++;
                updateDisplay();
            }
        }

        // Initialiser l'affichage
        updateDisplay();
    </script>
<?php else : ?>
    <p>Aucun utilisateur trouvé.</p>
<?php endif; ?>

<a href="?action=create">Ajouter un utilisateur</a>
