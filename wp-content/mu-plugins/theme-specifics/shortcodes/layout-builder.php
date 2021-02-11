<?php
function layoutBuilder_shortcode(){
	$sitePath					  	= get_field('site_path', 'options');
	$afterLinkIcon				= get_field('more_link_after', 'options');
	$playIcon 						= get_field('play_button', 'options');
	// layout fields
  $playIcon 						= get_field('play_button', 'options');
  $columnImage 					= get_sub_field('column_image');
  $linkAfter 						= get_field('more_link_after', 'options');
  $contacticon          = get_field('contact_icon', 'options');
	$locationicon         = get_field('location_icon', 'options');
	$emailicon         		= get_field('email_icon', 'options');
	$phoneicon         		= get_field('phone_icon', 'options');
	$mainphone            = get_field('phone', 'options');
	$mainfax              = get_field('fax', 'options');
	$mainemail            = get_field('email_address', 'options');
	$salesphone           = get_field('sales_phone', 'options');
	$searchicon         	= get_field('search_icon', 'options');
	$servicephone         = get_field('service_department_phone', 'options');
	$supportphone         = get_field('support_phone', 'options');
	$salesemail           = get_field('sales_email', 'options');
	$serviceemail         = get_field('service_email', 'options');
	$supportemail         = get_field('support_email', 'options');
	$address              = get_field('address', 'options');
	$city                 = get_field('city', 'options');
	$state                = get_field('state', 'options');
	$zip                  = get_field('zip', 'options');
	$map                  = get_field('map', 'options');
	$dualColCount 				= 0;

	//layout builder
	if( have_rows('layout_builder') ){
    while ( have_rows('layout_builder') ) : the_row();
			$layoutType 					= get_sub_field('section_layouts');
			// sub fields
			$incTitle 						= get_sub_field('include_section_title');
			$sectionTitle					= get_sub_field('section_title');
			$sectionAlignment			= get_sub_field('section_alignment');
			$imageCrop 						= get_sub_field('image_crop');
			$reverseColumns 			= get_sub_field('reverse_sides');
			$invertBG							= get_sub_field('invert_color');
			$bgIcon								= get_sub_field('background_icon');
			//single col
			$sectionContent 			= get_sub_field('section_content');
		  $addMedia 						= get_sub_field('add_media');
		  $video 								= get_sub_field('video_url');
		  $video 								= get_sub_field('video_url'); // Embed Code
		  $video_url 						= get_sub_field('video_url', FALSE, FALSE); // URL
		  $video_thumb_url 			= get_video_thumbnail_uri($video_url);
			// 1
		  $columnAlignment 			= get_sub_field('column_alignment');
		  $sectionContent1 			= get_sub_field('column_1_content');
		  $addMediaCol1 				= get_sub_field('column_1_add_media');
		  $video1 							= get_sub_field('video_url_1'); //Embed Code
		  $video_url1 					= get_sub_field('video_url_1', FALSE, FALSE); //URL
			$video_file1 					= get_sub_field('video_file_1'); //URL
		  $video_thumb_url1 		= get_video_thumbnail_uri($video_url1);
			$column1VideoType			= get_sub_field('column_1_video_type');
			$column1ImageType			= get_sub_field('column_1_image_type');
			$column1ImageTypeDup	= get_sub_field('column_1_image_type_nocollage');
		  $columnImage1 				= get_sub_field('column_image_1');
			$columnImageLink1			= get_sub_field('image_link_1');
			$column1Type					= get_sub_field('column_1_type');
		  // 2
		  $sectionContent2 			= get_sub_field('column_2_content');
		  $addMediaCol2 				= get_sub_field('column_2_add_media');
		  $video2 							= get_sub_field('video_url_2'); //Embed Code
		  $video_url2 					= get_sub_field('video_url_2', FALSE, FALSE); //URL
			$video_file2 					= get_sub_field('video_file_2'); //URL
			$video_thumb_url2 		= get_video_thumbnail_uri($video_url2);
			$column2VideoType			= get_sub_field('column_2_video_type');
			$column2ImageType			= get_sub_field('column_2_image_type');
			$column2ImageTypeDup	= get_sub_field('column_2_image_type_nocollage');
			$columnImage2 				= get_sub_field('column_image_2');
			$columnImageLink2			= get_sub_field('image_link_2');
			$column2Type					= get_sub_field('column_2_type');
		  // 3
		  $sectionContent3 			= get_sub_field('column_3_content');
		  $addMediaCol3 				= get_sub_field('column_3_add_media');
		  $video3 							= get_sub_field('video_url_3'); //Embed Code
		  $video_url3 					= get_sub_field('video_url_3', FALSE, FALSE); //URL
		  $video_thumb_url3 		= get_video_thumbnail_uri($video_url3);
			$column3ImageType			= get_sub_field('column_3_image_type');
			$column3ImageTypeDup	= get_sub_field('column_3_image_type_nocollage');
			$columnImage3 				= get_sub_field('column_image_3');
			$columnImageLink3			= get_sub_field('image_link_3');
			$column3Type					= get_sub_field('column_3_type');
		  // contact
		  $contactCol 					= get_sub_field('include_form_column');
		  $contactTitle 				= get_sub_field('form_title');
		  $contactCont 					= get_sub_field('form_content');
		  $contactSC 						= get_sub_field('form_shortcode');
		  $contactLinks 				= get_sub_field('form_column_includes');
			// staff
		  $staffTitle 					= get_sub_field('staff_section_title');
			$staffCont 						= get_sub_field('staff_section_content');
			// hero image
			$heroImg							= get_sub_field('hero_image');

			// site specific layouts
			include($sitePath.'/resources/views/partials/sitespecific/layoutpieces/site-layouts.blade.php');
			//

			// include breadcrumbs
			$includeBreadcrumbs		= get_sub_field('breadcrumbs');
			if($includeBreadcrumbs == 'include'){
				if(function_exists('bcn_display')){
					$bc .= '<div class="breadcrumbs">';
					$bc .= '<div class="columns is-multiline is-mobile">';
					$bc .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
					$bc .= bcn_display(true);
					$bc .= '</div>';
					$bc .= '</div>';
					$bc .= '</div>';
				}
			}

			// layout type = homepageHero (hH)
			if($layoutType == 'homepageHero'){
				$heroType 		= get_sub_field('hero_type');
				$heroAlign		= get_sub_field('hero_alignment');
				$heroBG 			= get_sub_field('hero_background_image');
				$heroSizer		= get_sub_field('hero_sizer');
				$heroTitle		= get_sub_field('hero_title');
				$heroCont			= get_sub_field('hero_content');

				if($heroType == 'backgroundImage'){
					if($heroTitle != ''){
						$hHT		.= '<div class="title">'.$heroTitle.'</div>';
					}

					if($heroCont != ''){
						$hHC		.= '<div class="cont">'.$heroCont.'</div>';
					}

					if($heroCont != ''){
						$hHB		.= '<div class="button-block">';
						if( have_rows('hero_buttons') ){
							while ( have_rows('hero_buttons') ) : the_row();
								$heroButton = get_sub_field('button');
								$hHB		.= '<a class="btn styled" href="'.$heroButton['url'].'" title="'.$heroButton['title'].'" target="'.$heroButton['target'].'">'.$heroButton['title'].'</a>';
							endwhile;
						}
						$hHB		.= '</div>';
					}

					if($heroImg){
						$hhI	.= '<img src="'.$heroImg['url'].'" alt="'.$heroImg['alt'].'" class="hero-side-img">';
					}

					$hHv 		.= 'bg-img';
					$hHvBG 	.= 'style="background: url('.$heroBG["url"].') no-repeat"';
					$hc .= '<div class="hero-content">';
					$hc .= $hHT;
					$hc .= $hHC;
					$hc .= $hHB;
					$hc .= '</div>';
				} elseif($heroType == 'slideshow') {
					$hHss 	.= 'hero-slideshow';
					$hHv 		.= 'sshow';
				} elseif($heroType == 'video') {
					$hHv 		.= 'hero-video';
				} elseif($heroType == 'videoSlideshow') {
					$hHv 		.= 'hero-video';
				}

				$hH .= '<div class="hblock">';
				$hH .= '<div class="hero-shape">';
				$hH .= '<section class="hero layout-builder homepage-hero '.$hHv.' align-'.$heroAlign.'" '.$hHvBG.'>';
				// content & slideshow

				if($heroType == 'slideshow') {
					if( have_rows('hero_slideshow') ):
						$hH .= '<div class="'.$hHss.'">';
						while ( have_rows('hero_slideshow') ) : the_row();
							$slidecopy		= get_sub_field('hero_slideshow_text');
							$slideGraphic = get_sub_field('hero_slide_graphic');
							$slideBG 			= get_sub_field('slide_image');
							// buttons
							if( have_rows('hero_buttons') ):
							  $slideBtn 	.= '<div class="button-block">';
							  while ( have_rows('hero_buttons') ) : the_row();
							    $btn			= get_sub_field('button');
							    $button		.= '<a class="btn styled" href="'.$btn['url'].'" title="'.$btn['title'].'" target="'.$btn['target'].'">'.$btn['title'].'</a>';
							  endwhile;
							  $slideBtn		.= $button;
							  $slideBtn 	.= '</div>';
							endif;

							//
							if($slideGraphic != ''){
								$graphic .= '<img src="'.$slideGraphic['url'].'" alt="'.$slideGraphic['title'].'">';
							}
							//

						  $slidecont .= '<div class="columns is-mobile is-multiline centerAligned">';
						  $slidecont .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
						  $slidecont .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
						  $slidecont .= '<div class="hero-content">'.$graphic.$slidecopy.$slideBtn.'</div>';
						  $slidecont .= '</div>';
						  $slidecont .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
						  $slidecont .= '</div>';

							//

							$hH .= '<div class="slide" style="background-image: url('.$slideBG['url'].'); background-size: cover;">';
							$hH .= $slidecont;
							$hH .= '<div class="hero-size"><img src="'.$heroSizer['url'].'"></div>';
							$hH .= '</div>';
						endwhile;


						$hH .= '</div>';
					endif;
				} elseif($heroType == 'slideshowStatic') {
					//
					// buttons
					if( have_rows('hero_buttons') ):
						$slideBtn 	.= '<div class="button-block">';
						while ( have_rows('hero_buttons') ) : the_row();
							$btn			= get_sub_field('button');
							$button		.= '<a class="btn styled" href="'.$btn['url'].'" title="'.$btn['title'].'" target="'.$btn['target'].'">'.$btn['title'].'</a>';
						endwhile;
						$slideBtn		.= $button;
						$slideBtn 	.= '</div>';
					endif;
					//
					if( have_rows('hero_slideshow') ):

						$slidecont .= '<div class="columns is-mobile is-multiline centerAligned">';
						$slidecont .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
						$slidecont .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
						$slidecont .= '<div class="hero-content">'.$heroCont.$slideBtn.'</div>';
						$slidecont .= '</div>';
						$slidecont .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
						$slidecont .= '</div>';
						$hc .= $slidecont;

						//
						$hH .= $hc;
						$hH .= '<div class="static-slideshow hero-slideshow">';
						$slideCount = '0';
						while ( have_rows('hero_slideshow') ) : the_row();
							$slideType 	= get_sub_field('slide_type');
							$slideImage = get_sub_field('slide_image');
							$slideVideo = get_sub_field('slide_video');
							//
							if($slideType == 'image' ){
								$hH .= '<div class="slide slide'.$slideCount++.'" style="background-image: url('.$slideImage['url'].'); background-size: cover;">';
							} else {
								$hH .= '<div class="slide video-slide slide'.$slideCount++.'">';
								$hH .= '<div class="vid">';
								$hH .= '<video width="100%" height="100%" class="video" muted playsinline>';
								$hH .= '<source src="'.$slideVideo['url'].'" type="video/mp4">';
								$hH .= '</video>';
								$hH .= '</div>';
							}
							$hH .= '<div class="hero-size"><img src="'.$heroSizer['url'].'"></div>';
							$hH .= '</div>';
						endwhile;
						$hH .= '</div>';

					endif;
				} else {
					//
					$cont .= '<div class="columns is-mobile is-multiline">';
					$cont .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
					$cont .= $hc;
					$cont .= '</div>';
					$cont .= '</div>';

					$hH .= $cont;
					$hH .= '<div class="hero-size"><img src="'.$heroSizer['url'].'"></div>';
				}
				//
				$hH .= '<div class="shadow">';
				$hH .= '<div class="header-shadow"></div>';
				$hH .= '</div>';
				$hH .= '<div class="shade"></div>';
				$hH .= '</section>';
				$hH .= '</div>';
				$hH .= $hhI;
				$hH .= '</div>';
				//
				echo $hH;
			}

			// internal page heros
			if($layoutType == 'internalHero'){
				$internalHeroType 	= get_sub_field('internal_hero_type');
				$internalheroAlign 	= get_sub_field('section_alignment');
				//hero image or video
				if(($internalHeroType == 'heroImgBlock') || ($internalHeroType == 'heroImg')){
					$heroMediaType 		= get_sub_field('hero_media_type');
					if($heroMediaType == 'image'){
						$iHi 						= get_sub_field('hero_background_image')['url'];
						//blurred background
						if(get_sub_field('blur_background_image') == 'yes'){
							$heroBG					= '';
							$blurRadius			= get_sub_field('blur_radius');
							$heroBGBlur			= '<div class="heroBGblurred" style="background: url('.$iHi.') #fff; filter: blur('.$blurRadius.'px);" data-type="parallax" data-speed="-2"></div>';
						} else {
							$heroBG					= 'style="background: url('.$iHi.') #000"; data-type="parallax" data-speed="-2"';
						}
					}

					// internal hero content
					$sectionTitle 			= get_sub_field('section_title');
					$getContent					= get_sub_field('add_content_to_hero');
					if($getContent == 'addContent'){
						$sectionContent 		= get_sub_field('section_content');
					} else {
						$sectionContent			= '';
					}

					if( have_rows('column_buttons') ){
						$hb .= '<div class="button-block">';
						while ( have_rows('column_buttons') ) : the_row();
							$linkStyle 				= get_sub_field('button_type');
							$link 						= get_sub_field('button');
							$method						= get_sub_field('button_method');
							$vidLink					= get_sub_field('video_link');
							$formLink					= get_sub_field('form_link');
							$mediaLinks				= get_sub_field('media_link');
							$buttonText				= get_sub_field('button_text');
							$size 						= 'full';

							if($method == 'videoLightbox'){
								// video lightbox
								$hb .= '<a class="btn '.$linkStyle.'" data-fancybox href="'.$vidLink['url'].'" data-caption="'.$vidLink['title'].'">'.$vidLink['title'].''.$afterLinkIcon.'</a>';
							} elseif($method == 'formLightbox'){
								// form lightbox
								$hb .= '<a class="btn '.$linkStyle.'" data-fancybox href="'.$formLink['url'].'">'.$formLink['title'].''.$afterLinkIcon.'</a>';
							} elseif($method == 'imageLightbox'){
								// image gallery
								if( $mediaLinks ){
									$mediaLinkCount = 0;
									foreach( $mediaLinks as $mediaLink ){
										$mediaLinkCount++;
										if($mediaLinkCount == '1'){
											$hb .= '<a class="btn '.$linkStyle.'" data-fancybox="images" href="'.$mediaLink['url'].'" data-caption="'.$mediaLink['title'].'">'.$buttonText.''.$afterLinkIcon.'</a>';
										} else {
											$hb .= '<a style="display: none" data-fancybox="images" href="'.$mediaLink['url'].'" data-caption="'.$mediaLink['title'].'"></a>';
										}
									}
								}
							} else {
								// standard link
								$hb .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a>';
							}

						endwhile;
						$hb .= '</div>';
					}

					// background box
					if($sectionTitle != ''){
						$addBGcolor = get_sub_field('add_background_box');
						//$addShortcode = get_sub_field('add_shortcode');
						if($internalHeroType == 'heroImgBlock'){
							$ihc .= '<div class="content animated fadeInUp '.$addBGcolor.'">';
						} else {
							$ihc .= '<div class="content no-bg animated fadeInUp">';
						}
						$ihc .= '<div class="title-area">';
						$ihc .= $bc;
						$ihc .= $sectionTitle;
						$ihc .= '</div>';
						$ihc .= $sectionContent;
						$ihc .= $hb;
						$ihc .= '</div>';

						//mobile title
						$mhc .= '<div class="mobile-header">';
						$mhc .= $bc;
						$mhc .= $sectionTitle;
						$mhc .= '</div>';
						//
					}

					if($heroMediaType == 'backgroundVideo'){
						$iHv 						= get_sub_field('hero_background_video');
						$iHvi						= get_sub_field('hero_background_video_placeholder_image');
						$heroImage 			= 'style="background: url('.$iHvi['url'].') #000"; data-type="parallax" data-speed="-2"';
						$heroVideo 			= '
						<div class="vid hero-video">
							'.$mhc.'
							<video width="100%" height="100%" class="video" muted="" loop="" playsinline="" autoplay="">
								<source src="'.$iHv['url'].'" type="video/mp4">
							</video>
						</div>
						';
					}

					// end hero content
					$iH .= '<div class="hero-shape">';
					if((($internalheroAlign == 'leftAligned') || ($internalheroAlign == 'rightAligned')  || ($internalheroAlign == 'centerAligned'))){
						if($internalHeroType != 'heroImgBlock'){
							$fullSize .= 'full-size';
						} else {
							$fullSize .= 'positioned';
						}

						if($heroMediaType == 'image'){
							$iH .= '<section class="hero layout-builder internal-hero hero-img additional-padding align-'.$internalheroAlign.' '.$fullSize.'">';
							$iH .= '<div class="hero-img '.$iHv.' '.$heroRestrict.'" '.$heroBG.'">'.$mhc.'</div>';
							if(get_sub_field('blur_background_image') == 'yes'){
								$iH .= $heroBGBlur;
							}

							if($fullSize == 'full-size'){
								$iH .= '<div class="shade"></div>';
							}
						} else {
							$iH .= '<section class="hero layout-builder internal-hero hero-video additional-padding align-'.$internalheroAlign.' '.$fullSize.'">';

							$iH .= '<div class="shade"></div>';
							if($heroMediaType == 'backgroundVideo'){
								$iH .= $heroVideo;
							}
						}
					} else {
						if($heroMediaType == 'image'){
							$iH .= '<section class="hero layout-builder internal-hero hero-img '.$iHv.' '.$heroRestrict.' '.$fullSize.'" '.$heroBG.'>';
						} else {
							$iH .= '<section class="hero layout-builder internal-hero '.$iHv.' '.$heroRestrict.'" '.$heroImage.' '.$fullSize.'">';
						}
					}


					// internal hero

					$iH .= '<div class="columns is-multiline is-mobile">';
					  // determine alignment
					  if($internalheroAlign == 'leftAligned') {
					    $iH .= '<div class="column is-12-mobile is-12-tablet is-6-desktop is-5-widescreen">';
							$iH .= $ihc;
					    $iH .= '</div>';
					    $iH .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-6-mobile is-7-widescreen"></div>';
					  } elseif($internalheroAlign == 'rightAligned') {
					    $iH .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-6-mobile is-7-widescreen">';
					    $iH .= '</div>';
					    $iH .= '<div class="column is-12-mobile is-12-tablet is-6-desktop is-5-widescreen">';
							$iH .= $ihc;
					    $iH .= '</div>';
					  } else {
					    $iH .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
					    $iH .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
							$iH .= $ihc;
					    $iH .= '</div>';
							$iH .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
					  }
					$iH .= '</div>';
					// end alignment
					$iH .= '<div class="shadow">';
					$iH .= '<div class="header-shadow"></div>';
					$iH .= '</div>';
					// $iH .= '<div class="shade"></div>';
					// if($heroMediaType == 'backgroundVideo'){
					// 	$iH .= $heroVideo;
					// }

					$iH .= '</section>';
					$iH .= '</div>';
					//
					echo $iH;
					// end internal hero
				}

				// hero bar
				if($internalHeroType == 'heroBar'){
					// js to position header
					// echo '
					// <script type="text/javascript">
					// 	window.onload = function() {
  				// 		document.getElementById("header").className = "is-relative";
					// 	};
					// </script>';
					$heroBG 			= get_field('header_placeholder_image', 'options');
					if($heroBG){
						$bgImg .= 'url('.$bgImg["url"].') no-repeat';
					}
					$heroBGColor 	= get_field('default_header_background_color', 'options');

					// header bar
					$iH .= '<section class="header-bar layout-builder align-'.$internalheroAlign.'" style="background:'.$bgImg.$heroBGColor.'">';
					$iH .= $bc;
					$iH .= '<div class="columns is-multiline is-mobile">';
					$iH .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
					$iH .= $sectionTitle;
					$iH .= '</div>';
					$iH .= '</div>';
					$iH .= '</section>';
					// content below header bar
					//$iH .= '<div class="columns">';
					echo $iH;
				}
			}

			// generic slideshow - just image and link
			if($layoutType == 'genericSlideshow') {
				$heroSizer = get_sub_field('hero_sizer');
				if( have_rows('generic_slideshow') ):
					$gs .= '<section class="layout-builder">';
					$gs .= '<div class="generic-slideshow">';
					while ( have_rows('generic_slideshow') ) : the_row();
						$slideLink		= get_sub_field('link');
						$slideBG 			= get_sub_field('slide_image');
						//

						$gs .= '<div class="slide">';
						$gs .= '<a href="'.$slideLink['url'].'" title="'.$slideLink['title'].'">';
						$gs .= '<img src="'.$slideBG['url'].'" alt="'.$slideLink['title'].'">';
						$gs .= '</a>';
						$gs .= '</div>';
					endwhile;
					$gs .= '</div>';
					$gs .= '</section>';

					echo $gs;
				endif;
			}

			//header
			if($layoutType == 'headerArea'){
				//variables
				$headerType = get_sub_field('header_type');
				$headerBG = get_sub_field('page_header_image');
				$override = get_sub_field('override_title');
				$overrideTitle = get_sub_field('title_override');
				$cropType = get_sub_field('header_crop');
				$standOutImage = get_sub_field('standout_image');
				$headerContent = get_sub_field('header_content');
				$textAlignment = get_sub_field('header_text_alignment');
				$overrideHeroColor = get_sub_field('override_hero_colors');
				$title = get_the_title();
				$page = get_the_id();
				//
				$h .= '<section class="hero layout-builder internal-hero '.$headerType.' '.$overrideHeroColor.'" style="overflow: '.$cropType.'">';
				$h .= '<div class="hero-content">';
				$h .= '<div class="columns is-multiline is-mobile">';
				if($headerType == 'textHeader'){
					// center align
					if($textAlignment == 'center'){
						$h .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen">&nbsp;</div>';
						$h .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen align-'.$textAlignment.'">';
						$h .= '<div class="hero-text-cont">';
						if($override == 'yes'){
							$h .= '<h1>'.$overrideTitle.'</h1>';
						} else {
							$h .= '<h1>'.$title.'</h1>';
						}
						$h .= $headerContent;
						// header buttons
						if( have_rows('header_buttons') ){
							$h .= '<div class="button-block internal-hero">';
							while ( have_rows('header_buttons') ) : the_row();
								$linkType 				= get_sub_field('link_type');
								$linkStyle 				= get_sub_field('link_style');
								$link 						= get_sub_field('button');
								$vidLink 					= get_sub_field('youtube_link');
								$vidText 					= get_sub_field('button_text');

								if($linkType == 'pageLink'){
									$h .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a></li>';
								}

								if($linkType == 'youtubeVideo'){
									$h .= '<a class="btn '.$linkStyle.' ico-before" data-fancybox href="'.$vidLink.'"title="'.$vidText.'">'.$playIcon.''.$vidText.'</a></li>';
								}
							endwhile;
							$h .= '</div>';
						}
						$h .= '</div>';
						$h .= '</div>';
						$h .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen">&nbsp;</div>';
					} // end center align

					// left align
					if($textAlignment == 'left'){
						$h .= '<div class="column is-12 align-'.$textAlignment.'">';
						$h .= '<div class="hero-text-cont">';
						if($override == 'yes'){
							$h .= '<h1>'.$overrideTitle.'</h1>';
						} else {
							$h .= '<h1>'.$title.'</h1>';
						}
						$h .= $headerContent;
						// header buttons
						if( have_rows('header_buttons') ){
							$h .= '<div class="button-block internal-hero">';
							while ( have_rows('header_buttons') ) : the_row();
								$linkType 				= get_sub_field('link_type');
								$linkStyle 				= get_sub_field('link_style');
								$link 						= get_sub_field('button');
								$vidLink 					= get_sub_field('youtube_link');
								$vidText 					= get_sub_field('button_text');

								if($linkType == 'pageLink'){
									$h .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a></li>';
								}

								if($linkType == 'youtubeVideo'){
									$h .= '<a class="btn '.$linkStyle.' ico-before" data-fancybox href="'.$vidLink.'"title="'.$vidText.'">'.$playIcon.''.$vidText.'</a></li>';
								}
							endwhile;
							$h .= '</div>';
						}
						$h .= '</div>';
						$h .= '</div>';
					} // end left align

					// right align
					if($textAlignment == 'right'){
						$h .= '<div class="column is-12 align-'.$textAlignment.'">';
						$h .= '<div class="hero-text-cont">';
						if($override == 'yes'){
							$h .= '<h1>'.$overrideTitle.'</h1>';
						} else {
							$h .= '<h1>'.$title.'</h1>';
						}
						$h .= $headerContent;
						// header buttons
						if( have_rows('header_buttons') ){
							$h .= '<div class="button-block internal-hero">';
							while ( have_rows('header_buttons') ) : the_row();
								$linkType 				= get_sub_field('link_type');
								$linkStyle 				= get_sub_field('link_style');
								$link 						= get_sub_field('button');
								$vidLink 					= get_sub_field('youtube_link');
								$vidText 					= get_sub_field('button_text');

								if($linkType == 'pageLink'){
									$h .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a></li>';
								}

								if($linkType == 'youtubeVideo'){
									$h .= '<a class="btn '.$linkStyle.' ico-before" data-fancybox href="'.$vidLink.'"title="'.$vidText.'">'.$playIcon.''.$vidText.'</a></li>';
								}
							endwhile;
							$h .= '</div>';
						}
						$h .= '</div>';
						$h .= '</div>';
					} // end right align
				} else {
					$h .= '<div class="column is-12-mobile is-12-tablet is-7-desktop is-7-widescreen">';
					$h .= '<div class="hero-text-cont">';
					if($override == 'yes'){
						$h .= '<h1>'.$overrideTitle.'</h1>';
					} else {
						$h .= '<h1>'.$title.'</h1>';
					}
					$h .= $headerContent;
					// header buttons
					if( have_rows('header_buttons') ){
						$h .= '<div class="button-block internal-hero">';
				    while ( have_rows('header_buttons') ) : the_row();
							$linkType 				= get_sub_field('link_type');
							$linkStyle 				= get_sub_field('link_style');
							$link 						= get_sub_field('button');
							$vidLink 					= get_sub_field('youtube_link');
							$vidText 					= get_sub_field('button_text');

							if($linkType == 'pageLink'){
								$h .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a></li>';
							}

							if($linkType == 'youtubeVideo'){
								$h .= '<a class="btn '.$linkStyle.' ico-before" data-fancybox href="'.$vidLink.'"title="'.$vidText.'">'.$playIcon.''.$vidText.'</a></li>';
							}
				    endwhile;
						$h .= '</div>';
					}
					$h .= '</div>';
					$h .= '</div>';
					$h .= '<div class="column is-12-mobile is-12-tablet is-5-desktop is-5-widescreen image-side">';
					if($page != '8'){
						$h .= '<img src="'.$standOutImage['url'].'" alt="'.$title.'" class="standout animated fadeInUp">';
						$h .= '<div class="popout-circle animated fadeIn _3"></div>';
					} else {
						// about page
						$h .= '<img src="'.$standOutImage['url'].'" alt="'.$title.'" class="standout top-aligned animated fadeInDown">';
					}
				}
				$h .= '</div>';
				$h .= '</div>';
				$h .= '</div>';
				if($headerBG != ''){
					$h .= '<div class="header-image" style="background-image: url('.$headerBG['url'].')"></div>';
				}
				$h .= '</section>';

				echo $h;
			}

			// layout type = shortcode
			$shortcodeType = get_sub_field('shortcode_type');
			if($layoutType == 'shortcode'){
				if($shortcodeType == 'custom'){
					// custom
					$customShortcode = get_sub_field('custom_shortcode');
					echo do_shortcode($customShortcode);
				} else {
					// default
					$defaultShortcode = get_sub_field('default_shortcodes');
					echo do_shortcode('['.$defaultShortcode.']');
				}

			}
			// end layout

			//layout type = steps
			if($layoutType == 'steps'){
				$stepCount = 0;
				if( have_rows('steps') ){
					$s .= '<section class="step-content layout-builder main-content internal-content">';
					$s .= '<div class="columns is-mobile is-multiline line-container">';
					while (have_rows('steps')) : the_row();
						$stepCount++;
						$stepIcon 		= get_sub_field('step_icon');
						$stepTitle 		= get_sub_field('step_title');
						$stepContent 	= get_sub_field('step_content');
						$stepLinks 		= get_sub_field('step_links');
						$stepLinkType = get_sub_field('step_link_type');
						$contactLinks = get_sub_field('step_contact_link');
						//
						$s .= '<div class="step column is-12-mobile is-3-tablet is-2-desktop is-1-widescreen animated fadeInUp _'.$stepCount.'">';
						$s .= '<div class="step-icon">'.$stepIcon.'</div>';
						$s .= '</div>';
						$s .= '<div class="step column is-12-mobile is-9-tablet is-10-desktop is-11-widescreen step-cont animated fadeInUp _'.$stepCount.'">';
						$s .= '<div class="step-title">'.$stepTitle.'</div>';
						$s .= $stepContent;
						if($stepLinks == 'yes'){
							// page links
							if($stepLinkType == 'pageLink'){
								if( have_rows('step_page_links') ){
									$s .= '<div class="button-block">';
							    while ( have_rows('step_page_links') ) : the_row();
						      	$pl = get_sub_field('page_link');
										$s .= '<a class="btn" href="'.$pl['url'].'" title="'.$pl['title'].'" target="'.$pl['target'].'">'.$pl['title'].''.$afterLinkIcon.'</a>';
							    endwhile;
									$s .= '</div>';
								}
							}

							// contact info
							if($stepLinkType == 'contactInfo'){
								// address
								$s .= '<div class="contact-info">';
								if(in_array('address', $contactLinks) && ($address != '')){
									$s .= '<div class="contact add">';
									if($locationicon != ''){
										$s .= $locationicon;
									}
									$s .= $address;

									if($city != ''){
										$s .= ', ' . $city;
									}

									if($state != ''){
										$s .= ', ' . $state;
									}

									if($zip != ''){
										$s .= ' ' . $zip;
									}

									$s .= '</div>';
								}

								// primary phone
								if(in_array('primaryPhone', $contactLinks) && ($mainphone != '')){
									$s .= '<div class="contact">';
									if($phoneicon != ''){
										$s .= $phoneicon;
									}
									$s .= $mainphone;
									$s .= '</div>';
								}

								// sales phone
								if(in_array('salesPhone', $contactLinks) && ($salesphone != '')){
									$s .= '<div class="contact">';
									if($phoneicon != ''){
										$s .= $phoneicon;
									}
									$s .= $salesphone;
									$s .= '</div>';
								}

								// service phone
								if(in_array('servicePhone', $contactLinks) && ($servicephone != '')){
									$s .= '<div class="contact">';
									if($phoneicon != ''){
										$s .= $phoneicon;
									}
									$s .= $servicephone;
									$s .= '</div>';
								}

								// support phone
								if(in_array('supportPhone', $contactLinks) && ($supportphone != '')){
									$s .= '<div class="contact">';
									if($phoneicon != ''){
										$s .= $phoneicon;
									}
									$s .= $supportphone;
									$s .= '</div>';
								}

								// primary email
								if(in_array('primaryEmail', $contactLinks) && ($mainemail != '')){
									$s .= '<div class="contact">';
									if($emailicon != ''){
										$s .= $emailicon;
									}
									$s .= '<a href="'.$mainemail.'" title="Email Us">'.$mainemail.'</a>';
									$s .= '</div>';
								}

								// sales email
								if(in_array('salesEmail', $contactLinks) && ($salesemail != '')){
									$s .= '<div class="contact">';
									if($emailicon != ''){
										$s .= $emailicon;
									}
									$s .= '<a href="'.$salesemail.'" title="Email Us">'.$salesemail.'</a>';
									$s .= '</div>';
								}

								// service email
								if(in_array('serviceEmail', $contactLinks) && ($serviceemail != '')){
									$s .= '<div class="contact">';
									if($emailicon != ''){
										$s .= $emailicon;
									}
									$s .= '<a href="'.$serviceemail.'" title="Email Us">'.$serviceemail.'</a>';
									$s .= '</div>';
								}

								// support email
								if(in_array('supportEmail', $contactLinks) && ($supportemail != '')){
									$s .= '<div class="contact">';
									if($emailicon != ''){
										$s .= $emailicon;
									}
									$s .= '<a href="'.$supportemail.'" title="Email Us">'.$supportemail.'</a>';
									$s .= '</div>';
								}

								// fax
								if(in_array('fax', $contactLinks) && ($mainfax != '')){
									$s .= '<div class="contact">';
									if($phoneicon != ''){
										$s .= $phoneicon;
									}
									$s .= 'fax: ' . $supportemail;
									$s .= '</div>';
								}
								$s .= '</div>';
							}
						}
						$s .= '</div>';
				  endwhile;
					$s .= '</div>';
					$s .= '</section>';
				}
				echo $s;
			}
			// end steps

			// layout type - fifty percents
			if($layoutType == 'fiftyPercents'){
				$col1Shortcode = get_sub_field('column_1_shortcode');
				$col2Shortcode = get_sub_field('column_2_shortcode');
				echo '<section class="fifty-percents layout-builder">';
				echo do_shortcode($col1Shortcode);
				echo do_shortcode($col2Shortcode);
				echo '</section>';
			}
			// end fifty percents

			// section types - left aligned
		  if($layoutType == 'leftAligned') {
		    echo '<div class="columns leftalign layout-builder is-multiline is-mobile">'; // open column

		    if(($addMedia == 'ytVideo') || ($addMedia == 'image')){
		      echo '<div class="column is-12-mobile is-8-tablet is-8-desktop is-8-widescreen">';
		      echo $sectionContent;
		      if(get_sub_field('column_buttons')):
		        echo '<div class="button-block">';
		        while(the_repeater_field('column_buttons')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		        endwhile;
		        echo '</div>';
		      endif;
		      echo '</div>';

		      echo '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
		      // youtube
		      if($addMedia == 'ytVideo'){
		        echo '
		          <a data-fancybox href="'.$video_url.'" title="Click to Watch">
		            <div class="media-asset">
		              <div class="video"><img src="'.$video_thumb_url.'" alt="'.$title['title'].'"></div>
		            </div>
		          </a>
		        ';
		      }
		      // image
		      if($addMedia == 'image'){
	          echo '
	            <div class="image-holder">
	              <img src="'.$columnImage['url'].'" alt="'.$columnImage['title'].'">
	            </div>
	          ';
		      }
		      echo '</div>';
		    } else {
		      echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen leftalign">';
		      echo $sectionContent;
		      if(get_sub_field('column_buttons')):
		        echo '<div class="button-block">';
		        while(the_repeater_field('column_buttons')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		        endwhile;
		        echo '</div>';
		      endif;
		      echo '</div>';
		    }
		    echo '</div>'; // close column
		  }
			// end left align

			// section layout - center align
		  if($layoutType == 'centeredAligned') {
		    echo '<div class="columns centeralign layout-builder is-multiline is-mobile">'; // open column
				//echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
				echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		    echo $sectionContent;
		    if(get_sub_field('column_buttons')):
		      echo '<div class="button-block">';
		      while(the_repeater_field('column_buttons')):
		        $button 	= get_sub_field('button');
						$butType 	= get_sub_field('button_type');
		        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		      endwhile;
		      echo '</div>';
		    endif;
		    // youtube
		    if($addMedia == 'ytVideo'){
		      echo '
		        <a data-fancybox href="'.$video_url.'" title="Click to Watch">
		          <div class="media-asset">
		            <div class="video"><img src="'.$video_thumb_url.'" alt="'.$title['title'].'"></div>
		          </div>
		        </a>
		      ';
		    }
		    // image
		    if($addMedia == 'image'){
		      echo '
		        <div class="media-asset">
		          <img src="'.$columnImage['url'].'" alt="'.$columnImage['title'].'">
		        </div>
		      ';
		    }
		    echo '</div>';
		    //echo '<div class="column is-1">&nbsp;</div>';
		    echo '</div>'; // close column
		  }

		  // right align
		  if($layoutType == 'rightAligned') {
		    echo '<div class="columns rightalign layout-builder">'; // open column

		    if(($addMedia == 'ytVideo') || ($addMedia == 'image')){
		      echo '<div class="column is-8">';
		      echo $sectionContent;
		      if(get_sub_field('column_buttons')):
		        echo '<div class="button-block">';
		        while(the_repeater_field('column_buttons')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		        endwhile;
		        echo '</div>';
		      endif;
		      echo '</div>';

		      echo '<div class="column is-4">';
		      // youtube
		      if($addMedia == 'ytVideo'){
		        echo '
		          <a data-fancybox href="'.$video_url.'" title="Click to Watch">
		            <div class="media-asset">
		              <div class="video"><img src="'.$video_thumb_url.'" alt="'.$title['title'].'"></div>
		            </div>
		          </a>
		        ';
		      }
		      // image
		      if($addMedia == 'image'){
	          echo '
	            <div class="image-holder">
	              <img src="'.$columnImage['url'].'" alt="'.$columnImage['alt'].'">
	            </div>
	          ';
		      }
		      echo '</div>';
		    } else {
		      echo '<div class="column is-12 rightalign">';
		      echo $sectionContent;
		      if(get_sub_field('column_buttons')):
		        echo '<div class="button-block">';
		        while(the_repeater_field('column_buttons')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		        endwhile;
		        echo '</div>';
		      endif;
		      echo '</div>';
		    }
		    echo '</div>'; // close column
		  }

			// dual col

		  if($layoutType == 'dualCol') {

				if($addMediaCol1 == 'yes'){
					$reversed = 'reversedcols';
				} else {
					$reversed = 'noreversedcols';
				}
				echo '<section class="dual-col-blocks layout-builder '.$sectionAlignment.' '.$reverseColumns.' '.$invertBG.'">';
		    echo '<div class="columns is-mobile is-multiline '.$reversed.'">';
				// if section title
				if($incTitle == 'yes'){
					if($sectionAlignment == 'center'){
						echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
						echo '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen sec-title">';
						echo $sectionTitle;
						echo '</div>';
						echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
					} else {
						echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen sec-title">';
						echo $sectionTitle;
						echo '</div>';
					}
				}
				//end section title

				//service page icon
				echo '<div class="column is-12-mobile is-6-tablet is-6-desktop is-6-widescreen">';
					// dual col - sec 1 cont
					echo $sectionContent1;

					if($bgIcon != ''){
						echo '<img src="'.$bgIcon['url'].'" class="bg-icon">';
					}

			    if(get_sub_field('column_buttons_1')):
			      echo '<div class="button-block">';
			      while(the_repeater_field('column_buttons_1')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
			      endwhile;
			      echo '</div>';
			    endif;
					// end dual col sect 1 cont
		    echo '</div>';

				echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-hidden-desktop-only is-1-widescreen">&nbsp;</div>';
		    	echo '<div class="column is-12-mobile is-6-tablet is-6-desktop is-5-widescreen">';
				    if($addMediaCol1 == 'ytVideo'){
				      echo '
				        <a data-fancybox href="'.$video_url1.'" title="Click to Watch">
				          <div class="media-asset">
				            <div class="video"><img src="'.$video_thumb_url1.'"></div>
				          </div>
				        </a>
				      ';
						} elseif($addMediaCol1 == 'customVideo'){
							// borderless or bordered image
							echo '<div class="media-asset '.$column1VideoType.'">';
							echo '<video width="100%" height="100%" class="video" muted playsinline>';
							echo '<source src="'.$video_file1['url'].'" type="video/mp4">';
							echo '</video>';
							echo '</div>';
				    } elseif($addMediaCol1 == 'image'){

							// borderless or bordered image
							echo '<div class="media-asset '.$column1ImageType.'">';
							echo '<img src="'.$columnImage1['url'].'" alt="'.$columnImage1['title'].'">';
							if($columnImage1['caption']){
								echo '<figcaption class="caption">'.$columnImage1['caption'].'</figcaption>';
							}
							echo '</div>';
							// close media
				    } else {
							// dual col - sec 2 cont if no media is displayed
							echo $sectionContent2;
					    if(get_sub_field('column_buttons_2')):
					      echo '<div class="button-block">';
					      while(the_repeater_field('column_buttons_2')):
									$button 	= get_sub_field('button');
									$butType 	= get_sub_field('button_type');
					        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
					      endwhile;
					      echo '</div>';
					    endif;
							// end dual col sect 2 cont
						}
		    	echo '</div>';
		    	echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
		    echo '</div>'; // close column
				echo '</section>';
		  }

			// five-sixth, media left or right
			if(($layoutType == 'five-sixth-left') || ($layoutType == 'five-sixth-right')) {
				if($layoutType == 'five-sixth-right') {
					$alignment = 'right';
				} else {
					$alignment = 'left';
				}
				echo '<div class="columns five-sixth layout-builder '.$alignment.'-media is-mobile is-multiline">'; // open column
		    echo '<div class="column is-12-mobile is-5-tablet is-5-desktop is-5-widescreen">';
				if($addMediaCol1 == 'ytVideo'){
		      echo '
		        <a data-fancybox href="'.$video_url1.'" title="Click to Watch">
		          <div class="media-asset">
		            <div class="video"><img src="'.$video_thumb_url1.'"></div>
		          </div>
		        </a>
		      ';
		    } elseif($addMediaCol1 == 'customVideo'){
					// borderless or bordered image
					echo '<div class="media-asset '.$column1VideoType.'">';
					echo '<video width="100%" height="100%" class="video" muted playsinline>';
					echo '<source src="'.$video_file1['url'].'" type="video/mp4">';
					echo '</video>';
					echo '</div>';
				}
				// image
		    if($addMediaCol1 == 'image'){
					// borderless or bordered image
					echo '<div class="media-asset '.$column1ImageType.'">';
					echo '<img src="'.$columnImage1['url'].'" alt="'.$columnImage1['title'].'">';
					if($columnImage1['caption']){
						echo '<figcaption class="caption">'.$columnImage1['caption'].'</figcaption>';
					}
					echo '</div>';
		    } // close image
		    echo '</div>';
		    echo '<div class="column is-12-mobile is-7-tablet is-7-desktop is-7-widescreen">';
				echo $sectionContent1;
		    if(get_sub_field('column_buttons_1')):
		      echo '<div class="button-block">';
		      while(the_repeater_field('column_buttons_1')):
						$button 	= get_sub_field('button');
						$butType 	= get_sub_field('button_type');
		        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		      endwhile;
		      echo '</div>';
		    endif;
		    echo '</div>';
		    echo '</div>'; // close column
			}

			// tri col
		  if($layoutType == 'triCol') {
				echo '<section class="tri-col-blocks layout-builder '.$sectionAlignment.'">';
				echo '<div class="columns is-mobile is-multiline">'; // open column
				// if section title
				if(($incTitle == 'yes') && ($sectionAlignment == 'centerAligned')){
					echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
					echo '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen sec-title">';
					echo $sectionTitle;
					echo '</div>';
					echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-2-desktop is-2-widescreen"></div>';
				} elseif($incTitle == 'yes') {
					echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen sec-title">';
					echo $sectionTitle;
					echo '</div>';
				}
				//end section title

				// column 1
			 	echo '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
				if($column1Type == 'sharedBlock'){
					$column1Block = get_sub_field('column_1_block');
					if( $column1Block ):
						$postBlock = $column1Block;
						setup_postdata( $postBlock );
						$columnBlockTitle 	= get_field('column_block_title', $postBlock->ID);
						$columnBlockImage 	= get_field('column_block_image', $postBlock->ID);
						$columnBlockContent = get_field('column_block_content', $postBlock->ID);
						$columnBlockLink 		= get_field('column_block_link', $postBlock->ID);
						//
						$block1 .= '<div class="media-asset bordered">';
						if($columnBlockLink != ''){
							$block1 .= '<a  href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'"><img src="'.$columnBlockImage['url'].'" alt="'.$columnBlockTitle.'"></a>';
						} else {
							$block1 .= '<img src="'.$columnBlockImage['url'].'" alt="'.$columnBlockTitle.'">';
						}
						$block1 .= '</div>';
						if($columnBlockLink != ''){
					    $block1 .= '<h3><a  href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'">'.$columnBlockTitle.'</a></h3>';
					  } else {
					    $block1 .= '<h3>'.$columnBlockTitle.'</h3>';
					  }
						$block1 .= $columnBlockContent;
						if($columnBlockLink != ''){
							$block1 .= '<div class="button-block"><a class="btn" href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'">'.$columnBlockLink['title'].$afterLinkIcon.'</a></div>';
						}
						echo $block1;

				  wp_reset_postdata();
					endif;
				} else {
					if($addMediaCol1 == 'ytVideo'){
			      echo '
			        <a data-fancybox href="'.$video_url1.'" title="Click to Watch">
			          <div class="media-asset">
			            <div class="video"><img src="'.$video_thumb_url1.'"></div>
			          </div>
			        </a>
			      ';
			    } elseif($addMediaCol1 == 'customVideo'){
						// borderless or bordered image
						echo '<div class="media-asset '.$column1VideoType.'">';
						echo '<video width="100%" height="100%" class="video" muted playsinline>';
						echo '<source src="'.$video_file1['url'].'" type="video/mp4">';
						echo '</video>';
						echo '</div>';
					}

					// image
			    if($addMediaCol1 == 'image'){
			      $image = $columnImage1;
			      $image1_url = $image['sizes']['tri-col-img'];
			      $imageNC1 = $columnImage1['url'];
			      //
			      if($imageCrop == 'yes'){
			        $m1 .= '<div class="media-asset '.$column1ImageTypeDup.'">';
			        $m1 .= '<img src="'.$image1_url.'" alt="'.$columnImage1['title'].'">';
			        $m1 .= '</div>';
			      } else {
			        $m1 .= '<div class="media-asset '.$column1ImageTypeDup.'">';
			        $m1 .= '<img src="'.$imageNC1.'" alt="'.$columnImage1['title'].'">';
			        $m1 .= '</div>';
			      }

						if($columnImageLink1 != ''){
							echo '<a href="'.$columnImageLink1['url'].'" title="'.$columnImageLink1['title'].'">'.$m1.'</a>';
						} else {
							echo $m1;
						}
			    }
			    echo $sectionContent1;
			    if(get_sub_field('column_buttons_1')):
			      echo '<div class="button-block">';
			      while(the_repeater_field('column_buttons_1')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
			      endwhile;
			      echo '</div>';
			    endif;
				}
		    echo '</div>';

				// column 2
		    echo '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
				if($column2Type == 'sharedBlock'){
					$column2Block = get_sub_field('column_2_block');
					if( $column2Block ):
					  $postBlock = $column2Block;
					  setup_postdata( $postBlock );
					  $columnBlockTitle 	= get_field('column_block_title', $postBlock->ID);
					  $columnBlockImage 	= get_field('column_block_image', $postBlock->ID);
					  $columnBlockContent = get_field('column_block_content', $postBlock->ID);
					  $columnBlockLink 		= get_field('column_block_link', $postBlock->ID);
					  //
					  $block2 .= '<div class="media-asset bordered">';
					  if($columnBlockLink != ''){
					    $block2 .= '<a  href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'"><img src="'.$columnBlockImage['url'].'" alt="'.$columnBlockTitle.'"></a>';
					  } else {
					    $block2 .= '<img src="'.$columnBlockImage['url'].'" alt="'.$columnBlockTitle.'">';
					  }
					  $block2 .= '</div>';
						if($columnBlockLink != ''){
					    $block2 .= '<h3><a  href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'">'.$columnBlockTitle.'</a></h3>';
					  } else {
					    $block2 .= '<h3>'.$columnBlockTitle.'</h3>';
					  }
					  $block2 .= $columnBlockContent;
					  if($columnBlockLink != ''){
					    $block2 .= '<div class="button-block"><a class="btn" href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'">'.$columnBlockLink['title'].$afterLinkIcon.'</a></div>';
					  }
					  echo $block2;

					wp_reset_postdata();
					endif;
				} else {
				  if($addMediaCol2 == 'ytVideo'){
			      echo '
			        <a data-fancybox href="'.$video_url2.'" title="Click to Watch">
			          <div class="media-asset">
			            <div class="video"><img src="'.$video_thumb_url2.'"></div>
			          </div>
			        </a>
			      ';
					} elseif($addMediaCol2 == 'customVideo'){
						// borderless or bordered image
						echo '<div class="media-asset '.$column2VideoType.'">';
						echo '<video width="100%" height="100%" class="video" muted playsinline>';
						echo '<source src="'.$video_file2['url'].'" type="video/mp4">';
						echo '</video>';
						echo '</div>';
					}
			    // image
			    if($addMediaCol2 == 'image'){
			      $image = $columnImage2;
			      $image2_url = $image['sizes']['tri-col-img'];
			      $imageNC2 = $columnImage2['url'];
						//
			      if($imageCrop == 'yes'){
			        $m2 .= '<div class="media-asset '.$column2ImageTypeDup.'">';
			        $m2 .= '<img src="'.$image2_url.'" alt="'.$columnImage2['title'].'">';
			        $m2 .= '</div>';
			      } else {
			        $m2 .= '<div class="media-asset '.$column2ImageTypeDup.'">';
			        $m2 .= '<img src="'.$imageNC2.'" alt="'.$columnImage2['title'].'">';
			        $m2 .= '</div>';
			      }

						if($columnImageLink2 != ''){
							echo '<a href="'.$columnImageLink2['url'].'" title="'.$columnImageLink2['title'].'">'.$m2.'</a>';
						} else {
							echo $m2;
						}
			    }
			    echo $sectionContent2;
			    if(get_sub_field('column_buttons_2')):
			      echo '<div class="button-block">';
			      while(the_repeater_field('column_buttons_2')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
			      endwhile;
			      echo '</div>';
			    endif;
				}
		    echo '</div>';

				// column 3
		    echo '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
				if($column3Type == 'sharedBlock'){
					$column3Block = get_sub_field('column_3_block');
					if( $column3Block ):
					  $postBlock = $column3Block;
					  setup_postdata( $postBlock );
					  $columnBlockTitle 	= get_field('column_block_title', $postBlock->ID);
					  $columnBlockImage 	= get_field('column_block_image', $postBlock->ID);
					  $columnBlockContent = get_field('column_block_content', $postBlock->ID);
					  $columnBlockLink 		= get_field('column_block_link', $postBlock->ID);
					  //
					  $block3 .= '<div class="media-asset bordered">';
					  if($columnBlockLink != ''){
					    $block3 .= '<a  href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'"><img src="'.$columnBlockImage['url'].'" alt="'.$columnBlockTitle.'"></a>';
					  } else {
					    $block3 .= '<img src="'.$columnBlockImage['url'].'" alt="'.$columnBlockTitle.'">';
					  }
					  $block3 .= '</div>';
						if($columnBlockLink != ''){
					    $block3 .= '<h3><a  href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'">'.$columnBlockTitle.'</a></h3>';
					  } else {
					    $block3 .= '<h3>'.$columnBlockTitle.'</h3>';
					  }
					  $block3 .= $columnBlockContent;
					  if($columnBlockLink != ''){
					    $block3 .= '<div class="button-block"><a class="btn" href="'.$columnBlockLink['url'].'" title="'.$columnBlockLink['title'].'" target="'.$columnBlockLink['target'].'">'.$columnBlockLink['title'].$afterLinkIcon.'</a></div>';
					  }
					  echo $block3;

					wp_reset_postdata();
					endif;
				} else {
				  if($addMediaCol3 == 'ytVideo'){
			      echo '
			        <a data-fancybox href="'.$video_url3.'" title="Click to Watch">
			          <div class="media-asset">
			            <div class="video"><img src="'.$video_thumb_url3.'"></div>
			          </div>
			        </a>
			      ';
			    }
			    // image
			    if($addMediaCol3 == 'image'){
			      $image = $columnImage3;
			      $image3_url = $image['sizes']['tri-col-img'];
			      $imageNC3 = $columnImage3['url'];
			      //
						//
			      if($imageCrop == 'yes'){
			        $m3 .= '<div class="media-asset '.$column3ImageTypeDup.'">';
			        $m3 .= '<img src="'.$image3_url.'" alt="'.$columnImage3['title'].'">';
			        $m3 .= '</div>';
			      } else {
			        $m3 .= '<div class="media-asset '.$column3ImageTypeDup.'">';
			        $m3 .= '<img src="'.$imageNC3.'" alt="'.$columnImage3['title'].'">';
			        $m3 .= '</div>';
			      }

						if($columnImageLink3 != ''){
							echo '<a href="'.$columnImageLink3['url'].'" title="'.$columnImageLink3['title'].'">'.$m3.'</a>';
						} else {
							echo $m3;
						}
			    }
			    echo $sectionContent3;
			    if(get_sub_field('column_buttons_3')):
			      echo '<div class="button-block">';
			      while(the_repeater_field('column_buttons_3')):
							$button 	= get_sub_field('button');
							$butType 	= get_sub_field('button_type');
			        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
			      endwhile;
			      echo '</div>';
			    endif;
			    echo '</div>';
				}
		    echo '</div>'; // close column
				echo '</section>';
		  }

			// staff
		  if($layoutType == 'staff') {
		    echo '<div class="columns is-mobile is-multiline staff layout-builder">'; // open column
				echo '<div class="column is-12">';

				if($staffTitle){
					echo '<div class="section-title">'.$staffTitle.'</div>';
				}

				if($staffCont){
					echo '<div class="section-content">'.$staffCont.'</div>';
				}


					//staff blocks
					if( have_rows('staff') ){
						echo '<ul class="staff-list">';
						while ( have_rows('staff') ) : the_row();
							$staff_name 			= get_sub_field('staff_name');
							$jobTitle 				= get_sub_field('staff_title');
							$email 						= get_sub_field('email_address');
							$linkedinLink 		= get_sub_field('linkedin_link');
							$includeBio 			= get_sub_field('include_bio');
							$bio 							= get_sub_field('bio');
							$headshot					= get_sub_field('staff_image');
							$headshotPH				= get_field('profile_placeholder_image', 'options');
							$teamMemberName2 	= str_replace(' ', '', $staff_name);
							$cleanedName 			= preg_replace('/[^A-Za-z0-9\-]/', '', $teamMemberName2);

							if(($includeBio != 'no') && ($bio != '')){
								$bioExists = 'true';
							} else {
								$bioExists = 'false';
							}

							//
							if($bioExists = 'true'){
								echo '<li class="staff-member call-out '.$bioExists.'">';
							} else {
								echo '<li class="staff-member">';
							}

							//if headshot
							if($headshot != ''){
								echo '<div class="staff-image"><div><img src="'.$headshot['url'].'" alt="'.$staff_name.'"></div></div>';
							} else {
								echo '<div class="staff-image"><div><img src="'.$headshotPH['url'].'" alt="'.$staff_name.'"></div></div>';
							}

							//staff info
							echo '<div class="staff-info">';

							// if staff name
							if($staff_name != ''){
								echo '<div class="name">'.$staff_name.'</div>';
								echo '<hr class="cb">';
							}
							// title
							if($jobTitle != ''){
								echo '<div class="title">'.$jobTitle.'</div>';
							}

							if(($linkedinLink) || ($email)){
								echo '<ul class="connect">';
								//
								if($linkedinLink){
									echo '<li><a href="'.$linkedinLink.'" title="View LinkedIn Profile" target="_blank"><icon class="icon-solid-linkedin"></icon></a></li>';
								}

								if($email){
									echo '<li><a href="mailto'.$email.'" title="Email '.$staff_name.'" target="_blank"><icon class="icon-solid-envelope"></icon></a></li>';
								}
								//
								echo '</ul>';
							}

							//
							if($bioExists = 'true'){
								// bio
								echo '<div class="bio">'.$bio.'</div>';
							}

							echo '</div>';


							// bio
							if($bioExists = 'true'){
								echo '<div style="display: none;" id="bio-'.$cleanedName.'" class="animated-modal bio-modal text-center">';

								echo '<div class="staff-member">';
								//if headshot
								if($headshot != ''){
									echo '<div class="staff-image"><img src="'.$headshot['url'].'" alt="'.$staff_name.'"></div>';
								} else {
									echo '<div class="staff-image"><img src="'.$headshotPH['url'].'" alt="'.$staff_name.'"></div>';
								}

								echo '<div class="staff-info">';
								// if staff name
								if($staff_name != ''){
									echo '<div class="name">'.$staff_name.'</div>';
								}
								// title
								if($jobTitle != ''){
									echo '<div class="title">'.$jobTitle.'</div>';
								}

								// bio
								echo '<div class="bio">'.$bio.'</div>';

								// email
								if($email != ''){
									echo '<a class="email" href="mailto:'.$email.'">'.$emailicon.' Contact Me</a>';
								}
								echo '</div>';
								echo '</div>';

								//
								echo '</div>';
							}
							// end bio

							echo '</li>';

						endwhile;
						echo '</ul>';
					}
		    echo '</div>'; // close column
				echo '</div>'; // close columns
		  }

			// contact
		  if($layoutType == 'form') {
		    // address
		    $s .= '<div class="contact-info layout-builder">';
		    if(in_array('address', $contactLinks) && ($address != '')){
		      $s .= '<div class="contact add"><span>Address</span>';
		      if($locationicon != ''){
		        $s .= $locationicon;
		      }
		      $s .= $address;

		      if($city != ''){
		        $s .= ', ' . $city;
		      }

		      if($state != ''){
		        $s .= ' ' . $state;
		      }

		      if($zip != ''){
		        $s .= ' ' . $zip;
		      }

		      $s .= '</div>';
		    }

		    // primary phone
		    if(in_array('primaryPhone', $contactLinks) && ($mainphone != '')){
		      $s .= '<div class="contact"><span>Phone</span>';
		      if($phoneicon != ''){
		        $s .= $phoneicon;
		      }
		      $s .= $mainphone;
		      $s .= '</div>';
		    }

		    // primary email
		    if(in_array('primaryEmail', $contactLinks) && ($mainemail != '')){
		      $s .= '<div class="contact"><span>Email</span>';
		      if($emailicon != ''){
		        $s .= $emailicon;
		      }
		      $s .= '<a href="'.$mainemail.'" title="Email Us">'.$mainemail.'</a>';
		      $s .= '</div>';
		    }

		    // fax
		    if(in_array('fax', $contactLinks) && ($mainfax != '')){
		      $s .= '<div class="contact"><span>Fax</span>';
		      if($phoneicon != ''){
		        $s .= $phoneicon;
		      }
		      $s .= 'fax: ' . $supportemail;
		      $s .= '</div>';
		    }
		    $s .= '</div>';


		    //
		    echo '<section class="contact-section">';
		    echo '<div class="columns main-columns is-mobile is-multiline">'; // open column
		    if($contactCol != 'yes'){

		      echo '<div class="column is-12">';
		      if($contactTitle != ''){
		        echo '<h2>'.$contactTitle.'</h2>';
		      }
		      echo $contactCont;

		      if($contactSC != ''){
		        echo do_shortcode($contactSC);
		      }

		      echo '</div>';
		    } else {
		      echo '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
		      if($contactTitle != ''){
		        echo '<h2>'.$contactTitle.'</h2>';
		      }
		      echo $contactCont;

		      if($contactSC != ''){
		        echo do_shortcode($contactSC);
		      }
		      echo '</div>';
		      echo '<div class="column is-12-mobile is-12-tablet is-4-desktop is-4-widescreen">';
		      echo $s;
		      echo '</div>';
		    }
		    echo '</div>';
		    echo '</section>';
		  }

			// gallery
		  if($layoutType == 'gallery') {
		    echo '<div class="columns is-mobile is-multiline gal-columns layout-builder '.$columnAlignment.'">'; // open column
		    if($columnAlignment == 'leftAlign'){
		      echo '<div class="column is-12">';
		      echo $sectionContent;
		      $images = get_sub_field('gallery');
		      if( $images ){
		        echo '<ul class="gal">';
		        foreach( $images as $image ):
		          $link = $image['url'];
		          $imageszd = $image['sizes']['medium'];
		          $imageALT = $link['caption'];

		          echo '
		          <li>
		            <a href="'.$link.'" data-fancybox="gallery" data-caption="'.$image['alt'].'">
		              <img src="'.$imageszd.'" alt="'.$image['alt'].'" />
		            </a>
		          </li>
		          ';
		        endforeach;
		        echo '</ul>';
		      }

		      echo '</div>';
		    }

		    if($columnAlignment == 'centerAlign'){
		      echo '<div class="column is-1">&nbsp;</div>';
		      echo '<div class="column is-10">';
		      echo $sectionContent;
					echo $sectionContent;
		      echo '</div>';
		      echo '<div class="column is-1">&nbsp;</div>';

		      echo '<div class="column is-12">';
		      $images = get_sub_field('gallery');
		      if( $images ){
		        echo '<ul class="gal">';
		        foreach( $images as $image ):
		          $link = $image['url'];
		          $image = $image['sizes']['medium'];
		          $imageALT = $image['alt'];

		          echo '
		          <li>
		            <a data-fancybox href="'.$link.'" title="'.$imageALT.'">
		              <img src="'.$image.'" alt="'.$imageALT.'" />
		            </a>
		          </li>
		          ';
		        endforeach;
		        echo '</ul>';
		      }
		      echo '</div>';
		    }

		    if($columnAlignment == 'rightAlign'){
		      echo '<div class="column is-12">';
		      echo $sectionContent;
		      $images = get_sub_field('gallery');
		      if( $images ){
		        echo '<ul class="gal">';
		        foreach( $images as $image ):
		          $link = $image['url'];
		          $image = $image['sizes']['medium'];
		          $imageALT = $image['alt'];

		          echo '
		          <li>
		            <a data-fancybox href="'.$link.'" title="'.$imageALT.'">
		              <img src="'.$image.'" alt="'.$imageALT.'" />
		            </a>
		          </li>
		          ';
		        endforeach;
		        echo '</ul>';
		      }
		      echo '</div>';
		    }
		    echo '</div>'; // close column
		  }

		  //three-quarter
			if(($layoutType == 'three-quarter-right') || ($layoutType == 'three-quarter-left')){
				if($layoutType == 'three-quarter-right'){
					$align = 'leftalign';
				} else {
					$align = 'rightalign';
				}
				echo '<section class="threequarter layout-builder '.$align.'">';
				echo '<div class="columns is-multiline is-mobile">'; // open column
		    echo '<div class="column is-12-mobile is-12-tablet is-7-desktop is-7-widescreen">';
		    echo $sectionContent1;
	      if(get_sub_field('column_buttons_1')):
	        echo '<div class="button-block">';
	        while(the_repeater_field('column_buttons_1')):
						$button 	= get_sub_field('button');
						$butType 	= get_sub_field('button_type');
		        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
	        endwhile;
	        echo '</div>';
	      endif;
		    echo '</div>';

	      echo '<div class="column is-12-tablet is-12-tablet is-5-desktop is-5-desktop">';
				if($addMediaCol1 == 'ytVideo'){
					echo '
						<a data-fancybox href="'.$video_url1.'" title="Click to Watch">
							<div class="media-asset">
								<div class="video"><img src="'.$video_thumb_url1.'"></div>
							</div>
						</a>
					';
				} elseif($addMediaCol1 == 'image'){
					// borderless or bordered image
					echo '<div class="media-asset '.$column1ImageType.'">';
					echo '<img src="'.$columnImage1['url'].'" alt="'.$columnImage1['title'].'">';
					if($columnImage1['caption']){
						echo '<figcaption class="caption">'.$columnImage1['caption'].'</figcaption>';
					}
					echo '</div>';
					// close media
				}
		    echo '</div>'; // close column
				echo '</div>';
				echo '</section>';
		  }

		  //faqs
		  if($layoutType == 'faqs'){
		    if(get_sub_field('faq_section')):
		      echo '<section class="faq-layout layout-builder">';
		      echo '<div class="columns is-multiline is-mobile">';
					while(the_repeater_field('faq_section')):
						echo '<div class="faq-block">';
						$sectionTitle = get_sub_field('faq_section_title');
		        // faqs within section
		        echo '<div class="column is-12">';
		        echo '<div class="faq-section-title">'.$sectionTitle.'</div>';
		        if(get_sub_field('faqs')):
		          while(the_repeater_field('faqs')):
		            $faqTitle = get_sub_field('faq_title');
		            $faqCont  = get_sub_field('faq_content');
		            //
		            echo '<div class="toggle">';
		            echo '<div class="toggle-title">';
		            echo '<div class="title">';
		            echo '<i></i>';
		            echo '<span class="title-name">'.$faqTitle.'</span>';
		            echo '</div>';
		            echo '</div>';
		            echo '<div class="toggle-inner">';
		            echo $faqCont;
		            echo '</div>';
		            echo '</div>';
		          endwhile;
		        endif;
		        echo '</div>';
		      endwhile;
		      echo '</div>';
		      echo '</section>';
		    endif;
		  }


			// call-out block
		  if($layoutType == 'callOutBlock') {
				$bgImage = get_sub_field('background_image');
				if($bgImage != ''){
					$backgroundImage .= 'style="background: url('.$bgImage['url'].')";';
				}
				echo '<section class="callOut layoutbuilder" '.$backgroundImage.'>';
		    echo '<div class="columns '.$sectionAlignment.' layout-builder is-multiline is-mobile">'; // open column
				//echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
				echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
				echo '<div class="cont">';
				echo $sectionContent1;
		    if(get_sub_field('column_buttons_1')):
		      echo '<div class="button-block">';
		      while(the_repeater_field('column_buttons_1')):
		        $button 	= get_sub_field('button');
						$butType 	= get_sub_field('button_type');
		        echo '<a class="btn '.$butType.'" href="'.$button['url'].'" title="'.$button['title'].'" target="'.$button['target'].'">'.$button['title'].$afterLinkIcon.'</a>';
		      endwhile;
		      echo '</div>';
		    endif;
				echo '</div>';
				echo '</div>';
		    echo '</div>'; // close column
				echo '<div class="shade"></div>';
				echo '</section>';
		  }
		  // end section types

			// callOutShapes
		  if($layoutType == 'callOutShapes') {
				$shapePosit = get_sub_field('call_out_shapes_position');
				$shapeColor = get_sub_field('call_out_shapes_colors');
				$shapeType 	= get_sub_field('call_out_shapes_type');
				$callOCont	= get_sub_field('call_out_content');
				$pageCount = 0;
				echo '<section class="callOutShapes layoutbuilder '.$shapePosit.' color-'.$shapeColor.'">';
		    echo '<div class="columns '.$sectionAlignment.' layout-builder is-multiline is-mobile">'; // open column
				echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
				if(get_sub_field('call_out_shapes')):
					echo '<ul class="c-shapes shape-'.$shapeType.'">';
					while ( the_repeater_field('call_out_shapes') ) :
		        $callOut 			= get_sub_field('call_out');
						$pageCount++;
						if($callOut){
							echo '<li class="animated fadeIn _'.$pageCount.'"">';
							echo '<div class="callout-content">'.$callOut.'</div>';
							echo '</li>';
						}
			    endwhile;
					echo '</ul>';
				endif;
				if($callOCont){
					echo '<div class="disclaimer">'.$callOCont.'</div>';
				}
		    echo '</div>'; // close column
				echo '</div>';
				echo '</section>';
		  }
			//


			// testimonial block
		  if($layoutType == 'testimonial') {
				$bgImage 		= get_sub_field('testimonials_background_image');
				$testLink		= get_sub_field('testimonials_link');
				$quoteIcon 	= get_field('quote_open', 'options');
				if($bgImage != ''){
					$backgroundImage .= 'style="background: url('.$bgImage['url'].')";';
				}
				echo '<section class="testimonial-block layoutbuilder" id="testimonials" '.$backgroundImage.'>';
		    echo '<div class="columns '.$sectionAlignment.' layout-builder is-multiline is-mobile">'; // open column
				echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen"></div>';
				echo '<div class="column is-12-mobile is-12-tablet is-10-desktop is-10-widescreen cont">';
				if(get_sub_field('testimonials')):
					echo '<div class="testimonial-slideshow">';
					while ( the_repeater_field('testimonials') ) :
						$testlogo 			= get_sub_field('testimonial_logo');
		        $testcont 			= get_sub_field('testimonial_content');
						$testauth 			= get_sub_field('testimonial_author');
						$testauthtitle 	= get_sub_field('testimonial_author_title');
						$testauthcomp 	= get_sub_field('testimonial_author_company');

						echo '<div class="slide testimonial">';
						//
						if($testlogo != ''){
							echo '
							<div class="testimonial-image">
								<div class="circle">
									<img src="'.$testlogo['url'].'" alt="'.$testauthcomp.'">
								</div>
							</div>';
						}
						//
						echo '<div class="test-content">';
						echo '<div class="icon">'.$quoteIcon.'</div>';
						echo $testcont;
						echo '<hr class="cb">';
						//
						if($testauth){
							echo '<div class="author">';
							echo '<div class="author-title">';
							echo '<span>'.$testauth.'</span>';
							if($testauthtitle){
								echo '<div>, '.$testauthtitle.'</div>';
							}

							if($testauthcomp){
								echo '<div>, '.$testauthcomp.'</div>';
							}
							echo '</div>';
							echo '</div>';
						}
						//
						echo '</div>';
						echo '</div>';
			    endwhile;
					echo '</div>';
				endif;
				if($testLink){
					echo '<div class="button-block">';
					echo '<a class="btn styled" href="'.$testLink['url'].'" title="'.$testLink['title'].'" target="'.$testLink['target'].'">'.$testLink['title'].$afterLinkIcon.'</a>';
					echo '</div>';
				}
		    echo '</div>'; // close column
				echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen"></div>';
				echo '</div>';
				echo '<div class="shade"></div>';
				echo '</section>';
		  }
		  // end section types

    endwhile;
	}
}
add_shortcode('layoutBuilder', 'layoutBuilder_shortcode');
?>
