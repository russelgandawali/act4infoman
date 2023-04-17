<?php
require_once __DIR__.'/vendor/autoload.php';
use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'keyFilePath' => 'keys\php-8-point-1-firebase-adminsdk-2db4s-01c4ac9561.json',
    'projectId' => 'php-8-point-1',
]);

$userColRef = $db->collection("users");

// INSERTING NEW DOCUMENT WITH CUSTOM ID
/*$newDocRef = $userColRef->document('russel')->set([
    'username' => 'russelgandawali',
    'email' => 'russelgandawali@yahoo.com',
    'password' => 'password123',
    'name' => [
        'first' => 'russel',
        'last' => 'gandawali',
    ],
    'role' => 'user',
    'social' => [
        'facebook' => 'https://www.facebook.com/russelgandawali',
        'instagram' => 'https://www.instagram.com/russelgandawali',
        'tiktok' => 'https://www.tiktok.com/@russelgandawali',
        'twitter' => 'https://www.twitter.com/russelgandawali',
    ],
]);*/

// INSERTING NEW DOCUMENT WITH AUTO ID
$db->collection('users')->add([
    'title' => 'Firestore demo',
    'content' => 'blah blah',
    'date' => FieldValue::serverTimestamp()
]);

// FETCHING SINGLE DOCUMENT
$post = $db->collection("users")->document("russel")->snapshot();

// DISPLAYING DOCUMENT DATA
echo '<p>Username: ' . $post['username'] . '</p>';
echo '<p>Name: ' . $post['name']['first'] . ' ' . $post['name']['last'] . '</p>';
echo '<p>Role: ' . $post['role'] . '</p>';

// Display social media links as a list
echo '<p>Social Media:</p><ul>';
foreach ($post['social'] as $platform => $link) {
    echo '<li><a href="' . $link . '">' . ucfirst($platform) . '</a></li>';
}
echo '</ul>';
