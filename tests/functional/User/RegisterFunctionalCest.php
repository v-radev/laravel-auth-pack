<?php

use App\Clusters\AuthCluster\Models\AccessControl\Permission;
use App\Clusters\AuthCluster\Models\AccessControl\Role;
use App\Clusters\AuthCluster\Models\AccessControl\UserPermission;
use App\Clusters\AuthCluster\Models\AccessControl\UserRole;
use Page\User\RegisterPage;


class RegisterFunctionalCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;


    public function __construct()
    {
        $this->userActor = new \Actors\UserActor;
    }


    public function it_has_record_in_db_after_registration ( FunctionalTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $userData = $this->userActor->fillRegisterPageFields($I);
        $I->submitForm(RegisterPage::$formId, [], 'Register');

        $I->seeRecord('users', ['username' => $userData['username']]);
    }

    public function it_has_role_in_db_after_registration( FunctionalTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $userData = $this->userActor->fillRegisterPageFields($I);
        $I->submitForm(RegisterPage::$formId, [], 'Register');

        $user = $I->grabRecord('users', ['username' => $userData['username']]);
        $role = Role::where('name', '=', Role::$defaultRole)->first();

        $I->seeRecord(
            UserRole::$tableName,
            ['user_id' => $user->id, 'role_id' => $role->id]
        );
    }

    public function it_has_permission_in_db_after_registration( FunctionalTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $userData = $this->userActor->fillRegisterPageFields($I);
        $I->submitForm(RegisterPage::$formId, [], 'Register');

        $user = $I->grabRecord('users', ['username' => $userData['username']]);
        $permission = Permission::where('name', '=', array_shift(Permission::$defaultPermissions))->first();

        $I->seeRecord(
            UserPermission::$tableName,
            ['user_id' => $user->id, 'permission_id' => $permission->id]
        );
    }
}
