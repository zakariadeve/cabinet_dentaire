<?php
session_start();
include "connection.php";
if (!isset($_SESSION['ida'])) {
    $idr = $_GET['idr'];
}else{
   
echo "<script>alert('Rendez-vous inexiste!')</script>";
echo "<script>window.location.href='php#rdv.php'</script>";
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة الحجوزات - عيادة طب الأسنان</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            direction: rtl;
            background-color: #f4f7f6;
            color: #333;
        }

        .header-print {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2980b9;
        }

        .header-print h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header-print p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .info-section {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-right: 4px solid #3498db;
        }

        .info-section h2 {
            color: #2c3e50;
            font-size: 1.3rem;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }

        .info-item {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .info-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .info-value {
            color: #555;
            font-size: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table thead {
            background-color: #2c3e50;
            color: white;
        }

        table th {
            padding: 15px;
            text-align: right;
            font-weight: 600;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        table tbody tr:hover {
            background-color: #f5f5f5;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        .status {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status.confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-print {
            background-color: #3498db;
            color: white;
        }

        .btn-print:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        .btn-back {
            background-color: #95a5a6;
            color: white;
        }

        .btn-back:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
        }

        .no-data {
            background-color: white;
            padding: 40px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #666;
        }

        .no-data i {
            font-size: 3rem;
            color: #bdc3c7;
            margin-bottom: 15px;
            display: block;
        }

        @media print {
            body {
                background-color: white;
            }

            .button-group {
                display: none;
            }

            .header-print {
                box-shadow: none;
                margin-bottom: 20px;
            }

            table {
                box-shadow: none;
            }

            .info-section {
                box-shadow: none;
                page-break-inside: avoid;
            }
        }

        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .header-print h1 {
                font-size: 1.5rem;
            }

            table {
                font-size: 0.9rem;
            }

            table th,
            table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header-print">
        <img src="img/logo.png" alt="logo" style="height: 50px; margin-bottom: 10px;">
        <h1><i class="fa fa-tooth"></i> عيادة طب الأسنان</h1>
        <p>تفاصيل الحجز للطباعة</p>
    </div>

    <div class="container">
        <?php
        if (!isset($_SESSION['ida'])) {
            echo "<div class='no-data'>";
            echo "<i class='fa fa-lock'></i>";
            echo "<h2>يرجى تسجيل الدخول أولاً</h2>";
            echo "<p><a href='admin.php' style='color: #3498db; text-decoration: none;'>العودة إلى صفحة الدخول</a></p>";
            echo "</div>";
        } else {
            // التحقق من وجود ملف معرّف في URL
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                echo "<div class='no-data'>";
                echo "<i class='fa fa-exclamation-circle'></i>";
                echo "<h2>معرّف الحجز مفقود</h2>";
                echo "<p>يرجى تحديد حجز للطباعة</p>";
                echo "</div>";
            } else {
                $rdv_id = intval($_GET['id']);
                
                // استخراج معلومات الحجز
                $rdv_req = mysqli_query($conn, "SELECT * FROM rdv WHERE id = '$rdv_id' LIMIT 1");
                $rdv = mysqli_fetch_assoc($rdv_req);

                if (!$rdv) {
                    echo "<div class='no-data'>";
                    echo "<i class='fa fa-calendar'></i>";
                    echo "<h2>الحجز غير موجود</h2>";
                    echo "<p>لم يتم العثور على حجز بهذا المعرّف</p>";
                    echo "</div>";
                } else {
                    // عرض معلومات الحجز
                    echo "<div class='info-section'>";
                    echo "<h2>بيانات الحجز</h2>";
                    echo "<div class='info-row'>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>رقم الحجز (المعرّف):</div>";
                    echo "<div class='info-value'>" . htmlspecialchars($rdv['id']) . "</div>";
                    echo "</div>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>تاريخ الطباعة:</div>";
                    echo "<div class='info-value'>" . date('d/m/Y H:i:s') . "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    // عرض معلومات المريض
                    echo "<div class='info-section'>";
                    echo "<h2>معلومات المريض</h2>";
                    echo "<div class='info-row'>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>الاسم الكامل:</div>";
                    echo "<div class='info-value'>" . htmlspecialchars($rdv['name']) . "</div>";
                    echo "</div>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>البريد الإلكتروني:</div>";
                    echo "<div class='info-value'>" . htmlspecialchars($rdv['email']) . "</div>";
                    echo "</div>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>رقم الهاتف:</div>";
                    echo "<div class='info-value'>" . htmlspecialchars($rdv['phone']) . "</div>";
                    echo "</div>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>تاريخ الحجز:</div>";
                    echo "<div class='info-value'>" . date('d/m/Y', strtotime($rdv['date_rdv'])) . "</div>";
                    echo "</div>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>وقت الحجز:</div>";
                    echo "<div class='info-value'>" . htmlspecialchars($rdv['time_rdv']) . "</div>";
                    echo "</div>";
                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>نوع العلاج:</div>";
                    echo "<div class='info-value'>" . htmlspecialchars(isset($rdv['type']) ? $rdv['type'] : 'عام') . "</div>";
                    echo "</div>";
                    
                    // عرض الحالة
                    $status = isset($rdv['status']) ? strtolower($rdv['status']) : 'pending';
                    $status_class = 'pending';
                    $status_text = 'قيد الانتظار';

                    if ($status == 'confirmed' || $status == 'مؤكد') {
                        $status_class = 'confirmed';
                        $status_text = 'مؤكد';
                    } elseif ($status == 'cancelled' || $status == 'ملغى') {
                        $status_class = 'cancelled';
                        $status_text = 'ملغى';
                    }

                    echo "<div class='info-item'>";
                    echo "<div class='info-label'>حالة الحجز:</div>";
                    echo "<div class='info-value'><span class='status " . $status_class . "'>" . $status_text . "</span></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    // عرض معلومات إضافية إن وجدت
                    if (isset($rdv['notes']) && !empty($rdv['notes'])) {
                        echo "<div class='info-section'>";
                        echo "<h2>ملاحظات</h2>";
                        echo "<div class='info-item'>";
                        echo "<div class='info-value'>" . htmlspecialchars($rdv['notes']) . "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
        }
        ?>
    </div>

    <div class="button-group">
        <button class="btn btn-print" onclick="window.print()">
            <i class="fa fa-print"></i> طباعة
        </button>
        <a href="cpanel.php" class="btn btn-back">
            <i class="fa fa-arrow-left"></i> العودة
        </a>
    </div>

</body>
</html>
