<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin_user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::create([
            'first_name' => 'Anakin',
            'last_name' => 'Skywalker',
            'email' => 'skywalker@mail.com',
            'password' => bcrypt('!I666am222DARth999VADer!'),
            'role' => User::USER_ROLE_ADMIN,
        ]);
    }
}
