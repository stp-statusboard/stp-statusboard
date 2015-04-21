# STP Statusboard

Simple project created by Schibsted Tech Polska that utilizes Silex power in order to create a status board for many
projects.

## Requirements

- php
- composer
- node and npm

## Installation

In the project directory run the following command:

```
composer install
```

This command will install all project dependencies including the ones listed in `package.json` and `bower.json`.

## Running

In order to run the project you just need to run following command in project root directory:

```
node_modules/.bin/grunt serve
```

The command will run php internal web server and open web browser window.

## Testing & Code quality

There are couple code quality tools installed:

```
node_modules/.bin/grunt phpcs
node_modules/.bin/grunt phpcpd
node_modules/.bin/grunt phpmd
node_modules/.bin/grunt jshint
```
