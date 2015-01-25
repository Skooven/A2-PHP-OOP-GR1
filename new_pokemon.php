<?php


require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__.'/bootstrap.php';

use Skooven\PokemonBattle\PokemonModel;

$pokemonName = !empty($_POST['name']) ? $_POST['name'] : null;
$pokemonType = !empty($_POST['pokemonType']) ? $_POST['pokemonType'] : null;

$pokemonRepository = $em->getRepository('Skooven\PokemonBattle\PokemonModel');
$criteria = array('trainerId' => $_SESSION['id']);
$pokemon_test = $pokemonRepository->findOneBy($criteria);

$isConnected = false;


if((isset($_SESSION['connected']) && $_SESSION['connected'] = true)) {

    $isConnected = true;

    if($pokemon_test = null){


    /**
     * Pokemon Create
     */
        if (null !== $pokemonName && null !== $pokemonType) {

            if ($pokemonType = '0') {
                $pokemon = new PokemonModel();

                $pokemon
                    ->setName($pokemonName)
                    ->setType(0)
                    ->setHP(100)
                    ->setTrainerId($_SESSION['id']);

                $em->persist($pokemon);
                $em->flush();

                echo '<div class="alert alert-success" role="alert">Pokemon feu crée!</div>';

            } else if ($pokemonType = '1') {
                $pokemon = new PokemonModel();

                $pokemon
                    ->setName($pokemonName)
                    ->setType(1)
                    ->setHp(100)
                    ->setTrainerId($_SESSION['id']);

                $em->persist($pokemon);
                $em->flush();

                echo '<div class="alert alert-success" role="alert">Pokemon eau crée!</div>';
            } else {
                $pokemon = new PokemonModel();

                $pokemon
                    ->setName($pokemonName)
                    ->setType(2)
                    ->setHP(100)
                    ->setTrainerId($_SESSION['id']);

                $em->persist($pokemon);
                $em->flush();

                echo '<div class="alert alert-success" role="alert">Pokemon Plante crée!</div>';
            }
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">Vous avez deja un pokemon : Voulez vous le supprimer ? <a href="delete_pokemon.php">Yes</a></div>';
    }

} else{
    header('Location: index.php');
}



echo $twig->render('new_pokemon.html.twig',[
    'isConnected' => $isConnected,
]);