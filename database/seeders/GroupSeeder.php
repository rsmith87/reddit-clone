<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = new Group;
        $group->name = 'Admin group';
        $group->type = 'private';
        $group->description = 'Admin group description';
        $group->slug = 'admin-group';
        $group->save();

        $groupTwo = new Group;
        $groupTwo->name = 'Public group';
        $groupTwo->type = 'public';
        $groupTwo->description = 'Public group description';
        $groupTwo->slug = 'public-group';
        $groupTwo->save();

        $groupThree = new Group;
        $groupThree->name = 'Group for RC';
        $groupThree->type = 'public';
        $groupThree->description = 'Group for RC fans';
        $groupThree->slug = 'rc-group';
        $groupThree->save();
    }
}
