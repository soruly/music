A super simple web music library with just nginx and one index.html file.
No server side script, no javascript dependencies.

## System Requirements
- Nginx >= 1.7.9

## Installation
Put `index.html` in `/var/www/music`
Configure Nginx
```
server {
        listen 443 ssl http2;
        server_name music.your.domain;

        location / {
            root /var/www/music;
            try_files $uri /index.html;
        }

        location /api {
            autoindex on;
            autoindex_format json;
            alias "/mnt/Data/Music";
        }

        location /file {
            alias "/mnt/Data/Music";
        }
}
```

## Music Folder Structure
Your must convert all your music files to browser playable format.  
Each album should be stored in one folder.  
The album cover should be named `cover.jpg` and put in the same folder.

