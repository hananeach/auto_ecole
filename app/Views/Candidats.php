<?php $this->extend('layouts/admin'); ?>

<?php $this->section('dashboard_content'); ?>
<button class="nextBtn" id="ajouterCandidat"> <span class="btnText">Ajouter un candidat</span>  </button>


                            
<div class="formulaire">
    <div class="main-card">
        <div class="cards">
            <?php foreach ($candidats as $candidat): ?>
                <div class="card">
                    <div class="content">
                    <a href="#" class="icon-info" onclick="showDetails(<?= $candidat['id'] ?>)">
                            <span class="material-symbols-outlined">info</span>
                        </a>
                        <div class="img">
                            <img src="<?= base_url('uploads/' . esc($candidat['image'])) ?>" alt="Image">
                        </div>
                        <div class="details">
                        <div class="name"><?= esc($candidat['nom']) ?></div>
                            <div class="job"><?= esc($candidat['cin']) ?></div>
                            <div class="name"><?= esc($candidat['dateInscription']) ?></div>
                        </div>
                       
                        <div class="icon-container">
                            <a href="<?= base_url('Candidats/modifier/' . $candidat['id']) ?>" class="action-link">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <a href="<?= base_url('Candidats/supprimer/' . $candidat['id']) ?>" class="action-link" onclick="return confirm('Confirmer la suppression ?')">
                                <span class="material-symbols-outlined">delete</span>
                            </a>       
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="modal" class="modal" style="display: none;">

    <div class="modal-content">
    <span id="closeModal">&times;</span>
        <div id="candidat-details"></div>
    </div>
</div>

