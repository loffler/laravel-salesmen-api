## Salesmen API

This is a simple CRUD API for managing salesmen. Built using Laravel 9.

# Setup
1. copy `.env.example` to `.env` and update the values to your needs.
2. run `composer install`
3. Run docker `./vendor/bin/sail up`
4. Run database migrations `./vendor/bin/sail  php artisan migrate`
5. Seed the database with initial data from CSV file: `./vendor/bin/sail php artisan db:seed --class=SalesmanSeeder`
6. You're ready to go! You can now make requests e.g. like this:
```shell
$ curl localhost/salesmen?per_page=1\&sort=first_name|jq
{
  "data": [
    {
      "id": "1b7d374d-e176-4350-ba26-48807a79c697",
      "first_name": "bob",
      "last_name": "doe",
      "titles_before": null,
      "titles_after": [
        "ArtD.",
        "PhD.",
        "CSc."
      ],
      "prosight_id": "12347",
      "email": "bob@doe.sk",
      "phone": "+421908100100",
      "gender": "m",
      "marital_status": "single",
      "created_at": "2023-02-09T12:34:34+00:00",
      "updated_at": "2023-02-09T12:34:34+00:00",
      "display_name": " bob doe ArtD. PhD. CSc.",
      "self": "/salesmen/1b7d374d-e176-4350-ba26-48807a79c697"
    }
  ],
  "links": {
    "first": "http://localhost/salesmen?page=1",
    "last": "http://localhost/salesmen?page=3",
    "prev": null,
    "next": "http://localhost/salesmen?page=2"
  }
}
