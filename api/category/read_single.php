<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die(); // This is how we get the values from e.g something.com?id=3;

    // Get category
    $category->read_single();

    // Create array
    $cat_arr = array(
        'id' => $category->id,
        'name'  => $category->name
    );

    // Make JSON & output
    print_r(json_encode($cat_arr)); 