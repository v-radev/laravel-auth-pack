<?php

use App\Clusters\AuthCluster\Models\User;
use Page\User\ProfilePage;


class ProfileFunctionalCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;


    public function __construct()
    {
        $this->userActor = new \Actors\UserActor;
    }


    public function it_successfully_updates_profile( FunctionalTester $I )
    {
        $logged = $this->userActor->makeLoggedUser($I);
        $name = 'Inevitable';

        $I->amOnRoute('profile.edit', $logged->username);

        $I->fillField('name', $name);
        $I->submitForm(ProfilePage::$formId, [], 'Update');

        $I->see('Profile successfully updated!');
        $I->seeRecord('users', ['name' => $name, 'username' => $logged->username]);
    }

    public function it_validates_unique_email_on_update( FunctionalTester $I )
    {
        $a = $this->userActor;
        $logged = $a->makeLoggedUser($I, $a->makeUserData());
        $randomEmail = 'my.randomEmai1lString@mail.com';

        $I->amOnRoute('profile.edit', $logged->username);

        $I->submitForm(ProfilePage::$formId, [], 'Update');
        $I->dontSee('The email has already been taken.');//No unique error when updating own profile

        $I->fillField('email', 'admin@example.com');
        $I->submitForm(ProfilePage::$formId, [], 'Update');
        $I->see('The email has already been taken.');

        $I->fillField('email', $randomEmail);
        $I->submitForm(ProfilePage::$formId, [], 'Update');
        $I->dontSee('The email has already been taken.');
        $I->see('Profile successfully updated!');
        $I->seeRecord('users', ['email' => $randomEmail, 'username' => $logged->username]);
    }

    public function it_successfully_updates_user_password( FunctionalTester $I )
    {
        $password = 'thefallen';
        $logged = $this->userActor->makeLoggedUser($I);

        $I->amOnRoute('profile.edit', $logged->username);

        $I->fillField('password', $password);
        $I->fillField('password_confirmation', $password);

        $I->submitForm(ProfilePage::$formId, [], 'Update');

        $I->see('Profile successfully updated!');
    }
}
