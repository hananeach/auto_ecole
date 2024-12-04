<?php  
namespace App\Controllers; 

use App\Models\Candidats; 
use App\Controllers\BaseController;  
use App\Models\Moniteurs;

class CandidatsController extends BaseController {    

    public function index()
    {
        $candidatsModel = new Candidats();
        $moniteursModel = new Moniteurs();
    
        // Récupération des candidats avec les informations des moniteurs
        $candidats = $candidatsModel->getCandidatsWithMoniteurs();

    // Récupération des moniteurs pratiques et théoriques
    $moniteursPratique = $moniteursModel->where('type', 'Pratique')->findAll();
    $moniteursTheorique = $moniteursModel->where('type', 'Théorique')->findAll();

    
        $data = [
            'candidats' => $candidats,
            'moniteursPratique' => $moniteursPratique,
            'moniteursTheorique' => $moniteursTheorique,
        ];
    
        return view('Candidats', $data);
    }
    public function getMoniteurInfo($id)
{
    $moniteursModel = new Moniteurs();
    $moniteur = $moniteursModel->find($id); // Trouver le moniteur par ID

    if ($moniteur) {
        return $this->response->setJSON($moniteur); // Retourner les données au format JSON
    }

    return $this->response->setJSON([]); // Retourner un tableau vide si le moniteur n'existe pas
}

    
public function ajouter() {
    $moniteursModel = new Moniteurs();
    
    // Récupérer les premiers moniteurs pratique et théorique disponibles
    $moniteurPratique = $moniteursModel->where('type', 'Pratique')->first(); // Type "Pratique"
    $moniteurTheorique = $moniteursModel->where('type', 'Théorique')->first(); // Type "Théorique"
    
    // Vérifier si les moniteurs existent
    if (!$moniteurPratique || !$moniteurTheorique) {
        return redirect()->back()->with('errors', ['Moniteur pratique ou théorique non disponible.']);
    }

    $validation = $this->validate([
        'nom' => 'required',
        'cin' => 'required',
        'tele' => 'required',
        'image' => 'uploaded[image]|is_image[image]|max_size[image,1024]',
        'dateInscription' => 'required|valid_date',
        'prix' => 'required|numeric',       
        'age' => 'required|integer',       
        'adresse' => 'required',
    ]);

    if ($validation) {
        // Récupérer et traiter l'image
        $imageFile = $this->request->getFile('image');
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            // Définir un nom unique pour l'image
            $imageName = $imageFile->getRandomName();
            // Déplacer l'image dans un dossier (par exemple "uploads/")
            $imageFile->move(FCPATH . 'uploads', $imageName);

            // Récupérer les autres données du formulaire
            $data = [
                'nom' => $this->request->getPost('nom'),
                'cin' => $this->request->getPost('cin'),
                'tele' => $this->request->getPost('tele'),
                'image' => $imageName, // Stocker le nom de l'image
                'dateInscription' => $this->request->getPost('dateInscription'),
                'prix' => $this->request->getPost('prix'),
                'age' => $this->request->getPost('age'),
                'adresse' => $this->request->getPost('adresse'),
                'moniteur_pratique_id' => $moniteurPratique['id'], // Associer au moniteur pratique
                'moniteur_theorique_id' => $moniteurTheorique['id'], // Associer au moniteur théorique
            ];

            // Insérer les données dans la base de données
            $candidatsModel = new Candidats();
            $candidatsModel->insert($data);

            return redirect()->to('/Candidats')->with('success', 'Candidat ajouté avec succès !');
        } else {
            return redirect()->back()->withInput()->with('errors', ['Erreur lors du téléchargement de l\'image.']);
        }
    } else {
        // Gérer les erreurs de validation
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}

