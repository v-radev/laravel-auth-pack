<?php


class DashboardDefaultFunctionalCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;

    protected $ajaxUrl = '/dashboard/ajax';


    public function __construct()
    {
        putenv('APP_ENV=testing');

        $this->userActor = new \Actors\UserActor;
    }


    public function it_returns_not_found_when_request_is_not_ajax ( FunctionalTester $I )
    {
        $I->amOnPage($this->ajaxUrl);
        $I->seeResponseCodeIs(404);
    }

    public function it_returns_not_found_when_requested_action_not_found ( FunctionalTester $I )
    {
        $I->sendAjaxGetRequest($this->ajaxUrl, ['action' => 'The fallen shall rise again!']);
        $I->seeResponseCodeIs(404);
    }

    public function it_returns_unauthorized_for_action_role_permission_when_no_role_id ( FunctionalTester $I )
    {
        $I->sendAjaxGetRequest($this->ajaxUrl, ['action' => 'role_permissions']);
        $I->seeResponseCodeIs(401);
    }

    public function it_returns_unauthorized_for_action_role_permission_when_user_not_authenticated ( FunctionalTester $I )
    {
        $I->sendAjaxGetRequest($this->ajaxUrl, ['action' => 'role_permissions', 'role_id' => 0]);
        $I->seeResponseCodeIs(401);
    }

    public function it_returns_unauthorized_for_action_role_permission_when_user_doesnt_have_permission ( FunctionalTester $I )
    {
        $user = $this->userActor->makeLoggedUser($I);

        $user->setRole('admin');

        $I->sendAjaxGetRequest($this->ajaxUrl, ['action' => 'role_permissions', 'role_id' => 1]);
        $I->seeResponseCodeIs(401);
    }

    public function it_returns_json_permissions_list_for_action_role_permission_on_successful_request ( FunctionalTester $I )
    {
        $user = $this->userActor->makeLoggedUser($I);

        $user->setRole('admin');
        $user->attachPermission('updateUsersAccess');

        $I->sendAjaxGetRequest($this->ajaxUrl, ['action' => 'role_permissions', 'role_id' => 1]);
        $I->seeResponseCodeIs(200);
    }

}
