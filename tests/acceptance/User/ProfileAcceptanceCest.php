<?php

use Page\User\ProfilePage;


class ProfileAcceptanceCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;


    public function __construct()
    {
        $this->userActor = new \Actors\UserActor();
    }


    public function it_prevents_guests_from_seeing_profiles( AcceptanceTester $I )
    {
        $user = $this->userActor->create();

        $I->amOnRoute('profile.show', $user->username);

        $I->seeInCurrentUrl('auth/login');
        $I->seeCurrentRouteIs('auth.login');
        $I->dontSee('Profile of user');
    }

    public function it_allows_users_to_view_their_profiles( AcceptanceTester $I )
    {
        $user = $this->userActor->makeLoggedUser($I);

        $I->amOnRoute('profile.show', $user->username);

        $I->seeInCurrentUrl('profile/'. $user->username);
        $I->seeCurrentRouteIs('profile.show', $user->username);
        $I->see('Profile of user '. $user->username);
    }

    public function it_allows_users_to_view_others_profiles( AcceptanceTester $I )
    {
        $a = $this->userActor;
        $logged = $a->makeLoggedUser($I, $a->makeUserData());
        $user = $a->create($a->makeUserData());

        $I->amOnRoute('profile.show', $user->username);

        $I->seeInCurrentUrl('profile/'. $user->username);
        $I->seeCurrentRouteIs('profile.show', $user->username);
        $I->see('Profile of user '. $user->username);
    }

    public function it_allows_users_to_edit_their_profiles( AcceptanceTester $I )
    {
        $user = $this->userActor->makeLoggedUser($I);
        $profilePage = new ProfilePage($I);

        $I->amOnRoute('profile.edit', $user->username);

        $I->seeInCurrentUrl('profile/'. $user->username);
        $I->seeCurrentRouteIs('profile.edit', $user->username);
        $profilePage->validateForm();
    }

    public function it_prevents_regular_users_from_editing_other_profiles( AcceptanceTester $I )
    {
        $a = $this->userActor;
        $logged = $a->makeLoggedUser($I, $a->makeUserData());
        $user = $a->create($a->makeUserData());

        $I->amOnRoute('profile.edit', $user->username);

        $I->seeInCurrentUrl('profile/'. $logged->username);
        $I->seeCurrentRouteIs('profile.edit', $logged->username);
        $I->see('EDIT USER '. $logged->username);
    }

    public function it_allows_users_with_access_to_edit_other_profiles( AcceptanceTester $I )
    {
        $a = $this->userActor;
        $logged = $a->makeLoggedUser($I, $a->makeUserData());
        $user = $a->create($a->makeUserData());

        $logged->setRole('admin');
        $logged->attachPermission('editUserProfiles');

        $I->amOnRoute('profile.edit', $user->username);

        $I->seeInCurrentUrl('profile/'. $user->username);
        $I->seeCurrentRouteIs('profile.edit', $user->username);
        $I->see('EDIT USER '. $user->username);
    }
}
