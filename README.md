A super simple light-weighted web client for browsing and playing your music folder on web.  

## System Requirements
- PHP >= 5.4

## Installation
1. secure your web using basic auth.  
2. Specify the location to your music folder in web server config.  
3. Specify the location to your music folder in `ajax.php`.  

Nginx config example
```
server {
        listen 443 ssl http2;
        server_name music.your.domain;

        location / {
                auth_basic "Please Login";
                auth_basic_user_file /etc/nginx/password.htpasswd;
                root /var/www/music;
                index index.php index.html index.htm;
                try_files $uri $uri/ /index.php;
        }
        location ~ \.php$ {
                root /var/www/music;
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_param  SCRIPT_FILENAME   $document_root$fastcgi_script_name;
                include        fastcgi_params;
        }
        location ~ \.(mp3|jpg)$ {
                root "/path/to/your/Music";
        }
}
```

## Music Folder Structure
Your must convert all your music files to MP3 format.  
Each album should be stored in one folder.  
The album cover should be named `cover.jpg` and put in the same folder where MP3s are located.  
