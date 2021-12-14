<?php

if(isset($_POST['name']) && $_POST['email'] && isset($_POST['comment'])){
    $file_open = fopen("data.csv", "a");

    $form_data = [
        'name'  => $_POST["name"],
        'email'  => $_POST["email"],
        'comment' => $_POST["comment"]
    ];
    
    fputcsv($file_open, $form_data, ';');
}

