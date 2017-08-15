<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name = 'owner';
        $owner->display_name = 'Project Owner'; // optional
        $owner->description = 'User is the owner of a given project'; // optional
        $owner->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description = 'User is allowed to manage and edit other users'; // optional
        $admin->save();

        $moderator = new Role();
        $moderator->name = 'moderator';
        $moderator->display_name = 'Moderator'; // optional
        $moderator->description = 'User is allowed product or their edit'; // optional
        $moderator->save();

        $user = new Role();
        $user->name = 'user';
        $user->display_name = 'User';
        $user->description = 'Usually user';
        $user->save();

        $user_site = User::where('name', '=', 'Anton')->first();
        $user_site->attachRole($owner);
        $user_site->save();

        $user_site = User::where('name', '=', 'admin')->first();
        $user_site->attachRole($admin);
        $user_site->save();

        $user_site = User::where('name', '=', 'moderator')->first();
        $user_site->attachRole($moderator);
        $user_site->save();

        $user_site = User::where('name', '=', 'user')->first();
        $user_site->attachRole($user);
        $user_site->save();


        $createProduct = new Permission();
        $createProduct->name = 'create-product';
        $createProduct->display_name = 'Create products'; // optional
        $createProduct->description = 'create products'; // optional
        $createProduct->save();

        $editProduct = new Permission();
        $editProduct->name = 'edit-product';
        $editProduct->display_name = 'Edit products'; // optional
        $editProduct->description = 'edit products'; // optional
        $editProduct->save();

        $deleteProduct = new Permission();
        $deleteProduct->name = 'delete-product';
        $deleteProduct->display_name = 'Delete products'; // optional
        $deleteProduct->description = 'delete products'; // optional
        $deleteProduct->save();

        $editUser = new Permission();
        $editUser->name = 'edit-user';
        $editUser->display_name = 'Edit Users'; // optional
        $editUser->description = 'edit existing users'; // optional
        $editUser->save();

        $admin->perms()->sync(array($createProduct->id, $editProduct->id,$deleteProduct->id ));

        $owner->perms()->sync(array($createProduct->id, $editUser->id,$deleteProduct->id,$editUser->id));

        $moderator->perms()->sync(array($createProduct->id));



    }

}
