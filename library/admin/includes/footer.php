   <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   Online Library Management System | ARD 
                <li> <i class="icon-calendar"></i>
								<?php
								$Today = date('y:m:d',time());
								$new = date('l, F d, Y', strtotime($Today));
								echo $new;
                                ?>
                                </li>
                   
                </div>

            </div>
        </div>
    </section>