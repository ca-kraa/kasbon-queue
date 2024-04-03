## Instalasi

1. Clone Repositori

    ```bash
    git clone https://github.com/ca-kraa/kasbon-queue.git
    ```

2. Instal Dependencies

    ```bash
    cd kasbon-queue
    composer install
    ```

3. Setup Environment
   <br> Buat file .env dari contoh .env.example dan atur koneksi database serta konfigurasi queue yang dibutuhkan.

4. Jalankan Worker Queue

    ```php
    php artisan queue:work --queue=setujui-kasbon
    ```

5. Akses API
   <br>
   Akses API menggunakan Postman atau aplikasi sejenis dengan URL yang sesuai.

## Endpoint API

1. Pegawai

    - Check All Pegawai (GET)

        ```php
        /pegawai/{page}
        ```

    - Create Data Pegawau (POST)
        ```php
        /create-pegawai
        ```

2. Kasbon

    - Check All Kasbon (GET)
        ```php
        /kasbon
        ```
    - Create Kasbon (POST)
        ```php
        /create-kasbon
        ```
    - Update Status Kasbon (PATCH)
        ```php
        /kasbon/setujui/{id}
        ```
    - Update All Statys Kasbon (POST)
        ```php
        /kasbon/setujui-masal
        ```
