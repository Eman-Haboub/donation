<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة AI - الأسر المحتاجة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ألوان حسب حالة الطوارئ */
        .emergency-high { background-color: #f8d7da; }   /* أحمر فاتح */
        .emergency-medium { background-color: #fff3cd; } /* أصفر فاتح */
        .emergency-low { background-color: #d1e7dd; }    /* أخضر فاتح */

        /* ألوان متدرجة حسب درجة الأولوية */
        .priority-low { background-color: #d1e7dd; }
        .priority-medium { background-color: #fff3cd; }
        .priority-high { background-color: #f8d7da; }
    </style>
</head>
<body class="p-4">

<h2 class="mb-4">الأسر حسب الأولوية</h2>

<table class="table table-bordered" id="families-table">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>عدد الأفراد</th>
            <th>حالة الطوارئ</th>
            <th>درجة الأولوية</th>
            <th>الاحتياجات غير المكتملة</th>
        </tr>
    </thead>
    <tbody>
        <!-- سيتم ملء البيانات عبر AJAX -->
    </tbody>
</table>

<h2 class="mt-5 mb-4">التنبيهات الذكية</h2>
<ul class="list-group" id="alerts-list">
    <!-- سيتم ملء التنبيهات عبر AJAX -->
</ul>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function fetchAIData() {
    $.get('/admin/ai-data', function(data) {
        // تحديث جدول الأسر
        let tbody = '';
        data.families.forEach(family => {
            let emergencyClass = family.emergency == 'high' ? 'emergency-high' :
                                 family.emergency == 'medium' ? 'emergency-medium' : 'emergency-low';

            // ألوان حسب درجة الأولوية
            let priorityClass = family.priority_score >= 15 ? 'priority-high' :
                                family.priority_score >= 8 ? 'priority-medium' : 'priority-low';

            let needsHtml = '';
            family.needs.forEach(need => {
                if (!need.fulfilled) {
                    needsHtml += need.type + ': لم يتم تلبيتها <br>';
                }
            });

            tbody += `<tr class="${emergencyClass} ${priorityClass}">
                        <td>${family.name}</td>
                        <td>${family.members_count}</td>
                        <td>${family.emergency.charAt(0).toUpperCase() + family.emergency.slice(1)}</td>
                        <td>${family.priority_score}</td>
                        <td>${needsHtml}</td>
                      </tr>`;
        });
        $('#families-table tbody').html(tbody);

        // تحديث التنبيهات
        let alertsHtml = '';
        data.alerts.forEach(alert => {
            alertsHtml += `<li class="list-group-item list-group-item-danger">${alert} <button class="btn btn-sm btn-primary float-end">إرسال إشعار</button></li>`;
        });
        $('#alerts-list').html(alertsHtml);
    });
}

// جلب البيانات فور تحميل الصفحة
fetchAIData();

// تحديث البيانات كل 30 ثانية
setInterval(fetchAIData, 30000);
</script>

</body>
</html>
