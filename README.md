# Zemail Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zemailme/zemail-laravel.svg?style=flat-square)](https://packagist.org/packages/zemailme/zemail-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/zemailme/zemail-laravel/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/zemailme/zemail-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![PHP Version](https://img.shields.io/packagist/php-v/zemailme/zemail-laravel.svg?style=flat-square)](https://packagist.org/packages/zemailme/zemail-laravel)
[![License](https://img.shields.io/github/license/zemailme/zemail-laravel?style=flat-square)](https://github.com/zemailme/zemail-laravel/blob/main/LICENSE)

The official Laravel wrapper for the [Zemail API](https://zemail.me). Generate disposable, temporary emails, fetch messages, and manage your account seamlessly from within your Laravel applications.

---

## 📦 Installation

You can install the package via composer:

```bash
composer require zemailme/zemail-laravel
```

## ⚙️ Configuration

Publish the configuration file with:

```bash
php artisan vendor:publish --tag="zemail-config"
```

This will create a `config/zemail.php` file in your app. Add your API key to your `.env` file:

```env
ZEMAIL_API_KEY=your_api_key_here
```

## 🚀 Usage

You can access the API fluently using the `Zemail` Facade.

### 1. Account & Subscription

Access your account profile, active plan, and API/mailbox usage limits:

```php
use Zemail\Laravel\Zemail;

// Get account profile
$account = Zemail::account()->get();
echo "Account ID: {$account->id}, Email: {$account->email}, Tier: {$account->tier}\n";

// Get active subscription
$subscription = Zemail::account()->subscription();
echo "Status: {$subscription->status}, Tier: {$subscription->tier}\n";

// Get current resource & API usage
$usage = Zemail::account()->usage();
print_r($usage->mailboxes);
print_r($usage->storage);
print_r($usage->developerApi);
```

---

### 2. Domains

List available domains for mailbox creation:

```php
$domains = Zemail::domains()->list();

foreach ($domains->data as $domain) {
    echo "Domain: {$domain->name} (Types: " . implode(', ', $domain->allowedTypes) . ")\n";
}
```

---

### 3. Mailboxes

#### List Mailboxes
```php
$mailboxes = Zemail::mailboxes()->list(page: 1, limit: 10);

foreach ($mailboxes->data as $mailbox) {
    echo "Mailbox: {$mailbox->address} (ID: {$mailbox->id})\n";
}

if ($mailboxes->hasMore) {
    echo "Next cursor: {$mailboxes->nextCursor}\n";
}
```

#### Create a Random Mailbox
```php
$mailbox = Zemail::mailboxes()->create([
    'type' => 'random',
]);

echo "Created random mailbox: {$mailbox->address}\n";
```

#### Create a Custom Mailbox
```php
$mailbox = Zemail::mailboxes()->create([
    'type' => 'custom',
    'domain' => 'zemail.me',
    'username' => 'my-inbox',
]);

echo "Created custom mailbox: {$mailbox->address}\n";
```

#### Get Mailbox Details
```php
$mailbox = Zemail::mailboxes()->get(123);
echo "Address: {$mailbox->address}, Unread emails: {$mailbox->unreadCount}\n";
```

#### Delete a Mailbox
```php
$deleted = Zemail::mailboxes()->delete(123);
// Returns true on success
```

---

### 4. Emails & Attachments

#### List Emails in a Mailbox
```php
// List recent emails with optional search query
$emails = Zemail::mailboxes()->emails()->list(
    mailboxId: $mailbox->id,
    page: 1,
    limit: 25,
    search: 'verification'
);

foreach ($emails->data as $email) {
    echo "[{$email->id}] From: {$email->sender} | Subject: {$email->subject}\n";
}
```

#### Get Full Email Details
```php
$email = Zemail::mailboxes()->emails()->get($mailbox->id, $emailId);

echo "Subject: {$email->subject}\n";
echo "Plain text body: {$email->bodyText}\n";
echo "HTML body: {$email->bodyHtml}\n";

// Inspect attachments
foreach ($email->attachments as $attachment) {
    echo "Attachment: {$attachment->name} ({$attachment->size} bytes)\n";
}
```

#### Mark Email as Read
```php
$isRead = Zemail::mailboxes()->emails()->markAsRead($mailbox->id, $emailId);
```

#### Get Temporary Attachment Download URL
```php
$download = Zemail::mailboxes()->emails()->getAttachmentDownloadUrl(
    mailboxId: $mailbox->id,
    emailId: $emailId,
    attachmentId: 'att_123'
);

echo "Download URL: {$download['url']}\n";
echo "Expires at: {$download['expires_at']}\n";
```

#### Delete an Email
```php
$deleted = Zemail::mailboxes()->emails()->delete($mailbox->id, $emailId);
// Returns true on success
```

> **Note:** This package is a lightweight wrapper around the core [`zemail-php` SDK](https://github.com/zemailme/zemail-php). All methods, error handling, and models available in the core SDK are automatically available here via the Facade!

## 🧪 Testing

```bash
composer test
```

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🔒 Security

If you discover any security related issues, please email support@zemail.me instead of using the issue tracker.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.