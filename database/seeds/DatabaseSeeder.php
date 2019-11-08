<?php

use App\Model\Customer;
use App\Model\User;
use App\Model\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        factory(Book::class, 50)->create();
        factory(User::class, 50)->create();
        factory(Customer::class, 50)->create();
    }
}
