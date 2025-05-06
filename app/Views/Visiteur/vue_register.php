<html>

<body>

<?php

    echo form_open('register');

    /* 'bonjournom' entrée routée vers 'Test::bonjourNom', en POST =  

    Méthode bonjourNom de Test appelée pour traitement formulaire */

    echo csrf_field(); // Pour sécurité

    echo form_label('Entrez votre nom ','txtNom');

    echo form_input('txtNom','');  

    echo form_label('Entrez votre prénom ','txtPrenom');

    echo form_input('txtPrenom','');  

    echo form_label('Entrez votre Adresse ','txtAdresse');

    echo form_input('txtAdresse','');  

    echo form_label('Entrez votre Code Postal ','txtCodepostal');

    echo form_input('txtCodepostal','');  

    echo form_label('Entrez votre Ville ','txtVille');

    echo form_input('txtVille','');  

    echo form_label('Entrez votre Telephone Fixe ','txtTelephonefixe');

    echo form_input('txtTelephonefixe','');  

    echo form_label('Entrez votre Telephone Mobile ','txtTelephonemobile');

    echo form_input('txtTelephonemobile','');  

    echo form_label('Entrez votre e-mail ','txtMel');

    echo form_input('txtMel','');  

    echo form_label('Créer un mot de passe ','txtMotdepasse');

    echo form_input('txtMotdepasse','');  

    echo form_submit('btnOK','OK');

    echo form_close();

?>

</body>

</html>