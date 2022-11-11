
# turkticaret.net Case - İbrahim KONUK

Git clone ardından .env dosyasında database ayarlarını yapınız.



## .env Database ayarları

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=case
DB_USERNAME=root
DB_PASSWORD=
```
## Migration & Seed And Run Application
Komut satırına gelerek;
  
  ```
php artisan migrate --seed
php artisan serve
  ```
  Komutunu uygulayınız. 
  ## API İşlemleri
Hazır işlemler için e-mail eki olarak gönderdiğim POSTMAN Collection'u kullanabilirsiniz.