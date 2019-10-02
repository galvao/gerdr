# Gerdr

![Gerdr Logo](https://raw.githubusercontent.com/galvao/gerdr/master/media/Gerdr350.png)

Manipulate DOM HTML trees, powered by PHP's DOM extension.

## Install
```bash
composer require galvao/gerdr
```

## Usage

* As an application

```bash
/path/to/gerdr/bin/gerdr -c /path/to/config.json -d /path/to/dom.html
```

As an application Gerdr outputs the modified DOM HTML so it can be piped, forwarded, etc... to any bash application.

* In your project:

```php
try {
    $gerdr = new Gerdr($dom, $config);
} catch (\Exception $e) {
    // Treat the exception
}

try {
    $gerdr->process();
} catch (\Exception $e) {
    // Treat the exception
}

$result = $gerdr->getModifiedDom();
```


## Dependencies
* [PHP >= 7.3](https://www.php.net)
* [League's CLImate](https://climate.thephpleague.com/)
* [Monolog](https://github.com/Seldaek/monolog)

## Actions

As of now Gerdr only removes elements/attributes with the `remove` action.

## Acknowledgements

* Gerdr's logo has a fragment from ["Skírnir and Gerðr I"](https://en.wikipedia.org/wiki/File:Sk%C3%ADrnir_and_Ger%C3%B0r_I_by_Fr%C3%B8lich.jpg), by [Lorenz Frølich](https://en.wikipedia.org/wiki/Lorenz_Fr%C3%B8lich);
* The font used in the logo is ["Norse"](https://www.dafont.com/norse.font), by [Joël Carrouché](https://www.joelcarrouche.com).