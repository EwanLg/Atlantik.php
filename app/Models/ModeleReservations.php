<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleReservations extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'NORESERVATION';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['NORESERVATION', 'NOTRAVERSEE', 'NOCLIENT', 'DATEHEURE', 'MONTANTTOTAL', 'PAYE'];

    public function getHistoriqueReservationsParClientPaginated($noClient, $perPage = 10)
    {
    return $this->db->table('reservation r')
        ->select('r.NORESERVATION, r.DATEHEURE AS DATERESE, 
                  p1.NOM AS PORT_DEPART, p2.NOM AS PORT_ARRIVEE, 
                  t.DATEHEUREDEPART, r.MONTANTTOTAL, r.PAYE')
        ->join('traversee t', 'r.NOTRAVERSEE = t.NOTRAVERSEE')
        ->join('liaison l', 't.NOLIAISON = l.NOLIAISON')
        ->join('port p1', 'l.NOPORT_DEPART = p1.NOPORT')
        ->join('port p2', 'l.NOPORT_ARRIVEE = p2.NOPORT')
        ->where('r.NOCLIENT', $noClient)
        ->orderBy('r.DATEHEURE', 'DESC');
    }
    public function creerReservation($data)
    {
        return $this->insert($data);
    }
}
