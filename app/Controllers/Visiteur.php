<?php

namespace App\Controllers;
use App\Models\ModeleUtilisateur;

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

            /* MEL et mot de passe OK : MEL est stocké en session */

            $MEL = $utilisateurRetourne->MEL;
            $NOM = $utilisateurRetourne->NOM;
            $PRENOM = $utilisateurRetourne->PRENOM;
            $NOCLIENT = $utilisateurRetourne->NOCLIENT;

            $session->set('MEL', $MEL);
            $session->set('NOM', $NOM);
            $session->set('PRENOM', $PRENOM);
            $session->set('NOCLIENT', $NOCLIENT);

            $data['MEL'] = $MEL;
            $data['NOM'] = $NOM;
            $data['PRENOM'] = $PRENOM;
            $data['TitreDeLaPage'] = "Accueil - Atlantik";

            $session->set('connecté', true);

            return view('Templates/Header', $data)

            . view('Visiteur/vue_connexionreussie')

            . view('Visiteur/vue_accueil')

            . view('Templates/Footer');

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

    public function register()
{
    helper(['form', 'url']);

    if ($this->request->is('post')) {

        // Règles de validation
        $reglesValidation = [
            'txtNom'            => 'required',
            'txtPrenom'         => 'required',
            'txtAdresse'        => 'required',
            'txtCodepostal'     => 'required|alpha_numeric',
            'txtVille'          => 'required',
            'txtTelephonefixe'  => 'required|alpha_numeric',
            'txtTelephonemobile'=> 'required|alpha_numeric',
            'txtMEL'            => 'required',
            'txtMotdepasse'     => 'required',
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
            'MEL'             => $this->request->getPost('txtMEL'),
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
        $data['TitreDeLaPage'] = 'Atlantik - Liaisons';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_liaisons')
                .view('Templates/Footer');
    }

    public function tarifs()
    {
        $data['TitreDeLaPage'] = 'Atlantik - Tarifs';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_tarifs')
                .view('Templates/Footer');
    }

    public function horaires()
    {
        $data['TitreDeLaPage'] = 'Atlantik - Horaires';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_horaires')
                .view('Templates/Footer');
    }

    public function reserver()
    {
        $data['TitreDeLaPage'] = 'Atlantik - Réservation';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_reserver')
                .view('Templates/Footer');
    }

    public function compterendu()
    {
        $data['TitreDeLaPage'] = 'Atlantik - Compte-Rendu';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_compterendu')
                .view('Templates/Footer');
    }

    public function historique()
    {
        $data['TitreDeLaPage'] = 'Atlantik - Historique';

        return view('Templates/Header', $data)
                .view('Visiteur/vue_historiquereservation')
                .view('Templates/Footer');
    }
}
