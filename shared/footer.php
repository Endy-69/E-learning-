<button class="btn btn-lg btn-info btn-rounded position-fixed d-none" onclick="scrollToTop()" id="back-to-up" style="bottom: 25px; right: 25px; height: 45px; z-index: 1;">
  <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
</button>

<footer class=" mainfooter" role="contentinfo" style="padding-top: 30px; margin-top: 60px; background-color: rgb(207, 224, 235);" >

    <!--  -->
    <div class="footer-middle">
      <div class="container-fluid main-footer">
        <div class="row footer-first">
          <div class="col-md-4 col-sm-12 col-xs-12">
            <!--Column1-->
            <div class="">
              <h3 class="font-weight-bold">Mekdela Amba  University</h3>
              <hr style="background-color: green; height: 2px;">
              <p style="font-size: 15px; text-align: justify;">
                <b>Mekdela Amba  University</b> is one of the comprehensive universities has two sub campus(TuluAwlia and Mekaneselam) launched at a historically 
				valuable town – Mekdela Amba . This town is one of the ancient towns of Ethiopia which is located at
				 the foot of Mount Mekdela. MekdelaAmba is the third highest mountain called “the water tower of Ethiopia” 
				 whose wet breathing helped the town much to take advantage point in keeping its surrounding conducive 
				 to live in.
              </p>
            </div>
          </div>
          <!-- Our services -->
          <div class="col-md-4 col-sm-6 col-xs-6">
            <!--Column1-->
            <div class="useful-links" >
              <h4 class="text-center font-weight-bold">Useful Links</h4>
              <hr style=" height: 2px; background-color: yellow;">
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="font-weight-bold" style="padding-left: 40px;">Academics</h3>
                  <ul style="list-style: none; color: red;">
				  	<li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/our-history/#">
						Colleges
                      </a>
                    </li>
					<li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/our-history/#">
						Technology Faculty
                      </a>
                    </li>
					<li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/our-history/#">
						Schools
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <h3 class="font-weight-bold" style="padding-left: 40px;">Services</h3>
                  <ul style="list-style: none;">
				  <li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/our-history/#">
						Events
                      </a>
                    </li>                    
					<li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/registrar/">
						Registrar
                      </a>
                    </li>
					<li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/library/">
						Library
                      </a>
                    </li>
					<li class="nav-item nav-foot">
                      <a style="background-color: transparent;" href="https://mkau.edu.et/our-history/#">
						Administration
                      </a>
                    </li>		
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- map -->
          <div class="col-md-4 col-sm-6 col-xs-6">
            <!--more for helpers-->
            <h3 class="font-weight-bold">Find Out Our Location</h3>
            <hr style=" height: 2px; background-color: rgb(247, 97, 97);" />
             
            <!-- place_id:ChIJ72lzjsOaSxYRkquYdntV-wk -->
          </div>
        </div>
      </div>
    </div>
    <!-- Fotter bottom {{curYear}} -->
    <div class="container-fluid" style="background-color: #4e4c4c; margin-top: 12px; padding: 10px;">
      <p class="text-center" style="font-size: 16px; font-family: cursive; color: white">Copyright
        <i class="fa fa-copyright" style="margin: 3px; padding-top: -30px;"></i> 2015/2023,
          By Mekdela Amba  University. All Rights Reserved.</p>
    </div>
  </footer>
  <script>
    window.onscroll = () => {
      toggleTopButton();
    }
    function scrollToTop(){
      window.scrollTo({top: 0, behavior: 'smooth'});
    }

    function toggleTopButton() {
      if (document.body.scrollTop > 20 ||document.documentElement.scrollTop > 20) {
        document.getElementById('back-to-up').classList.remove('d-none');
      } else {
        document.getElementById('back-to-up').classList.add('d-none');
      }
    } 
  </script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script> 
  <script src="../js/popper.js"></script> 
  <script src="../js/owl.carousel.min.js"></script>  