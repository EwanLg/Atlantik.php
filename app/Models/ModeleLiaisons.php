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
/*        $builder = $this->db->table('liaison');
        $builder->select('secteur.NOM as nomSecteur, liaison.NOLIAISON, liaison.DISTANCE, 
                          portDepart.NOM as portDepart, portArrivee.NOM as portArrivee');
        $builder->join('secteur', 'secteur.NOSECTEUR = liaison.NOSECTEUR');
        $builder->join('port as portDepart', 'portDepart.NOPORT = liaison.NOPORT_DEPART');
        $builder->join('port as portArrivee', 'portArrivee.NOPORT = liaison.NOPORT_ARRIVEE');
        $builder->orderBy('secteur.NOM');
        $builder->orderBy('liaison.NOLIAISON');
              return $builder->get()->getResult();
              */
        
        $res = $this->join('secteur', 'secteur.NOSECTEUR = liaison.NOSECTEUR')
        ->join('port as portDepart', 'portDepart.NOPORT = liaison.NOPORT_DEPART')
        ->join('port as portArrivee', 'portArrivee.NOPORT = liaison.NOPORT_ARRIVEE')
        ->orderBy('secteur.NOM')
        ->orderBy('liaison.NOLIAISON')
        ->select('secteur.NOM as nomSecteur, liaison.NOLIAISON, liaison.DISTANCE, 
                          portDepart.NOM as portDepart, portArrivee.NOM as portArrivee')
        ;

        return $res->get()->getResult();


    }
}