<div class="container" id="candidats_table" style="display: none;">
    <span class="close-btn" id="closeModal">&times;</span>
    <header>Ajouter un Candidat</header>
    <form action="/CandidatsA" method="post" enctype="multipart/form-data">
        <div class="form first">
            <div class="details personal">
                <div class="fields">
                    <div class="input-field">
                        <label>Nom complet:</label>
                        <input type="text" placeholder="Entrer ton nom ici.." id="nom" name="nom" required value="<?= old('nom') ?>">
                    </div>
                    <div class="input-field">
                        <label for="adresse">Adresse:</label>
                        <input type="text" placeholder="Entrer ton adresse ici.." id="adresse" name="adresse" required value="<?= old('adresse') ?>">
                    </div>
                    <div class="input-field">
                        <label>Date d'inscription:</label>
                        <input type="date" placeholder="Entrez la date de votre inscription" id="dateInscription" name="dateInscription" required value="<?= old('dateInscription') ?>">
                    </div>
                    <div class="input-field">
                        <label>Prix en DH:</label>
                        <input type="text" placeholder="Entrez le prix" id="prix" name="prix" required value="<?= old('prix') ?>">
                    </div>
                    <div class="input-field">
                        <label>Téléphone:</label>
                        <input type="number" placeholder="Entrez votre numéro de téléphone" id="tele" name="tele" required value="<?= old('tele') ?>">
                    </div>
                    <div class="input-field">
                        <label>CIN:</label>
                        <input type="text" placeholder="Entrez votre CIN" id="cin" name="cin" required value="<?= old('cin') ?>">
                    </div>
                    <div class="input-field">
                        <label>Age:</label>
                        <input type="number" placeholder="Entrez votre age" id="age" name="age" required value="<?= old('age') ?>">
                    </div>

                    <div class="input-field">
                        <label>Votre image:</label>
                        <input type="file" placeholder="Entrez votre image.." id="image" name="image" required>
                    </div>

                    <div class="input-field">
                        <select id="moniteur_pratique" name="moniteur_id_pratique" required>
                            <option disabled selected>Sélectionnez un moniteur pratique :</option>
                            <?php foreach ($moniteursPratique as $moniteur): ?>
                                <option value="<?= esc($moniteur['id']) ?>"
                                    <?= old('moniteur_id_pratique') == $moniteur['id'] ? 'selected' : '' ?>>
                                    <?= esc($moniteur['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select id="moniteur_theorique" name="moniteur_id_theorique" required>
                            <option disabled selected>Sélectionnez un moniteur théorique :</option>
                            <?php foreach ($moniteursTheorique as $moniteur): ?>
                                <option value="<?= esc($moniteur['id']) ?>"
                                    <?= old('moniteur_id_theorique') == $moniteur['id'] ? 'selected' : '' ?>>
                                    <?= esc($moniteur['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="details ID">
                <span class="title">Informations de moniteurs:</span>
                <div class="fields" id="moniteur_pratique_info">
                    <div class="input-field">
                        <label for="nom_moniteur_pratique">Nom :</label>
                        <input type="text" id="nom_moniteur_pratique" readonly value="<?= old('moniteur_pratique_nom') ?>">
                    </div>
                    <div class="input-field">
                        <label for="dateCAP_pratique">Date CAP :</label>
                        <input type="text" id="dateCAP_pratique" readonly value="<?= old('moniteur_pratique_dateCAP') ?>">
                    </div>
                    <div class="input-field">
                        <label for="numCAP_pratique">Numéro CAP :</label>
                        <input type="text" id="numCAP_pratique" readonly value="<?= old('moniteur_pratique_numCAP') ?>">
                    </div>
                </div>

                <div class="fields" id="moniteur_theorique_info">
                    <div class="input-field">
                        <label for="nom_moniteur_theorique">Nom :</label>
                        <input type="text" id="nom_moniteur_theorique" readonly value="<?= old('moniteur_theorique_nom') ?>">
                    </div>
                    <div class="input-field">
                        <label for="dateCAP_theorique">Date CAP :</label>
                        <input type="text" id="dateCAP_theorique" readonly value="<?= old('moniteur_theorique_dateCAP') ?>">
                    </div>
                    <div class="input-field">
                        <label for="numCAP_theorique">Numéro CAP :</label>
                        <input type="text" id="numCAP_theorique" readonly value="<?= old('moniteur_theorique_numCAP') ?>">
                    </div>
                </div>

                <button type="submit" class="nextBtn">
                    <span class="btnText">Ajouter</span>
                </button>
            </div>
        </div>
    </form>
</div>

    <script>
     const ajouterCandidatLink = document.getElementById('ajouterCandidat');
        const candidatsTable = document.getElementById('candidats_table');
        const closeModal = document.getElementById('closeModal');

        // Afficher le formulaire lorsque le lien est cliqué
        ajouterCandidatLink.addEventListener('click', (e) => {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            candidatsTable.style.display = 'block'; // Affiche le formulaire
        });

        // Fermer le formulaire lorsque le bouton de fermeture est cliqué
        closeModal.addEventListener('click', () => {
            candidatsTable.style.display = 'none'; // Cache le formulaire
        });

        // (Optionnel) Fermer le formulaire en cliquant en dehors de celui-ci
        window.addEventListener('click', (e) => {
            if (e.target === candidatsTable) {
                candidatsTable.style.display = 'none';
            }
        }); 


        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour mettre à jour les informations du moniteur
            function updateMoniteurInfo(moniteurId, type) {
                fetch('/path_to_get_moniteur_info/' + moniteurId)
                    .then(response => response.json())
                    .then(data => {
                        if (type === 'pratique') {
                            document.getElementById('nom_moniteur_pratique').value = data.nom || '';
                            document.getElementById('dateCAP_pratique').value = data.dateCAP || '';
                            document.getElementById('numCAP_pratique').value = data.numCAP || '';
                        } else if (type === 'theorique') {
                            document.getElementById('nom_moniteur_theorique').value = data.nom || '';
                            document.getElementById('dateCAP_theorique').value = data.dateCAP || '';
                            document.getElementById('numCAP_theorique').value = data.numCAP || '';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching moniteur data:', error);
                    });
            }

            // Event listener pour le changement de moniteur pratique
            document.getElementById('moniteur_pratique').addEventListener('change', function() {
                const moniteurId = this.value;
                if (moniteurId) {
                    updateMoniteurInfo(moniteurId, 'pratique');
                } else {
                    // Si aucun moniteur n'est sélectionné, réinitialiser les champs
                    document.getElementById('nom_moniteur_pratique').value = '';
                    document.getElementById('dateCAP_pratique').value = '';
                    document.getElementById('numCAP_pratique').value = '';
                }
            });

            function clearFields() {
                document.getElementById('nom_moniteur_pratique').value = '';
                document.getElementById('dateCAP_pratique').value = '';
                document.getElementById('numCAP_pratique').value = '';

                document.getElementById('nom_moniteur_theorique').value = '';
                document.getElementById('dateCAP_theorique').value = '';
                document.getElementById('numCAP_theorique').value = '';
            }

            // Réinitialisation des champs au démarrage
            clearFields();

            // Event listener pour le changement de moniteur théorique
            document.getElementById('moniteur_theorique').addEventListener('change', function() {
                const moniteurId = this.value;
                if (moniteurId) {
                    updateMoniteurInfo(moniteurId, 'theorique');
                } else {
                    // Si aucun moniteur n'est sélectionné, réinitialiser les champs
                    document.getElementById('nom_moniteur_theorique').value = '';
                    document.getElementById('dateCAP_theorique').value = '';
                    document.getElementById('numCAP_theorique').value = '';
                }
            });
        });

        function showDetails(candidatId) {
    // Effectuer une requête AJAX pour récupérer les détails du candidat
    fetch('<?= base_url('Candidats/getCandidatDetails/') ?>' + candidatId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données');
            }
            return response.json();
        })
        .then(data => {
            if (data && !data.error) {
                // Afficher les détails dans la div
                document.getElementById('candidat-details').innerHTML = `
                    <img src="<?= base_url('uploads/') ?>${data.image}" alt="Image du candidat" class="popup-image">
                    <div class="popup-info">
                        <div class="job"><strong>Nom:</strong> ${data.nom}</div>
                        <div class="job"><strong>CIN:</strong> ${data.cin}</div>
                        <div class="job"><strong>Date d'inscription:</strong> ${data.dateInscription}</div>
                        <div class="job"><strong>Téléphone:</strong> ${data.tele}</div>
                        <div class="job"><strong>Prix:</strong> ${data.prix}</div>
                        <div class="job"><strong>Age:</strong> ${data.age}</div>
                        <div class="job"><strong>Adresse:</strong> ${data.adresse}</div>
                        <div class="job"><strong>Moniteur Pratique:</strong> ${data.moniteur_pratique_nom || 'Non disponible'}</div>
                        <div class="job"><strong>Moniteur Théorique:</strong> ${data.moniteur_theorique_nom || 'Non disponible'}</div>
                    </div>
                `;
                // Afficher la boîte modale
                document.getElementById('modal').style.display = "block";
            } else {
                document.getElementById('candidat-details').innerHTML = '<div>Aucun détail trouvé.</div>';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            document.getElementById('candidat-details').innerHTML = '<div>Erreur lors de la récupération des détails.</div>';
        });
        document.getElementById('closeModal').onclick = function() {
        document.getElementById('modal').style.display = "none";
    }
    window.onclick = function(event) {
        const modal = document.getElementById('modal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
} </script>
   
    <?php $this->endSection(); ?>