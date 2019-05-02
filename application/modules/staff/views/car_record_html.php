<title>ใบขอใช้รถ</title>
<style>
@page
	{
		margin-top: 2.5cm;
		margin-left: 2.5cm;
		margin-right: 2cm;
        margin-bottom: 2cm;
	}

    p.normal{
        font-size:16pt;
    }
    body{
        font-size:16pt;
    }
    .psu-logo{
        /*float: left;*/

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
<p><img class="psu-logo" src="<?=realpath('images/logo-psu.jpg')?>"><div class="head-title">บันทึกข้อความ</div></p>
<p class="sec-1"><b>ส่วนงาน</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คณะทรัพยากรธรรมชาติ&nbsp;&nbsp;&nbsp;&nbsp;ภาควิชาพัฒนาการเกษตร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โทร 6121, 6122<br>
มอ 520/{booking_num}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่</b>&nbsp;&nbsp;{booking_date}<br>
<b>เรื่อง</b>&nbsp;{booking_title}</p>
<hr class="head-line">
<p class="sec-1"><b>เรียน</b>&nbsp;{booking_reference}</p>
<p class="sec-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย{booking_objective}&nbsp;มีความประสงค์จะเดินทางไปปฏิบัติงานที่{booking_go_place}&nbsp;โดยมีวัตถุประสงค์เพื่อ (กรณีเดินทางเพื่อปฏิบัติงานในโครงการวิจัยให้ระบุ
ชื่อโครงการวิจัยด้วย)&nbsp;{booking_research_name}&nbsp;จึงใคร่ขออนุมัติใช้รถและเดินทางไปปฏิบัติงาน/
ปฏิบัติงานนอกเวลา เพื่อปฏิบัติงานดังกล่าว โดยให้รถรับ&nbsp;{booking_depart_place}&nbsp;ในวันที่&nbsp;{booking_depart_date}&nbsp;เวลา&nbsp;{booking_depart_time}</p>
</body>