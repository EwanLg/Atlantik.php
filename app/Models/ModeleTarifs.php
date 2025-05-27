<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleTarifs extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getLiaison($noliaison)
    {
        return $this->db->table('liaison l')
            ->select('l.NOLIAISON, pd.NOM AS PORT_DEPART, pa.NOM AS PORT_ARRIVEE')
            ->join('port pd', 'l.NOPORT_DEPART = pd.NOPORT')
            ->join('port pa', 'l.NOPORT_ARRIVEE = pa.NOPORT')
            ->where('l.NOLIAISON', $noliaison)
            ->get()
            ->getRow();
    }

    public function getPeriodes()
    {
        $today = date('Y-m-d');
        return $this->db->table('periode')
            ->select('NOPERIODE, DATEDEBUT, DATEFIN')
            ->where('DATEFIN >=', $today)
            ->orderBy('DATEDEBUT', 'DESC')
            ->limit(4)
            ->get()
            ->getResult();
    }

    public function getTarifs($noliaison)
    {
        $builder = $this->db->table('type t');
        $builder->select('t.LETTRECATEGORIE, t.NOTYPE, t.LIBELLE AS LIBELLETYPE,
                          tr.NOPERIODE, tr.TARIF');
        $builder->join('tarifer tr', 'tr.LETTRECATEGORIE = t.LETTRECATEGORIE 
                                       AND tr.NOTYPE = t.NOTYPE 
                                       AND tr.NOLIAISON = ' . $this->db->escape($noliaison), 'left');
        $builder->orderBy('t.LETTRECATEGORIE')->orderBy('t.NOTYPE');

        return $builder->get()->getResult();
    }
}
