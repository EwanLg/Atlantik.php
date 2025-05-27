<?php

namespace App\Controllers;
use App\Models\ModeleUtilisateur;
use App\Models\ModeleHoraires;
use App\Models\ModeleSecteur;
use App\Models\ModeleLiaisons;
use App\Models\ModeleTarifs;
use App\Models\ModeleReservations;

class Visiteur extends BaseController
{
    public function accueil()
    {
        $data['TitreDeLaPage'] = 'Atlantik - Accueil';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_accueil')
                .view('Templates/Footer');
    }

    public function seconnecter()
    {

        helper(['form']);

        $session = session();

 

        $data['TitreDeLaPage'] = 'Se connecter';

 

        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */

        if (!$this->request->is('post')) {

            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_seconnecter')
            . view('Templates/Footer');
        }

        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */

 

        /* VALIDATION DU FORMULAIRE */

        $reglesValidation = [ // Régles de validation
           'txtMEL' => 'required',
           'txtMotDePasse' => 'required',

        ];

        if (!$this->validate($reglesValidation)) {

            /* formulaire non validé */

            $data['TitreDeLaPage'] = "Saisie incorrecte";

            return view('Templates/Header', $data)

            . view('Visiteur/vue_seconnecter') // Renvoi formulaire de connexion

            . view('Templates/Footer');

        }

        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */

        /* RECHERCHE UTILISATEUR DANS BDD */

        $MEL = $this->request->getPost('txtMEL');

        $MdP = $this->request->getPost('txtMotDePasse');

 

        /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */

        $modUtilisateur = new ModeleUtilisateur(); // instanciation modèle

        $condition = ['MEL'=>$MEL,'motdepasse'=>$MdP];

        $utilisateurRetourne = $modUtilisateur->where($condition)->first();

        /* where : méthode, QueryBuilder, héritée de Model (), retourne,

        ici sous forme d'un objet, le résultat de la requête :

        SELECT * FROM utilisateur  WHERE MEL='$pId' and motdepasse='$MotdePasse

        utilisateurRetourne = objet utilisateur ($returnType = 'object')

        */

 

        if ($utilisateurRetourne != null) {
            $MEL = $utilisateurRetourne->MEL;
            $NOM = $utilisateurRetourne->NOM;
            $PRENOM = $utilisateurRetourne->PRENOM;
            $NOCLIENT = $utilisateurRetourne->NOCLIENT;
        
            $session->set('MEL', $MEL);
            $session->set('NOM', $NOM);
            $session->set('PRENOM', $PRENOM);
            $session->set('NOCLIENT', $NOCLIENT);
            $session->set('connecté', true);
        
            $redirectUrl = $session->get('redirect_after_login');
            if ($redirectUrl) {
                $session->remove('redirect_after_login');
                return redirect()->to($redirectUrl);
            } else {
                return redirect()->to('/');
            }

        } else {

            /* MEL et/ou mot de passe OK : on renvoie le formulaire  */

            $data['TitreDeLaPage'] = "MEL ou/et Mot de passe inconnu(s)";

            return view('Templates/Header', $data)

            . view('Visiteur/vue_seconnecter')

            . view('Templates/Footer');

        }

    } // Fin seConnecter

    public function sedeconnecter()
    {

        session()->destroy();

        $data['TitreDeLaPage'] = "Accueil - Atlantik";

        return view('Templates/Header', $data)

        . view('Visiteur/vue_deconnexionreussie')

        . view('Visiteur/vue_accueil')

        . view('Templates/Footer');

    } // Fin seDeconnecter

