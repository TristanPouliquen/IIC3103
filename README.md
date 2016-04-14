# IIC3103-Proyecto10

## Project installation

### Download the project from Github

Use `git clone` to clone the current repository to your computer.

You can also use Github's desktop application.

### Install Composer

Get Composer from their [official website](https://getcomposer.org) and follow their
instructions to install on your computer.

### Install the project libraries

In the project folder, open a terminal and run `composer install` to automatically install
all the dependencies of the project

### Set up the project locally

If not already done with `composer install`, opy the `app/config/parameters.yml.dist`
in a new file `app/config/parameters.yml` indicating the credentials of your computer's installation where needed.

Run `php bin/console doctrine:migrations:migrate` to be sure that you have the latest migrations on your computer

### Launch the project locally

To run the project on your computer, you can simply run `php bin/console server:run` or configure a virtual machine
if you know how to.