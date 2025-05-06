<h2><?php echo $TitreDeLaPage ?></h2>

<?php

    echo form_open('register');

    /* 'bonjournom' entrée routée vers 'Test::bonjourNom', en POST =  

    Méthode bonjourNom de Test appelée pour traitement formulaire */

    echo csrf_field(); // Pour sécurité

    echo form_label('Entrez votre nom ','txtNom');

    echo form_input('txtNom','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre prénom ','txtPrenom');

    echo form_input('txtPrenom','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre Adresse ','txtAdresse');

    echo form_input('txtAdresse','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre Code Postal ','txtCodepostal');

    echo form_input('txtCodepostal','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre Ville ','txtVille');

    echo form_input('txtVille','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre Telephone Fixe ','txtTelephonefixe');

    echo form_input('txtTelephonefixe','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre Telephone Mobile ','txtTelephonemobile');

    echo form_input('txtTelephonemobile','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Entrez votre e-mail ','txtMel');

    echo form_input('txtMel','');  

    echo '<br>';
    echo '<br>';

    echo form_label('Créer un mot de passe ','txtMotdepasse');

    echo form_input('txtMotdepasse','');  

    echo '<br>';
    echo '<br>';

    echo form_submit('btnOK','Créer');

    echo form_close();

?>