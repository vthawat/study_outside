<title>บันทึกข้อความ การขอใช้รถ</title>
<style>
@page
	{
		margin-top: 2.5cm;
		margin-left: 2.5cm;
		margin-right: 2cm;
        margin-bottom: 2cm;
	}

    p.normal{
        font-size:15pt;
    }
    body{
        font-size:15pt;
    }

    .head-title{
        font-size:29pt;
        font-weight:bold;
       position:fixed;
       padding-left:240px;
        margin-top:-60px;

    }
    hr.head-line{
        color:black;
        margin-top:-20px;
    }
    .sec-1{
        margin-top:-10px;
        line-height:1;
    }
    .sec-2{
        margin-top:-10px;
        line-height:1.15;
    }
</style>
<body>
<p><img src="<?=realpath('images/logo-psu.jpg')?>"><div class="head-title">บันทึกข้อความ</div></p>
<p class="sec-1"><b>ส่วนงาน</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คณะทรัพยากรธรรมชาติ&nbsp;&nbsp;&nbsp;&nbsp;ภาควิชาพัฒนาการเกษตร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โทร 6121, 6122<br>
มอ 520/{booking_num}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่</b>&nbsp;&nbsp;{booking_date}<br>
<b>เรื่อง</b>&nbsp;{booking_title}</p>
<hr class="head-line">
<p class="sec-1"><b>เรียน</b>&nbsp;{booking_reference}</p>
<p class="sec-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย{booking_objective}&nbsp;มีความประสงค์จะเดินทางไปปฏิบัติงานที่{booking_go_place}&nbsp;โดยมีวัตถุประสงค์เพื่อ (กรณีเดินทางเพื่อปฏิบัติงานในโครงการวิจัยให้ระบุ
ชื่อโครงการวิจัยด้วย)&nbsp;{booking_research_name}&nbsp;จึงใคร่ขออนุมัติใช้รถและเดินทางไปปฏิบัติงาน/
ปฏิบัติงานนอกเวลา เพื่อปฏิบัติงานดังกล่าว โดยให้รถรับ&nbsp;{booking_depart_place}&nbsp;ในวันที่&nbsp;{booking_depart_date}&nbsp;เวลา&nbsp;{booking_depart_time}&nbsp;น.&nbsp;กลับถึงคณะฯ&nbsp;ในวันที่&nbsp;{booking_arrive_date}&nbsp;เวลา&nbsp;{booking_depart_time}&nbsp;น.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{booking_get_money1}]&nbsp;ไม่ขอเบิกค่าใช้จ่าย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{booking_get_money2}]&nbsp;ขอเบิกค่าใช้จ่ายต่าง ๆ ดังนี้<br>
<u>หมวดค่าใช้สอย</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>หมวดค่าวัสดุและค่าตอบแทน</u><br>
1.&nbsp;ค่าวัสดุน้ำมันเชื้อเพลิง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{item_money_type1_1}&nbsp;บาท&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;ค่าวัสดุน้ำมันเชื้อเพลิง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{item_money_type1_1}&nbsp;บาท<br>
2.&nbsp;ค่าเบี้ยเลี้ยง&nbsp;{item_money_type1_2_duration}&nbsp;{item_money_type1_2_duration}&nbsp;บาท&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;ค่าล่วงเวลา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{item_money_type2_2}&nbsp;บาท<br>
3.&nbsp;ค่าที่พัก&nbsp;{item_money_type1_3_duration}&nbsp;{item_money_type1_3}&nbsp;บาท&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;ค่าสมนาคุณพนักงานขับรถ&nbsp;{item_money_type2_3_person}&nbsp;&nbsp;{item_money_type2_3}&nbsp;บาท<br>
4.&nbsp;ค่าใช้จ่ายอื่น ๆ&nbsp;{item_money_type1_4_etc}&nbsp;&nbsp;{item_money_type1_4}&nbsp;บาท&nbsp;&nbsp;&nbsp;4.&nbsp;ค่าใช้จ่ายอื่น ๆ&nbsp;&nbsp;{item_money_type2_4_etc}&nbsp;&nbsp;{item_money_type2_4}&nbsp;บาท<br>
รวมเป็นเงินทั้งสิ้น&nbsp;&nbsp;{item_money_sum_type1}&nbsp;&nbsp;&nbsp;บาท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวมเป็นเงินทั้งสิ้น&nbsp;&nbsp;{item_money_sum_type2}&nbsp;&nbsp;&nbsp;บาท<br>
จากเงินงบประมาณ&nbsp;&nbsp;{get_money_from_1}&nbsp;โครงการวิจัย&nbsp;&nbsp;{get_money_from_2}&nbsp;ภาควิชา/หน่วยงาน&nbsp;&nbsp;{get_money_from_3}&nbsp;คณะฯ&nbsp;&nbsp;{get_money_from_4}&nbsp;อื่นๆ ระบุ&nbsp;{get_money_from_4_etc}<br>
&nbsp;&nbsp;&nbsp;&nbsp;{booking-close-text}</p>
</p>&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา<br>
เรียน คณบดี/รองคณบดีฝ่ายบริหาร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(..................................................)<br>
ได้จัดรถ (1)...หมายเลขทะเบียน..............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2)...หมายเลขทะเบียน..............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรียน คณบดี/รองคณบดีฝ่ายบริหารฯ<br>
พนักงานขับรถชื่อ (1).........................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เห็นสมควรอนุมัติ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2).........................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.............................................)<br>
ผู้จัดรถ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้าภาควิชา/หน่วยงาน<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่..........................<br>
เลขไมล์ไป.................................เลขไมล์กลับ.....................<br>
รวม.......................................กม<br>
เฉพาะโครงการวิจัย<br>
[ ] โครงการวิจัยเติมน้ำมันเชื้อเพลิง<br>
จำนวน............................บาท<br>
[ ] โครงการวิจัยค้างจ่ายค่าน้ำมันเชื้อเพลิง<br>
(ลงชื่อ)........…........................พนักงานขับรถ<br>
<p>
</body>