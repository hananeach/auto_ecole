<?php

namespace App\Models;

use CodeIgniter\Model;

class Vehicules extends Model
{
    protected $table = 'vehicules';
    protected $primaryKey = 'id';

    // Les champs qui peuvent être insérés ou mis à jour
    protected $allowedFields = [
        'Image', 'Nom', 'Modele', 'DateAchat', 'Matricule', 'created_at', 'updated_at'
    ];
   
}