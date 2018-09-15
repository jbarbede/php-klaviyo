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
    * [Special Event Properties](#track-special-event-properties)
8. [Identify](#identify)
    * [Basic Identify Call](#identify-basic-identify-call)
    * [Special Identify Properties](#identify-special-identify-properties)
    
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="profiles-getting-all-people"></a>
### Getting All People
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists"></a>
## Lists

<a name="lists-lists-in-account"></a>
### Lists in Account
####DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-creating-a-list"></a>
### Creating a List
####DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-list-information"></a>
### List Information
####DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-updating-a-list"></a>
### Updating a List
####DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-deleting-a-list"></a>
### Deleting a List
####DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-checking-if-someone-is-in-a-list"></a>
### Checking if Someone is in a List
####DEPRECATED: Please use the [Lists API V2](#lists-v2).
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-lists"></a>
### Get Lists
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-list-details"></a>
### Get List Details
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-update-a-list"></a>
### Update a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-delete-a-list"></a>
### Delete a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-subscribe-to-list"></a>
### Subscribe to List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-check-list-subscriptions"></a>
### Check List Subscriptions
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-unsubscribe-from-list"></a>
### Unsubscribe from List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-add-to-list"></a>
### Add to List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-check-list-membership"></a>
### Check List Membership
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-remove-from-list"></a>
### Remove from List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-all-exclusions-on-a-list"></a>
### Get All Exclusions on a List
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="lists-v2-get-group-member-emails"></a>
### Get Group Member Emails
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="track-special-event-properties"></a>
### Special Event Properties
```php
<?php
include "Klaviyo.php";
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
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
$api_key = "pk_123456789abcdef123456789abcdef12";
$klaviyo = new Klaviyo($api_key);
$args = array(
    "source_name" => "FoxyCart",
    "search_start_date" => "2015-04-15 12:05:06",
    "order_by" => "shipping_last_name",
);
$result = $klaviyo->get("", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";
?>
```
<a name="identify-special-identify-properties"></a>
### Special Event Properties
    $tracker = new Klaviyo("YOUR_TOKEN");
    $tracker->track(
        'Purchased item',
        array('$email' => 'someone@example.com', '$first_name' => 'Bill', '$last_name' => 'Shakespeare'),
        array('Item SKU' => 'ABC123', 'Payment Method' => 'Credit Card'),
        1354913220
    );
