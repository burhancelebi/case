## Task Test Edilmesi

Veritabanını kurduğumuzda aşağıdaki komutları sırasıyla çalıştırıyoruz.
    
    docker-compose up -d
    docker-compose exec -it case sh
    php artisan migrate --seed

Bu üç komutu çalıştırdıktan sonra proje dosyalarının
içine koyduğum Postman 
koleksiyonunu import edip endpointleri test edebilirsiniz.
