Ajax Login Form Bundle
=========

A simple AJAX form login for Symfony 2.

## Prerequisites

This version of the bundle requires Symfony 2.x.

## Installation

### Step 1: Download AjaxLoginBundle using composer

In your composer.json, add AjaxLoginBundle :

```js
{
    "require": {
        "divi/ajax-login-bundle": "dev-master"
    }
}
```

Now, you must update your vendors using this command :

``` bash
$ php composer.phar update divi/ajax-login-bundle
```

### Step 2: Enable the bundle

Enable the bundle using the AppKernel :

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Divi\AjaxLoginBundle\DiviAjaxLoginBundle(),
    );
}
```

### Step 3: Configure your project

Configure your form login using security.yml, replace "form_login" authentication by "ajax_form_login"

``` yaml
# app/config/security.yml
security:
    firewalls:
        main:
            pattern: ^/
            ajax_form_login:
                # ...
```

## How to use

### Examples

Two examples are available in the `Resources/views/Login` folder. Note: jQuery is required for these two examples. If not exists, it will be loaded dynamically (with Google API).
The first example works with the AcmeBundle (Symfony standard) form login, the second with the [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) form login.

If you want to use the javascript part on your login twig form, just include the init file :

``` twig
{% include 'DiviAjaxLoginBundle:Javascript:init.html.twig' with {'form_selector': '#your_form_id'} %}
```

## Issue or new feature ?

Feel free to post your issue or feature request in the [issue tracker](https://github.com/Divi/AjaxLoginBundle/issues) !

## TODO

### Translations for error messages
