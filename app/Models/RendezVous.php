<?php

namespace App\Models;

use CodeIgniter\Model;

class RendezVous extends Model
{
    protected $table      = 'rendezvous';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'email', 'tele', 'address', 'city', 'cin', 'dateNaissance', 'rendezVous'];

     public function countByDate($date)
    {
        return $this->where('rendezVous', $date)->countAllResults();
    }
}
