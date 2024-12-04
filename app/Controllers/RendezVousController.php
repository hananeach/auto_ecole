<?php

namespace App\Controllers;

use App\Models\RendezVous;

class RendezvousController extends BaseController
{
    public function index()
    {
        $RendezVousModel = new RendezVous();
        $data['rendezvous'] = $RendezVousModel->findAll();
        return view('RendezVous', $data);
    }

    public function ajouter()
    {
        $RendezVousModel = new RendezVous();

        $validation = $this->validate([
            'nom' => 'required',
            'email' => 'required|valid_email',
            'tele' => 'required|numeric',
            'address' => 'required',
            'city' => 'required',
            'cin' => 'required',
            'dateNaissance' => 'required|valid_date',
            'rendezVous' => 'required|valid_date',
        ]);

        if ($validation) {
            $date = $this->request->getPost('rendezVous');

            // Vérification si la date a déjà 3 rendez-vous
            if ($RendezVousModel->countByDate($date) < 3) {
                $data = [
                    'nom' => $this->request->getPost('nom'),
                    'email' => $this->request->getPost('email'),
                    'tele' => $this->request->getPost('tele'),
                    'address' => $this->request->getPost('address'),
                    'city' => $this->request->getPost('city'),
                    'cin' => $this->request->getPost('cin'),
                    'dateNaissance' => $this->request->getPost('dateNaissance'),
                    'rendezVous' => $date,
                ];

                $RendezVousModel->insert($data);
                return redirect()->to('/RendezVous')->with('success', 'Rendez-vous enregistré avec succès.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Ce rendez-vous est déjà complet.');
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function getUnavailableDates()
    {
        $RendezVousModel = new RendezVous();
        
        // Récupérer les dates où il y a plus de 3 rendez-vous
        $dates = $RendezVousModel
            ->select('rendezVous')
            ->groupBy('rendezVous')
            ->having('COUNT(rendezVous) >=', 3)
            ->findAll();
        
        // Retourner les dates en format JSON (pour utilisation avec AJAX)
        $unavailableDates = array_column($dates, 'rendezVous');
        
        // Vérifier si la requête est AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($unavailableDates);
        }
        
        // Si ce n'est pas une requête AJAX, renvoyer la vue avec les dates bloquées
        return view('RendezVous', ['unavailableDates' => $unavailableDates]);
    }

    
}
