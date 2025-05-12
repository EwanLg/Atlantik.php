<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleUtilisateur extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'noclient';

    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $allowedFields = [
        'nom', 'prenom', 'adresse', 'codepostal', 'ville',
        'telephonefixe', 'telephonemobile', 'mel', 'motdepasse'
    ];
}