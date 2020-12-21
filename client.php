<?php
header("Access-Control-Allow-Origin: *");
    require "../ModelCrudRepository.php";
    require "../Entities/client.php";
    require "../utils/utility.php";
    require __DIR__ . '/../vendor/autoload.php';

    use \Firebase\JWT\JWT;

    $key = "example_key";
    $conn = new PDO("mysql:host=localhost;dbname=gym", 'root', "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    $method=$_SERVER["REQUEST_METHOD"];
    $path=Utils::find_endpoint_from_path($_SERVER["PHP_SELF"]);
    $model=new ModelCrudRepository($conn,Client::class);
    $post_functions=array(
        
    );
    $get_functions=array();
    $put_functions=array();

    /////////////get////////////////
    $get_functions["/client.php"]=function() use (&$model,&$key){
        $id=$_GET["id"];
        $client=$model->findOne($id);
    };


    ////////////////////*/signup*/ ///////////////
        $post_functions["/client.php/signup"]=function() use (&$model,&$key){
            $request_body=json_decode(file_get_contents("php://input"));
            $client=new Client();
            $options=[
                "cost"=>12
            ];
            $client=$client->load_json($request_body);
            $hashed_password=password_hash($client->getPassword(),PASSWORD_BCRYPT,$options);
            $client->setPassword($hashed_password);
            try{
                $model->save($client);
                http_response_code(201);

        }
            catch(Exception $e){
                http_response_code(500);
                echo $e->getMessage();
            }

        };

        /////////////////////////////*/auth*////////////
        $post_functions["/client.php/auth"]=function() use (&$model,&$key){
            $request_body=json_decode(file_get_contents("php://input"));
            $query=new stdClass();
            $query->email=$request_body->email; 
            $client=$model->findOne($query);
            if(!$client){
                http_response_code(404);
                echo "user not found";
                return;
            }
            if(!password_verify($request_body->password,$client->getPassword()))
                {
                    http_response_code(403);
                    echo "password is not correct";
                    return;
                }
            $payload=array(
                "iat"=>time(),
                "exp"=>time()+7*24*60*60,
                "email"=>$client->getEmail(),
                "name"=>$client->getName(),
                "id"=>$client->getId()
                
            );
            $jwt =JWT::encode($payload,$key);
            http_response_code(200);
            echo json_encode($jwt);
            return;

        };

        ////////////////////update////////////
        $put_functions["/client"]=function() use(&$model,&$key){
            $request_body=json_decode(file_get_contents("php://input"));
            $client=new Client();
            $client=$client->load_json($request_body);
            $model->save($client);
        };
        switch($_SERVER['REQUEST_METHOD']
        ){
            case "GET":
                $get_functions[$path]();
                break;
            case "POST":
                $post_functions[$path]();
                break;
            
        }
            ?>