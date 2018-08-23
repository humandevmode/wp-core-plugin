<?php

namespace Core\Models;

use Core\Exceptions\TermNotFound;
use Core\Traits\MetaData;
use DateTime;
use DateTimeZone;
use WP_Post;

class BaseModel
{
  use MetaData;

  /**
   * @var WP_Post
   */
  protected $post;

  public function __construct(WP_Post $post)
  {
    $this->post = $post;
  }

  public function getMetaType()
  {
    return 'post';
  }

  public function getID()
  {
    return $this->post->ID;
  }

  public function getAuthor()
  {
    return new UserModel(get_user_by('ID', $this->post->post_author));
  }

  public function getStatus()
  {
    return $this->post->post_status;
  }

  public function getType()
  {
    return $this->post->post_type;
  }

  public function getName()
  {
    return $this->post->post_name;
  }

  public function getTitle()
  {
    return get_the_title($this->post);
  }

  public function title()
  {
    return esc_html(get_the_title($this->post));
  }

  public function getPermalink()
  {
    return get_permalink($this->post);
  }

  public function permalink()
  {
    return esc_url(apply_filters('the_permalink', get_permalink($this->post), $this->post));
  }

  /**
   * @param string $taxonomy
   *
   * @return \WP_Term
   * @throws \Exception
   */
  public function getTerm(string $taxonomy)
  {
    $terms = wp_get_post_terms($this->getID(), $taxonomy);
    if ($terms) {
      return $terms[0];
    }

    throw new TermNotFound('Can\'t find term of taxonomy '.$taxonomy);
  }

  /**
   * @param string $taxonomy
   *
   * @return \WP_Term[]
   */
  public function getTerms(string $taxonomy)
  {
    return wp_get_post_terms($this->getID(), $taxonomy);
  }

  public function hasThumbnail(): bool
  {
    return has_post_thumbnail($this->post);
  }

  public function thumbnail(array $args = [])
  {
    $args = wp_parse_args($args, [
      'size' => 'post-thumbnail',
    ]);
    $attributes = array_filter($args, function ($value, $key) {
      return $key !== 'size';
    }, ARRAY_FILTER_USE_BOTH);

    return get_the_post_thumbnail($this->post, $args['size'], $attributes);
  }

  public function hasContent(): bool
  {
    return !empty($this->post->post_content);
  }

  public function getContent()
  {
    global $post;

    $orig_post = $post;
    $post = $this->post;
    $content = get_the_content();
    $post = $orig_post;

    return $content;
  }

  public function content()
  {
    return str_replace(']]>', ']]&gt;', apply_filters('the_content', $this->getContent()));
  }

  public function getExcerpt()
  {
    return get_the_excerpt($this->post);
  }

  public function excerpt()
  {
    return apply_filters('the_excerpt', $this->getExcerpt());
  }

  public function getDate(string $format = '')
  {
    return get_the_date($format, $this->post);
  }

  public function date(string $format = '')
  {
    return apply_filters('the_date', $this->getDate($format), $format, '', '');
  }

  public function getTime(string $format = '')
  {
    return get_the_time($format, $this->post);
  }

  public function time(string $format = '')
  {
    return apply_filters('the_time', $this->getTime($format), $format);
  }

  public function getDateTime()
  {
    return new DateTime($this->post->post_date);
  }

  public function getGmtDateTime()
  {
    return new DateTime($this->post->post_date_gmt, new DateTimeZone('GMT'));
  }

  public function getModifiedDateTime()
  {
    return new DateTime($this->post->post_modified);
  }

  public function getGmtModifiedDateTime()
  {
    return new DateTime($this->post->post_modified_gmt, new DateTimeZone('GMT'));
  }
}
