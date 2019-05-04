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
<?=$car_html_content?>
</body>