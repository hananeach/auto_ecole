<?php

namespace App\Models;

use CodeIgniter\Model;

class Moniteurs extends Model
{
    protected $table = 'moniteurs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'cin', 'tele', 'type', 'dateCAP', 'numCAP'];
}