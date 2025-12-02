<?php include 'head.php'; ?>
<html>
<link href="../vendor/clock-picker/clockpicker.css" rel="stylesheet">
<link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'nav.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">กิจกรรม</h1>

                    <!-- Form for Events Calendar Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">เพิ่มกิจกรรมใหม่</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="../add_save/add_list_calendar.php">
                                <!-- Event Name -->
                                <h6 class="m-0 font-weight-bold text-primary">ชื่อกิจกรรม</h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name_th_calendar">ชื่อ ไทย</label>
                                            <input type="text" class="form-control" id="name_th_calendar" name="name_th_calendar" placeholder="กรอกชื่อกิจกรรม ภาษาไทย" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name_en_calendar">ชื่อ อังกฤษ</label>
                                            <input type="text" class="form-control" id="name_en_calendar" name="name_en_calendar" placeholder="กรอกชื่อกิจกรรม ภาษาอังกฤษ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <!-- Event Date -->
                                        <h6 class="m-0 font-weight-bold text-primary">วันที่จัดกิจกรรม</h6>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="date_calendar">วันที่</label>
                                                    <input type="text" class="form-control datepicker" id="date_calendar" name="date_calendar" placeholder="วว/ดด/ปปปป" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Start and End Time -->
                                        <h6 class="m-0 font-weight-bold text-primary">เวลา</h6>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="start_time_calendar">เวลาเริ่ม</label>
                                                    <div class="input-group clockpicker" id="clockPicker2">
                                                        <input type="text" class="form-control clockpicker" id="start_time_calendar" name="start_time_calendar" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="end_time_calendar">เวลาสิ้นสุด</label>
                                                    <div class="input-group clockpicker" id="clockPicker3">
                                                        <input type="text" class="form-control clockpicker" id="end_time_calendar" name="end_time_calendar" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Speaker -->
                                <h6 class="m-0 font-weight-bold text-primary">วิทยากร</h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="speaker_th_calendar">ชื่อวิทยากร ไทย</label>
                                            <input type="text" class="form-control" id="speaker_th_calendar" name="speaker_th_calendar" placeholder="กรอกชื่อวิทยากร ภาษาไทย">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="speaker_en_calendar">ชื่อวิทยากร อังกฤษ</label>
                                            <input type="text" class="form-control" id="speaker_en_calendar" name="speaker_en_calendar" placeholder="กรอกชื่อวิทยากร ภาษาอังกฤษ">
                                        </div>
                                    </div>
                                </div>

                                <!-- Location -->
                                <h6 class="m-0 font-weight-bold text-primary">สถานที่</h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="select2Single">เลือกสถานที่</label>
                                            <select class="form-control select2-single" id="location_th_calendar" name="location_th_calendar" required>
                                                <option value="">-- กรุณาเลือกสถานที่ --</option>
                                                <!-- ภาคกลาง -->
                                                <optgroup label="ภาคกลาง">
                                                    <option value="สำนักงานใหญ่">สำนักงานใหญ่</option>
                                                    <option value="สาขาสมุทรสาคร">สาขาสมุทรสาคร</option>
                                                    <option value="สาขาพระนครศรีอยุธยา">สาขาพระนครศรีอยุธยา</option>
                                                </optgroup>
                                                <!-- ภาคตะวันออก -->
                                                <optgroup label="ภาคตะวันออก">
                                                    <option value="สาขาศรีราชา">สาขาศรีราชา</option>
                                                    <option value="สาขาอรัญประเทศ">สาขาอรัญประเทศ</option>
                                                </optgroup>
                                                <!-- ภาคตะวันออกเฉียงเหนือ -->
                                                <optgroup label="ภาคตะวันออกเฉียงเหนือ">
                                                    <option value="สาขาอุบลราชธานี">สาขาอุบลราชธานี</option>
                                                    <option value="สาขาขอนแก่น">สาขาขอนแก่น</option>
                                                    <option value="สาขาสกลนคร">สาขาสกลนคร</option>
                                                    <option value="สาขาโคราช">สาขาโคราช</option>
                                                    <option value="สาขาร้อยเอ็ด">สาขาร้อยเอ็ด</option>
                                                </optgroup>
                                                <!-- ภาคเหนือ -->
                                                <optgroup label="ภาคเหนือ">
                                                    <option value="สาขาเชียงใหม่">สาขาเชียงใหม่</option>
                                                    <option value="สาขาเชียงราย">สาขาเชียงราย</option>
                                                    <option value="สาขาพิษณุโลก">สาขาพิษณุโลก</option>
                                                </optgroup>
                                                <!-- ภาคใต้ -->
                                                <optgroup label="ภาคใต้">
                                                    <option value="สาขาชุมพร">สาขาชุมพร</option>
                                                    <option value="สาขาสุราษฎร์ธานี">สาขาสุราษฎร์ธานี</option>
                                                    <option value="สาขานครศรีธรรมราช">สาขานครศรีธรรมราช</option>
                                                    <option value="สาขาหาดใหญ่">สาขาหาดใหญ่</option>
                                                    <option value="สาขาตรัง">สาขาตรัง</option>
                                                </optgroup>
                                                <!-- ต่างประเทศ -->
                                                <optgroup label="ต่างประเทศ">
                                                    <option value="สาขาเวียงจันทน์">สาขาเวียงจันทน์</option>
                                                    <option value="สาขาปากเซ">สาขาปากเซ</option>
                                                    <option value="สาขาสะหวันนะเขต">สาขาสะหวันนะเขต</option>
                                                    <option value="สาขาเซียงขวาง">สาขาเซียงขวาง</option>
                                                    <option value="สาขากัมพูชา">สาขากัมพูชา</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="location_en_calendar">สถานที่ อังกฤษ</label>
                                            <input type="text" class="form-control" id="location_en_calendar" name="location_en_calendar" placeholder="กรอกสถานที่ ภาษาอังกฤษ" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <h6 class="m-0 font-weight-bold text-primary">หมายเหตุ</h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="notes_th_calendar">หมายเหตุ ไทย</label>
                                            <textarea class="form-control" id="notes_th_calendar" name="notes_th_calendar" rows="3" placeholder="กรอกหมายเหตุ ภาษาไทย"></textarea>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="notes_en_calendar">หมายเหตุ อังกฤษ</label>
                                            <textarea class="form-control" id="notes_en_calendar" name="notes_en_calendar" rows="3" placeholder="กรอกหมายเหตุ ภาษาอังกฤษ"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <a href="../table_calendar.php" class="btn btn-secondary">ย้อนกลับ</a>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../footer.php'; ?>
        </div>
    </div>
