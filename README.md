## Installation Steps

```
git clone git@github.com:x-ahmed/file-upload-issue-reproduction.git
```

```
copy .env.example to .env (replace .env values if needed)
```

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
 
```
./vendor/bin/sail up
```

```
./vendor/bin/sail artisan key:generate
```

```
./vendor/bin/sail artisan migrate
```

```
./vendor/bin/sail artisan make:filament-user
```

```
./vendor/bin/sail artisan storage:link
```


### Steps to reproduce the bug

1. Browse to `http://localhost/admin/users/create`

2. There are two file upload inputs first is the regular filament file upload (that has the issue) and the other is a custom file upload with the issue resolved.

3. Fill the form inputs and upload an image to each then after the upload is completed click "tap to undo" (revert the uploaded file from both) then submit the form.

4. The expected behavior is that both images won't be stored in DB.

5. In the actual behavior, the filament file upload would store the reverted image name in DB whereas the custom file upload that sets the state to null when the image is reverted would have a NULL value stored in DB.
