  <!-- START FOOTER -->
  <section class="bg-footer">
      <div class="container">
          <div class="row">
              <div class="col-md-3 col-6">
                  <div class="footer-item mt-4 mt-lg-0">
                      <p class="fs-16 mb-2"><strong>Jobseekers</strong></p>
                      <ul class="list-unstyled footer-list mb-0">
                          
                          <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#signupModal"><i
                                      class="mdi mdi-plus"></i>&nbsp; Register CV</a></li>
                          <li><a href="<?php echo e(route('jobs')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Explore All Jobs </a>
                          </li>
                          <li><a href="<?php echo e(route('career-tips')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Career Tips </a>
                          </li>
                          <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i
                                      class="mdi mdi-plus"></i>&nbsp; Member
                                  Login</a></li>

                          <li><a href="<?php echo e(route('faq', ['faq' => 'job_seeker'])); ?>"><i class="mdi mdi-plus"></i>&nbsp;
                                  FAQs</a></li>
                      </ul>
                  </div>
              </div>
              <!--end col-->
              <div class="col-md-3 col-6">
                  <div class="footer-item mt-4 mt-lg-0">
                      <p class="fs-16 mb-2"><strong>Employers</strong></p>
                      <ul class="list-unstyled footer-list mb-0">
                          <li><a href="<?php echo e(route('employers.postAJob')); ?>"
                                  <?php if(!request()->routeIs('employers.*')): ?> target="_blank" <?php endif; ?>><i
                                      class="mdi mdi-plus"></i>&nbsp; Post A
                                  Job</a></li>
                          
                          <li><a href="<?php echo e(route('advertise.banner-job')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Advertise
                                  Plan</a>
                          </li>
                          <li><a href="<?php echo e(route('employers.jobs.index')); ?>"
                                  <?php if(!request()->routeIs('employers.*')): ?> target="_blank" <?php endif; ?>><i
                                      class="mdi mdi-plus"></i>&nbsp; View All
                                  Jobs</a></li>
                          <li><a href="<?php echo e(route('faq', ['faq' => 'employer'])); ?>"><i class="mdi mdi-plus"></i>&nbsp;
                                  FAQs</a></li>
                      </ul>
                  </div>
              </div>
              <!--end col-->
              <div class="col-md-3 col-6">
                  <div class="footer-item mt-4 mt-lg-0">
                      <p class="fs-16 mb-2"><strong>More From Mega Job</strong></p>
                      <ul class="list-unstyled footer-list mb-0">
                          <li><a href="<?php echo e(route('about')); ?>"><i class="mdi mdi-plus"></i>&nbsp; About Us</a></li>
                          <li><a href="<?php echo e(route('faq')); ?>"><i class="mdi mdi-plus"></i>&nbsp;
                                  FAQs</a></li>
                          <li><a href="<?php echo e(route('blog')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Our Blogs</a></li>
                          <li><a href="<?php echo e(route('newsAndAnnouncement')); ?>"><i class="mdi mdi-plus"></i>&nbsp; News And
                                  Announcement</a></li>
                          <li><a href="<?php echo e(route('contact')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Contact Us</a></li>
                          
                          </li>
                      </ul>
                  </div>
              </div>
              <!--end col-->
              <div class="col-md-3 col-6">
                  <div class="footer-item mt-4 mt-lg-0">
                      <p class="fs-16 mb-2"><strong>Support</strong></p>
                      <ul class="list-unstyled footer-list mb-0">
                          <li><a href="<?php echo e(route('terms')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Terms & Conditions</a>
                          </li>
                          <li><a href="<?php echo e(route('privacy')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Privacy Policy</a>
                          </li>
                          <li><a href="<?php echo e(route('reportIssue')); ?>"><i class="mdi mdi-plus"></i>&nbsp; Report Issue</a>
                          </li>
                          </li>
                          
                          
                      </ul>
                  </div>
              </div>
              <!--end col-->
          </div>
          <div class="row">
              <div class="col-md-4 col-lg-3 order-lg-first order-md-last tab-only-none">
                  <div class="footer-bottom bottom-padding-right">
                      <h4 class="connect-title-us"><span>Connect With Us</span></h4>
                      <ul class="footer-contact footer-social-menu list-inline">
                          <li class="list-inline-item facebook"><a
                                  href="<?php echo e(isset($setting->facebook_url) ? $setting->facebook_url : ''); ?>"><i
                                      class="uil uil-facebook-f"></i></a>
                          </li>
                          <li class="list-inline-item linkedin"><a
                                  href="<?php echo e(isset($setting->linkedin_url) ? $setting->linkedin_url : ''); ?>"><i
                                      class="uil uil-linkedin"></i></a>
                          </li>
                          <li class="list-inline-item instagram"><a
                                  href="<?php echo e(isset($setting->instagram_url) ? $setting->instagram_url : ''); ?>"><i
                                      class="uil uil-instagram"></i></a>
                          </li>
                          <li class="list-inline-item twitter"><a
                                  href="<?php echo e(isset($setting->twitter_url) ? $setting->twitter_url : ''); ?>"><i
                                      class="uil uil-twitter"></i></a>
                          </li>
                      </ul>
                  </div>
              </div>


              <div class="col-lg-9">
                  <div class="footer-bottom">
                      <h4><span>Reach Us</span></h4>
                      <ul class="footer-contact">
                          <li>
                              <div class="i-box">
                                  <i class="fa fa-phone"></i>
                              </div>
                              <div class="c-box">
                                  <p>Call Us Now</p>
                                  <a
                                      href="tel:<?php echo e(isset($setting->phone) ? $setting->phone : ''); ?>"><?php echo e(isset($setting->phone) ? $setting->phone : ''); ?></a>
                                  <a
                                      href="tel:<?php echo e(isset($setting->mobile) ? $setting->mobile : ''); ?>"><?php echo e(isset($setting->mobile) ? $setting->mobile : ''); ?></a>
                              </div>
                          </li>
                          <li>
                              <div class="i-box">
                                  <i class="fa fa-envelope"></i>
                              </div>
                              <div class="c-box">
                                  <p>Send Us An Email</p>
                                  <a href="mailto:<?php echo e(isset($setting->site_email) ? $setting->site_email : ''); ?>"
                                      target="_blank">
                                      <?php echo e(isset($setting->site_email) ? $setting->site_email : ''); ?>

                                  </a>
                              </div>
                          </li>
                          <li>
                              <div class="i-box">
                                  <i class="fa fa-map-marker"></i>
                              </div>
                              <div class="c-box">
                                  <p>Visit Our Offices</p>
                                  <a href="<?php echo e(route('contact')); ?>"
                                      target="_blank"><?php echo e(isset($setting->address) ? $setting->address : ''); ?></a>
                              </div>
                          </li>
                      </ul>
                  </div>
                  <!--end col-->
              </div>
          </div>
          <!--end container-->
  </section>
  <!-- END FOOTER -->

  <!-- START FOOTER-ALT -->
  <div class="footer-alt">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <p class="text-center mb-0">
                      <script>
                          document.write(new Date().getFullYear())
                      </script> &copy; All Rights Reserved
                      <?php echo e(isset($setting) ? $setting->site_title : ''); ?>

                  </p>
              </div>
              <!--end col-->
          </div>
      </div>
      <!--end container-->
  </div>
  <!-- END FOOTER -->


  <?php if(!auth()->check()): ?>
      <div class="footer-fixed">
          <div class="auto-container">
              <div class="flex-container">
                  <div class="footer-fixed-info">
                      Get Job Today :
                  </div>
                  <div class="user-button">
                      <a href="javascript:void(0)" class="btn btn-primary position-relative" data-bs-toggle="modal"
                          data-bs-target="#loginModal"><i class="fa fa-user"></i>&nbsp;&nbsp;<span>Sign
                              In</span></a>
                      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#signupModal"
                          class="btn btn btn-outline-danger position-relative"><i
                              class="mdi mdi-login"></i>&nbsp;&nbsp;<span>Register CV</span> </a>
                  </div>
                  <div class="employer-zone">
                      <a href="<?php echo e(route('employers.index')); ?>">

                          <span class="monitor-icon">
                              <i class="fa-solid fa-desktop"></i>
                          </span>
                          Employeer Zone
                      </a>
                  </div>
              </div>

          </div>
      </div>
  <?php endif; ?>
<?php /**PATH /home/megajobn/public_html/resources/views/user/layout/footer.blade.php ENDPATH**/ ?>