</body>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../vendor/select2/dist/js/select2.min.js"></script>
<script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<script src="../vendor/clock-picker/clockpicker.js"></script>
<script src="../js/ruang-admin.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize datepicker
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });

        // Initialize clockpicker for start time
        $('#start_time_calendar').clockpicker({
            autoclose: true
        });

        // Initialize clockpicker for end time
        $('#end_time_calendar').clockpicker({
            autoclose: true
        });
        $('.select2-single').select2({
            placeholder: "กรุณาเลือกสถานที่ / Please select a location",
            allowClear: true
        });

        // Select2 Single  with Placeholder
        $('.select2-single-placeholder').select2({
            placeholder: "Select a Province",
            allowClear: true
        });

        // Select2 Multiple
        $('.select2-multiple').select2();

    });
</script>
<script>
    $(document).ready(function() {
        $('#location_th_calendar').change(function() {
            var selectedLocation = $(this).val();
            var locationEn = '';

            switch (selectedLocation) {
                case 'สำนักงานใหญ่':
                    locationEn = 'Head Office';
                    break;
                case 'สาขาสมุทรสาคร':
                    locationEn = 'Samut Sakhon Branch';
                    break;
                case 'สาขาพระนครศรีอยุธยา':
                    locationEn = 'Phra Nakhon Si Ayutthaya Branch';
                    break;
                case 'สาขาศรีราชา':
                    locationEn = 'Si Racha Branch';
                    break;
                case 'สาขาอรัญประเทศ':
                    locationEn = 'Aranyaprathet Branch';
                    break;
                case 'สาขาอุบลราชธานี':
                    locationEn = 'Ubon Ratchathani Branch';
                    break;
                case 'สาขาขอนแก่น':
                    locationEn = 'Khon Kaen Branch';
                    break;
                case 'สาขาสกลนคร':
                    locationEn = 'Sakon Nakhon Branch';
                    break;
                case 'สาขาโคราช':
                    locationEn = 'Korat Branch';
                    break;
                case 'สาขาร้อยเอ็ด':
                    locationEn = 'Roi Et Branch';
                    break;
                case 'สาขาเชียงใหม่':
                    locationEn = 'Chiang Mai Branch';
                    break;
                case 'สาขาเชียงราย':
                    locationEn = 'Chiang Rai Branch';
                    break;
                case 'สาขาพิษณุโลก':
                    locationEn = 'Phitsanulok Branch';
                    break;
                case 'สาขาชุมพร':
                    locationEn = 'Chumphon Branch';
                    break;
                case 'สาขาสุราษฎร์ธานี':
                    locationEn = 'Surat Thani Branch';
                    break;
                case 'สาขานครศรีธรรมราช':
                    locationEn = 'Nakhon Si Thammarat Branch';
                    break;
                case 'สาขาหาดใหญ่':
                    locationEn = 'Hat Yai Branch';
                    break;
                case 'สาขาตรัง':
                    locationEn = 'Trang Branch';
                    break;
                case 'สาขาเวียงจันทน์':
                    locationEn = 'Vientiane Branch';
                    break;
                case 'สาขาปากเซ':
                    locationEn = 'Pakse Branch';
                    break;
                case 'สาขาสะหวันนะเขต':
                    locationEn = 'Savannakhet Branch';
                    break;
                case 'สาขาเซียงขวาง':
                    locationEn = 'Xieng Khouang Branch';
                    break;
                case 'สาขากัมพูชา':
                    locationEn = 'Cambodia Branch';
                    break;
                default:
                    locationEn = '';
            }

            $('#location_en_calendar').val(locationEn).prop('readonly', true);
        });
    });
</script>

</html>