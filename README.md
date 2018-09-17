Klaviyo PHP SDK + GET and PUT
============

This is a fork of the [official Klaviyo PHP API](https://github.com/klaviyo/php-klaviyo) that also adds in GET and PUT functionality from [robwittman/php-klaviyo](https://github.com/robwittman/php-klaviyo). The Guzzle requirement of robwittman was removed by borrowing from the [Order Desk PHP Client](https://gist.github.com/sparkweb/c6a5a21ab44a23589b9c). It provides a minimal-abstraction wrapper for the track, identify, metrics, profiles, lists (v1 and v2), campaigns, and templates APIs all from the same class.

Table of Contents
-------------
<a name="metrics-top"></a>
1. [Metrics](#metrics)
    <a name="metrics-listing-metrics-top"></a>
    * [Listing metrics](#metrics-listing-metrics)
    <a name="metrics-listing-the-complete-event-timeline-top"></a>
    * [Listing the complete event timeline](#metrics-listing-the-complete-event-timeline)
    <a name="metrics-listing-the-event-timeline-for-a-particular-metric-top"></a>
    * [Listing the event timeline for a particular metric](#metrics-listing-the-event-timeline-for-a-particular-metric)
    <a name="metrics-exporting-metric-data-top"></a>
    * [Exporting metric data](#metrics-exporting-metric-data)
<a name="profiles-top"></a>
2. [Profiles](#profiles)
    <a name="profiles-retrieving-a-persons-attributes-top"></a>
    * [Retrieving a Person's Attributes](#profiles-retrieving-a-persons-attributes)
    <a name="profiles-adding-or-updating-a-persons-attributes-top"></a>
    * [Adding or Updating a Person's Attributes](#profiles-adding-or-updating-a-persons-attributes)
    <a name="profiles-listing-a-persons-complete-event-timeline-top"></a>
    * [Listing a person's complete event timeline](#profiles-listing-a-persons-complete-event-timeline)
    <a name="profiles-listing-a-persons-event-timeline-for-a-particular-metric-top"></a>
    * [Listing a person's event timeline for a particular metric](#profiles-listing-a-persons-event-timeline-for-a-particular-metric)
    <a name="profiles-getting-all-people-top"></a>
    * [Getting all people](#profiles-getting-all-people)
<a name="lists-top"></a>
3. [Lists](#lists)
    <a name="lists-lists-in-account-top"></a>
    * ~~[Lists in Account](#lists-lists-in-account)~~
    <a name="lists-creating-a-list-top"></a>
    * ~~[Creating a List](#lists-creating-a-list)~~
    <a name="lists-list-information-top"></a>
    * ~~[List Information](#lists-list-information)~~
    <a name="lists-updating-a-list-top"></a>
    * ~~[Updating a List](#lists-updating-a-list)~~
    <a name="lists-deleting-a-list-top"></a>
    * ~~[Deleting a List](#lists-deleting-a-list)~~
    <a name="lists-checking-if-someone-is-in-a-list-top"></a>
    * ~~[Checking if Someone is in a List](#lists-checking-if-someone-is-in-a-list)~~
    <a name="lists-checking-if-someone-is-in-a-segment-top"></a>
    * [Checking if Someone is in a Segment](#lists-checking-if-someone-is-in-a-segment)
    <a name="lists-adding-someone-to-a-list-top"></a>
    * ~~[Adding Someone to a List](#lists-adding-someone-to-a-list)~~
    <a name="lists-batch-adding-people-to-a-list-top"></a>
    * ~~[Batch Adding People to a List](#lists-batch-adding-people-to-a-list)~~
    <a name="lists-batch-removing-people-from-a-list-top"></a>
    * ~~[Batch Removing People from a List](#lists-batch-removing-people-from-a-list)~~
    <a name="lists-exclude-or-unsubscribe-someone-from-a-list-top"></a>
    * ~~[Exclude or Unsubscribe Someone from a List](#lists-exclude-or-unsubscribe-someone-from-a-list)~~
    <a name="lists-list-exclusions-or-unsubscribes-for-a-list-top"></a>
    * ~~[List Exclusions or Unsubscribes for a List](#lists-list-exclusions-or-unsubscribes-for-a-list)~~
    <a name="lists-list-exclusions-or-unsubscribes-top"></a>
    * [List Exclusions or Unsubscribes](#lists-list-exclusions-or-unsubscribes)
    <a name="lists-exclude-or-unsubscribe-someone-from-all-email-top"></a>
    * [Exclude or Unsubscribe Someone from All Email](#lists-exclude-or-unsubscribe-someone-from-all-email)
<a name="lists-v2-top"></a>
4. [Lists v2](#lists-v2)
    <a name="lists-v2-create-a-list-top"></a>
    * [Create a List](#lists-v2-create-a-list)
    <a name="lists-v2-get-lists-top"></a>
    * [Get Lists](#lists-v2-get-lists)
    <a name="lists-v2-get-list-details-top"></a>
    * [Get List Details](#lists-v2-get-list-details)
    <a name="lists-v2-update-a-list-top"></a>
    * [Update a List](#lists-v2-update-a-list)
    <a name="lists-v2-delete-a-list-top"></a>
    * [Delete a List](#lists-v2-delete-a-list)
    <a name="lists-v2-subscribe-to-list-top"></a>
    * [Subscribe to List](#lists-v2-subscribe-to-list)
    <a name="lists-v2-check-list-subscriptions-top"></a>
    * [Check List Subscriptions](#lists-v2-check-list-subscriptions)
    <a name="lists-v2-unsubscribe-from-list-top"></a>
    * [Unsubscribe from List](#lists-v2-unsubscribe-from-list)
    <a name="lists-v2-add-to-list-top"></a>
    * [Add to List](#lists-v2-add-to-list)
    <a name="lists-v2-check-list-membership-top"></a>
    * [Check List Membership](#lists-v2-check-list-membership)
    <a name="lists-v2-remove-from-list-top"></a>
    * [Remove from List](#lists-v2-remove-from-list)
    <a name="lists-v2-get-all-exclusions-on-a-list-top"></a>
    * [Get All Exclusions on a List](#lists-v2-get-all-exclusions-on-a-list)
    <a name="lists-v2-get-group-member-emails-top"></a>
    * [Get Group Member Emails](#lists-v2-get-group-member-emails)
<a name="campaigns-top"></a>
5. [Campaigns](#campaigns)
    <a name="campaigns-campaigns-in-account-top"></a>
    * [Campaigns in Account](#campaigns-campaigns-in-account)
    <a name="campaigns-creating-a-campaign-top"></a>
    * [Creating a Campaign](#campaigns-creating-a-campaign)
    <a name="campaigns-campaign-information-top"></a>
    * [Campaign Information](#campaigns-campaign-information)
    <a name="campaigns-updating-a-campaign-top"></a>
    * [Updating a Campaign](#campaigns-updating-a-campaign)
    <a name="campaigns-send-a-campaign-immediately-top"></a>
    * [Send a Campaign Immediately](#campaigns-send-a-campaign-immediately)
    <a name="campaigns--schedule-a-campaign-top"></a>
    * [Schedule a Campaign](#campaigns--schedule-a-campaign)
    <a name="campaigns-cancel-a-campaign-top"></a>
    * [Cancel a Campaign](#campaigns-cancel-a-campaign)
    <a name="campaigns-clone-a-campaign-top"></a>
    * [Clone a Campaign](#campaigns-clone-a-campaign)
    <a name="campaigns-campaign-recipient-information-top"></a>
    * [Campaign Recipient Information](#campaigns-campaign-recipient-information)
<a name="templates-top"></a>
6. [Templates](#templates)
    <a name="templates-list-all-templates-top"></a>
    * [List all templates](#templates-list-all-templates)
    <a name="templates-creating-a-template-top"></a>
    * [Creating a template](#templates-creating-a-template)
    <a name="templates-updating-an-email-template-top"></a>
    * [Updating an email template](#templates-updating-an-email-template)
    <a name="templates-deleting-template-top"></a>
    * [Deleting template](#templates-deleting-template)
    <a name="templates-clone-template-top"></a>
    * [Clone template](#templates-clone-template)
    <a name="templates-render-template-top"></a>
    * [Render template](#templates-render-template)
    <a name="templates-render-template-and-send-email-top"></a>
    * [Render template and send email](#templates-render-template-and-send-email)
<a name="track-top"></a>
7. [Track](#track)
    <a name="track-basic-event-call-top"></a>
    * [Basic Event Call](#track-basic-event-call)
<a name="identify-top"></a>
8. [Identify](#identify)
    <a name="identify-basic-identify-call-top"></a>
    * [Basic Identify Call](#identify-basic-identify-call)
    
<a name="metrics"></a>
## [Metrics](#metrics-top)

<a name="metrics-listing-metrics"></a>
### [Listing metrics](#metrics-listing-metrics-top)
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
### [Listing the complete event timeline](#metrics-listing-the-complete-event-timeline-top)
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
### [Listing the event timeline for a particular metric](#metrics-listing-the-event-timeline-for-a-particular-metric-top)
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
### [Exporting metric data](#metrics-exporting-metric-data-top)
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
    "count" => 100
);
$result = $klaviyo->get("metric/{{METRIC_ID}}/export", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles"></a>
## [Profiles](#profiles-top)

<a name="profiles-retrieving-a-persons-attributes"></a>
### [Retrieving a Person's Attributes](#profiles-retrieving-a-persons-attributes-top)
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
### [Adding or Updating a Person's Attributes](#profiles-adding-or-updating-a-persons-attributes-top)
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
   '$id'                => 'dqQnNW',
   '$email'             => 'george.washington@example.com',
   '$first_name'        => 'George',
   '$last_name'         => 'Washington',
   '$phone_number'      => '555-555-5555',
   '$title'             => 'Ex-president',
   '$organization'      => 'U.S. Government',
   '$city'              => 'Mount Vernon',
   '$region'            => 'Virginia',
   '$country'           => 'US',
   '$zip'               => '22121',
   '$image'             => 'http://media.clarkart.edu/Web_medium_images/1955.16.jpg',
   '$timezone'          => 'US/Eastern',
   'favorite_ice_cream' => 'vanilla'
);
$result = $klaviyo->put("person/{{PERSON_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles-listing-a-persons-complete-event-timeline"></a>
### [Listing a person's complete event timeline](#profiles-listing-a-persons-complete-event-timeline-top)
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
### [Listing a person's event timeline for a particular metric](#profiles-listing-a-persons-event-timeline-for-a-particular-metric-top)
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
### [Getting All People](#profiles-getting-all-people-top)
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$result = $klaviyo->get("people");
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists"></a>
## [Lists](#lists-top)

<a name="lists-lists-in-account"></a>
### [Lists in Account](#lists-lists-in-account-top)
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
### [Creating a List](#lists-creating-a-list-top)
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
### [List Information](#lists-list-information-top)
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
### [Updating a List](#lists-updating-a-list-top)
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
### [Deleting a List](#lists-deleting-a-list-top)
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
### [Checking if Someone is in a List](#lists-checking-if-someone-is-in-a-list-top)
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
<a name="lists-checking-if-someone-is-in-a-segment"></a>
### [Checking if Someone is in a Segment](#lists-checking-if-someone-is-in-a-segment-top)
<!--#### DEPRECATED: Please use the [Lists API V2](#lists-v2).-->
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
### [Adding Someone to a List](#lists-adding-someone-to-a-list-top)
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
### [Batch Adding People to a List](#lists-batch-adding-people-to-a-list-top)
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
### [Batch Removing People from a List](#lists-batch-removing-people-from-a-list-top)
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
### [Exclude or Unsubscribe Someone from a List](#lists-exclude-or-unsubscribe-someone-from-a-list-top)
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
### [List Exclusions or Unsubscribes for a List](#lists-list-exclusions-or-unsubscribes-for-a-list-top)
<!--#### DEPRECATED: Please use the [Lists API V2](#lists-v2).-->
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
### [List Exclusions or Unsubscribes](#lists-list-exclusions-or-unsubscribes-top)
<!--#### DEPRECATED: Please use the [Lists API V2](#lists-v2).-->
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
### [Exclude or Unsubscribe Someone from All Email](#lists-exclude-or-unsubscribe-someone-from-all-email-top)
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
## [Lists v2](#lists-v2-top)

<a name="lists-v2-create-a-list"></a>
### [Create a List](#lists-v2-create-a-list-top)
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
### [Get Lists](#lists-v2-get-lists-top)
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
### [Get List Details](#lists-v2-get-list-details-top)
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
### [Update a List](#lists-v2-update-a-list-top)
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
### [Delete a List](#lists-v2-delete-a-list-top)
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
### [Subscribe to List](#lists-v2-subscribe-to-list-top)
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
### [Check List Subscriptions](#lists-v2-check-list-subscriptions-top)
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
### [Unsubscribe from List](#lists-v2-unsubscribe-from-list-top)
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
### [Add to List](#lists-v2-add-to-list-top)
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
### [Check List Membership](#lists-v2-check-list-membership-top)
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
### [Remove from List](#lists-v2-remove-from-list-top)
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
### [Get All Exclusions on a List](#lists-v2-get-all-exclusions-on-a-list-top)
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
### [Get Group Member Emails](#lists-v2-get-group-member-emails-top)
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
## [Campaigns](#campaigns-top)

<a name="campaigns-campaigns-in-account"></a>
### [Campaigns in Account](#campaigns-campaigns-in-account-top)
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
### [Creating a Campaign](#campaigns-creating-a-campaign-top)
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "list_id"              => "erRoOX",
    "template_id"          => "gtTqQZ",
    "from_email"           => "george.washington@example.com",
    "from_name"            => "George Washington",
    "subject"              => "Company Monthly Newsletter",
    "name"                 => "Campaign Name",
    "use_smart_sending"    => true,
    "add_google_analytics" => true
);
$result = $klaviyo->post("campaigns", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-campaign-information"></a>
### [Campaign Information](#campaigns-campaign-information-top)
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
### [Updating a Campaign](#campaigns-updating-a-campaign-top)
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "list_id"              => "erRoOX",
    "template_id"          => "gtTqQZ",
    "from_email"           => "george.washington@example.com",
    "from_name"            => "George Washington",
    "subject"              => "Company Monthly Newsletter",
    "name"                 => "Campaign Name",
    "use_smart_sending"    => true,
    "add_google_analytics" => true
);
$result = $klaviyo->put("campaign/{{CAMPAIGN_ID}}", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="campaigns-send-a-campaign-immediately"></a>
### [Send a Campaign Immediately](#campaigns-send-a-campaign-immediately-top)
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
### [Schedule a Campaign](#campaigns--schedule-a-campaign-top)
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
### [Cancel a Campaign](#campaigns-cancel-a-campaign-top)
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
### [Clone a Campaign](#campaigns-clone-a-campaign-top)
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
### [Campaign Recipient Information](#campaigns-campaign-recipient-information-top)
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
## [Templates](#templates-top)

<a name="templates-list-all-templates"></a>
### [List all templates](#templates-list-all-templates-top)
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
### [Creating a template](#templates-creating-a-template-top)
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
### [Updating an email template](#templates-updating-an-email-template-top)
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
### [Deleting template](#templates-deleting-template-top)
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
### [Clone template](#templates-clone-template-top)
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
### [Render template](#templates-render-template-top)
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
### [Render template and send email](#templates-render-template-and-send-email-top)
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "from_email" => "george.washington@example.com",
    "from_name"  => "George Washington",
    "subject"    => "Company Monthly Newsletter",
    "context"    => '{ "name" : "George Washington", "notifcation_count" : 10 }'
);
$result = $klaviyo->post("email-template/{{TEMPLATE_ID}}/send", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="track"></a>
## [Track](#track-top)

<a name="track-basic-event-call"></a>
### [Basic Event Call](#track-basic-event-call-top)
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
    "PreviouslyVicePresident" => true,
    "YearElected"             => 1801,
    "VicePresidents"          => ["Aaron Burr", "George Clinton"]
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
        "PreviouslyVicePresident" => true,
        "YearElected"             => 1801,
        "VicePresidents"          => ["Aaron Burr", "George Clinton"],
        '$event_id'               => 10001234,
        '$value'                  => 11.25
    ),
    "time" => 1537057291
);
$result = $klaviyo->get("track", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="identify"></a>
## [Identify](#identify-top)

<a name="identify-basic-identify-call"></a>
### [Basic Identify Call](#identify-basic-identify-call-top)
```php
<?php
include "Klaviyo.php";
$token = "ABC123";
$klaviyo = new Klaviyo(null, $token);
$properties = array(
    '$id'           => 'dqQnNW',
    '$email'        => 'george.washington@example.com',
    '$first_name'   => 'George',
    '$last_name'    => 'Washington',
    '$phone_number' => '555-555-5555',
    '$title'        => 'Ex-president',
    '$organization' => 'U.S. Government',
    '$city'         => 'Mount Vernon',
    '$region'       => 'Virginia',
    '$country'      => 'US',
    '$zip'          => '22121',
    '$image'        => 'http://media.clarkart.edu/Web_medium_images/1955.16.jpg',
    "Plan"          => "Premium",
    "SignUpDate"    => "2016-05-01 10:10:00"
);
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
    '$id'           => 'dqQnNW',
    '$email'        => 'george.washington@example.com',
    '$first_name'   => 'George',
    '$last_name'    => 'Washington',
    '$phone_number' => '555-555-5555',
    '$title'        => 'Ex-president',
    '$organization' => 'U.S. Government',
    '$city'         => 'Mount Vernon',
    '$region'       => 'Virginia',
    '$country'      => 'US',
    '$zip'          => '22121',
    '$image'        => 'http://media.clarkart.edu/Web_medium_images/1955.16.jpg',
    "Plan"          => "Premium",
    "SignUpDate"    => "2016-05-01 10:10:00"
);
$result = $klaviyo->get("identify", $properties);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
