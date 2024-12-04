<?php $this->extend('layouts/admin'); ?>

<?php $this->section('dashboard_content'); ?>

<div class="container2">

    <header>Modifier un Candidat</header>

    <form action="<?= base_url('Candidats/update/' . $candidat['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="form first">
            <div class="details personal">
                <div class="fields">
                    <div class="input-field">
                        <label>Nom complet:</label>
                        <input type="text" name="nom" value="<?= set_value('nom', $candidat['nom']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>Adresse:</label>
                        <input type="text" name="adresse" value="<?= set_value('adresse', $candidat['adresse']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>Date d'inscription:</label>
                        <input type="date" name="dateInscription" value="<?= set_value('dateInscription', $candidat['dateInscription']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>Prix en DH:</label>
                        <input type="number" name="prix" value="<?= set_value('prix', $candidat['prix']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>Téléphone:</label>
                        <input type="number" name="tele" value="<?= set_value('tele', $candidat['tele']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>CIN:</label>
                        <input type="text" name="cin" value="<?= set_value('cin', $candidat['cin']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>Age:</label>
                        <input type="number" name="age" value="<?= set_value('age', $candidat['age']) ?>" required>
                    </div>
                    <div class="input-field">
                        <label>Votre image:</label>
                        <?php if (!empty($candidat['image']) && file_exists(FCPATH . 'uploads/' . $candidat['image'])): ?>
                            <img id="previewImage" src="<?= base_url('uploads/' . $candidat['image']) ?>" alt="Image du candidat" style="max-width: 150px; max-height: 150px;">
                        <?php endif; ?>
                        <input type="file" name="image" id="imageInput">
                    </div>
                    <div class="details ID">
                    <span class="title">Informations de moniteurs:</span>
                    <div class="fields">
             <label>Moniteur Pratique:</label>
         <select name="moniteur_pratique_id" required>
        <?php foreach ($moniteursPratique as $moniteur): ?>
            <option value="<?= $moniteur['id'] ?>" <?= $moniteur['id'] == $candidat['moniteur_pratique_id'] ? 'selected' : '' ?>>
                <?= $moniteur['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

            <!-- <div class="input-field"> -->
                <label>Moniteur Théorique:</label>
                <select name="moniteur_theorique_id" required>
                    <?php foreach ($moniteursTheorique as $moniteur): ?>
                        <option value="<?= $moniteur['id'] ?>" <?= $moniteur['id'] == $candidat['moniteur_theorique_id'] ? 'selected' : '' ?>>
                            <?= $moniteur['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
 <button type="button" class="nextBtn" onclick="history.back();">
                    <span class="btnText">Retour</span>
                </button>
           
                    <button type="submit" class="nextBtn">
                    <span class="btnText">Modifier</span>
                </button>
               
                </div> 
            </div>

          
        </form>
</div>
<script>
    // Fonction pour mettre à jour l'aperçu de l'image
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Récupère le fichier sélectionné
        const previewImage = document.getElementById('previewImage'); // L'image à mettre à jour

        if (file) {
            const reader = new FileReader(); // Crée un lecteur de fichier
            reader.onload = function(e) {
                previewImage.src = e.target.result; // Met à jour la source de l'image
                previewImage.style.display = 'block'; // Affiche l'image (au cas où elle était cachée)
            };
            reader.readAsDataURL(file); // Lit le fichier sélectionné comme URL
        } else {
            // Si aucun fichier n'est sélectionné, cacher l'image
            previewImage.style.display = 'none';
        }
    });
</script>
<style>/* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');


.container2{
    position: relative;
    max-width: 900px;
    width: 100%;
    border-radius: 6px;
    padding: 30px;
    margin: 0 15px;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}
.container2 header{
    position: relative;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}
.container2 header::before{
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    height: 3px;
    width: 27px;
    border-radius: 8px;
    background-color: #4070f4;
}
.container2 form{
    position: relative;
    margin-top: 16px;
    min-height: 490px;
    background-color: #fff;
    overflow: hidden;
}
.container2 form .form{
    position: absolute;
    background-color: #fff;
    transition: 0.3s ease;
}


form.secActive .form.first{
    opacity: 0;
    pointer-events: none;
    transform: translateX(-100%);
}
.container2 form .title{
    display: block;
    margin-bottom: 8px;
    font-size: 16px;
    font-weight: 500;
    margin: 6px 0;
    color: #333;
}
.container2 form .fields{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
form .fields .input-field{
    display: flex;
    width: calc(100% / 3 - 15px);
    flex-direction: column;
    margin: 4px 0;
}
.input-field label{
    font-size: 12px;
    font-weight: 500;
    color: #2e2e2e;
}
.input-field input, select{
    outline: none;
    font-size: 14px;
    font-weight: 400;
    color: #333;
    border-radius: 5px;
    border: 1px solid #aaa;
    padding: 0 15px;
    height: 42px;
    margin: 8px 0;
}
.input-field input :focus,
.input-field select:focus{
    box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.input-field select,
.input-field input[type="date"]{
    color: #707070;
}
.input-field input[type="date"]:valid{
    color: #333;
}

.container2 form .btnText{
    font-size: 14px;
    font-weight: 400;
}
form button:hover{
    background-color: #265df2;
}

form .buttons{
    display: flex;
    align-items: center;
}

@media (max-width: 750px) {
    .container2 form{
        overflow-y: scroll;
    }
    .container2 form::-webkit-scrollbar{
       display: none;
    }
    form .fields .input-field{
        width: calc(100% / 2 - 15px);
    }
}

@media (max-width: 550px) {
    form .fields .input-field{
        width: 100%;
    }
}
.backBtn{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;
    max-width: 200px;
    width: 100%;
    border: none;
    outline: none;
    color: #fff;
    border-radius: 5px;
    margin: 25px 0;
    background-color: #4070f4;
    transition: all 0.3s linear;
    cursor: pointer;
}
</style>

<?php $this->endSection(); ?>