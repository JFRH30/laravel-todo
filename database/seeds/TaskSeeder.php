<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();
        DB::table('tasks')->insert([
            [
                'user_id' => 1,
                'name' => 'Task 1',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 1,
                'name' => 'Task 2',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 1,
                'name' => 'Task 3',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 1,
                'name' => 'Task 4',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 1,
                'name' => 'Task 5',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 1,
                'name' => 'Task 6',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 2,
                'name' => 'Task 1',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 2,
                'name' => 'Task 2',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 2,
                'name' => 'Task 3',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 2,
                'name' => 'Task 4',
                'complete' => false,
                'important' => false,
            ],
            [
                'user_id' => 2,
                'name' => 'Task 5',
                'complete' => false,
                'important' => false,
            ],
        ]);
    }
}
