# DR_LoginAsCustomer
Allows admin users to login as a specified customer.

## Description
This module allows to login as a specified customer from backend. The button respectively link display on customer grid and form. Each login will be logged in the file "system.log".

## Installation

### Via composer
Open the command line and run the following commands
```
cd PATH_TO_MAGENTO_2_ROOT
composer require dr/loginascustomer
```

### Via archive
* Download the ZIP-Archive
* Extract files
* Copy the extracted Files to PATH_TO_MAGENTO_2_ROOT/app/code/DR/LoginAsCustomer
* Run the following Commands:
```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

## Support
If you have any issues with this extension, open an issue on GitHub (see URL above).

## Contribution
Any contributions are highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests/).

## Developer
Daniel Rose

* Xing: https://www.xing.com/profile/Daniel_Rose16

## Licence
[MIT License](https://opensource.org/licenses/MIT)

## Copyright
(c) 2015 Daniel Rose