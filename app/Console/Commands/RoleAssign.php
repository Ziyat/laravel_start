<?php

namespace App\Console\Commands;

use App\Domain\User\Entities\User;
use Illuminate\Console\Command;

class RoleAssign extends Command
{
    protected $signature = 'role:assign {email} {role}';
    protected $description = 'Assign role by email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            if ($user = User::where('email', $this->argument('email'))->first()) {
                $user->changeRole($this->argument('role'));
                $this->info("change role success.");
                die;
            }
            $this->error("User not found.");
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
