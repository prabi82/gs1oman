<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandler {
    private $mail;
    
    public function __construct() {
        $this->mail = new PHPMailer(true);
        
        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host = 'host33.theukhost.net';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'info@gs1oman.com';
        $this->mail->Password = '9rsE@+3M[f*&';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
        
        // Default sender
        $this->mail->setFrom('info@gs1oman.com', 'GS1 Oman');
    }
    
    public function sendRegistrationEmail($userData) {
        try {
            $this->mail->addAddress($userData['user_email']);
            $this->mail->addAddress('info@gs1oman.com');
            
            $this->mail->isHTML(true);
            $this->mail->Subject = 'GS1 Oman Registration Status';
            
            // Build email body based on status
            $statusMessage = '';
            switch($userData['status']) {
                case '0':
                    $statusMessage = '<span style="color:#ff9900">Once your application is approved, you will get an activation email with the login details.</span>';
                    break;
                case '1':
                    $statusMessage = '<span style="color:#009900">Your account is Approved successfully</span>';
                    break;
                case '2':
                    $statusMessage = '<span style="color:#cc0000">Your registration request is Rejected!</span>';
                    break;
                case '3':
                    $statusMessage = '<span style="color:#ff0000">Your account is disabled or blocked for a short period</span>';
                    break;
            }
            
            $this->mail->Body = $this->getEmailTemplate($userData, $statusMessage);
            $this->mail->AltBody = strip_tags($this->mail->Body);
            
            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function sendErrorNotification($errorMessage) {
        try {
            $this->mail->addAddress('info@gs1oman.com');
            $this->mail->isHTML(true);
            $this->mail->Subject = 'GS1 Oman System Error';
            $this->mail->Body = "An error occurred in the system:<br><br>" . htmlspecialchars($errorMessage);
            $this->mail->AltBody = strip_tags($this->mail->Body);
            
            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Error notification failed: " . $e->getMessage());
            throw $e;
        }
    }
    
    private function getEmailTemplate($userData, $statusMessage) {
        $loginUrl = 'https://gs1oman.com/user/';  // The portal login URL
        
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { text-align: center; padding: 20px; }
                .content { padding: 20px; background-color: #f9f9f9; }
                .footer { text-align: center; padding: 20px; color: #666; }
                .login-button { 
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    margin: 20px 0;
                }
                .login-button:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="https://gs1oman.com/images/logo.png" alt="GS1 Oman Logo" style="max-width: 200px;">
                </div>
                <div class="content">
                    ' . $statusMessage . '
                    <h3>Registration Details:</h3>
                    <ul>
                        <li>Company Name: ' . htmlspecialchars($userData['name']) . '</li>
                        <li>Mobile Number: ' . htmlspecialchars($userData['mobile_number']) . '</li>
                        <li>Email: ' . htmlspecialchars($userData['user_email']) . '</li>
                        <li>Password: ' . htmlspecialchars($userData['password']) . '</li>
                    </ul>
                    <div style="text-align: center;">
                        <a href="' . $loginUrl . '" class="login-button" style="color: white;">
                            Click here to login to your account
                        </a>
                    </div>
                    <p style="margin-top: 20px;">
                        <strong>Login URL:</strong> <a href="' . $loginUrl . '">' . $loginUrl . '</a>
                    </p>
                </div>
                <div class="footer">
                    <p>This is an automated message, please do not reply.</p>
                </div>
            </div>
        </body>
        </html>';
    }
} 