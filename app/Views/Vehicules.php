<?php $this->extend('layouts/admin'); ?>

<?php $this->section('dashboard_content'); ?>
<main class="table" id="customers_table">
    <section class="table__header">
        <h1>Ajouter un Moniteur</h1>
        
        <!-- Formulaire Ajouter Moniteur en haut de la page -->
        <div class="add-moniteur-form">
        <form action="<?= base_url('/Vehicules/ajouter') ?>" method="post" enctype="multipart/form-data" class="form-inline">
        <?= csrf_field() ?>
            <label for="Image">Imgae:</label>
            <input type="file" id="Image" name="Image" required>
                <label for="Nom">Nom:</label>
                <input type="text" id="Nom" name="Nom" required>

                <label for="Modele">Modele:</label>
                <input type="number" id="Modele" name="Modele" required>

                <label for="DateAchat">DateAchat:</label>
                <input type="date" id="DateAchat" name="DateAchat" required>


                <label for="Matricule">Matricule:</label>
                <input type="text" id="Matricule" name="Matricule" required>


                <button type="submit" class="submit-btn">Ajouter</button>
            </form>
        </div>
        
        <!-- Champ de recherche -->
        <div class="input-group">
            <input type="search" placeholder="Rechercher..." />
            <img src="images/search.png" alt="search icon">
        </div>
    </section>

    <!-- Affichage des véhicules dans des cartes -->
    <section class="vehicle-cards">
    <?php if (!empty($vehicules)): ?>
        <?php foreach ($vehicules as $vehicule): ?>
            <div class="vehicle-card">
                <div class="img">
                <img src="<?= base_url('uploads/' . esc($vehicule['Image'])) ?>" alt="Image du véhicule" class="vehicle-image">
                </div>
                <h3 class="vehicle-name"><?= esc($vehicule['Nom']) ?></h3>
                <p><strong>Modèle:</strong> <?= esc($vehicule['Modele']) ?></p>
                <p><strong>Date d'achat:</strong> <?= esc($vehicule['DateAchat']) ?></p>
                <p><strong>Matricule:</strong> <?= esc($vehicule['Matricule']) ?></p>
                <div class="actions">
                <a href="<?= base_url('Vehicules/modifier/'.$vehicule['id']) ?>" class="btn-action">Modifier</a>

                  
                    <div class="actions">
    <a href="<?= base_url('/Vehicules/supprimer/' . $vehicule['id']) ?>" 
       onclick="return confirm('Voulez-vous vraiment supprimer ce véhicule ?');" 
       class="btn-action delete">
        Supprimer
    </a>
</div>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun véhicule trouvé.</p>
    <?php endif; ?>
</section>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= implode('<br>', session()->getFlashdata('errors')) ?>
        </div>
    <?php endif; ?>
</main>

<style>
/* Style des labels du formulaire */
.add-moniteur-form label {
    font-weight: bold;
    font-size: 0.9rem;
    color: #333;
    margin-right: 0.5rem;
}

/* Style des champs d'entrée du formulaire */
.add-moniteur-form input[type="text"],
.add-moniteur-form input[type="date"],
.add-moniteur-form input[type="number"] {
    width: 155px;
    padding: 0.6rem;
    border-radius: 0.3rem;
    border: 1px solid #ddd;
    transition: border-color 0.2s ease-in-out;
}

/* Effet focus pour les champs d'entrée */
.add-moniteur-form input[type="text"]:focus,
.add-moniteur-form input[type="date"]:focus,
.add-moniteur-form input[type="number"]:focus {
    border-color: deepskyblue;
    outline: none;
}

/* Bouton de soumission */
.add-moniteur-form .submit-btn {
    background-color: deepskyblue;
    color: white;
    padding: 0.7rem 1.2rem;
    border: none;
    border-radius: 0.3rem;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.2s ease-in-out;
}

.add-moniteur-form .submit-btn:hover {
    background-color: #5a00a3;
}

/* Styles des cartes pour afficher les véhicules */
.vehicle-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-evenly;
}

.vehicle-card {
    width: 350px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: white;
    text-align: center;
}

.vehicle-card h3 {
    margin-bottom: 15px;
    font-size: 1.1rem;
    color: #333;
}

.vehicle-card p {
    margin: 10px 0;
    color: #555;
}

.vehicle-card .actions {
    margin-top: 15px;
}

.vehicle-card .btn-action {
    background-color: #5a00a3;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.2s ease-in-out;
}

.vehicle-card .btn-action:hover {
    background-color: deepskyblue;
}

</style>

<link rel="stylesheet" href="/css/table.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<script src="script.js"></script>

<?php $this->endSection(); ?>
