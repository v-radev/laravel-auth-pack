<?php namespace Actors;

use Codeception\Actor;
use Laracasts\TestDummy\Factory;
use Faker\Factory as Faker;
use Page\User\LoginPage;

class UserActor
{

    protected $_modelName = 'App\Clusters\AuthCluster\Models\User';

    public static $_defaultPassword = '123456';

    public static $_nonExistingUser = 'the.fallen';
    public static $_nonExistingEmail = 'the.fallen@willrailse.com';

    public static $_existingUser = 'admin';

    /**
     * @var Faker
     */
    protected $faker;


    public function __construct()
    {
        $this->faker = (new Faker)->create();
    }


    public function create( $attr = [] )
    {
        return Factory::create($this->_modelName, $attr);
    }

    public function build( $attr = [] )
    {
        return Factory::build($this->_modelName, $attr);
    }

    public function makeUserData( array $custom = [] )
    {
        $f = $this->faker;
        $data = [
            'name' => $f->firstNameFemale .' '. $f->lastName,
            'username' => strtolower($f->userName),
            'email' => $f->email,
            'password' => static::$_defaultPassword,
        ];

        $custom = array_merge($data, $custom);

        return $custom;
    }

    public function fillRegisterPageFields( Actor $I, array $custom = [] )
    {
        $data = $this->makeUserData($custom);

        foreach ( $data as $field => $value ) {
            $I->fillField($field, $value);
        }

        $I->fillField('password_confirmation', $data['password']);

        return $data;
    }

    public function makeLoginAttempt( Actor $I, $username, $password )
    {
        $I->amOnRoute(LoginPage::$ROUTE);

        $I->fillField('username', $username);
        $I->fillField('password', $password);
        $I->submitForm(LoginPage::$formId, [], 'Login');
    }

    public function makeLoggedUser( Actor $I, array $custom = [] )
    {
        $password = static::$_defaultPassword;
        $user = $this->create($custom);

        $this->makeLoginAttempt($I, $user->username, $password);

        return $user;
    }
}
