<?php

namespace App\Models;

use CodeIgniter\Model;

 

class ModeleSecteur extends Model

{

  protected $table = 'secteur'; 

  protected $primaryKey = 'nosecteur';

  protected $useAutoIncrement = true;

  protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

 

  protected $allowedFields = ['nosecteur', 'nom'];

}