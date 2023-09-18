# Hgati Webp (supported PHP 8.2)

- Magento2 module for images conversion to webp format with save a product.
- It's better to create a bash script with a scheduled job using the cwebp executable to convert to webp every day, rather than doing it this way.

```bash
#!/usr/bin/env bash
# AWS CloudFront CDN Conditional WebP Caching, https://www.friism.com/webp-content-negotiation-cloudfront/
# WebP,AVIF + NGINX = https://vincent.bernat.ch/en/blog/2021-webp-avif-nginx

BASEDIR=/var/www/magento
###################################################################
# Convert all images to WebP format (if not exists .webp in same directory)
declare -A TARGET_DIRS
TARGET_DIRS[0]=$BASEDIR/pub/media/catalog/category
TARGET_DIRS[1]=$BASEDIR/pub/media/catalog/product
TARGET_DIRS[2]=$BASEDIR/pub/media/logo
TARGET_DIRS[3]=$BASEDIR/pub/media/magefan_blog
TARGET_DIRS[4]=$BASEDIR/pub/media/wysiwyg
TARGET_DIRS[5]=$BASEDIR/pub/media/resized
TARGET_DIRS[6]=$BASEDIR/pub/media/blog/cache

# Cleanning all generated .webp images
if [ "$1" = "clean" ]; then
	for TARGET_DIR in ${TARGET_DIRS[@]}; do
		echo "Deleting *.ngx.WebP | ${TARGET_DIR} ..."
		find $TARGET_DIR -type f -iname '*.webp' | while read filepath
		do
			CURR_DIR=$(dirname $filepath)
			SRC_FILE=$(basename $filepath .webp)
			[ -f "$CURR_DIR/$SRC_FILE" ] && echo $filepath && rm $filepath
		done
	done
else
	for TARGET_DIR in ${TARGET_DIRS[@]}; do
		echo "Converting JPG,PNG,GIF to .ngx.WebP | ${TARGET_DIR} ..."

		# JPG to WebP > Optimize JPG
		find $TARGET_DIR -type f -regex ".*\.\(jpe?g\)$" | while read filepath
		do 
			[ ! -f "$filepath.webp" ] && cwebp -q 65 -af $filepath -o $filepath.webp -quiet \
				&& jpegoptim --max=80 --all-progressive --strip-all --quiet $filepath
		done

		# PNG to WebP > Optimize PNG
		find $TARGET_DIR -type f -regex ".*\.\(png\)$" | while read filepath
		do 
			[ ! -f "$filepath.webp" ] && cwebp -q 65 -af $filepath -o $filepath.webp -quiet \
				&& pngquant --skip-if-larger --strip --ext .png --force -- $filepath
		done
		
		# GIF to WebP
		find $TARGET_DIR -type f -regex ".*\.\(gif\)$" | while read filepath
		do 
			[ ! -f "$filepath.webp" ] && gif2webp -q 65 $filepath -o $filepath.webp -quiet
		done
	done
fi

echo "------- THE END ------------------------------------------------"
```

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

