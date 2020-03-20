<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class SubjectController extends Controller
{

    public function index(){
          // Authentication the service account with firebasekey.json
    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
    // creating a new firebase object
    $firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://fir-2-d0174.firebaseio.com/')
    ->create();

    // getting database uri
    $database = $firebase->getDatabase();
    // refrencing the collection from the database
    $ref = $database->getReference('Subjects');
    // retrieving the data form the collection
    $subjects = $ref->getValue();

    // looping through the array
    foreach($subjects as $subject){
        // storing all the subjects in an array all_subject
        $all_subject[] = $subject;
    }

    // return json_encode($all_subject);
        return view('pages.subject', compact('all_subject'));
    }  

    // addd subject
    public function addSubject(Request $request){
                // Authentication the service account with firebasekey.json
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        // creating a new firebase object
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://fir-2-d0174.firebaseio.com/')
        ->create();

        // getting database uri
        $database = $firebase->getDatabase();
        // refrencing the collection from the database
        $ref = $database->getReference('Subjects');

        $subjectname = $request->subjectname;

        $key = $ref->push()->getKey();

        $ref->getChild($key)->set([
            'SubjectName'=> $subjectname
        ]);
        $subjects = $ref->getValue();

        foreach($subjects as $subject){
            // storing all the subjects in an array all_subject
            $all_subject[] = $subject;
        }
    
        // return json_encode($all_subject);
            return view('pages.subject', compact('all_subject'));
        

    }

}
