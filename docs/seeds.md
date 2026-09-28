# Seeds

[Back to README](../README.md)

## Seeded Roles

- Unverified - Level 0
- User - Level 1
- Administrator - Level 5

## Seeded Permissions

- view.users
- create.users
- edit.users
- delete.users

## Seeded Users

| Email           | Password | Access       |
| :-------------- | :------- | :----------- |
| <user@user.com>   | password | User Access  |
| <admin@user.com> | password | Admin Access |

## Themes Seed List

- [ThemesTableSeeder](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeders/ThemesTableSeeder.php)
- NOTE: A lot of themes render incorrectly on Bootstrap 4 since their core was built to override Bootstrap 4. These will be updated soon and ones that do not render correctly will be removed from the seed. In the mean time you can remove them from the seed or manaully from the UI or database.

## Blocked Types Seed List

- [BlockedTypeTableSeeder.php](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeders/BlockedTypeTableSeeder.php)

| Slug        | Name         |
| :---------- | :----------- |
| email       | E-mail       |
| ipAddress   | IP Address   |
| domain      | Domain Name  |
| user        | User         |
| city        | City         |
| state       | State        |
| country     | Country      |
| countryCode | Country Code |
| continent   | Continent    |
| region      | Region       |

## Blocked Items Seed List

- [BlockedItemsTableSeeder.php](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeders/BlockedItemsTableSeeder.php)

| Type   | Value          | Note                                     |
| :----- | :------------- | :--------------------------------------- |
| domain | test.com       | Block all domains/emails @test.com       |
| domain | test.ca        | Block all domains/emails @test.ca        |
| domain | fake.com       | Block all domains/emails @fake.com       |
| domain | example.com    | Block all domains/emails @example.com    |
| domain | mailinator.com | Block all domains/emails @mailinator.com |
