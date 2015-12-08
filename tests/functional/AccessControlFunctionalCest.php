<?php

use App\Clusters\AuthCluster\Models\AccessControl\Permission;
use App\Clusters\AuthCluster\Models\AccessControl\Role;
use App\Clusters\AuthCluster\Models\AccessControl\RolePermission;
use App\Clusters\AuthCluster\Models\AccessControl\UserRole;
use App\Clusters\AuthCluster\Models\AccessControl\UserPermission;
use App\Clusters\AuthCluster\Models\User;


class AccessControlFunctionalCest
{

    /**
     * @var \Actors\UserActor
     */
    protected $userActor;

    protected $URT = '';
    protected $UPT = '';


    public function __construct()
    {
        $this->userActor = new \Actors\UserActor();

        $this->URT = UserRole::$tableName;
        $this->UPT = UserPermission::$tableName;;
    }


    public function it_returns_true_if_user_has_role( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('user');

        $I->assertTrue($user->is('user'));
    }

    public function it_returns_false_if_user_lacks_role( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('user');

        $I->assertFalse($user->is('admin'));
    }

    public function it_returns_true_if_user_has_permission( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('admin');
        $user->attachPermission('editUserProfiles');

        $I->assertTrue($user->can('editUserProfiles'));
    }

    public function it_returns_false_if_user_lacks_permission( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('admin');
        $user->attachPermission('editUserProfiles');

        $I->assertFalse($user->can('doSomeThing'));
    }

    public function it_returns_true_if_user_has_permissions( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('admin');
        $user->attachPermission('editUserProfiles');
        $user->attachPermission('accessDashboard');

        $I->assertTrue($user->can(['editUserProfiles', 'accessDashboard']));
    }

    public function it_returns_false_if_user_lacks_permissions( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('admin');
        $user->attachPermission('editUserProfiles');

        $I->assertFalse($user->can(['editUserProfiles', 'accessDashboard']));
    }

    public function it_sets_user_role_by_id( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $roleId = 1;

        $user->setRole($roleId);

        $I->seeRecord($this->URT, ['user_id' => $user->id, 'role_id' => $roleId]);
    }

    public function it_sets_user_role_by_name( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $role = 'admin';

        $user->setRole($role);
        $roleId = $role = Role::where('name', '=', $role)->firstOrFail()->id;

        $I->seeRecord($this->URT, ['user_id' => $user->id, 'role_id' => $roleId]);
    }

    public function it_deletes_permissions_when_setting_a_role( FunctionalTester $I )
    {
        $user = User::where('username', '=', 'admin')->firstOrFail();

        $I->seeRecord($this->URT, ['user_id' => $user->id]);
        $I->seeRecord($this->UPT, ['user_id' => $user->id]);

        $user->setRole('user');

        $I->dontSeeRecord($this->UPT, ['user_id' => $user->id]);
    }

    public function it_creates_new_role_relation_for_new_users( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $I->dontSeeRecord($this->URT, ['user_id' => $user->id]);

        $user->setRole('admin');
        $user->attachPermission('editUserProfiles');

        $I->seeRecord($this->URT, ['user_id' => $user->id]);
    }

    public function it_returns_false_when_assigning_wrong_permission_to_role( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('user');

        $I->assertFalse($user->attachPermission('accessDashboard'), 'User role can not access the dashboard.');
    }

    public function it_returns_null_when_user_already_has_permission( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->setRole('admin');
        $user->attachPermission('accessDashboard');

        $I->assertNull($user->attachPermission('accessDashboard'), 'User already has this permission.');
    }

    public function it_returns_true_when_permission_is_assigned( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $permission = 'accessDashboard';

        $permissionId = Permission::where('name', '=', $permission)->firstOrFail()->id;

        $user->setRole('admin');

        $I->assertTrue($user->attachPermission($permission));
        $I->seeRecord($this->UPT, ['user_id' => $user->id, 'permission_id' => $permissionId]);
    }

    public function it_successfully_detaches_permission( FunctionalTester $I )
    {
        $user = $this->userActor->create();
        $permission = 'accessDashboard';

        $permissionId = Permission::where('name', '=', $permission)->firstOrFail()->id;

        $user->setRole('admin');

        $I->assertTrue($user->attachPermission($permission));
        $I->seeRecord($this->UPT, ['user_id' => $user->id, 'permission_id' => $permissionId]);

        $user->detachPermission($permission);
        $I->dontSeeRecord($this->UPT, ['user_id' => $user->id, 'permission_id' => $permissionId]);
    }

    public function it_does_nothing_when_detaching_not_assigned_permission( FunctionalTester $I )
    {
        $user = $this->userActor->create();

        $user->detachPermission('accessDashboard');
    }

    public function it_creates_default_permission_for_all_roles( FunctionalTester $I )
    {
        $roles = Role::all();

        foreach ( $roles as $role ) {
            $rolePermissions = RolePermission::where('role_id', '=', $role->id)->with('permission')->get();

            $I->assertTrue($rolePermissions->count() >= 1, 'Each role should have a default permission.');
        }
    }
}
