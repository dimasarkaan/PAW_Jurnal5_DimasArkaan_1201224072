<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Print mahasiswa list
$mahasiswas = App\Models\Mahasiswa::all()->toArray();
echo "MAHASISWA_JSON:\n";
echo json_encode($mahasiswas, JSON_PRETTY_PRINT) . "\n\n";

// Create token for test user if exists
$user = App\Models\User::where('email', 'test@example.com')->first();
if ($user) {
    $token = $user->createToken('cli-token')->plainTextToken;
    echo "TOKEN:\n" . $token . "\n";
} else {
    echo "TOKEN:\nNO_USER\n";
}
