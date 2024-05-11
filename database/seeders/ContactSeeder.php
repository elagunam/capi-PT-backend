<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //CREAR 5000 CONTACTOS
        for ($i=0; $i < 5000; $i++) {
            $contact = Contact::create([
                'fullname' => fake()->name().' '.fake()->lastName()
            ]);

            //PARA CADA CONTACTO, CREAMOS ALGUNOS DATOS ADICIONALES
            for ($j = 0; $j < rand(1, 3); $j++){
                $contact->phones()->create([
                    'phone_number' => fake()->phoneNumber(),
                    'type' => fake()->randomElement(['home', 'work', 'mobile'])
                ]);

                $contact->emails()->create([
                    'email' => fake()->email
                ]);

                $contact->addresses()->create([
                    'address' => fake()->address(),
                    'city' => fake()->city(),
                    'country' => fake()->country(),
                    'zip' => fake()->randomNumber(5, true)
                ]);

                
            }
        }
    }
}

