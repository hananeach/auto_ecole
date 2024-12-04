<?php $this->extend('layouts/admin'); ?>

<?php $this->section('dashboard_content'); ?>
      
<div class="dashboard">
    <div class="card orange">
        <h3><?= $total_vehicules ?></h3>
        <p>Total Véhicules</p>
        <div class="footer">
            <span class="change-text">Voir plus</span>
            <span class="arrow">&#x2191;</span>
        </div>
    </div>
    <div class="card green">
        <h3><?= $total_moniteurs ?></h3>
        <p>Total Moniteurs</p>
        <div class="footer">
            <span class="change-text">Voir plus</span>
            <span class="arrow">&#x2191;</span>
        </div>
    </div>
    <div class="card red">
        <h3><?= $total_candidats ?></h3>
        <p>Total Candidats</p>
        <div class="footer">
            <span class="change-text">Voir plus</span>
            <span class="arrow">&#x2191;</span>
        </div>
    </div>


<?php $this->endSection(); ?>
