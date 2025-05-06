<?php

namespace App\Controllers;

class Visiteur extends BaseController
{
    public function accueil()
    {
        return view('Templates/Header')
                .view('Visiteur/vue_accueil')
                .view('Templates/Footer');
    }

    public function seConnecter()
    {

        helper(['form']);

        $session = session();

 

        $data['TitreDeLaPage'] = 'Se connecter';

 

        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */

        if (!$this->request->is('post')) {

            return view('Templates/Header', $data) // Renvoi formulaire de connexion

            . view('Visiteur/vue_SeConnecter')

            . view('Templates/Footer');

        }

        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */

 

        /* VALIDATION DU FORMULAIRE */

        $reglesValidation = [ // Régles de validation

            'txtIdentifiant' => 'required',

            'txtMotDePasse' => 'required',

        ];

        if (!$this->validate($reglesValidation)) {

            /* formulaire non validé */

            $data['TitreDeLaPage'] = "Saisie incorrecte";

            return view('Templates/Header', $data)

            . view('Visiteur/vue_SeConnecter') // Renvoi formulaire de connexion

            . view('Templates/Footer');

        }

        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */

        /* RECHERCHE UTILISATEUR DANS BDD */

        $Identifiant = $this->request->getPost('txtIdentifiant');

        $MdP = $this->request->getPost('txtMotDePasse');

 

        /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */

        $modUtilisateur = newModeleUtilisateur(); // instanciation modèle

        $condition = ['identifiant'=>$Identifiant,'motdepasse'=>$MdP];

        $utilisateurRetourne = $modUtilisateur->where($condition)->first();

        /* where : méthode, QueryBuilder, héritée de Model (), retourne,

        ici sous forme d'un objet, le résultat de la requête :

        SELECT * FROM utilisateur  WHERE identifiant='$pId' and motdepasse='$MotdePasse

        utilisateurRetourne = objet utilisateur ($returnType = 'object')

        */

 

        if ($utilisateurRetourne != null) {

            /* identifiant et mot de passe OK : identifiant et profil sont stockés en session */

            $session->set('identifiant', $utilisateurRetourne->identifiant);

            $session->set('profil', $utilisateurRetourne->profil);

            // profil = "SuperAdministrateur ou "Administrateur"

            $data['Identifiant'] = $Identifiant;

            echo view('Templates/Header', $data);

            echo view('Visiteur/vue_ConnexionReussie');

        } else {

            /* identifiant et/ou mot de passe OK : on renvoie le formulaire  */

            $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";

            return view('Templates/Header', $data)

            . view('Visiteur/vue_SeConnecter')

            . view('Templates/Footer');

        }

    } // Fin seConnecter

    public function seDeconnecter()
    {

        session()->destroy();

        returnredirect()->to('seconnecter');

    } // Fin seDeconnecter

    public function register()
    {
        helper(['form', 'url']);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nom'              => $this->request->getPost('txtNom'),
                'prenom'           => $this->request->getPost('txtPrenom'),
                'adresse'          => $this->request->getPost('txtAdresse'),
                'code_postal'      => $this->request->getPost('txtCodepostal'),
                'ville'            => $this->request->getPost('txtVille'),
                'telephone_fixe'   => $this->request->getPost('txtTelephonefixe'),
                'telephone_mobile' => $this->request->getPost('txtTelephonemobile'),
                'email'            => $this->request->getPost('txtMel'),
                'mot_de_passe'     => $this->request->getPost('txtMotdepasse'),
            ];

            // Ici tu peux faire des traitements : sauvegarde BDD, validation, etc.
            // Par exemple : return view avec un message
            return view('Templates/Header', $data)

            . view('Visiteur/vue_registerreussi')

            . view('Templates/Footer');
        }

        $data['TitreDeLaPage'] = 'Créer un compte';
        // Si pas POST, redirige vers la vue du formulaire (optionnel)
        return view('Templates/Header', $data)

            . view('Visiteur/vue_register')

            . view('Templates/Footer');
    }
}
