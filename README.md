# BeSMS Notifications Channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/velostazione/laravel-besms.svg)](https://packagist.org/packages/velostazione/laravel-besms)
[![Total Downloads](https://img.shields.io/packagist/dt/velostazione/laravel-besms.svg)](https://packagist.org/packages/velostazione/laravel-besms)
![PHP 8.0.10](https://img.shields.io/badge/php-8.0.10-474a8a.svg?logo=php)
![Laravel 8](https://img.shields.io/badge/laravel-8-fb503b.svg?logo=laravel)

BeSMS Notifications Channel for Laravel


### Installation

```bash
composer require velostazione/laravel-besms
```

Add the configuration to your `.env` file:

```bash
BESMS_USERNAME=
BESMS_PASSWORD=
BESMS_API_ID=
BESMS_REPORT_TYPE= # Default: C
BESMS_SENDER= # Default: null
```

### Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use \Velostazione\Laravel\BeSMSChannel;

class YourNotification extends Notification
{
    public function via($notifiable): array
    {
        return [BeSMSChannel::class];
    }

    public function toBeSMS($notifiable): BeSMSMessage
    {
        $message = new BeSMSMessage();
        $message->content("Hello {$notifiable->name}!");
        $message->sender("Me");
        return $message;
    }
}
```
