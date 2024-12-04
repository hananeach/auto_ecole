<?php

namespace App\Controllers;

use App\Models\Vehicules;
use CodeIgniter\Controller;

class VehiculesController extends Controller
{
    public function index()
    {
        $vehiculeModel = new Vehicules();
        $data['vehicules'] = $vehiculeModel->findAll();

        return view('Vehicules', $data);
    }

    public function ajouter()
    {
        $validation = $this->validate([
            'Nom' => 'required|string|max_length[100]',
            'Image' => 'uploaded[Image]|is_image[Image]|max_size[Image,1024]',
            'Modele' => 'required|integer',
            'DateAchat' => 'required|valid_date',
            'Matricule' => 'required|string|max_length[100]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageFile = $this->request->getFile('Image');
        $imageName = $imageFile->getRandomName();
        $imageFile->move(FCPATH . 'uploads', $imageName);

        $data = [
            'Nom' => $this->request->getPost('Nom'),
            'Image' => $imageName,
            'Modele' => $this->request->getPost('Modele'),
            'DateAchat' => $this->request->getPost('DateAchat'),
            'Matricule' => $this->request->getPost('Matricule'),
        ];

        $vehiculeModel = new Vehicules();
        $vehiculeModel->insert($data);

        return redirect()->to('/Vehicules')->with('success', 'Véhicule ajouté avec succès.');
    }
    public function supprimer($id)
{
    // Charger le modèle
    $vehiculeModel = new \App\Models\Vehicules();

    // Vérifier si le véhicule existe
    $vehicule = $vehiculeModel->find($id);
    if ($vehicule) {
        // Supprimer le fichier d'image si nécessaire
        $imagePath = FCPATH . 'uploads/' . $vehicule['Image'];
        if (is_file($imagePath)) {
            unlink($imagePath); // Supprime le fichier
        }

        // Supprimer l'entrée dans la base de données
        $vehiculeModel->delete($id);

        // Redirection avec message de succès
        return redirect()->to('/Vehicules')->with('success', 'Véhicule supprimé avec succès.');
    } else {
        // Redirection avec message d'erreur
        return redirect()->to('/Vehicules')->with('errors', ['Véhicule introuvable.']);
    }
}
public function modifier($id)
{
    $VehiculesModel = new Vehicules();
    $Vehicules = $VehiculesModel->find($id);

    if (!$Vehicules) {
        return redirect()->to('/Vehicules')->with('errors', ['Vehicules introuvable.']);
    }

    $data['Vehicules'] = $Vehicules;
    return view('ModifierVehicules', $data);
}
public function update($id)
{
    $vehiculeModel = new Vehicules();
    $vehicule = $vehiculeModel->find($id);

    if (!$vehicule) {
        return redirect()->to('/Vehicules')->with('errors', ['Véhicule introuvable.']);
    }

    // Validation des champs
    $validation = $this->validate([
        'Nom' => 'required|string|max_length[100]',
        'Modele' => 'required|integer',
        'DateAchat' => 'required|valid_date',
        'Matricule' => 'required|string|max_length[100]',
        'Image' => 'if_exist|uploaded[Image]|is_image[Image]|max_size[Image,1024]', // Validation facultative pour l'image
    ]);

    if (!$validation) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Traitement de l'image si elle est téléchargée
    $imageFile = $this->request->getFile('Image');
    if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
        // Supprimer l'ancienne image si elle existe
        $oldImagePath = FCPATH . 'uploads/' . $vehicule['Image'];
        if (is_file($oldImagePath)) {
            unlink($oldImagePath);
        }

        $newImageName = $imageFile->getRandomName();
        $imageFile->move(FCPATH . 'uploads', $newImageName);
        $vehicule['Image'] = $newImageName;
    }

    // Mise à jour des données
    $vehicule['Nom'] = $this->request->getPost('Nom');
    $vehicule['Modele'] = $this->request->getPost('Modele');
    $vehicule['DateAchat'] = $this->request->getPost('DateAchat');
    $vehicule['Matricule'] = $this->request->getPost('Matricule');

    $vehiculeModel->update($id, $vehicule);

    return redirect()->to('/Vehicules')->with('success', 'Véhicule mis à jour avec succès.');
}


}
