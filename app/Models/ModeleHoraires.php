<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleHoraires extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getLesLiaisonsParSecteur($noSecteur)
    {
        return $this->db->query("
            SELECT l.NOLIAISON, pd.NOM AS PORT_DEPART, pa.NOM AS PORT_ARRIVEE
            FROM liaison l
            JOIN port pd ON l.NOPORT_DEPART = pd.NOPORT
            JOIN port pa ON l.NOPORT_ARRIVEE = pa.NOPORT
            WHERE l.NOSECTEUR = ?
        ", [$noSecteur])->getResult();
    }

    public function getLesDatesDisponibles($noLiaison)
    {
        return $this->db->query("
            SELECT DISTINCT DATE(DATEHEUREDEPART) AS date
            FROM traversee
            WHERE NOLIAISON = ?
            ORDER BY DATEHEUREDEPART
        ", [$noLiaison])->getResult();
    }

    public function getLesCategories()
    {
        return $this->db->query("SELECT LETTRECATEGORIE, LIBELLE FROM categorie")->getResult();
    }

    public function getLesTraverseesBateaux($noLiaison, $date)
    {
        return $this->db->query("
            SELECT t.NOTRAVERSEE, TIME(t.DATEHEUREDEPART) AS HEURE, b.NOM AS BATEAU
            FROM traversee t
            JOIN bateau b ON t.NOBATEAU = b.NOBATEAU
            WHERE t.NOLIAISON = ?
              AND DATE(t.DATEHEUREDEPART) = ?
            ORDER BY t.DATEHEUREDEPART
        ", [$noLiaison, $date])->getResult();
    }

    public function getQuantiteEnregistree($noTraversee, $lettreCategorie)
    {
        $result = $this->db->query("
            SELECT SUM(e.QUANTITERESERVEE) AS total
            FROM enregistrer e
            JOIN reservation r ON e.NORESERVATION = r.NORESERVATION
            WHERE r.NOTRAVERSEE = ?
              AND e.LETTRECATEGORIE = ?
        ", [$noTraversee, $lettreCategorie])->getRow();

        return $result && $result->total !== null ? (int)$result->total : 0;
    }

    public function getCapaciteMaximale($noTraversee, $lettreCategorie)
    {
        $result = $this->db->query("
            SELECT c.CAPACITEMAX
            FROM contenir c
            JOIN traversee t ON c.NOBATEAU = t.NOBATEAU
            WHERE t.NOTRAVERSEE = ?
              AND c.LETTRECATEGORIE = ?
        ", [$noTraversee, $lettreCategorie])->getRow();

        return $result ? (int)$result->CAPACITEMAX : 0;
    }
}
