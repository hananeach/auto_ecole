<?= $this->extend('layouts/admin'); ?>
<?= $this->section('dashboard_content'); ?>

<section class="container2">
   <header>Modifier un moniteur</header>
    <form action="/Moniteurs/update/<?= esc($moniteur['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="form first">
            <div class="details personal">
                <div class="fields">
                    <div class="input-field">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" value="<?= esc($moniteur['nom']) ?>" required>
                    </div>

                    <div class="input-field">
                        <label for="cin">CIN:</label>
                        <input type="text" id="cin" name="cin" value="<?= esc($moniteur['cin']) ?>" required>
                    </div>

                    <div class="input-field">
                        <label for="tele">Téléphone:</label>
                        <input type="text" id="tele" name="tele" value="<?= esc($moniteur['tele']) ?>" required>
                    </div>

                    <div class="input-field">
                        <label for="type">Type:</label>
                        <select id="type" name="type" required>
                            <option value="Pratique" <?= ($moniteur['type'] == 1) ? 'selected' : ''; ?>>Pratique</option>
                            <option value="Théorique" <?= ($moniteur['type'] == 0) ? 'selected' : ''; ?>>Théorique</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="dateCAP">Date C.A.P:</label>
                        <input type="date" id="dateCAP" name="dateCAP" value="<?= esc($moniteur['dateCAP']) ?>" required>
                    </div>

                    <div class="input-field">
                        <label for="numCAP">Numéro C.A.P:</label>
                        <input type="number" id="numCAP" name="numCAP" value="<?= esc($moniteur['numCAP']) ?>" required>
                    </div>
                </div> <!-- Fermeture de .fields -->
            </div> <!-- Fermeture de .details.personal -->
            
            <button type="button" class="nextBtn" onclick="history.back();">
                <span class="btnText">Retour</span>
            </button>
            
            <button type="submit" class="nextBtn">
                <span class="btnText">Modifier</span>
            </button>
        </div> <!-- Fermeture de .form.first -->
    </form>
</section>
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
<?= $this->endSection(); ?>