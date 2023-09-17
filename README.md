# Hgati Webp (supported PHP 8.2)

- Magento2 module for images conversion to webp format with save a product.
- Deleted all the unnecessary things from the bug-ridden original source code. (it sucks)

## Requirements

* PHP >= **8.2.8**
* Cwebp >= **0.5.2**
* libvips >= **8.4.5**
* Magento >= **2.4.6**

## Installation

1. Webp support

    ```shell script
    sudo apt-get install libwebp-dev
    sudo apt-get install webp
    ```
   
   You must also enable GD-support.
   
   Make sure that You have this extension.
   
    ```shell script
   sudo apt-get install phpX-gd
   ```
   
   Where x is PHP version (i. e. 8.2).
   
   Next configure PHP to enable support for webp format.
   
    ```shell script
    --with-webp-dir=DIR
    ```   
   
2. Vips extension

    ```shell script
    echo "Installing vips library"
    sudo apt-get install libvips-dev
    
    echo "Installing vips pecl extension"
    $PHP_VER=8.2
    printf "\n" | sudo pecl install vips
    
    [ -d /etc/php/$PHP_VER/mods-available ] && echo 'extension=vips.so' | sudo tee /etc/php/$PHP_VER/mods-available/vips.ini
    [ -d /etc/php/$PHP_VER/mods-available ] && sudo ln -sf /etc/php/$PHP_VER/mods-available/vips.ini /etc/php/$PHP_VER/fpm/conf.d/20-vips.ini
    [ -d /etc/php/$PHP_VER/mods-available ] && sudo ln -sf /etc/php/$PHP_VER/mods-available/vips.ini /etc/php/$PHP_VER/cli/conf.d/20-vips.ini
    # OR Add `extension=vips.so` to **php.ini** file.
    ```

3. Module

    ```shell  
    composer require hgati/magento2-webp-convert
    
    php bin/magento module:enable Hgati_Webp
    
    php bin/magento setup:upgrade
    
    php bin/magento setup:di:compile
    
    php bin/magento setup:static-content:deploy -f
    ```

## Usage

#### **Stores > Configuration > CATALOG > Webp**

* **General->Enabled** - module activation
* **Settings->Algorithm** - choose one from three method types 
* **Settings->Quality** - quality of converted image
* **Conversion->Convert images on product save** - if selected,
 after uploaded images on product page and save product, images will be converted automatically
 
#### Catalog->Products

Upload images in **Images And Videos** tab.

Update changes by click on **Save** button.

All images assigned to product should be converted with **.ngx.webp** file extension in same directory.

- It is more effective when used in conjunction with Nginx.
    - https://vincent.bernat.ch/en/blog/2021-webp-avif-nginx
- Configuring AWS CloudFront CDN to cache webp files is advisable.
    - https://www.friism.com/webp-content-negotiation-cloudfront/