    public function register(){
        
    helper(['form', 'url']);

    if ($this->request->is('post')) {

        // Règles de validation
        $reglesValidation = [
            'txtNom'            => 'required|alpha_space|max_length[25]',
            'txtPrenom'         => 'required|alpha_space|max_length[25]',
            'txtAdresse'        => 'required|string|max_length[50]',
            'txtCodepostal'     => 'required|numeric|exact_length[5]',
            'txtVille'          => 'required|alpha_space|max_length[50]',
            'txtTelephonefixe'  => 'permit_empty|numeric|exact_length[10]',
            'txtTelephonemobile'=> 'permit_empty|numeric|exact_length[10]',
            'txtMEL'            => 'required|valid_email',
            'txtMotdepasse'     => 'required|min_length[5]',
        ];

        // Validation du formulaire
        if (!$this->validate($reglesValidation)) {
            // Formulaire non validé, afficher les erreurs et rediriger
            $data['TitreDeLaPage'] = "Formulaire invalide";

            return view('Templates/Header', $data)
                . view('Visiteur/vue_register')  // Rediriger vers le formulaire avec les erreurs
                . view('Templates/Footer');
        }

        // Si le formulaire est validé, préparer les données pour insertion
        $data = [
            'nom'             => $this->request->getPost('txtNom'),
            'prenom'          => $this->request->getPost('txtPrenom'),
            'adresse'         => $this->request->getPost('txtAdresse'),
            'codepostal'      => $this->request->getPost('txtCodepostal'),
            'ville'           => $this->request->getPost('txtVille'),
            'telephonefixe'   => $this->request->getPost('txtTelephonefixe'),
            'telephonemobile' => $this->request->getPost('txtTelephonemobile'),
            'mel'             => $this->request->getPost('txtMEL'),
            'motdepasse'      => $this->request->getPost('txtMotdepasse'),  // Sécurisation du mot de passe
        ];

        // Insérer l'utilisateur dans la base de données
        $modeleutilisateur = new ModeleUtilisateur();
        $modeleutilisateur->insert($data);

        $data['TitreDeLaPage'] = 'Se connecter';

        return view('Templates/Header', $data)
            . view('Visiteur/vue_registerreussi') // Afficher le message de succès
            . view('Visiteur/vue_seconnecter')  // Permettre à l'utilisateur de se connecter
            . view('Templates/Footer');
    }

    // Si pas de POST, renvoyer le formulaire d'inscription
    $data['TitreDeLaPage'] = 'Créer un compte';
    return view('Templates/Header', $data)
        . view('Visiteur/vue_register')  // Formulaire d'inscription
        . view('Templates/Footer');
}

public function moncompte()
{
    $session = session();
    $mel = $session->get('MEL');

    $modeleUtilisateur = new ModeleUtilisateur();
    $utilisateur = $modeleUtilisateur->where(['MEL' => $mel])->first();

    $data['TitreDeLaPage'] = 'Mon Compte';
    $data['utilisateur'] = $utilisateur;

    return view('Templates/Header', $data)
        . view('Visiteur/vue_compte')
        . view('Templates/Footer');
}

public function modifiermoncompte()
{
    helper(['form']);

    $session = session();

    // Récupérer l'id utilisateur en session (ici j'imagine que c’est noclient)
    // Adaptation possible selon ta gestion des sessions
    $noclient = $session->get('NOCLIENT'); 
    if (!$noclient) {
        return redirect()->to(site_url('seconnecter'));
    }

    // Règles de validation
    $reglesValidation = [
        'nom'       => 'required',
        'prenom'    => 'required',
        'adresse'   => 'required',
        'codepostal'=> 'required|alpha_numeric',
        'ville'     => 'required',
        'motdepasse'=> 'required',
        // Les téléphones sont optionnels, validation seulement si activés
    ];

    if (!$this->validate($reglesValidation)) {
        // Recharger le formulaire avec erreurs et données actuelles
        $modUtilisateur = new ModeleUtilisateur();
        $utilisateur = $modUtilisateur->find($noclient);

        $data['TitreDeLaPage'] = 'Modifier mes informations';
        $data['validation'] = $this->validator;
        $data['utilisateur'] = $utilisateur;

        return view('Templates/Header', $data)
            . view('Visiteur/vue_modifiermoncompte')
            . view('Templates/Footer');
    }

    // Récupérer les données POST
    $nom = $this->request->getPost('nom');
    $prenom = $this->request->getPost('prenom');
    $adresse = $this->request->getPost('adresse');
    $codepostal = $this->request->getPost('codepostal');
    $ville = $this->request->getPost('ville');
    $motdepasse = $this->request->getPost('motdepasse');

    // Gestion des téléphones avec cases à cocher
    $telephonefixe = $this->request->getPost('active_fixe') ? $this->request->getPost('telephonefixe') : null;
    $telephonemobile = $this->request->getPost('active_mobile') ? $this->request->getPost('telephonemobile') : null;

    // Préparer les données à mettre à jour
    $donnees = [
        'nom'             => $nom,
        'prenom'          => $prenom,
        'adresse'         => $adresse,
        'codepostal'      => $codepostal,
        'ville'           => $ville,
        'telephonefixe'   => $telephonefixe,
        'telephonemobile' => $telephonemobile,
        'motdepasse'      => $motdepasse,
    ];

    $modUtilisateur = new ModeleUtilisateur();

    // Mise à jour
    if ($modUtilisateur->update($noclient, $donnees)) {
        // Mise à jour des sessions NOM, PRENOM si besoin
        $session->set('NOM', $nom);
        $session->set('PRENOM', $prenom);

        $session->setFlashdata('success', 'Informations mises à jour avec succès.');

        return redirect()->to(site_url('moncompte'));
    } else {
        $session->setFlashdata('error', 'Une erreur est survenue lors de la mise à jour.');
        return redirect()->back()->withInput();
    }
}

public function liaisons()
{
    $modelliaison = new ModeleLiaisons();
    $liaisons = $modelliaison->getToutesLesLiaisonsAvecInfos();
 
    $data['TitreDeLaPage'] = 'Atlantik - Liaisons';
    $data['liaisons'] = $liaisons;

    return view('Templates/Header', $data)
         . view('Visiteur/vue_liaisons', $data)
         . view('Templates/Footer');
}

public function tarifs($noliaison)
{
    $modeltarifs = new ModeleTarifs();

    $liaison = $modeltarifs->getLiaison($noliaison);

    $periodes = $modeltarifs->getPeriodes();
    $tarifData = $modeltarifs->getTarifs($noliaison);

    // Organiser les tarifs par type
    $tarifs = [];
    foreach ($tarifData as $row) {
        $key = $row->LETTRECATEGORIE . '-' . $row->NOTYPE;
        if (!isset($tarifs[$key])) {
            $tarifs[$key] = (object)[
                'CATEGORIE' => $row->LETTRECATEGORIE,
                'CODETYPE' => $row->NOTYPE,
                'LIBELLETYPE' => $row->LIBELLETYPE,
                'prix' => [],
            ];
        }
        $tarifs[$key]->prix[] = (object)[
            'NOPERIODE' => $row->NOPERIODE,
            'tarif' => $row->TARIF
        ];
    }

    $data['TitreDeLaPage'] = 'Atlantik - Tarifs';

    return view('Templates/Header', $data)
        . view('Visiteur/vue_tarifs', [
            'liaison' => $liaison,
            'periodes' => $periodes,
            'tarifs' => array_values($tarifs)
        ])
        . view('Templates/Footer');
}

public function horaires()
{
    $modelHoraires = new ModeleHoraires();
    $modelSecteur = new ModeleSecteur();

    $data['TitreDeLaPage'] = 'Atlantik - Horaires';

    // 1. Récupérer tous les secteurs pour affichage à gauche
    $data['lesSecteurs'] = $modelSecteur->orderBy('nom')->findAll();

    // 2. Récupérer le secteur sélectionné (via lien), sinon prendre le 1er
    $secteur = $this->request->getGet('secteur');
    if (!$secteur && !empty($data['lesSecteurs'])) {
        $secteur = $data['lesSecteurs'][0]->NOSECTEUR;
    }
    $data['secteurActuel'] = $secteur;

    // 3. Récupérer les liaisons du secteur sélectionné
    $data['liaisons'] = $modelHoraires->getLesLiaisonsParSecteur($secteur);

    // 4. Si formulaire soumis pour afficher les traversées
    if ($this->request->getMethod() == 'GET') {
        $noLiaison = $this->request->getGET('noliaison');
        $date = $this->request->getGET('date');

        // a. Catégories (A/B/C...)
        $categories = $modelHoraires->getLesCategories();

        // b. Traversées du jour pour cette liaison
        $traversees = $modelHoraires->getLesTraverseesBateaux($noLiaison, $date);

        // c. Construction tableau traversées + places dispo
        $tableau = [];
        foreach ($traversees as $t) {
            $ligne = [
                'NOTRAVERSEE' => $t->NOTRAVERSEE,
                'HEURE' => $t->HEURE,
                'BATEAU' => $t->BATEAU,
                'places' => []
            ];

            foreach ($categories as $cat) {
                $capacite = $modelHoraires->getCapaciteMaximale($t->NOTRAVERSEE, $cat->LETTRECATEGORIE);
                $reserve = $modelHoraires->getQuantiteEnregistree($t->NOTRAVERSEE, $cat->LETTRECATEGORIE);
                $placesDispo = $capacite - $reserve;
                $ligne['places'][$cat->LETTRECATEGORIE] = $placesDispo;
            }

            $tableau[] = $ligne;
        }

        $data['categories'] = $categories;
        $data['tableauTraversees'] = $tableau;
        $data['dateChoisie'] = $date;
        $data['liaisonChoisie'] = $noLiaison;
        $data['secteurActuel'] = $secteur;
        $data['selectedSecteur'] = $secteur;
        $data['selectedLiaison'] = $noLiaison ?? '';
        $data['selectedDate'] = $date ?? '';
        $data['traversees'] = $traversees ?? [];
    }

    $data['selectedDate'] = $data['dateChoisie'] ?? '';
    $data['selectedLiaison'] = $data['liaisonChoisie'] ?? '';

    return view('Templates/Header', $data)
        . view('Visiteur/vue_horaires', $data)
        . view('Templates/Footer');
}

public function reservation($notraversee)
{
    $session = session();
    $mel = $session->get('MEL');

    $modeleUtilisateur = new ModeleUtilisateur();
    $utilisateur = $modeleUtilisateur->where(['MEL' => $mel])->first();

    $data['utilisateur'] = $utilisateur;

    $data['TitreDeLaPage'] = 'Atlantik - Réservation';
    $data['notraversee'] = $notraversee;

    // Récupération des infos client depuis la session
    $data['nom'] = $session->get('nom');
    $data['adresse'] = $session->get('adresse');
    $data['cp'] = $session->get('cp');
    $data['ville'] = $session->get('ville');

    return view('Templates/Header', $data)
        . view('Visiteur/vue_reservations', $data)
        . view('Templates/Footer');
}

public function validereservation()
{
    $reservationModel = new ModeleReservations();
    $session = session();

    $quantites = $this->request->getPost('quantite');
    $tarifs = $this->request->getPost('tarif');
    $types = $this->request->getPost('type');
    $notraversee = $this->request->getPost('notraversee');

    $total = 0;
    for ($i = 0; $i < count($quantites); $i++) {
        $total += $quantites[$i] * $tarifs[$i];
    }

    $data = [
        'NOTRAVERSEE' => $notraversee,
        'NOCLIENT' => $session->get('NOCLIENT'), // ID client en session
        'DATEHEURE' => date('Y-m-d H:i:s'),
        'MONTANTTOTAL' => $total,
        'PAYE' => 0,
    ];

    $reservationModel->insert($data);

    $session->set([
        'resume' => [], // On construit le résumé
        'montant' => $total,
        'date_reservation' => date('Y-m-d H:i:s'),
        'notraversee' => $notraversee
    ]);
    
    $resume = [];
    for ($i = 0; $i < count($quantites); $i++) {
    if ((int)$quantites[$i] > 0) {
        $resume[] = [
            'type' => $types[$i],
            'quantite' => (int)$quantites[$i],
            'tarif' => (float)$tarifs[$i],
        ];
        }
    }

    $session->set('resume', $resume);

    return redirect()->to('compterendu');
}

