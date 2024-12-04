<?php

namespace App\Controllers;

use App\Models\Candidats;
use App\Models\Moniteurs;
use App\Models\Vehicules;
use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


 class DashboardController extends Controller
{
    public function index()
    {
        $moniteurModel = new Moniteurs();
        $candidatModel = new Candidats();
        $vehiculeModel = new Vehicules();

        $data['total_moniteurs'] = $moniteurModel->countAllResults();
        $data['total_candidats'] = $candidatModel->countAllResults();
        $data['total_vehicules'] = $vehiculeModel->countAllResults();

        return view('dashboard', $data);
    }
 
}
