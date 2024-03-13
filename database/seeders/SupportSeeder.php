<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Support::where('subject', 'Assunto 1')->first()){
            Support::create([
                'user_id' => '9b8d07e5-9322-4833-aba0-da3399c4d210',
                'subject' => 'Assunto 1',
                'status'  => 'C',
                'body'    => 'descrição 1'

            ]);
        }
        if(!Support::where('subject', 'Assunto 2')->first()){
            Support::create([
                'user_id' => '',
                'subject' => 'Assunto 2',
                'status'  => 'A',
                'body'    => 'descrição 2'

            ]);
        }
    }
      
}
