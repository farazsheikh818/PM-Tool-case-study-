<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'edit Project', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete Project' , 'guard_name' => 'api']);
        Permission::create(['name' => 'Create Project' , 'guard_name' => 'api']);
        Permission::create(['name' => 'View project details' , 'guard_name' => 'api']);

        Permission::create(['name' => 'edit Task' , 'guard_name' => 'api']);
        Permission::create(['name' => 'delete Task' , 'guard_name' => 'api']);
        Permission::create(['name' => 'Create Task', 'guard_name' => 'api']);

        Permission::create(['name' => 'Update task status', 'guard_name' => 'api']);
        Permission::create(['name' => 'Comment on tasks' , 'guard_name' => 'api']);
        
        

        // Create roles and assign created permissions
        $role1 = Role::create(['name' => 'Project Manager', 'guard_name' => 'api']);
        $role1->givePermissionTo(['edit Project', 'delete Project', 'Create Project', 'edit Task', 'delete Task', 'Create Task'
    , 'View project details', 'Update task status', 'Comment on tasks']);

        $role2 = Role::create(['name' => 'Team Member' , 'guard_name' => 'api']);
        $role2->givePermissionTo(['View project details', 'Update task status', 'Comment on tasks']);

        $role3 = Role::create(['name' => 'admin' , 'guard_name' => 'api']);
        $role3->givePermissionTo(Permission::all());
    }
}
