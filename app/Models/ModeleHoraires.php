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
    $builder = $this->db->table('liaison');
    $builder->select('liaison.NOLIAISON, portDepart.NOM as PORT_DEPART, portArrivee.NOM as PORT_ARRIVEE');
    $builder->join('port as portDepart', 'portDepart.NOPORT = liaison.NOPORT_DEPART');
    $builder->join('port as portArrivee', 'portArrivee.NOPORT = liaison.NOPORT_ARRIVEE');
    $builder->where('liaison.NOSECTEUR', $noSecteur);

    $query = $builder->get();
    return $query->getResult();
}

    public function getLesDatesDisponibles($noLiaison)
{
    $builder = $this->db->table('traversee');
    $builder->select('DISTINCT DATE(DATEHEUREDEPART) as date');
    $builder->where('NOLIAISON', $noLiaison);
    $builder->orderBy('DATEHEUREDEPART');

    $query = $builder->get();
    return $query->getResult();
}

    public function getLesCategories()
    {
        return $this->db->query("SELECT LETTRECATEGORIE, LIBELLE FROM categorie")->getResult();
    }

    public function getLesTraverseesBateaux($noLiaison, $date)
{
    $builder = $this->db->table('traversee');
    $builder->select('traversee.NOTRAVERSEE, TIME(traversee.DATEHEUREDEPART) as HEURE, bateau.NOM as BATEAU');
    $builder->join('bateau', 'bateau.NOBATEAU = traversee.NOBATEAU');
    $builder->where('traversee.NOLIAISON', $noLiaison);
    $builder->where('DATE(traversee.DATEHEUREDEPART)', $date);
    $builder->orderBy('traversee.DATEHEUREDEPART');

    $query = $builder->get();
    return $query->getResult();
}

public function getQuantiteEnregistree($noTraversee, $lettreCategorie)
{
    $builder = $this->db->table('enregistrer');
    $builder->select('SUM(enregistrer.QUANTITERESERVEE) as total');
    $builder->join('reservation', 'reservation.NORESERVATION = enregistrer.NORESERVATION');
    $builder->where('reservation.NOTRAVERSEE', $noTraversee);
    $builder->where('enregistrer.LETTRECATEGORIE', $lettreCategorie);

    $query = $builder->get();
    $result = $query->getRow();

    return $result && $result->total !== null ? (int)$result->total : 0;
}

    public function getCapaciteMaximale($noTraversee, $lettreCategorie)
{
    $builder = $this->db->table('contenir');
    $builder->select('contenir.CAPACITEMAX');
    $builder->join('traversee', 'traversee.NOBATEAU = contenir.NOBATEAU');
    $builder->where('traversee.NOTRAVERSEE', $noTraversee);
    $builder->where('contenir.LETTRECATEGORIE', $lettreCategorie);

    $query = $builder->get();
    $result = $query->getRow();

    return $result ? (int)$result->CAPACITEMAX : 0;
}
}
