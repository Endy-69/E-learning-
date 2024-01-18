<div class="center">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table">
                <tr bgcolor="#ecf9f2">
                    <td bgcolor="#ecf9f2">
                        <script language="JavaScript">
                            if (document.all || document.getElementById)
                                document.write('<span id="worldclock" style="font:bold 25px Arial;"></span><br>')

                            zone = 0;
                            isitlocal = true;
                            ampm = '';

                            function updateclock(z) {
                                zone = z.options[z.selectedIndex].value;
                                isitlocal = (z.options[0].selected) ? true : false;
                            }

                            function WorldClock() {
                                now = new Date();
                                ofst = now.getTimezoneOffset() / 60;
                                secs = now.getSeconds();
                                sec = -1.57 + Math.PI * secs / 30;
                                mins = now.getMinutes();
                                min = -1.57 + Math.PI * mins / 30;
                                hr = (isitlocal) ? now.getHours() : (now.getHours() + parseInt(ofst)) + parseInt(zone);
                                hrs = -1.575 + Math.PI * hr / 6 + Math.PI * parseInt(now.getMinutes()) / 360;
                                if (hr < 0)
                                    hr += 24;
                                if (hr > 23)
                                    hr -= 24;
                                ampm = (hr > 11) ? "PM" : "AM";
                                statusampm = ampm.toLowerCase();

                                hr2 = hr;
                                if (hr2 == 0)
                                    hr2 = 12;
                                (hr2 < 13) ? hr2 : hr2 %= 12;
                                if (hr2 < 10)
                                    hr2 = "0" + hr2

                                var finaltime = hr2 + ':' + ((mins < 10) ? "0" + mins : mins) + ':' + ((secs < 10) ? "0" + secs : secs) + ' ' + statusampm;
                                if (document.all)
                                    worldclock.innerHTML = finaltime
                                else if (document.getElementById)
                                    document.getElementById("worldclock").innerHTML = finaltime
                                else if (document.layers) {
                                    document.worldclockns.document.worldclockns2.document.write(finaltime)
                                    document.worldclockns.document.worldclockns2.document.close()
                                }


                                setTimeout('WorldClock()', 1000);
                            }

                            window.onload = WorldClock
                        </script>

                    </td>
                </tr>
            </table>
        </div>
    </div> 
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr bgcolor="#ecf9f2">
                        <td bgcolor="#ecf9f2">
                            <script LANGUAGE="JavaScript">
                                monthnames = new Array("January", "Februrary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Decemeber");
                                var linkcount = 0;
                                function addlink(month, day, href) {
                                    var entry = new Array(3);
                                    entry[0] = month;
                                    entry[1] = day;
                                    entry[2] = href;
                                    this[linkcount++] = entry;
                                }
                                Array.prototype.addlink = addlink;
                                linkdays = new Array();
                                monthdays = new Array(12);
                                monthdays[0] = 31;
                                monthdays[1] = 28;
                                monthdays[2] = 31;
                                monthdays[3] = 30;
                                monthdays[4] = 31;
                                monthdays[5] = 30;
                                monthdays[6] = 31;
                                monthdays[7] = 31;
                                monthdays[8] = 30;
                                monthdays[9] = 31;
                                monthdays[10] = 30;
                                monthdays[11] = 31;
                                todayDate = new Date();
                                thisday = todayDate.getDay();
                                thismonth = todayDate.getMonth();
                                thisdate = todayDate.getDate();
                                thisyear = todayDate.getYear();
                                thisyear = thisyear % 100;
                                thisyear = ((thisyear < 50) ? (2000 + thisyear) : (1900 + thisyear));
                                if (((thisyear % 4 == 0)
                                        && !(thisyear % 100 == 0))
                                        || (thisyear % 400 == 0))
                                    monthdays[1]++;
                                startspaces = thisdate;
                                while (startspaces > 7)
                                    startspaces -= 7;
                                startspaces = thisday - startspaces + 1;
                                if (startspaces < 0)
                                    startspaces += 7;
                                document.write("<table class=\"table\" border=2 bgcolor=ddeeaa ");
                                document.write("bordercolor=black><font color=red>");
                                document.write("<tr><td colspan=7><center><strong>"
                                        + monthnames[thismonth] + " " + thisyear
                                        + "</strong></center></font></td></tr>");
                                document.write("<tr>");
                                document.write("<td align=center>Su</td>");
                                document.write("<td align=center>M</td>");
                                document.write("<td align=center>Tu</td>");
                                document.write("<td align=center>W</td>");
                                document.write("<td align=center>Th</td>");
                                document.write("<td align=center>F</td>");
                                document.write("<td align=center>Sa</td>");
                                document.write("</tr>");
                                document.write("<tr>");
                                for (s = 0; s < startspaces; s++) {
                                    document.write("<td> </td>");
                                }
                                count = 1;
                                while (count <= monthdays[thismonth]) {
                                    for (b = startspaces; b < 7; b++) {
                                        linktrue = false;
                                        document.write("<td>");
                                        for (c = 0; c < linkdays.length; c++) {
                                            if (linkdays[c] != null) {
                                                if ((linkdays[c][0] == thismonth + 1) && (linkdays[c][1] == count)) {
                                                    document.write("<a href=\"" + linkdays[c][2] + "\">");
                                                    linktrue = true;
                                                }
                                            }
                                        }
                                        if (count == thisdate) {
                                            document.write("<font color='FF0000'><strong>");
                                        }
                                        if (count <= monthdays[thismonth]) {
                                            document.write(count);
                                        } else {
                                            document.write(" ");
                                        }
                                        if (count == thisdate) {
                                            document.write("</strong></font>");
                                        }
                                        if (linktrue)
                                            document.write("</a>");
                                        document.write("</td>");
                                        count++;
                                    }
                                    document.write("</tr>");
                                    document.write("<tr>");
                                    startspaces = 0;
                                }
                                document.write("</table></p>");
                            </script>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

                