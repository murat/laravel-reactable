# Reactable for Laravel 5.x

Easy to use reactions, like Slack, for your Laravel models. Without the pain.

## Installation

Go to your project's root folder and run the composer require command.

    $ cd projects/project
    $ composer require muratbsts/laravel-reactable dev-master

Then run this command for publishing migration file.

    $ php artisan vendor:publish --provider="Muratbsts\Reactable\Providers\ReactableServiceProvider" --tag="migrations"

If you are on Laravel **5.5**, the package will automatically be loaded into the framework.

If you are on Laravel version **5.0 - 5.4**, add the service provider to config/app.php file:

```php
<?php
...
'providers' => [
    ...
    Muratbsts\MailTemplate\Providers\ReactableServiceProvider::class,
    ...
],
...
```

## Usage

Use package as like below in your models

```php

// Post model
use Muratbsts\Reactable\Traits\Reactable;

class Post extends Model
{
    use Reactable;
    ...
    ...
}


// User model
use Muratbsts\Reactable\Traits\Reactor;

class User extends Model
{
    use Reactor;
    ...
    ...
}
```

And do make some reactions as like below

```php

# Get an user's reactions
User::find(1)->reactions()->get();

# Get an post's reactions
Post::find(1)->reactions()->get();

# Make a reaction with Reactor
Post::find(1)->reaction('claps', User::find(1)); // Reaction, Reactor

# Or with Reactable
User::find(1)->reaction('claps', Post::find(1)); // Reaction, Reactable
```

🎉 Cheers! That's it!

## License

[MIT](./LICENSE) © [Murat Bastas](http://muratbt.com)
