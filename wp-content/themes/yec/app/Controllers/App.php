<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    // global fields
    public function globalvalue()
    {

      $copyright = '&copy; ' . date('Y') .'. '. get_bloginfo('name') . '. All Rights Reserved.';
      $thumbnail = get_the_post_thumbnail();

      return (object) array(
        'sitecopyright'         => $copyright,

        //logos
        'slogo'                 => get_field('primary_logo', 'options'),
        'logo'                  => get_field('colored_logo', 'options'),
        'blogo'                 => get_field('blue_logo', 'options'),
        'wlogo'                 => get_field('white_logo', 'options'),
        'favico'                => get_field('favicon', 'options'),
        'sitetitle'             => get_field('site_title', 'options'),

        //main address
        'address'               => get_field('address', 'options'),
        'city'                  => get_field('city', 'options'),
        'state'                 => get_field('state', 'options'),
        'zip'                   => get_field('zip', 'options'),
        'map'                   => get_field('map', 'options'),

        //main contact information
        'contactcont'           => get_field('contact_content', 'options'),
        'contacticon'           => get_field('contact_icon', 'options'),
        'mainphone'             => get_field('phone', 'options'),
        'mainfax'               => get_field('fax', 'options'),
        'mainemail'             => get_field('email_address', 'options'),
        //
        //

        //social media
        'smtitle'               => get_field('social_media_title', 'options'),

        //icon library
        'morelinkbefore'        => get_field('more_link_before', 'options'),
        'morelinkafter'         => get_field('more_link_after', 'options'),
        'searchicon'            => get_field('search_icon', 'options'),
        'locationicon'          => get_field('location_icon', 'options'),
        'returnarrow'           => get_field('return_arrow', 'options'),
        'playbtn'               => get_field('play_button', 'options'),
        'editicon'              => get_field('edit_icon', 'options'),
        'eventicon'             => get_field('event_icon', 'options'),
        'plusicon'              => get_field('plus_icon', 'options'),
        'accounticon'           => get_field('account_icon', 'options'),
        'carticon'              => get_field('cart_icon', 'options'),
        'uparrow'               => get_field('up_arrow', 'options'),
        'rightarrow'            => get_field('right_arrow', 'options'),
        'downarrow'             => get_field('down_arrow', 'options'),
        'leftarrow'             => get_field('left_arrow', 'options'),
        'quoteopen'             => get_field('quote_open', 'options'),
        'quoteclosed'           => get_field('quote_closed', 'options'),
        'tagicon'               => get_field('tag_icon', 'options'),
        'mainIcon'              => get_field('main_icon', 'options'),
        'phoneicon'             => get_field('phone_icon', 'options'),
        'emailicon'             => get_field('email_icon', 'options'),

        //compliancy note
        'compnote'              => get_field('compliancy_note', 'options'),

        //placeholder for blog, profile, categories and events
        'blogplaceholder'       => get_field('blog_placeholder_image', 'options'),
        'eventsplaceholder'     => get_field('event_placeholder_image', 'options'),
        'bloglink'              => get_field('blog_link', 'options'),
        'eventslink'            => get_field('events_link', 'options'),
        'profileplaceholder'    => get_field('profile_placeholder_image', 'options'),
        'categoryplaceholder'   => get_field('default_category_image', 'options'),
        'subcatplaceholder'     => get_field('default_sub_category_image', 'options'),

        //seo note
        'seonote'               => get_field('seo_note', 'options'),

        //enews
        'enewstitle'            => get_field('enews_title', 'options'),
        'enewscont'             => get_field('enews_content', 'options'),
        'enewsform'             => get_field('enews_form_shortcode', 'options'),

        //sitewide blocks
        'aboutblocktitle'       => get_field('about_block_title', 'options'),
        'aboutblockcont'        => get_field('about_block_content', 'options'),
        'aboutblockimg'         => get_field('about_block_image', 'options'),

        'placeimg'              => 'http://via.placeholder.com/',
        'featuredimg'           => $thumbnail,
        'shortcode'             => get_field('shortcode'),
        'defaultHeader'         => get_field('default_header_image', 'options'),

        //callout block
        'calloutTitle'          => get_field('callout_title', 'options'),
        'calloutContent'        => get_field('callout_content', 'options'),
        'calloutLink'           => get_field('callout_link', 'options'),
        'calloutBackground'     => get_field('callout_background', 'options'),

        //social
        'socialFacebook'        => get_field('facebook_icon', 'options'),
        'socialTwitter'         => get_field('twitter_icon', 'options'),
        'socialInstagram'       => get_field('instagram_icon', 'options'),
        'socialYoutube'         => get_field('youtube_icon', 'options'),
        'socialLinkedIn'        => get_field('linkedin_icon', 'options'),
      );
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }
}
