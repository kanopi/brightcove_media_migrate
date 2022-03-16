# Brightcove Media Migrate

Drupal module that adds migrations and data import functionality.

**Contents**
* Introduction
* Requirements
* Recommended modules
* Installation
* Configuration
* Troubleshooting
* FAQ
* Maintainers

## Introduction
This custom module provides two things:

* A Brightcove Video media entity.

* A special Brightcove media migration.

The [Brightcove Video Connector](https://www.drupal.org/project/brightcove) contributed module automatically synchronizes Brightcove videos and playlists to special entities the module provides (Brightcove Videos and Brightcove Playlists). The Brightcove media migration "migrates" the data in the D9 Brightcove Video entities to D9 Brightcove Video Media entities and can be invoked at any time using the Drupal migrate UI or CLI. It can also be scheduled to run with cron.

## Requirements
* [Brightcove Video Connector](https://www.drupal.org/project/brightcove)
* Media (Core)
* Migrate (Core)
* [Migrate Tools](https://www.drupal.org/project/migrate_tools)
* [Migrate Plus](https://www.drupal.org/project/migrate_plus)

## Recommended modules

* The [Migrate Cron](https://www.drupal.org/project/migrate_cron) module allows us to schedule the Brightcove media process whenever cron is run.

## Installation

These instructions assume you already have the
[Brightcove Video Connector](https://www.drupal.org/project/brightcove)
module and its Media Brightcove sub module enabled and fully configured
to synchronize Brightcove Videos with Drupal.

Install the module as you normally would. Installing the module creates
a Media bundle called **Brightcove Video** which can be customized as
needed, although it is recommended you not delete any of the fields provided
by this module to avoid warnings when migrations are run.

## Configuration
Load the migrations:

`drush cim --partial --source=modules/custom/brightcove_media_migrate/config/install`

Run the initial migration:

`drush mim brightcove_video_media_entities`

Run subsequent migrations - don't update existing videos (only import new ones):

`drush mim brightcove_video_media_entities`

Run subsequent migrations - update existing videos and also import new ones:

`drush mim brightcove_video_media_entities --update`

**Optional:** configure cron to run the migration using the [Migrate Cron](https://www.drupal.org/project/migrate_cron) module or any preferred method.

## Maintainers
* Anne Bonham (https://www.drupal.org/u/banoodle)
* Jim Birch (https://www.drupal.org/u/thejimbirch)

## Sponsored By
* Kanopi Studios (https://kanopi.com/)
