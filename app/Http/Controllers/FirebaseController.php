<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    //
    public function index(){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->create();

        $database = $firebase->getDatabase();

        $ref = $database->getReference('Courses');

        $key = $ref->push()->getKey();

   
        $ref->getChild($key)->set([
            'SubjectName'=> 'BSc Physics'            
        ]);
        return $key;
    }
}
