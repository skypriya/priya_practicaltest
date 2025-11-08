<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $userModel = new UserModel();

        // Check if admin user already exists
        $existingAdmin = $userModel->where('email', 'admin@example.com')->first();
        
        if ($existingAdmin) {
            echo "Admin user already exists. Skipping...\n";
            return;
        }

        // Create default admin user
        $data = [
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'date_of_birth' => null,
            'gender' => null,
            'address' => null,
            'profile_picture' => null,
            'signature_image' => null,
            'is_admin' => 1,
        ];

        $userModel->insert($data);
        
        echo "Default admin user created successfully!\n";
        echo "Email: admin@example.com\n";
        echo "Password: admin123\n";
        echo "\n⚠️  IMPORTANT: Change the password after first login!\n";
    }
}