    public function supprimer($id) {     
        $candidatsModel = new Candidats();     
        if ($candidatsModel->find($id)) {         
            $candidatsModel->delete($id);         
            return redirect()->to('/Candidats')->with('success', 'Candidat supprimé avec succès.');     
        } else {         
            return redirect()->to('/Candidats')->with('errors', ['Candidat introuvable.']);     
        } 
    }  
    public function modifier($id) {
        helper('form');
        $candidatsModel = new Candidats();
        $candidat = $candidatsModel->find($id);
    
        if (!$candidat) {
            return redirect()->to('/Candidats')->with('errors', ['Candidat introuvable.']);
        }
    
        // Récupération des moniteurs pratiques et théoriques pour le formulaire
        $moniteursModel = new Moniteurs();
        $moniteursPratique = $moniteursModel->where('type', 'Pratique')->findAll();
        $moniteursTheorique = $moniteursModel->where('type', 'Théorique')->findAll();
    
        $data = [
            'candidat' => $candidat,
            'moniteursPratique' => $moniteursPratique,
            'moniteursTheorique' => $moniteursTheorique,
        ];
    
        return view('modifierCandidat', $data);
    }
    
    public function update($id) {
        $candidatsModel = new Candidats();
        $moniteursModel = new Moniteurs();
    
        // Vérifier si le candidat existe
        $candidat = $candidatsModel->find($id);
        if (!$candidat) {
            return redirect()->to('/Candidats')->with('errors', ['Candidat introuvable.']);
        }
    
        $validation = $this->validate([
            'nom' => 'required',
            'cin' => 'required',
            'tele' => 'required',
            'image' => 'if_exist|uploaded[image]|is_image[image]|max_size[image,1024]',
            'dateInscription' => 'required|valid_date',
            'prix' => 'required|numeric',
            'age' => 'required|integer',
            'adresse' => 'required',
            'moniteur_pratique_id' => 'required|integer|is_not_unique[moniteurs.id]',
            'moniteur_theorique_id' => 'required|integer|is_not_unique[moniteurs.id]'
        ]);
    
        if ($validation) {
            $data = [
                'nom' => $this->request->getPost('nom'),
                'cin' => $this->request->getPost('cin'),
                'tele' => $this->request->getPost('tele'),
                'dateInscription' => $this->request->getPost('dateInscription'),
                'prix' => $this->request->getPost('prix'),
                'age' => $this->request->getPost('age'),
                'adresse' => $this->request->getPost('adresse'),
                'moniteur_pratique_id' => $this->request->getPost('moniteur_pratique_id'),
                'moniteur_theorique_id' => $this->request->getPost('moniteur_theorique_id')
            ];
    
            // Gestion de l'image
            $imageFile = $this->request->getFile('image');
            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $imageName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads', $imageName);
                $data['image'] = $imageName;
    
                // Supprimer l'ancienne image si elle existe
                if (!empty($candidat['image']) && file_exists(FCPATH . 'uploads/' . $candidat['image'])) {
                    unlink(FCPATH . 'uploads/' . $candidat['image']);
                }
            }
    
            // Mise à jour des données dans la base
            $candidatsModel->update($id, $data);
    
            return redirect()->to('/Candidats')->with('success', 'Candidat modifié avec succès.');
        } else {
            // Gestion des erreurs de validation
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
    
    public function getCandidatDetails($id)
    {
        $candidatsModel = new Candidats();
        $moniteursModel = new Moniteurs();
    
        // Récupérer le candidat
        $candidat = $candidatsModel->find($id);
    
        if ($candidat) {
            // Récupérer les moniteurs associés (pratique et théorique)
            $moniteurPratique = $moniteursModel->find($candidat['moniteur_pratique_id']);
            $moniteurTheorique = $moniteursModel->find($candidat['moniteur_theorique_id']);
    
            // Préparer les données à renvoyer au format JSON
            $data = [
                'id' => $candidat['id'],
                'nom' => $candidat['nom'],
                'cin' => $candidat['cin'],
                'tele' => $candidat['tele'],
                'image' => $candidat['image'],
                'dateInscription' => $candidat['dateInscription'],
                'prix' => $candidat['prix'],
                'age' => $candidat['age'],
                'adresse' => $candidat['adresse'],
                'moniteur_pratique_nom' => $moniteurPratique ? $moniteurPratique['nom'] : null,
                'moniteur_theorique_nom' => $moniteurTheorique ? $moniteurTheorique['nom'] : null,
            ];
    
            // Retourner les données en JSON
            return $this->response->setJSON($data);
        } else {
            // Candidat non trouvé
            return $this->response->setJSON(['error' => 'Candidat non trouvé']);
        }
    }
    
}