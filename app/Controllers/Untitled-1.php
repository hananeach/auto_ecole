<div class="formulaire">
    <div class="main-card">
        <div class="cards">
            <?php if (!empty($vehicules) && is_array($vehicules)): ?>
                <?php foreach ($vehicules as $vehicule): ?>
                    <div class="card">
                        <div class="content">
                            <div class="img">
                                <img src="<?= base_url('uploads/' . esc($vehicule['Image'])) ?>" alt="Image du véhicule">
                            </div>
                            <div class="details">
                                <div class="name"><?= esc($vehicule['Nom']) ?></div>
                                <div class="job">Modèle: <?= esc($vehicule['Modele']) ?></div>
                                <div class="job">Date d'achat: <?= esc($vehicule['DateAchat']) ?></div>
                                <div class="job">Matricule: <?= esc($vehicule['Matricule']) ?></div>
                            </div>
                            <div class="icon-container">
                                <a href="<?= base_url('Vehicules/modifier/' . $vehicule['id']) ?>" class="action-link">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <a href="<?= base_url('Vehicules/supprimer/' . $vehicule['id']) ?>" class="action-link" onclick="return confirm('Confirmer la suppression ?')">
                                    <span class="material-symbols-outlined">delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun véhicule trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>