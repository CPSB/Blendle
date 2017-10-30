<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migrations before seeding, it will clear all old data!')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, started from blank database.');
        }

        // Confirm roles needed.
        if ($this->command->confirm('Create roles for users, default is Admin and user. [y|N]', true)) {
            // Ask for roles from input.
            $inputRoles = $this->command->ask('Enter Roles in comma separate format.', 'admin,user');
            $rolesArray = explode(',', $inputRoles);

            foreach ($rolesArray as $role) { // Add roles
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'admin') { // Assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all permissions');
                } else { // For others by default only read access.
                    $role->syncPermissions(Permission::chere('name', 'LIKE', 'view_%')->get());
                }

                $this->createUser($role); // Create one user for each role.
            }
        }
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if( $role->name == 'admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
