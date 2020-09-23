<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for creating system admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function confirm_passwords($password, $confirm_password) {

        if($password != $confirm_password){
            $error = $this->error('Passwords do not match!');
            $password = $this->secret('Insert password');
            $password = $this->validatePassword($password);
            $confirm_password = $this->secret('Confirm your password');
            return $this->confirm_passwords($password, $confirm_password);
        }
        return $password;
    }

    // Validating if the emails does not repeat
    public function validateEmails($email){

        $email_validator = Validator::make(
            ['email' => $email],
            ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']]
        );

        if($email_validator->fails()){
            $this->error('Email is Invalid or already exist!');
            $email = $this->ask('Insert valid email:');
            return $this->validateEmails($email);
        }

        return $email;

    }

    public function validatePassword($password){

        $password_validator = Validator::make(
            ['password' => $password],
            ['password' => ['required', 'min:8']]
        );

        if($password_validator->fails()){
            $this->error('Password required and atleast 8 characters Needed');
            $password = $this->secret('Enter Password:');
            return $this->validatePassword($password);
        }

        return $password;
    }

    public function validateName($name){

        $name_validator = Validator::make(
            ['name' => $name],
            ['name' => ['required', 'string', 'max:255']]
        );

        if($name_validator->fails()){
            $this->error('Name is required!');
            $name = $this->ask('Insert Name:');
            return $this->validateName($name);
        }

        return $name;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        // Ask for name of admin
        $name = $this->ask('Insert name:');
        $name = $this->validateName($name);

        $email = $this->ask('Insert Email:');
        $email = $this->validateEmails($email);

        $password = $this->secret('Insert password');
        $password = $this->validatePassword($password);

        $confirm_password = $this->secret('Confirm your password');
        $password = $this->confirm_passwords($password, $confirm_password);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = 'admin';
        $user->created_at = Carbon::now();
        $user->save();

        $this->info('Congratulations, Now you are adminstrator of this system.');

        
        
    }
}
