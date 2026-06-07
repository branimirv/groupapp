<?php
/**
 * The template for displaying all single posts
 * Template Name: singl blog
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GroupApp
 */

get_header();
?>
<section class="section-page-tup ">
    <div class="container">
        <div class="row">
		<?php if(have_posts()){while(have_posts( )){
          the_post();?>
          <div class="col-12">
            <p class="info">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M7.99935 13.3332H13.9993M10.9167 2.41449C11.1821 2.1491 11.542 2 11.9173 2C12.2927 2 12.6526 2.1491 12.918 2.41449C13.1834 2.67988 13.3325 3.03983 13.3325 3.41516C13.3325 3.79048 13.1834 4.15043 12.918 4.41582L4.91133 12.4232C4.75273 12.5818 4.55668 12.6978 4.34133 12.7605L2.42667 13.3192C2.3693 13.3359 2.30849 13.3369 2.25061 13.3221C2.19272 13.3072 2.13988 13.2771 2.09763 13.2349C2.05538 13.1926 2.02526 13.1398 2.01043 13.0819C1.9956 13.024 1.9966 12.9632 2.01333 12.9058L2.572 10.9912C2.63481 10.776 2.75083 10.5802 2.90933 10.4218L10.9167 2.41449Z" stroke="#5B5C65" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
              <?php the_author(); ?> <span><?php the_date(); ?></span></p>
          </div>
            <div class="col">
                <div class="pos">
                  <p class="t1"><?php the_title();?></p>
				  <?php the_content();?>



                </div>
            </div>
			<?}    
                
			}?>
        </div>
    </div>

</section>
<section class="section-create-txt section-txt-singl-block ">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="block-txt-g-c">
          <p class="t-b">Create your free account</p>
          <p class="t-st">Join 527+ creators and bring your courses and community together!</p>
        
            <div class="block-center">
              <div class="block-gradient">
              <a href="https://my.group.app/signup?utm_content=173ea782-3575-4aa8-95f6-eab702aeff2c">
                <div class="txt">
                  <b class="t-gradient">Try GroupApp for free</b>
                </div>
                </a>
              </div>
            </div>
        
          <p class="t-st font">No credit card required</p>
        </div>
      </div>
    </div>
  </div>
</section>


<?php

get_footer();
