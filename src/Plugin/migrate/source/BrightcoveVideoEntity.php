<?php

namespace Drupal\explo_migrate\Plugin\migrate\source;

use Drupal\Core\Database\Database;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for Brightcove Video migration.
 *
 * @MigrateSource(
 *   id = "brightcove_video_entity",
 *   source_module = "brightcove"
 * )
 */
class BrightcoveVideoEntity extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $fields = [
      'bcvid',
      'api_client',
      'status',
      'name',
      'video_id',
      'duration',
      'description',
      'related_link__uri',
      'related_link__title',
      'long_description',
      'economics',
      'video_url',
      'profile',
      'poster__target_id',
      'poster__alt',
      'poster__title',
      'poster__width',
      'poster__height',
      'thumbnail__target_id',
      'thumbnail__alt',
      'thumbnail__title',
      'thumbnail__width',
      'thumbnail__height',
      'custom_field_values',
      'force_ads',
      'logo_image__target_id',
      'logo_image__alt',
      'logo_image__title',
      'logo_image__width',
      'logo_image__height',
    ];

    $query = $this->select('brightcove_video', 'bc')
      ->fields('bc', $fields);

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'bcvid' => $this->t('Brightcove ID'),
      'status' => $this->t('Status'),
      'name' => $this->t('Name'),
      'video_id' => $this->t('Video ID'),
      'duration' => $this->t('Druation'),
      'description' => $this->t('Description'),
      'related_link__uri' => $this->t('Related Link URI'),
      'related_link__title' => $this->t('Related Link title'),
      'long_description' => $this->t('Long Desciption'),
      'economics' => $this->t('Advertising'),
      'video_url' => $this->t('Node ID'),
      'profile' => $this->t('Node ID'),
      'poster__target_id' => $this->t('Node ID'),
      'poster__alt' => $this->t('Node ID'),
      'poster__title' => $this->t('Node ID'),
      'poster__width' => $this->t('Node ID'),
      'poster__height' => $this->t('Node ID'),
      'thumbnail__target_id' => $this->t('Node ID'),
      'thumbnail__alt' => $this->t('Node ID'),
      'thumbnail__title' => $this->t('Node ID'),
      'thumbnail__width' => $this->t('Node ID'),
      'thumbnail__height' => $this->t('Node ID'),
      'custom_field_values' => $this->t('Node ID'),
      'force_ads' => $this->t('Node ID'),
      'logo_image__target_id' => $this->t('Node ID'),
      'logo_image__alt' => $this->t('Node ID'),
      'logo_image__title' => $this->t('Node ID'),
      'logo_image__width' => $this->t('Node ID'),
      'logo_image__height' => $this->t('Node ID'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'bcvid' => [
        'type' => 'integer',
        'alias' => 'bc',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {

    $bc_tags = [];

    // Getting to the Drupal 9 db.
    $drupalDb = Database::getConnection('default', 'default');

      $results = $drupalDb->select('brightcove_video__tags', 'ta')
        ->fields('ta', ['entity_id', 'tags_target_id'])
        ->condition('ta.entity_id', $row->getSource()['bcvid'], '=')
        ->execute()
        ->fetchAll();

    $tags = [];

      if (!empty($results)) {
        foreach ($results as $result) {
          $tags[] = $result->tags_target_id;
        }
        $bc_tags = implode(',', $tags);
      }

    // Custom source property that can be referenced in yml.
    $row->setSourceProperty('prepare_multiple_tags', $bc_tags);

    return parent::prepareRow($row);
  }

}