    public function compterendu()
{
    $session = session();
    $modeleUtilisateur = new ModeleUtilisateur();
    $mel = $session->get('MEL');

    $utilisateur = $modeleUtilisateur->where('MEL', $mel)->first();

    $data = [
        'TitreDeLaPage' => 'Atlantik - Compte-Rendu',
        'utilisateur' => $utilisateur,
        'notraversee' => $session->get('notraversee'),
        'montant' => $session->get('montant'),
        'date' => $session->get('date_reservation'),
        'resume' => $session->get('resume'),
        'portDepart' => 'Quiberon', // À rendre dynamique si tu veux
        'portArrivee' => 'Le Palais', // Idem
    ];

    return view('Templates/Header', $data)
        . view('Visiteur/vue_compterendu', $data)
        . view('Templates/Footer');

        $session->remove(['resume', 'montant', 'date_reservation', 'notraversee']);

}


    public function historique()
{
    $session = session();
    $noClient = $session->get('NOCLIENT');

    $model = new ModeleReservations();

    $toutesReservations = $model->getHistoriqueReservationsParClientPaginated($noClient)->get()->getResultArray();

    $parPage = 5;
    $page = (int) ($this->request->getGet('page') ?? 1);
    $total = count($toutesReservations);
    $reservations = array_slice($toutesReservations, ($page - 1) * $parPage, $parPage);

    $data = [
        'TitreDeLaPage' => 'Atlantik - Historique',
        'reservations' => $reservations,
        'pager' => [
            'total' => $total,
            'page' => $page,
            'parPage' => $parPage
        ]
    ];

    return view('Templates/Header', $data)
         . view('Visiteur/vue_historiquereservations', $data)
         . view('Templates/Footer');
}


}
