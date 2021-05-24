# Mage2 Module Harriswebworks Slider

    harriswebworks/module-slider

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 


## Main Functionalities
Accustandard Slider

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Harriswebworks`
 - Enable the module by running `php bin/magento module:enable Harriswebworks_Slider`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.hww-slider vcs git@github.com:harriswebworks/slider.git`
 - Install the module composer by running `composer require harriswebworks/module-slider`
 - enable the module by running `php bin/magento module:enable Harriswebworks_Slider`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration






