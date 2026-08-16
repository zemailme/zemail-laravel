# Zemail Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zemailme/zemail-laravel.svg?style=flat-square)](https://packagist.org/packages/zemailme/zemail-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/zemailme/zemail-laravel.svg?style=flat-square)](https://packagist.org/packages/zemailme/zemail-laravel)
[![License](https://img.shields.io/packagist/l/zemailme/zemail-laravel.svg?style=flat-square)](https://packagist.org/packages/zemailme/zemail-laravel)
[![PHP Version](https://img.shields.io/packagist/php-v/zemailme/zemail-laravel.svg?style=flat-square)](https://packagist.org/packages/zemailme/zemail-laravel)

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

```php
use Zemail\Laravel\Zemail;

// 1. Get your account details
$account = Zemail::account()->get();
echo "My balance: " . $account->balance;

// 2. Fetch available domains
$domains = Zemail::domains()->list();
foreach ($domains as $domain) {
    echo $domain->domain . PHP_EOL;
}

// 3. Create a temporary mailbox
$mailbox = Zemail::mailboxes()->create('example.com');
echo "New email address: " . $mailbox->address;
```

> **Note:** This package is a lightweight wrapper around the core [`zemail-php` SDK](https://github.com/zemailme/zemail-php). All methods and models available in the core SDK are automatically available here!

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