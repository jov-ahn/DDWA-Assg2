<?php
    require '../vendor/autoload.php';

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'hintel';
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $app = new \Slim\App();

    $team = $connection->query("SELECT * FROM team_account;");

    $app->get('/team', function($req, $res, $args) {
        return $res->withJson($team);
    });

    $app->run();
?>