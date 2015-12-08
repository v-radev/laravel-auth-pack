<?php
use Faker\Factory as Faker;
use Actors\UserActor;

/**
 * @var $factory
 * @var $faker
 */

$actor = new UserActor;


$factory('App\Clusters\AuthCluster\Models\User', $actor->makeUserData());