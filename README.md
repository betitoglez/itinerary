# Itinerary generator

# What is Itinerary Generator?

Itinerary Generator is a tool to calculate a valid route from a set of unsorted cards given by the user.

Itinerary provides 2 interfaces to calculate a valid route: Command Line Tool and Web Interface Portal. 

# Requirements

* PHP 7.1.X
* PHP-CLI extension
* PHPUnit 6.1 (Included in Composer file)
* Composer

## Why PHP 7.1.X?

The main reason to use PHP 7.1 for this project is because an stronger OOP (such Java) was required.
Working with PHP 7.1 we have some OOP features not available in older releases. Please refer to [PHP Official Documentation](http://php.net/manual/en/migration71.new-features.php "Documentation") for further information.
 
## Why PHP Unit 6.1.X?

Basically because it is the latest stable version and it is compatible with PHP 7.1. [PHPUnit Official Web](https://phpunit.de/index.html "Offical Documentation")

#Installing 

First of all let's download the project from GitHub

```shell
git clone https://github.com/betitoglez/itinerary
```

Now let's install dependencies for PHPUnit (PHPDoc is also included in the composer file, if you don't want it just remove that entry from composer.json file).

```shell
cd itinerary;
composer install;
```


## Testing Locally
Despite it's possible to create a new VHost (an Apache VHost conf file is available within "config" folder), it's also possible testing using the built-in PHP Dev Webserser.
To do that just navigate to the public "www" folder and start the server there pointing to the router.php file:

```shell
    cd www/;
    php -S 0.0.0.0:8080 ../router.php;
```
 Make sure you use a valid IP address (0.0.0.0 covers all the network, so in case of doubt just use that), and an available port.
 
 Then navigate in your browser to the given IP:PORT address and check if everything works fine.
 
 ## Using the CLI tool
 
 A Command Line tool is also available, to see it working just create an "input.txt" file in the project root path and provide a valid JSON estructure. Then run the script "itinerary" and a "output.txt" json file will be created if a valid estructure was provided.
 
 ```shell
 php itinerary
 ```
 
# Documentation
PHP Documentation is available within /www/doc folder. A LIVE doc is available also [here](http://itinerary.phphtmlfreelance.com/doc).

# Live example
A High Performance Demo Web is also availble at [itinerary.phphtmlfreelance.com](http://itinerary.phphtmlfreelance.com). This request will be handled by a Varnish HTTP Cache Server, and it will processed, if needed, by an Apache 2.4 Server with PHP-FPM 7.1. PHP Configuration is also available [here](http://itinerary.phphtmlfreelance.com/info.php)
