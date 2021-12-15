<?php

header('Content-Type: application/json');

$errors = [];
$success = false;
$requireKeys = ['name', 'email', 'comment'];

const FILE_NAME = "data.csv";

try {

    foreach ($requireKeys as $key) {
        if (empty($_POST[$key])) {
            array_push($errors, "Field $key is empty");
        }else{
            $formData[$key] = $_POST[$key];
        }
    }

    if (empty($errors)) {
        $fileOpen = fopen(FILE_NAME, "a");

        if (fputcsv($fileOpen, $formData, ';')) {
            $success = true;
        } 
    }
} catch (Exception $e) {

    array_push($errors, $e->getMessage());
}
finally{

    if($fileOpen){
        fclose($fileOpen);
    }
}

echo json_encode([
    'errors' => $errors,
    'success' => $success
]);
