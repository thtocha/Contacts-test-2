<?php

namespace Thtocha\ContactsPackage\Database\Seeders;

use Thtocha\ContactsPackage\Models\Contact;
use Thtocha\ContactsPackage\Models\PhoneNumber;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::factory()->count(50)->create()->each(function ($contact) {
            $contact->phones()->saveMany(
                PhoneNumber::factory()->count(rand(1,3))->make()
            );
        });
    }
}
