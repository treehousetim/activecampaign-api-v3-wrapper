# ActiveCampaign API v3 Wrapper


Wrapper for ActiveCampaign API v3.
Allows to make calls in ActiveCampaign services and work with data, using PHP. Simple and easy to use.
Services available so far:
- Lists
- Contacts
- Tags
- Custom Fields

## Official API documentation

https://developers.activecampaign.com/v3/reference

## Installation

**ActiveCampaign API v3 Wrapper** is available on Packagist. Just add this line to your **composer.json** file in **require** section

```json
"treehousetim/activecampaign-api-v3-wrapper": "^1.0"
```

or open terminal window and run

```bash
composer require treehousetim/activecampaign-api-v3-wrapper
```

## Usage

Wrapper allows you to chain methods and use a single instance to apply all needed filters and queries.

### Setup

```php
<?php

// include required classes
require 'vendor/autoload.php';

use treehousetim\ActiveCampaign\ActiveCampaign;

// using hard coded values
$ac = new ActiveCampaign( 'ACTIVE_CAMPAIGN_URL', 'ACTIVE_CAMPAIGN_KEY');

// using environment variables
$ac = new ActiveCampaign();
```

**Using Environment Variables requires entries in a .env file or in your environment**

### Get service models

To get access to the active campaign api endpoints, you will need to create a service model first.

```php
// lists
$lists = $ac->lists();

// contacts
$contacts = $ac->contacts();

// tags
$tags = $ac->tags();

// custom fields
$fields = $ac->customFields();

```

### Basic example

To retrieve all lists, call the `->all()` method. This method should be always at the very end of your chain sequence:

```php
$lists = $ac->lists()->all();
```
_Note that by default the Active Campaign API returns 20 items._

### Pagination

https://developers.activecampaign.com/reference/pagination

Pagination allows you to get needed amount of items and make offsets.
Note the API limit is 100 items max.


```php

// fetch the first 50 lists
$limit = 50;
$offset = 0;

$paginated_lists = $ac->lists()->paginate( $limit, $offset )->all();
```

### Sorting

https://developers.activecampaign.com/v3/reference#section-ordering
You can sort results in needed order. Use `->orderby()` method and pass as argument an array, where key is the name of field and value is order (asc or desc).
 
```php
// get all contacts and sort them by email in asc order and by last name in desc order
$contacts = $ac->contacts()->orderby( ['email' => 'asc', 'lastName' => 'desc'] )->all();
```

### Filtering

https://developers.activecampaign.com/v3/reference#section-filtering
You can filter results by multiple parameters. Use `->filter()` method and pass an array as argument, where key is parameter name and value is parameter value.

```php
// get contacts where first name is equal to John
$contacts = $ac->contacts()->filter(['firstName' => 'john'])->all();
```

### URL Queries

Additionaly, you can add any parameter to url that will be send to activecampaign endpoint. Use `->query()` method and pass as argument an array with parameters key and value

```php
$ac->tags()->query(['foo' => 'bar'])->all();
```

### Get item by ID

To access any item by it's ID, use `->get($id)` method.

```php
// get tag with ID == 1
$tag = $ac->tags()->get(1);
```

### Advanced examples

```php
// skip 10 tags and get next 50 tags, also order them by description
$tags = $ac->tags()->orderby(['description' => 'asc'])->paginate(50, 10)->all();

// get contact where email is equal to 'john@mail.com'
$contact = $ac->contacts()->getByEmail('john@mail.com');

// create new contact
$ac->contacts()->create([
  'email'     => 'johndoe@example.com',
  'firstName' => 'John',
  'lastName'  => 'Doe',
  'phone'     => '7223224241'
]);

// create new tag
$ac->tags()->create([
  'tag'         => 'My Tag',
  'tagType'     => 'contact',
  'description' => 'Description'
]);

// add tag to contact
$ac->contacts()->addTag([
  'contact' => '1', // contact ID
  'tag'     => '20' // tag ID
]);


```

