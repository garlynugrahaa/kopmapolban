<?php

namespace App\Jobs;

use Faker\Factory;
use App\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class DataUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        
        //this will work

        logger()->info('My Log message before Exception');

        //Your other logic
        $faker = Factory::create();
        $jumlahData = 100;
        for ($i = 1; $i <= $jumlahData; $i++){
            $data = [
            'fullname' => $faker->name(),
            'email' => $faker->unique()->email(),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('1234567890'),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
            User::Create($data);
        }

        throw new \Exception("Message is Logged before the Exception but the job is failed", 1);

        //code below the exception won't work

        logger()->info('My Log message after Exception');
    }
}
