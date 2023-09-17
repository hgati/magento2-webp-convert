# Hgati Webp (supported PHP 8.2)

Magento2 module for images conversion to webp format.


## Requirements

* PHP >= **8.2**
* Cwebp >= **0.5.2**
* libvips >= **8.4.5**
* Magento >= **2.4**

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
    sudo apt-get install libvips-dev
    
    pecl install vips
    ```
    
    Add `extension=vips.so` to **php.ini** file.

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
