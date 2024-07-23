<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\About;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'Address'=>'Aungban',
            'role'=>'admin',
            'phone'=> '09448977540',
            'password'=> Hash::make('12345678'),
        ]);
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'Address'=>'Aungban',
            'role'=>'user',
            'phone'=> '09448977540',
            'password'=> Hash::make('12345678'),
        ]);
        About::create([
            'description' => 'Welcome to Customer! We are passionate about helping you find the perfect vehicle to suit your needs and budget. Since our establishment in 2001, we have been dedicated to providing exceptional customer service and a wide range of high-quality vehicles. Whether you’re looking for a new, certified pre-owned, or used car, our knowledgeable team is here to assist you every step of the way. Dear, we believe in transparency, integrity, and customer satisfaction. Our extensive inventory features the latest models from top manufacturers as well as reliable pre-owned vehicles that have undergone rigorous inspections to ensure quality and safety. We strive to make your car-buying experience as seamless and enjoyable as possible. Visit us today to explore our selection and discover why so many customers trust [Your Dealership Name] for their automotive needs. Your satisfaction is our top priority.',
        ]);
        Contact::create([
            'address' => 'Taunggyi(Shan State)',
            'email' => 'example.com',
            'phone' => '09xxxxxxx',
        ]);
    }
}
