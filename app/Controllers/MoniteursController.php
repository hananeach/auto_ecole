<?php

namespace App\Controllers;
use App\Models\Moniteurs;
use App\Controllers\BaseController;

class MoniteursController extends BaseController
{
    public function index()
    {
        $moniteursModel = new Moniteurs();
        $data['moniteurs'] = $moniteursModel->findAll();
        
        return view('Moniteurs', $data); 
    }
    
   
    public function ajouter()
    {
        // Validation des données du formulaire
        $validation = $this->validate([
            'nom' => 'required',
            'cin' => 'required',
            'tele' => 'required',
            'type' => 'required', // 0 pour Théorique, 1 pour Pratique
            'dateCAP' => 'required|valid_date',
            'numCAP' => 'required',
        ]);

        if ($validation) {
            // Récupération des données du formulaire
            $data = [
                'nom' => $this->request->getPost('nom'),
                'cin' => $this->request->getPost('cin'),
                'tele' => $this->request->getPost('tele'),
                'type' => $this->request->getPost('type'),
                'dateCAP' => $this->request->getPost('dateCAP'),
                'numCAP' => $this->request->getPost('numCAP'),
            ];

            // Création du modèle et insertion dans la base de données
            $moniteursModel = new Moniteurs();
            $moniteursModel->insert($data);

            return redirect()->to('/Moniteurs'); 
        } else {
            // Gérer les erreurs de validation (afficher un message, rediriger, etc.)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
    public function supprimer($id)
{
    $moniteursModel = new Moniteurs();
    if ($moniteursModel->find($id)) {
        $moniteursModel->delete($id);
        return redirect()->to('/Moniteurs')->with('success', 'Moniteur supprimé avec succès.');
    } else {
        return redirect()->to('/Moniteurs')->with('errors', ['Moniteur introuvable.']);
    }
}

}
