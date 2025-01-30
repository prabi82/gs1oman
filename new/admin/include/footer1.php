 <footer id="footer" class="footer bg-black-111">

	    <div class="container pt-70 pb-40">

	      <div class="row border-bottom-black">

	        <div class="col-sm-6 col-md-3">

	          <div class="widget dark">
                 
                 <a href="<?= $base_url; ?>"><img src="<?= $base_url; ?><?php echo $website_setting['logo'] ?>" alt="" class="mt-10 mb-20" /></a>
	            <!--<img class="mt-10 mb-20" alt="" src="images/logo-wide1.png">--->

	            <p>Lorem ipsum dolor adipisicing amet, consectetur sit elit. Aspernatur incidihil quo officia.</p>

	            <ul class="list-inline mt-5">

	              <li class="m-0 pl-10 pr-10"> <i class="fa fa-map-marker text-theme-colored mr-5"></i> <a class="text-gray" href="#">203, Lorem ipsum dolor adipisicing</a> </li>

	              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored mr-5"></i>
	              <a href="tel:<?php echo  $website_setting['mobile_number'] ?>" class="text-gray"><?php echo  $website_setting['mobile_number'] ?></a> </li>

	              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored mr-5"></i> 
	              	<a href="mailto:<?php echo  $website_setting['website_email_id'] ?>" class="text-gray"><?php echo  $website_setting['website_email_id'] ?></a>
	              	<!--<a class="text-gray" href="#">contact@yourdomain.com</a>---> </li>

	              <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-colored mr-5"></i> <a class="text-gray" href="#">www.yourdomain.com</a> </li>

	            </ul>

	          </div>

	        </div>

	        <div class="col-sm-6 col-md-3">

	          <div class="widget dark">

	            <h5 class="widget-title line-bottom">Useful Links</h5>

	            <ul class="list-border">

	              <li><a href="index.php" style="color: #000 !important;">Home</a></li>

	              <li><a href="about.php" style="color: #000 !important;">About us</a></li>

	              <li><a href="contact.php" style="color: #000 !important;">Contact</a></li>

	            </ul>

	          </div>

	          

	        </div>

	        <div class="col-sm-6 col-md-3">

	          <div class="widget dark">

	            <h5 class="widget-title line-bottom">Call Us Now</h5>

	            <div class="text-gray">

	              +61 3 1234 5678 <br>

	              +12 3 1234 5678

	            </div>

	          </div>

	        </div>

	        <div class="col-sm-6 col-md-3">

	          <div class="widget dark">

	            <h5 class="widget-title line-bottom">Opening Hours</h5>

	            <div class="opening-hours">

	              <ul class="list-border">

	                <li class="clearfix"> <span> Mon - Tues :  </span>

	                  <div class="value pull-right flip"> 6.00 am - 10.00 pm </div>

	                </li>

	                <li class="clearfix text-white"> <span> Wednes - Thurs :</span>

	                  <div class="value pull-right flip"> 8.00 am - 6.00 pm </div>

	                </li>

	                <li class="clearfix"> <span> Fri : </span>

	                  <div class="value pull-right flip"> 3.00 pm - 8.00 pm </div>

	                </li>

	                <li class="clearfix"> <span> Sun : </span>

	                  <div class="value pull-right flip"> Closed </div>

	                </li>

	                <li class="clearfix"> <span> Sat : </span>

	                  <div class="value pull-right flip"> 10.00 am - 2.00 pm </div>

	                </li>

	              </ul>

	            </div>

	          </div>

	          

	        </div>

	      </div>

	    </div>

	    <div class="footer-bottom bg-black-222">

	      <div class="container pt-10 pb-0">

	        <div class="row">

	          <div class="col-md-6 sm-text-center">

	            <p class="font-13 text-black-777 m-0">Copyright &copy;2021 Artistic Yoga. All Rights Reserved & Design by <a href="https://websutility.com/">websutility.com</a></p>

	          </div>

	          <div class="col-md-6 text-right flip sm-text-center">

	            <div class="widget no-border m-0">

	              <ul class="styled-icons icon-dark icon-circled icon-sm">

	                <li><a href="<?php echo  $website_setting['facebook_url'] ?>">
	                	<i class="fa fa-facebook"></i></a></li>

	                <li><a href="<?php echo  $website_setting['twitter_url'] ?>"><i class="fa fa-twitter"></i></a></li>

	                <li><a href="#"><i class="fa fa-instagram"></i></a></li>

	              

	              </ul>

	            </div>

	          </div>

	        </div>

	      </div>

	    </div>

  </footer>


  <script type="text/javascript">
          var tpj=jQuery;         
          var revapi34;
          tpj(document).ready(function() {
            if(tpj("#rev_slider_home").revolution == undefined){
              revslider_showDoubleJqueryError("#rev_slider_home");
            }else{
              revapi34 = tpj("#rev_slider_home").show().revolution({
                sliderType:"standard",
                jsFileLocation:"js/revolution-slider/js/",
                sliderLayout:"fullwidth",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                  keyboardNavigation:"on",
                  keyboard_direction: "horizontal",
                  mouseScrollNavigation:"off",
                  onHoverStop:"on",
                  touch:{
                    touchenabled:"on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                  }
                  ,
                  arrows: {
                    style:"zeus",
                    enable:true,
                    hide_onmobile:true,
                    hide_under:600,
                    hide_onleave:true,
                    hide_delay:200,
                    hide_delay_mobile:1200,
                    tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                    left: {
                      h_align:"left",
                      v_align:"center",
                      h_offset:30,
                      v_offset:0
                    },
                    right: {
                      h_align:"right",
                      v_align:"center",
                      h_offset:30,
                      v_offset:0
                    }
                  },
                  bullets: {
                    enable:true,
                    hide_onmobile:true,
                    hide_under:600,
                    style:"metis",
                    hide_onleave:true,
                    hide_delay:200,
                    hide_delay_mobile:1200,
                    direction:"horizontal",
                    h_align:"center",
                    v_align:"bottom",
                    h_offset:0,
                    v_offset:30,
                    space:5,
                    tmp:'<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
                  }
                },
                viewPort: {
                  enable:true,
                  outof:"pause",
                  visible_area:"80%"
                },
                responsiveLevels:[1240,1024,778,480],
                gridwidth:[1240,1024,778,480],
                gridheight:[600,550,500,450],
                lazyType:"none",
                parallax: {
                  type:"scroll",
                  origo:"enterpoint",
                  speed:400,
                  levels:[5,10,15,20,25,30,35,40,45,50],
                },
                shadow:0,
                spinner:"off",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                shuffle:"off",
                autoHeight:"off",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                  simplifyAll:"off",
                  nextSlideOnWindowFocus:"off",
                  disableFocusListener:false,
                }
              });
            }
          }); /*ready*/
        </script>