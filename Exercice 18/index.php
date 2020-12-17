
<?php

//numéro de tel
$test = '02.02.02.02.02';

if( preg_match('/^(\d{2}[ \-\.]{0,1}){4}\d{2}$/', $test) ){
    echo 'oui';
}else{
    echo 'non';
}


?>


<?php

//adresse mail
$test = '0jduej@dd.dd';

if( preg_match('/^[a-z0-9]{1,50}\@[a-z0-9]{1,50}\.[a-z]{1,6}$/', $test) ){
    echo 'oui';
}else{
    echo 'non';
}


?>
