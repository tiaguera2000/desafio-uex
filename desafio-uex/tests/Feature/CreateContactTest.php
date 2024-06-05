<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateContactTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $user = User::create([
            'name' => "test case user",
            'email' => "tester@case.com",
            'password' => bcrypt("testing")
        ]);
        $this->assertInstanceOf(User::class, $user);
        $address = Address::create([
            "state" => "PR", 
            "city" => "curitiba", 
            "district" => "vila izabel", 
            "zip_code" => "80320310", 
            "street" => "R Tabajaras", 
            "number" => "1241", 
            "lat" => "-155", 
            "lon" => "-444"
        ]);
        $this->assertInstanceOf(Address::class, $address);
        $contact = Contact::create([
            "name" => "Joao do teste", 
            "cpf" => "08929391923", 
            "phone" => "43999100910", 
            "email" => "joao@teste.com", 
            "address_id" => $address->id, 
            "user_id" => $user->id
        ]);
        $this->assertInstanceOf(Contact::class, $contact);
    }
}
