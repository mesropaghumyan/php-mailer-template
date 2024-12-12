# Install project
`git clone https://github.com/mesropaghumyan/php-mailer-template.git`
`cd php-mailer-template`

# Install PHP Mailer
`composer install`

# Configure SMTP
`cp .env.example .env`
`nano .env`

# Run script
`php index.php <attachment_name> <attachment_path>`

PS : if you don't need send attachments, delete or comment these lines and run script with `php index.php` :
```php
if ($argc !== 3) {
    echo "Usage: php mailer/index.php <attachment_name> <attachment_path>\n";
    exit(1);
}

$attachment_name = $argv[2];
$attachment_path = $argv[3];

$mail->addAttachment($attachment_path, $attachment_name);
```
