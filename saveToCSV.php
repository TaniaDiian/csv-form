<?php

header('Content-Type: application/json');

$errors = [];
$success = false;
$requireKeys = ['name', 'email', 'comment'];

try {

    foreach ($requireKeys as $key) {
        if (!isset($_POST[$key]) || strlen($_POST[$key]) === 0) {
            array_push($errors, "Field $key is empty");
        }
    }

    if (empty($errors)) {
        $formData = [
            'name'  => $_POST["name"],
            'email'  => $_POST["email"],
            'comment' => $_POST["comment"]
        ];

        $fileOpen = fopen("data.csv", "a");

        if (fputcsv($fileOpen, $formData, ';')) {
            $success = true;
        }

        fclose($fileOpen);
    }
} catch (Exception $e) {

    array_push($errors, $e->getMessage());
} finally {
    $result = [
        'errors' => $errors,
        'success' => $success
    ];

    echo json_encode($result);
}
