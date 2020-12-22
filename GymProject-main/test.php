<?php 
    require __DIR__."/ModelCrudRepository.php";
    require __DIR__ ."/Entities/client.php";
    $conn = new PDO("mysql:host=localhost;dbname=gym", 'root', "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    $method=$_SERVER["REQUEST_METHOD"];
    $model=new ModelCrudRepository($conn,Client::class);
    $client=new Client();
    $client->setName("haitham elsystem");
    $client->setId(44);
    $model->save($client);
?>
