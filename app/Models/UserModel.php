<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'password_hash',
        'date_of_birth',
        'gender',
        'address',
        'profile_picture',
        'signature_image',
        'is_admin',
    ];

    protected $returnType = 'array';

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first() ?: null;
    }
}


