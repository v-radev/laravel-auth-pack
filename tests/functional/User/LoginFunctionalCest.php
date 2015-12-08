<?php

use Page\User\LoginPage;


class LoginFunctionalCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;


    public function __construct()
    {
        $this->userActor = new \Actors\UserActor();
    }


    public function it_increments_login_attempts( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $username = $user->username;
        $key = 'login:attempts:'.md5($username.'127.0.0.1');

        Cache::forget($key);//clean row if any

        $this->userActor->makeLoginAttempt($I, $username, '123');//fail login
        $I->see('Login failed. Please try again.');

        $I->assertTrue(Cache::has($key));//check for record, has to be 1

        $this->userActor->makeLoginAttempt($I, $username, '123');//fail again
        $I->see('Login failed. Please try again.');

        $attempts = Cache::get($key);
        $I->assertTrue($attempts == 2, 'Number of login attempts should be incremented to 2.');
    }

    public function it_locks_out_user_after_attempts( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $username = $user->username;
        $key = 'login:expiration:'.md5($username.'127.0.0.1');
        $attempts = LoginPage::$maxLoginAttempts + 1;

        $I->assertFalse(Cache::has($key));

        for ($i = 0; $i < $attempts; $i++) {
            $this->userActor->makeLoginAttempt($I, $username, 'a');
        }

        $I->assertTrue(Cache::has($key));
    }

    public function it_clears_attempts_on_successful_login( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $username = $user->username;
        $keyAttempts = 'login:attempts:'.md5($username.'127.0.0.1');
        $keyLockout = 'login:expiration:'.md5($username.'127.0.0.1');

        $I->assertFalse(Cache::has($keyAttempts));//check for records
        $I->assertFalse(Cache::has($keyLockout));

        $this->userActor->makeLoginAttempt($I, $username, 'a');//fail to login

        $I->assertTrue(Cache::has($keyAttempts));//record should exist

        $this->userActor->makeLoginAttempt($I, $username, \Actors\UserActor::$_defaultPassword);//success login
        $I->see('Logout');

        $I->assertFalse(Cache::has($keyAttempts));//records should be deleted
        $I->assertFalse(Cache::has($keyLockout));
    }

    public function it_logs_out_successfully( FunctionalTester $I )
    {
        $this->userActor->makeLoggedUser($I);

        $I->seeAuthentication();

        $I->amOnRoute('auth.logout');

        $I->dontSeeAuthentication();

        $I->seeCurrentRouteIs('home');
    }

    public function it_checks_if_user_model_is_of_the_authenticated_user( FunctionalTester $I )
    {
    //No one is logged, check random user object is current
        $actor = $this->userActor;
        $randomUserModel = $actor->create($actor->makeUserData());

        $I->assertFalse($randomUserModel->isCurrent(), 'User model should not be of the authenticated user.');

    //Make logged user, check if another user model is current
        $loggedUserModel = $actor->makeLoggedUser($I, $actor->makeUserData());
        $anotherRandomUserModel = $actor->create($actor->makeUserData());

        $I->assertFalse($anotherRandomUserModel->isCurrent(), 'User model should not be of the authenticated user.');

    //Check if logged user model is current
        $I->assertTrue($loggedUserModel->isCurrent(), 'User model should be of the authenticated user.');
    }
}
