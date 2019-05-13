   <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   Online Library Management System | ARD 
                    <li>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                        
                        <script language="javascript" type="text/javascript">

                                //<!-- Begin
                                var timerID = null;
                                var timerRunning = false;
                                function stopclock (){
                                if(timerRunning)
                                clearTimeout(timerID);
                                timerRunning = false;
                                }
                                function showtime () {
                                var now = new Date();
                                var hours = now.getHours();
                                var minutes = now.getMinutes();
                                var seconds = now.getSeconds()
                                var timeValue = "" + ((hours >12) ? hours -12 :hours)
                                if (timeValue == "0") timeValue = 12;
                                timeValue += ((minutes < 10) ? ":0" : ":") + minutes
                                timeValue += ((seconds < 10) ? ":0" : ":") + seconds
                                timeValue += (hours >= 12) ? " P.M." : " A.M."
                                document.clock.face.value = timeValue;
                                timerID = setTimeout("showtime()",1000);
                                timerRunning = true;
                                }
                                function startclock() {
                                stopclock();
                                showtime();
                                }
                                window.onload=startclock;
                                // End -->
                            
                        </script>
                       
                    </li>
                    <form name="clock">
                    <td>
                    <tr><input style="width:100px;" id="focusedInput" class="input-xlarge focused" name="face" value="" disabled></tr>
                    </td>
			
			         </form>
                    
                </div>

            </div>
        </div>
    </section>