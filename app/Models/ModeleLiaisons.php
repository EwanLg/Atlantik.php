<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleLiaisons extends Model
{
    protected $table = 'liaison'; // table principale
    protected $primaryKey = 'NOLIAISON';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['NOLIAISON', 'NOSECTEUR', 'NOPORT_DEPART', 'NOPORT_ARRIVEE', 'DISTANCE'];

    public function getToutesLesLiaisonsAvecInfos()
    {
        $builder = $this->db->table('liaison');
        $builder->select('secteur.NOM as nomSecteur, liaison.NOLIAISON, liaison.DISTANCE, 
                          portDepart.NOM as portDepart, portArrivee.NOM as portArrivee');
        $builder->join('secteur', 'secteur.NOSECTEUR = liaison.NOSECTEUR');
        $builder->join('port as portDepart', 'portDepart.NOPORT = liaison.NOPORT_DEPART');
        $builder->join('port as portArrivee', 'portArrivee.NOPORT = liaison.NOPORT_ARRIVEE');
        $builder->orderBy('secteur.NOM');

        return $builder->get()->getResult();
    }
}
