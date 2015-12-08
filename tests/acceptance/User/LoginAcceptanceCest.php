<?php

use Page\User\LoginPage;


class LoginAcceptanceCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;


    public function __construct()
    {
        $this->userActor = new \Actors\UserActor();
    }


    public function it_has_login_form( AcceptanceTester $I )
    {
        $loginPage = new LoginPage($I);
        $loginPage->validateForm();
    }

    public function it_validates_required_fields( AcceptanceTester $I )
    {
        $I->amOnRoute(LoginPage::$ROUTE);
        $I->submitForm(LoginPage::$formId, [], 'Login');
        $I->see('The username field is required.');
        $I->see('The password field is required.');
    }

    public function it_outputs_error_on_incorrect_login( AcceptanceTester $I )
    {
        $this->userActor->makeLoginAttempt($I, 'a', 'a');
        $I->see('Login failed. Please try again.');
    }

    public function it_outputs_too_many_attempts_error( AcceptanceTester $I )
    {
        $username = 'no';
        $password = 'no';

        for ($i = 0; $i < LoginPage::$maxLoginAttempts; $i++) {
            $this->userActor->makeLoginAttempt($I, $username, $password);
            $I->see('Login failed. Please try again.');
        }

        $this->userActor->makeLoginAttempt($I, $username, $password);
        $I->see('Too many login attempts. Please try again in');
    }

    public function it_logs_in_successfully( AcceptanceTester $I )
    {
        $user = $this->userActor->makeLoggedUser($I);

        $I->see($user->username);
        $I->see('View profile');
        $I->see('Edit profile');
        $I->see('Logout');

        $I->dontSee('Login');
        $I->dontSee('Register');
    }

    public function it_logs_out_successfully( AcceptanceTester $I )
    {
        $user = $this->userActor->makeLoggedUser($I);

        $I->click('Logout');

        $I->see('Login');
        $I->see('Register');

        $I->dontSee($user->username);
        $I->dontSee('View profile');
        $I->dontSee('Edit profile');
        $I->dontSee('Logout');
    }
}
