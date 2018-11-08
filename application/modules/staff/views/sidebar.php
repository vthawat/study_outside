 <!-- Optionally, you can add icons to the links --> 
    <!-- <li class="treeview"><a href="<?=base_url()?>staff"><i class='fa fa-dashboard text-green fa-fw'></i><span>Dashboard</span></a></li>     -->
    <li class="treeview">
        <a href="<?=base_url()?>"><i class='fa fa-rocket text-green fa-fw'></i><span>จัดการข้อมูลการเดินทาง</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="<?=base_url('staff/calendar')?>"><i class='fa fa-circle-o text-green fa-fw'></i>ปฏิทินการเดินทาง</a></li>
                <li><a href="<?=base_url()?>staff/trip"><i class='fa fa-circle-o text-green fa-fw'></i>ความต้องการเดินทาง</a></li>
              	<!--<li><a href="<?=base_url()?>staff/money"><i class='fa fa-circle-o text-green fa-fw'></i>จัดการข้อมูลงบประมาณ</a></li> -->
                <li><a href="<?=base_url()?>staff/cars"><i class='fa fa-circle-o text-green fa-fw'></i>ออกใบขอใช้รถ</a></li>
                <li><a href="<?=base_url()?>staff/report"><i class='fa fa-circle-o text-green fa-fw'></i>รายงานสรุปการเดินทาง</a></li>
            </ul>
    </li>

 <!-- Optionally, you can add icons to the links -->   
    <li class="treeview">
        <a href="<?=base_url()?>"><i class='fa fa-gears text-green fa-fw'></i><span>จัดการข้อมูลพื้นฐาน</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              	<li><a href="<?=base_url()?>staff/place"><i class='fa fa-circle-o text-green fa-fw'></i>สถานที่ศึกษาดูงาน</a></li>
                <li><a href="<?=base_url()?>staff/subject_major"><i class='fa fa-circle-o text-green fa-fw'></i>สาขาวิชา</a></li>
                <li><a href="<?=base_url()?>staff/subject"><i class='fa fa-circle-o text-green fa-fw'></i>รายวิชาฝึกภาคสนาม</a></li>
            </ul>
    </li>            
    