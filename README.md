Klaviyo PHP SDK + GET and PUT
============

This is a fork of the [official Klaviyo PHP API](https://github.com/klaviyo/php-klaviyo) that also adds in GET and PUT functionality from [robwittman/php-klaviyo](https://github.com/robwittman/php-klaviyo). The Guzzle requirement of robwittman was removed by borrowing from the [Order Desk PHP Client](https://gist.github.com/sparkweb/c6a5a21ab44a23589b9c). It provides a minimal-abstraction wrapper for the track, identify, metrics, profiles, lists (v1 and v2), campaigns, and templates APIs all from the same class.

Table of Contents
-------------
1. [Metrics](#metrics)
    * [Listing metrics](#metrics-listing-metrics)
    * [Listing the complete event timeline](#metrics-listing-the-complete-event-timeline)
    * [Listing the event timeline for a particular metric](#metrics-listing-the-event-timeline-for-a-particular-metric)
    * [Exporting metric data](#metrics-exporting-metric-data)
2. [Profiles](#profiles)
    * [Retrieving a Person's Attributes](#profiles-retrieving-a-persons-attributes)
    * [Adding or Updating a Person's Attributes](#profiles-adding-or-updating-a-persons-attributes)
    * [Listing a person's complete event timeline](#profiles-listing-a-persons-complete-event-timeline)
    * [Listing a person's event timeline for a particular metric](#profiles-listing-a-persons-event-timeline-for-a-particular-metric)
    * [Getting all people](#profiles-getting-all-people)
3. [Lists](#lists)
    * [Lists in Account](#lists-lists-in-account)
    * [Creating a List](#lists-creating-a-list)
    * [List Information](#lists-list-information)
    * [Updating a List](#lists-updating-a-list)
    * [Deleting a List](#lists-deleting-a-list)
    * [Checking if Someone is in a List](#lists-checking-if-someone-is-in-a-list)
    * [Checking if Someone is in a Segment](#lists-Checking if Someone is in a Segment)
    * [Adding Someone to a List](#lists-adding-someone-to-a-list)
    * [Batch Adding People to a List](#lists-batch-adding-people-to-a-list)
    * [Batch Removing People from a List](#lists-batch-removing-people-from-a-list)
    * [Exclude or Unsubscribe Someone from a List](#lists-exclude-or-unsubscribe-someone-from-a-list)
    * [List Exclusions or Unsubscribes for a List](#lists-list-exclusions-or-unsubscribes-for-a-list)
    * [List Exclusions or Unsubscribes](#lists-list-exclusions-or-unsubscribes)
    * [Exclude or Unsubscribe Someone from All Email](#lists-exclude-or-unsubscribe-someone-from-all-email)
4. [Lists v2](#lists-v2)
    * [Create a List](#lists-v2-create-a-list)
    * [Get Lists](#lists-v2-get-lists)
    * [Get List Details](#lists-v2-get-list-details)
    * [Update a List](#lists-v2-update-a-list)
    * [Delete a List](#lists-v2-delete-a-list)
    * [Subscribe to List](#lists-v2-subscribe-to-list)
    * [Check List Subscriptions](#lists-v2-check-list-subscriptions)
    * [Unsubscribe from List](#lists-v2-unsubscribe-from-list)
    * [Add to List](#lists-v2-add-to-list)
    * [Check List Membership](#lists-v2-check-list-membership)
    * [Remove from List](#lists-v2-remove-from-list)
    * [Get All Exclusions on a List](#lists-v2-get-all-exclusions-on-a-list)
    * [Get Group Member Emails](#lists-v2-get-group-member-emails)
5. [Campaigns](#campaigns)
    * [Campaigns in Account](#campaigns-campaigns-in-account)
    * [Creating a Campaign](#campaigns-creating-a-campaign)
    * [Campaign Information](#campaigns-campaign-information)
    * [Updating a Campaign](#campaigns-updating-a-campaign)
    * [Send a Campaign Immediately](#campaigns-send-a-campaign-immediately)
    * [Schedule a Campaign](#campaigns--schedule-a-campaign)
    * [Cancel a Campaign](#campaigns-cancel-a-campaign)
    * [Clone a Campaign](#campaigns-clone-a-campaign)
    * [Campaign Recipient Information](#campaigns-campaign-recipient-information)
6. [Templates](#templates)
    * [List all templates](#templates-list-all-templates)
    * [Creating a template](#templates-creating-a-template)
    * [Updating an email template](#templates-updating-an-email-template)
    * [Deleting template](#templates-deleting-template)
    * [Clone template](#templates-clone-template)
    * [Render template](#templates-render-template)
    * [Render template and send email](#templates-render-template-and-send-email)
7. [Track](#track)
    * [Basic Event Call](#track-basic-event-call)
8. [Identify](#identify)
    * [Basic Identify Call](#identify-basic-identify-call)
    
<a name="metrics"></a>
## Metrics

<a name="metrics-listing-metrics"></a>
### Listing metrics
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "page"  => 1,
    "count" => 100
);
$result = $klaviyo->get("metrics", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="metrics-listing-the-complete-event-timeline"></a>
### Listing the complete event timeline
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "since" => 1400656845,
    "count" => 100,
    "sort"  => "asc"
);
$result = $klaviyo->get("metrics/timeline", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="metrics-listing-the-event-timeline-for-a-particular-metric"></a>
### Listing the event timeline for a particular metric
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "since" => 1400656845,
    "count" => 100,
    "sort"  => "asc"
);
$result = $klaviyo->get("metric/{{METRIC_ID}}/timeline", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="metrics-exporting-metric-data"></a>
### Exporting metric data
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "start_date"  => 2015-01-01,
    "end_date"    => 2015-01-31,
    "unit"        => "week",
    "measurement" => '["sum","ItemCount"]',
    "where"       => '[["ItemCount","=",5]]',
//  "by"          => urlencode('Accepts Marketing'),
    "count" => 100,
);
$result = $klaviyo->get("metric/{{METRIC_ID}}/export", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles"></a>
## Profiles

<a name="profiles-retrieving-a-persons-attributes"></a>
### Retrieving a Person's Attributes
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->get("person/{{PERSON_ID}}");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles-adding-or-updating-a-persons-attributes"></a>
### Adding or Updating a Person's Attributes
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
   '$id'		      		=> 'dqQnNW',
   '$email'			      => 'george.washington@example.com',
   '$first_name'	   	=> 'George',
   '$last_name'		   => 'Washington',
   '$phone_number'   	=> '555-555-5555',
   '$title'			      => 'Ex-president',
   '$organization'      => 'U.S. Government',
   '$city'			      => 'Mount Vernon',
   '$region'		   	=> 'Virginia',
   '$country'	   		=> 'US',
   '$zip'	   			=> '22121',
   '$image'			      => 'http://media.clarkart.edu/Web_medium_images/1955.16.jpg',
   '$timezone'		      => 'US/Eastern',
   'favorite_ice_cream' => 'vanilla'
);
$result = $klaviyo->put("person/{{PERSON_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles-listing-a-persons-complete-event-timeline"></a>
### Listing a person's complete event timeline
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "since" => 1400656845,
    "count" => 100,
    "sort"  => "asc"
);
$result = $klaviyo->get("person/{{PERSON_ID}}/metrics/timeline", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles-listing-a-persons-event-timeline-for-a-particular-metric"></a>
### Listing a person's event timeline for a particular metric
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "since" => 1400656845,
    "count" => 100,
    "sort"  => "asc"
);
$result = $klaviyo->get("person/{{PERSON_ID}}/metric/{{METRIC_ID}}/timeline", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles-getting-all-people"></a>
### Getting All People
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$result = $klaviyo->get("people");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists"></a>
## Lists

<a name="lists-lists-in-account"></a>
### Lists in Account
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "type"  => "segment",
    "page"  => "1",
    "count" => "100"
);
$result = $klaviyo->get("lists", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-creating-a-list"></a>
### Creating a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "name"        => "My New List",
    "list_type"   => "standard"
);
$result = $klaviyo->post("lists", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-list-information"></a>
### List Information
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->get("list/{{LIST_ID}}");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-updating-a-list"></a>
### Updating a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "name" => "My New List Name"
);
$result = $klaviyo->put("list/{{LIST_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-deleting-a-list"></a>
### Deleting a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->delete("list/{{LIST_ID}}");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-checking-if-someone-is-in-a-list"></a>
### Checking if Someone is in a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "email" => '["george.washington@example.com","thomas.jefferson@example.com"]'
);
$result = $klaviyo->get("list/{{LIST_ID}}/members", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-Checking if Someone is in a Segment"></a>
### Checking if Someone is in a Segment
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "email" => '["george.washington@example.com","thomas.jefferson@example.com"]'
);
$result = $klaviyo->get("segment/{{SEGMENT_ID}}/members", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-adding-someone-to-a-list"></a>
### Adding Someone to a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "email"          => "george.washington@example.com",
    "properties"     => '{ "$first_name" : "George", "Birthday" : "02/22/1732" }',
    "confirm_optin"  => true
);
$result = $klaviyo->post("list/{{LIST_ID}}/members", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-batch-adding-people-to-a-list"></a>
### Batch Adding People to a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "batch"          => '[ { "email" : "george.washington@example.com", "properties" : { "$first_name" : "George", "Birthday" : "02/22/1732" } }, { "email" : "thomas.jefferson@example.com" } ]',
    "confirm_optin"  => true
);
$result = $klaviyo->post("list/{{LIST_ID}}/members/batch", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-batch-removing-people-from-a-list"></a>
### Batch Removing People from a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "batch" => '[ { "email" : "george.washington@example.com" }, { "email" : "ben.franklin@example.com" } ]'
);
$result = $klaviyo->delete("list/{{LIST_ID}}/members/batch", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-exclude-or-unsubscribe-someone-from-a-list"></a>
### Exclude or Unsubscribe Someone from a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "email"       => "george.washington@example.com",
    "timestamp"   => 1400656845
);
$result = $klaviyo->post("list/{{LIST_ID}}/members/exclude", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-list-exclusions-or-unsubscribes-for-a-list"></a>
### List Exclusions or Unsubscribes for a List
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "reason"   => "unsubscribe",
    "sort"     => "desc"
);
$result = $klaviyo->get("list/{{LIST_ID}}/exclusions", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-list-exclusions-or-unsubscribes"></a>
### List Exclusions or Unsubscribes
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "reason"   => "unsubscribe",
    "sort"     => "desc"
);
$result = $klaviyo->get("people/exclusions", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-exclude-or-unsubscribe-someone-from-all-email"></a>
### Exclude or Unsubscribe Someone from All Email
#### DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "email"       => "george.washington@example.com",
    "timestamp"   => 1400656845
);
$result = $klaviyo->post("people/exclusions", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2"></a>
## Lists v2

<a name="lists-v2-create-a-list"></a>
### Create a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "list_name" => "my new list name",
);
$result = $klaviyo->post("lists", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-lists"></a>
### Get Lists
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$result = $klaviyo->get("lists");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-list-details"></a>
### Get List Details
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$result = $klaviyo->get("list/{{LIST_ID}}");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-update-a-list"></a>
### Update a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "list_name" => "my new list name",
);
$result = $klaviyo->put("list/{{LIST_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-delete-a-list"></a>
### Delete a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$result = $klaviyo->delete("list/{{LIST_ID}}");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-subscribe-to-list"></a>
### Subscribe to List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "profiles" => '[ { "email": "george.washington@example.com", "example_property": "valueA" }, { "email": "thomas.jefferson@example.com", "example_property": "valueB" } ]'
);
$result = $klaviyo->post("list/{{LIST_ID}}/subscribe", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-check-list-subscriptions"></a>
### Check List Subscriptions
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "emails" => '["george.washington@example.com", "john.adams@example.com"]'
);
$result = $klaviyo->get("list/{{LIST_ID}}/subscribe", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-unsubscribe-from-list"></a>
### Unsubscribe from List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "emails" => '["george.washington@example.com", "john.adams@example.com"]'
);
$result = $klaviyo->delete("list/{{LIST_ID}}/subscribe", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-add-to-list"></a>
### Add to List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "profiles" => '[ { "email": "george.washington@example.com", "example_property": "valueA" }, { "email": "thomas.jefferson@example.com", "example_property": "valueB" } ]'
);
$result = $klaviyo->post("list/{{LIST_ID}}/members", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-check-list-membership"></a>
### Check List Membership
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "emails" => '["george.washington@example.com", "john.adams@example.com"]'
);
$result = $klaviyo->get("list/{{LIST_ID}}/members", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-remove-from-list"></a>
### Remove from List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "emails" => '["george.washington@example.com", "john.adams@example.com"]'
);
$result = $klaviyo->delete("list/{{LIST_ID}}/members", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-all-exclusions-on-a-list"></a>
### Get All Exclusions on a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "marker" => 123456,
);
$result = $klaviyo->get("list/{{LIST_ID}}/exclusions/all", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-group-member-emails"></a>
### Get Group Member Emails
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key, null, 2);
$args = array(
    "marker" => 123456,
);
$result = $klaviyo->get("list/{{LIST_ID or SEGMENT_ID}}/members/all", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns"></a>
## Campaigns

<a name="campaigns-campaigns-in-account"></a>
### Campaigns in Account
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "page"  => 1,
    "count" => 100
);
$result = $klaviyo->get("campaigns", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-creating-a-campaign"></a>
### Creating a Campaign
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
	"list_id"				=> "erRoOX",
	"template_id"			=> "gtTqQZ",
	"from_email"			=> "george.washington@example.com",
	"from_name"				=> "George Washington",
	"subject"				=> "Company Monthly Newsletter",
	"name"					=> "Campaign Name",
	"use_smart_sending"		=> true,
	"add_google_analytics"	=> true
);
$result = $klaviyo->post("campaigns", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-campaign-information"></a>
### Campaign Information
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->get("campaign/{{CAMPAIGN_ID}}");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-updating-a-campaign"></a>
### Updating a Campaign
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
	"list_id"				=> "erRoOX",
	"template_id"			=> "gtTqQZ",
	"from_email"			=> "george.washington@example.com",
	"from_name"				=> "George Washington",
	"subject"				=> "Company Monthly Newsletter",
	"name"					=> "Campaign Name",
	"use_smart_sending"		=> true,
	"add_google_analytics"	=> true
);
$result = $klaviyo->put("campaign/{{CAMPAIGN_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-send-a-campaign-immediately"></a>
### Send a Campaign Immediately
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->post("campaign/{{CAMPAIGN_ID}}/send");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns--schedule-a-campaign"></a>
### Schedule a Campaign
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "send_time"   => "2013-06-14 00:00:00"
);
$result = $klaviyo->post("campaign/{{CAMPAIGN_ID}}/schedule", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-cancel-a-campaign"></a>
### Cancel a Campaign
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->post("campaign/{{CAMPAIGN_ID}}/cancel", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-clone-a-campaign"></a>
### Clone a Campaign
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "name"     => "Cloned Campaign",
    "list_id"  => "erRoOX"
);
$result = $klaviyo->post("campaign/{{CAMPAIGN_ID}}/clone", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-campaign-recipient-information"></a>
### Campaign Recipient Information
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "count"    => 25000,
    "sort"     => "desc",
    "offset"   => "Z2VvcmdlLndhc2hpbmd0b25AZXhhbXBsZS5jb20=",
);
$result = $klaviyo->get("campaign/{{CAMPAIGN_ID}}/recipients", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates"></a>
## Templates

<a name="templates-list-all-templates"></a>
### List all templates
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->get("email-templates", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates-creating-a-template"></a>
### Creating a template
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "name" => "My New Template",
    "html" => "<html><body><p>This is an email for {{ email }}.</p></body></html>"
);
$result = $klaviyo->post("email-templates", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates-updating-an-email-template"></a>
### Updating an email template
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "name" => "My New Template",
    "html" => "<html><body><p>This is an email for {{ email }}.</p></body></html>"
);
$result = $klaviyo->put("email-template/{{TEMPLATE_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates-deleting-template"></a>
### Deleting template
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$result = $klaviyo->delete("email-template/{{TEMPLATE_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates-clone-template"></a>
### Clone template
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "name" => "My Cloned Template"
);
$result = $klaviyo->post("email-template/{{TEMPLATE_ID}}/clone", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates-render-template"></a>
### Render template
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "context" => '{ "name" : "George Washington", "notifcation_count" : 10 }',
);
$result = $klaviyo->post("email-template/{{TEMPLATE_ID}}/render", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="templates-render-template-and-send-email"></a>
### Render template and send email
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
	 "from_email"  => "george.washington@example.com",
	 "from_name"	=> "George Washington",
	 "subject"		=> "Company Monthly Newsletter",
    "context"     => '{ "name" : "George Washington", "notifcation_count" : 10 }'
);
$result = $klaviyo->post("email-template/{{TEMPLATE_ID}}/send", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="track"></a>
## Track

<a name="track-basic-event-call"></a>
### Basic Event Call
```php
<?php
include "Klaviyo.php";
$token = "ABC123";
$klaviyo = new Klaviyo(null, $token);
$event = "Elected President";
$customer_properties = array(
    '$email' => "thomas.jefferson@example.com"
);
$properties = array(
    "PreviouslyVicePresident"	=> true,
    "YearElected"				=> 1801,
    "VicePresidents"			=> ["Aaron Burr", "George Clinton"]
);
$time = 1537057291;
$result = $klaviyo->tracker($event, $customer_properties, $properties, $time);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
However, since a GET request is being performed in the class, the following implementation is also supported:
```php
<?php
include "Klaviyo.php";
$token = "ABC123";
$klaviyo = new Klaviyo(null, $token);
$args = array(
	"event" => "Elected President",
	"customer_properties" => array(
		'$email' => "thomas.jefferson@example.com"
	),
	"properties" => array(
		"PreviouslyVicePresident"	=> true,
		"YearElected"		   		=> 1801,
		"VicePresidents"		   	=> ["Aaron Burr", "George Clinton"],
      '$event_id'                => 10001234,
      '$value'                   => 11.25
	),
	"time" => 1537057291
);
$result = $klaviyo->get("track", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="identify"></a>
## Identify

<a name="identify-basic-identify-call"></a>
### Basic Identify Call
```php
<?php
include "Klaviyo.php";
$token = "ABC123";
$klaviyo = new Klaviyo(null, $token);
$properties = array(
    '$id'			=> 'dqQnNW',
    '$email'		=> 'george.washington@example.com',
    '$first_name'	=> 'George',
    '$last_name'	=> 'Washington',
    '$phone_number'	=> '555-555-5555',
    '$title'		=> 'Ex-president',
    '$organization'	=> 'U.S. Government',
    '$city'			=> 'Mount Vernon',
    '$region'		=> 'Virginia',
    '$country'		=> 'US',
    '$zip'			=> '22121',
    '$image'		=> 'http://media.clarkart.edu/Web_medium_images/1955.16.jpg',
    "Plan"			=> "Premium",
    "SignUpDate"	=> "2016-05-01 10:10:00"
)
$result = $klaviyo->identify($properties);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
However, since a GET request is being performed in the class, the following implementation is also supported:
```php
<?php
include "Klaviyo.php";
$token = "ABC123";
$klaviyo = new Klaviyo(null, $token);
$properties = array(
    '$id'			=> 'dqQnNW',
    '$email'		=> 'george.washington@example.com',
    '$first_name'	=> 'George',
    '$last_name'	=> 'Washington',
    '$phone_number'	=> '555-555-5555',
    '$title'		=> 'Ex-president',
    '$organization'	=> 'U.S. Government',
    '$city'			=> 'Mount Vernon',
    '$region'		=> 'Virginia',
    '$country'		=> 'US',
    '$zip'			=> '22121',
    '$image'		=> 'http://media.clarkart.edu/Web_medium_images/1955.16.jpg',
    "Plan"			=> "Premium",
    "SignUpDate"	=> "2016-05-01 10:10:00"
)
$result = $klaviyo->get("identify", $properties);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
