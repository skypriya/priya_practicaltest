<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\PasswordResetModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    protected $email;
    protected $request;
    protected $session;
    protected $users;

    
    public function __construct()
    {
        $this->email = service('email');
        $this->request = service('request');
        $this->session = session();
        $this->users = new UserModel();
    }


    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $email = trim((string) $this->request->getPost('email'));
            $password = (string) $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->findByEmail($email);
            if ($user && password_verify($password, (string) $user['password_hash'])) {
                session()->set('user', [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'is_admin' => (int) $user['is_admin'] === 1,
                    'name' => $user['first_name'] . ' ' . $user['last_name'],
                ]);
                return redirect()->to('/dashboard');
            }
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        return view('auth/login');
    }

    public function register()
    {
      
        if ($this->request->getMethod() === 'POST') {
           
            $rules = [
                'first_name' => 'required|min_length[2]',
                'last_name' => 'required|min_length[2]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
            ];
            if (! $this->validate($rules)) {
                $errors = $this->validator->getErrors();
                return redirect()->back()->withInput()->with('error', $errors);
            }

            $userModel = new UserModel();
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
                'date_of_birth' => $this->request->getPost('date_of_birth') ?: null,
                'gender' => $this->request->getPost('gender') ?: null,
                'address' => $this->request->getPost('address') ?: null,
                'is_admin' => 1,
                
            ];

            // Handle uploaded/cropped profile picture (optional)
            // First check for cropped image (base64), otherwise use uploaded file
            $croppedImage = $this->request->getPost('profile_cropped');
            if ($croppedImage) {
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
                $fileName = uniqid('profile_', true) . '.jpg';
                $uploadPath = FCPATH  . 'uploads/profile_pictures/';
                if (! is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }
                file_put_contents($uploadPath . $fileName, $image);
                $data['profile_picture'] = 'uploads/profile_pictures/' . $fileName;
            } else {
                $profile = $this->request->getFile('profile_picture');
                if ($profile && $profile->isValid() && ! $profile->hasMoved()) {
                    $uploadPath = FCPATH  . 'uploads/profile_pictures/';
                    if (! is_dir($uploadPath)) {
                        mkdir($uploadPath, 0775, true);
                    }
                    $newName = $profile->getRandomName();
                    $profile->move($uploadPath, $newName);
                    $data['profile_picture'] = 'uploads/profile_pictures/' . $newName;
                }
            }

            // Handle signature image (base64 from plugin)
            $signatureData = (string) $this->request->getPost('signature_image');
            if ($signatureData) {
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));
                $fileName = uniqid('sign_', true) . '.png';
                $path = FCPATH . 'uploads/signatures/' . $fileName;
                if (! is_dir(dirname($path))) {
                    mkdir(dirname($path), 0775, true);
                }
                file_put_contents($path, $image);
                $data['signature_image'] = 'uploads/signatures/' . $fileName;
            }

            $userModel->insert($data);
            return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
        }
        
        return view('auth/register');
    }

    public function forgot()
    {
        //if ($this->request->getMethod() === 'POST') {
            // In a real app, send email here. We just flash a success.
            //return redirect()->back()->with('success', 'If the email exists, a reset link was sent.');
        //}
        if ($this->request->getMethod() === 'POST') {
            return $this->sendReset();
        }
        return view('auth/forgot');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // Handle forgot POST
    protected function sendReset()
    {
        $email = (string) $this->request->getPost('email');
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Please enter a valid email address')->withInput();
        }

        $user = $this->users->where('email', $email)->first();

        // Always respond with success to avoid enumerating emails
        // But only create token if user exists.
        if ($user) {
            // Create selector + token
            $selector = bin2hex(random_bytes(12)); // 24 chars
            $tokenRaw = bin2hex(random_bytes(32)); // 64 chars raw token
            $tokenHash = password_hash($tokenRaw, PASSWORD_DEFAULT);

            // expiry - 1 hour from now
            $expires = Time::now()->addHours(1)->toDateTimeString();

            // Save to password_resets table
            $prModel = new \App\Models\PasswordResetModel();
            // optional: delete previous resets for this email
            $prModel->where('email', $email)->delete();

            $prData = [
                'user_id' => $user['id'],
                'email' => $email,
                'selector' => $selector,
                'token_hash' => $tokenHash,
                'expires_at' => $expires,
            ];
            $prModel->insert($prData);

            // Build reset URL: include selector + token
            $resetUrl = site_url('reset-password') . '?sel=' . $selector . '&token=' . $tokenRaw;

            // Compose email
            $subject = 'Password reset request';
            $message = view('emails/reset_password', ['name' => $user['first_name'] ?? $user['email'], 'resetUrl' => $resetUrl, 'expires' => $expires]);

            // send email
            $this->email->setFrom(config('Email')->fromEmail ?? getenv('email.fromEmail'), config('Email')->fromName ?? getenv('email.fromName'));
            $this->email->setTo($email);
            $this->email->setSubject($subject);
            $this->email->setMessage($message);
            try {
                $this->email->send();
            } catch (\Exception $e) {
                log_message('error', 'Password reset email failed: ' . $e->getMessage());
                // do not reveal to user
            }
        }

        return redirect()->back()->with('success', 'If that email exists, a password reset link has been sent.');
    }

    // Show reset form
    public function reset()
    {
        // selector & token come via query params
        $selector = $this->request->getGet('sel');
        $token = $this->request->getGet('token');

        // If POST, handle reset submission
        if ($this->request->isPost()) {
            return $this->doReset();
        }

        // Minimal validation
        if (! $selector || ! $token) {
            return redirect()->to('/login')->with('error', 'Invalid password reset link.');
        }

        // Verify selector exists and not expired
        $prModel = new \App\Models\PasswordResetModel();
        $row = $prModel->where('selector', $selector)->first();
        if (! $row || strtotime($row['expires_at']) < time()) {
            return redirect()->to('/login')->with('error', 'Password reset link is invalid or has expired.');
        }

        // Show form, include selector & token as hidden fields (avoid GET token in URL)
        return view('auth/reset', ['selector' => $selector, 'token' => $token, 'email' => $row['email']]);
    }

    // Process reset POST
    protected function doReset()
    {
        $selector = $this->request->getPost('selector');
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if (! $selector || ! $token) {
            return redirect()->to('/login')->with('error', 'Invalid request.');
        }
        if (strlen($password) < 6) {
            return redirect()->back()->with('error', 'Password must be at least 6 characters')->withInput();
        }
        if ($password !== $passwordConfirm) {
            return redirect()->back()->with('error', 'Passwords do not match')->withInput();
        }

        $prModel = new \App\Models\PasswordResetModel();
        $row = $prModel->where('selector', $selector)->first();
        if (! $row || strtotime($row['expires_at']) < time()) {
            return redirect()->to('/login')->with('error', 'Reset link invalid or expired.');
        }

        // Verify token matches hash
        if (! password_verify($token, $row['token_hash'])) {
            // Optionally delete this reset row to avoid repeated attempts
            $prModel->delete($row['id']);
            return redirect()->to('/login')->with('error', 'Invalid reset token.');
        }

        // Update user's password
        $userModel = new UserModel();
        $user = $userModel->find($row['user_id']);
        if (! $user) {
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        $userModel->update($user['id'], ['password_hash' => password_hash($password, PASSWORD_DEFAULT)]);

        // Invalidate used token
        $prModel->delete($row['id']);

        return redirect()->to('/login')->with('success', 'Password reset successful. Please login with your new password.');
    }
}


